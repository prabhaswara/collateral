<?php include 'collateral_script/session_head.php'; ?>
<TITLE> CARI & EDIT DEBITUR </TITLE>
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
<form method=get action=cari_debitur.php>
  <p class="style2">&nbsp;</p>
  <p class="style2">
    <input type=text name=cari size=50 VALUE="Ketik data yang dicari ..."
	  onFocus="if(this.value=='Ketik data yang dicari ...')
	  {this.value=''}" onBlur="if(this.value==''){this.value='Ketik data yang dicari ...'}" /> 
  </p>
  <p class="style2"> Kategori :  
  <p class="style2">
    <INPUT type=radio name=pilih value=NAMADEBITUR checked>
    Nama Debitur <BR>
    <INPUT type=radio name=pilih value=NOAPLIKASI>
    No. Aplikasi <BR>
    <INPUT type=radio name=pilih value=afiliasi>
    No. Rekg. Afiliasi <BR>
    <INPUT type=radio name=pilih value=no_rekg_pinjaman>
    No. Rekg. Pinjaman <BR>
    <INPUT type=radio name=pilih value=no_pk>
    No. PK <br>
    <INPUT type=radio name=pilih value=no_surat_tanah>
    No. Sertifikat <br>
    <INPUT type=radio name=pilih value=instansi>
    Nama Tempat Kerja/Usaha <BR>
    <INPUT type=radio name=pilih value=developer>
    Nama Developer
  <p class="style2"><input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">
  <?php
$oke=$_GET['oke'];
if ($oke=='Cari'){
Include ("koneksi.php");
mysql_select_db("collateral_db");

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


$tampil2    = "SELECT * FROM debitur WHERE $pilih LIKE '%$cari%'";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);

if ($jumlah > 0) {
echo "<p align='left'>Maaf, data yang anda cari tidak ada pada database !!!";
}
else{
echo "<p align='left'>Ditemukan <b>$jmldata</b> data debitur dengan kriteria cari : <b>$cari</b></p>";
}
//Langkah 2
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['pilih'];
$cari  =$_GET['cari'];

$tampil= mysql_query("SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' ORDER BY debitur.tgl_pk DESC LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);


if ($jumlah > 0) {

echo "<p class=style6><b>DAFTAR DEBITUR</b><BR><br><table cellpadding=4>
<tr>
<th font-size: 14px>NO.</th>
<th>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>TEMPAT KERJA</th>
<th>TGL PK</th>
<th>MAKSIMUM KREDIT</th>
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
$griya = number_format($r['maksimum_kredit'],0,',','.');

echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[instansi]</td>
<td align='center'>$r[tgl_pk]</td>
<td align='center'>$griya</td>

<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
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
}
?>
</div>
