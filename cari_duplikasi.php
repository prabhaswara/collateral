<?php include 'collateral_script/session_head.php'; ?>
<TITLE>CARI DUPLIKASI</TITLE>
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
<p>
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
//$oke=$_GET['oke'];
//if ($oke=='Cari'){
Include ("koneksi.php");
mysql_select_db("collateral_db");

$bbb =$_GET['jml_jaminan'];

//Langkah 1
$batas   = 99999;
$halaman = $_GET['halaman'];
if(empty($halaman)){
  $posisi  = 0;
  $halaman = 1;
}
else{
  $posisi=($halaman-1)* $batas;}

$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda
$warna  = $warna1;     // warna default


$tampil2    = "SELECT * FROM debitur WHERE debitur.no_surat_tanah='$id' AND debitur.jaminan='SATUAN'";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);

if ($jumlah > 0) {
echo "<p align='left'>Maaf, data yang anda cari tidak ada pada database !!!";
}
else{
echo "<p align='left'>Terdapat <b>$jmldata</b> data debitur</p>";
}
//Langkah 2
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['no_surat_tanah'];
$cari  =$_GET['cari'];
$bbb =$_GET['jml_jaminan'];

$tampil= mysql_query("SELECT * FROM debitur WHERE debitur.no_surat_tanah LIKE '$id' AND debitur.jaminan='SATUAN' ");
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
<th>ACTION</th></th>
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

<td align='center'><a href=edit_data_debitur.php?id=$r[NOAPLIKASI]>Edit
</td>
</tr>";
      $no++;
}
echo "</table>";

//Langkah 3

//Link ke halaman sebelumnya (previous)
//if ($halaman>1){
//    $previous = $halaman-1;
//	echo "<A HREF=$file?halaman=1> << First </A> |
//	      <A HREF=$file?halaman=$previous> < Previous </A> | ";
//}
//else{
//     echo "<< First | < Previous | "; }

//Tampilkan link halaman 1,2,3,...
//for ($i=1;$i<=$jmlhalaman;$i++)
//if  ($i !=$halaman){
//  echo "<a href=$file?halaman=$i>$i</A> | ";}
//else{
//  echo "<b>$i</b> | ";}
//Link ke halaman berikutnya (Next)
//if ($halaman < $jmlhalaman){
//    $next = $halaman+1;
//	echo "<A HREF=$file?halaman=$next> Next > </A> |
//	      <A HREF=$file?halaman=$jmlhalaman> Previous >> </A> | ";
//}
//else{
//     echo "Next > | Last >>";}
}

?>
</div>
