<TITLE>MONITORING PENCAIRAN</TITLE>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style><head>
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
body,td,th {
	font-size: 10px;
	color: #0000FF;
}
-->
</style>
</head> 
<link rel="stylesheet" type="text/css" href="y.css" /> 
<body> 
<div id="wrap"> 
<div align='center'>
  <p>&nbsp;</p>
  <p><b><font size="3" color="black"><a href="summary_bso.php">MENU UTAMA</a><a href="maint.htm"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="bso_menu.htm">BSO MENU</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="laporan_bso.htm">ACTION</a>&nbsp;<a href="form_import.php"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="kpi_bso.htm">LAPORAN</a></font></b></p>
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
<a style="color:#000000;font-size:18px;text-decoration:blink;">TOOLS BUSINESS SECURITY</a></font></strong></p>
<a style="color:#000000;font-size:18px;text-decoration:blink;">MONITORING PENCAIRAN BERTAHAP</a></font></strong></p>
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
$warna1 = "##CCCCCC";   // baris genap berwarna biru BNI
$warna2 = "##FFFFCC";   // baris ganjil berwarna kuning muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("griya");

echo "<table>
<tr bgcolor=$warna>
<td align='center' rowspan=2><font color='black'><B>NO.</b></td>
<td align='center' rowspan=2><font color='black'><B>LNC</b></td>
<td align='center' rowspan=2><font color='black'><B>TOTAL DEBITUR</b></td>
<td align='center' colspan=4> <font color='black'><B>PEMBANGUNAN IN PROGRESS</b></td>
<td align='center' colspan=2><font color='black'><B>TOTAL PENCAIRAN BERTAHAP</b></td>
<td align='center' rowspan=2><font color='black'><B>PROGRESS PENYELESAIAN</b></td>
</tr>
<tr bgcolor=$warna>
<td align='center'><font color='black'><B>PONDASI</b></td>
<td align='center'><font color='black'><B>TOPPING OFF</b></td>
<td align='center'><font color='black'><B>BAST</b></td>
<td align='center'><font color='black'><B>DOKUMEN</b></td>
<td align='center'><font color='black'><B>IN PROGRESS</b></td>
<td align='center'><font color='black'><B>SELESAI</b></td>
</tr>";
$no=1;

//HITUNG PENDING LNC PLL
//1. Langkah hitung total debitur 
$debitur      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='PLL'");
$jmldebitur   = mysql_num_rows($debitur);

//2. Langkah hitung total data pending Tahap I 
$tahap1       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='PLL'");
$jmltahap1    = mysql_num_rows($tahap1);

//3. Langkah hitung total data pending Tahap II 
$tahap2       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00'
AND data.LNC='PLL'");
$jmltahap2    = mysql_num_rows($tahap2);
//4. Langkah hitung total data pending Tahap III
$tahap3    	  = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00'
AND data.LNC='PLL'");
$jmltahap3  = mysql_num_rows($tahap3);
//5. Langkah hitung total data pending Tahap IV
$tahap4    	  = mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00'
AND data.LNC='PLL'");
$jmltahap4  = mysql_num_rows($tahap4);

//6. Langkah hitung total debitur in progress
$progress    	  = mysql_query("SELECT data.lnc FROM data WHERE data.progress='BELUM'
AND data.LNC='PLL'");
$jmlprogress  = mysql_num_rows($progress);

//7. Langkah hitung total selesai di review
$cek_bso     = mysql_query("SELECT data.progress FROM data WHERE data.progress='SELESAI' 
AND data.LNC='PLL'");
$jmlcek  = mysql_num_rows($cek_bso);

//8. Langkah menjumlahkan progress
$ao  = ($jmlcek!=0)?( $jmlcek / $jmldebitur )  * 100:0 ;
$ao	 = round($ao,2);

// Langkah membaca semua LNC

$lnc1  = 'PLL';

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40><font color='black'>$no</td>
<td align='center' width=50><font color='black'>$lnc1</td>
<td align='center' width=120><font color='black'>$jmldebitur</td>
<td align='center' width=120><font color='black'>$jmltahap1</td>
<td align='center' width=120><font color='black'>$jmltahap2</td>
<td align='center' width=120><font color='black'>$jmltahap3</td>
<td align='center' width=120><font color='black'>$jmltahap4</td>
<td align='center' width=120><font color='black'>$jmlprogress</td>
<td align='center' width=120><font color='black'>$jmlcek</td>
<td align='center' width=140><font color='black'>$ao %</td>
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

//}
echo "<br></table>";
//$date=date('Y-mm-d');'<br>';
//Langkah Hitung total data debitur
$tampil20     = mysql_query("SELECT * FROM data");
$jmldatax     = mysql_num_rows($tampil20);
$jmldatax     = number_format($jmldatax,0,',','.');
//echo "<p>Total data debitur yang berada di database : <b>$jmldatax</b> orang </p>";

echo "<font color='black'><BR><BR><font color='black'><b>VER : 1.0</b><br>";
echo "<font size=1> <BR><font color='black'><b>Copyright : CPR ®</b><br>";
//echo "<a href='legalitas.php'>LEGALITAS";
?>
</div>
