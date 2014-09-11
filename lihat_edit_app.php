<TITLE>EDIT  PER PERIODE</TITLE>
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
	font-size: 12px;
	table-layout: auto;
}
.style10 {font-size: 18px}
.style11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<p><span class="style1"><a href="summary.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="menu_appraisal.htm" class="style1">MENU APPRAISAL</a></span> <BR>
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
<form name=biodata method=get action=lihat_edit_app.php>
  <p class="style11">
    <INPUT type=radio name=pilih value=status_rekg checked>
  DAFTAR EDIT DATA DEBITUR PER PERIODE<br>
  </p>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <font face="Arial" size="2">Nama LNC</font></td>
      <td width="86%" style="border-style: none; border-width: medium" height="29"> <font face="Arial"><span class="style11"><span class="style2">
        <select size="1" name="LNC">
          <option>BAL</option>
          </select>
      </span></span>
      </font></td>
    </tr>
  </table>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <font size="2" face="Arial">Tgl. Awal </font></td>
      <td width="86%" style="border-style: none; border-width: medium" height="29"> <font face="Arial"><span class="style11"><span class="style2">
        <input type="date" name="tgl_awal" size="10" style="text-transform:uppercase;" onClick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_awal);return false;">
</span></span> </font></td>
    </tr>
  </table>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <font size="2" face="Arial">Tgl. Akhir</font></td>
      <td width="86%" style="border-style: none; border-width: medium" height="29"> <font face="Arial"><span class="style11"><span class="style2">
      <input type=date name=tgl_akhir size="10" style="text-transform:uppercase;" onClick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_akhir);return false;">
</span></span> </font></td>
    </tr>
  </table>
  <p class="style11">
    <input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">

<div align="center">
  <?php
ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');
ini_set('max_input_time', 10600);
ini_set('max_execution_time', 10600);
  
$tgl_awal	= $_POST['tgl_awal'];
$tgl_akhir	= $_POST['tgl_akhir'];

$oke=$_GET['oke'];
if ($oke=='Cari'){

Include ("koneksi.php");
Include ("inc.librari.php");
mysql_select_db("collateral_db");

//Langkah 1
$batas   = 100000;
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
$bpkb=$_GET['no_bpkb'];
$ajb=$_GET['no_ajb'];
$aplikasi=$_GET['NOAPLIKASI'];
$notaris=$_GET['no_pengikatan'];
$developer=$_GET['developer']; 
$assjiwa=$_GET['no_polis_ass_jiwa'];
$asskerugian=$_GET['no_polis_ass_kerugian'];
$tgl_pk=$_GET['tgl_pk'];
$maksimum_kredit=$_GET['maksimum_kredit'];
$nilai_ht=$_GET['nilai_ht'];
$today=date(Ymd);
$tgl_jt_pk  = $_POST['tgl_jt_pk'];


$a=$today>40;

if($pilih == "status_rekg")
{
$a = "DAFTAR EDIT DATA DEBITUR PER PERIODE";
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
$a = "MONITORING AKTA JUAL BELI";
}

$tampil=mysql_query("SELECT * FROM debitur WHERE debitur.produk<>'BNI Fleksi' AND debitur.produk<>'3610 0101 - BNI FLEKSI IND FLAT IDR' AND LNC='$lnc' AND debitur.tgl_update_app between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY debitur.tgl_update_app ASC");
$jumlah= mysql_num_rows($tampil);


if ($jumlah > 0) {

echo "<br><p class=style11><b>$a $_GET[tgl_awal] S/D $_GET[tgl_akhir] LNC $lnc</b></p><table cellpadding=4>
<tr>
<th>NO.</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th>JENIS PRODUK</th>
<th>MAX KREDIT</th>
<th width=65>TGL. TAKSASI</th>
<th width=65>NAMA USER</th>
<th width=65>STATUS</th>
</tr>";

$no=$posisi+1;
While ($r=mysql_fetch_array($tampil)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}
//ngitung jumlah pada tabel
$allx  = "SELECT SUM(maksimum_kredit) AS total_max FROM debitur WHERE debitur.produk<>'BNI Fleksi' AND debitur.produk<>'3610 0101 - BNI FLEKSI IND FLAT IDR' AND LNC='$lnc' AND debitur.tgl_update_app between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY debitur.tgl_update_app DESC ";
  $result = mysql_query($allx) or die 
  (mysql_error());
  $t      = mysql_fetch_array($result);
$xxx = number_format($t['total_max'],0,',','.');

//ngitung selisih tgl 
$tgl2=$r['tgl_jt_pk'];
$tgl1=date('Y-m-d');
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

$aaa = 40;
$c1  = 0;

$bbb = $selisih < $c1;
$c2  = $selisih < $aaa;

$ab    = "JATUH TEMPO";
$count = "AKAN JATUH TEMPO";
$st    = "AKTIF";

$slsh  = number_format($selisih,0,',','.');
$rupiah= number_format($r['maksimum_kredit'],0,',','.');

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
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='center'><b>$r[produk]</td>
<td align='center'><b>$rupiah</td>
<td align='center'><b>$r[tgl_taksasi]</td>
<td align='center'><b>$r[penilai]</td>
<td align='center'><b>$r[status]</td>
</tr>";
      $no++;
}
elseif ($bbb=='AKAN JATUH TEMPO'){
Echo "
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='center'><b>$r[produk]</td>
<td align='center'><b>$rupiah</td>
<td align='center'><b>$r[tgl_taksasi]</td>
<td align='center'><b>$r[penilai]</td>
<td align='center'><b>$r[status]</td>
</tr>";
      $no++;
}
else {	
Echo "
<tr bgcolor=$warna>
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='center'><b>$r[produk]</td>
<td align='center'><b>$rupiah</td>
<td align='center'><b>$r[tgl_taksasi]</td>
<td align='center'><b>$r[penilai]</td>
<td align='center'><b>$r[status]</td>

</tr>";
      $no++;
}  
}
echo "</table>";


//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2    = mysql_query("SELECT * FROM debitur WHERE debitur.produk<>'BNI Fleksi' AND debitur.produk<>'3610 0101 - BNI FLEKSI IND FLAT IDR' AND LNC LIKE '$lnc' AND debitur.tgl_update_app between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_update_app DESC ");
$jmldata    = mysql_num_rows($tampil2);
$jmlhalaman = ceil($jmldata/$batas);
$file       = "lihat_lunas.php";
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
echo "<b><font color='blue'><p>TOTAL DEBITUR YANG DIEDIT : $jmldata DEBITUR</b> </font>";
//echo "<p>TOTAL DATA <b>$a dari LNC $lnc</b> : <b>$jmldata</b> DEBITUR </p>";
}
else{
echo "<br><p class=style11><b>Maaf, data <b>$a $_GET[tgl_awal] S/D $_GET[tgl_akhir] dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b></p>";
}
}
?>
</div>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>