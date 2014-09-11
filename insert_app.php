<strong> <a href="summary_app.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp; <a href="menu_appraisal.htm">MENU APPRAISAL</a></strong><br><br><br>

<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif} 
body,td,th {
	font-size: 14px;
}
-->
</style>
  <style type="text/css">
table { 
   border: 1px solid #000000;
}
th {
   background-color : #FF9900;
   color            : #FFFFFF;
}
tr:hover{
   background-color : #CCCCCC;
}
  </style>
</p>
<form method=get action=cari_duplikasi.php>
    
<div align="center">
<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("collateral", $con);

$lnc=$HTTP_POST_VARS['LNC'];
$noaplikasi=$HTTP_POST_VARS['NOAPLIKASI'];
$namadebitur=$HTTP_POST_VARS['NAMADEBITUR'];
$shm=$HTTP_POST_VARS['no_surat_tanah'];
$jam =$HTTP_POST_VARS['jml_jaminan'];
$today=date(Ymd);
//$tgl=date(Y-m-d);
//$now=$_POST['action'];
$nilai=str_replace(".","",$_POST['plafond_dimohon']);
$abc1=str_replace(".","",$_POST['harga_tanah']);
$abc2=str_replace(".","",$_POST['harga_bangunan']);
$abc3=str_replace(".","",$_POST['harga_tanah_imb']);
$abc4=str_replace(".","",$_POST['harga_bangunan_imb']);


$cekdata="select NOAPLIKASI, NAMADEBITUR, no_surat_tanah, jaminan, jml_jaminan from debitur where jaminan='SATUAN' AND no_surat_tanah='$shm' AND jml_jaminan='$jam'";
$ada=mysql_query($cekdata) or die(mysql_error());

$x = mysql_query("SELECT * FROM debitur WHERE no_surat_tanah LIKE '%$shm%' AND jaminan='SATUAN'");
$y = mysql_num_rows($x);


if(mysql_num_rows($ada)>0)
{
$sql="INSERT INTO debitur (
action,
LNC,
NOAPLIKASI,
NAMADEBITUR,
TEMPATLAHIR,
TGLLAHIR,
CIF,
no_rekg_pinjaman,
afiliasi,
instansi,
produk,
maksimum_kredit,
no_pk,
tgl_pk,
jkw_kredit,
fixed_rate,
tgl_jt_pk,
tgl_jt_fixed_rate,
lokasi_dokumen_asli,
amplop_asli,
amplopasli,
lokasi_dokumen_copy,
amplop_copy,
amplopcopy,
jaminan,
jml_jaminan,
jenis_surat_tanah,
alamat_collateral,
luas_tanah,
tgl_jt_surat_tanah,
jenis_pengikatan,
nilai_ht,
jkw_covernote,
notaris,
appraisal,
no_ajb,
no_surat_tanah,
collateral_zipcode,
luas_bangunan,
nilai_taksasi,
harga_tanah,
harga_bangunan,
harga_tanah_imb,
harga_bangunan_imb,
no_pengikatan,
tgl_covernote,
tgl_jt_covernote,
developer,
skim_pks,
no_imb,
status_imb,
nama_perumahan,
asuransi_jiwa,
no_polis_ass_jiwa,
premi_jiwa,
nilai_pertanggungan_ass_jiwa,
tgl_ass_jiwa,
tgl_jt_ass_jiwa,
asuransi_kerugian,
no_polis_ass_kerugian,
premi_kerugian,
nilai_pertanggungan_ass_kerugian,
tgl_ass_kerugian,
tgl_jt_ass_kerugian,
jenis_kendaraan,
no_bpkb,
no_rangka,
nama_dealer,
merk,
no_mesin,
no_polisi,
status_rekg,
tgl_pelunasan,
memo,
skdr,
siup,
tdp,
others,
serah,
kendala,
tgl_update,
bunga,
program,
agama,
npwp, 
kelamin,
tgl_imb,
penilai,
tgl_taksasi,
tinggal,
cabang,
no_ktp,
ibu_kandung,
jabatan,
memo_appraisal,
plafond_dimohon,
nama_emergency,
telp_emergency,
alamat_kantor,
hubungan,
progress,
sales,
hp_sales,
kjpp,
status,
skim_pencairan)

