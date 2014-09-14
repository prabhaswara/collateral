<?php include 'collateral_script/session_head.php'; ?>
<TITLE>CARI DOKUMEN</TITLE>
<?php include 'collateral_script/head.php'; ?> 
<div style="margin:0px 50px;text-align: left;">
    <form method=get action=cari_bantek.php>
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

$warna1 = "#DBDBA6";   // baris genap berwarna tua
$warna2 = "#F2F2DF";   // baris ganjil berwarna muda
$warna  = $warna1;     // warna default

//Langkah 2
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['pilih'];
$cari  =$_GET['cari'];
$lnc  	=$_GET['LNC'];
$status	=$_GET['status_rekg'];

if($pilih == "amplop_asli")
{
$a = "BANTEK FILE ASLI NOMOR";
}
elseif($pilih == "amplop_copy")
{
$a = "BANTEK FILE KERJA NOMOR";
}
elseif($pilih == "NAMADEBITUR")
{
$a = "NAMA DEBITUR";
}
elseif($pilih == "no_ajb")
{
$a = "MONITORING AKTA JUAL BELI";
}


$tampil= mysql_query("SELECT * FROM debitur WHERE debitur.status_rekg='AKTIF' AND $pilih ='$cari' AND LNC='$lnc'  LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);


if ($jumlah > 0) {

echo "<br><p align='center'><b>DATA PENYIMPANAN FILE DEBITUR</b></p><br><table class='tblLookup' border='1px'>
<thead>
<tr>
<th >NO.</th>
<th width=20>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=20>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>NO. PK</th>
<th>LOKASI FILE ASLI</th>
<th>NO. BANTEK FILE ASLI</th>
<th>NO. AMPLOP ASLI</th>
<th>LOKASI FILE KERJA</th>
<th>NO. BANTEK FILE KERJA</th>
<th>NO. AMPLOP KERJA</th>
<th>STATUS REKG.</th>
</tr></thead>";

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

echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='center'>$r[no_pk]</td>
<td align='center'>$r[lokasi_dokumen_asli]</td>
<td align='center'>$r[amplop_asli]</td>
<td align='center'>$r[amplopasli]</td>
<td align='center'>$r[lokasi_dokumen_copy]</td>
<td align='center'>$r[amplop_copy]</td>
<td align='center'>$r[amplopcopy]</td>

<td align='center'>$r[status_rekg]</td>
</tr>";
      $no++;
}
echo "</table>";

//Langkah 3
$tampil2    = "SELECT * FROM debitur WHERE debitur.status_rekg='AKTIF' AND $pilih ='$cari' AND LNC='$lnc'";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);
$batas = 10;
$xl    = $batas - $jmldata; 

if ($pilih==NAMADEBITUR){
echo "";
}
else 

echo "<p><b>$jmldata</b> DATA DEBITUR <b>LNC $lnc</b> KRITERIA : <b>$a : <b>$cari</b></p>";
echo "<b>SISA TEMPAT KOSONG : <BLINK>$xl</b>";

}
else
echo "<br><p class=style11><b>Maaf, data <b>$a dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b></p>";
}



?>
</div>
</div>
