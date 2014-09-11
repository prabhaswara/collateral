<?
$koneksi_oke= mysql_connect("localhost","root","");
mysql_select_db("griya");
$result=mysql_query("select * from data");

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
header("Content-Disposition: attachment;filename=EXPORTSMPB.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();
//Buatlah Judul Tabelnya
//xlsWriteLabel(0,0,"DATA CADS LNC");

//Buatlah nama kolom dimulai baris ke 1
//xlsWriteLabel(0,0,"No.");
xlsWriteLabel(0,0,"TGL. INPUT");
xlsWriteLabel(0,1,"LNC");
xlsWriteLabel(0,2,"PRODUK");
xlsWriteLabel(0,3,"JENIS");
xlsWriteLabel(0,4,"NO. APLIKASI");
xlsWriteLabel(0,5,"No. REKG. PINJAMAN");
xlsWriteLabel(0,6,"NAMA DEBITUR");
xlsWriteLabel(0,7,"MAX KREDIT");
xlsWriteLabel(0,8,"TENOR");
xlsWriteLabel(0,9,"TGL. PK");
xlsWriteLabel(0,10,"PENJUAL");
xlsWriteLabel(0,11,"BADAN PERUSAHAAN");
xlsWriteLabel(0,12,"PROYEK");
xlsWriteLabel(0,13,"JENIS PROYEK");
xlsWriteLabel(0,14,"SKIM");
xlsWriteLabel(0,15,"NO. PKS");
xlsWriteLabel(0,16,"NO. REKG. ESCROW");
xlsWriteLabel(0,17,"CAIR TAHAP I");
xlsWriteLabel(0,18,"KETERANGAN I");
xlsWriteLabel(0,19,"TGL. CAIR TAHAP I");
xlsWriteLabel(0,20,"CAIR TAHAP II");
xlsWriteLabel(0,21,"KETERANGAN II");
xlsWriteLabel(0,22,"TGL. CAIR TAHAP II");
xlsWriteLabel(0,23,"CAIR TAHAP III");
xlsWriteLabel(0,24,"KETERANGAN III");
xlsWriteLabel(0,25,"TGL. CAIR TAHAP III");
xlsWriteLabel(0,26,"CAIR TAHAP IV");
xlsWriteLabel(0,27,"KETERANGAN IV");
xlsWriteLabel(0,28,"TGL. CAIR TAHAP IV");
xlsWriteLabel(0,29,"TGL. UPDATE");
xlsWriteLabel(0,30,"KETERANGAN");
xlsWriteLabel(0,31,"STATUS");

$xlsRow = 1;

//letakkan data tersebut sesuai dengan kolom
while($row=mysql_fetch_array($result)){
   
//xlsWriteNumber($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,0,$row['tgl_input']);
xlsWriteLabel($xlsRow,1,$row['lnc']);
xlsWriteLabel($xlsRow,2,$row['produk']);
xlsWriteLabel($xlsRow,3,$row['jenis']);
xlsWriteLabel($xlsRow,4,$row['no_aplikasi']);
xlsWriteLabel($xlsRow,5,$row['rekg_pinjaman']);
xlsWriteLabel($xlsRow,6,$row['nama_debitur']);
xlsWriteLabel($xlsRow,7,$row['max_kredit']);
xlsWriteLabel($xlsRow,8,$row['tenor']);
xlsWriteLabel($xlsRow,9,$row['tgl_pk']);
xlsWriteLabel($xlsRow,10,$row['developer']);
xlsWriteLabel($xlsRow,11,$row['badan']);
xlsWriteLabel($xlsRow,12,$row['perumahan']);
xlsWriteLabel($xlsRow,13,$row['proyek']);
xlsWriteLabel($xlsRow,14,$row['skim']);
xlsWriteLabel($xlsRow,15,$row['pks']);
xlsWriteLabel($xlsRow,16,$row['escrow']);
xlsWriteLabel($xlsRow,17,$row['cair_1']);
xlsWriteLabel($xlsRow,18,$row['keterangan1']);
xlsWriteLabel($xlsRow,19,$row['tgl_cair_1']);
xlsWriteLabel($xlsRow,20,$row['cair_2']);
xlsWriteLabel($xlsRow,21,$row['keterangan2']);
xlsWriteLabel($xlsRow,22,$row['tgl_cair_2']);
xlsWriteLabel($xlsRow,23,$row['cair_3']);
xlsWriteLabel($xlsRow,24,$row['keterangan3']);
xlsWriteLabel($xlsRow,25,$row['tgl_cair_3']);
xlsWriteLabel($xlsRow,26,$row['cair_4']);
xlsWriteLabel($xlsRow,27,$row['keterangan4']);
xlsWriteLabel($xlsRow,28,$row['tgl_cair_4']);
xlsWriteLabel($xlsRow,29,$row['tgl_update']);
xlsWriteLabel($xlsRow,30,$row['keterangan']);
xlsWriteLabel($xlsRow,31,$row['progress']);
$xlsRow++;

}
xlsEOF();
exit();
?>