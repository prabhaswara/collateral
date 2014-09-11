<TITLE>MONITORING PENCAIRAN</TITLE>
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
  <p><b><font size="3" color="#009999"><a href="summary.php">MENU UTAMA</a><a href="maint.htm"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="form_ass.htm">INPUT</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="maint.htm">DATABASE</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="laporan.htm">OUTPUT</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logoutcpr.php">LOGOUT</a></font></b></p>
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
<a style="color:#000000;font-size:18px;text-decoration:blink;">SUMMARY PENCAIRAN BERTAHAP</a></font></strong></p>
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
$warna1 = "#FF6600";   // baris genap berwarna orange tua
$warna2 = "#FFCC66";   // baris ganjil berwarna orange muda
$warna  = $warna1;     // warna default

Include ("koneksi.php");
mysql_select_db("griya");

echo "<table>
<tr bgcolor=$warna>
<td align='center' rowspan=2><B>NO.</b></td>
<td align='center' rowspan=2><B>LNC</b></td>
<td align='center' rowspan=2><B>TOTAL DEBITUR</b></td>
<td align='center' colspan=4><B>PEMBANGUNAN IN PROGRESS</b></td>
<td align='center' colspan=2><B>TOTAL PENCAIRAN BERTAHAP</b></td>
<td align='center' rowspan=2><B>PROGRESS PENYELESAIAN</b></td>
</tr>
<tr bgcolor=$warna>
<td align='center'><B>PONDASI</b></td>
<td align='center'><B>TOPPING OFF</b></td>
<td align='center'><B>BAST</b></td>
<td align='center'><B>DOKUMEN</b></td>
<td align='center'><B>IN PROGRESS</b></td>
<td align='center'><B>SELESAI</b></td>
</tr>";
$no=1;

//HITUNG PENDING LNC SBL
//1. Langkah hitung total debitur 
$debitur      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='SBL'");
$jmldebitur   = mysql_num_rows($debitur);

//2. Langkah hitung total data pending Tahap I 
$tahap1       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='SBL'");
$jmltahap1    = mysql_num_rows($tahap1);

//3. Langkah hitung total data pending Tahap II 
$tahap2       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00'
AND data.LNC='SBL'");
$jmltahap2    = mysql_num_rows($tahap2);
//4. Langkah hitung total data pending Tahap III
$tahap3    	  = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00'
AND data.LNC='SBL'");
$jmltahap3  = mysql_num_rows($tahap3);
//5. Langkah hitung total data pending Tahap IV
$tahap4    	  = mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00'
AND data.LNC='SBL'");
$jmltahap4  = mysql_num_rows($tahap4);

//6. Langkah hitung total debitur in progress
$jmlprogress    	  = $jmltahap1 + $jmltahap2 + $jmltahap3 + $jmltahap4;

//7. Langkah hitung total selesai di review
$cek_bso     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='SBL' AND data.progress='SELESAI'");
$jmlcek  = mysql_num_rows($cek_bso);

//8. Langkah menjumlahkan progress
$ao  = ($jmlcek!=0)?( $jmlcek / $jmldebitur )  * 100:0 ;
$ao	 = round($ao,2);

//----------------------- MDL ----------------------------

//HITUNG PENDING LNC MDL
//1. Langkah hitung total debitur 
$debiturmdl      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='MDL'");
$jmldebiturmdl   = mysql_num_rows($debiturmdl);

//2. Langkah hitung total data pending Tahap I 
$tahap1mdl       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='MDL'");
$jmltahap1mdl    = mysql_num_rows($tahap1mdl);

//3. Langkah hitung total data pending Tahap II 
$tahap2mdl       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00'
AND data.LNC='MDL'");
$jmltahap2mdl    = mysql_num_rows($tahap2mdl);

//4. Langkah hitung total data pending Tahap III
$tahap3mdl    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='MDL'");
$jmltahap3mdl    = mysql_num_rows($tahap3mdl);

