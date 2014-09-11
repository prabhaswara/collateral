<strong> <a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="cads_menu.htm">BSO MENU</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("bso", $con);

$lnc=$HTTP_POST_VARS['lnc'];
$bulan=$HTTP_POST_VARS['bulan'];
$tahun=$HTTP_POST_VARS['tahun'];
$today=date(Ymd);
//$tgl=date(Y-m-d);
//$now=$_POST['action'];

$sql="INSERT INTO collateral (



tgl_input,
lnc,
bulan,
tahun,
bpkb,
ajb,
sht,
ass_jw,
ass_kerugian
)

VALUES
(
'$today',
'$_POST[lnc]',
'$_POST[bulan]',
'$_POST[tahun]',
'$_POST[bpkb]',
'$_POST[ajb]',
'$_POST[sht]',
'$_POST[ass_jiwa]',
'$_POST[ass_kerugian]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("<BLINK>PENAMBAHAN DATA COLLATERAL PERIODE $bulan $tahun BERHASIL ....!!!</BLINK><br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");


mysql_close($con)
?>