VALUES
(
'$today',
'$_POST[LNC]',
'$_POST[NOAPLIKASI]',
'$_POST[NAMADEBITUR]',
'$_POST[TEMPATLAHIR]',
'$_POST[TGLLAHIR]',
'$_POST[CIF]',
'$_POST[no_rekg_pinjaman]',
'$_POST[afiliasi]',
'$_POST[instansi]',
'$_POST[produk]',
'$_POST[maksimum_kredit]',
'$_POST[no_pk]',
'$_POST[tgl_pk]',
'$_POST[jkw_kredit]',
'$_POST[fixed_rate]',
'$_POST[tgl_jt_pk]',
'$_POST[tgl_jt_fixed_rate]',
'$_POST[lokasi_dokumen_asli]',
'$_POST[amplop_asli]',
'$_POST[amplopasli]',
'$_POST[lokasi_dokumen_copy]',
'$_POST[amplop_copy]',
'$_POST[amplopcopy]',
'$_POST[jaminan]',
'$_POST[jml_jaminan]',
'$_POST[jenis_surat_tanah]',
'$_POST[alamat_collateral]',
'$_POST[luas_tanah]',
'$_POST[tgl_jt_surat_tanah]',
'$_POST[jenis_pengikatan]',
'$_POST[nilai_ht]',
'$_POST[jkw_covernote]',
'$_POST[notaris]',
'$_POST[appraisal]',
'$_POST[no_ajb]',
'$_POST[no_surat_tanah]',
'$_POST[collateral_zipcode]',
'$_POST[luas_bangunan]',
'$_POST[nilai_taksasi]',
'$abc1',
'$abc2',
'$abc3',
'$abc4',
'$_POST[no_pengikatan]',
'$_POST[tgl_covernote]',
'$_POST[tgl_jt_covernote]',
'$_POST[developer]',
'$_POST[skim_pks]',
'$_POST[no_imb]',
'$_POST[status_imb]',
'$_POST[nama_perumahan]',
'$_POST[asuransi_jiwa]',
'$_POST[no_polis_ass_jiwa]',
'$_POST[premi_jiwa]',
'$_POST[nilai_pertanggungan_ass_jiwa]',
'$_POST[tgl_ass_jiwa]',
'$_POST[tgl_jt_ass_jiwa]',
'$_POST[asuransi_kerugian]',
'$_POST[no_polis_ass_kerugian]',
'$_POST[premi_kerugian]',
'$_POST[nilai_pertanggungan_ass_kerugian]',
'$_POST[tgl_ass_kerugian]',
'$_POST[tgl_jt_ass_kerugian]',
'$_POST[jenis_kendaraan]',
'$_POST[no_bpkb]',
'$_POST[no_rangka]',
'$_POST[nama_dealer]',
'$_POST[merk]',
'$_POST[no_mesin]',
'$_POST[no_polisi]',
'$_POST[status_rekg]',
'$_POST[tgl_pelunasan]',
'$_POST[memo]',
'$_POST[skdr]',
'$_POST[siup]',
'$_POST[tdp]',
'$_POST[others]',
'$_POST[serah]',
'$_POST[kendala]',
'$_POST[tgl_update]',
'$_POST[bunga]',
'$_POST[program]',
'$_POST[agama]',
'$_POST[npwp]',
'$_POST[kelamin]',
'$_POST[tgl_imb]',
'$_POST[penilai]',
'$_POST[tgl_taksasi]',
'$_POST[tinggal]',
'$_POST[cabang]',
'$_POST[no_ktp]',
'$_POST[ibu_kandung]',
'$_POST[jabatan]',
'$_POST[memo_appraisal]',
'$nilai',
'$_POST[nama_emergency]',
'$_POST[telp_emergency]',
'$_POST[alamat_kantor]',
'$_POST[hubungan]',
'$_POST[progress]',
'$_POST[sales]',
'$_POST[hp_sales]',
'$_POST[kjpp]',
'$_POST[status]',
'$_POST[skim_pencairan]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("Penambahan data debitur berhasil ....!!!<br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NO. APLIKASI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$noaplikasi<br>");
Echo ("NAMA DEBITUR&nbsp;&nbsp;: &nbsp;$namadebitur<br><br><br><br>");


echo "<blink><font color='red'><h3>Duplikasi No. SHM & No. GS/SU !!! </h3></blink>";

$tampil= mysql_query("SELECT * FROM debitur WHERE debitur.no_surat_tanah = '$_POST[no_surat_tanah]' AND debitur.jaminan='SATUAN' AND debitur.jml_jaminan='$_POST[jml_jaminan]'");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<b>DAFTAR DEBITUR YANG TERINDIKASI DUPLIKASI SERTIFIKAT</b><BR><br><table cellpadding=4>
<tr>
<th>NO.</th>
<th>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>STATUS SERTIFIKAT</th>
<th>NO. SERTIFIKAT</th>
<th>NO. GS/SU</th>
</tr>";

$no=$posisi+1;
While ($r=mysql_fetch_array($tampil)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}

echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[jaminan]</td>
<td align='center'>$r[no_surat_tanah]</td>
<td align='center'>$r[jml_jaminan]</td>
</td>
</tr>";
      $no++;
}
echo "</table>";
}
}
else
{
$sql="INSERT INTO debitur (
action,
LNC,
NOAPLIKASI,
NAMADEBITUR,
TEMPATLAHIR,
TGLLAHIR,
CIF,
no_rekg_pinjaman,
afiliasi,
instansi,
produk,
maksimum_kredit,
no_pk,
tgl_pk,
jkw_kredit,
fixed_rate,
tgl_jt_pk,
tgl_jt_fixed_rate,
lokasi_dokumen_asli,
amplop_asli,
amplopasli,
lokasi_dokumen_copy,
amplop_copy,
amplopcopy,
jaminan,
jml_jaminan,
jenis_surat_tanah,
alamat_collateral,
luas_tanah,
tgl_jt_surat_tanah,
jenis_pengikatan,
nilai_ht,
jkw_covernote,
notaris,
appraisal,
no_ajb,
no_surat_tanah,
collateral_zipcode,
luas_bangunan,
nilai_taksasi,
harga_tanah,
harga_bangunan,
harga_tanah_imb,
harga_bangunan_imb,
no_pengikatan,
tgl_covernote,
tgl_jt_covernote,
developer,
skim_pks,
no_imb,
status_imb,
nama_perumahan,
asuransi_jiwa,
no_polis_ass_jiwa,
premi_jiwa,
nilai_pertanggungan_ass_jiwa,
tgl_ass_jiwa,
tgl_jt_ass_jiwa,
asuransi_kerugian,
no_polis_ass_kerugian,
premi_kerugian,
nilai_pertanggungan_ass_kerugian,
tgl_ass_kerugian,
tgl_jt_ass_kerugian,
jenis_kendaraan,
no_bpkb,
no_rangka,
nama_dealer,
merk,
no_mesin,
no_polisi,
status_rekg,
tgl_pelunasan,
memo,
skdr,
siup,
tdp,
others,
serah,
kendala,
tgl_update,
bunga,
program,
agama,
npwp, 
kelamin,
tgl_imb,
penilai,
tgl_taksasi,
tinggal,
cabang,
no_ktp,
ibu_kandung,
jabatan,
memo_appraisal,
plafond_dimohon,
nama_emergency,
telp_emergency,
alamat_kantor,
hubungan,
progress,
sales,
hp_sales,
kjpp,
status,
skim_pencairan)

