<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
<p align="left"><b><font size="3" color="#009999"><a href="summary.php">MENU UTAMA</a><a href="maint.htm"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="maint.htm">DATABASE</a></font></b></p>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p>
<p align="center" style="margin-top: 0; margin-bottom: 0"></p>
<?php
Include ("koneksi.php");
$db = "collateral";
mysql_select_db($db) or die (mysql_error());

//import data excel mulai baris ke 2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
//membaca data no. soal (kolom ke-1)
$no=$data->val ($i,1)
$a=$data->val ($i,2)
$b=$data->val ($i,3)
$c=$data->val ($i,4)
$d=$data->val ($i,5)

//setelah data dibaca, sisipkan ke dalam tabel debitur

$import = 'debitur';
$file   = "C:/import db sql/db_debitur.xls";
$query  = "INSERT INTO debitur '$file' INTO TABLE $import";


$result = mysql_query($query) or die ("data.xls dari folder C:/import db sql, berhasil di upload ke database !!!");
?>