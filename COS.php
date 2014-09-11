<TITLE> SUMMARY </TITLE>
<style type="text/css">
<!--
.style4 {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 22px;
}
-->
</style>
<p align="LEFT">MAINTENANCE</p>
<p align="center"><strong>SUMMARY MONITORING PENDING</strong>     <BR>
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
</p>
<div align="center">
  <?php
$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("collateral_db");

//echo "<br>CARI DEBITUR<a href=cari_debitur.php>
echo "<table>
<tr bgcolor=$warna2>
<td>NO.</td>
<td>LNC</td>
<td>AJB</td>
<td>SHT</td>
<td>ASURANSI JIWA</td>
<td>ASURANSI KERUGIAN</td>
</tr>";

//lANGKAH 1 : Tentukan batas, crk halaman $ posisi data
//$batas   = 30;
//$halaman = $_GET['halaman'];
//if(empty($halaman)) {
//   $posisi   = 0;
//   $halaman  = 1;
//}
//else{
//     $posisi = ($halaman-1) * $batas;   
//}
//$sql=mysql_query("SELECT * FROM debitur LIMIT $posisi, $batas");

$no=1;
//While ($lnc=mysql_fetch_array($sql)){
//if($warna == $warna1){
//   $warna = $warna2;
//}
//else{
//  $warna = $warna1;
//}

//1. Langkah hitung total data pending AJB 
$ajb         = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING'");
$jmlajb      = mysql_num_rows($ajb);

//2. Langkah hitung total data pending notaris 
$notaris     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING'");
$jmlnotaris  = mysql_num_rows($notaris);

//3. Langkah hitung total data pending asuransi jiwa
$assjiwa     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING'");
$jmlassjiwa     = mysql_num_rows($assjiwa);

//4. Langkah hitung total data pending asuransi kerugian
$asskerugian = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING'");
$jmlasskerugian  = mysql_num_rows($asskerugian);


//5. Langkah conditional Nama LNC
$lnc  = 'MDL';
$lnc1 = 'PBL';
$lnc2 = 'PLL';
$lnc3 = 'BAL';
$lnc4 = 'SML';
$lnc5 = 'YGL';
$lnc6 = 'SBL';
$lnc7 = 'DPL';
$lnc8 = 'BJL';
$lnc9 = 'MKL';
$lnc10 = 'MNL';
$lnc11 = 'JKL';

Echo "
<tr bgcolor=$warna>
<td align='center'>$no</td>
<td align='center'>$lnc1</td>
<td align='right'>$jmlajb</td>
<td align='right'>$jmlnotaris</td>
<td align='right'>$jmlassjiwa</td>
<td align='right'>$jmlasskerugian</td>
</tr>";

      $no++;
//}
echo "</table>";

//echo "<p>Total Debitur : <b>$jmlnotaris</b> orang </p>";
?>
</div>
<p>&nbsp;</p>
<p><a href="mailto:dicky_garkiyadi@yahoo.com">SENT MAIL</a></p>
