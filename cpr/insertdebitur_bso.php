<strong> <a href="summary_bso.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="kpi_bso.htm">OUTPUT</a></strong><br><br><br>
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("bso", $con);

$lnc=$_POST['lnc'];
$no_aplikasi=$HTTP_POST_VARS['no_aplikasi'];
$nama=$_POST['nama'];
$today=date(Ymd);

$nilai=str_replace(".","",$_POST['max_kredit']);
$cair1=str_replace(".","",$_POST['cair_1']);
$cair2=str_replace(".","",$_POST['cair_2']);
$cair3=str_replace(".","",$_POST['cair_3']);
$cair4=str_replace(".","",$_POST['cair_4']);

$sql="INSERT INTO debitur (
tgl_input,
lnc,
no_aplikasi,
produk,
nama,
sales,
plafond,
tenor,
tgl_pk,
developer,
perumahan,
review_rc,
lokasi_jaminan,
lt,
harga_tanah,
lb,
harga_bangunan,
total_taksasi,
catatan_lnc,
lokasi_pembanding,
lt_pembanding,
harga_tanah_pembanding,
lb_pembanding,
harga_bangunan_pembanding,
total_harga_pembanding,
sumber_info,
review_taksasi,
saran,
cek_bso
)

VALUES
(
'$today',
'$_POST[lnc]',
'$_POST[no_aplikasi]',
'$_POST[produk]',
'$_POST[nama]',
'$_POST[sales]',
'$_POST[plafond]',
'$_POST[tenor]',
'$_POST[tgl_pk]',
'$_POST[developer]',
'$_POST[perumahan]',
'$_POST[review_rc]',

'$_POST[lokasi_jaminan]',
'$_POST[lt]',
'$_POST[harga_tanah]',
'$_POST[lb]',
'$_POST[harga_bangunan]',
'$_POST[total_taksasi]',
'$_POST[catatan_lnc]',
'$_POST[lokasi_pembanding]',
'$_POST[lt_pembanding]',
'$_POST[harga_tanah_pembanding]',
'$_POST[lb_pembanding]',
'$_POST[harga_bangunan_pembanding]',
'$_POST[total_harga_pembanding]',
'$_POST[sumber_info]',
'$_POST[review_taksasi]',
'$_POST[saran]',
'$_POST[cek_bso]')";


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