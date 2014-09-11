<TITLE>CEK SALDO DEVELOPER</TITLE>
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
<p><span class="style1"><a href="summary.php">MENU UTAMA</a>&nbsp&nbsp&nbsp<a href="laporan.htm" class="style4">LAPORAN</a></span> <BR>
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
<form method=get action=cek_saldo_developer.php>
  <p class="style2">&nbsp;</p>
  <p class="style2">
    <input type=text name=cari size=50 VALUE="Ketik nama developer yang dicari ..."
	  onFocus="if(this.value=='Ketik nama developer yang dicari ...')
	  {this.value=''}" onBlur="if(this.value==''){this.value='Ketik nama developer yang dicari ...'}" /> 
  </p>
  <p class="style2"> <INPUT type=radio name=pilih value=developer checked>
  Nama Developer/Penjual  
  <p class="style2"><br>
    <input type=submit name=oke value=Cari>
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

$tampil=mysql_query("SELECT * FROM data WHERE data.produk='GRIYA' AND LNC='$lnc'  
                    ORDER BY data.progress ASC");
$jumlah= mysql_num_rows($tampil);

//ngitung jumlah 
$max    = "SELECT SUM(max_kredit) AS total_max FROM data WHERE LNC='$lnc' ";
$result = mysql_query($max) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx    = $t['total_max'];

$cair1  = "SELECT SUM(cair_1) AS total_max FROM data WHERE LNC='$lnc' ";
$result = mysql_query($cair1) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx1   = $t['total_max'];

$cair2  = "SELECT SUM(cair_2) AS total_max FROM data WHERE LNC='$lnc' ";
$result = mysql_query($cair2) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx2   = $t['total_max'];

$cair3  = "SELECT SUM(cair_3) AS total_max FROM data WHERE LNC='$lnc' ";
$result = mysql_query($cair3) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx3   = $t['total_max'];

$cair4  = "SELECT SUM(cair_4) AS total_max FROM data WHERE LNC='$lnc' ";
$result = mysql_query($cair4) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx4   = $t['total_max'];

$xy 	= ($xxx - $xxx1- $xxx2 - $xxx3 - $xxx4);
$xxxy   = number_format($xy,0,',','.');

//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2    = mysql_query("SELECT * FROM data WHERE data.produk LIKE 'GRIYA' AND lnc LIKE '$lnc'");
$jmldata    = mysql_num_rows($tampil2);
$jmlhalaman = ceil($jmldata/$batas);
$jmldata	= number_format($jmldata,0,',','.');

//Langkah 2
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['pilih'];
$cari  =$_GET['cari'];

$tampil= mysql_query("SELECT * FROM data WHERE $pilih LIKE '%$cari%' ORDER BY data.lnc ASC LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<b>DAFTAR DEBITUR</b><BR><br><table cellpadding=4>
<tr>
<th >NO.</th>
<th>NAMA LNC</th>
<th>NO. REK. PINJAMAN</th>
<th>NAMA DEBITUR</th>
<th>PENJUAL</th>
<th>PERUMAHAN</th>
<th>ESCROW</th>
<th>SALDO</th>
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
<td>$r[rekg_pinjaman]</td>
<td align='center'>$r[nama_debitur]</td>
<td align='center'>$r[developer]</td>
<td align='center'>$r[perumahan]</td>
<td align='center'>$r[escrow]</td>
<td align='center'>$xxxy </td>
<td align='center'><a href=edit_data_debitur.php?id=$r[rekg_pinjaman]>Edit
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
