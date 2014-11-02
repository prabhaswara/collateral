<?php include 'collateral_script/session_head.php'; ?>
<?php include 'collateral_script/head.php'; ?> 
<?php include 'collateral_script/db_function.php';?> 
<?php include 'collateral_script/function.php';?> 
<TITLE>MONITORING SHT</TITLE>


<div style="margin:0px 50px;text-align: left;">
<form method=get action=cari_pending_ht.php>
  <table>
        <tr>
            <td>Nama LNC</td>
            <td><?=selectLNC("LNC") ?></td>
        </tr>
        <tr>
            <td>Hari Proses</td>
            <td><?=  inputnya("hariproses1","style='width:100px'")." s/d ".inputnya("hariproses2","style='width:100px'") ?> </td>
        </tr>
    </table>
   
  <p class="style11">
    <INPUT type=radio name=pilih value=no_pengikatan checked>
  Monitoring Penyelesaian SHT All <br>
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
mysql_select_db("collateral_db");

//Langkah 1
$batas   = 25000;
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

if($pilih == "no_pengikatan")
{
$a = "MONITORING PENYELESAIAN SHT ALL";
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
$tampil=mysql_query("SELECT * FROM debitur WHERE $pilih='PENDING' ".(($lnc=="all")?"":"AND LNC='$lnc'")."
                    $sqlHariProsses ORDER BY debitur.tgl_pk ASC LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<br><p class=style11><b>$a</b></p><table class='tblLookup' border='1px'>
<thead>
<tr>
<th>NO.</th>
<th width=20>NAMA LNC</th>
<th>NO. APLIKASI</th>
<th>NAMA DEBITUR</th>
<th widht=20>NO. REK. PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>MAKSIMUM KREDIT</th>
<th>NOTARIS</th>
<th>NILAI HT</th>
<th width=65>TGL. PK</th>
<th width=40>HARI PROSES</th>
<th width=65>STATUS</th>
<th width=10>ACTION</th></th>
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
$selisih=number_format($selisih,0,',','.');

if ($bbb==1){
    $bbb=$count;
}
else{
  $bbb = $ab;
}
	
if ($bbb=='PENDING'){	
Echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td align='center'>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='right'>$rupiah</td>
<td align='center'>$r[notaris]</td>
<td align='right'>$rupiah1</td>
<td align='center'>$r[tgl_pk]</td>
<td align='right'>$selisih</td>
<td align='center' style='color:red'>$bbb
</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}
else {	
Echo "
<tr bgcolor=$warna>
<td>$no</td>
<td align='center'>$r[LNC]</td>
<td align='center'>$r[NOAPLIKASI]</td>
<td>$r[NAMADEBITUR]</td>
<td align='right'>$r[no_rekg_pinjaman]</td>
<td align='center'>$r[produk]</td>
<td align='right'>$rupiah</td>
<td align='center'>$r[notaris]</td>
<td align='right'>$rupiah1</td>
<td align='center'>$r[tgl_pk]</td>
<td align='right'>$selisih</td>
<td align='center'>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}  
}
echo "</table>";


//Langkah 3 : Hitung total data dan halaman serta link 1,2,3
$tampil2    = mysql_query("SELECT * FROM debitur WHERE $pilih LIKE 'PENDING' ".(($lnc=="all")?"":"AND LNC='$lnc'")." $sqlHariProsses ORDER BY debitur.tgl_pk ASC");
$jmldata    = mysql_num_rows($tampil2);
$jmlhalaman = ceil($jmldata/$batas);
$file       = "cari_pending_ht.php";
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
echo "<p>TOTAL DATA <b>$a dari LNC $lnc</b> : <b>$jmldata</b> DEBITUR </p>";
}
else{
echo "<br><p class=style11><b>Maaf, data <b>$a dari LNC $lnc</b> yang anda cari tidak ada pada database !!!</b></p>";
}
}
?>
</div>
</div>