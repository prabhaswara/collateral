<?php include 'collateral_script/session_head.php'; ?>
<TITLE> SUMMARY </TITLE>
<head>
<link rel="shortcut icons" href="http://www.localhost/bnilogo.ico"/>
</head>
<div align="center">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Home</title> 
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {font-size: 12px}
body,td,th {
	font-size: 10px;
	color: #0000FF;
}
.style5 {font-size: 9px}
-->
</style>
</head> 
<link rel="stylesheet" type="text/css" href="y.css" /> 

</html> 
<br>
<style type="text/css">
<!--
body, td, th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
-->
</style>
<base target="_self">
<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
<p align="left" style="margin-top: 0; margin-bottom: 0"><b>
</b></p>
<p align="center" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
<p align="center" style="margin-top: 0; margin-bottom: 0"><strong><font size="4">
<a style="color:#000000;font-size:18px;text-decoration:blink;">SUMMARY PENDING PENYELESAIAN</a></font></strong></p>
<p align="center"><font size="5">
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
  </font>
</p>

<?php
$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("collateral_db");
//echo "Update : ";
//echo date('D, ');
//echo date('d/m/Y');

//echo "<br>CARI DEBITUR<a href=cari_debitur.php>
echo "<table>
<tr bgcolor=$warna>
<td align='center'><B>NO.</b></td>
<td align='center'><B>LNC</b></td>
<td align='center'><B>BPKB</b></td>
<td align='center'><B>AJB</b></td>
<td align='center'><B>SHT</b></td>
<td align='center'><B>POLIS ASURANSI JIWA</b></td>
<td align='center'><B>POLIS ASURANSI KERUGIAN</b></td>
<td align='center'><B>TOTAL</b></td>
<td align='center'><B>JUMLAH DEBITUR</b></td>
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

//Langkah Hitung total data debitur
$totalmdl     = mysql_query("SELECT * FROM debitur where debitur.LNC='MDL' AND debitur.status_rekg='AKTIF'");
$jmldatamdl     = mysql_num_rows($totalmdl);
$jmldatamdl     = number_format($jmldatamdl,0,',','.');

//HITUNG PENDING LNC MDL
//1. Langkah hitung total data pending BPKB 
$bpkb         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='MDL'");
$jmlbpkb      = mysql_num_rows($bpkb);
//2. Langkah hitung total data pending AJB 
$ajb         = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='MDL'");
$jmlajb      = mysql_num_rows($ajb);
//3. Langkah hitung total data pending notaris 
$notaris     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='MDL'");
$jmlnotaris  = mysql_num_rows($notaris);
//4. Langkah hitung total data pending asuransi jiwa
$assjiwa     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='MDL'");
$jmlassjiwa  = mysql_num_rows($assjiwa);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' 
AND debitur.LNC='MDL'");
$jmlasskerugian  = mysql_num_rows($asskerugian);
//6. Langkah menjumlahkan total data all pending
$all= $jmlbpkb+$jmlasskerugian + $jmlassjiwa + $jmlnotaris + $jmlajb;


//Langkah Hitung total data debitur
$totalpnl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='PNL' AND debitur.status_rekg='AKTIF'");
$jmldatapnl     = mysql_num_rows($totalpnl);
$jmldatapnl     = number_format($jmldatapnl,0,',','.');

//HITUNG PENDING LNC PNL
//1. Langkah hitung total data pending BPKB 
$bpkb1         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='PNL'");
$jmlbpkb1      = mysql_num_rows($bpkb1);
//2. Langkah hitung total data pending AJB 
$ajb1        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='PNL'");
$jmlajb1      = mysql_num_rows($ajb1);
//3. Langkah hitung total data pending notaris PNL 
$notaris1     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='PNL'");
$jmlnotaris1  = mysql_num_rows($notaris1);
//4. Langkah hitung total data pending asuransi jiwa PNL
$assjiwa1     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='PNL'");
$jmlassjiwa1  = mysql_num_rows($assjiwa1);
//5. Langkah hitung total data pending asuransi kerugian PNL
$asskerugian1     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='PNL'");
$jmlasskerugian1  = mysql_num_rows($asskerugian1);
//6. Langkah menjumlahkan total data all pending
$all1= $jmlbpkb1+$jmlasskerugian1 + $jmlassjiwa1 + $jmlnotaris1 + $jmlajb1;


