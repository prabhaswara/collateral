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
header("Content-Disposition: attachment;filename=EXPORTCADS.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();
//Buatlah Judul Tabelnya
//xlsWriteLabel(0,0,"DATA CADS LNC");

//Buatlah nama kolom dimulai baris ke 1
//xlsWriteLabel(0,0,"No.");
xlsWriteLabel(0,0,"TGL. INPUT");
xlsWriteLabel(0,1,"LNC");
xlsWriteLabel(0,2,"NO. APLIKASI");
xlsWriteLabel(0,3,"NAMA DEBITUR");
xlsWriteLabel(0,4,"TEMPAT LAHIR");
xlsWriteLabel(0,5,"TGL. LAHIR");
xlsWriteLabel(0,6,"CIF");
xlsWriteLabel(0,7,"NO.REKG. PINJAMAN");
xlsWriteLabel(0,8,"AFILIASI");
xlsWriteLabel(0,9,"INSTANSI");
xlsWriteLabel(0,10,"PRODUK");
xlsWriteLabel(0,11,"PLAFOND");
xlsWriteLabel(0,12,"NO. PK");
xlsWriteLabel(0,13,"TGL. PK");
xlsWriteLabel(0,14,"JKW. KREDIT");
xlsWriteLabel(0,15,"FIX RATE");
xlsWriteLabel(0,16,"TGL. JT TEMPO");
xlsWriteLabel(0,17,"TGL. JT FIX");
xlsWriteLabel(0,18,"LOKASI DOK. ASLI");
xlsWriteLabel(0,19,"NO.BANTEK ASLI");
xlsWriteLabel(0,20,"NO. AMPLOP ASLI");
xlsWriteLabel(0,21,"LOKASI DOK. COPY");
xlsWriteLabel(0,22,"NO. BANTEK COPY");
xlsWriteLabel(0,23,"NO. AMPLOP COPY");
xlsWriteLabel(0,24,"STATUS SERTIFIKAT");
xlsWriteLabel(0,25,"NO. GS/SU");
xlsWriteLabel(0,26,"JENIS SURAT TANAH");
xlsWriteLabel(0,27,"ALAMAT OBYEK JAMINAN");
xlsWriteLabel(0,28,"LUAS TANAH");
xlsWriteLabel(0,29,"TGL.JT SURAT TANAH");
xlsWriteLabel(0,30,"JENIS HT");
xlsWriteLabel(0,31,"NILAI HT");
xlsWriteLabel(0,32,"JKW COVERNOTE");
xlsWriteLabel(0,33,"NAMA NOTARIS");
xlsWriteLabel(0,34,"NAMA PEMILIK JAMINAN");
xlsWriteLabel(0,35,"NO. AJB");
xlsWriteLabel(0,36,"NO. KEPEMILIKAN TANAH");
xlsWriteLabel(0,37,"COLLATERAL ZIPCODE");
xlsWriteLabel(0,38,"LUAS BANGUNAN");
xlsWriteLabel(0,39,"TGL. SERTIFIKAT");
xlsWriteLabel(0,40,"HARGA TANAH");
xlsWriteLabel(0,41,"HARGA BANGUNAN");
xlsWriteLabel(0,42,"HARGA TANAH IMB/M2");
xlsWriteLabel(0,43,"HARGA BANGUNAN IMB/M2");
xlsWriteLabel(0,44,"NO. PENGIKATAN");
xlsWriteLabel(0,45,"TGL. COVERNOTE");
xlsWriteLabel(0,46,"TGL JT COVERNOTE");
xlsWriteLabel(0,47,"DEVELOPER");
xlsWriteLabel(0,48,"SKIM PKS");
xlsWriteLabel(0,49,"NO. IMB");
xlsWriteLabel(0,50,"STATUS IMB");
xlsWriteLabel(0,51,"NAMA PERUMAHAN");
xlsWriteLabel(0,52,"ASS. JIWA");
xlsWriteLabel(0,53,"NO.POLIS ASS JW");
xlsWriteLabel(0,54,"PREMI ASS.JW");
xlsWriteLabel(0,55,"NILAI PERTANGG ASS JW");
xlsWriteLabel(0,56,"TGL. ASS JW");
xlsWriteLabel(0,57,"TGL. JT ASS JW");
xlsWriteLabel(0,58,"ASS. KERUGIAN");
xlsWriteLabel(0,59,"NO. POLIS ASS KERUGIAN");
xlsWriteLabel(0,60,"PREMI KERUGIAN");
xlsWriteLabel(0,61,"NILAI PERTGG ASS KERUGIAN");
xlsWriteLabel(0,62,"TGL. ASS KERUGIAN");
xlsWriteLabel(0,63,"TGL. JT ASS KERUGIAN");
xlsWriteLabel(0,64,"JENIS KENDARAAN");
xlsWriteLabel(0,65,"NO. BPKB");
xlsWriteLabel(0,66,"NO. RANGKA");
xlsWriteLabel(0,67,"NAMA DEALER");
xlsWriteLabel(0,68,"MERK");
xlsWriteLabel(0,69,"NO. MESIN");
xlsWriteLabel(0,70,"NO. POLISI");
xlsWriteLabel(0,71,"STATUS REKG");
xlsWriteLabel(0,72,"TGL. LUNAS");
xlsWriteLabel(0,73,"MEMO");
xlsWriteLabel(0,74,"SKDR");
xlsWriteLabel(0,75,"SIUP");
xlsWriteLabel(0,76,"TDP");
xlsWriteLabel(0,77,"OTHERS");
xlsWriteLabel(0,78,"STATUS PENYERAHAN JAMINAN");
xlsWriteLabel(0,79,"KENDALA");
xlsWriteLabel(0,80,"TGL. UPDATE");
xlsWriteLabel(0,81,"BUNGA");
xlsWriteLabel(0,82,"PROGRAM");
xlsWriteLabel(0,83,"AGAMA");
xlsWriteLabel(0,84,"NO. NPWP");
xlsWriteLabel(0,85,"JENIS KELAMIN");
xlsWriteLabel(0,86,"TGL. IMB");
xlsWriteLabel(0,87,"PENILAI");
xlsWriteLabel(0,88,"TGL. TAKSASI");
xlsWriteLabel(0,89,"ALAMAT");
xlsWriteLabel(0,90,"KODE CABANG");
xlsWriteLabel(0,91,"NO. KTP");
xlsWriteLabel(0,92,"IBU KANDUNG");
xlsWriteLabel(0,93,"JABATAN");
xlsWriteLabel(0,94,"MEMO APPRAISAL");
xlsWriteLabel(0,95,"PLAFOND DIMOHON");
xlsWriteLabel(0,96,"NAMA EMERGENCY");
xlsWriteLabel(0,97,"NO.TELP. EMERGENCY");
xlsWriteLabel(0,98,"ALAMAT KANTOR");
xlsWriteLabel(0,99,"HUBUNGAN EMERGENCY");
xlsWriteLabel(0,100,"PROGRESS BANGUNAN");
xlsWriteLabel(0,101,"NAMA SALES");
xlsWriteLabel(0,102,"NO. HP SALES");
xlsWriteLabel(0,103,"KJPP");
xlsWriteLabel(0,104,"STATUS APLIKASI");
xlsWriteLabel(0,105,"TGL.UPDATE APP");
xlsWriteLabel(0,106,"TGL.UPDATE LOS");
xlsWriteLabel(0,107,"TGL.UPDATE ASC");
xlsWriteLabel(0,108,"SKIM PENCAIRAN");

$xlsRow = 1;

//letakkan data tersebut sesuai dengan kolom
while($row=mysql_fetch_array($result)){
   
//xlsWriteNumber($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,0,$row['action']);
xlsWriteLabel($xlsRow,1,$row['LNC']);
xlsWriteLabel($xlsRow,2,$row['NOAPLIKASI']);
xlsWriteLabel($xlsRow,3,$row['NAMADEBITUR']);
xlsWriteLabel($xlsRow,4,$row['TEMPATLAHIR']);
xlsWriteLabel($xlsRow,5,$row['TGLLAHIR']);
xlsWriteLabel($xlsRow,6,$row['CIF']);
xlsWriteLabel($xlsRow,7,$row['no_rekg_pinjaman']);
xlsWriteLabel($xlsRow,8,$row['afiliasi']);
xlsWriteLabel($xlsRow,9,$row['instansi']);
xlsWriteLabel($xlsRow,10,$row['produk']);
xlsWriteLabel($xlsRow,11,$row['maksimum_kredit']);
xlsWriteLabel($xlsRow,12,$row['no_pk']);
xlsWriteLabel($xlsRow,13,$row['tgl_pk']);
xlsWriteLabel($xlsRow,14,$row['jkw_kredit']);
xlsWriteLabel($xlsRow,15,$row['fixed_rate']);
xlsWriteLabel($xlsRow,16,$row['tgl_jt_pk']);
xlsWriteLabel($xlsRow,17,$row['tgl_jt_fixed_rate']);
xlsWriteLabel($xlsRow,18,$row['lokasi_dokumen_asli']);
xlsWriteLabel($xlsRow,19,$row['amplop_asli']);
xlsWriteLabel($xlsRow,20,$row['amplopasli']);
xlsWriteLabel($xlsRow,21,$row['lokasi_dokumen_copy']);
xlsWriteLabel($xlsRow,22,$row['amplop_copy']);
xlsWriteLabel($xlsRow,23,$row['amplopcopy']);
xlsWriteLabel($xlsRow,24,$row['jaminan']);
xlsWriteLabel($xlsRow,25,$row['jml_jaminan']);
xlsWriteLabel($xlsRow,26,$row['jenis_surat_tanah']);
xlsWriteLabel($xlsRow,27,$row['alamat_collateral']);
xlsWriteLabel($xlsRow,28,$row['luas_tanah']);
xlsWriteLabel($xlsRow,29,$row['tgl_jt_surat_tanah']);
xlsWriteLabel($xlsRow,30,$row['jenis_pengikatan']);
xlsWriteLabel($xlsRow,31,$row['nilai_ht']);
xlsWriteLabel($xlsRow,32,$row['jkw_covernote']);
xlsWriteLabel($xlsRow,33,$row['notaris']);
xlsWriteLabel($xlsRow,34,$row['appraisal']);
xlsWriteLabel($xlsRow,35,$row['no_ajb']);
xlsWriteLabel($xlsRow,36,$row['no_surat_tanah']);
xlsWriteLabel($xlsRow,37,$row['collateral_zipcode']);
xlsWriteLabel($xlsRow,38,$row['luas_bangunan']);
xlsWriteLabel($xlsRow,39,$row['nilai_taksasi']);
xlsWriteLabel($xlsRow,40,$row['harga_tanah']);
xlsWriteLabel($xlsRow,41,$row['harga_bangunan']);
xlsWriteLabel($xlsRow,42,$row['harga_tanah_imb']);
xlsWriteLabel($xlsRow,43,$row['harga_bangunan_imb']);
xlsWriteLabel($xlsRow,44,$row['no_pengikatan']);
xlsWriteLabel($xlsRow,45,$row['tgl_covernote']);
xlsWriteLabel($xlsRow,46,$row['tgl_jt_covernote']);
xlsWriteLabel($xlsRow,47,$row['developer']);
xlsWriteLabel($xlsRow,48,$row['skim_pks']);
xlsWriteLabel($xlsRow,49,$row['no_imb']);
xlsWriteLabel($xlsRow,50,$row['status_imb']);
xlsWriteLabel($xlsRow,51,$row['nama_perumahan']);
xlsWriteLabel($xlsRow,52,$row['asuransi_jiwa']);
xlsWriteLabel($xlsRow,53,$row['no_polis_ass_jiwa']);
xlsWriteLabel($xlsRow,54,$row['premi_jiwa']);
xlsWriteLabel($xlsRow,55,$row['nilai_pertanggungan_ass_jiwa']);
xlsWriteLabel($xlsRow,56,$row['tgl_ass_jiwa']);
xlsWriteLabel($xlsRow,57,$row['tgl_jt_ass_jiwa']);
xlsWriteLabel($xlsRow,58,$row['asuransi_kerugian']);
xlsWriteLabel($xlsRow,59,$row['no_polis_ass_kerugian']);
xlsWriteLabel($xlsRow,60,$row['premi_kerugian']);
xlsWriteLabel($xlsRow,61,$row['nilai_pertanggungan_ass_kerugian']);
xlsWriteLabel($xlsRow,62,$row['tgl_ass_kerugian']);
xlsWriteLabel($xlsRow,63,$row['tgl_jt_ass_kerugian']);
xlsWriteLabel($xlsRow,64,$row['jenis_kendaraan']);
xlsWriteLabel($xlsRow,65,$row['no_bpkb']);
xlsWriteLabel($xlsRow,66,$row['no_rangka']);
xlsWriteLabel($xlsRow,67,$row['nama_dealer']);
xlsWriteLabel($xlsRow,68,$row['merk']);
xlsWriteLabel($xlsRow,69,$row['no_mesin']);
xlsWriteLabel($xlsRow,70,$row['no_polisi']);
xlsWriteLabel($xlsRow,71,$row['status_rekg']);
xlsWriteLabel($xlsRow,72,$row['tgl_pelunasan']);
xlsWriteLabel($xlsRow,73,$row['memo']);
xlsWriteLabel($xlsRow,74,$row['skdr']);
xlsWriteLabel($xlsRow,75,$row['siup']);
xlsWriteLabel($xlsRow,76,$row['tdp']);
xlsWriteLabel($xlsRow,77,$row['others']);
xlsWriteLabel($xlsRow,78,$row['serah']);
xlsWriteLabel($xlsRow,79,$row['kendala']);
xlsWriteLabel($xlsRow,80,$row['tgl_update']);
xlsWriteLabel($xlsRow,81,$row['bunga']);
xlsWriteLabel($xlsRow,82,$row['program']);
xlsWriteLabel($xlsRow,83,$row['agama']);
xlsWriteLabel($xlsRow,84,$row['npwp']);
xlsWriteLabel($xlsRow,85,$row['kelamin']);
xlsWriteLabel($xlsRow,86,$row['tgl_imb']);
xlsWriteLabel($xlsRow,87,$row['penilai']);
xlsWriteLabel($xlsRow,88,$row['tgl_taksasi']);
xlsWriteLabel($xlsRow,89,$row['tinggal']);
xlsWriteLabel($xlsRow,90,$row['cabang']);
xlsWriteLabel($xlsRow,91,$row['no_ktp']);
xlsWriteLabel($xlsRow,92,$row['ibu_kandung']);
xlsWriteLabel($xlsRow,93,$row['jabatan']);
xlsWriteLabel($xlsRow,93,$row['jabatan']);
xlsWriteLabel($xlsRow,94,$row['memo_appraisal']);
xlsWriteLabel($xlsRow,95,$row['plafond_dimohon']);
xlsWriteLabel($xlsRow,96,$row['nama_emergency']);
xlsWriteLabel($xlsRow,97,$row['telp_emergency']);
xlsWriteLabel($xlsRow,98,$row['alamat_kantor']);
xlsWriteLabel($xlsRow,99,$row['hubungan']);
xlsWriteLabel($xlsRow,100,$row['progress']);
xlsWriteLabel($xlsRow,101,$row['sales']);
xlsWriteLabel($xlsRow,102,$row['hp_sales']);
xlsWriteLabel($xlsRow,103,$row['kjpp']);
xlsWriteLabel($xlsRow,104,$row['status']);
xlsWriteLabel($xlsRow,105,$row['tgl_update_app']);
xlsWriteLabel($xlsRow,106,$row['tgl_update_los']);
xlsWriteLabel($xlsRow,107,$row['tgl_update_asc']);
xlsWriteLabel($xlsRow,108,$row['skim_pencairan']);

$xlsRow++;

}
xlsEOF();
exit();
?>