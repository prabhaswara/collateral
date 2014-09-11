<strong> <a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="cads_menu.htm">CADS MENU</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("collateral", $con);

$lnc=$HTTP_POST_VARS['lnc'];
$notaris=$HTTP_POST_VARS['nama_notaris'];

//$tgl=date(Y-m-d);
//$now=$_POST['action'];
$today=date(Ymd);

$sql="INSERT INTO notaris (

tgl_input,
lnc,
nama_notaris,
no_pks,
tgl_pks,
tgl_jt_pks,
nama_tempat,
nama_jalan,
nama_kecamatan,
kota,
kode_pos)

VALUES
(
'$today',
'$_POST[lnc]',
'$_POST[nama_notaris]',
'$_POST[no_pks]',
'$_POST[tgl_pks]',
'$_POST[tgl_jt_pks]',
'$_POST[nama_tempat]',
'$_POST[nama_jalan]',
'$_POST[nama_kecamatan]',
'$_POST[kota]',
'$_POST[kode_pos]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("Penambahan data notaris berhasil ....!!!<br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NAMA NOTARIS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$notaris<br>");


mysql_close($con)
?>