//Langkah Hitung total data debitur
$totalpll     	= mysql_query("SELECT * FROM debitur where debitur.LNC='PLL' AND debitur.status_rekg='AKTIF'");
$jmldatapll     = mysql_num_rows($totalpll);
$jmldatapll     = number_format($jmldatapll,0,',','.');

//HITUNG PENDING LNC PLL
//1. Langkah hitung total data pending BPKB 
$bpkb2         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='PLL'");
$jmlbpkb2      = mysql_num_rows($bpkb2);
//2. Langkah hitung total data pending AJB 
$ajb2        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='PLL'");
$jmlajb2      = mysql_num_rows($ajb2);
//3. Langkah hitung total data pending notaris
$notaris2     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='PLL'");
$jmlnotaris2  = mysql_num_rows($notaris2);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa2     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='PLL'");
$jmlassjiwa2  = mysql_num_rows($assjiwa2);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian2     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='PLL'");
$jmlasskerugian2  = mysql_num_rows($asskerugian2);
//6. Langkah menjumlahkan total data all pending
$all2= $jmlbpkb2+$jmlasskerugian2 + $jmlassjiwa2 + $jmlnotaris2 + $jmlajb2;

//Langkah Hitung total data debitur
$totalbal     	= mysql_query("SELECT * FROM debitur where debitur.LNC='BAL' AND debitur.status_rekg='AKTIF'");
$jmldatabal     = mysql_num_rows($totalbal);
$jmldatabal     = number_format($jmldatabal,0,',','.');

//HITUNG PENDING LNC BAL
//1. Langkah hitung total data pending BPKB 
$bpkb3         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='BAL'");
$jmlbpkb3      = mysql_num_rows($bpkb3);
//2. Langkah hitung total data pending AJB 
$ajb3        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='BAL'");
$jmlajb3      = mysql_num_rows($ajb3);
//3. Langkah hitung total data pending notaris
$notaris3     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='BAL'");
$jmlnotaris3  = mysql_num_rows($notaris3);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa3     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='BAL'");
$jmlassjiwa3  = mysql_num_rows($assjiwa3);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian3     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='BAL'");
$jmlasskerugian3  = mysql_num_rows($asskerugian3);
//6. Langkah menjumlahkan total data all pending
$all3= $jmlbpkb3 + $jmlasskerugian3 + $jmlassjiwa3 + $jmlnotaris3 + $jmlajb3;
//$all3= number_format($all3,0,',','.');

//Langkah Hitung total data debitur
$totalsml     	= mysql_query("SELECT * FROM debitur where debitur.LNC='SML' AND debitur.status_rekg='AKTIF'");
$jmldatasml     = mysql_num_rows($totalsml);
$jmldatasml     = number_format($jmldatasml,0,',','.');

//HITUNG PENDING LNC SML
//1. Langkah hitung total data pending BPKB 
$bpkb4         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='SML'");
$jmlbpkb4      = mysql_num_rows($bpkb4);
//2. Langkah hitung total data pending AJB 
$ajb4        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='SML'");
$jmlajb4      = mysql_num_rows($ajb4);
//3. Langkah hitung total data pending notaris
$notaris4     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='SML'");
$jmlnotaris4  = mysql_num_rows($notaris4);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa4     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='SML'");
$jmlassjiwa4  = mysql_num_rows($assjiwa4);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian4     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='SML'");
$jmlasskerugian4  = mysql_num_rows($asskerugian4);
//6. Langkah menjumlahkan total data all pending
$all4= $jmlbpkb4+$jmlasskerugian4 + $jmlassjiwa4 + $jmlnotaris4 + $jmlajb4;

//Langkah Hitung total data debitur
$totalygl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='YGL' AND debitur.status_rekg='AKTIF'");
$jmldataygl     = mysql_num_rows($totalygl);
$jmldataygl     = number_format($jmldataygl,0,',','.');

//HITUNG PENDING LNC YGL
//1. Langkah hitung total data pending BPKB 
$bpkb5         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='YGL'");
$jmlbpkb5      = mysql_num_rows($bpkb5);
//2. Langkah hitung total data pending AJB 
$ajb5        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='YGL'");
$jmlajb5      = mysql_num_rows($ajb5);
//3. Langkah hitung total data pending notaris
$notaris5     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='YGL'");
$jmlnotaris5  = mysql_num_rows($notaris5);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa5     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='YGL'");
$jmlassjiwa5  = mysql_num_rows($assjiwa5);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian5     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='YGL'");
$jmlasskerugian5  = mysql_num_rows($asskerugian5);
//6. Langkah menjumlahkan total data all pending
$all5= $jmlbpkb5+$jmlasskerugian5 + $jmlassjiwa5 + $jmlnotaris5 + $jmlajb5;

