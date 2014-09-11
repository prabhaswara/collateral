<strong> <a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="cads_menu.htm">BSO MENU</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("bso", $con);

$lnc=$HTTP_POST_VARS['lnc'];
$no_aplikasi=$HTTP_POST_VARS['no_aplikasi'];
$nama=$HTTP_POST_VARS['nama_debitur'];
$today=date(Ymd);
//$nama_perumahan=$HTTP_POST_VARS['nama_perumahan'];

//$tgl=date(Y-m-d);
//$now=$_POST['action'];

$sql="INSERT INTO fraud (
tgl_input,
lnc,
no_aplikasi,
nama_debitur,
sales,
tempat_lahir,
tgl_lahir,
alamat,
no_telp,
no_hp,
max_kredit,
permasalahan,
file,
tgl_update)

VALUES
(
'$today',
'$_POST[lnc]',
'$_POST[no_aplikasi]',
'$_POST[nama_debitur]',
'$_POST[sales]',
'$_POST[tempat_lahir]',
'$_POST[tgl_lahir]',
'$_POST[alamat]',
'$_POST[no_telp]',
'$_POST[no_hp]',
'$_POST[max_kredit]',
'$_POST[permasalahan]',
'$_POST[file]',
'$_POST[tgl_update]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("<BLINK><RED>PENAMBAHAN DATA FADS APLIKASI BERHASIL ....!!!</BLINK></RED><br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NO. APLIKASI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$no_aplikasi<br>");
Echo ("NAMA DEBITUR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$nama<br>");

mysql_close($con)
?>