//5. Langkah hitung total data pending Tahap IV
$tahap4mdl  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='MDL'");
$jmltahap4mdl  	= mysql_num_rows($tahap4mdl);

//6. Langkah hitung total debitur in progress
$jmlprogressmdl    	  = $jmltahap1mdl + $jmltahap2mdl + $jmltahap3mdl + $jmltahap4mdl;

//7. Langkah hitung total selesai di review
$cek_bsomdl     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='MDL' AND data.progress='SELESAI'");
$jmlcekmdl  = mysql_num_rows($cek_bsomdl);

//8. Langkah menjumlahkan progress
$aomdl  = ($jmlcekmdl!=0)?( $jmlcekmdl / $jmldebiturmdl )  * 100:0 ;
$aomdl	 = round($aomdl,2);

//----------------------- PNL ----------------------------
//HITUNG PENDING LNC PNL
//1. Langkah hitung total debitur 
$debiturpnl      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='PNL'");
$jmldebiturpnl   = mysql_num_rows($debiturpnl);

//2. Langkah hitung total data pending Tahap I 
$tahap1pnl       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='PNL'");
$jmltahap1pnl    = mysql_num_rows($tahap1pnl);

//3. Langkah hitung total data pending Tahap II 
$tahap2pnl       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='PNL'");
$jmltahap2pnl    = mysql_num_rows($tahap2pnl);

//4. Langkah hitung total data pending Tahap III
$tahap3pnl    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='PNL'");
$jmltahap3pnl    = mysql_num_rows($tahap3pnl);

//5. Langkah hitung total data pending Tahap IV
$tahap4pnl  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='PNL'");
$jmltahap4pnl  	= mysql_num_rows($tahap4pnl);

//6. Langkah hitung total debitur in progress
$jmlprogresspnl    	  = $jmltahap1pnl + $jmltahap2pnl + $jmltahap3pnl + $jmltahap4pnl;

//7. Langkah hitung total selesai di review
$cek_bsopnl     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='PNL' AND data.progress='SELESAI'");
$jmlcekpnl  = mysql_num_rows($cek_bsopnl);

//8. Langkah menjumlahkan progress
$aopnl  = ($jmlcekpnl!=0)?( $jmlcekpnl / $jmldebiturpnl )  * 100:0 ;
$aopnl	 = round($aopnl,2);


//----------------------- PLL ----------------------------
//HITUNG PENDING LNC PLL
//1. Langkah hitung total debitur 
$debiturpll      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='PLL'");
$jmldebiturpll   = mysql_num_rows($debiturpll);

//2. Langkah hitung total data pending Tahap I 
$tahap1pll       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='PLL'");
$jmltahap1pll    = mysql_num_rows($tahap1pll);

//3. Langkah hitung total data pending Tahap II 
$tahap2pll       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='PLL'");
$jmltahap2pll    = mysql_num_rows($tahap2pll);

//4. Langkah hitung total data pending Tahap III
$tahap3pll    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='PLL'");
$jmltahap3pll    = mysql_num_rows($tahap3pll);

//5. Langkah hitung total data pending Tahap IV
$tahap4pll  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='PLL'");
$jmltahap4pll  	= mysql_num_rows($tahap4pll);

//6. Langkah hitung total debitur in progress
$jmlprogresspll    	  = $jmltahap1pll + $jmltahap2pll + $jmltahap3pll + $jmltahap4pll;

//7. Langkah hitung total selesai di review
$cek_bsopll     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='PLL' AND data.progress='SELESAI'");
$jmlcekpll  = mysql_num_rows($cek_bsopll);

//8. Langkah menjumlahkan progress
$aopll  = ($jmlcekpll!=0)?( $jmlcekpll / $jmldebiturpll )  * 100:0 ;
$aopll	 = round($aopll,2);

//----------------------- BAL ----------------------------
//HITUNG PENDING LNC BAL
//1. Langkah hitung total debitur 
$debiturBAL      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='BAL'");
$jmldebiturBAL   = mysql_num_rows($debiturBAL);