//Langkah Hitung total data debitur
$totalsbl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='SBL' AND debitur.status_rekg='AKTIF'");
$jmldatasbl     = mysql_num_rows($totalsbl);
$jmldatasbl     = number_format($jmldatasbl,0,',','.');

//HITUNG PENDING LNC SBL
//1. Langkah hitung total data pending BPKB 
$bpkb6         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='SBL'");
$jmlbpkb6      = mysql_num_rows($bpkb6);
//2. Langkah hitung total data pending AJB 
$ajb6        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='SBL'");
$jmlajb6      = mysql_num_rows($ajb6);
//3. Langkah hitung total data pending notaris
$notaris6     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='SBL'");
$jmlnotaris6  = mysql_num_rows($notaris6);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa6     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='SBL'");
$jmlassjiwa6  = mysql_num_rows($assjiwa6);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian6     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='SBL'");
$jmlasskerugian6  = mysql_num_rows($asskerugian6);
//6. Langkah menjumlahkan total data all pending
$all6= $jmlbpkb6+$jmlasskerugian6 + $jmlassjiwa6 + $jmlnotaris6 + $jmlajb6;

//Langkah Hitung total data debitur
$totaldpl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='DPL' AND debitur.status_rekg='AKTIF'");
$jmldatadpl     = mysql_num_rows($totaldpl);
$jmldatadpl     = number_format($jmldatadpl,0,',','.');

//HITUNG PENDING LNC DPL
//1. Langkah hitung total data pending BPKB 
$bpkb7         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='DPL'");
$jmlbpkb7      = mysql_num_rows($bpkb7);
//2. Langkah hitung total data pending AJB 
$ajb7        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='DPL'");
$jmlajb7      = mysql_num_rows($ajb7);
//3. Langkah hitung total data pending notaris
$notaris7     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='DPL'");
$jmlnotaris7  = mysql_num_rows($notaris7);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa7     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='DPL'");
$jmlassjiwa7  = mysql_num_rows($assjiwa7);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian7     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='DPL'");
$jmlasskerugian7  = mysql_num_rows($asskerugian7);
//6. Langkah menjumlahkan total data all pending
$all7= $jmlbpkb7+$jmlasskerugian7 + $jmlassjiwa7 + $jmlnotaris7 + $jmlajb7;

//Langkah Hitung total data debitur
$totalbjl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='BJL' AND debitur.status_rekg='AKTIF'");
$jmldatabjl     = mysql_num_rows($totalbjl);
$jmldatabjl     = number_format($jmldatabjl,0,',','.');

//HITUNG PENDING LNC BJL
//1. Langkah hitung total data pending BPKB 
$bpkb8         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='BJL'");
$jmlbpkb8      = mysql_num_rows($bpkb8);
//2. Langkah hitung total data pending AJB 
$ajb8        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='BJL'");
$jmlajb8      = mysql_num_rows($ajb8);
//3. Langkah hitung total data pending notaris
$notaris8     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='BJL'");
$jmlnotaris8  = mysql_num_rows($notaris8);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa8     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='BJL'");
$jmlassjiwa8  = mysql_num_rows($assjiwa8);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian8     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='BJL'");
$jmlasskerugian8  = mysql_num_rows($asskerugian8);
//6. Langkah menjumlahkan total data all pending
$all8= $jmlbpkb8+$jmlasskerugian8 + $jmlassjiwa8 + $jmlnotaris8 + $jmlajb8;

//Langkah Hitung total data debitur
$totalmkl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='MKL' AND debitur.status_rekg='AKTIF'");
$jmldatamkl     = mysql_num_rows($totalmkl);
$jmldatamkl     = number_format($jmldatamkl,0,',','.');

