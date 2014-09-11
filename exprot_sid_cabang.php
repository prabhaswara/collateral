<?
$koneksi_oke= mysql_connect("localhost","root","");
mysql_select_db("collateral_db");
$result=mysql_query("select * from debitur");

function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=EXPORT4SID.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();
$posisi  = 0;
$no=$posisi+1;
//Buatlah Judul Tabelnya
//xlsWriteLabel(0,0,"DATA CADS LNC");

//Buatlah nama kolom dimulai baris ke 3
xlsWriteLabel(2,0,"NO.");
xlsWriteLabel(2,1,"KD CAB");
xlsWriteLabel(2,2,"CIF");
xlsWriteLabel(2,3,"NO. REKG. PINJAMAN");
xlsWriteLabel(2,4,"NAMA DEBITUR");
xlsWriteLabel(2,5,"NO. PERJANJIAN KREDIT");
xlsWriteLabel(2,6,"TGL. PK");
xlsWriteLabel(2,7,"JW");
xlsWriteLabel(2,8,"TGL. JT");
xlsWriteLabel(2,9,"MAKSIMUM PINJAMAN");
xlsWriteLabel(2,10,"KODE JENIS KRD");
xlsWriteLabel(2,11,"JENIS JAMINAN");
xlsWriteLabel(2,12,"NO.SERTIFIKAT");
xlsWriteLabel(2,13,"TGL. SERTIFIKAT");
xlsWriteLabel(2,14,"NAMA PEMILIK JAMINAN");
xlsWriteLabel(2,15,"TELAH BALIK NAMA");
xlsWriteLabel(2,16,"JENIS PENGIKATAN");
xlsWriteLabel(2,17,"NILAI PENGIKATAN");
xlsWriteLabel(2,18,"ALAMAT JAMINAN");
xlsWriteLabel(2,19,"NILAI TANAH");
xlsWriteLabel(2,20,"LUAS TANAH");
xlsWriteLabel(2,21,"NILAI BANGUNAN");
xlsWriteLabel(2,22,"LUAS BANGUNAN");
xlsWriteLabel(2,23,"TGL. TAKSASI");
xlsWriteLabel(2,24,"PETUGAS TAKSASI");
xlsWriteLabel(2,25,"NILAI PERTANGGUNGAN ASURANSI");
xlsWriteLabel(2,26,"RATE");
xlsWriteLabel(2,27,"ALAMAT DEBITUR");
xlsWriteLabel(2,28,"TEMPAT LAHIR");
xlsWriteLabel(2,29,"TANGGAL LAHIR");
xlsWriteLabel(2,30,"NO. KTP/APLIKASI");
xlsWriteLabel(2,31,"STATUS PERKAWINAN");
xlsWriteLabel(2,32,"JENIS KELAMIN");
xlsWriteLabel(2,33,"PENDIDIKAN");
xlsWriteLabel(2,34,"NAMA IBU KANDUNG");
xlsWriteLabel(2,35,"NPWP");
xlsWriteLabel(2,36,"NAMA PERUSAHAAN");
xlsWriteLabel(2,37,"ALAMAT PERUSAHAAN");
xlsWriteLabel(2,38,"NO. TELP. PERUSAHAAN");
$xlsRow = 3;

//letakkan data tersebut sesuai dengan kolom
while($row=mysql_fetch_array($result)){
   
//xlsWriteNumber($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,0,$no);
xlsWriteLabel($xlsRow,1,$row['cabang']);
xlsWriteLabel($xlsRow,2,$row['CIF']);
xlsWriteLabel($xlsRow,3,$row['no_rekg_pinjaman']);
xlsWriteLabel($xlsRow,4,$row['NAMADEBITUR']);
xlsWriteLabel($xlsRow,5,$row['no_pk']);
xlsWriteLabel($xlsRow,6,$row['tgl_pk']);
xlsWriteLabel($xlsRow,7,$row['jkw_kredit']);
xlsWriteLabel($xlsRow,8,$row['tgl_jt_pk']);
xlsWriteLabel($xlsRow,9,$row['maksimum_kredit']);
xlsWriteLabel($xlsRow,10,$row['KOSONG']);
xlsWriteLabel($xlsRow,11,$row['jenis_surat_tanah']);
xlsWriteLabel($xlsRow,12,$row['no_surat_tanah']);
xlsWriteLabel($xlsRow,13,$row['nilai_taksasi']);
xlsWriteLabel($xlsRow,14,$row['appraisal']);
xlsWriteLabel($xlsRow,15,$row['KOSONG']);
xlsWriteLabel($xlsRow,16,$row['jenis_pengikatan']);
xlsWriteLabel($xlsRow,17,$row['nilai_ht']);
xlsWriteLabel($xlsRow,18,$row['alamat collateral']);
xlsWriteLabel($xlsRow,19,$row['harga_tanah']);
xlsWriteLabel($xlsRow,20,$row['luas_tanah']);
xlsWriteLabel($xlsRow,21,$row['nilai_bangunan']);
xlsWriteLabel($xlsRow,22,$row['luas_bangunan']);
xlsWriteLabel($xlsRow,23,$row['tgl_taksasi']);
xlsWriteLabel($xlsRow,24,$row['penilai']);
xlsWriteLabel($xlsRow,25,$row['nilai_pertanggungan_ass_kerugian']);
xlsWriteLabel($xlsRow,26,$row['rate']);
xlsWriteLabel($xlsRow,27,$row['tinggal']);
xlsWriteLabel($xlsRow,28,$row['TEMPATLAHIR']);
xlsWriteLabel($xlsRow,29,$row['TGLLAHIR']);
xlsWriteLabel($xlsRow,30,$row['NOAPLIKASI']);
xlsWriteLabel($xlsRow,31,$row['KOSONG']);
xlsWriteLabel($xlsRow,32,$row['kelamin']);
xlsWriteLabel($xlsRow,33,$row['KOSONG']);
xlsWriteLabel($xlsRow,34,$row['KOSONG']);
xlsWriteLabel($xlsRow,35,$row['KOSONG']);
xlsWriteLabel($xlsRow,36,$row['instansi']);
xlsWriteLabel($xlsRow,37,$row['KOSONG']);
xlsWriteLabel($xlsRow,38,$row['KOSONG']);
$no++;
$xlsRow++;

}
xlsEOF();
exit();
?>