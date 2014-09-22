<?php

include 'collateral_script/session_head.php';
include 'collateral_script/db_function.php';
include 'collateral_script/function.php';


$mod = $_GET["mod"];

switch ($mod) {
    case "json_list_program":

        $ListProgram = getlistProgram($_GET["produk"]);
        echo json_encode($ListProgram);
        exit;

        break;

    case "json_nomor_aplikasi":

        json_nomor_aplikasi();

        break;

    case "json_sumDet":

        json_sumDet();

    break;
    case "json_sumDetCair":

        json_sumDetCair();

    break;

case "json_produktifitasDet":

        json_produktifitasDet();

    break;
}

function json_produktifitasDet(){
$npp = $_GET['npp'];
$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];
$submn = $_GET['submn'];
$lnc = $_GET['lnc'];
$dataArray = array();

$db_function = new db_function();



    $page = $_GET['page'];
    $limit = $_GET['rows'];
    $sidx = $_GET['sidx'];
    $sord = $_GET['sord'];
    if (!$sidx)
        $sidx = 1;

    
    if($limit==""){
        $limit=10;
    }
    $sql = "select noaplikasi,namadebitur,no_rekg_pinjaman,produk,tgl_pk,no_bpkb,
        no_pengikatan,no_polis_ass_jiwa,no_polis_ass_kerugian,tgl_update,no_trail  
        from debitur_trail where :whereInput: and userupdate='$npp' and lnc='$lnc' and
        tgl_update>'" . balikTgl($tgl1) . "' and tgl_update<'" . balikTgl($tgl2) . "'
        ";
   

    if ($submn == "input") {
        $sql = str_replace(":whereInput:", "no_trail=1", $sql);
    } else {
        $sql = str_replace(":whereInput:", "no_trail<>1", $sql);
    }
    if(isset($_GET['searchValue']) && trim($_GET['searchValue'])!="" ){
        $sql.=" and ".$_GET['searchBy']." like '%".$_GET['searchValue']."%' ";
    }
    
    $sqlCount = "select count(*) from ($sql) test";
    $count = $db_function->selectOnefield($sqlCount);

    if ($count > 0 && $limit > 0) {
        $total_pages = ceil($count / $limit);
    } else {
        $total_pages = 0;
    }
    if ($page > $total_pages)
        $page = $total_pages;
    $start = $limit * $page - $limit;
    if ($start < 0)
        $start = 0;

    $sqlDt = $sql . " LIMIT $start , $limit";


    $query = $db_function->selectAllRows($sqlDt);
   
    $responce['page'] = $page; 
    $responce['total'] = $total_pages; 
    $responce['records']= $count;
    $i=0;
    foreach($query as $row){
        $responce['rows'][$i]['id']=$i; 
        $responce['rows'][$i]['cell']=array(        
            'noaplikasi'=>$row['noaplikasi'],
            'namadebitur'=>$row['namadebitur'],
            'no_rekg_pinjaman'=>$row['no_rekg_pinjaman'],
            'produk'=>$row['produk'],
            'tgl_pk'=>$row['tgl_pk'],
            'no_bpkb'=>$row['no_bpkb'],
            'no_pengikatan'=>$row['no_pengikatan'],
            'no_polis_ass_jiwa'=>$row['no_polis_ass_jiwa'],
            'no_polis_ass_kerugian'=>$row['no_polis_ass_kerugian'],  
            'tgl_update'=>balikTglDate($row['tgl_update']),
            'no_trail'=>$row['no_trail']
        );
        $i++;
        
    }
    echo json_encode($responce);
    exit;
}

