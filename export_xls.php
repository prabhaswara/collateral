<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
<p align="left"><b><font size="3" color="#009999"><a href="summary.php">MENU UTAMA</a><a href="maint.htm"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="maint.htm">DATABASE</a></font></b></p>
<p align="left">&nbsp;</p>
<p align="left">&nbsp;</p>
<p align="center" style="margin-top: 0; margin-bottom: 0"></p>
<?php
Include ("koneksi.php");
$db = "collateral";
mysql_select_db("$db") or die (mysql_error());

$filename   = "C:/backup db sql/test.xls";

//nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport

$sukses = 0;
$gagal  = 0;
$export = 'debitur';

//jumlah kolom
$jkolom=0;

//generate kolom
$q      = mysql_query ("SELECT * FROM $export");
$r      = mysql_fetch_assoc($q);
foreach ($r as $head=>$nilai) {
$header .=$head." \t";

//print header table
$jkolom++;
}
$header .= "\n";

//generate baris
$rst    = mysql_query("SELECT * FROM $export");
while
($row   = mysql_fetch_array($rst))
{
for ($x=0; $x<$jkolom; $x++) {
$content .=$row[$x]." \t ";
}
$content .=$row[$x]." \n ";
}

$output .=$header.$content;
header('Content-type:application/ms-excel');
header('Content-Disposition:attachment;
filename=.$filename');
echo $output;

//$result = mysql_query($query) or die ("Database telah di 
//backup ke dalam format Ms. Excel dengan nama : <b>data.xls</b> pada 
//folder C:/backup db sql  !!!");

?>