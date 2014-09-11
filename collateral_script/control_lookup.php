<?php
$db_function = new db_function();
/*
$listTypeLookup=array();
$rows=$db_function->selectAllRows("select distinct type from lookup order by type asc");
foreach($rows as  $row){
    $listTypeLookup[$row["type"]]=$row["type"];
}*/
$listTypeLookup=array("asuransi_jiwa"=>"Asuransi Jiwa","asuransi_kerugian"=>"Asuransi Kerugian",
    "daftar_kjpp"=>"Daftar Kjpp","developer"=>"Developer","jns_kendaraan"=>"Jenis Kendaraan",
    "merk_kendaraan"=>"Merek Kendaraan","notaris"=>"Notaris","kendala"=>"Kendala Pengikatan");
$listLookup="";
$action=$_GET['action']!=null?$_GET['action']:"Simpan";

if(!empty($_POST)){
    if($_POST['action']=="Batal"){
        header("location:col_lookup.php?type=".$_GET['type']);
    
    }
    elseif($_POST['action']=="Simpan"){
        $frm=$_POST['frm'];
        $sql="insert into lookup(type,value,lnc)values('".$frm['type']."','".$frm['value']."','".$frm['lnc']."')";
        
        $db_function->exec($sql);
        header("location:col_lookup.php?type=".$_GET['type']);
    }
    elseif($_POST['action']=="Edit"){
        $frm=$_POST['frm'];
        $db_function->exec("update lookup set type='".$frm['type']."',value='".$frm['value']."',lnc='".$frm['lnc']."' "
                . "where type='".$_GET['type']."' and value='".$_GET['value']."'");
        
        header("location:col_lookup.php?type=".$_GET['type']);
    }
}

if($action=="delete"){
    $db_function->exec("delete from lookup where type='".$_GET['type']."' and value='".$_GET['value']."'");
    header("location:col_lookup.php?type=".$_GET['type']);
    
}
elseif($action=="Edit"&& empty($_POST)){
    $_POST['frm']['value']=$_GET['value'];
    $_POST['frm']['lnc']=$db_function->selectOnefield("select lnc from lookup where type='".$_GET['type']."' and value='".$_GET['value']."'");
}


if($_GET['type']!=null){
    $_POST['frm']['type']=$_GET['type'];
    $sql="select * from lookup where type= '".$_GET['type']."' order by value asc";    
    $listLookup=$db_function->selectAllRows($sql);
}


?>