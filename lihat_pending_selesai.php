<?php include 'collateral_script/session_head.php'; ?>
<TITLE>MONITORING PENDING</TITLE>
<?php include 'collateral_script/head.php'; ?> 
<div style="margin:0px 50px;text-align: left;">
<form name=biodata method=get action=lihat_pending_selesai.php>
  <p class="style11">
    <INPUT type=radio name=pilih value=status_rekg checked>
  Detail  Pending &amp; Penyelesaian Collateral Per Periode <br>
  </p>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <font face="Arial" size="2">Nama LNC</font></td>
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
$a = "DETAIL PENDING & PENYELESAIAN COLLATERAL PER PERIODE";
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

$tampil=mysql_query("SELECT * FROM debitur WHERE $pilih='AKTIF' AND LNC='$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY debitur.produk asc LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);


if ($jumlah > 0) {

echo "<br><p class=style11><b>$a $_GET[tgl_awal] s/d $_GET[tgl_akhir]</b></p><table class='tblLookup' border='1px'>
<thead>
<tr>
<th>NO.</th>
<th width=20>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=20>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>MAKSIMUM KREDIT</th>
<th width=65>TGL. PK</th>
<th width=65>STATUS BPKB</th>
<th width=65>STATUS AJB</th>
<th width=65>STATUS SHT</th>
<th width=65>STATUS POLIS JIWA</th>
<th width=65>STATUS POLIS KERUGIAN</th>
<th width=65>TGL. UPDATE</th>
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

$ab    = "AKTIF";
$count = "AKAN JATUH TEMPO";
$st    = "JATUH TEMPO";

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
<td><b>$no</td>
<td align='center'><b>$r[LNC]</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='right'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><b>$r[produk]</td>
<td align='right'><b>$rupiah</td>
<td align='center'><b>$r[tgl_pk]</td>
<td align='center'><b>$r[no_bpkb]</td>
<td align='center'><b>$r[no_ajb]</td>
<td align='center'><b>$r[no_pengikatan]</td>
<td align='center'><b>$r[no_polis_ass_jiwa]</td>
<td align='center'><b>$r[no_polis_ass_kerugian]</td>
<td align='center'><b>$r[tgl_update]</td>

<td align='center'><a href=edit_data_debitur.php?id=$r[NOAPLIKASI]>Edit
</td>
</tr>";
      $no++;
}
elseif ($bbb=='AKAN JATUH TEMPO'){
Echo "
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[LNC]</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='right'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><b>$r[produk]</td>
<td align='right'><b>$rupiah</td>
<td align='center'><b>$r[tgl_pk]</td>
<td align='center'><b>$r[no_bpkb]</td>
<td align='center'><b>$r[no_ajb]</td>
<td align='center'><b>$r[no_pengikatan]</td>
<td align='center'><b>$r[no_polis_ass_jiwa]</td>
<td align='center'><b>$r[no_polis_ass_kerugian]</td>
<td align='center'><b>$r[tgl_update]</td>

<td align='center'><a href=edit_data_debitur.php?id=$r[NOAPLIKASI]>Edit
</td>
</tr>";
      $no++;
}
else {	
Echo "
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[LNC]</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='right'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><b>$r[produk]</td>
<td align='right'><b>$rupiah</td>
<td align='center'><b>$r[tgl_pk]</td>
<td align='center'><b>$r[no_bpkb]</td>
<td align='center'><b>$r[no_ajb]</td>
<td align='center'><b>$r[no_pengikatan]</td>
<td align='center'><b>$r[no_polis_ass_jiwa]</td>
<td align='center'><b>$r[no_polis_ass_kerugian]</td>
<td align='center'><b>$r[tgl_update]</td>

<td align='center'><a href=edit_data_debitur.php?id=$r[NOAPLIKASI]>Edit
</td>
</tr>";
      $no++;
}  
}
echo "</table>";

//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2    = mysql_query("SELECT * FROM debitur WHERE $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata    = mysql_num_rows($tampil2);
$file       = "lihat_pending_selesai.php";
$jmldata	= number_format($jmldata,0,',','.');