function getlistProgram($produk) {
    $db_function = new db_function();

    $ListProgram = array();
    $buf = $db_function->selectAllRows(
            "select b.program_nm from  master_produk a join master_program b on a.produk_kd=b.produk_kd
        where a.produk_nm='" . $produk . "' order by b.program_nm");
    foreach ($buf as $row) {
        $ListProgram[] = $row['program_nm'];
    }
    return $ListProgram;
}

function json_nomor_aplikasi() {
    $db_function = new db_function();
    $dataprint = array('status' => 'gagal');
    $noaplikasi = $_GET['noaplikasi'];
    if (strlen($noaplikasi) == 20) {
        $buf['tgl'] = substr($noaplikasi, 0, 8);
        $buf['program_kd'] = substr($noaplikasi, 8, 2);
        $buf['cab_kd'] = substr($noaplikasi, 10, 5);

        $program_kd = $buf['program_kd'];
        $cab_kd = $buf['cab_kd'];
        $inputdate = substr($buf['tgl'], 0, 2) . "-" . substr($buf['tgl'], 2, 2) . "-" . substr($buf['tgl'], 4, 4);
        $lnc = cleanstr($db_function->selectOnefield("select singkatan from master_cab where cab_kd='" . $buf['cab_kd'] . "'"));

        $buf = $db_function->selectOneRows(
                "select prog.program_nm,prod.produk_kd,prod.produk_nm from master_program prog 
                    left join master_produk  prod on prog.produk_kd=prod.produk_kd
                    where prog.program_kd='" . $buf['program_kd'] . "'
                    ");
        $produk_kd = "";
        $program = "";
        $produk = "";
        if (!empty($buf)) {

            $produk = $buf['produk_nm'];
            $program = $buf['program_nm'];
            $produk_kd = $buf['produk_kd'];
        }
        $ListProgram = getlistProgram($produk);

        if ($produk != "") {
            $dataprint = array(
                'status' => 'sukses',
                'listProgram' => $ListProgram,
                'field' => array(
                    'produk' => $produk,
                    'program' => $program,
                    'inputdate' => $inputdate,
                    'lnc' => $lnc
                )
            );
        }
    }

    echo json_encode($dataprint);
    exit;
}

function json_sumDet() {
    $db_function = new db_function();
    $tgl = $_GET['tgl'];
    $lnc = $_GET['lnc'];
    $jns = $_GET['jns'];

    $page = $_GET['page'];
    $limit = $_GET['rows'];
    $sidx = $_GET['sidx'];
    $sord = $_GET['sord'];
    
    if($limit==""){
        $limit=10;
    }
    $tgl_update = $tgl . " 23:59:59";
    $sql = "select trail.noaplikasi,trail.namadebitur,trail.no_rekg_pinjaman,trail.produk,trail.tgl_pk,trail.no_bpkb,
        trail.no_pengikatan,trail.no_polis_ass_jiwa,trail.no_polis_ass_kerugian,trail.tgl_update,trail.no_trail 
        from debitur_trail trail 
            join (select max(tgl_update) tgl_update,no_rekg_pinjaman from debitur_trail where tgl_update <= '$tgl_update' group by no_rekg_pinjaman) bb
            on trail.no_rekg_pinjaman=bb.no_rekg_pinjaman and trail.tgl_update=bb.tgl_update
            where lnc='$lnc' and :paramwhere: ";

   
    if ($jns == "status_rekg") {
        $sql = str_replace(":paramwhere:", "trail.status_rekg='AKTIF' ", $sql);
    }
    else{
        $sql = str_replace(":paramwhere:", "trail.$jns='PENDING' ", $sql);
    }
    
    if(isset($_GET['searchValue']) && trim($_GET['searchValue'])!="" ){
        $sql.=" and trail.".$_GET['searchBy']." like '%".$_GET['searchValue']."%' ";
    }
    
    $sqlCount = "select count(*) from ($sql) test";
    
  
    $count = $db_function->selectOnefield($sqlCount);

    if ($count > 0 && $limit > 0) {
        $total_pages = ceil($count / $limit);
    } else {
        $total_pages = 0;
    }
    if ($page > $total_pages)
        $page = $total_pages;
    $start = $limit * $page - $limit;
    if ($start < 0)
        $start = 0;

    $sqlDt = "select * from ($sql)temp LIMIT $start , $limit";
    
    $query = $db_function->selectAllRows($sqlDt);
   
    $responce['page'] = $page; 
    $responce['total'] = $total_pages; 
    $responce['records']= $count;
    $i=0;
    foreach($query as $row){
        $responce['rows'][$i]['id']=$i; 
        $responce['rows'][$i]['cell']=$row;
        $i++;
        
    }
    echo json_encode($responce);

    exit;
}
function json_sumDetCair() {
    $db_function = new db_function();
    
    $lnc = $_GET['lnc'];
    $jns = $_GET['jns'];

    $page = $_GET['page'];
    $limit = $_GET['rows'];
    $sidx = $_GET['sidx'];
    $sord = $_GET['sord'];
    
    if($limit==""){
        $limit=10;
    }
    $tgl_update = $tgl . " 23:59:59";
    $sql = "select trail.noaplikasi,trail.namadebitur,trail.no_rekg_pinjaman,trail.tgl_pk".
           ",tgl_cair_tahap_fondasi,tgl_cair_tahap_topping,tgl_cair_tahap_bast,tgl_cair_tahap_dok from debitur trail ".
           "where lnc='$lnc' and skim_pencairan='PARTIAL DROW DOWN' and  skim_pks in('KAVLING BANGUN','INDENT') ".
           "";

   if(isset($_GET['searchValue']) && trim($_GET['searchValue'])!="" ){
        $sql.=" and ".$_GET['searchBy']." like '%".$_GET['searchValue']."%' ";
    }
    
   switch ($jns){
       case "debitur";
           $sql.="and progress <> ''";
       break;
       
       case "pondasi";
           $sql.="and progress='BELUM SELESAI' and tgl_cair_tahap_fondasi  in(null,'','0000-00-00')";
       break;
       
       case "topping";
           $sql.="and progress='BELUM SELESAI' and tgl_cair_tahap_fondasi >'0000-00-00' and tgl_cair_tahap_topping in(null,'','0000-00-00')";
       break;
   
       case "bast";
           $sql.="and progress='BELUM SELESAI' and tgl_cair_tahap_topping >'0000-00-00' and tgl_cair_tahap_bast in(null,'','0000-00-00')";
       break;
       
       case "dokumen";
            $sql.="and progress='BELUM SELESAI' and tgl_cair_tahap_bast >'0000-00-00' and tgl_cair_tahap_dok in(null,'','0000-00-00')";
       break;
       
       case "inprogress";
           $sql.="and progress='BELUM SELESAI'";
       break;
   
       case "selesai";
           $sql.="AND progress='SELESAI'";
       
       break;
       
   }
    $sqlCount = "select count(*) from ($sql) test";
    
  
    $count = $db_function->selectOnefield($sqlCount);

    if ($count > 0 && $limit > 0) {
        $total_pages = ceil($count / $limit);
    } else {
        $total_pages = 0;
    }
    if ($page > $total_pages)
        $page = $total_pages;
    $start = $limit * $page - $limit;
    if ($start < 0)
        $start = 0;

    $sqlDt = "select * from ($sql)temp LIMIT $start , $limit";
    
    $query = $db_function->selectAllRows($sqlDt);
   
    $responce['page'] = $page; 
    $responce['total'] = $total_pages; 
    $responce['records']= $count;
    $i=0;
    foreach($query as $row){
        
        $row['tgl_pk']=  balikTgl($row['tgl_pk']);
        $row['tgl_cair_tahap_fondasi']=  cleanDate(balikTgl($row['tgl_cair_tahap_fondasi']));
        $row['tgl_cair_tahap_topping']=  cleanDate(balikTgl($row['tgl_cair_tahap_topping']));
        $row['tgl_cair_tahap_bast']=  cleanDate(balikTgl($row['tgl_cair_tahap_bast']));
        $row['tgl_cair_tahap_dok']=  cleanDate(balikTgl($row['tgl_cair_tahap_dok']));
        $responce['rows'][$i]['id']=$i; 
        $responce['rows'][$i]['cell']=$row;
        $i++;
        
    }
    echo json_encode($responce);

    exit;
}

?>
