<TITLE>DAFTAR ASURADUR</TITLE>
<style type="text/css">
<!--
.style3 {
	font-size: 12px;
	font-weight: bold;
}
.style4 {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
body,td,th {
	font-size: 14px;
}
-->
</style>
<p><span class="style4"><a href="summary.php" class="style4">MENU UTAMA </a>&nbsp&nbsp&nbsp<a href="menu_laporan.htm" class="style4">REPORTING</a></span><BR>
  <BR>
</p>
<div align="center">
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
.style3 {font-size: 10px}
  </style>
  
  
<?php

$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("collateral_db");

//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2     = mysql_query("SELECT * FROM asuransi");
$jmldata     = mysql_num_rows($tampil2);
echo "<p align='left'>Total data rekanan asuransi : <b>$jmldata</b> <BR>"; 
//echo "<br>CARI DEBITUR<a href=cari_debitur.php>
echo "<br><p align='center'><b>DAFTAR REKANAN ASURANSI</b></p><table cellpadding=4>
<tr>
<th>NO.</th>
<th>NAMA PERUSAHAAN</th>
<th>JENIS ASURANSI</th>
<th>ALAMAT</th>
</tr>";

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
$sql=mysql_query("SELECT * FROM asuransi ORDER BY asuransi.jenis_asuransi DESC LIMIT $posisi, $batas");

$no=$posisi+1;
While ($r=mysql_fetch_array($sql)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}
Echo "
<tr bgcolor=$warna>
<td align='center'>$no</td>
<td align='center'>$r[asuradur]</td>
<td align='center'>$r[jenis_asuransi]</td>
<td align='center'>$r[nama_jalan] $r[nama_kecamatan] $r[kota]</td>
</tr>";

      $no++;
}
echo "</table>";

//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2     = mysql_query("SELECT * FROM asuransi");
$jmldata     = mysql_num_rows($tampil2);
$jmlhalaman  = ceil($jmldata/$batas);
$file        = "lihat_asuransi.php";

//Link ke halaman sebelumnya (previous)
if ($halaman>1){
    $previous = $halaman-1;
	echo "<A HREF=$file?halaman=1> << First </A> |
	      <A HREF=$file?halaman=$previous> < Previous </A> | ";
}
else{
     echo "<< First | < Previous | "; }

//Tampilkan link halaman 1,2,3,...
for ($i=1;$i<=$jmlhalaman;$i++)
if  ($i !=$halaman){
  echo "<a href=$file?halaman=$i>$i</A> | ";}
else{
  echo "<b>$i</b> | ";}
//Link ke halaman berikutnya (Next)
if ($halaman < $jmlhalaman){
    $next = $halaman+1;
	echo "<A HREF=$file?halaman=$next> Next > </A> |
	      <A HREF=$file?halaman=$jmlhalaman> Previous >> </A> | ";
}
else{
     echo "Next > | Last >>";}

?>
</div>
