<?php include 'collateral_script/session_head.php'; ?>
<TITLE>DUPLIKASI SERTIFIKAT</TITLE>
<?php include 'collateral_script/head.php'; ?> 
<div style="margin:0px 50px;text-align: left;">

<p align="center">
  <?php

echo "<br><align='center'><b>DAFTAR DUPLIKASI JAMINAN</b><BR><br><table class='tblLookup' border='1px'>
<thead>
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
<th>ACTION</th></th>
</tr></thead>";

$warna1 = "#DBDBA6";   // baris genap berwarna tua
$warna2 = "#F2F2DF";   // baris ganjil berwarna muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("collateral_db");
$shm=$HTTP_POST_VARS['no_surat_tanah'];
$jam =$HTTP_POST_VARS['jml_jaminan'];

//echo "<br>CARI DEBITUR<a href=cari_debitur.php>

//lANGKAH 1 : Tentukan batas, crk halaman $ posisi data
$batas   = 100;
$halaman = $_GET['halaman'];
if(empty($halaman)) {
   $posisi   = 0;
   $halaman  = 1;
}
else{
     $posisi = ($halaman-1) * $batas;   
}
$sql=mysql_query("SELECT * FROM debitur 
				  where debitur.jaminan='SATUAN' AND debitur.no_surat_tanah=debitur.no_surat_tanah AND debitur.jml_jaminan=debitur.jml_jaminan
				  AND debitur.jenis_surat_tanah=debitur.jenis_surat_tanah GROUP BY debitur.jaminan, debitur.no_surat_tanah, debitur.jml_jaminan HAVING COUNT(*) > 1 
				  LIMIT $posisi, $batas");

$no=1;
While ($r=mysql_fetch_array($sql)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}

Echo "
<tr bgcolor=$warna>
<td align='right'>$no</td>
<td align='center'>$r[LNC]</td>
<td align='center'>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[jaminan]</td>
<td align='center'>$r[no_surat_tanah]</td>
<td align='center'>$r[jml_jaminan]</td>

<td align='center'><a href=cari_duplikasi.php?id=$r[no_surat_tanah] OR id=$r[jml_jaminan]> Duplikasi 
</td>
</tr>";

      $no++;
}
echo "</table>";
//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2     = mysql_query("SELECT debitur.LNC, debitur.NOAPLIKASI, debitur.NAMADEBITUR, debitur.no_rekg_pinjaman, 
	              debitur.produk, debitur.jaminan, debitur.no_surat_tanah, debitur.jml_jaminan FROM debitur 
				  where debitur.jaminan='SATUAN' AND debitur.no_surat_tanah=debitur.no_surat_tanah AND debitur.jml_jaminan=debitur.jml_jaminan
				  AND debitur.jenis_surat_tanah=debitur.jenis_surat_tanah GROUP BY debitur.jaminan, debitur.no_surat_tanah, debitur.jml_jaminan HAVING COUNT(*) > 1 ");
$jmldata     = mysql_num_rows($tampil2);
$jmlhalaman  = ceil($jmldata/$batas);

//echo "<br>Halaman  : ";

for ($i=1;$i<=$jmlhalaman;$i++)
if  ($i !=$halaman){
  echo "<a href=$_SERVER[PHP_SELF]?halaman=$i>$i</A> | ";
}
else{
  echo "<b>$i</b> |";
}

if ($jmldata>0)
{
echo "<p>Total Duplikasi Debitur : <b>$jmldata</b> orang </p>";
}
else{
echo "<br><p class=style10 align='center'><font color='blue'><b><blink> Tidak terdapat data duplikasi sertifikat pada database !!!</b></p>";
}

?>
</p>