//2. Langkah hitung total data pending Tahap I 
$tahap1BAL       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='BAL'");
$jmltahap1BAL    = mysql_num_rows($tahap1BAL);

//3. Langkah hitung total data pending Tahap II 
$tahap2BAL       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='BAL'");
$jmltahap2BAL    = mysql_num_rows($tahap2BAL);

//4. Langkah hitung total data pending Tahap III
$tahap3BAL    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='BAL'");
$jmltahap3BAL    = mysql_num_rows($tahap3BAL);

//5. Langkah hitung total data pending Tahap IV
$tahap4BAL  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='BAL'");
$jmltahap4BAL  	= mysql_num_rows($tahap4BAL);

//6. Langkah hitung total debitur in progress
$jmlprogressBAL    	  = $jmltahap1BAL + $jmltahap2BAL + $jmltahap3BAL + $jmltahap4BAL;

//7. Langkah hitung total selesai di review
$cek_bsoBAL     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='BAL' AND data.progress='SELESAI'");
$jmlcekBAL  = mysql_num_rows($cek_bsoBAL);

//8. Langkah menjumlahkan progress
$aoBAL  = ($jmlcekBAL!=0)?( $jmlcekBAL / $jmldebiturBAL )  * 100:0 ;
$aoBAL	 = round($aoBAL,2);

//----------------------- YGL ----------------------------
//HITUNG PENDING LNC YGL
//1. Langkah hitung total debitur 
$debiturYGL      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='YGL'");
$jmldebiturYGL   = mysql_num_rows($debiturYGL);

//2. Langkah hitung total data pending Tahap I 
$tahap1YGL       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='YGL'");
$jmltahap1YGL    = mysql_num_rows($tahap1YGL);

//3. Langkah hitung total data pending Tahap II 
$tahap2YGL       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='YGL'");
$jmltahap2YGL    = mysql_num_rows($tahap2YGL);

//4. Langkah hitung total data pending Tahap III
$tahap3YGL    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='YGL'");
$jmltahap3YGL    = mysql_num_rows($tahap3YGL);

//5. Langkah hitung total data pending Tahap IV
$tahap4YGL  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='YGL'");
$jmltahap4YGL  	= mysql_num_rows($tahap4YGL);

//6. Langkah hitung total debitur in progress
$jmlprogressYGL    	  = $jmltahap1YGL + $jmltahap2YGL + $jmltahap3YGL + $jmltahap4YGL;

//7. Langkah hitung total selesai di review
$cek_bsoYGL     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='YGL' AND data.progress='SELESAI'");
$jmlcekYGL  = mysql_num_rows($cek_bsoYGL);

//8. Langkah menjumlahkan progress
$aoYGL  = ($jmlcekYGL!=0)?( $jmlcekYGL / $jmldebiturYGL )  * 100:0 ;
$aoYGL	 = round($aoYGL,2);

//----------------------- SML ----------------------------
//HITUNG PENDING LNC SML
//1. Langkah hitung total debitur 
$debiturSML      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='SML'");
$jmldebiturSML   = mysql_num_rows($debiturSML);

//2. Langkah hitung total data pending Tahap I 
$tahap1SML       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='SML'");
$jmltahap1SML    = mysql_num_rows($tahap1SML);

//3. Langkah hitung total data pending Tahap II 
$tahap2SML       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='SML'");
$jmltahap2SML    = mysql_num_rows($tahap2SML);

//4. Langkah hitung total data pending Tahap III
$tahap3SML    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='SML'");
$jmltahap3SML    = mysql_num_rows($tahap3SML);

//5. Langkah hitung total data pending Tahap IV
$tahap4SML  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='SML'");
$jmltahap4SML  	= mysql_num_rows($tahap4SML);

//6. Langkah hitung total debitur in progress
$jmlprogressSML    	  = $jmltahap1SML + $jmltahap2SML + $jmltahap3SML + $jmltahap4SML;

//7. Langkah hitung total selesai di review
$cek_bsoSML     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='SML' AND data.progress='SELESAI'");
$jmlcekSML  = mysql_num_rows($cek_bsoSML);

