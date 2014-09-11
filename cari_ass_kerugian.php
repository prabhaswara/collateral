<?php include 'collateral_script/session_head.php'; ?>
<TITLE>PENDING POLIS ASS. KERUGIAN</TITLE>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
body,td,th {
	font-size: 10px;
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
<form method=get action=cari_ass_kerugian.php>
  <p class="style1">&nbsp;</p>
  <p class="style1"><span class="style1">Nama LNC :
    <select size="1" name="LNC">
      <option>= SELECT =</option>
      <option>MDL</option>
      <option>PBL</option>
      <option>PLL</option>
      <option>BAL</option>
      <option>SML</option>
      <option>YGL</option>
      <option>SBL</option>
      <option>DPL</option>
      <option>BJL</option>
      <option>MKL</option>
      <option>MNL</option>
      <option>JKL</option>
              </select>
  </span> </p>
  <p class="style1">
    <input type=radio name=pilih value=asuransi_kerugian checked>
   Nama Perusahaan Asuransi Kerugian<br><input type=text name=cari size=50>
  </p>
  <p class="style2">
  
  <p class="style2">
    <input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">
  <?php
$oke=$_GET['oke'];
if ($oke=='Cari'){
Include ("koneksi.php");
mysql_select_db("collateral_db");

//Langkah 1
$batas   = 9999999;
$halaman = $_GET['halaman'];
if(empty($halaman)){
  $posisi  = 0;
  $halaman = 1;
}
else{
  $posisi=($halaman-1)* $batas;}

$warna1 = "#DBDBA6";   // baris genap berwarna tua
$warna2 = "#F2F2DF";   // baris ganjil berwarna muda
$warna  = $warna1;     // warna default

//Langkah 2
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['pilih'];
$cari  =$_GET['cari'];
$lnc=$_GET['LNC'];

$tampil= mysql_query("SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.no_polis_ass_kerugian = 'PENDING' AND debitur.LNC LIKE '%$lnc%' ORDER BY debitur.tgl_pk ASC LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<br><b>MONITORING PENYELESAIAN POLIS ASURANSI KERUGIAN</b><BR><br><table cellpadding=4>

<tr>
<th >NO.</th>
<th width=20>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=20>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>NILAI PERTANGGUNGAN</th>
<th>ASURANSI</th>
<th>PREMI</th>
<th>TGL. PK</th>
<th width=40>HARI PROSES</th>
<th width=65>STATUS</th>
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
//ngitung selisih tgl 
$tgl1=$r['tgl_pk'];
$tgl2=date('Y-m-d');
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal pertama
$pecah1 = explode("-", $tgl1);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal kedua
$pecah2 = explode("-", $tgl2);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 =  $pecah2[0];
// menghitung JDN dari masing-masing tanggal
$jd1 = GregorianToJD($month1, $date1, $year1);
$jd2 = GregorianToJD($month2, $date2, $year2);
// hitung selisih hari kedua tanggal
$selisih = $jd2 - $jd1;

$aaa = 30;
$bbb = $selisih > $aaa;

$ab  = "IN PROGRESS";
$count = "PENDING";

$max = $r['nilai_pertanggungan_ass_kerugian'];
$nht = $r['premi_kerugian'];
$rupiah=number_format($max,0,',','.');
$rupiah1=number_format($nht,0,',','.');
$slsh=number_format($selisih,0,',','.');

if ($bbb==1){
    $bbb=$count;
}
else{
  $bbb = $ab;
}

if ($bbb=='PENDING'){

echo "
<tr bgcolor=$warna>
<td><font color='red'>$no</td>
<td align='center'><font color='red'>$r[LNC]</td>
<td align='right'><font color='red'>$r[NOAPLIKASI]</td>
<td><font color='red'>$r[NAMADEBITUR]</td>
<td align='right'><font color='red'>$r[no_rekg_pinjaman]</td>
<td align='center'><font color='red'>$r[produk]</td>
<td align='right'><font color='red'>$rupiah</td>
<td align='center'><font color='red'>$r[asuransi_kerugian]</td>
<td align='right'><font color='red'>$rupiah1</td>
<td align='center' width=70><font color='red'>$r[tgl_pk]</td>
<td align='right'><font color='red'>$slsh</td>
<td align='center'><font color='red'><blink>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
else {
echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td align='right'>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='right'>$rupiah</td>
<td align='center'>$r[asuransi_kerugian]</td>
<td align='right'>$rupiah1</td>
<td align='center' width=70>$r[tgl_pk]</td>
<td align='right'>$slsh</td>
<td align='center'>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
}
echo "</table>";

//Langkah 3
$tampil2    = "SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.no_polis_ass_kerugian = 'PENDING' AND debitur.LNC LIKE '%$lnc%' ORDER BY debitur.tgl_pk ASC";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);
$jmldata	= number_format($jmldata,0,',','.');

//echo "<br>Halaman : ";
//$file = "cari_ass_jiwa.php";
//for($i=1;$i<=$jmlhalaman;$i++)
// if ($i !=$halaman) {
//echo "<a href='$file?halaman=$i&$pilih=$cari&oke=$oke'>$i</A> | ";
//}
//else{
//echo "<b>$i</b> | ";
//}
echo "<p>Total Data <b>LNC $lnc</b> : <b>$jmldata</b> debitur yang ditanggung oleh Asuransi : <b>$cari</b></p>";
}
else{
echo "<b><p class=style1>Maaf, data <b>MONITORING PENYELESAIAN POLIS ASURANSI KERUGIAN</b> dari <b>LNC $lnc</b> yang anda cari tidak ada pada database !!!</b>";
}
}
?>
</div>