$tampil3    = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata1    = mysql_num_rows($tampil3);
$file1       = "lihat_pending_selesai.php";
$jmldata1	= number_format($jmldata1,0,',','.');

$tampil4    = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata2   = mysql_num_rows($tampil4);
$file2      = "lihat_pending_selesai.php";
$jmldata2	= number_format($jmldata2,0,',','.');

$tampil5    = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata3   = mysql_num_rows($tampil5);
$file3      = "lihat_pending_selesai.php";
$jmldata3	= number_format($jmldata3,0,',','.');

$tampil6    = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata4   = mysql_num_rows($tampil6);
$file4      = "lihat_pending_selesai.php";
$jmldata4	= number_format($jmldata4,0,',','.');

$tampil7    = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata5   = mysql_num_rows($tampil7);
$file5      = "lihat_pending_selesai.php";
$jmldata5	= number_format($jmldata5,0,',','.');

$jmldatax   = $jmldata1 + $jmldata2 + $jmldata3 + $jmldata4 + $jmldata5;
$jmldatax	= number_format($jmldatax,0,',','.');

//SELESAI PENDING
//ASS. KERUGIAN
$tampil8    = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='ADA' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata6   = mysql_num_rows($tampil8);
$file6      = "lihat_pending_selesai.php";
$jmldata6	= number_format($jmldata6,0,',','.');

//ASS. JIWA
$tampil9    = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_jiwa='ADA' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata7   = mysql_num_rows($tampil9);
$file7      = "lihat_pending_selesai.php";
$jmldata7	= number_format($jmldata7,0,',','.');

//PENGIKATAN
$tampil10    = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_pengikatan='ADA' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata8   = mysql_num_rows($tampil10);
$file8      = "lihat_pending_selesai.php";
$jmldata8	= number_format($jmldata8,0,',','.');

//AJB
$tampil11    = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_ajb='ADA' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata9   = mysql_num_rows($tampil11);
$file9      = "lihat_pending_selesai.php";
$jmldata9	= number_format($jmldata9,0,',','.');

//BPKB
$tampil12    = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_bpkb='ADA' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'");
$jmldata10   = mysql_num_rows($tampil12);
$file10      = "lihat_pending_selesai.php";
$jmldata10	 = number_format($jmldata10,0,',','.');

$jml 		 = $jmldata6 + $jmldata7 + $jmldata8 + $jmldata9 + $jmldata10;

echo "<BR><B><a style=font-size:16px><blink>SUMMARY</blink></p></B>";

echo "<B><table><a style=font-size:16px>
<tr bgcolor=#A6D000>
<td align='center'><a style=font-size:12px><B>LNC</b></td>
<td align='center'><a style=font-size:12px><B>BPKB</b></td>
<td align='center'><a style=font-size:12px><B>AJB</b></td>
<td align='center'><a style=font-size:12px><B>SHT</b></td>
<td align='center'><a style=font-size:12px><B>POLIS ASURANSI JIWA</b></td>
<td align='center'><a style=font-size:12px><B>POLIS ASURANSI KERUGIAN</b></td>
<td align='center'><a style=font-size:12px><B>TOTAL PENDING</b></td>
<td align='center'><a style=font-size:12px><B>TOTAL PENYELESAIAN</b></td>
<td align='center'><a style=font-size:12px><B>TOTAL DEBITUR</b></td>
</tr></blink>";
Echo "
<tr bgcolor=$warna2>
<td align='center' width=50><a style=font-size:12px>$lnc</td>
<td align='center' width=120><a style=font-size:12px>$jmldata1</td>
<td align='center' width=120><a style=font-size:12px>$jmldata2</td>
<td align='center' width=120><a style=font-size:12px>$jmldata3</td>
<td align='center' width=120><a style=font-size:12px>$jmldata4</td>
<td align='center' width=120><a style=font-size:12px>$jmldata5</td>
<td align='center' width=120><a style=font-size:12px>$jmldatax</td>
<td align='center' width=120><a style=font-size:12px>$jml</td>
<td align='center' width=120><a style=font-size:12px>$jmldata</td>
</tr>";
      $no++;

}
else{
echo "<br><p class=style11><b>Maaf, data <b>$a dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b></p>";
}
}

?>

</div>
</div>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>