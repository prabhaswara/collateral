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
xlsWriteLabel(0,0,"tgl_input ");
xlsWriteLabel(0,1,"lnc ");
xlsWriteLabel(0,2,"produk ");
xlsWriteLabel(0,3,"no_aplikasi ");
xlsWriteLabel(0,4,"rekg_pinjaman ");
xlsWriteLabel(0,5,"nama_debitur ");
xlsWriteLabel(0,6,"max_kredit ");
xlsWriteLabel(0,7,"tenor ");
xlsWriteLabel(0,8,"tgl_pk ");
xlsWriteLabel(0,9,"developer ");
xlsWriteLabel(0,10,"badan ");
xlsWriteLabel(0,11,"perumahan ");
xlsWriteLabel(0,12,"proyek ");
xlsWriteLabel(0,13,"skim ");
xlsWriteLabel(0,14,"pks ");
xlsWriteLabel(0,15,"escrow ");
xlsWriteLabel(0,16,"cair_1 ");
xlsWriteLabel(0,17,"keterangan1 ");
xlsWriteLabel(0,18,"tgl_cair_1 ");
xlsWriteLabel(0,19,"cair_2 ");
xlsWriteLabel(0,20,"keterangan2 ");
xlsWriteLabel(0,21,"tgl_cair_2 ");
xlsWriteLabel(0,22,"cair_3 ");
xlsWriteLabel(0,23,"keterangan3 ");
xlsWriteLabel(0,24,"tgl_cair_3 ");
xlsWriteLabel(0,25,"cair_4 ");
xlsWriteLabel(0,26,"keterangan4 ");
xlsWriteLabel(0,27,"tgl_cair_4 ");
xlsWriteLabel(0,28,"tgl_update ");
xlsWriteLabel(0,29,"keterangan ");
xlsWriteLabel(0,30,"progress ");
xlsWriteLabel(0,31,"jenis ");
xlsWriteLabel(0,32,"cek_1 ");
xlsWriteLabel(0,33,"keterangan_bso_1 ");
xlsWriteLabel(0,34,"tgl_bso_1 ");
xlsWriteLabel(0,35,"cek_2 ");
xlsWriteLabel(0,36,"keterangan_bso_2 ");
xlsWriteLabel(0,37,"tgl_2 ");
xlsWriteLabel(0,38,"cek_3 ");
xlsWriteLabel(0,39,"keterangan_bso_3 ");
xlsWriteLabel(0,40,"tgl_3 ");
xlsWriteLabel(0,41,"cek_4 ");
xlsWriteLabel(0,42,"keterangan_bso_4 ");
xlsWriteLabel(0,43,"tgl_4 ");
xlsWriteLabel(0,44,"evaluasi ");
xlsWriteLabel(0,45,"tgl_evaluasi");
xlsWriteLabel(0,46,"unit");
xlsWriteLabel(0,47,"transaksi");
xlsWriteLabel(0,48,"pengikatan");

$xlsRow = 1;

//letakkan data tersebut sesuai dengan kolom
while($row=mysql_fetch_array($result)){
   
//xlsWriteNumber($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,0,$row['tgl_input']);
xlsWriteLabel($xlsRow,1,$row['lnc']);
xlsWriteLabel($xlsRow,2,$row['produk']);
xlsWriteLabel($xlsRow,3,$row['no_aplikasi']);
xlsWriteLabel($xlsRow,4,$row['rekg_pinjaman']);
xlsWriteLabel($xlsRow,5,$row['nama_debitur']);
xlsWriteLabel($xlsRow,6,$row['max_kredit']);
xlsWriteLabel($xlsRow,7,$row['tenor']);
xlsWriteLabel($xlsRow,8,$row['tgl_pk']);
xlsWriteLabel($xlsRow,9,$row['developer']);
xlsWriteLabel($xlsRow,10,$row['badan']);
xlsWriteLabel($xlsRow,11,$row['perumahan']);
xlsWriteLabel($xlsRow,12,$row['proyek']);
xlsWriteLabel($xlsRow,13,$row['skim']);
xlsWriteLabel($xlsRow,14,$row['pks']);
xlsWriteLabel($xlsRow,15,$row['escrow']);
xlsWriteLabel($xlsRow,16,$row['cair_1']);
xlsWriteLabel($xlsRow,17,$row['keterangan1']);
xlsWriteLabel($xlsRow,18,$row['tgl_cair_1']);
xlsWriteLabel($xlsRow,19,$row['cair_2']);
xlsWriteLabel($xlsRow,20,$row['keterangan2']);
xlsWriteLabel($xlsRow,21,$row['tgl_cair_2']);
xlsWriteLabel($xlsRow,22,$row['cair_3']);
xlsWriteLabel($xlsRow,23,$row['keterangan3']);
xlsWriteLabel($xlsRow,24,$row['tgl_cair_3']);
xlsWriteLabel($xlsRow,25,$row['cair_4']);
xlsWriteLabel($xlsRow,26,$row['keterangan4']);
xlsWriteLabel($xlsRow,27,$row['tgl_cair_4']);
xlsWriteLabel($xlsRow,28,$row['tgl_update']);
xlsWriteLabel($xlsRow,29,$row['keterangan']);
xlsWriteLabel($xlsRow,30,$row['progress']);
xlsWriteLabel($xlsRow,31,$row['jenis']);
xlsWriteLabel($xlsRow,32,$row['cek_1']);
xlsWriteLabel($xlsRow,33,$row['keterangan_bso_1']);
xlsWriteLabel($xlsRow,34,$row['tgl_bso_1']);
xlsWriteLabel($xlsRow,35,$row['cek_2']);
xlsWriteLabel($xlsRow,36,$row['keterangan_bso_2']);
xlsWriteLabel($xlsRow,37,$row['tgl_2']);
xlsWriteLabel($xlsRow,38,$row['cek_3']);
xlsWriteLabel($xlsRow,39,$row['keterangan_bso_3']);
xlsWriteLabel($xlsRow,40,$row['tgl_3']);
xlsWriteLabel($xlsRow,41,$row['cek_4']);
xlsWriteLabel($xlsRow,42,$row['keterangan_bso_4']);
xlsWriteLabel($xlsRow,43,$row['tgl_4']);
xlsWriteLabel($xlsRow,44,$row['evaluasi']);
xlsWriteLabel($xlsRow,45,$row['tgl_evaluasi']);
xlsWriteLabel($xlsRow,46,$row['unit']);
xlsWriteLabel($xlsRow,47,$row['transaksi']);
xlsWriteLabel($xlsRow,48,$row['pengikatan']);

$xlsRow++;

}
xlsEOF();
exit();
?>