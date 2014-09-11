<strong> <a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="cads_menu.htm">BSO MENU</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("bso", $con);

$lnc=$HTTP_POST_VARS['lnc'];
$nama=$HTTP_POST_VARS['nama_debitur'];
$rekening=$HTTP_POST_VARS['no_rekg'];
$today=date(Ymd);
//$tgl=date(Y-m-d);
//$now=$_POST['action'];

$sql="INSERT INTO bdo (


tgl_input,
lnc,
nama_debitur,
no_rekg,
golongan,
persetujuan,
hp,
tgk_hp,
tgk_bunga,
tgk_denda,
tgk_biaya,
outs,
ht,
ada_ht,
voucher,
tgl_buku,
selisih,
testkey,
status,
keterangan,
tgl_update
)

VALUES
(
'$today',
'$_POST[lnc]', 
'$_POST[nama_debitur]',
'$_POST[no_rekg]',
'$_POST[golongan]',
'$_POST[persetujuan]',
'$_POST[hp]',
'$_POST[tgk_hp]',
'$_POST[tgk_bunga]',
'$_POST[tgk_denda]',
'$_POST[tgk_biaya]',
'$_POST[outs]',
'$_POST[ht]',
'$_POST[ada_ht]',
'$_POST[voucher]',
'$_POST[tgl_buku]',
'$_POST[selisih]',
'$_POST[testkey]',
'$_POST[status]',
'$_POST[keterangan]',
'$_POST[tgl_update]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("<BLINK>PENAMBAHAN DATA REVIEW BDO ....!!!</BLINK><br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NAMA DEBITUR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$nama<br>");
Echo ("NO. REKENING&nbsp;&nbsp;&nbsp;: &nbsp;$rekening<br><br><br><br>");


mysql_close($con)
?>