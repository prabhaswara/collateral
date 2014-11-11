<?php

$db_function = new db_function();
$action = $_POST["action"] == null ? "" : strtolower($_POST["action"]);
$showInformasiJaminan = false;
$showInformasiAsuransiKerugian = false;
$showInformasiAsuransiJiwa = false;
$showInformasiFleksi = false;
$showInformasiOto = false;
$showDtLunas = false;
$showForm = true;
$showInformasiLain = true;
$showEmergencyKon = true;
$messageBox = "";
$pesanError = array();

$program_kd = "";
$cab_kd = "";
$lnc = "*";

//$messageBox = showMessage("<div>Data Telah di simpan</div>","notice");

$produkLama = "";
$programLama = "";
$agamaLama = "";
$kelaminLama = "";
$skdrLama = "";
$jaminanLama = "";
$proses_agunanLama = "";
$jenis_surat_tanahLama = "";
$no_covernoteLama = "";
$jkw_covernoteLama = "";
$status_imbLama = "";
$jenis_pengikatanLama = "";
$no_pengikatanLama = "";
$proses_pengikatanLama = "";
$notarisLama = "";
$developerLama = "";
$skim_pencairanLama = "";
$siupLama = "";
$tdpLama = "";
$otherLama = "";
$no_polis_ass_kerugianLama = "";
$jenis_kendaraanLama = "";
$merkLama = "";
$asuransi_jiwaLama = "";
$asuransi_kerugianLama = "";
$berkas_asuransi_kerugianLama = "";
$no_polis_ass_jiwaLama = "";
$kendalaLama = "";
$jenis_sertifikatLama = "";






if (empty($_POST)) {
    $buf = $db_function->selectOneRows("select * from debitur where no_rekg_pinjaman='" . $_GET['id'] . "'");
    // print_r($_POST);
    foreach ($buf as $key => $val) {
        if (!is_int($key)) {
            $_POST['frm'][strtolower($key)] = isDateDB($val) ? balikTgl($val) : $val;
        }
    }
    $produkLama = $_POST['frm']['produk'];
    $programLama = $_POST['frm']['program'];
    $agamaLama = $_POST['frm']['agama'];
    $kelaminLama = $_POST['frm']['kelamin'];
    $skdrLama = $_POST['frm']['skdr'];
    $jaminanLama = $_POST['frm']['jaminan'];
    $proses_agunanLama = $_POST['frm']['proses_agunan'];
    $jenis_surat_tanahLama = $_POST['frm']['jenis_surat_tanah'];
    $no_covernoteLama = $_POST['frm']['no_covernote'];
    $jkw_covernoteLama = $_POST['frm']['jkw_covernote'];
    $status_imbLama = $_POST['frm']['status_imb'];
    $jenis_pengikatanLama = $_POST['frm']['jenis_pengikatan'];
    $no_pengikatanLama = $_POST['frm']['no_pengikatan'];
    $proses_pengikatanLama = $_POST['frm']['proses_pengikatan'];
    $notarisLama = $_POST["frm"]["notaris"];
    $developerLama = $_POST["frm"]["developer"];
    $skim_pencairanLama = $_POST["frm"]["skim_pencairan"];
    $siupLama = $_POST["frm"]["siup"];
    $tdpLama = $_POST["frm"]["tdp"];
    $otherLama = $_POST["frm"]["other"];
    $no_polis_ass_kerugianLama = $_POST["frm"]["no_polis_ass_kerugian"];
    $asuransi_kerugianLama = $_POST["frm"]["asuransi_kerugian"];
    $asuransi_jiwaLama = $_POST["frm"]["asuransi_jiwa"];
    $berkas_asuransi_kerugianLama = $_POST["frm"]["berkas_asuransi_kerugian"];
    $jenis_kendaraanLama = $_POST["frm"]["jenis_kendaraan"];
    $merkLama = $_POST["frm"]["merk"];
    $no_polis_ass_jiwaLama = $_POST["frm"]["no_polis_ass_jiwa"];
    $kendalaLama = $_POST["frm"]["kendalaLama"];
    $jenis_sertifikatLama = $_POST["frm"]["jenis_sertifikat"];
    $noaplikasi = $_POST['frm']['noaplikasi'];

    // print_r($_POST);exit;
} else {
    $produkLama = $_POST['produkLama'];
    $programLama = $_POST['programLama'];
   
    $agamaLama = $_POST['agamaLama'];
    $kelaminLama = $_POST['kelaminLama'];

    $skdrLama = $_POST['frm']['skdrLama'];
    $jaminanLama = $_POST['frm']['jaminanLama'];
    $proses_agunanLama = $_POST['frm']['proses_agunanLama'];
    $jenis_surat_tanahLama = $_POST['frm']['jenis_surat_tanahLama'];
    $no_covernoteLama = $_POST['frm']['no_covernoteLama'];
    $jkw_covernoteLama = $_POST['frm']['jkw_covernoteLama'];
    $status_imbLama = $_POST['frm']['status_imbLama'];
    $jenis_pengikatanLama = $_POST['frm']['jenis_pengikatanLama'];
    $no_pengikatanLama = $_POST['frm']['no_pengikatanLama'];
    $proses_pengikatanLama = $_POST['frm']['proses_pengikatanLama'];
    $notarisLama = $_POST["frm"]["notarisLama"];
    $developerLama = $_POST["frm"]["developerLama"];
    $skim_pencairanLama = $_POST["frm"]["skim_pencairanLama"];
    $siupLama = $_POST["frm"]["siupLama"];
    $tdpLama = $_POST["frm"]["tdpLama"];
    $otherLama = $_POST["frm"]["otherLama"];
    $no_polis_ass_kerugianLama = $_POST["frm"]["no_polis_ass_kerugianLama"];
    $asuransi_kerugianLama = $_POST["frm"]["asuransi_kerugianLama"];
    $asuransi_jiwaLama = $_POST["frm"]["asuransi_jiwaLama"];
    $berkas_asuransi_kerugianLama = $_POST["frm"]["berkas_asuransi_kerugianLama"];
    $jenis_kendaraanLama = $_POST["frm"]["jenis_kendaraanLama"];
    $merkLama = $_POST["frm"]["merkLama"];
    $no_polis_ass_jiwaLama = $_POST["frm"]["no_polis_ass_jiwaLama"];
    $kendalaLama = $_POST["frm"]["kendalaLamaLama"];
    $jenis_sertifikatLama = $_POST["frm"]["jenis_sertifikatLama"];

    $chekNoaplikasi = true;
    $noaplikasi = $_POST['frm']['noaplikasi'];
}