//HITUNG PENDING LNC MKL
//1. Langkah hitung total data pending BPKB 
$bpkb9         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='MKL'");
$jmlbpkb9      = mysql_num_rows($bpkb9);
//2. Langkah hitung total data pending AJB 
$ajb9        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='MKL'");
$jmlajb9      = mysql_num_rows($ajb9);
//3. Langkah hitung total data pending notaris
$notaris9     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='MKL'");
$jmlnotaris9  = mysql_num_rows($notaris9);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa9     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='MKL'");
$jmlassjiwa9  = mysql_num_rows($assjiwa9);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian9     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='MKL'");
$jmlasskerugian9  = mysql_num_rows($asskerugian9);
//6. Langkah menjumlahkan total data all pending
$all9= $jmlbpkb9+$jmlasskerugian9 + $jmlassjiwa9 + $jmlnotaris9 + $jmlajb9;

//Langkah Hitung total data debitur
$totalmnl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='MNL' AND debitur.status_rekg='AKTIF'");
$jmldatamnl     = mysql_num_rows($totalmnl);
$jmldatamnl     = number_format($jmldatamnl,0,',','.');

//HITUNG PENDING LNC MNL
//1. Langkah hitung total data pending BPKB 
$bpkb10         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='MNL'");
$jmlbpkb10      = mysql_num_rows($bpkb10);
//2. Langkah hitung total data pending AJB 
$ajb10        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='MNL'");
$jmlajb10      = mysql_num_rows($ajb10);
//3. Langkah hitung total data pending notaris
$notaris10     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='MNL'");
$jmlnotaris10  = mysql_num_rows($notaris10);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa10     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='MNL'");
$jmlassjiwa10  = mysql_num_rows($assjiwa10);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian10     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='MNL'");
$jmlasskerugian10  = mysql_num_rows($asskerugian10);
//6. Langkah menjumlahkan total data all pending
$all10= $jmlbpkb10+$jmlasskerugian10 + $jmlassjiwa10 + $jmlnotaris10 + $jmlajb10;

//Langkah Hitung total data debitur
$totaljkl     	= mysql_query("SELECT * FROM debitur where debitur.LNC='JKL' AND debitur.status_rekg='AKTIF'");
$jmldatajkl     = mysql_num_rows($totaljkl);
$jmldatajkl     = number_format($jmldatajkl,0,',','.');

