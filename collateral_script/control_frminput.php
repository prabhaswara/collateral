<?php

$db_function = new db_function();
$action = $_POST["action"] == null ? "" : strtolower($_POST["action"]);
$showInformasiJaminan = false;
$showInformasiAsuransiKerugian = false;
$showInformasiAsuransiJiwa = false;
$showInformasiFleksi = false;
$showInformasiOto = false;
$showDtLunas = false;
$showForm = false;
$showInformasiLain = true;
$showEmergencyKon = true;
$messageBox = "";
$pesanError = array();

$program_kd = "";
$cab_kd = "";
$lnc = "*";

if ($action != "") {



    $chekNoaplikasi = true;
    $noaplikasi = $_POST['frm']['noaplikasi'];
    if (strlen($noaplikasi) >= 18 && strlen($noaplikasi) <= 24) {
        $buf['tgl'] = substr($noaplikasi, 0, 8);
        $buf['program_kd'] = substr($noaplikasi, 8, 2);
        $buf['cab_kd'] = substr($noaplikasi, 10, 5);

        $program_kd = $buf['program_kd'];
        $cab_kd = $buf['cab_kd'];

        $_POST['frm']['input_date'] = substr($buf['tgl'], 0, 2) . "-" . substr($buf['tgl'], 2, 2) . "-" . substr($buf['tgl'], 4, 4);
        $_POST['frm']['lnc'] = cleanstr($db_function->selectOnefield("select singkatan from master_cab where cab_kd='" . $buf['cab_kd'] . "'"));
        $lnc = $_POST['frm']['lnc'];

        $buf = $db_function->selectOneRows(
                "select prog.program_nm,prod.produk_kd,prod.produk_nm from master_program prog 
                    left join master_produk  prod on prog.produk_kd=prod.produk_kd
                    where prog.program_kd='" . $buf['program_kd'] . "'
                    ");
        $produk_kd = "";
        if (!empty($buf)) {

            $_POST['frm']['produk'] = $buf['produk_nm'];
            $_POST['frm']['program'] = $buf['program_nm'];
            $produk_kd = $buf['produk_kd'];
        } else {
            $_POST['frm']['produk'] = "";
            $_POST['frm']['program'] = "";
        }
        /*
          01 BNI GRIYA
          02 BNI OTO
          03 BNI GRIYA MULTIGUNA
          04 BNI FLEKSI
          05 BNI CERDAS
          06 BNI WIRAUSAHA
          07 UMG
         */

        //cuma Griya/Multiguna/BWU yg bisa
        if (in_array($produk_kd, array("01", "03", "06"))) {
            $showInformasiJaminan = true;
        }
         //cuma Griya/OTO/Multiguna/BWU/umg yg bisa
        if (in_array($produk_kd, array("01", "02", "03", "06","07"))) {
            $showInformasiAsuransiKerugian = true;
        }

        //semua nya
        $showInformasiAsuransiJiwa = $produk_kd=="07"?false:true;//umg ngak muncul
        $showDtLunas = true;
        $showInformasiLain = true;
        $showEmergencyKon = true;
        //cuma fleksi
        if (in_array($produk_kd, array("04"))) {
            $showInformasiFleksi = true;

            //cuma oto
            if (in_array($produk_kd, array("02"))) {
                $showInformasiOto = true;
            }
        }
    } else {
        $chekNoaplikasi = false;
    }

    if (!$chekNoaplikasi) {
        array_push($pesanError, "Format nomor aplikasi salah");
        $_POST['frm']['lnc'] = "";
        $_POST['frm']['produk'] = "";
        $_POST['frm']['program'] = "";
    } else {
        $showForm = true;
    }

    if ($action == "simpan" && $chekNoaplikasi ) {
        $frm=$_POST['frm'];
        $pesanError=  array_merge($pesanError,validasi_form($frm));
       
        if(empty($pesanError)){
           
            $strKey = "";
            $strVal = "'";
            // unset skim_pencairan bila sekaligus
            if ($_POST['frm']['skim_pencairan'] == "SEKALIGUS") {
                unset($_POST['frm']['siup']);
                unset($_POST['frm']['tdp']);
                unset($_POST['frm']['others']);
                unset($_POST['frm']['total_unitdibangun']);
                unset($_POST['frm']['cair_tahap_fondasi']);
                unset($_POST['frm']['tgl_cair_tahap_fondasi']);
                unset($_POST['frm']['cair_tahap_topping']);
                unset($_POST['frm']['tgl_cair_tahap_topping']);
                unset($_POST['frm']['cair_tahap_bast']);
                unset($_POST['frm']['tgl_cair_tahap_bast']);
                unset($_POST['frm']['cair_tahap_dok']);
                unset($_POST['frm']['tgl_cair_tahap_dok']);


            }
            
            $datenow=date(Ymd);
            $userCreate=$_SESSION['colateral']['npp'];
           
            
            foreach ($_POST['frm'] as $key => $val) {
                if (isDate($val)) {
                    $val = balikTgl($val);
                }
                $strKey.=$key . ",";
                $strVal.=trim($val) . "','";
            }
            $strKey = substr_replace($strKey, "", -1);
            $strVal = substr_replace($strVal, "", -2);

            $query = "insert into debitur
                            ($strKey,usercreate,userupdate,action,tgl_update) 
                    values($strVal,'$userCreate','$userCreate','$datenow','$datenow');";            
            $buf=  cleanstr($db_function->exec($query));
            if($buf==""){               
                //--insert trail
                $strKey = "";
                $strVal = "'";
                $frmTrail=$_POST['frm'];
                $nonTrail=array('usercreate','action');
                
                foreach($nonTrail as $row){
                    unset($frmTrail[$row]);
                }
                foreach ($frmTrail as $key => $val) {
                    if (isDate($val)) {
                        $val = balikTgl($val);
                    }
                    $strKey.=$key . ",";
                    $strVal.=trim($val) . "','";
                }
                
                $strKey = substr_replace($strKey, "", -1);
                $strVal = substr_replace($strVal, "", -2);
                $query = "insert into debitur_trail
                                (no_trail,$strKey,userupdate,tgl_update) 
                        values('1',$strVal,'$userCreate',now());";            
                $buf=  cleanstr($db_function->exec($query));  
                if($buf!=""){
                     cleanstr($db_function->exec("delete from debitur where noaplikasi='".$_POST['frm']['noaplikasi']."'"));
                }
            }
            //------------
            if($buf!=""){              
                 array_push($pesanError, $buf);
            }
            else{
                if($frm['jaminan'] =="SATUAN" &&
                    cleanstr($frm['no_surat_tanah'])!="" &&
                    cleanstr($frm['jml_jaminan'])!=""
                   ){
                     $sql="select lnc,noaplikasi,namadebitur,no_rekg_pinjaman,produk,jaminan,no_surat_tanah,jml_jaminan ".
                     "FROM debitur WHERE debitur.no_surat_tanah = '".$frm['no_surat_tanah']."' ".
                     "AND debitur.jaminan='" . $frm['jaminan'] . "' AND debitur.jml_jaminan='".$frm['jml_jaminan']."' order by input_date desc";

                     $dataduplikasi=$db_function->selectAllRows($sql);
                     if(count($dataduplikasi)>0){
                         $buf="<h3>DAFTAR DEBITUR YANG TERINDIKASI DUPLIKASI SERTIFIKAT</h3><table class='tblLookup' border='1px'><thead><tr>
                             <th>NAMA LNC</th> 
                             <th>NO. APLIKASI</th> 
                             <th>NAMA DEBITUR</th>
                             <th>NO. REK. PINJAMAN</th>
                             <th>JENIS PRODUK</th>
                             <th>STATUS SERTIFIKAT</th>
                             <th>NO. SERTIFIKAT</th>
                             <th>NO. GS/SU</th>
                             </tr></thead><tbody>";
                         foreach ($dataduplikasi as $row) {
                             $buf.="<tr><td>" . $frm['lnc'] . "</td>" .
                                     "<td>" . $frm['noaplikasi'] . "</td>" .
                                     "<td>" . $frm['namadebitur'] . "</td>" .
                                     "<td>" . $frm['no_rekg_pinjaman'] . "</td>" .
                                     "<td>" . $frm['produk'] . "</td>" .
                                     "<td>" . $frm['jaminan'] . "</td>" .
                                     "<td>" . $frm['no_surat_tanah'] . "</td>" .
                                     "<td>" . $frm['jml_jaminan'] . "</td>" .
                                     "</tr>";
                         }
                         $buf.="</tbody></table>";
                         $_SESSION['colateral']['message']= showMessage($buf,"notice","-ses");
                     }


                 }
                 if(empty($_SESSION['colateral']['message'])){
                     $_SESSION['colateral']['message']= showMessage("Data debitur telah disimpan","success","-ses");
                 }

                 header("location:col_frminput.php");
                 exit;
            }        
        }
       
    }
    
   //error success warning notice
    $messageBox = showMessage($pesanError);
}
//$messageBox = showMessage("<div>Data Telah di simpan</div>","notice");


/*
  $showInformasiJaminan = true;
  $showInformasiAsuransiKerugian = true;
  $showInformasiAsuransiJiwa = true;
  $showInformasiFleksi = true;
  $showInformasiOto = true;
  $showDtLunas=true;
  $showForm=true;
  $showInformasiLain=true;
  $showEmergencyKon=true;
*/
  
  function validasi_form($frm){
      $pesanError=array();
      $db_function = new db_function();
      if(cleanstr($frm['namadebitur'])==""){
          array_push($pesanError, "Nama Debitur Harus diisi");
      }
      if(cleanstr($frm['tgl_pk'])==""){
          array_push($pesanError, "Tgl Perjanjian Kredit Harus diisi");
      }
      if(cleanstr($frm['jkw_kredit'])==""){
          array_push($pesanError, "Jangka Waktu Kredit Harus diisi");
      }
      if(cleanstr($frm['fixed_rate'])=="" && preg_match("/(griya|multiguna)/", strtolower($frm['produk']))){
          
          array_push($pesanError, "Masa fix rate Harus diisi");
      }
      if(cleanstr($frm['no_rekg_pinjaman'])==""){
          array_push($pesanError, "Norek Pinjaman Harus diisi");
      }
      //validasi no_rekg_pinjaman
      $buf=$db_function->selectOnefield("select noaplikasi from debitur where no_rekg_pinjaman ='".$frm['no_rekg_pinjaman']."'");
      if(cleanstr($buf)!=""){
          array_push($pesanError, "Norek Pinjaman sudah ada sebelum nya dengan no aplikasi ".$buf);
      }
      
      $skimPencairan=  strtolower($frm['skim_pencairan']);
      $skimPks=  strtolower($frm['skim_pks']);
      if($skimPencairan=="partial drow down" && in_array($skimPks,array("kavling bangun","indent") ) ){
          
          if($frm['progress']==""){
            array_push($pesanError, "Progress Pembangunan harus di isi untuk Partial drow down, skim pks kavling bangun/indent ");
          }elseif($frm["progress"]!="SELESAI"&&!in_array($frm['tgl_cair_tahap_dok'],array("","00-00-0000") )){
            array_push($pesanError, "tanggal cair tahap dok sudah di isi harap progress pembangunan = <b>selesai</b>");
          }
          
      }
      
      return $pesanError;
  }
?>