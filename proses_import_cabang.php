<?php
Echo "<a href='summary.php'><b>MENU UTAMA</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='maint.htm'>DATABASE</a></b>";
echo "<br><br><br>";
// menggunakan class phpExcelReader
include "excel_reader2.php";
 
// koneksi ke MySQL
mysql_connect("localhost","root","");
mysql_select_db("collateral_db");
 
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
 
// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
 
// import data excel mulai baris ke-2 
// (karena baris pertama adalah nama kolom)
for ($i=2; $i <= $baris; $i++){

$kd_wilayah					= $data->val($i, 1);
$wilayah                	= $data->val($i, 2); 
$singkatan_wilayah			= $data->val($i, 3);
$kd_cabang					= $data->val($i, 4);
$cabang						= $data->val($i, 5);
$singkatan_cabang			= $data->val($i, 6);

	$cari = mysql_num_rows(mysql_query("SELECT * FROM daftar_cabang WHERE kd_cabang = '$kd_cabang'"));
    
    if (empty($kd_cabang)){
    $hasil = mysql_query("INSERT INTO gagal VALUES('$kd_cabang','$cabang',
	'Kode Cabang Kosong')");
    }
    elseif ($cari > 0){
    $hasil = mysql_query("INSERT INTO gagal VALUES('$kd_cabang','$cabang',
	'Duplikasi Kode Cabang')");
    }
   else{

// setelah data dibaca, sisipkan ke dalam tabel debitur

$hasil = mysql_query("INSERT INTO daftar_cabang VALUES 
('$kd_wilayah','$wilayah','$singkatan_wilayah','$kd_cabang','$cabang','$singkatan_cabang')");
    }
}
echo "<p align='center'> <b>Import Data Cabang Selesai !!!<b></p>";
?>