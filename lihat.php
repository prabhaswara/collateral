<TITLE> LIST DEBITUR </TITLE>

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

    
<?php

$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("collateral_db");

//echo "<br>CARI DEBITUR<a href=cari_debitur.php>
echo "<br>DAFTAR DEBITUR<BR><br><table cellpadding=4>
<tr>
<th>NO.</th>
<th>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>ACTION</th></th>
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
$sql=mysql_query("SELECT * FROM debitur LIMIT $posisi, $batas");

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
<td>$no</td>
<td>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td>$r[no_rekg_pinjaman]</td>
<td>$r[produk]</td>

<td><a href=edit_data_debitur.php?id=$r[NOAPLIKASI]>&nbsp&nbsp&nbsp&nbspEdit&nbsp&nbsp&nbsp&nbsp
</td>
</tr>";

      $no++;
}
echo "</table>";
//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2     = mysql_query("SELECT * FROM debitur");
$jmldata     = mysql_num_rows($tampil2);
$jmlhalaman  = ceil($jmldata/$batas);

echo "<br>Halaman  : ";

for ($i=1;$i<=$jmlhalaman;$i++)
if  ($i !=$halaman){
  echo "<a href=$_SERVER[PHP_SELF]?halaman=$i>$i</A> | ";
}
else{
  echo "<b>$i</b> |";
}
echo "<p>Total Debitur : <b>$jmldata</b> orang </p>";
?>