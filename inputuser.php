<center><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="3.5">
<?php
Include ("koneksi.php");
mysql_select_db("collateral_db");
$npp=$HTTP_POST_VARS['NPP'];
$password=$HTTP_POST_VARS['PASSWORD'];
$nama=$HTTP_POST_VARS['NAMA'];
$jabatan=$HTTP_POST_VARS['JABATAN'];
$cabang=$HTTP_POST_VARS['CABANG'];

$perintah="INSERT INTO pegawai (NPP,PASSWORD,NAMA, JABATAN, CABANG) VALUES('$_POST[NPP]','$password','$nama', '$jabatan', '$cabang')";
$isi_data=mysql_query($perintah);
If (isset($isi_data))
{
Echo ("Data anda telah terdaftar ke database :<BR><BR>");
Echo ("NPP         : $npp<br>");
Echo ("NAMA        : $nama<br><br>");

Echo("<a href=startlnc.html>MENU UTAMA</a><br><BR>");
Echo("<a href=input_data_user.htm>INPUT USER BARU</a><br>");
Echo("<br><a href=lihatuser.php>LIHAT USER</a><br>");

}
Else
{
Echo("pendaftaran gagal");
}
?>
