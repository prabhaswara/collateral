<?php include 'collateral_script/session_head.php'; ?>
<?php include 'collateral_script/head.php'; ?> 
<?php include 'collateral_script/db_function.php';?> 
<?php include 'collateral_script/function.php';?> 

<TITLE>MONITORING PRODUK</TITLE>
<div style="margin:0px 50px;text-align: left;">
<form method=get action=cari_produk.php>
  <tr>
  <td width="100">&nbsp;</td>
  <td>&nbsp; </td>
  </tr>
  <span class="style15">
  </span><span class="style15">
  </span><span class="style12">
  </span>  
    <p class="style10">
   <TR>
   <TD>
   <TR>
   <TD></p>
     <table width="100%" height="35" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
       <tr>
         <td width="14%" style="border-style: none; border-width: medium" height="33"> <input type=radio name=xxx checked>
           <span class="style14"> Nama LNC</span></td>
         <td width="86%" style="border-style: none; border-width: medium" height="33"> <font face="Arial">
           <?=selectLNC("LNC") ?>
         </font></td>
       </tr>
     </table>
     <table width="100%" height="35" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
       <tr>
         <td width="14%" style="border-style: none; border-width: medium" height="33"><input type=radio name=pilih value=produk checked>
           <span class="style14"> Nama Produk </span> <font face="Arial">&nbsp;</font> </td>
         <td width="86%" style="border-style: none; border-width: medium" height="33"> <font face="Arial">
           <?php
           $db_function=new db_function();
           $options=array();
            $data = $db_function->selectAllRows("select produk_nm from master_produk");
            foreach ($data as $row) {
                $options[$row["produk_nm"]] = $row["produk_nm"];
            }
            echo selectnya("cari", $options);
           ?>
          
</font></td>
       </tr>
     </table>     <p>&nbsp;</p></TD>
   </TR>
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

$sql="SELECT * FROM debitur WHERE debitur.no_pengikatan = 'PENDING' ".(($cari=="all")?"":"and $pilih = '$cari'")." 
".(($lnc=="all")?"":"AND LNC='$lnc'")." ORDER BY debitur.tgl_pk ";

$tampil= mysql_query($sql);
$jumlah= mysql_num_rows($tampil);

if ($jumlah > 0) {

echo "<p class=style10><b>MONITORING PENYELESAIAN SHT PER PRODUK</p></b>
    <table class='tblLookup' border='1px'>
<thead>
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
<td>$no</font></td>
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
<td align='center'><BLINK>$bbb</td>
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
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
<td align='center'><a href=edit_data_debitur.php?id=$r[no_rekg_pinjaman]>Edit
</td>
</tr>";
      $no++;
}


}
echo "</table>";

//Langkah 3
$tampil2    = "SELECT * FROM debitur WHERE debitur.no_pengikatan = 'PENDING' ".(($cari=="all")?"":"and $pilih = '$cari'")."
".(($lnc=="all")?"":"AND LNC='$lnc'")."";
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
echo "<p class=style2>Ditemukan <b>$jmldata</b> data debitur <b>LNC $lnc</b> yang produk nya: <b>$cari</b></p>";
}
else{
echo "<b><p class=style1>Maaf, data Penyelesaian SHT <b>$cari</b> dari <b>LNC $lnc</b> yang anda cari tidak ada pada database !!!</b>";
}
}
?>
</div>
</DIV>