//HITUNG PENDING LNC JKL
//1. Langkah hitung total data pending BPKB 
$bpkb11         = mysql_query("SELECT debitur.no_bpkb FROM debitur WHERE debitur.no_bpkb='PENDING' 
AND debitur.LNC='JKL'");
$jmlbpkb11      = mysql_num_rows($bpkb11);
//2. Langkah hitung total data pending AJB 
$ajb11        = mysql_query("SELECT debitur.no_ajb FROM debitur WHERE debitur.no_ajb='PENDING' 
AND debitur.LNC='JKL'");
$jmlajb11      = mysql_num_rows($ajb11);
//3. Langkah hitung total data pending notaris
$notaris11     = mysql_query("SELECT debitur.no_pengikatan FROM debitur WHERE debitur.no_pengikatan='PENDING' 
AND debitur.LNC='JKL'");
$jmlnotaris11  = mysql_num_rows($notaris11);
//4. Langkah hitung total data pending asuransi jiwa 
$assjiwa11     = mysql_query("SELECT debitur.no_polis_ass_jiwa FROM debitur WHERE debitur.no_polis_ass_jiwa='PENDING' 
AND debitur.LNC='JKL'");
$jmlassjiwa11  = mysql_num_rows($assjiwa11);
//5. Langkah hitung total data pending asuransi kerugian
$asskerugian11     = mysql_query("SELECT debitur.no_polis_ass_kerugian FROM debitur WHERE debitur.no_polis_ass_kerugian='PENDING' AND debitur.LNC='JKL'");
$jmlasskerugian11  = mysql_num_rows($asskerugian11);
//$jmlasskerugian11   = number_format($jmlasskerugian11,0,',','.');
//6. Langkah menjumlahkan total data all pending
$all11	 = $jmlbpkb11+$jmlasskerugian11 + $jmlassjiwa11 + $jmlnotaris11 + $jmlajb11;
//$all11   = number_format($all11,0,',','.');

// Langkah membaca semua LNC
$lnc   = 'MDL';
$lnc1  = 'PNL';
$lnc2  = 'PLL';
$lnc3  = 'BAL';
$lnc4  = 'SML';
$lnc5  = 'YGL';
$lnc6  = 'SBL';
$lnc7  = 'DPL';
$lnc8  = 'BJL';
$lnc9  = 'MKL';
$lnc10 = 'MNL';
$lnc11 = 'JKL';

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc</td>
<td align='center' width=120>$jmlbpkb</td>
<td align='center' width=120>$jmlajb</td>
<td align='center' width=120>$jmlnotaris</td>
<td align='center' width=120>$jmlassjiwa</td>
<td align='center' width=120>$jmlasskerugian</td>
<td align='center' width=120>$all</td>
<td align='center' width=120>$jmldatamdl</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc1</td>
<td align='center' width=120>$jmlbpkb1</td>
<td align='center' width=120>$jmlajb1</td>
<td align='center' width=120>$jmlnotaris1</td>
<td align='center' width=120>$jmlassjiwa1</td>
<td align='center' width=120>$jmlasskerugian1</td>
<td align='center' width=120>$all1</td>
<td align='center' width=120>$jmldatapnl</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc2</td>
<td align='center' width=120>$jmlbpkb2</td>
<td align='center' width=120>$jmlajb2</td>
<td align='center' width=120>$jmlnotaris2</td>
<td align='center' width=120>$jmlassjiwa2</td>
<td align='center' width=120>$jmlasskerugian2</td>
<td align='center' width=120>$all2</td>
<td align='center' width=120>$jmldatapll</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc3</td>
<td align='center' width=120>$jmlbpkb3</td>
<td align='center' width=120>$jmlajb3</td>
<td align='center' width=120>$jmlnotaris3</td>
<td align='center' width=120>$jmlassjiwa3</td>
<td align='center' width=120>$jmlasskerugian3</td>
<td align='center' width=120>$all3</td>
<td align='center' width=120>$jmldatabal</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc4</td>
<td align='center' width=120>$jmlbpkb4</td>
<td align='center' width=120>$jmlajb4</td>
<td align='center' width=120>$jmlnotaris4</td>
<td align='center' width=120>$jmlassjiwa4</td>
<td align='center' width=120>$jmlasskerugian4</td>
<td align='center' width=120>$all4</td>
<td align='center' width=120>$jmldatasml</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc5</td>
<td align='center' width=120>$jmlbpkb5</td>
<td align='center' width=120>$jmlajb5</td>
<td align='center' width=120>$jmlnotaris5</td>
<td align='center' width=120>$jmlassjiwa5</td>
<td align='center' width=120>$jmlasskerugian5</td>
<td align='center' width=120>$all5</td>
<td align='center' width=120>$jmldataygl</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc6</td>
<td align='center' width=120>$jmlbpkb6</td>
<td align='center' width=120>$jmlajb6</td>
<td align='center' width=120>$jmlnotaris6</td>
<td align='center' width=120>$jmlassjiwa6</td>
<td align='center' width=120>$jmlasskerugian6</td>
<td align='center' width=120>$all6</td>
<td align='center' width=120>$jmldatasbl</td>
</tr>";
      $no++;
Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc7</td>
<td align='center' width=120>$jmlbpkb7</td>
<td align='center' width=120>$jmlajb7</td>
<td align='center' width=120>$jmlnotaris7</td>
<td align='center' width=120>$jmlassjiwa7</td>
<td align='center' width=120>$jmlasskerugian7</td>
<td align='center' width=120>$all7</td>
<td align='center' width=120>$jmldatadpl</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc8</td>
<td align='center' width=120>$jmlbpkb8</td>
<td align='center' width=120>$jmlajb8</td>
<td align='center' width=120>$jmlnotaris8</td>
<td align='center' width=120>$jmlassjiwa8</td>
<td align='center' width=120>$jmlasskerugian8</td>
<td align='center' width=120>$all8</td>
<td align='center' width=120>$jmldatabjl</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc9</td>
<td align='center' width=120>$jmlbpkb9</td>
<td align='center' width=120>$jmlajb9</td>
<td align='center' width=120>$jmlnotaris9</td>
<td align='center' width=120>$jmlassjiwa9</td>
<td align='center' width=120>$jmlasskerugian9</td>
<td align='center' width=120>$all9</td>
<td align='center' width=120>$jmldatamkl</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc10</td>
<td align='center' width=120>$jmlbpkb10</td>
<td align='center' width=120>$jmlajb10</td>
<td align='center' width=120>$jmlnotaris10</td>
<td align='center' width=120>$jmlassjiwa10</td>
<td align='center' width=120>$jmlasskerugian10</td>
<td align='center' width=120>$all10</td>
<td align='center' width=120>$jmldatamnl</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc11</td>
<td align='center' width=100>$jmlbpkb11</td>
<td align='center' width=100>$jmlajb11</td>
<td align='center' width=100>$jmlnotaris11</td>
<td align='center' width=100>$jmlassjiwa11</td>
<td align='center' width=100>$jmlasskerugian11</td>
<td align='center' width=100>$all11</td>
<td align='center' width=100>$jmldatajkl</td>
</tr>";
      $no++;
	  
$bpkbx   = $jmlbpkb + $jmlbpkb1 + $jmlbpkb2 + $jmlbpkb3 + $jmlbpkb4 + $jmlbpkb5 + 
           $jmlbpkb6 + $jmlbpkb7 + $jmlbpkb8+ $jmlbpkb9 + $jmlbpkb10 + $jmlbpkb11;
$bpkbx   = number_format($bpkbx,0,',','.');

$ajbx    = $jmlajb + $jmlajb1 + $jmlajb2 + $jmlajb3 + $jmlajb4 + $jmlajb5 + 
           $jmlajb6 + $jmlajb7 + $jmlajb8+ $jmlajb9 + $jmlajb10 + $jmlajb11;
$ajbx    = number_format($ajbx,0,',','.');

$notx    = $jmlnotaris + $jmlnotaris1 + $jmlnotaris2 + $jmlnotaris3 + $jmlnotaris4 +
           $jmlnotaris5 + $jmlnotaris6 + $jmlnotaris7 + $jmlnotaris8 + $jmlnotaris9 +
		   $jmlnotaris10 + $jmlnotaris11;
$notx    = number_format($notx,0,',','.');

$jwx     = $jmlassjiwa + $jmlassjiwa1 + $jmlassjiwa2 + $jmlassjiwa3 + $jmlassjiwa4 + 
           $jmlassjiwa5 + $jmlassjiwa6 + $jmlassjiwa7 + $jmlassjiwa8 + $jmlassjiwa9 + 
		   $jmlassjiwa10 + $jmlassjiwa11;
$jwx     = number_format($jwx,0,',','.');

$krgx    = $jmlasskerugian + $jmlasskerugian1 + $jmlasskerugian2 + $jmlasskerugian3 +
           $jmlasskerugian4 + $jmlasskerugian5 + $jmlasskerugian6 + $jmlasskerugian7 +
		   $jmlasskerugian8 + $jmlasskerugian9 + $jmlasskerugian10 + $jmlasskerugian11; 
$krgx    = number_format($krgx,0,',','.');

$allx    = $all + $all1 + $all2 + $all3 + $all4 + $all5 + $all6 + $all7 + $all8 + $all9 +
           $all10 + $all11;
$allx    = number_format($allx,0,',','.');

//$jmldatalnc    = $jmldatamdl + $jmldatapnl + $jmldatapll + $jmldatabal + $jmldatasml + $jmldataygl + $jmldatasbl + $jmldatadpl + $jmldatabjl + $jmldatamkl +
//                 $jmldatamnl + $jmldatajkl;
//$jmldatalnc    = number_format($jmldatalnc,0,',','.');

//Langkah Hitung total data debitur
$tampil20     = mysql_query("SELECT * FROM debitur");
$jmldatax     = mysql_num_rows($tampil20);
$jmldatax     = number_format($jmldatax,0,',','.');

Echo "
<tr bgcolor=$warna>
<td colspan='2'><b>TOTAL</b></td>
<td align='center' width=100><b>$bpkbx</b></td>
<td align='center' width=100><b>$ajbx</b></td>
<td align='center' width=100><b>$notx</b></td>
<td align='center' width=100><b>$jwx</b></td>
<td align='center' width=100><b>$krgx</b></td>
<td align='center' width=100><b>$allx</b></td>
<td align='center' width=100><b>$jmldatax</b></td>
</tr>";
      $no++;

//}
echo "<br></table>";
//$date=date('Y-mm-d');'<br>';
//Langkah Hitung total data debitur
$tampil20     = mysql_query("SELECT * FROM debitur");
$jmldatax     = mysql_num_rows($tampil20);
$jmldatax     = number_format($jmldatax,0,',','.');
//echo "<p>Total data debitur yang berada di database : <b>$jmldatax</b> orang </p>";

echo "<b>CADS VER : 1.0</b><br>";
echo "<a href='legalitas.php'>LEGALITAS";
?>
</div>
