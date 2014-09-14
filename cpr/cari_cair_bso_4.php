<TITLE>EVALUASI TAHAP IV</TITLE>
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
<p><span class="style1"><a href="summary_bso.php">MENU UTAMA</a>&nbsp&nbsp&nbsp<a href="laporan_bso.htm" class="style1">ACTION</a>&nbsp&nbsp&nbsp</span> <BR>
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
<form method=get action=cari_cair_bso_4.php>
  <p class="style2">&nbsp;</p>
  <p class="style2"><span class="style10">Nama LNC</span> : <span class="style2">
    <select size="1" name="lnc">
      <option>PLL</option>
    </select>
  </span></p>
  <p class="style11">
    <INPUT type=radio name=pilih value=produk checked>
  Evaluasi Tahap IV<br>
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

$warna1 = "#DBDBA6";   // baris genap berwarna tua
$warna2 = "#F2F2DF";   // baris ganjil berwarna muda
$warna  = $warna1;     // warna default

//Langkah 2
$cari=$_GET['cari'];
$pilih=$_GET['pilih'];
$lnc=$_GET['lnc'];
$no_aplikasi=$_GET['no_aplikasi'];
$produk=$_GET['produk'];
$nama=$_GET['nama'];
$plafond=$_GET['plafond'];
$developer=$_GET['developer']; 
$perumahan=$_GET['perumahan'];
$skim=$_GET['skim'];
$tahap_1=$_GET['tahap_1'];
$tgl_tahap_1=$_GET['tgl_tahap_1'];
$tahap_2=$_GET['tahap_2'];
$tgl_tahap_2=$_GET['tgl_tahap_2'];
$tahap_3=$_GET['tahap_3'];
$tgl_tahap_3=$_GET['tgl_tahap_3'];


