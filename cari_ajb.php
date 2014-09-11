<?php include 'collateral_script/session_head.php'; ?>
<TITLE>MONITORING AJB</TITLE>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	table-layout: auto;
}
.style5 {
	font-size: 12px;
	font-weight: bold;
}
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.style10 {font-size: 18px}
.style11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
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
<form method=get action=cari_ajb.php>
  <p class="style2">&nbsp;</p>
  <p class="style2"><span class="style10">Nama LNC</span> : <span class="style2">
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
  </span></p>
  <p class="style11">
    <INPUT type=radio name=pilih value=no_ajb checked>
  Monitoring Penyelesaian Akta Jual Beli <br>
  </p>
  <p class="style2">
    <input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">
<div align="center">
  <?php
$oke=$_GET['oke'];
if ($oke=='Cari'){
Include ("koneksi.php");
Include ("inc.librari.php");
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

$warna1 = "#DBDBA6";   // baris genap berwarna tua
$warna2 = "#F2F2DF";   // baris ganjil berwarna muda
$warna  = $warna1;     // warna default

//Langkah 2
$cari=$_GET['cari'];
$pilih=$_GET['pilih'];
$lnc=$_GET['LNC'];
$nama=$_GET['NAMADEBITUR'];
$ajb=$_GET['no_ajb'];
$aplikasi=$_GET['NOAPLIKASI'];
$notaris=$_GET['no_pengikatan'];
$developer=$_GET['developer']; 
$assjiwa=$_GET['no_polis_ass_jiwa'];
$asskerugian=$_GET['no_polis_ass_kerugian'];
$tgl_pk=$_GET['tgl_pk'];
$maksimum_kredit=$_GET['maksimum_kredit'];
$nilai_ht=$_GET['nilai_ht'];

if($pilih == "no_pengikatan")
{
$a = "MONITORING PENYELESAIAN AJB";
}
elseif($pilih == "no_polis_ass_jiwa")
{
$a = "MONITORING ASURANSI JIWA";
}
elseif($pilih == "no_polis_ass_kerugian")
{
$a = "MONITORING ASURANSI KERUGIAN";
}
elseif($pilih == "no_ajb")
{
$a = "MONITORING PENYELESAIAN AKTA JUAL BELI";
}

$tampil=mysql_query("SELECT * FROM debitur WHERE $pilih='PENDING' AND LNC='$lnc' 
                    ORDER BY debitur.tgl_pk ASC");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<br><p class=style11><b>$a</b></p><table cellpadding=4>
<tr>
<th>NO.</th>
<th width=20>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=30>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>NOTARIS</th>
<th width=50>TGL. PK</th>
<th width=40>HARI PROSES</th>
<th width=65>STATUS</th>
<th width=10>ACTION</th></th>
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

$aaa = 180;
$bbb = $selisih > $aaa;

$ab  = "IN PROGRESS";
$count = "PENDING";

$max = $r['maksimum_kredit'];
$nht = $r['nilai_ht'];
$selisih=number_format($selisih,0,',','.');

if ($bbb==1){
    $bbb=$count;
}
else{
  $bbb = $ab;
}

if ($bbb=='PENDING'){	
Echo "
<tr bgcolor=$warna>
<td><font color='red'><b>$no</td>
<td align='center'><font color='red'><b>$r[LNC]</td>
<td align='center'><font color='red'><b>$r[NOAPLIKASI]</td>
<td><font color='red'><b>$r[NAMADEBITUR]</td>
<td align='right'><font color='red'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><font color='red'><b>$r[produk]</td>
<td align='center'><font color='red'><b>$r[notaris]</td>
<td align='center'><font color='red'><b>$r[tgl_pk]</td>
<td align='right'><font color='red'><b>$selisih</td>
<td align='center'><font color='red'><b><BLINK>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
else {
Echo "

<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td align='center'>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[notaris]</td>
<td align='center'>$r[tgl_pk]</td>
<td align='right'>$selisih</td>
<td align='center'>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
}
echo "</table>";


//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2    = mysql_query("SELECT * FROM debitur WHERE $pilih LIKE 'PENDING' AND LNC LIKE '$lnc'");
$jmldata    = mysql_num_rows($tampil2);
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
echo "<p>TOTAL DATA <b>$a dari LNC $lnc</b> : <b>$jmldata</b> debitur </p>";
}
else{
echo "<b><p class=style11>Maaf, data <b>$a dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b>";

}
}
?>
</div>
