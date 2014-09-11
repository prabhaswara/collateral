<?php
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 6000);
ini_set('max_execution_time', 6000);

//1 & 2 meningkatkan ukuran file yg diupload menjadi 10 M
//3 & 4 meningkatkan limit waktu eksekusi script menjadi 600 detik

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

$action				=	$data->val($i, 1);
$LNC				=	$data->val($i, 2);
$NOAPLIKASI			=	$data->val($i, 3);
$NAMADEBITUR		=	$data->val($i, 4);
$TEMPATLAHIR		=	$data->val($i, 5);
$TGLLAHIR			=	$data->val($i, 6);
$CIF				=	$data->val($i, 7);
$no_rekg_pinjaman	=	$data->val($i, 8);
$afiliasi			=	$data->val($i, 9);
$instansi			=	$data->val($i, 10);
$produk				=	$data->val($i, 11);
$maksimum_kredit	=	$data->val($i, 12);
$no_pk				=	$data->val($i, 13);
$tgl_pk				=	$data->val($i, 14);
$jkw_kredit			=	$data->val($i, 15);
$fixed_rate			=	$data->val($i, 16);
$tgl_jt_pk			=	$data->val($i, 17);
$tgl_jt_fixed_rate	=	$data->val($i, 18);
$lokasi_dokumen_asli	=	$data->val($i, 19);
$amplop_asli			=	$data->val($i, 20);
$amplopasli				=	$data->val($i, 21);
$lokasi_dokumen_copy	=	$data->val($i, 22);
$amplop_copy			=	$data->val($i, 23);
$amplopcopy				=	$data->val($i, 24);
$jaminan				=	$data->val($i, 25);
$jml_jaminan			=	$data->val($i, 26);
$jenis_surat_tanah		=	$data->val($i, 27);
$alamat_collateral		=	$data->val($i, 28);
$luas_tanah				=	$data->val($i, 29);
$tgl_jt_surat_tanah		=	$data->val($i, 30);
$jenis_pengikatan		=	$data->val($i, 31);
$nilai_ht				=	$data->val($i, 32);
$jkw_covernote			=	$data->val($i, 33);
$notaris				=	$data->val($i, 34);
$appraisal				=	$data->val($i, 35);
$no_ajb					=	$data->val($i, 36);
$no_surat_tanah			=	$data->val($i, 37);
$collateral_zipcode		=	$data->val($i, 38);
$luas_bangunan			=	$data->val($i, 39);
$nilai_taksasi			=	$data->val($i, 40);
$harga_tanah			=	$data->val($i, 41);
$harga_bangunan			=	$data->val($i, 42);
$harga_tanah_imb		=	$data->val($i, 43);
$harga_bangunan_imb		=	$data->val($i, 44);
$no_pengikatan			=	$data->val($i, 45);
$tgl_covernote			=	$data->val($i, 46);
$tgl_jt_covernote		=	$data->val($i, 47);
$developer				=	$data->val($i, 48);
$skim_pks				=	$data->val($i, 49);
$no_imb					=	$data->val($i, 50);
$status_imb				=	$data->val($i, 51);
$nama_perumahan			=	$data->val($i, 52);
$asuransi_jiwa			=	$data->val($i, 53);
$no_polis_ass_jiwa		=	$data->val($i, 54);
$premi_jiwa				=	$data->val($i, 55);
$nilai_pertanggungan_ass_jiwa	=	$data->val($i, 56);
$tgl_ass_jiwa					=	$data->val($i, 57);
$tgl_jt_ass_jiwa				=	$data->val($i, 58);
$asuransi_kerugian				=	$data->val($i, 59);
$no_polis_ass_kerugian			=	$data->val($i, 60);
$premi_kerugian					=	$data->val($i, 61);
$nilai_pertanggungan_ass_kerugian	=	$data->val($i, 62);
$tgl_ass_kerugian					=	$data->val($i, 63);
$tgl_jt_ass_kerugian				=	$data->val($i, 64);
$jenis_kendaraan					=	$data->val($i, 65);
$no_bpkb				=	$data->val($i, 66);
$no_rangka				=	$data->val($i, 67);
$nama_dealer			=	$data->val($i, 68);
$merk					=	$data->val($i, 69);
$no_mesin				=	$data->val($i, 70);
$no_polisi				=	$data->val($i, 71);
$status_rekg			=	$data->val($i, 72);
$tgl_pelunasan			=	$data->val($i, 73);
$memo					=	$data->val($i, 74);
$skdr					=	$data->val($i, 75);
$siup					=	$data->val($i, 76);
$tdp					=	$data->val($i, 77);
$others					=	$data->val($i, 78);
$serah					=	$data->val($i, 79);
$kendala				=	$data->val($i, 80);
$tgl_update				=	$data->val($i, 81);
$bunga					=	$data->val($i, 82);
$program				=	$data->val($i, 83);
$agama					=	$data->val($i, 84);
$npwp					=	$data->val($i, 85);
$kelamin				=	$data->val($i, 86);
$tgl_imb				=	$data->val($i, 87);
$penilai				=	$data->val($i, 88);
$tgl_taksasi			=	$data->val($i, 89);
$tinggal				=	$data->val($i, 90);
$cabang					=	$data->val($i, 91);
$no_ktp					=	$data->val($i, 92);
$ibu_kandung			=	$data->val($i, 93);
$jabatan				=	$data->val($i, 94);
$memo_appraisal  		=	$data->val($i, 95);
$plafond_dimohon 		=	$data->val($i, 96);
$nama_emergency 		=	$data->val($i, 97);
$telp_emergency 		=	$data->val($i, 98);
$alamat_kantor 			=	$data->val($i, 99);
$hubungan 				=	$data->val($i, 100);
$progress 				=	$data->val($i, 101);
$sales 					=	$data->val($i, 102);
$hp_sales 				=	$data->val($i, 103);
$kjpp 					=	$data->val($i, 104);
$status 				=	$data->val($i, 105);
$tgl_update_app 		=	$data->val($i, 106);
$tgl_update_los 		=	$data->val($i, 107);
$tgl_update_asc 		=	$data->val($i, 108);
$skim_pencairan			=	$data->val($i, 109);


    $del=mysql_query("delete from debitur WHERE no_rekg_pinjaman = '$no_rekg_pinjaman'");

	$cari = mysql_num_rows(mysql_query("SELECT * FROM debitur WHERE no_rekg_pinjaman = '$no_rekg_pinjaman'"));
    
    if (empty($NOAPLIKASI)){
    $hasil = mysql_query("INSERT INTO gagal VALUES('$no_rekg_pinjaman','$NAMADEBITUR','No. Aplikasi Kosong')");
    }
    elseif ($cari > 0 && $cari['tgl_update']!=$tgl_update){
    mysql_query("INSERT INTO debitur_log() values (

'$action',
'$LNC',
'$NOAPLIKASI',
'$NAMADEBITUR',
'$TEMPATLAHIR',
'$TGLLAHIR',
'$CIF',
'$no_rekg_pinjaman',
'$afiliasi',
'$instansi',
'$produk',
'$maksimum_kredit',
'$no_pk',
'$tgl_pk',
'$jkw_kredit',
'$fixed_rate',
'$tgl_jt_pk',
'$tgl_jt_fixed_rate',
'$lokasi_dokumen_asli',
'$amplop_asli',
'$amplopasli',
'$lokasi_dokumen_copy',
'$amplop_copy',
'$amplopcopy',
'$jaminan',
'$jml_jaminan',
'$jenis_surat_tanah',
'$alamat_collateral',
'$luas_tanah',
'$tgl_jt_surat_tanah',
'$jenis_pengikatan',
'$nilai_ht',
'$jkw_covernote',
'$notaris',
'$appraisal',
'$no_ajb',
'$no_surat_tanah',
'$collateral_zipcode',
'$luas_bangunan',
'$nilai_taksasi',
'$harga_tanah',
'$harga_bangunan',
'$harga_tanah_imb',
'$harga_bangunan_imb',
'$no_pengikatan',
'$tgl_covernote',
'$tgl_jt_covernote',
'$developer',
'$skim_pks',
'$no_imb',
'$status_imb',
'$nama_perumahan',
'$asuransi_jiwa',
'$no_polis_ass_jiwa',
'$premi_jiwa',
'$nilai_pertanggungan_ass_jiwa',
'$tgl_ass_jiwa',
'$tgl_jt_ass_jiwa',
'$asuransi_kerugian',
'$no_polis_ass_kerugian',
'$premi_kerugian',
'$nilai_pertanggungan_ass_kerugian',
'$tgl_ass_kerugian',
'$tgl_jt_ass_kerugian',
'$jenis_kendaraan',
'$no_bpkb',
'$no_rangka',
'$nama_dealer',
'$merk',
'$no_mesin',
'$no_polisi',
'$status_rekg',
'$tgl_pelunasan',
'$memo',
'$skdr',
'$siup',
'$tdp',
'$others',
'$serah',
'$kendala',
'$tgl_update',
'$bunga',
'$program',
'$agama',
'$npwp',
'$kelamin',
'$tgl_imb',
'$penilai',
'$tgl_taksasi',
'$tinggal',
'$cabang',
'$no_ktp',
'$ibu_kandung',
'$jabatan',
'$memo_appraisal',
'$plafond_dimohon',
'$nama_emergency',
'$telp_emergency',
'$alamat_kantor',
'$hubungan',
'$progress',
'$sales',
'$hp_sales',
'$kjpp',
'$status',
'$tgl_update_app',
'$tgl_update_los',
'$tgl_update_asc',
'$skim_pencairan')");

	mysql_query("update debitur_log set kolom='". $cari['kolom'] ."' where no_rekg_pinjaman= '". $cari['no_rekg_pinjaman'] ."' ");
    }
   else{

// setelah data dibaca, sisipkan ke dalam tabel debitur

$hasil = mysql_query("INSERT INTO debitur 
(action
,LNC
,NOAPLIKASI
,NAMADEBITUR
,TEMPATLAHIR
,TGLLAHIR
,CIF
,no_rekg_pinjaman
,afiliasi
,instansi
,produk
,maksimum_kredit
,no_pk
,tgl_pk
,jkw_kredit
,fixed_rate
,tgl_jt_pk
,tgl_jt_fixed_rate
,lokasi_dokumen_asli
,amplop_asli
,amplopasli
,lokasi_dokumen_copy
,amplop_copy
,amplopcopy
,jaminan
,jml_jaminan
,jenis_surat_tanah
,alamat_collateral
,luas_tanah
,tgl_jt_surat_tanah
,jenis_pengikatan
,nilai_ht
,jkw_covernote
,notaris
,appraisal
,no_ajb
,no_surat_tanah
,collateral_zipcode
,luas_bangunan
,nilai_taksasi
,harga_tanah
,harga_bangunan
,harga_tanah_imb
,harga_bangunan_imb
,no_pengikatan
,tgl_covernote
,tgl_jt_covernote
,developer
,skim_pks
,no_imb
,status_imb
,nama_perumahan
,asuransi_jiwa
,no_polis_ass_jiwa
,premi_jiwa
,nilai_pertanggungan_ass_jiwa
,tgl_ass_jiwa
,tgl_jt_ass_jiwa
,asuransi_kerugian
,no_polis_ass_kerugian
,premi_kerugian
,nilai_pertanggungan_ass_kerugian
,tgl_ass_kerugian
,tgl_jt_ass_kerugian
,jenis_kendaraan
,no_bpkb
,no_rangka
,nama_dealer
,merk
,no_mesin
,no_polisi
,status_rekg
,tgl_pelunasan
,memo
,skdr
,siup
,tdp
,others
,serah
,kendala
,tgl_update
,bunga
,program
,agama
,npwp
,kelamin
,tgl_imb
,penilai
,tgl_taksasi
,tinggal
,cabang
,no_ktp
,ibu_kandung
,jabatan
,memo_appraisal
,plafond_dimohon
,nama_emergency
,telp_emergency
,alamat_kantor
,hubungan
,progress
,sales
,hp_sales
,kjpp
,status
,tgl_update_app
,tgl_update_los
,tgl_update_asc
,skim_pencairan
)    
VALUES (

'$action',
'$LNC',
'$NOAPLIKASI',
'$NAMADEBITUR',
'$TEMPATLAHIR',
'$TGLLAHIR',
'$CIF',
'$no_rekg_pinjaman',
'$afiliasi',
'$instansi',
'$produk',
'$maksimum_kredit',
'$no_pk',
'$tgl_pk',
'$jkw_kredit',
'$fixed_rate',
'$tgl_jt_pk',
'$tgl_jt_fixed_rate',
'$lokasi_dokumen_asli',
'$amplop_asli',
'$amplopasli',
'$lokasi_dokumen_copy',
'$amplop_copy',
'$amplopcopy',
'$jaminan',
'$jml_jaminan',
'$jenis_surat_tanah',
'$alamat_collateral',
'$luas_tanah',
'$tgl_jt_surat_tanah',
'$jenis_pengikatan',
'$nilai_ht',
'$jkw_covernote',
'$notaris',
'$appraisal',
'$no_ajb',
'$no_surat_tanah',
'$collateral_zipcode',
'$luas_bangunan',
'$nilai_taksasi',
'$harga_tanah',
'$harga_bangunan',
'$harga_tanah_imb',
'$harga_bangunan_imb',
'$no_pengikatan',
'$tgl_covernote',
'$tgl_jt_covernote',
'$developer',
'$skim_pks',
'$no_imb',
'$status_imb',
'$nama_perumahan',
'$asuransi_jiwa',
'$no_polis_ass_jiwa',
'$premi_jiwa',
'$nilai_pertanggungan_ass_jiwa',
'$tgl_ass_jiwa',
'$tgl_jt_ass_jiwa',
'$asuransi_kerugian',
'$no_polis_ass_kerugian',
'$premi_kerugian',
'$nilai_pertanggungan_ass_kerugian',
'$tgl_ass_kerugian',
'$tgl_jt_ass_kerugian',
'$jenis_kendaraan',
'$no_bpkb',
'$no_rangka',
'$nama_dealer',
'$merk',
'$no_mesin',
'$no_polisi',
'$status_rekg',
'$tgl_pelunasan',
'$memo',
'$skdr',
'$siup',
'$tdp',
'$others',
'$serah',
'$kendala',
'$tgl_update',
'$bunga',
'$program',
'$agama',
'$npwp',
'$kelamin',
'$tgl_imb',
'$penilai',
'$tgl_taksasi',
'$tinggal',
'$cabang',
'$no_ktp',
'$ibu_kandung',
'$jabatan',
'$memo_appraisal',
'$plafond_dimohon',
'$nama_emergency',
'$telp_emergency',
'$alamat_kantor',
'$hubungan',
'$progress',
'$sales',
'$hp_sales',
'$kjpp',
'$status',
'$tgl_update_app',
'$tgl_update_los',
'$tgl_update_asc',
'$skim_pencairan')")or die(mysql_error());
    }
}
echo "<p align='center'> <b>Import File Excel Selesai !!!<b></p>";
?>