<TITLE>LEGALITAS</TITLE>
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
<body> 
<div id="wrap"> 
<div align='center'>
  <p>&nbsp;</p>
  <p><b><font size="3" color="#009999"><a href="summary.php">MENU UTAMA</a><a href="maint.htm"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="cads_menu.htm">CADS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="maint.htm">DATABASE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="menu_laporan.htm">REPORTING</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="help.htm">HELP</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logout.htm">LOGOUT</a></font></b></p>
</div>
<div class="style1" id="menu"></div>
</div> 

</body> 
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
$warna1 = "#FF9900";   // baris genap berwarna Orange tua
$warna2 = "#FFCC66";   // baris ganjil berwarna Orange muda
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
<td align='center'><B>IMB</b></td>
<td align='center'><B>SIUP</b></td>
<td align='center'><B>TDP</b></td>
<td align='center'><B>OTHERS</b></td>
<td align='center'><B>TOTAL</b></td>
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

//HITUNG PENDING LNC MDL
//1. Langkah hitung total data pending IMB 
$imb         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='MDL'");
$jmlimb      = mysql_num_rows($imb);
//2. Langkah hitung total data pending SIUP 
$siup        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING'  
AND debitur.LNC='MDL'");
$jmlsiup     = mysql_num_rows($siup);
//3. Langkah hitung total data pending TDP 
$tdp         = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='MDL'");
$jmltdp  	 = mysql_num_rows($tdp);
//4. Langkah hitung total data pending OTHERS
$others     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='MDL'");
$jmlothers 	= mysql_num_rows($others);
//5. Langkah menjumlahkan total data all pending
$all= $jmlimb + $jmlsiup + $jmltdp + $jmlothers;

//HITUNG PENDING LNC PNL
//1. Langkah hitung total data pending IMB 
$imb1         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='PNL'");
$jmlimb1      = mysql_num_rows($imb1);
//2. Langkah hitung total data pending SIUP 
$siup1        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='PNL'");
$jmlsiup1      = mysql_num_rows($siup1);
//3. Langkah hitung total data pending TDP 
$tdp1     	= mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='PNL'");
$jmltdp1  	= mysql_num_rows($tdp1);
//4. Langkah hitung total data pending OTHERS
$others1    = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='PNL'");
$jmlothers1  = mysql_num_rows($others1);
//5. Langkah menjumlahkan total data all pending
$all1= $jmlimb1 + $jmlsiup1 + $jmltdp1 + $jmlothers1;


//HITUNG PENDING LNC PLL
//1. Langkah hitung total data pending IMB 
$imb2         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='PLL'");
$jmlimb2      = mysql_num_rows($imb2);
//2. Langkah hitung total data pending SIUP 
$siup2        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='PLL'");
$jmlsiup2      = mysql_num_rows($siup2);
//3. Langkah hitung total data pending TDP
$tdp2     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='PLL'");
$jmltdp2  = mysql_num_rows($tdp2);
//4. Langkah hitung total data pending OTHERS 
$others2     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='PLL'");
$jmlothers2  = mysql_num_rows($others2);
//5. Langkah menjumlahkan total data all pending
$all2 = $jmlimb2 + $jmlsiup2 + $jmltdp2 + $jmlothers2;

//HITUNG PENDING LNC BAL
//1. Langkah hitung total data pending IMB 
$imb3         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='BAL'");
$jmlimb3      = mysql_num_rows($imb3);
//2. Langkah hitung total data pending SIUP 
$siup3        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='BAL'");
$jmlsiup3      = mysql_num_rows($siup3);
//3. Langkah hitung total data pending TDP
$tdp3     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='BAL'");
$jmltdp3  = mysql_num_rows($tdp3);
//4. Langkah hitung total data pending others 
$others3     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='BAL'");
$jmlothers3  = mysql_num_rows($others3);
//5. Langkah menjumlahkan total data all pending
$all3= $jmlimb3 + $jmlsiup3 + $jmltdp3 + $jmlothers3;
//$all3= number_format($all3,0,',','.');

