<?php include 'collateral_script/session_head.php'; ?>
<?php include 'collateral_script/head.php'; ?> 
<?php include 'collateral_script/db_function.php';?> 
<?php include 'collateral_script/function.php';?> 
<?php include 'collateral_script/list_dropdown.php';?> 

<TITLE> PENDING POLIS ASS. JIWA </TITLE>
<?php include 'collateral_script/head.php'; ?> 
<div style="margin:0px 50px;text-align: left;">
    
<form method=get action=cari_ass_jiwa.php>
    
    <table>
        <tr>
            <td>Nama LNC</td>
            <td><?=selectLNC("LNC") ?></td>
        </tr>
        <tr>
            <td>Nama AsuransiJiwa</td>
            <td>
            <?php echo selectnya("cari",$ListAsuransiJiwa,"b") ?>
            </td>
        </tr>
        <tr>
            <td>Hari Proses</td>
            <td><?=  inputnya("hariproses1","style='width:100px'")." s/d ".inputnya("hariproses2","style='width:100px'") ?> </td>
        </tr>
    </table>
  <p class="style1">
    <input type=radio name=pilih value=asuransi_jiwa checked>
   Monitoring Penyelesaian Polis Asuransi Jiwa
  
  </p>
  
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

$sqlHariProsses="";
if(intval($_GET['hariproses1'])&&intval($_GET['hariproses2']))
{
    $sqlHariProsses=" and DATEDIFF(now(),tgl_pk) >= ".$_GET['hariproses1']." and DATEDIFF(now(),tgl_pk) <= ".$_GET['hariproses2'];
}

$tampil= mysql_query("SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.no_polis_ass_jiwa = 'PENDING' ".(($lnc=="all")?"":"AND LNC='$lnc'")." $sqlHariProsses ORDER BY debitur.tgl_pk ASC LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<p class=style5><b>MONITORING PENYELESAIAN POLIS ASURANSI JIWA</b></p><table class='tblLookup' border='1px'>
<thead>

<tr>
<th >NO.</th>
<th width=20>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=20>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>NILAI PERTANGGUNGAN</th>
<th>ASURANSI</th>
<th>PREMI</th>
<th width=65>TGL. PK</th>
<th width=40>HARI PROSES</th>
<th width=65>STATUS</th>
<th>ACTION</th></th>
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

$aaa = 30;
$bbb = $selisih > $aaa;

$ab  = "IN PROGRESS";
$count = "PENDING";

$max = $r['nilai_pertanggungan_ass_jiwa'];
$nht = $r['premi_jiwa'];
$rupiah=number_format($max,0,',','.');
$rupiah1=number_format($nht,0,',','.');
$slsh=number_format($selisih,0,',','.');

$allx  = "(SELECT sum(maksimum_kredit) FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.no_polis_ass_jiwa = 'PENDING' ".(($lnc=="all")?"":"AND LNC='$lnc'")." $sqlHariProsses)";

if ($bbb==1){
    $bbb=$count;
}
else{
  $bbb = $ab;
}

if ($bbb=='PENDING'){

echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='right'>$rupiah</td>
<td align='center'>$r[asuransi_jiwa]</td>
<td align='right'>$rupiah1</td>
<td align='center'>$r[tgl_pk]</td>
<td align='right'>$slsh</td>
<td align='center' style='color:red'>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
else {
echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='right'>$rupiah</td>
<td align='center'>$r[asuransi_jiwa]</td>
<td align='right'>$rupiah1</td>
<td align='center'>$r[tgl_pk]</td>
<td align='right'>$slsh</td>
<td align='center'>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
}
echo "</table>";

//Langkah 3
$tampil2    = "SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.no_polis_ass_jiwa = 'PENDING' ".(($lnc=="all")?"":"AND LNC='$lnc'")." $sqlHariProsses ORDER BY debitur.tgl_pk ASC";


$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);
$jmldata	= number_format($jmldata,0,',','.');

//echo "<br>Halaman : ";
//$file = "cari_ass_jiwa.php";
//for($i=1;$i<=$jmlhalaman;$i++)
// if ($i !=$halaman) {
//echo "<a href='$file?halaman=$i&$pilih=$cari&oke=$oke'>$i</A> | ";
//}
//else{
//echo "<b>$i</b> | ";
//}
echo "<p>Total Data <b>LNC $lnc</b> : <b>$jmldata</b> debitur yang ditanggung oleh Asuransi : <b>$cari</b></p>";
}
else{
echo "<b><p class=style1>Maaf, data <b>MONITORING PENYELESAIAN ASURANSI JIWA</b> dari <b>LNC $lnc</b> yang anda cari tidak ada pada database !!!</b>";
}
}
?>
</div>
</div>