<strong> <a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="cads_menu.htm">BSO MENU</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("bso", $con);

$lnc=$HTTP_POST_VARS['lnc'];
$developer=$HTTP_POST_VARS['developer'];
$perumahan=$HTTP_POST_VARS['perumahan'];
$today=date(Ymd);
//$tgl=date(Y-m-d);
//$now=$_POST['action'];

$sql="INSERT INTO developer (



tgl_input,
lnc,
developer,
perumahan,
unit,
no_pks,
no_buy_back,
tgl_pks,
escrow1,
escrow2,
skim,
validasi_pks,
jkw_pembangunan
)

VALUES
(
'$today',
'$_POST[lnc]',
'$_POST[developer]',
'$_POST[perumahan]',
'$_POST[unit]',
'$_POST[no_pks]',
'$_POST[no_buy_back]',
'$_POST[tgl_pks]',
'$_POST[escrow1]',
'$_POST[escrow2]',
'$_POST[skim]',
'$_POST[validasi_pks]',
'$_POST[jkw_pembangunan]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("<BLINK>PENAMBAHAN DATA DEVELOPER ....!!!</BLINK><br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NAMA DEVELOPER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$developer<br>");
Echo ("NAMA PERUMAHAN&nbsp;&nbsp;&nbsp;: &nbsp;$perumahan<br><br><br><br>");


mysql_close($con)
?>