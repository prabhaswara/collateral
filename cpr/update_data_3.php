<?php
$today=date('Y-m-d H:i:s', time()+60*60*-1);

$nilai=str_replace(".","",$_POST['max_kredit']);
$cair1=str_replace(".","",$_POST['cair_1']);
$cair2=str_replace(".","",$_POST['cair_2']);
$cair3=str_replace(".","",$_POST['cair_3']);
$cair4=str_replace(".","",$_POST['cair_4']);

$lnc			= $_POST['lnc'];
$produk			= $_POST['produk'];
$jenis			= $_POST['jenis'];
$no_aplikasi	= $_POST['no_aplikasi'];
$rekg_pinjaman	= $_POST['rekg_pinjaman'];
$nama_debitur	= $_POST['nama_debitur'];
$max_kredit		= $_POST['max_kredit'];
$tenor		 	= $_POST['tenor'];
$tgl_pk			= $_POST['tgl_pk'];

$developer		= $_POST['developer'];
$badan			= $_POST['badan'];
$perumahan		= $_POST['perumahan'];
$proyek			= $_POST['proyek'];
$skim			= $_POST['skim'];
$pks			= $_POST['pks'];

$escrow			= $_POST['escrow'];
$cair_1			= $_POST['cair_1'];
$keterangan1	= $_POST['keterangan1'];
$tgl_cair_1		= $_POST['tgl_cair_1'];
$cair_2			= $_POST['cair_2'];
$keterangan2	= $_POST['keterangan2'];
$tgl_cair_2		= $_POST['tgl_cair_2'];
$cair_3			= $_POST['cair_3'];
$keterangan3	= $_POST['keterangan3'];
$tgl_cair_3		= $_POST['tgl_cair_3'];
$cair_4			= $_POST['cair_4'];
$keterangan4	= $_POST['keterangan4'];
$tgl_cair_4		= $_POST['tgl_cair_4'];

$tgl_3			= $_POST['tgl_3'];
$keterangan		= $_POST['keterangan'];
$progress		= $_POST['progress'];
$cek_3			= $_POST['cek_3'];
$keterangan_bso_3	= $_POST['keterangan_bso_3'];

Include ("koneksi.php");
mysql_select_db("griya");

$ubah="UPDATE data SET 
lnc='$lnc',
produk='$produk',
jenis='$jenis',
no_aplikasi='$no_aplikasi',
rekg_pinjaman= '$rekg_pinjaman',
nama_debitur= '$nama_debitur', 
max_kredit='$nilai', 
tenor='$tenor', 
tgl_pk='$tgl_pk', 
developer= '$developer', 
badan= '$badan', 
perumahan='$perumahan',
proyek= '$proyek',
skim= '$skim',
pks= '$pks',    
escrow='$escrow', 

cair_1='$cair1', 
keterangan1= '$keterangan1', 
tgl_cair_1='$tgl_cair_1', 
cair_2='$cair2', 
keterangan2= '$keterangan2', 
tgl_cair_2='$tgl_cair_2', 
cair_3='$cair3',
keterangan3= '$keterangan3',  
tgl_cair_3='$tgl_cair_3', 
cair_4='$cair4', 
keterangan4= '$keterangan4', 
tgl_cair_4='$tgl_cair_4', 
tgl_3='$today',
keterangan='$keterangan', 
progress='$progress',
cek_3='$cek_3',
keterangan_bso_3='$keterangan_bso_3' 

WHERE rekg_pinjaman='$_POST[id]'"; 

$hsl=mysql_query ($ubah);

echo ("<br><a href=summary_bso.php><b>MENU UTAMA</a>&nbsp&nbsp&nbsp<a href=laporan_bso.htm>ACTION</a></b><br><br><br><br>");
if ($hsl) echo ("<p><b>Proses Update Data Sukses !!! </b></p>");
else echo ("<p><b>Update Data Gagal !!! </b></p>");
?>