<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!empty($_SESSION['colateral'])){
    header('location:start.php');
}

$errorBox="";
$db_function = new db_function();

if(!empty($_POST)){
    $pesanError=array();
    $dataUser=$db_function->selectOneRows("select * from pegawai where npp='".$_POST['frm']['npp']."'");
    if(empty($dataUser)){
        array_push($pesanError, "Pegawai Tidak Terdaftar");
    }elseif($dataUser['PASSWORD']!=$_POST['frm']['password']){      
        array_push($pesanError, "Password salah");
    }else{
        $_SESSION['colateral']['npp']=$dataUser["NPP"];
        $_SESSION['colateral']['nama']=$dataUser["NAMA"];
        $_SESSION['colateral']['jabatan']=$dataUser["JABATAN"];
        $_SESSION['colateral']['cabang']=$dataUser["CABANG"];
        $_SESSION['colateral']['group']=$dataUser["group"];
        
        header('location:start.php');
    }
    
    
    $errorBox=showMessage($pesanError);


}

 

?>