//HITUNG PENDING LNC SML
//1. Langkah hitung total data pending IMB
$imb4         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='SML'");
$jmlimb4      = mysql_num_rows($imb4);
//2. Langkah hitung total data pending SIUP 
$siup4        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='SML'");
$jmlsiup4      = mysql_num_rows($siup4);
//3. Langkah hitung total data pending tdp
$tdp4     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='SML'");
$jmltdp4  = mysql_num_rows($tdp4);
//4. Langkah hitung total data pending others 
$others4     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='SML'");
$jmlothers4  = mysql_num_rows($others4);
//5. Langkah menjumlahkan total data all pending
$all4= $jmlimb4+$jmlsiup4 + $jmlsiup4 + $jmltdp4 + $jmlothers4;

//HITUNG PENDING LNC YGL
//1. Langkah hitung total data pending IMB
$imb5         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='YGL'");
$jmlimb5      = mysql_num_rows($imb5);
//2. Langkah hitung total data pending SIUP 
$siup5        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='YGL'");
$jmlsiup5      = mysql_num_rows($siup5);
//3. Langkah hitung total data pending TDP
$tdp5     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='YGL'");
$jmltdp5  = mysql_num_rows($tdp5);
//4. Langkah hitung total data pending OTHERS 
$others5     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='YGL'");
$jmlothers5  = mysql_num_rows($others5);
//5. Langkah menjumlahkan total data all pending
$all5= $jmlimb5+$jmlsiup5 + $jmltdp5 + $jmlothers5;

//HITUNG PENDING LNC SBL
//1. Langkah hitung total data pending IMB 
$imb6         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='SBL'");
$jmlimb6      = mysql_num_rows($imb6);
//2. Langkah hitung total data pending SIUP 
$siup6        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='SBL'");
$jmlsiup6      = mysql_num_rows($siup6);
//3. Langkah hitung total data pending TDP
$tdp6     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='SBL'");
$jmltdp6  = mysql_num_rows($tdp6);
//4. Langkah hitung total data pending others 
$others6     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='SBL'");
$jmlothers6  = mysql_num_rows($others6);
//5. Langkah menjumlahkan total data all pending
$all6= $jmlimb6+$jmlsiup6 + $jmltdp6 + $jmlothers6;

//HITUNG PENDING LNC DPL
//1. Langkah hitung total data pending IMB
$imb7         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='DPL'");
$jmlimb7      = mysql_num_rows($imb7);
//2. Langkah hitung total data pending SIUP 
$siup7        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='DPL'");
$jmlsiup7     = mysql_num_rows($siup7);
//3. Langkah hitung total data pending TDP
$tdp7     	  = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='DPL'");
$jmltdp7  = mysql_num_rows($tdp7);
//4. Langkah hitung total data pending OTHERS 
$others7     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='DPL'");
$jmlothers7  = mysql_num_rows($others7);
//5. Langkah menjumlahkan total data all pending
$all7= $jmlimb7 + $jmlsiup7 + $jmltdp7 + $jmlothers7;

//HITUNG PENDING LNC BJL
//1. Langkah hitung total data pending IMB 
$imb8         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='BJL'");
$jmlimb8     = mysql_num_rows($imb8);
//2. Langkah hitung total data pending SIUP 
$siup8       = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='BJL'");
$jmlsiup8   = mysql_num_rows($siup8);
//3. Langkah hitung total data pending TDP
$tdp8     	= mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='BJL'");
$jmltdp8  = mysql_num_rows($tdp8);
//4. Langkah hitung total data pending others 
$others8     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='BJL'");
$jmlothers8  = mysql_num_rows($others8);
//5. Langkah menjumlahkan total data all pending
$all8= $jmlimb8+$jmlsiup8 + $jmltdp8 + $jmlothers8;

//HITUNG PENDING LNC MKL
//1. Langkah hitung total data pending IMB 
$imb9         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='MKL'");
$jmlimb9      = mysql_num_rows($imb9);
//2. Langkah hitung total data pending SIUP 
$siup9        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='MKL'");
$jmlsiup9      = mysql_num_rows($siup9);
//3. Langkah hitung total data pending tdp
$tdp9     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='MKL'");
$jmltdp9  = mysql_num_rows($tdp9);
//4. Langkah hitung total data pending others 
$others9     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='MKL'");
$jmlothers9  = mysql_num_rows($others9);
//5. Langkah menjumlahkan total data all pending
$all9= $jmlimb9+$jmlsiup9 + $jmltdp9 + $jmlothers9;