//8. Langkah menjumlahkan progress
$aoSML  = ($jmlcekSML!=0)?( $jmlcekSML / $jmldebiturSML )  * 100:0 ;
$aoSML	 = round($aoSML,2);

//----------------------- DPL ----------------------------
//HITUNG PENDING LNC DPL
//1. Langkah hitung total debitur 
$debiturDPL      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='DPL'");
$jmldebiturDPL   = mysql_num_rows($debiturDPL);

//2. Langkah hitung total data pending Tahap I 
$tahap1DPL       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='DPL'");
$jmltahap1DPL    = mysql_num_rows($tahap1DPL);

//3. Langkah hitung total data pending Tahap II 
$tahap2DPL       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='DPL'");
$jmltahap2DPL    = mysql_num_rows($tahap2DPL);

//4. Langkah hitung total data pending Tahap III
$tahap3DPL    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='DPL'");
$jmltahap3DPL    = mysql_num_rows($tahap3DPL);

//5. Langkah hitung total data pending Tahap IV
$tahap4DPL  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='DPL'");
$jmltahap4DPL  	= mysql_num_rows($tahap4DPL);

//6. Langkah hitung total debitur in progress
$jmlprogressDPL    	  = $jmltahap1DPL + $jmltahap2DPL + $jmltahap3DPL + $jmltahap4DPL;

//7. Langkah hitung total selesai di review
$cek_bsoDPL     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='DPL' AND data.progress='SELESAI'");
$jmlcekDPL  = mysql_num_rows($cek_bsoDPL);

//8. Langkah menjumlahkan progress
$aoDPL  = ($jmlcekDPL!=0)?( $jmlcekDPL / $jmldebiturDPL )  * 100:0 ;
$aoDPL	 = round($aoDPL,2);

//----------------------- BJL ----------------------------
//HITUNG PENDING LNC BJL
//1. Langkah hitung total debitur 
$debiturBJL      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='BJL'");
$jmldebiturBJL   = mysql_num_rows($debiturBJL);

//2. Langkah hitung total data pending Tahap I 
$tahap1BJL       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='BJL'");
$jmltahap1BJL    = mysql_num_rows($tahap1BJL);

//3. Langkah hitung total data pending Tahap II 
$tahap2BJL       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='BJL'");
$jmltahap2BJL    = mysql_num_rows($tahap2BJL);

//4. Langkah hitung total data pending Tahap III
$tahap3BJL    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='BJL'");
$jmltahap3BJL    = mysql_num_rows($tahap3BJL);

//5. Langkah hitung total data pending Tahap IV
$tahap4BJL  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='BJL'");
$jmltahap4BJL  	= mysql_num_rows($tahap4BJL);

//6. Langkah hitung total debitur in progress
$jmlprogressBJL    	  = $jmltahap1BJL + $jmltahap2BJL + $jmltahap3BJL + $jmltahap4BJL;

//7. Langkah hitung total selesai di review
$cek_bsoBJL     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='BJL' AND data.progress='SELESAI'");
$jmlcekBJL  = mysql_num_rows($cek_bsoBJL);

//8. Langkah menjumlahkan progress
$aoBJL  = ($jmlcekBJL!=0)?( $jmlcekBJL / $jmldebiturBJL )  * 100:0 ;
$aoBJL	 = round($aoBJL,2);

//----------------------- MKL ----------------------------
//HITUNG PENDING LNC MKL
//1. Langkah hitung total debitur 
$debiturMKL      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='MKL'");
$jmldebiturMKL   = mysql_num_rows($debiturMKL);

//2. Langkah hitung total data pending Tahap I 
$tahap1MKL       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='MKL'");
$jmltahap1MKL    = mysql_num_rows($tahap1MKL);

//3. Langkah hitung total data pending Tahap II 
$tahap2MKL       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='MKL'");
$jmltahap2MKL    = mysql_num_rows($tahap2MKL);