VALUES
(
'$today',
'$_POST[LNC]',
'$_POST[NOAPLIKASI]',
'$_POST[NAMADEBITUR]',
'$_POST[TEMPATLAHIR]',
'$_POST[TGLLAHIR]',
'$_POST[CIF]',
'$_POST[no_rekg_pinjaman]',
'$_POST[afiliasi]',
'$_POST[instansi]',
'$_POST[produk]',
'$_POST[maksimum_kredit]',
'$_POST[no_pk]',
'$_POST[tgl_pk]',
'$_POST[jkw_kredit]',
'$_POST[fixed_rate]',
'$_POST[tgl_jt_pk]',
'$_POST[tgl_jt_fixed_rate]',
'$_POST[lokasi_dokumen_asli]',
'$_POST[amplop_asli]',
'$_POST[amplopasli]',
'$_POST[lokasi_dokumen_copy]',
'$_POST[amplop_copy]',
'$_POST[amplopcopy]',
'$_POST[jaminan]',
'$_POST[jml_jaminan]',
'$_POST[jenis_surat_tanah]',
'$_POST[alamat_collateral]',
'$_POST[luas_tanah]',
'$_POST[tgl_jt_surat_tanah]',
'$_POST[jenis_pengikatan]',
'$_POST[nilai_ht]',
'$_POST[jkw_covernote]',
'$_POST[notaris]',
'$_POST[appraisal]',
'$_POST[no_ajb]',
'$_POST[no_surat_tanah]',
'$_POST[collateral_zipcode]',
'$_POST[luas_bangunan]',
'$_POST[nilai_taksasi]',
'$abc1',
'$abc2',
'$abc3',
'$abc4',
'$_POST[no_pengikatan]',
'$_POST[tgl_covernote]',
'$_POST[tgl_jt_covernote]',
'$_POST[developer]',
'$_POST[skim_pks]',
'$_POST[no_imb]',
'$_POST[status_imb]',
'$_POST[nama_perumahan]',
'$_POST[asuransi_jiwa]',
'$_POST[no_polis_ass_jiwa]',
'$_POST[premi_jiwa]',
'$_POST[nilai_pertanggungan_ass_jiwa]',
'$_POST[tgl_ass_jiwa]',
'$_POST[tgl_jt_ass_jiwa]',
'$_POST[asuransi_kerugian]',
'$_POST[no_polis_ass_kerugian]',
'$_POST[premi_kerugian]',
'$_POST[nilai_pertanggungan_ass_kerugian]',
'$_POST[tgl_ass_kerugian]',
'$_POST[tgl_jt_ass_kerugian]',
'$_POST[jenis_kendaraan]',
'$_POST[no_bpkb]',
'$_POST[no_rangka]',
'$_POST[nama_dealer]',
'$_POST[merk]',
'$_POST[no_mesin]',
'$_POST[no_polisi]',
'$_POST[status_rekg]',
'$_POST[tgl_pelunasan]',
'$_POST[memo]',
'$_POST[skdr]',
'$_POST[siup]',
'$_POST[tdp]',
'$_POST[others]',
'$_POST[serah]',
'$_POST[kendala]',
'$_POST[tgl_update]',
'$_POST[bunga]',
'$_POST[program]',
'$_POST[agama]',
'$_POST[npwp]',
'$_POST[kelamin]',
'$_POST[tgl_imb]',
'$_POST[penilai]',
'$_POST[tgl_taksasi]',
'$_POST[tinggal]',
'$_POST[cabang]',
'$_POST[no_ktp]',
'$_POST[ibu_kandung]',
'$_POST[jabatan]',
'$_POST[memo_appraisal]',
'$nilai',
'$_POST[nama_emergency]',
'$_POST[telp_emergency]',
'$_POST[alamat_kantor]',
'$_POST[hubungan]',
'$_POST[progress]',
'$_POST[sales]',
'$_POST[hp_sales]',
'$_POST[kjpp]',
'$_POST[status]',
'$_POST[skim_pencairan]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

Echo ("Penambahan data debitur berhasil ....!!!<br><br>");
Echo ("NAMA LNC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$lnc<br>");
Echo ("NO. APLIKASI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;$noaplikasi<br>");
Echo ("NAMA DEBITUR&nbsp;&nbsp;: &nbsp;$namadebitur<br><br><br><br>");
}

mysql_close($con)
?>