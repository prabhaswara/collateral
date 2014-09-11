<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
<p align="left"><b><font size="3" color="#009999"><a href="summary.php">MENU UTAMA</a><a href="maint.htm"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="maint.htm">DATABASE</a></font></b></p>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p>
<p align="center" style="margin-top: 0; margin-bottom: 0"></p>
<?php
Include ("koneksi.php");
$db = "collateral";
mysql_select_db($db) or die (mysql_error());

$export = 'debitur';
$file   = "C:/data.xls";
$query  = "SELECT * INTO OUTFILE '$file' FROM $export";

$result = mysql_query($query) or die ("Database telah di 
backup ke dalam format Ms. Excel dengan nama : <b>data.xls</b> pada 
folder C:/backup db sql  !!!");

?>