if($pilih == "produk")
{
$a = "DAFTAR EVALUASI PENCAIRAN TAHAP IV";
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

$tampil=mysql_query("SELECT * FROM data WHERE lnc='$lnc' AND cek_4=''");
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



if ($jumlah > 0) {

echo "<p class=style11><b>$a</b></p><table cellpadding=4>
<tr>
<th>NO.</th>
<th width=20>NAMA LNC</th>
<th>PRODUK</th>
<th widht=20>NO.REKG. PINJAMAN</th>
<th>NAMA DEBITUR</th>
<th widht=30>MAX KREDIT</th>
<th>TGL. PK</th>
<th>PENJUAL</th>
<th width=50>TGL. CAIR TAHAP 3</th>
<th width=50>TGL. CAIR TAHAP 4</th>
<th width=50>HARI CAIR TAHAP 4</th>
<th width=50>STATUS TAHAP 4</th>
<th width=65>STATUS BANGUNAN</th>
<th width=65>SISA</th>
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
$tgl1=$r['tgl_cair_3'];
$tgl2=$r['tgl_cair_4'];
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

// ngitung selisih ke-2
$tgl3=$r['tgl_cair_1'];
$tgl4=$r['tgl_cair_2'];
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal pertama
$pecah3 = explode("-", $tgl3);
$date3 = $pecah3[2];
$month3 = $pecah3[1];
$year3 = $pecah3[0];
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal kedua
$pecah4 = explode("-", $tgl4);
$date4 = $pecah4[2];
$month4 = $pecah4[1];
$year4 =  $pecah4[0];
// menghitung JDN dari masing-masing tanggal
$jd3 = GregorianToJD($month3, $date3, $year3);
$jd4 = GregorianToJD($month4, $date4, $year4);
// hitung selisih hari kedua tanggal
$selisih2 = $jd4 - $jd3;

// ngitung selisih ke-3
$tgl5=$r['tgl_cair_2'];
$tgl6=$r['tgl_cair_3'];
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal pertama
$pecah5 = explode("-", $tgl5);
$date5 = $pecah5[2];
$month5 = $pecah5[1];
$year5 = $pecah5[0];
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal kedua
$pecah6 = explode("-", $tgl6);
$date6 = $pecah6[2];
$month6 = $pecah6[1];
$year6 =  $pecah6[0];
// menghitung JDN dari masing-masing tanggal
$jd5 = GregorianToJD($month5, $date5, $year5);
$jd6 = GregorianToJD($month6, $date6, $year6);
// hitung selisih hari kedua tanggal
$selisih3 = $jd6 - $jd5;

// ngitung selisih ke-4
$tgl7=$r['tgl_cair_3'];
$tgl8=$r['tgl_cair_4'];
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal pertama
$pecah7 = explode("-", $tgl7);
$date7 = $pecah7[2];
$month7 = $pecah7[1];
$year7 = $pecah7[0];
// memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
// dari tanggal kedua
$pecah8 = explode("-", $tgl8);
$date8 = $pecah8[2];
$month8 = $pecah8[1];
$year8 =  $pecah8[0];
// menghitung JDN dari masing-masing tanggal
$jd7 = GregorianToJD($month7, $date7, $year7);
$jd8 = GregorianToJD($month8, $date8, $year8);
// hitung selisih hari kedua tanggal
$selisih4 = $jd8 - $jd7;

$ccc  = 90;
$ddd  = 30;
$koe  = 0;
$eee  = $selisih > $ccc;
$fff  = $selisih < $ddd;

$ab  = "CEK BSO";
$ct = "OK";


$a1 = ($r[max_kredit] - $r[cair_1] - $r[cair_2] - $r[cair_3] - $r[cair_4]);
$a1	= number_format($a1,0,',','.');

$r[max_kredit]	= number_format($r[max_kredit],0,',','.');
$r[cair_1]		= number_format($r[cair_1],0,',','.');
$r[cair_2]		= number_format($r[cair_2],0,',','.');
$r[cair_3]		= number_format($r[cair_3],0,',','.');
$r[cair_4]		= number_format($r[cair_4],0,',','.');

if ($selisih > 90){	
Echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[lnc]</td>
<td td align='center'>$r[produk]</td>
<td td align='center'>$r[rekg_pinjaman]</td>
<td align='left'>$r[nama_debitur]</td>
<td align='right'>$r[max_kredit]</td>
<td align='center'>$r[tgl_pk]</td>
<td align='center'>$r[developer]</td>
<td align='center'>$r[tgl_cair_3]</td>
<td align='center'>$r[tgl_cair_4]</td>
<td align='center'>$selisih</td>
<td align='center'>$ab</td>
<td align='center'>$r[progress]</td>
<td align='right'>$a1</td>
<td align='center'><a href=edit_data_4.php?id=$r[rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
elseif ($selisih < 0){
Echo "

<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[lnc]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[rekg_pinjaman]</td>
<td>$r[nama_debitur]</td>
<td align='right'>$r[max_kredit]</td>
<td align='center'>$r[tgl_pk]</td>
<td align='center'>$r[developer]</td>
<td align='center'>$r[tgl_cair_3]</td>
<td align='center'>$r[tgl_cair_4]</td>
<td align='center'>$selisih</td>
<td align='center'>$ab</td>
<td align='center'>$r[progress]</td>

<td align='right'>$a1</td>
<td align='center'><a href=edit_data_4.php?id=$r[rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
}
echo "</table>";


//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2    = mysql_query("SELECT * FROM data WHERE lnc LIKE '$lnc'");
$jmldata    = mysql_num_rows($tampil2);
$jmlhalaman = ceil($jmldata/$batas);
$jmldata	= number_format($jmldata,0,',','.');

//echo "<p class=style11>TOTAL DATA <b>$a LNC $lnc</b> : <br><b>$jmldata</font> DEBITUR, SISA SALDO : Rp. $xxxy</p></b></font> ";

}
else{
echo "<b><p class=style11>Maaf, data <b>$a dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b>";

}
}
?>
</div>
