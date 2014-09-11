<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
<p align="left"><b><font size="3" color="#009999"><a href="summary.php">MENU UTAMA</a><a href="maint.htm"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="maint.htm">DATABASE</a></font></b></p>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p>
<p align="center" style="margin-top: 0; margin-bottom: 0"></p>
<?php
Include ("koneksi.php");
$db = "collateral";
mysql_select_db($db) or die (mysql_error());

$import = 'debitur';
$file   = "C:/import db sql/data.xls";
$query  = "LOAD DATA INFILE '$file' INTO TABLE $import";

$result = mysql_query($query) or die ("data.xls dari folder C:/import db sql, berhasil di upload ke database !!!");
?>