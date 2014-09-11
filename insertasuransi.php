<strong> <a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="cads_menu.htm">CADS MENU</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("collateral", $con);

$lnc=$HTTP_POST_VARS['lnc'];
$asuradur=$HTTP_POST_VARS['asuradur'];
$today=date(Ymd);
//$nama_perumahan=$HTTP_POST_VARS['nama_perumahan'];

//$tgl=date(Y-m-d);
//$now=$_POST['action'];

$sql="INSERT INTO asuransi (



tgl_input,
lnc,
asuradur,
jenis_asuransi,
nama_tempat,
nama_jalan,
nama_kecamatan,
kota,
kode_pos
)

VALUES
('$today',
'$_POST[lnc]',
'$_POST[asuradur]',
'$_POST[jenis_asuransi]',
'$_POST[nama_tempat]',
'$_POST[nama_jalan]',
'$_POST[nama_kecamatan]',
'$_POST[kota]',
'$_POST[kode_pos]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("Penambahan data asuransi berhasil ....!!!<br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NAMA ASURANSI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$asuradur<br>");

mysql_close($con)
?>