//4. Langkah hitung total data pending Tahap III
$tahap3MKL    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='MKL'");
$jmltahap3MKL    = mysql_num_rows($tahap3MKL);

//5. Langkah hitung total data pending Tahap IV
$tahap4MKL  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='MKL'");
$jmltahap4MKL  	= mysql_num_rows($tahap4MKL);

//6. Langkah hitung total debitur in progress
$jmlprogressMKL    	  = $jmltahap1MKL + $jmltahap2MKL + $jmltahap3MKL + $jmltahap4MKL;

//7. Langkah hitung total selesai di review
$cek_bsoMKL     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='MKL' AND data.progress='SELESAI'");
$jmlcekMKL  = mysql_num_rows($cek_bsoMKL);

//8. Langkah menjumlahkan progress
$aoMKL  = ($jmlcekMKL!=0)?( $jmlcekMKL / $jmldebiturMKL )  * 100:0 ;
$aoMKL	 = round($aoMKL,2);

//----------------------- MNL ----------------------------
//HITUNG PENDING LNC MNL
//1. Langkah hitung total debitur 
$debiturMNL      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='MNL'");
$jmldebiturMNL   = mysql_num_rows($debiturMNL);

//2. Langkah hitung total data pending Tahap I 
$tahap1MNL       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='MNL'");
$jmltahap1MNL    = mysql_num_rows($tahap1MNL);

//3. Langkah hitung total data pending Tahap II 
$tahap2MNL       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='MNL'");
$jmltahap2MNL    = mysql_num_rows($tahap2MNL);

//4. Langkah hitung total data pending Tahap III
$tahap3MNL    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='MNL'");
$jmltahap3MNL    = mysql_num_rows($tahap3MNL);

//5. Langkah hitung total data pending Tahap IV
$tahap4MNL  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='MNL'");
$jmltahap4MNL  	= mysql_num_rows($tahap4MNL);

//6. Langkah hitung total debitur in progress
$jmlprogressMNL    	  = $jmltahap1MNL + $jmltahap2MNL + $jmltahap3MNL + $jmltahap4MNL;

//7. Langkah hitung total selesai di review
$cek_bsoMNL     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='MNL' AND data.progress='SELESAI'");
$jmlcekMNL  = mysql_num_rows($cek_bsoMNL);

//8. Langkah menjumlahkan progress
$aoMNL  = ($jmlcekMNL!=0)?( $jmlcekMNL / $jmldebiturMNL )  * 100:0 ;
$aoMNL	 = round($aoMNL,2);

//----------------------- JKL ----------------------------
//HITUNG PENDING LNC JKL
//1. Langkah hitung total debitur 
$debiturJKL      = mysql_query("SELECT data.lnc FROM data WHERE data.LNC='JKL'");
$jmldebiturJKL   = mysql_num_rows($debiturJKL);

