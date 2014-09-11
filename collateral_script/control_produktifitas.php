<?php

if (empty($_GET["submn"])) {
    header("location:col_produktifitas.php?submn=input");
    exit;
}

$cssTabActive = "ui-tabs-active ui-state-active";

$cssInput = $cssTabActive;
$cssEdit = "";

$submn = $_GET['submn'];

if ($submn == "input") {
    $cssInput = $cssTabActive;
    $cssEdit = "";
} else {
    $cssEdit = $cssTabActive;
    $cssInput = "";
}

$db_function = new db_function();

$dataTBL = array();
$listLNC = array();
$listLNC[''] = "semua";

$data = $db_function->selectAllRows("select singkatan from master_cab order by singkatan asc");
foreach ($data as $row) {
    $listLNC[$row["singkatan"]] = $row["singkatan"];
}


if (!empty($_POST)) {
    $tgl1 = balikTgl($_POST['frm']['tgl1']);
    $tgl2 = balikTgl($_POST['frm']['tgl2']);
    $sql = "select lnc,npp,nama,jml from pegawai right join
            (select lnc,userupdate,count(no_rekg_pinjaman) jml from debitur_trail 
            where 1=1 :whereLNC: and :whereInput: and tgl_update>'$tgl1' and tgl_update<'$tgl2 23:59:59'
            group by userupdate,lnc) sumjml on pegawai.npp=sumjml.userupdate order by lnc,npp";

   
    if($_POST['frm']['lnc']==""){
        $sql=str_replace(":whereLNC:", "", $sql);
    }else{
       
        $sql=str_replace(":whereLNC:", "and lnc='".$_POST['frm']['lnc']."'", $sql);
    }
    
    if($submn=="input"){
        $sql=str_replace(":whereInput:", "no_trail=1", $sql);
    }else{
        $sql=str_replace(":whereInput:", "no_trail<>1", $sql);
    }
   
    $dataTBL = $db_function->selectAllRows($sql);
    
    
}
?>