<?php

set_time_limit(3000);//set limit untuk melakukan query = 3000 seconds

Echo "<a href='summary.php'><b>MENU UTAMA</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='laporan.htm'>ACTION</a></b>";
echo "<br><br><br>";
// menggunakan class phpExcelReader
include "excel_reader2.php";
 
// koneksi ke MySQL
mysql_connect("localhost","root","");
mysql_select_db("griya");
 
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
 
// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
 
// import data excel mulai baris ke-2 
// (karena baris pertama adalah nama kolom)
for ($i=2; $i <= $baris; $i++){

$tgl_input			=	$data->val($i, 1);
$lnc				=	$data->val($i, 2);
$produk				=	$data->val($i, 3);
$no_aplikasi		=	$data->val($i, 4);
$rekg_pinjaman		=	$data->val($i, 5);
$nama_debitur		=	$data->val($i, 6);
$max_kredit			=	$data->val($i, 7);
$tenor				=	$data->val($i, 8);
$tgl_pk				=	$data->val($i, 9);
$developer			=	$data->val($i, 10);
$badan				=	$data->val($i, 11);
$perumahan			=	$data->val($i, 12);
$proyek				=	$data->val($i, 13);
$skim				=	$data->val($i, 14);
$pks				=	$data->val($i, 15);
$escrow				=	$data->val($i, 16);
$cair_1				=	$data->val($i, 17);
$keterangan1		=	$data->val($i, 18);
$tgl_cair_1			=	$data->val($i, 19);
$cair_2				=	$data->val($i, 20);
$keterangan2		=	$data->val($i, 21);
$tgl_cair_2			=	$data->val($i, 22);
$cair_3				=	$data->val($i, 23);
$keterangan3		=	$data->val($i, 24);
$tgl_cair_3			=	$data->val($i, 25);
$cair_4				=	$data->val($i, 26);
$keterangan4		=	$data->val($i, 27);
$tgl_cair_4			=	$data->val($i, 28);
$tgl_update			=	$data->val($i, 29);
$keterangan			=	$data->val($i, 30);
$progress			=	$data->val($i, 31);
$jenis				=	$data->val($i, 32);
$cek_1				=	$data->val($i, 33);
$keterangan_bso_1	=	$data->val($i, 34);
$tgl_bso_1			=	$data->val($i, 35);
$cek_2				=	$data->val($i, 36);
$keterangan_bso_2	=	$data->val($i, 37);
$tgl_bso_2			=	$data->val($i, 38);
$cek_3				=	$data->val($i, 39);
$keterangan_bso_3	=	$data->val($i, 40);
$tgl_bso_3			=	$data->val($i, 41);
$cek_4				=	$data->val($i, 42);
$keterangan_bso_4	=	$data->val($i, 43);
$tgl_bso_4			=	$data->val($i, 44);
$evaluasi		=	$data->val($i, 45);
$tgl_evaluasi	=	$data->val($i, 46);
$unit			=	$data->val($i, 47);
$transaksi		=	$data->val($i, 48);
$pengikatan		=	$data->val($i, 49);
$outstanding	=	$data->val($i, 50);
$jaminan		=	$data->val($i, 51);
$bangunan		=	$data->val($i, 52);
$induk			=	$data->val($i, 53);
$kategori		=	$data->val($i, 54);

    $del=mysql_query("delete from data WHERE rekg_pinjaman = '$rekg_pinjaman'");

	$cari = mysql_num_rows(mysql_query("SELECT * FROM data WHERE rekg_pinjaman = '$rekg_pinjaman'"));
    
    if (empty($rekg_pinjaman)){
    $hasil = mysql_query("INSERT INTO gagal VALUES('$NOAPLIKASI','$NAMADEBITUR','No. Aplikasi Kosong')");
    }
    elseif ($cari > 0 && $cari['tgl_update']!=$tgl_update){
    mysql_query("INSERT INTO data_log() values (

'$tgl_input',
'$lnc',
'$produk',
'$no_aplikasi',
'$rekg_pinjaman',
'$nama_debitur',
'$max_kredit',
'$tenor',
'$tgl_pk',
'$developer',
'$badan',
'$perumahan',
'$proyek',
'$skim',
'$pks',
'$escrow',
'$cair_1',
'$keterangan1',
'$tgl_cair_1',
'$cair_2',
'$keterangan2',
'$tgl_cair_2',
'$cair_3',
'$keterangan3',
'$tgl_cair_3',
'$cair_4',
'$keterangan4',
'$tgl_cair_4',
'$tgl_update',
'$keterangan',
'$progress',
'$jenis',
'$cek_1',
'$keterangan_bso_1',
'$tgl_bso_1',
'$cek_2',
'$keterangan_bso_2',
'$tgl_bso_2',
'$cek_3',
'$keterangan_bso_3',
'$tgl_bso_3',
'$cek_4',
'$keterangan_bso_4',
'$tgl_bso_4',
'$evaluasi',
'$tgl_evaluasi',
'$unit',
'$transaksi',
'$pengikatan',
'$outstanding',
'$jaminan',
'$bangunan',
'$induk',
'$kategori')");

	mysql_query("update data_log set kolom='". $cari['kolom'] ."' where rekg_pinjaman= '". $cari['rekg_pinjaman'] ."' ");
    }
   else{

// setelah data dibaca, sisipkan ke dalam tabel debitur

$hasil = mysql_query("INSERT INTO data VALUES (

'$tgl_input',
'$lnc',
'$produk',
'$no_aplikasi',
'$rekg_pinjaman',
'$nama_debitur',
'$max_kredit',
'$tenor',
'$tgl_pk',
'$developer',
'$badan',
'$perumahan',
'$proyek',
'$skim',
'$pks',
'$escrow',
'$cair_1',
'$keterangan1',
'$tgl_cair_1',
'$cair_2',
'$keterangan2',
'$tgl_cair_2',
'$cair_3',
'$keterangan3',
'$tgl_cair_3',
'$cair_4',
'$keterangan4',
'$tgl_cair_4',
'$tgl_update',
'$keterangan',
'$progress',
'$jenis',
'$cek_1',
'$keterangan_bso_1',
'$tgl_bso_1',
'$cek_2',
'$keterangan_bso_2',
'$tgl_bso_2',
'$cek_3',
'$keterangan_bso_3',
'$tgl_bso_3',
'$cek_4',
'$keterangan_bso_4',
'$tgl_bso_4',
'$evaluasi',
'$tgl_evaluasi',
'$unit',
'$transaksi',
'$pengikatan',
'$outstanding',
'$jaminan',
'$bangunan',
'$induk',
'$kategori')");
    }
}
echo "<p align='center'> <b>Import File Excel Selesai !!!<b></p>";
?>