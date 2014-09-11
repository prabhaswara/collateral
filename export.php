<?php
// koneksi database
$db = "collateral";

mysql_connect("localhost","root","");
mysql_select_db("$db");

$tanggal=date(dmY);
//$filename = "$tangga.xls";

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;
$table = "debitur";


//jumlah kolom
$jkolom=0;

//generate kolom
$q= mysql_query("select * from $table");
$r=mysql_fetch_assoc($q);
foreach ($r as $head=>$nilai) {
$header .=$head." \t"; //print header table
$jkolom++;
}
$header .= "\n";

//generate baris
$result= mysql_query("select * from $table");
while ($row=mysql_fetch_array($result)) {
for ($x=0; $x<$jkolom; $x++) {
$content .=$row[$x]." \t ";
}
$content .= $row[$x]." \n ";
}


$output .= $header.$content;
header('Content-type:application/x-msdownload');
header('Content-Disposition: attachment; filename='.$tanggal.'.xls');
echo $output;

?>