//2. Langkah hitung total data pending Tahap I 
$tahap1JKL       = mysql_query("SELECT data.tgl_cair_1 FROM data WHERE data.tgl_cair_1 ='0000-00-00' AND data.progress='BELUM' 
AND data.LNC='JKL'");
$jmltahap1JKL    = mysql_num_rows($tahap1JKL);

//3. Langkah hitung total data pending Tahap II 
$tahap2JKL       = mysql_query("SELECT data.tgl_cair_2 FROM data WHERE data.tgl_cair_2 ='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_1>'0000-00-00' AND data.tgl_cair_3='0000-00-00' AND data.LNC='JKL'");
$jmltahap2JKL    = mysql_num_rows($tahap2JKL);

//4. Langkah hitung total data pending Tahap III
$tahap3JKL    	 = mysql_query("SELECT data.tgl_cair_3 FROM data WHERE data.tgl_cair_3='0000-00-00' AND data.progress='BELUM'
AND data.tgl_cair_2>'0000-00-00' AND data.tgl_cair_4='0000-00-00' AND data.LNC='JKL'");
$jmltahap3JKL    = mysql_num_rows($tahap3JKL);

//5. Langkah hitung total data pending Tahap IV
$tahap4JKL  	= mysql_query("SELECT data.tgl_cair_4 FROM data WHERE data.tgl_cair_4='0000-00-00' AND data.progress='BELUM' 
AND data.tgl_cair_3 > '0000-00-00' AND data.LNC='JKL'");
$jmltahap4JKL  	= mysql_num_rows($tahap4JKL);

//6. Langkah hitung total debitur in progress
$jmlprogressJKL    	  = $jmltahap1JKL + $jmltahap2JKL + $jmltahap3JKL + $jmltahap4JKL;

//7. Langkah hitung total selesai di review
$cek_bsoJKL     = mysql_query("SELECT data.progress FROM data WHERE data.LNC='JKL' AND data.progress='SELESAI'");
$jmlcekJKL  = mysql_num_rows($cek_bsoJKL);

//8. Langkah menjumlahkan progress
$aoJKL  = ($jmlcekJKL!=0)?( $jmlcekJKL / $jmldebiturJKL )  * 100:0 ;
$aoJKL	 = round($aoJKL,2);

// Langkah membaca semua LNC
$lnc1  = 'SBL';
$lnc2  = 'MDL';
$lnc3  = 'PNL';
$lnc4  = 'PLL';
$lnc5  = 'BAL';
$lnc6  = 'YGL';
$lnc7  = 'SML';
$lnc8  = 'DPL';
$lnc9  = 'BJL';
$lnc10  = 'MKL';
$lnc11  = 'MNL';
$lnc12  = 'JKL';

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc2</td>
<td align='center' width=120>$jmldebiturmdl</td>
<td align='center' width=120>$jmltahap1mdl</td>
<td align='center' width=120>$jmltahap2mdl</td>
<td align='center' width=120>$jmltahap3mdl</td>
<td align='center' width=120>$jmltahap4mdl</td>
<td align='center' width=120>$jmlprogressmdl</td>
<td align='center' width=120>$jmlcekmdl</td>
<td align='center' width=140>$aomdl %</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc3</td>
<td align='center' width=120>$jmldebiturpnl</td>
<td align='center' width=120>$jmltahap1pnl</td>
<td align='center' width=120>$jmltahap2pnl</td>
<td align='center' width=120>$jmltahap3pnl</td>
<td align='center' width=120>$jmltahap4pnl</td>
<td align='center' width=120>$jmlprogresspnl</td>
<td align='center' width=120>$jmlcekpnl</td>
<td align='center' width=140>$aopnl %</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc4</td>
<td align='center' width=120>$jmldebiturpll</td>
<td align='center' width=120>$jmltahap1pll</td>
<td align='center' width=120>$jmltahap2pll</td>
<td align='center' width=120>$jmltahap3pll</td>
<td align='center' width=120>$jmltahap4pll</td>
<td align='center' width=120>$jmlprogresspll</td>
<td align='center' width=120>$jmlcekpll</td>
<td align='center' width=140>$aopll %</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc5</td>
<td align='center' width=120>$jmldebiturBAL</td>
<td align='center' width=120>$jmltahap1BAL</td>
<td align='center' width=120>$jmltahap2BAL</td>
<td align='center' width=120>$jmltahap3BAL</td>
<td align='center' width=120>$jmltahap4BAL</td>
<td align='center' width=120>$jmlprogressBAL</td>
<td align='center' width=120>$jmlcekBAL</td>
<td align='center' width=140>$aoBAL %</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc6</td>
<td align='center' width=120>$jmldebiturYGL</td>
<td align='center' width=120>$jmltahap1YGL</td>
<td align='center' width=120>$jmltahap2YGL</td>
<td align='center' width=120>$jmltahap3YGL</td>
<td align='center' width=120>$jmltahap4YGL</td>
<td align='center' width=120>$jmlprogressYGL</td>
<td align='center' width=120>$jmlcekYGL</td>
<td align='center' width=140>$aoYGL %</td>
</tr>";
      $no++;	  

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc7</td>
<td align='center' width=120>$jmldebiturSML</td>
<td align='center' width=120>$jmltahap1SML</td>
<td align='center' width=120>$jmltahap2SML</td>
<td align='center' width=120>$jmltahap3SML</td>
<td align='center' width=120>$jmltahap4SML</td>
<td align='center' width=120>$jmlprogressSML</td>
<td align='center' width=120>$jmlcekSML</td>
<td align='center' width=140>$aoSML %</td>
</tr>";
      $no++;	  
	  	  	  
Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc1</td>
<td align='center' width=120>$jmldebitur</td>
<td align='center' width=120>$jmltahap1</td>
<td align='center' width=120>$jmltahap2</td>
<td align='center' width=120>$jmltahap3</td>
<td align='center' width=120>$jmltahap4</td>
<td align='center' width=120>$jmlprogress</td>
<td align='center' width=120>$jmlcek</td>
<td align='center' width=140>$ao %</td>
</tr>";
      $no++;

Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc8</td>
<td align='center' width=120>$jmldebiturDPL</td>
<td align='center' width=120>$jmltahap1DPL</td>
<td align='center' width=120>$jmltahap2DPL</td>
<td align='center' width=120>$jmltahap3DPL</td>
<td align='center' width=120>$jmltahap4DPL</td>
<td align='center' width=120>$jmlprogressDPL</td>
<td align='center' width=120>$jmlcekDPL</td>
<td align='center' width=140>$aoDPL %</td>
</tr>";
      $no++;	  
Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc9</td>
<td align='center' width=120>$jmldebiturBJL</td>
<td align='center' width=120>$jmltahap1BJL</td>
<td align='center' width=120>$jmltahap2BJL</td>
<td align='center' width=120>$jmltahap3BJL</td>
<td align='center' width=120>$jmltahap4BJL</td>
<td align='center' width=120>$jmlprogressBJL</td>
<td align='center' width=120>$jmlcekBJL</td>
<td align='center' width=140>$aoBJL %</td>
</tr>";
      $no++;	
	  
Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc10</td>
<td align='center' width=120>$jmldebiturMKL</td>
<td align='center' width=120>$jmltahap1MKL</td>
<td align='center' width=120>$jmltahap2MKL</td>
<td align='center' width=120>$jmltahap3MKL</td>
<td align='center' width=120>$jmltahap4MKL</td>
<td align='center' width=120>$jmlprogressMKL</td>
<td align='center' width=120>$jmlcekMKL</td>
<td align='center' width=140>$aoMKL %</td>
</tr>";
      $no++;		  
Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc11</td>
<td align='center' width=120>$jmldebiturMNL</td>
<td align='center' width=120>$jmltahap1MNL</td>
<td align='center' width=120>$jmltahap2MNL</td>
<td align='center' width=120>$jmltahap3MNL</td>
<td align='center' width=120>$jmltahap4MNL</td>
<td align='center' width=120>$jmlprogressMNL</td>
<td align='center' width=120>$jmlcekMNL</td>
<td align='center' width=140>$aoMNL %</td>
</tr>";
      $no++;		  	 
Echo "
<tr bgcolor=$warna2>
<td align='center' width=40>$no</td>
<td align='center' width=50>$lnc12</td>
<td align='center' width=120>$jmldebiturJKL</td>
<td align='center' width=120>$jmltahap1JKL</td>
<td align='center' width=120>$jmltahap2JKL</td>
<td align='center' width=120>$jmltahap3JKL</td>
<td align='center' width=120>$jmltahap4JKL</td>
<td align='center' width=120>$jmlprogressJKL</td>
<td align='center' width=120>$jmlcekJKL</td>
<td align='center' width=140>$aoJKL %</td>
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
echo "<p>Total data debitur di database : <b>$jmldatax</b> </p>";

echo "<BR><b>VER : 1.0</b><br>";
echo "<font size=1> <BR><b>Copyright : CPR ®</b><br>";
//echo "<a href='legalitas.php'>LEGALITAS";
?>
</div>
