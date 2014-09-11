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
header("Content-Disposition: attachment;filename=EXPORT4ELO.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();
$posisi  = 0;
$no=$posisi+1;
//Buatlah Judul Tabelnya
//xlsWriteLabel(0,0,"DATA CADS LNC");

//Buatlah nama kolom dimulai baris ke 3
xlsWriteLabel(2,0,"NO.");
xlsWriteLabel(2,1,"NO. APLIKASI");
xlsWriteLabel(2,2,"NO.REKG. PINJAMAN");
xlsWriteLabel(2,3,"CIF");
xlsWriteLabel(2,4,"NAMA DEPAN");
xlsWriteLabel(2,5,"NAMA TENGAH");
xlsWriteLabel(2,6,"NAMA BELAKANG");
xlsWriteLabel(2,7,"JENIS KELAMIN");
xlsWriteLabel(2,8,"ALAMAT1");
xlsWriteLabel(2,9,"ALAMAT2");
xlsWriteLabel(2,10,"ALAMAT3");
xlsWriteLabel(2,11,"NO.TELP DEPAN");
xlsWriteLabel(2,12,"NO.TELP BELAKANG");
xlsWriteLabel(2,13,"PRODUK");
xlsWriteLabel(2,14,"TENOR");
xlsWriteLabel(2,15,"JENIS JAMINAN");
xlsWriteLabel(2,16,"ALAMAT OBYEK JAMINAN");
xlsWriteLabel(2,17,"NO. KEPEMILIKAN DOKUMEN");
xlsWriteLabel(2,18,"KEPEMILIKAN DOKUMEN");
xlsWriteLabel(2,19,"TGL.JT AGUNAN");
xlsWriteLabel(2,20,"JENIS HT");
xlsWriteLabel(2,21,"NO. PENGIKATAN");
xlsWriteLabel(2,22,"TGL. PENGIKATAN");
xlsWriteLabel(2,23,"NILAI HT");
xlsWriteLabel(2,24,"NO. IMB");
xlsWriteLabel(2,25,"TGL. IMB");
xlsWriteLabel(2,26,"TGL. TAKSASI");
xlsWriteLabel(2,27,"NILAI TAKSASI");
xlsWriteLabel(2,28,"PENILAI");
xlsWriteLabel(2,29,"ASS. KERUGIAN");
xlsWriteLabel(2,30,"NO. POLIS ASS KERUGIAN");
xlsWriteLabel(2,31,"TGL. ASS. KERUGIAN");
xlsWriteLabel(2,32,"TGL. JT TEMPO ASS. KERUGIAN");
xlsWriteLabel(2,33,"NILAI PERTANGG. ASS. KERUGIAN");
xlsWriteLabel(2,34,"MASA PERTANGG. ASS. KERUGIAN");
xlsWriteLabel(2,35,"PREMI KERUGIAN");
xlsWriteLabel(2,36,"ASS. JIWA");
xlsWriteLabel(2,37,"NO.POLIS ASS JIWA");
xlsWriteLabel(2,38,"TGL. ASS. JIWA");
xlsWriteLabel(2,39,"TGL. JT ASS JIWA");
xlsWriteLabel(2,40,"NILAI PERTGG.ASS.JIWA");
xlsWriteLabel(2,41,"MASA PERTANGG. ASS. JIWA");
xlsWriteLabel(2,42,"PREMI ASS.JIWA");
xlsWriteLabel(2,43,"KLUIS DOK. ASLI");
xlsWriteLabel(2,44,"BARIS DOK. ASLI");
xlsWriteLabel(2,45,"LACI DOK. ASLI");
xlsWriteLabel(2,46,"NO.BANTEK ASLI");
xlsWriteLabel(2,47,"NO. AMPLOP ASLI");
xlsWriteLabel(2,48,"KLUIS DOK. KERJA");
xlsWriteLabel(2,49,"BARIS DOK. KERJA");
xlsWriteLabel(2,50,"LACI DOK. KERJA");
xlsWriteLabel(2,51,"NO. BANTEK KERJA");
xlsWriteLabel(2,52,"NO. AMPLOP KERJA");
xlsWriteLabel(2,53,"LOKASI LAMA");

$xlsRow = 3;

//letakkan data tersebut sesuai dengan kolom
while($row=mysql_fetch_array($result)){
   
//xlsWriteNumber($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,0,$no);
xlsWriteLabel($xlsRow,1,$row['NOAPLIKASI']);
xlsWriteLabel($xlsRow,2,$row['no_rekg_pinjaman']);
xlsWriteLabel($xlsRow,3,$row['CIF']);
xlsWriteLabel($xlsRow,4,$row['NAMADEBITUR']);
xlsWriteLabel($xlsRow,5,$row['KOSONG']);
xlsWriteLabel($xlsRow,6,$row['KOSONG']);
xlsWriteLabel($xlsRow,7,$row['kelamin']);
xlsWriteLabel($xlsRow,8,$row['tinggal']);
xlsWriteLabel($xlsRow,9,$row['KOSONG']);
xlsWriteLabel($xlsRow,10,$row['KOSONG']);
xlsWriteLabel($xlsRow,11,$row['KOSONG']);
xlsWriteLabel($xlsRow,12,$row['KOSONG']);
xlsWriteLabel($xlsRow,13,$row['produk']);
xlsWriteLabel($xlsRow,14,$row['jkw_kredit']);
xlsWriteLabel($xlsRow,15,$row['jenis_surat_tanah']);
xlsWriteLabel($xlsRow,16,$row['alamat_collateral']);
xlsWriteLabel($xlsRow,17,$row['no_surat_tanah']);
xlsWriteLabel($xlsRow,18,$row['appraisal']);
xlsWriteLabel($xlsRow,19,$row['tgl_jt_surat_tanah']);
xlsWriteLabel($xlsRow,20,$row['jenis_pengikatan']);
xlsWriteLabel($xlsRow,21,$row['no_pengikatan']);
xlsWriteLabel($xlsRow,22,$row['tgl_covernote']);
xlsWriteLabel($xlsRow,23,$row['nilai_ht']);
xlsWriteLabel($xlsRow,24,$row['no_imb']);
xlsWriteLabel($xlsRow,25,$row['tgl_imb']);
xlsWriteLabel($xlsRow,26,$row['tgl_taksasi']);
xlsWriteLabel($xlsRow,27,$row['nilai_taksasi']);
xlsWriteLabel($xlsRow,28,$row['penilai']);
xlsWriteLabel($xlsRow,29,$row['asuransi_kerugian']);
xlsWriteLabel($xlsRow,30,$row['no_polis_ass_kerugian']);
xlsWriteLabel($xlsRow,31,$row['tgl_ass_kerugian']);
xlsWriteLabel($xlsRow,32,$row['tgl_jt_ass_kerugian']);
xlsWriteLabel($xlsRow,33,$row['nilai_pertanggungan_ass_kerugian']);
xlsWriteLabel($xlsRow,34,$row['KOSONG']);
xlsWriteLabel($xlsRow,35,$row['premi_kerugian']);
xlsWriteLabel($xlsRow,36,$row['asuransi_jiwa']);
xlsWriteLabel($xlsRow,37,$row['no_polis_ass_jiwa']);
xlsWriteLabel($xlsRow,38,$row['tgl_ass_jiwa']);
xlsWriteLabel($xlsRow,39,$row['tgl_jt_ass_jiwa']);
xlsWriteLabel($xlsRow,40,$row['nilai_pertanggungan_ass_jiwa']);
xlsWriteLabel($xlsRow,41,$row['jkw_kredit']/12);
xlsWriteLabel($xlsRow,42,$row['premi_jiwa']);
xlsWriteLabel($xlsRow,43,$row['lokasi_dokumen_asli']);
xlsWriteLabel($xlsRow,44,$row['KOSONG']);
xlsWriteLabel($xlsRow,45,$row['KOSONG']);
xlsWriteLabel($xlsRow,46,$row['amplop_asli']);
xlsWriteLabel($xlsRow,47,$row['amplopasli']);
xlsWriteLabel($xlsRow,48,$row['lokasi_dokumen_copy']);
xlsWriteLabel($xlsRow,49,$row['KOSONG']);
xlsWriteLabel($xlsRow,50,$row['KOSONG']);
xlsWriteLabel($xlsRow,51,$row['amplop_copy']);
xlsWriteLabel($xlsRow,52,$row['amplopcopy']);
xlsWriteLabel($xlsRow,53,$row['KOSONG']);
$no++;
$xlsRow++;

}
xlsEOF();
exit();
?>