<?php

if(isset($_POST['frm']['lnc'])){
    $lnc=$_POST['frm']['lnc'];
}

$listAgama = array(
    'ISLAM' => 'ISLAM', 'KRISTEN' => 'KRISTEN',
    'PROTESTAN' => 'PROTESTAN', 'HINDU' => 'HINDU',
    'KONG HU CHU' => 'KONG HU CHU', 'KEPERCAYAAN LAINNYA' => 'KEPERCAYAAN LAINNYA');
$listJenkel = array('LAKI-LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN');
$listJnsJaminan = array("INDUK" => "INDUK", "SATUAN" => "SATUAN", "GIRIK" => "GIRIK");
$listJnsPengikatan = $db_function->selectLookup("jns_pengikatan");
$listAdaPending = array("ADA" => "ADA", "PENDING" => "PENDING");
$listAdaPendingTidak = array("ADA" => "ADA", "PENDING" => "PENDING", "TIDAK" => "TIDAK");
$listAdaTidak = array("ADA" => "ADA", "TIDAK ADA" => "TIDAK ADA");
$ListSkimPKSDev = array("READY STOCK" => "READY STOCK", "KAVLING BANGUN" => "KAVLING BANGUN", "INDENT" => "INDENT");
$ListSelesaiBelum = array("SELESAI" => "SELESAI", "BELUM SELESAI" => "BELUM SELESAI");
$ListSkimPencairan = array("SEKALIGUS" => "SEKALIGUS", "PARTIAL DROW DOWN" => "PARTIAL DROW DOWN");
$ListJnsJaminanFleksi = array('SK' => 'SK', 'IJAZAH' => 'IJAZAH', 'KARTU TASPEN' => 'KARTU TASPEN');
$ListSerah = array("SUDAH" => "SUDAH", "BELUM" => "BELUM");
$ListStatusRekg = array("AKTIF" => "AKTIF", "LUNAS" => "LUNAS");
$ListProsesAgunan = array("PPJB" => "PPJB", "AJB" => "AJB", "PPJK" => "PPJK");
//$ListJenisSuratTanah = array("SHM" => "SHM", "SHGB" => "SHGB", "STRATA TITLE" => "STRATA TITLE", "OTHER" => "OTHER");
$ListJenisSuratTanah = $db_function->selectLookup("jns_surat_tanah", $lnc);
$ListJenisSertifikat= array("SHGB" => "SHGB", "SHGB DIATAS HPL" => "SHGB DIATAS HPL", "SHGB - STRATA TITLE" => "SHGB - STRATA TITLE", 
    "SHM" => "SHM", "SHM - SRS" => "SHM - SRS");

$ListJnsProsespengikatan = array("PENDING DEVELOPER" => "PENDING DEVELOPER", "PENDING NOTARIS" => "PENDING NOTARIS", "SELESAI" => "SELESAI");
$ListJnsKendaraan = $db_function->selectLookup("jns_kendaraan", $lnc);
$listMerkKendaraan = $db_function->selectLookup("merk_kendaraan", $lnc);
$ListAsuransiJiwa = $db_function->selectLookup("asuransi_jiwa", $lnc);
$ListAsuransiKerugian = $db_function->selectLookup("asuransi_kerugian", $lnc);
$ListDeveloper = $db_function->selectLookup("developer", $lnc);
$ListNotaris = $db_function->selectLookup("notaris", $lnc);
$ListKjpp = $db_function->selectLookup("daftar_kjpp", $lnc);
$ListKendala= $db_function->selectLookup("kendala", $lnc);

$ListJkwCov="";
for($i=0;$i<=60;$i++){
    $ListJkwCov[$i]=$i;
}
?>