//HITUNG PENDING LNC MNL
//1. Langkah hitung total data pending IMB 
$imb10         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='MNL'");
$jmlimb10      = mysql_num_rows($imb10);
//2. Langkah hitung total data pending SIUP 
$siup10        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='MNL'");
$jmlsiup10      = mysql_num_rows($siup10);
//3. Langkah hitung total data pending TDP
$tdp10     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='MNL'");
$jmltdp10  = mysql_num_rows($tdp10);
//4. Langkah hitung total data pending OTHERS 
$others10     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='MNL'");
$jmlothers10  = mysql_num_rows($others10);
//5. Langkah menjumlahkan total data all pending
$all10= $jmlimb10+$jmlsiup10 + $jmltdp10 + $jmlothers10;

//HITUNG PENDING LNC JKL
//1. Langkah hitung total data pending IMB 
$imb11         = mysql_query("SELECT debitur.no_imb FROM debitur WHERE debitur.no_imb='PENDING' 
AND debitur.LNC='JKL'");
$jmlimb11      = mysql_num_rows($imb11);
//2. Langkah hitung total data pending SIUP 
$siup11        = mysql_query("SELECT debitur.siup FROM debitur WHERE debitur.siup='PENDING' 
AND debitur.LNC='JKL'");
$jmlsiup11      = mysql_num_rows($siup11);
//3. Langkah hitung total data pending tdp
$tdp11     = mysql_query("SELECT debitur.tdp FROM debitur WHERE debitur.tdp='PENDING' 
AND debitur.LNC='JKL'");
$jmltdp11  = mysql_num_rows($tdp11);
//4. Langkah hitung total data pending others 
$others11     = mysql_query("SELECT debitur.others FROM debitur WHERE debitur.others='PENDING' 
AND debitur.LNC='JKL'");
$jmlothers11  = mysql_num_rows($others11);
//5. Langkah menjumlahkan total data all pending
$all11	 = $jmlimb11+$jmlsiup11 + $jmltdp11 + $jmlothers11;
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
<td align='center' width=120>$jmlimb</td>
<td align='center' width=120>$jmlsiup</td>
<td align='center' width=120>$jmltdp</td>
<td align='center' width=120>$jmlothers</td>
<td align='center' width=120>$all</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc1</td>
<td align='center' width=120>$jmlimb1</td>
<td align='center' width=120>$jmlsiup1</td>
<td align='center' width=120>$jmltdp1</td>
<td align='center' width=120>$jmlothers1</td>
<td align='center' width=120>$all1</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc2</td>
<td align='center' width=120>$jmlimb2</td>
<td align='center' width=120>$jmlsiup2</td>
<td align='center' width=120>$jmltdp2</td>
<td align='center' width=120>$jmlothers2</td>
<td align='center' width=120>$all2</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc3</td>
<td align='center' width=120>$jmlimb3</td>
<td align='center' width=120>$jmlsiup3</td>
<td align='center' width=120>$jmltdp3</td>
<td align='center' width=120>$jmlothers3</td>
<td align='center' width=120>$all3</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc4</td>
<td align='center' width=120>$jmlimb4</td>
<td align='center' width=120>$jmlsiup4</td>
<td align='center' width=120>$jmltdp4</td>
<td align='center' width=120>$jmlothers4</td>
<td align='center' width=120>$all4</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc5</td>
<td align='center' width=120>$jmlimb5</td>
<td align='center' width=120>$jmlsiup5</td>
<td align='center' width=120>$jmltdp5</td>
<td align='center' width=120>$jmlothers5</td>
<td align='center' width=120>$all5</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc6</td>
<td align='center' width=120>$jmlimb6</td>
<td align='center' width=120>$jmlsiup6</td>
<td align='center' width=120>$jmltdp6</td>
<td align='center' width=120>$jmlothers6</td>
<td align='center' width=120>$all6</td>
</tr>";
      $no++;
Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc7</td>
<td align='center' width=120>$jmlimb7</td>
<td align='center' width=120>$jmlsiup7</td>
<td align='center' width=120>$jmltdp7</td>
<td align='center' width=120>$jmlothers7</td>
<td align='center' width=120>$all7</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc8</td>
<td align='center' width=120>$jmlimb8</td>
<td align='center' width=120>$jmlsiup8</td>
<td align='center' width=120>$jmltdp8</td>
<td align='center' width=120>$jmlothers8</td>
<td align='center' width=120>$all8</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc9</td>
<td align='center' width=120>$jmlimb9</td>
<td align='center' width=120>$jmlsiup9</td>
<td align='center' width=120>$jmltdp9</td>
<td align='center' width=120>$jmlothers9</td>
<td align='center' width=120>$all9</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc10</td>
<td align='center' width=120>$jmlimb10</td>
<td align='center' width=120>$jmlsiup10</td>
<td align='center' width=120>$jmltdp10</td>
<td align='center' width=120>$jmlothers10</td>
<td align='center' width=120>$all10</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc11</td>
<td align='center' width=120>$jmlimb11</td>
<td align='center' width=120>$jmlsiup11</td>
<td align='center' width=120>$jmltdp11</td>
<td align='center' width=120>$jmlothers11</td>
<td align='center' width=120>$all11</td>
</tr>";
      $no++;
	  
$imbx   = $jmlimb + $jmlimbb1 + $jmlimbb2 + $jmlimb3 + $jmlimb4 + $jmlimb5 + 
           $jmlimb6 + $jmlimb7 + $jmlimb8+ $jmlimb9 + $jmlimb10 + $jmlimb11;
$imbx   = number_format($imbx,0,',','.');

$siupx    = $jmlsiup + $jmlsiup1 + $jmlsiup2 + $jmlsiup3 + $jmlsiup4 + $jmlsiup5 + 
           $jmlsiup6 + $jmlsiup7 + $jmlsiup8+ $jmlsiup9 + $jmlsiup10 + $jmlsiup11;
$siupx    = number_format($siupx,0,',','.');

$tdpx    = $jmltdp + $jmltdp1 + $jmltdp2 + $jmltdp3 + $jmltdp4 +
           $jmltdp5 + $jmltdp6 + $jmltdp7 + $jmltdp8 + $jmltdp9 +
		   $jmltdp10 + $jmltdp11;
$tdpx    = number_format($tdpx,0,',','.');

$othersx = $jmlothers + $jmlothers1 + $jmlothers2 + $jmlothers3 + $jmlothers4 + 
           $jmlothers5 + $jmlothers6 + $jmlothers7 + $jmlothers8 + $jmlothers9 + 
		   $jmlothers10 + $jmlothers11;
$othersx = number_format($othersx,0,',','.');

$allx    = $all + $all1 + $all2 + $all3 + $all4 + $all5 + $all6 + $all7 + $all8 + $all9 +
           $all10 + $all11;
$allx    = number_format($allx,0,',','.');

Echo "
<tr bgcolor=$warna>
<td colspan='2'><b>TOTAL</b></td>
<td align='center' width=120><b>$imbx</b></td>
<td align='center' width=120><b>$siupx</b></td>
<td align='center' width=120><b>$tdpx</b></td>
<td align='center' width=120><b>$othersx</b></td>
<td align='center' width=120><b>$allx</b></td>
</tr>";
      $no++;

//}
echo "<br></table>";
//$date=date('Y-mm-d');'<br>';
//Langkah Hitung total data debitur
$tampil20     = mysql_query("SELECT * FROM debitur");
$jmldatax     = mysql_num_rows($tampil20);
$jmldatax     = number_format($jmldatax,0,',','.');
echo "<p>Total data debitur yang berada di database : <b>$jmldatax</b> orang </p>";

echo "<b>CADS VER : 1.0</b><br>";
echo "<a href='summary.php'>COLLATERAL";
?>
</div>