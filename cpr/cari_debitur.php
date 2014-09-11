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
<p><span class="style1"><a href="summary.php">MENU UTAMA</a>&nbsp&nbsp&nbsp<a href="laporan.htm" class="style4">OUTPUT</a></span> <BR>
  <BR>
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
    <input name=cari type=text class="style2"
	  onFocus="if(this.value=='Ketik data yang dicari ...')
	  {this.value=''}" onBlur="if(this.value==''){this.value='Ketik data yang dicari ...'}" VALUE="Ketik data yang dicari ..." size=50 /> 
  </p>
  <p class="style2"> Kategori :  
  <p class="style2">
    <INPUT type=radio name=pilih value=nama_debitur checked>
    Nama Debitur <BR>
    <INPUT type=radio name=pilih value=no_aplikasi>
    No. Aplikasi <BR>
    <INPUT type=radio name=pilih value=rekg_pinjaman>
    No. Rekg. Pinjaman <BR>
    <INPUT type=radio name=pilih value=developer>
    Nama Developer/Penjual<br>
    <INPUT type=radio name=pilih value=perumahan>
    Nama Perumahan<br>
    <INPUT type=radio name=pilih value=escrow>
    No. Rekg. Escrow 
  <p class="style2"><input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">
  <?php
$oke=$_GET['oke'];
if ($oke=='Cari'){
Include ("koneksi.php");
mysql_select_db("griya");

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

//Langkah 2
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['pilih'];
$cari  =$_GET['cari'];

$tampil2    = "SELECT * FROM data WHERE $pilih LIKE '%$cari%'";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);

if ($jumlah > 0) {
echo "<p align='left'>Maaf, data yang anda cari tidak ada pada database !!!";
}
else{
echo "<p align='left'>Ditemukan <b>$jmldata</b> data debitur dengan kriteria cari : <b>$cari</b></p>";
}

$tampil= mysql_query("SELECT * FROM data WHERE $pilih LIKE '%$cari%' ");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<b>DAFTAR DEBITUR</b><BR><br><table cellpadding=4>
<tr>
<th >NO.</th>
<th>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NO. REK. PINJAMAN</th>
<th>NAMA DEBITUR</th>
<th>PENJUAL</th>
<th>PERUMAHAN</th>
<th>ESCROW</th>
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
<td align='center'>$r[lnc]</td>
<td>$r[no_aplikasi]</td>
<td>$r[rekg_pinjaman]</td>
<td align='center'>$r[nama_debitur]</td>
<td align='center'>$r[developer]</td>
<td align='center'>$r[perumahan]</td>
<td align='center'>$r[escrow]</td>

<td align='center'><a href=edit_data_debitur.php?id=$r[rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
echo "</table>";

}
}
?>
</div>
