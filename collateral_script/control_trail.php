<?php

$db_function = new db_function();
if (empty($_GET['no_trail'])) {

    $no_trail = $db_function->selectOnefield("select no_trail from debitur_trail where no_rekg_pinjaman='" . $_GET['id'] . "' order by no_trail desc limit 1");
    header("location: col_trail.php?id=" . $_GET['id'] . "&no_trail=" . $no_trail);exit;
}


$showInformasiJaminan = false;
$showInformasiAsuransiKerugian = false;
$showInformasiAsuransiJiwa = false;
$showInformasiFleksi = false;
$showInformasiOto = false;
$showDtLunas = false;
$showForm = true;
$showInformasiLain = true;
$showEmergencyKon = true;
$messageBox = "";
$pesanError = array();

$program_kd = "";
$cab_kd = "";
$lnc = "*";

//$messageBox = showMessage("<div>Data Telah di simpan</div>","notice");
$no_trail=$_GET['no_trail'];
$_POST['frm']['no_trail']=$no_trail;
$trailSekarang;
$trailSebelum;

$buf = $db_function->selectOneRows("select * from debitur_trail  where no_rekg_pinjaman='" . $_GET['id'] . "' and no_trail='".$_GET['no_trail']."'");
foreach ($buf as $key => $val) {
    if (!is_int($key)) {
        $trailSekarang[strtolower($key)] = isDateDB($val) ? balikTgl($val) : $val;
    }
}

$usersCreate=$db_function->selectOneRows("select * from pegawai where npp='".$trailSekarang['userupdate']."'");

if($_GET['no_trail']>1){
    $buf = $db_function->selectOneRows("select * from debitur_trail  where no_rekg_pinjaman='" . $_GET['id'] . "' and no_trail='".($_GET['no_trail']-1)."'");
    foreach ($buf as $key => $val) {
        if (!is_int($key)) {
            $trailSebelum[strtolower($key)] = isDateDB($val) ? balikTgl($val) : $val;
        }
    }
}
$cekTrail=new CekTrail($trailSekarang,$trailSebelum);


$buf= $db_function->selectAllRows("select distinct no_trail from debitur_trail  where no_rekg_pinjaman='" . $_GET['id'] . "' order by no_trail asc");
$ListNoTrail=array();
foreach($buf as $row){
    $ListNoTrail[$row['no_trail']]=$row['no_trail'];
}

$produk_nm = trim(strtoupper($_POST['frm']["produk"]));
//echo $produk_nm;exit;
if (in_array($produk_nm, array("BNI GRIYA", "BNI OTO", "BNI GRIYA MULTIGUNA", "BNI FLEKSI", "BNI CERDAS", "BNI WIRAUSAHA", "UMG"))) {
// kalau pilihan nya ada didatabase baru pakek kondisi    
    //cuma Griya/Multiguna/BWU yg bisa
    if (in_array($produk_nm, array("BNI GRIYA", "BNI GRIYA MULTIGUNA", "BNI WIRAUSAHA"))) {
        $showInformasiJaminan = true;
    }
//cuma Griya/OTO/Multiguna/BWU yg bisa
    if (in_array($produk_nm, array("BNI GRIYA", "BNI OTO", "BNI GRIYA MULTIGUNA", "BNI WIRAUSAHA"))) {
        $showInformasiAsuransiKerugian = true;
    }

//semua nya
    $showInformasiAsuransiJiwa = true;
    $showDtLunas = true;
    $showInformasiLain = true;
    $showEmergencyKon = true;
//cuma fleksi
    if (in_array($produk_nm, array("BNI FLEKSI"))) {
        $showInformasiFleksi = true;

        //cuma oto
        if (in_array($produk_nm, array("BNI OTO"))) {
            $showInformasiOto = true;
        }
    }
} else {
//kalau pilihan ngk ada di database munculin semua    
    $showInformasiJaminan = true;
    $showInformasiAsuransiKerugian = true;
    $showInformasiAsuransiJiwa = true;
    $showInformasiFleksi = true;
    $showInformasiOto = true;
    $showDtLunas = true;
    $showForm = true;
    $showInformasiLain = true;
    $showEmergencyKon = true;
}

/*
  $showInformasiJaminan = true;
  $showInformasiAsuransiKerugian = true;
  $showInformasiAsuransiJiwa = true;
  $showInformasiFleksi = true;
  $showInformasiOto = true;
  $showDtLunas = true;
  $showForm = true;
  $showInformasiLain = true;
  $showEmergencyKon = true; */


class CekTrail{
    private $trailSekarang;
    private $trailSebelum;
    public function __construct($trailSekarang,$trailSebelum) {
        $this->trailSebelum=$trailSebelum;
        $this->trailSekarang=$trailSekarang;        
    }
    
    
    public function printTrail($key,$jenis=""){       
        $img="";
        if(isset($this->trailSebelum[$key]) && $this->trailSekarang[$key]!=$this->trailSebelum[$key]){
            $img="<img src='images/replace.png' class='tooltip' title='".$this->trailSebelum[$key]."' />";
        }
        $printtext=$this->trailSekarang[$key];
        if(($jenis=="rp"||$jenis=="number")&& cleanstr($this->trailSekarang[$key])!="" ){
            $printtext=($jenis=="rp"?"Rp ":"").number_format($this->trailSekarang[$key], 0, ',', '.');
            
            
        }
        return $printtext." ".$img;
    }
}
?>