<TITLE>MONITORING PENGIKATAN</TITLE>
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
<p><span class="style1"><a href="summary.php">MENU UTAMA</a>&nbsp&nbsp&nbsp<a href="menu_laporan.htm" class="style1">REPORT</a>&nbsp&nbsp&nbsp</span> <BR>
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
<form method=get action=hasil_pending.php>
  <p class="style2">
    <div align="center">
<?php
Include ("koneksi.php");
Include ("inc.librari.php");
mysql_select_db("collateral_db");
$lnc=$_GET['LNC'];

$sql_pl = "SELECT * FROM debitur WHERE $pilih LIKE '%$lnc%'";
$hasil = mysql_query($sql_pl);
$jumlah = mysql_num_rows($hasil);

if($jumlah>0);
{
Echo ("data yang ditemukan :$jumlah<br><hr>");
while($r=mysql_fetch_row($hasil))
{
Echo("
<br>
<p class=style11><b>DAFTAR MONITORING PENGIKATAN</b></p><table cellpadding=4>
<tr>
<th>NO.</th>
<th width=20>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=30>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>MAKSIMUM KREDIT</th>
<th>NILAI HT</th>
<th>NAMA NOTARIS</th>
<th width=50>TGL. PK</th>
<th width=40>HARI PROSES</th>
<th width=65>STATUS</th>
<th width=10>ACTION</th></th>
</tr>");

$no++;

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

if ($bbb==1){
    $bbb=$count;
}
else{
  $bbb = $ab;
}
	

Echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td align='center'>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='right'>$r[maksimum_kredit]</td>
<td align='right'>$r[nilai_ht]</td>
<td><? echo $r[notaris]; ?></td>
<td align='center'>$r[tgl_pk]</td>
<td align='right'>$selisih</td>
<td align='center'>$bbb</td>

<td><a href=edit_data_pending.php?id=$r[NOAPLIKASI]>&nbsp&nbsp&nbsp&nbspEdit&nbsp&nbsp&nbsp&nbsp
</td>
</tr>";
}
}
//else
{
echo ("Maaf, data tidak tersedia !!!");
}
 ?>
</table>
</body>
</html>