if (!empty($_POST)) {
    if ($_POST['action'] == "simpan") {

        $pesanError = array_merge($pesanError, validasi_form($_POST['frm']));
        if (empty($pesanError)) {
            $datenow = date(Ymd);
            $userCreate = $_SESSION['colateral']['npp'];
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
            //update debitur

            $query = "update debitur set tgl_update=now(),userupdate='$userCreate',";

            foreach ($_POST['frm'] as $key => $val) {
                if (isDate($val)) {
                    $val = balikTgl($val);
                }
                $query.="$key='$val',";
            }
            $query = substr_replace($query, "", -1);
            $query.=" where no_rekg_pinjaman='" . $_POST['frm']['no_rekg_pinjaman'] . "'";

            $buf = cleanstr($db_function->exec($query));
            if ($buf == "") {
                //insert trail
                $strKey = "";
                $strVal = "'";
                $frmTrail = $_POST['frm'];

                foreach ($frmTrail as $key => $val) {
                    if (isDate($val)) {
                        $val = balikTgl($val);
                    }
                    $strKey.=$key . ",";
                    $strVal.=trim($val) . "','";
                }
                $query = "select no_trail from debitur_trail where no_rekg_pinjaman='" . $_POST['frm']['no_rekg_pinjaman'] . "' order by no_trail desc";

                $lastOrder = $db_function->selectOnefield($query);

                $lastOrder = $lastOrder == "" ? "0" : ($lastOrder + 1);


                $strKey = substr_replace($strKey, "", -1);
                $strVal = substr_replace($strVal, "", -2);
                $query = "insert into debitur_trail
                                    (no_trail,$strKey,userupdate,tgl_update) 
                            values('$lastOrder',$strVal,'$userCreate',now());";
                //  echo $query;exit;
                $buf = cleanstr($db_function->exec($query));
                // echo $buf;
                // exit;
            }
            if ($buf != "") {
                array_push($pesanError, $buf);
            } else {

                $_SESSION['colateral']['message'] = showMessage("Data telah ubah", "success", "-ses");

                header("location:edit_data_debitur.php?id=" . $_POST['frm']['no_rekg_pinjaman']);
                exit;
            }
        }
    }

    $messageBox = showMessage($pesanError);
}
///////////////
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
        
    }
