<strong> <a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="laporan.htm">OUTPUT</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("griya", $con);

$lnc=$HTTP_POST_VARS['lnc'];
$no_aplikasi=$HTTP_POST_VARS['no_aplikasi'];
$nama=$HTTP_POST_VARS['nama_debitur'];
$today=date(Ymd);

$nilai=str_replace(".","",$_POST['max_kredit']);
$cair1=str_replace(".","",$_POST['cair_1']);
$cair2=str_replace(".","",$_POST['cair_2']);
$cair3=str_replace(".","",$_POST['cair_3']);
$cair4=str_replace(".","",$_POST['cair_4']);

$sql="INSERT INTO data (


tgl_input,
lnc,
produk,
jenis,
no_aplikasi,
rekg_pinjaman,
nama_debitur,
max_kredit,
tenor,
tgl_pk,
developer,
badan,
perumahan,
proyek,
skim,
pks,
escrow,
cair_1,
keterangan1,
tgl_cair_1,
cair_2,
keterangan2,
tgl_cair_2,
cair_3,
keterangan3,
tgl_cair_3,
cair_4,
keterangan4,
tgl_cair_4,
keterangan,
progress,
unit,
transaksi,
pengikatan,
outstanding,
jaminan,
bangunan,
induk,
kategori)

VALUES
(
'$today',
'$_POST[lnc]',
'$_POST[produk]',
'$_POST[jenis]',
'$_POST[no_aplikasi]',
'$_POST[rekg_pinjaman]',
'$_POST[nama_debitur]',
'$nilai',
'$_POST[tenor]',
'$_POST[tgl_pk]',
'$_POST[developer]',
'$_POST[badan]',
'$_POST[perumahan]',
'$_POST[proyek]',
'$_POST[skim]',
'$_POST[pks]',
'$_POST[escrow]',
'$cair1',
'$_POST[keterangan1]',
'$_POST[tgl_cair_1]',
'$cair2',
'$_POST[keterangan2]',
'$_POST[tgl_cair_2]',
'$cair3',
'$_POST[keterangan3]',
'$_POST[tgl_cair_3]',
'$cair4',
'$_POST[keterangan4]',
'$_POST[tgl_cair_4]',
'$_POST[keterangan]',
'$_POST[progress]',
'$_POST[unit]',
'$_POST[transaksi]',
'$_POST[pengikatan]',
'$_POST[outstanding]',
'$_POST[jaminan]',
'$_POST[bangunan]',
'$_POST[induk]',
'$_POST[kategori]')";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo ("<BLINK><RED>PENAMBAHAN DATA DEBITUR BERHASIL ....!!!</BLINK></RED><br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NO. APLIKASI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$no_aplikasi<br>");
Echo ("NAMA DEBITUR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$nama<br>");

mysql_close($con)
?>