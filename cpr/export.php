<?php
 
// Connect and query the database for the users
$conn = new PDO("mysql:host=localhost;dbname=griya", 'root', '');
$sql = "SELECT * FROM data";
$results = $conn->query($sql);
 
// Pick a filename and destination directory for the file
// Remember that the folder where you want to write the file has to be writable
$filename = "/tmp/db_user_export_".time().".csv";
 
// Actually create the file
// The w+ parameter will wipe out and overwrite any existing file with the same name
$handle = fopen($filename, 'w+');
 
// Write the spreadsheet column titles / labels
fputcsv($handle, array('Tgl. Input','LNC','Produk' ,'No. Aplikasi','No. Rekg. Pinjaman','Nama Debitur','Maksimum','Tenor','Tgl. PK','Nama Penjual','Nama Perumahan','No.Rekg. Escrow','Tahap I','Tgl. Pencairan I','Tahap II','Tgl. Pencairan II','Tahap III','Tgl. Pencairan III','Tahap IV','Tgl. Pencairan IV','Tgl. Update','Keterangan','Progress'));
 
// Write all the user records to the spreadsheet
foreach($results as $row)
{
fputcsv($handle, array($row['tgl_input'], $row['lnc'], $row['produk'], $row['no_aplikasi'], $row['rek_pinjaman'], $row['nama_debitur'],$row['max_kredit'], $row['tenor'], $row['tgl_pk'], $row['developer'], $row['perumahan'], $row['escrow'],$row['cair_1'],$row['tgl_cair_1'],$row['cair_2'],$row['tgl_cair_2'],$row['cair_3'],$row['tgl_cair_3'],$row['cair_4'],$row['tgl_cair_4'],$row['tgl_update'],$row['keterangan'],$row['progress']));
}
 
// Finish writing the file
fclose($handle);
 
?>