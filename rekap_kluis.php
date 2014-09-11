<TITLE> DOKUMEN ASLI </TITLE>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
body,td,th {
	font-size: 12px;
}
.style10 {font-size: 18px}
-->
</style>
<p><span class="style1"><a href="summary.php">MENU UTAMA</a>&nbsp&nbsp&nbsp<a href="menu_laporan.htm" class="style4">REPORTING</a></span> <BR>
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
<form method=get action=rekap_kluis.php>
  <p class="style2">&nbsp;</p>
  <p class="style2"><span class="style10">Nama LNC</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
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
  </p>
  <p class="style1">
  <input type=radio name=pilih value=NAMADEBITUR checked>
  Nama Debitur <br>
    <input type=radio name=pilih value=amplop_asli>
  Nomor Bantek File Asli <br>
  <input type=radio name=pilih value=amplop_copy>
  Nomor Bantek File Kerja </p>
  <p class="style1">    <input type=text name=cari size=50>
  </p>
  <p class="style1">
  
  <p class="style1">
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
$batas   = 999999;
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
$lnc  =$_GET['LNC'];


if($pilih == "amplop_asli")
{
$a = "BANTEK FILE ASLI NOMOR";
}
elseif($pilih == "amplop_copy")
{
$a = "BANTEK FILE KERJA NOMOR";
}
elseif($pilih == "NAMA DEBITUR")
{
$a = "NAMA DEBITUR";
}
elseif($pilih == "no_ajb")
{
$a = "MONITORING AKTA JUAL BELI";
}


$tampil= mysql_query("SELECT * FROM debitur WHERE $pilih like '%$cari%' AND LNC='$lnc' LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);


if ($jumlah > 0) {

echo "<br><p align='center'><b>INFORMASI TEMPAT PENYIMPANAN FILE DEBITUR</b></p><br><table cellpadding=4>

<tr>

<th>NO.</th>
<th>LNC</th>
<th>LOKASI FILE ASLI</th>
<th>NO. BANTEK FILE ASLI</th>
<th>NO. AMPLOP ASLI</th>
<th>SISA TEMPAT FILE ASLI</th>
<th>LOKASI FILE KERJA</th>
<th>NO. BANTEK FILE KERJA</th>
<th>NO. AMPLOP KERJA</th>
<th>SISA TEMPAT FILE KERJA</th>

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
$rupiah=number_format($max,0,',','.');
$rupiah1=number_format($nht,0,',','.');
$slsh=number_format($selisih,0,',','.');

if ($bbb==1){
    $bbb=$count;
}
else{
  $bbb = $ab;
}

$tampil2    = "SELECT * FROM debitur WHERE $pilih like '%$cari%' AND LNC='$lnc'";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);
$batas = 10;
$xl    = $batas - $jmldata; 
echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td align='center'>$r[lokasi_dokumen_asli]</td>
<td align='center'>$r[amplop_asli]</td>
<td align='center'>$r[amplopasli]</td>
<td align='center'>$xl</td>
<td align='center'>$r[lokasi_dokumen_copy]</td>
<td align='center'>$r[amplop_copy]</td>
<td align='center'>$r[amplopcopy]</td>

<td align='center'>$r[status_rekg]</td>
</tr>";
      $no++;
}
echo "</table>";

//Langkah 3
$tampil2    = "SELECT * FROM debitur WHERE $pilih like '%$cari%' AND LNC='$lnc'";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);
$batas = 10;
$xl    = $batas - $jmldata; 
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
echo "<p><b>$jmldata</b> DATA DEBITUR <b>LNC $lnc</b> KRITERIA <b><font color='red'>$a : <b>$cari</b>, SISA TEMPAT KOSONG : <blink>$xl </b></p>";
}
else{
echo "<br><p class=style11><b>Maaf, data <b>$a dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b></p>";
}
}
?>
</div>
