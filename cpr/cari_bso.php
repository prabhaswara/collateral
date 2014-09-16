<TITLE>MONITORING NOTARIS</TITLE>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
body,td,th {
	font-size: 9px;
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
   background-color : #99FF66;
}
  </style>
</p>
<form method=get action=cari_notaris.php>
  <p class="style2"><span class="style10">Nama LNC</span> :
    <select size="1" name="LNC">
      <option>PLL</option>
    </select>
</p>
  <p class="style10">
    <input type=radio name=pilih value=notaris checked>
    <span class="style2">Nama Notaris</span><br>
    <input type=text name=cari size=50>
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
mysql_select_db("collateral");

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
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['pilih'];
$cari  =$_GET['cari'];
$lnc=$_GET['LNC'];

$tampil= mysql_query("SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.no_pengikatan = 'PENDING' AND 
debitur.LNC LIKE '%$lnc%' ORDER BY debitur.tgl_pk LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<p class=style10><b>MONITORING PENYELESAIAN SHT PER NOTARIS</p></b><table cellpadding=4>

<tr>
<th><b>NO.</th>
<th width=20><b>NAMA LNC</th>
<th><b>NO. APLIKASI</th>
<th><b>NAMA DEBITUR</th>
<th widht=20><b>NO. REK. PINJAMAN</th>
<th><b>JENIS PRODUK</th>
<th><b>NO.PK</th>
<th><b>MAKSIMUM KREDIT</th>
<th><b>NILAI PENGIKATAN</th>
<th><b>NOTARIS</th>
<th width=65><b>TGL. PK</th>
<th width=40><b>HARI PROSES</th>
<th width=65><b>STATUS</b></th>
<th><b>ACTION</th></th>
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
$slsh= number_format($selisih,0,',','.');

if ($bbb==1){
    $bbb=$count;
}
else{
  $bbb = $ab;
}

if ($bbb=='PENDING'){

echo "
<tr bgcolor=$warna>
<td><font color='red'>$no</font></td>
<td align='center'><font color='red'>$r[LNC]</td>
<td><font color='red'>$r[NOAPLIKASI]</td>
<td><font color='red'>$r[NAMADEBITUR]</td>
<td align='right'><font color='red'>$r[no_rekg_pinjaman]</td>
<td align='center'><font color='red'>$r[produk]</td>
<td align='center'><font color='red'>$r[no_pk]</td>
<td align='right'><font color='red'>$rupiah</td>
<td align='right'><font color='red'>$rupiah1</td>
<td align='center'><font color='red'>$r[notaris]</td>
<td align='center'><font color='red'>$r[tgl_pk]</td>
<td align='right'><font color='red'>$slsh</td>
<td align='center'><font color='red'><b><BLINK>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[NOAPLIKASI]>Edit
</td>
</tr>";
      $no++;
}
else{
echo "
<tr bgcolor= $warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[no_pk]</td>
<td align='right'>$rupiah</td>
<td align='right'>$rupiah1</td>
<td align='center'>$r[notaris]</td>
<td align='center'>$r[tgl_pk]</td>
<td align='right'>$slsh</td>
<td align='center'>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[NOAPLIKASI]>Edit
</td>
</tr>";
      $no++;
}


}
echo "</table>";

//Langkah 3
$tampil2    = "SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.no_pengikatan = 'PENDING' AND 
debitur.LNC LIKE '%$lnc%'";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);
$jmldata	= number_format($jmldata,0,',','.');

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
echo "<p class=style2>Ditemukan <b>$jmldata</b> data debitur <b>LNC $lnc</b> yang pengikatannya oleh Notaris : <b>$cari</b></p>";
}
else{
echo "<b><p class=style1>Maaf, data Notaris <b>$cari</b> dari <b>LNC $lnc</b> yang anda cari tidak ada pada database !!!</b>";
}
}
?>
</div>
