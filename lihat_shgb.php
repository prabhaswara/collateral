<?php include 'collateral_script/session_head.php'; ?>
<?php include 'collateral_script/head.php'; ?> 
<?php include 'collateral_script/db_function.php';?> 
<?php include 'collateral_script/function.php';?> 
<TITLE>SHGB JATUH TEMPO</TITLE>
<div style="margin:0px 50px;text-align: left;">
    
<form name=biodata method=get action=lihat_shgb.php>
  <p class="style11">
    <INPUT type=radio name=pilih value=status_rekg checked>
  SHGB JATUH TEMPO PER PERIODE<br>
  </p>
  <table>
        <tr>
            <td>Nama LNC</td>
            <td><?=selectLNC("LNC","style='width:100px'") ?></td>
        </tr>
        <tr>
            <td>Tgl Jth Tempo SHGB</td>
            <td> <?=inputnya("tgl_awal",'style="width:100px" onClick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_awal);return false;"') ?>
                s/d  <?=inputnya("tgl_akhir",'style="width:100px" onClick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_awal);return false;"') ?>
            </td>
        </tr>
        <tr>
            <td>Hari Proses</td>
            <td><?=  inputnya("hariproses1","style='width:100px'")." s/d ".inputnya("hariproses2","style='width:100px'") ?> </td>
        </tr>
    </table>
  
  <p class="style11">
    <input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">

<div align="center">
  <?php
set_time_limit(3000);//set limit untuk melakukan query = 3000 seconds  
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
$a = "SHGB JATUH TEMPO PER PERIODE";
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
$sqlHariProsses="";
if(intval($_GET['hariproses1'])&&intval($_GET['hariproses2']))
{
    $sqlHariProsses=" and DATEDIFF(now(),tgl_pk) >= ".$_GET['hariproses1']." and DATEDIFF(now(),tgl_pk) <= ".$_GET['hariproses2'];
}

$tampil=mysql_query("SELECT NOAPLIKASI,NAMADEBITUR,no_rekg_pinjaman,produk,tgl_pk,tgl_jt_pk,tgl_jt_surat_tanah,no_rekg_pinjaman,DATEDIFF(now(),tgl_pk) hari_proses FROM debitur WHERE $pilih='AKTIF' $sqlHariProsses ".(($lnc=="all")?"":"AND LNC='$lnc'")." AND debitur.tgl_jt_surat_tanah between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY produk ASC");
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
<th width=65>HARI PROSES</th>
<th width=65>TGL. JATUH TEMPO PK</th>
<th width=65>TGL. JATUH TEMPO SHGB</th>
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
	
	
Echo "
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[NOAPLIKASI]</td>
<td><b>$r[NAMADEBITUR]</td>
<td align='right'><b>$r[no_rekg_pinjaman]</td>
<td align='center'><b>$r[produk]</td>
<td align='right'><b>$rupiah</td>
<td align='center'><b>$r[tgl_pk]</td>
<td align='center'><b>$r[hari_proses]</td>    
<td align='center'><b>$r[tgl_jt_pk]</td>
<td align='center'><blink><b>$r[tgl_jt_surat_tanah]</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</tr>";
      $no++;
 
}
echo "</table>";


//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
/*
$tampil2    = mysql_query("SELECT * FROM debitur WHERE $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata    = mysql_num_rows($tampil2);
$file       = "lihat_booking.php";
$jmldata	= number_format($jmldata,0,',','.');

$tampil3    = mysql_query("SELECT * FROM debitur WHERE debitur.produk='BWU' AND $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata1   = mysql_num_rows($tampil3);
$file1      = "lihat_booking.php";
$jmldata1	= number_format($jmldata1,0,',','.');

$tampil4    = mysql_query("SELECT * FROM debitur WHERE debitur.produk='GRIYA' AND $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata2   = mysql_num_rows($tampil4);
$file2      = "lihat_booking.php";
$jmldata2	= number_format($jmldata2,0,',','.');

$tampil5    = mysql_query("SELECT * FROM debitur WHERE debitur.produk='GRIYA MULTIGUNA' AND $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata3   = mysql_num_rows($tampil5);
$file3      = "lihat_booking.php";
$jmldata3	= number_format($jmldata3,0,',','.');

$tampil6    = mysql_query("SELECT * FROM debitur WHERE debitur.produk='MULTIGUNA' AND $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata4   = mysql_num_rows($tampil6);
$file4      = "lihat_booking.php";
$jmldata4	= number_format($jmldata4,0,',','.');

$tampil7    = mysql_query("SELECT * FROM debitur WHERE debitur.produk='OTO' AND $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata5   = mysql_num_rows($tampil7);
$file5      = "lihat_booking.php";
$jmldata5	= number_format($jmldata5,0,',','.');

$tampil8    = mysql_query("SELECT * FROM debitur WHERE debitur.produk='FLEKSI' AND $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata6   = mysql_num_rows($tampil8);
$file6      = "lihat_booking.php";
$jmldata6	= number_format($jmldata6,0,',','.');

$tampil9    = mysql_query("SELECT * FROM debitur WHERE debitur.produk='PINJAMAN PEGAWAI' AND $pilih LIKE 'AKTIF' AND LNC LIKE '$lnc' AND debitur.tgl_pk between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ORDER BY tgl_pk DESC ");
$jmldata7   = mysql_num_rows($tampil9);
$file7      = "lihat_booking.php";
$jmldata7	= number_format($jmldata7,0,',','.');
*/

//echo "<p>TOTAL DATA <b>$a dari LNC $lnc</b> : <b>$jmldata</b> DEBITUR </p>";
}
else{
// echo "<br><p class=style11><b>Maaf, data <b>$a $_GET[tgl_awal] S/D $_GET[tgl_akhir] dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b></p>";
}
}
?>
</div>
</div>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>