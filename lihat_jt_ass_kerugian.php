<?php include 'collateral_script/session_head.php'; ?>
<TITLE>JATUH TEMPO ASS KERUGIAN</TITLE>
<?php include 'collateral_script/head.php'; ?> 
<div style="margin:0px 50px;text-align: left;">
    
<form name=biodata method=get action=lihat_jt_ass_kerugian.php>
  <p class="style11">
    <INPUT type=radio name=pilih value=status_rekg checked>
  JATUH TEMPO ASURANSI KERUGIAN PER PERIODE<br>
  </p>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <span class="style15"><font face="Arial">Nama LNC</font></span></td>
      <td width="86%" style="border-style: none; border-width: medium" height="29"> <font face="Arial"><span class="style11"><span class="style2">
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
      </span></span>
      </font></td>
    </tr>
  </table>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <span class="style15"><font face="Arial">Tgl. Awal </font></span></td>
      <td width="86%" style="border-style: none; border-width: medium" height="29"> <font face="Arial"><span class="style11"><span class="style2">
        <input type="date" name="tgl_awal" size="10" style="text-transform:uppercase;" onClick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_awal);return false;">
</span></span> </font></td>
    </tr>
  </table>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <span class="style15"><font face="Arial">Tgl. Akhir</font></span></td>
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
$a = "JATUH TEMPO ASURANSI KERUGIAN PER PERIODE";
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

$tampil=mysql_query("SELECT * FROM debitur WHERE $pilih='AKTIF' AND LNC='$lnc' AND debitur.tgl_jt_ass_kerugian between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_jt_ass_kerugian ASC");
$jumlah= mysql_num_rows($tampil);


if ($jumlah > 0) {

echo "<br><p class=style11><b>$a $_GET[tgl_awal] S/D $_GET[tgl_akhir] LNC $lnc</b></p><table class='tblLookup' border='1px'>
<thead>

<tr>
<th>NO.</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=20>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>MAKSIMUM KREDIT</th>
<th width=65>TGL. PK</th>
<th width=65>TGL. JATUH TEMPO ASS KERUGIAN</th>
</tr></thead>";

$no=$posisi+1;
While ($r=mysql_fetch_array($tampil)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}
//ngitung jumlah pada tabel
$allx  = "SELECT SUM(maksimum_kredit) AS total_max FROM debitur WHERE $pilih='AKTIF' AND LNC='$lnc' AND debitur.tgl_jt_ass_kerugian between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY debitur.tgl_jt_ass_kerugian DESC ";
  $result = mysql_query($allx) or die 
  (mysql_error());
  $t      = mysql_fetch_array($result);
$xxx = number_format($t['total_max'],0,',','.');

//ngitung selisih tgl 
$tgl2=$r['tgl_jt_ass_kerugian'];
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
<td>$no</td>
<td align='center'>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='right'>$rupiah</td>
<td align='center'>$r[tgl_pk]</td>
<td align='center'><blink><b>$r[tgl_jt_ass_kerugian]</td>
</tr>";
      $no++;
}
elseif ($bbb=='AKAN JATUH TEMPO'){
Echo "
<tr bgcolor=$warna>
<td><font color='blue'><b>$no</td>
<td align='center'><font color='blue'><b>$r[NOAPLIKASI]</td>
<td><font color='blue'><b>$r[NAMADEBITUR]</td>
<td align='right'><font color='blue'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><font color='blue'><b>$r[produk]</td>
<td align='right'><font color='blue'><b>$rupiah</td>
<td align='center'><font color='blue'><b>$r[tgl_pk]</td>
<td align='center'><font color='blue'><b>$r[tgl_jt_ass_kerugian]</td>
</tr>";
      $no++;
}
else {	
Echo "
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='right'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><b>$r[produk]</td>
<td align='right'><b>$rupiah</td>
<td align='center'><b>$r[tgl_pk]</td>
<td align='center'><b>$r[tgl_jt_ass_kerugian]</td>

</tr>";
      $no++;
}  
}
echo "</table>";


//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2    = mysql_query("SELECT * FROM debitur WHERE $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_jt_ass_kerugian between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_jt_ass_kerugian DESC ");
$jmldata    = mysql_num_rows($tampil2);
$jmlhalaman = ceil($jmldata/$batas);
$file       = "lihat_jt_ass_kerugian.php";
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
echo "<b><font color='blue'><p>TOTAL LNC $lnc : $jmldata DEBITUR - Rp. $xxx</b> </font>";
//echo "<p>TOTAL DATA <b>$a dari LNC $lnc</b> : <b>$jmldata</b> DEBITUR </p>";
}
else{
echo "<br><p class=style11><b>Maaf, data <b>$a $_GET[tgl_awal] S/D $_GET[tgl_akhir] dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b></p>";
}
}
?>
</div>
</div>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>