<?php 
//cek username dan password user dalam table users database
$koneksi = mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("collateral",$koneksi);

$username =$HTTP_POST_VARS['NPP'];

$password =$HTTP_POST_VARS['PASSWORD'];

$query =mysql_query("SELECT * FROM pegawai WHERE NPP='$username' AND PASSWORD='$password'");

$data_user =mysql_fetch_array($query);

if($data_user['NPP'] == $username and $data_user['PASSWORD'] == $password){

//men-set data sesi username dan password

session_register('NPP','PASSWORD');

header('location:start.php');

}else {

//penanganan error

$error ="";

if(empty($username) and empty($HTTP_POST_VARS['PASSWORD'])){

$error ="<b>NPP</b> dan <b>Password</b> kosong";

}else if(empty($username)){

$error ="<b>Username</b> kosong";

}else if(empty($HTTP_POST_VARS['PASSWORD'])){

$error ="<b>Password</b> kosong";

}else{

$error ="<b>Username</b> dan <b>Password</b> tidak sesuai";

}

echo "<h3>Login Gagal:</h3><p>$error. <br /><a href='login.php'>Kembali</a><p>";

}

?> 