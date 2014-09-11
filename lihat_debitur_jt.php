<TITLE> LIST DEBITUR JATUH TEMPO </TITLE>
<style type="text/css">
<!--
.style3 {
	font-size: 12px;
	font-weight: bold;
}
.style4 {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
body,td,th {
	font-size: 11px;
}
.style10 {font-size: 18px}
.style11 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<p><span class="style4"><a href="summary.php" class="style4">MENU UTAMA </a>&nbsp&nbsp&nbsp<a href="menu_laporan.htm" class="style4">REPORTING</a></span><BR>
</p>
<form method=get action=lihat_debitur_jt.php>
  <p class="style2">&nbsp;</p>
  <p class="style2"><span class="style10">Nama LNC</span> :
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
  <p class="style11">
    <INPUT type=radio name=pilih value=status_rekg checked>
    Status Rekening <br>
  </p>
  <p class="style2">
    <input type=submit name=oke value=Cari>
  </p>
</form>
<div align="center">
  <div align="center"></div>
</div>
<p><BR>
</p>
<div align="center">
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
.style3 {font-size: 10px}
  </style>
  
  
<?php
$warna1 = "#DBDBA6";   // baris genap berwarna tua
$warna2 = "#F2F2DF";   // baris ganjil berwarna muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("collateral_db");

//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2     = mysql_query("SELECT * FROM debitur WHERE $pilih='AKTIF' AND LNC like '$lnc' ");
$jmldata     = mysql_num_rows($tampil2);
$jmldata     = number_format($jmldata,0,',','.');

echo "<p align='left'>Total data debitur : <b>$jmldata</b> orang <BR>"; 

echo "<br><p align='center'><b>DAFTAR STATUS REKENING DEBITUR YANG MASIH AKTIF </b></p><table cellpadding=4>
<tr>
<th>NO.</th>
<th>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>JATUH TEMPO PK</th>
<th>HARI</th>
<th>KETERANGAN</th>
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
$sql=mysql_query("SELECT * FROM debitur WHERE debitur WHERE $pilih like 'AKTIF' AND LNC like '$lnc' ORDER BY debitur.tgl_jt_pk ASC LIMIT $posisi, $batas");

$no=$posisi+1;
While ($r=mysql_fetch_array($sql)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}
//ngitung selisih tgl 
$tgl1=$r['tgl_jt_pk'];
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
$selisih = $jd1 - $jd2;

$aaa = 40;
$c1  = 0;

$bbb = $selisih < $c1;
$c2  = $selisih < $aaa;

$ab    = "AKTIF";
$count = "AKAN JATUH TEMPO";
$st    = "JATUH TEMPO";
$slsh  = number_format($selisih,0,',','.');

if ($bbb==1){
    $bbb=$st;
}
elseif ($c2==1){
	$bbb=$count;
}
else {	
    $bbb = $ab;
}

if ($bbb=='JATUH TEMPO'){
Echo "
<tr bgcolor=$warna>
<td align='center'><font color='red'>$no</td>
<td align='center'><font color='red'>$r[LNC]</td>
<td><font color='red'>$r[NOAPLIKASI]</td>
<td><font color='red'>$r[NAMADEBITUR]</td>
<td align='right'><font color='red'>$r[no_rekg_pinjaman]</td>
<td align='center'><font color='red'>$r[produk]</td>
<td align='center'><font color='red'>$r[tgl_jt_pk]</td>
<td align='center'><font color='red'>$slsh</td>
<td align='center'><font color='red'><blink>$bbb</td>
</tr>";
      $no++;
}
elseif ($bbb=='AKAN JATUH TEMPO'){
Echo "
<tr bgcolor=$warna>
<td align='center'><font color='blue'><b>$no</td>
<td align='center'><font color='blue'><b>$r[LNC]</td>
<td><font color='blue'><b>$r[NOAPLIKASI]</td>
<td><font color='blue'><b>$r[NAMADEBITUR]</td>
<td align='right'><font color='blue'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><font color='blue'><b>$r[produk]</td>
<td align='center'><font color='blue'><b>$r[tgl_jt_pk]</td>
<td align='center'><font color='blue'><b>$slsh</td>
<td align='center'><font color='blue'><b><blink>$bbb</td>
</tr>";
      $no++;
}
else {
Echo "
<tr bgcolor=$warna>
<td align='center'>$no</td>
<td align='center'>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[tgl_jt_pk]</td>
<td align='center'>$slsh</td>
<td align='center'>$bbb</td>
</tr>";
      $no++;
}
}
echo "</table>";

//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2     = mysql_query("SELECT * FROM debitur debitur WHERE $pilih='AKTIF' AND LNC='$lnc' ");
$jmldata     = mysql_num_rows($tampil2);
$jmlhalaman  = ceil($jmldata/$batas);
$file        = "lihat_debitur_jt.php";

//Link ke halaman sebelumnya (previous)
if ($halaman>1){
    $previous = $halaman-1;
	echo "<A HREF=$file?halaman=1> << First </A> |
	      <A HREF=$file?halaman=$previous> < Previous </A> | ";
}
else{
     echo "<< First | < Previous | "; }

//Tampilkan link halaman 1,2,3,...
for ($i=1;$i<=$jmlhalaman;$i++)
if  ($i !=$halaman){
  echo "<a href=$file?halaman=$i>$i</A> | ";}
else{
  echo "<b>$i</b> | ";}
//Link ke halaman berikutnya (Next)
if ($halaman < $jmlhalaman){
    $next = $halaman+1;
	echo "<A HREF=$file?halaman=$next> Next > </A> |
	      <A HREF=$file?halaman=$jmlhalaman> Previous >> </A> | ";
}
else{
     echo "Next > | Last >>";}

?>
</div>