////////////////

$ListProduk = array();
$buf = $db_function->selectAllRows("select produk_nm from  master_produk order by produk_nm");
foreach ($buf as $row) {
    $ListProduk[$row['produk_nm']] = $row['produk_nm'];
}
$ListProgram = array();
$buf = $db_function->selectAllRows(
        "select b.program_nm from  master_produk a join master_program b on a.produk_kd=b.produk_kd
        where a.produk_nm='" . $_POST['frm']["produk"] . "' order by b.program_nm");
foreach ($buf as $row) {
    $ListProgram[$row['program_nm']] = $row['program_nm'];
}

$produk_nm = trim(strtoupper($_POST['frm']["produk"]));
//echo $produk_nm;exit;
if (in_array($produk_nm, array("BNI GRIYA", "BNI OTO", "BNI GRIYA MULTIGUNA", "BNI FLEKSI", "BNI CERDAS", "BNI WIRAUSAHA", "UMG"))) {
// kalau pilihan nya ada didatabase baru pakek kondisi   
//cuma Griya/Multiguna/BWU yg bisa
  
    if (in_array($produk_kd, array("01", "03", "06"))) {
     
        $showInformasiJaminan = true;
    }
    //cuma Griya/OTO/Multiguna/BWU/umg yg bisa
    if (in_array($produk_kd, array("01", "02", "03", "06", "07"))) {
        $showInformasiAsuransiKerugian = true;
    }

    //semua nya
    $showInformasiAsuransiJiwa = $produk_kd == "07" ? false : true; //umg ngak muncul
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
//kalau pilihan ngk ada di database munculin semua    
    $showInformasiJaminan = true;
    $showInformasiAsuransiKerugian = true;
    $showInformasiAsuransiJiwa = true;
    $showInformasiFleksi = true;
    $showInformasiOto = true;
    $showDtLunas = true;
    $showForm = true;
    $showInformasiLain = true;
    $showEmergencyKon = true;
}

/*
  $showInformasiJaminan = true;
  $showInformasiAsuransiKerugian = true;
  $showInformasiAsuransiJiwa = true;
  $showInformasiFleksi = true;
  $showInformasiOto = true;
  $showDtLunas = true;
  $showForm = true;
  $showInformasiLain = true;
  $showEmergencyKon = true; */

function validasi_form($frm) {

    $pesanError = array();
    $db_function = new db_function();
    if (cleanstr($frm['namadebitur']) == "") {
        array_push($pesanError, "Nama Debitur Harus diisi");
    }
    if (cleanstr($frm['produk']) == "") {
        array_push($pesanError, "Nama Produk Harus diisi");
    }
    if (cleanstr($frm['lnc']) == "") {
        array_push($pesanError, "LNC Harus diisi");
    }
    if (cleanstr($frm['input_date']) == "") {
        array_push($pesanError, "input date Harus diisi");
    }
    if (cleanstr($frm['tgl_pk']) == "") {
        array_push($pesanError, "Tgl Perjanjian Kredit Harus diisi");
    }
    if (cleanstr($frm['jkw_kredit']) == "") {
        array_push($pesanError, "Jangka Waktu Kredit Harus diisi");
    }
    if (cleanstr($frm['fixed_rate']) == "" && preg_match("/(griya|multiguna)/", strtolower($frm['produk']))) {

        array_push($pesanError, "Masa fix rate Harus diisi");
    }
    if (cleanstr($frm['no_rekg_pinjaman']) == "") {
        array_push($pesanError, "Norek Pinjaman Harus diisi");
    }

    $skimPencairan = strtolower($frm['skim_pencairan']);
    $skimPks = strtolower($frm['skim_pks']);
    if ($skimPencairan == "partial drow down" && in_array($skimPks, array("kavling bangun", "indent"))) {

        if ($frm['progress'] == "") {
            array_push($pesanError, "Progress Pembangunan harus di isi untuk Partial drow down, skim pks kavling bangun/indent ");
        } elseif ($frm["progress"] != "SELESAI" && !in_array($frm['tgl_cair_tahap_dok'], array("", "00-00-0000"))) {
            array_push($pesanError, "tanggal cair tahap dok sudah di isi harap progress pembangunan = <b>selesai</b>");
        }
    }
    return $pesanError;
}

?>