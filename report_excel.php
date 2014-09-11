<?php
require_once "Excel.class.php";

//Include ("koneksi.php");
//mysql_select_db("collateral");

#koneksi ke mysql
$mysqli = new mysqli("localhost","root","");
if ($mysqli->connect_error) {
    die('Connect Error (' 
 . $mysqli->connect_error . ') ' 
);
}
#akhir koneksi

#ambil data
$query = "SELECT LNC, NOAPLIKASI, NAMADEBITUR FROM debitur";
$sql = $mysqli->query($query);
$arrmhs = array();
while ($row = $sql->fetch_assoc()) {
        array_push($arrmhs, $row);
}
#akhir data

$excel = new Excel();
#Send Header
$excel->setHeader('contoh-2.xls');
$excel->BOF();

#header tabel
$excel->writeLabel(0, 0, "LNC");
$excel->writeLabel(0, 1, "NO. APLIKASI");
$excel->writeLabel(0, 2, "NAMA DEBITUR");

#isi data
$i = 1;
foreach ($arrmhs as $baris) {
        $j = 0;
        foreach ($baris as $value) {
                $excel->writeLabel($i, $j, $value);
                $j++;
        }
        $i++;
}

$excel->EOF();

exit();
?>
