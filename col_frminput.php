<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_frminput.php';
include 'collateral_script/list_dropdown.php';
?>   

<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>

            $(document).ready(function() {
<?php
if (strtolower(cleanstr($_POST['frm']['skim_pencairan'])) == "partial drow down") {
    echo '$(".skimshowhide").show();';
    $buf = strtolower(cleanstr($_POST['frm']['skim_pks']));

    if ($buf == "kavling bangun" || $buf == "indent") {
        echo '$(".skimPKSshowhide").show();';
    } else {
        echo '$(".skimPKSshowhide").hide();';
    }
} else {
    echo '$(".skimshowhide").hide();';
    echo '$(".skimPKSshowhide").hide();';
}
?>
        
        $('#jenis_pengikatan').change(function() {
          
             if($('#jenis_pengikatan').val()=='SHT'){
                                
                 $('#no_pengikatan').html("<option value=''>--pilih--</option><option value='ADA'>ADA</option><option value='PENDING'>PENDING</option>");
                 
             }else{
                $('#no_pengikatan').html("<option value='PENDING'>PENDING</option>");
                  
             }
             
         }); 
                $("#close_box").click(function() {
                    $("#alert-box").hide("slow");
                });
                $("#close_box-ses").click(function() {
                    $("#alert-box-ses").hide("slow");
                });
                ///--tambahan skim pks start
                $('#skim_pencairan').change(function() {

                    showHideSkimPKS();
                });
                $('#skim_pks').change(function() {

                    showHideSkimPKS();
                });                
                function showHideSkimPKS(){
                    skimPencairan=$('#skim_pencairan').val().toLowerCase();
                    skimPKS=$('#skim_pks').val().toLowerCase();
                    
                    if (skimPencairan == "partial drow down") {
                        $(".skimshowhide").show();
                        if(skimPKS=="kavling bangun"||skimPKS=="indent"){
                            $(".skimPKSshowhide").show();
                        }
                        else{
                            $(".skimPKSshowhide").hide();
                            $(".skimPKSshowhide td input").val("");
                            $(".skimPKSshowhide td select").val("");
                            $("input.skimPKSshowhide").val("");     
                        }
                    }
                    else {
                        
                        $(".skimshowhide").hide();
                        $(".skimshowhide td input").val("");
                        $(".skimshowhide td select").val("");
                        $("input.skimshowhide").val("");
                        
                        $(".skimPKSshowhide").hide();
                        $(".skimPKSshowhide td input").val("");
                        $(".skimPKSshowhide td select").val("");
                        $("input.skimPKSshowhide").val("");

                    }
                    
                }
                ///--tambahan skim pks end
<?php
if (strtolower(cleanstr($_POST['frm']['no_covernote'])) == "pending") {
    echo '$(".covernoteshowhide").hide();';
} else {
    echo '$(".covernoteshowhide").show();';
}
?>
                $('#no_covernote').change(function() {

                    if ($(this).val().toLowerCase() == "ada") {
                        $(".covernoteshowhide").show();
                    }
                    else {
                        $(".covernoteshowhide").hide();
                        $(".covernoteshowhide td input").val("");
                        $("input.covernoteshowhide").val("");
                    }
                });

                $('#maksimum_kredit').change(function() {

                    hideShowKjpp();

                });
                hideShowKjpp();
                function hideShowKjpp() {

                    program = $("#program").val().toUpperCase();
                    produk = $("#produk").val().toUpperCase();
                    var programArray = ["PEMBANGUNAN", "RENOVASI", "MULTIGUNA", "REFINANCING", "TAKEOVER"];

                    showKjpp = false;
                    for (i = 0; i < programArray.length; i++) {

                        if (
                                produk.match(".*(BNI GRIYA).*") &&
                                program.match(".*(" + programArray[i] + ").*") &&
                                (parseInt($('#maksimum_kredit').val()) >= parseInt("5000000000"))) {
                            showKjpp = true;
                        }

                    }
                    if (showKjpp) {
                        $('.showkjpp').show();
                        $('#kjpp').val('YA');


                    }
                    else {
                        $('.showkjpp').hide();
                        $('#kjpp').val('');
                        $('#kjpp_N').val('');
                    }
                }
                $('#tgl_pk').change(function() {
                    tglJatuhTempoPerjanjian();
                    tglFixRate()
                });
                $('#jkw_kredit').change(function() {
                    tglJatuhTempoPerjanjian();
                });
                $('#fixed_rate').change(function() {
                    tglFixRate();
                });

                $('#jkw_covernote').change(function() {
                    tglCovernote();
                });
                $('#tgl_covernote').change(function() {
                    tglCovernote();
                });
                function tglCovernote() {
                    tanggal = $('#tgl_covernote').datepicker('getDate');
                    jmlTambah = $('#jkw_covernote').val();

                    if (isTanggal(tanggal) && isInt(jmlTambah)) {
                        tanggal.setMonth(parseInt(tanggal.getMonth()) + parseInt(jmlTambah));
                        tanggal.setDate(parseInt(tanggal.getDate()) - 1);
                        $('#tgl_jt_covernote').datepicker('setDate', tanggal);
                    }
                    else {
                        $('#tgl_jt_covernote').val("");
                    }
                }


                function tglJatuhTempoPerjanjian() {
                    tanggal = $('#tgl_pk').datepicker('getDate');
                    jmlTambah = $('#jkw_kredit').val();

                    if (isTanggal(tanggal) && isInt(jmlTambah)) {

                        tanggal.setMonth(parseInt(tanggal.getMonth()) + parseInt(jmlTambah));
                        tanggal.setDate(parseInt(tanggal.getDate()) - 1);
                        $('#tgl_jt_pk').datepicker('setDate', tanggal);
                    }
                    else {
                        $('#tgl_jt_pk').val("");
                    }
                }
                function tglFixRate() {
                    tanggal = $('#tgl_pk').datepicker('getDate');
                    jmlTambah = $('#fixed_rate').val();

                    if (isTanggal(tanggal) && isInt(jmlTambah)) {
                        tanggal.setMonth(parseInt(tanggal.getMonth()) + parseInt(jmlTambah));
                        tanggal.setDate(parseInt(tanggal.getDate()) - 1);
                        $('#tgl_jt_fixed_rate').datepicker('setDate', tanggal);
                    }
                    else {
                        $('#tgl_jt_fixed_rate').val("");
                    }
                }
                function isTanggal(tgl) {
                    return (tgl instanceof Date && !isNaN(tgl.valueOf()))
                }
                function isInt(value) {
                    return !isNaN(value) && value != "" && parseInt(Number(value)) == value;
                }

            });
        </script>
    </head>
    <body>            
        <form method="POST">

            <div style="margin:0px 50px;text-align: left;">
                <?= $messageBox ?>
                <?php
                if (isset($_SESSION['colateral']['message'])) {
                    echo $_SESSION['colateral']['message'];
                    unset($_SESSION['colateral']['message']);
                }
                ?>

                <h1 class="judulfrm">Informasi Aplikasi</h1>
                <table class="tbllayout">
                    <tr>
                        <td>
                            <table class="tbllayout">
                                <tr>
                                    <td class="w180">Nomor Aplikasi <span class="red">*)</span></td><td class="w300"> <?= ht_input("noaplikasi", "style='width:200px'") ?>
                                        <button name="action" value="search"><span class="ui-icon ui-icon-search"></span>
                                        </button>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <?php
                if ($showForm) {
                    ?>
                    <table class="tbllayout">
                        <tr>
                            <td>
                                <table class="tbllayout" >

                                    <tr>
                                        <td class="w180">LNC</td><td class="w300"> 

                                            <?= cleanstr($_POST['frm']['lnc']) ?>    
                                            <?= ht_input("lnc", "", "hidden") ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class='tambahan'>Input Date</td><td>
                                            <?= cleanstr($_POST['frm']['input_date']) ?>    
                                            <?= ht_input("input_date", "", "hidden") ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Produk</td><td>
                                            <?= cleanstr($_POST['frm']['produk']) ?>
                                            <?= ht_input("produk", "", "hidden") ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Produk Program</td><td>
                                            <?= cleanstr($_POST['frm']['program']) ?> 
                                            <?= ht_input("program", "", "hidden") ?>
                                            <input type="hidden" value="<?= $program_kd ?>" id="program_kd" />

                                        </td>
                                    </tr>
                                    <tr>         
                                </table>
                            </td>
                            <td>
                                <table class="tbllayout" >                                    
                                    <tr>                           
                                        <td class="w180">CIF</td><td class="w300"> <?= ht_input("cif") ?></td>
                                    </tr>
                                    <tr>                          
                                        <td>Norek Pinjaman <span class="red">*)</span></td><td> <?= ht_input("no_rekg_pinjaman") ?></td>
                                    </tr>
                                    <tr>                           
                                        <td>Norek Afiliasi</td><td> <?= ht_input("afiliasi") ?></td>
                                    </tr>
                                    <tr>                            
                                        <td>Kode Cabang</td><td> <?= ht_input("cabang") ?></td>
                                    </tr>
                                    <tr>         
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="tbllayout">
                        <tr>
                            <td>
                                <table class="tbllayout">
                                    <tr>
                                        <td class="w180">Nama Debitur <span class="red">*)</span></td><td  class="w300"><?= ht_input("namadebitur") ?> </td>

                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir</td><td><?= ht_input("tempatlahir") ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td><td><?= ht_input("tgllahir", "class='dateBack dateMask'") ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td><td><?= ht_select("agama", $listAgama) ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td><td><?= ht_select("kelamin", $listJenkel) ?>  </td>
                                    </tr>

                                    <tr>
                                        <td>Nama Tempat Kerja/Usaha</td><td> <?= ht_input("instansi") ?> </td>
                                    </tr>

                                    <tr>
                                        <td>Alamat Tempat Tinggal </td><td><?= ht_textarea("tinggal") ?> </td>
                                    </tr>
                                    <tr>
                                        <td >Permohonan SKDR</td>
                                        <td><?= ht_select("skdr", $listAdaTidak); ?> </td>
                                    </tr>     
                                    <tr>                         
                                </table>
                            </td>
                            <td>
                                <table class="tbllayout" >
                                    <tr> 
                                        <td class="w180">No Perjanjian Kredit</td><td class="w300"><?= ht_input("no_pk") ?>  </td>
                                    </tr>
                                    <tr><td >Maksimum Kredit</td><td><?= ht_input("maksimum_kredit", "class='kendorupiah'") ?></td></tr>

                                    <tr>
                                        <td>Tgl Perjanjian Kredit <span class="red">*)</span></td><td> <?= ht_input("tgl_pk", "class='dateNormal dateMask'") ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Jangka Waktu Kredit (bulan) <span class="red">*)</span></td><td> <?= ht_input("jkw_kredit", "class='kendonumber'") ?>  </td>
                                    </tr>
                                    <tr>
                                        <td>Tgl Jatuh Tempo Perjanjian</td><td> <?= ht_input("tgl_jt_pk", "class='dateNormal' ") ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Rate Bunga (%) <span class="red">*)</span> </td><td><?= ht_input("bunga") ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Masa fix rate (bulan) <span class="red">*)</span> </td><td><?= ht_input("fixed_rate", "class='kendonumber'") ?>  </td>
                                    </tr>

                                    <tr><td >Tgl. Berakhir Masa Fixed Rate</td><td><?= ht_input("tgl_jt_fixed_rate", "class='dateNormal'") ?></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <?php
                    if ($showInformasiJaminan) {
                        ?>
                        <h1 class="judulfrm">Informasi Jaminan</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr>
                                            <td class='w180'>Status Agunan
                                            </td>
                                            <td class="w300">
                                                <?= ht_select("jaminan", $listJnsJaminan) ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Proses Agunan
                                            </td>
                                            <td>
                                                <?= ht_select("proses_agunan", $ListProsesAgunan) ?>
                                            </td>
                                        </tr>
                                        <tr><td>Jenis Jaminan </td><td><?= ht_select("jenis_surat_tanah", $ListJenisSuratTanah) ?></td></tr>
                                        <tr><td>Tanggal JTP Surat Tanah</td><td><?= ht_input("tgl_jt_surat_tanah", "class='dateNormal dateMask'") ?></td></tr>

                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">
                                        <tr><td class="tambahan w180">Covernote</td><td class="w300">
                                                <?= ht_select("no_covernote", $listAdaPending, "style='width:100px'", false) ?>
                                                <?= ht_input("no_covernote_n", "style='width:151px' class='covernoteshowhide'") ?>
                                            </td></tr>

                                        <tr class="covernoteshowhide"><td>Jangka Waktu Covernote(bln)</td><td><?= ht_select("jkw_covernote", $ListJkwCov) ?></td></tr>
                                        <tr class="covernoteshowhide"><td>Tanggal Covernote</td><td><?= ht_input("tgl_covernote", "class='dateNormal dateMask'") ?></td></tr>
                                        <tr class="covernoteshowhide"><td>Tanggal JTP Covernote</td><td><?= ht_input("tgl_jt_covernote", "class='dateNormal dateMask'") ?></td></tr>

                                    </table>
                                </td>
                            </tr>
                        </table>

                        <div class="diagonal_line">&nbsp;</div>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr><td class="tambahan w180">Banyaknya Jaminan </td><td class='w300'><?= ht_input("jml_jaminan_n", "class='kendonumber'") ?></td>
                                        <tr><td >No IMB</td>
                                            <td> 
                                                <?= ht_select("status_imb", $listAdaPending, "style='width:100px'") ?>
                                                <?= ht_input("no_imb", "style='width:151px'") ?>

                                            </td></tr>

                                        <tr><td>Tanggal IMB</td><td><?= ht_input("tgl_imb", "class='dateNormal dateMask'") ?></td></tr>
                                        <tr><td >Nilai HT </td><td><?= ht_input("nilai_ht", "class='kendorupiah'") ?></td></tr>

                                        <tr><td>Jenis Pengikatan</td><td><?= ht_select("jenis_pengikatan", $listJnsPengikatan) ?></td></tr>
                                        <tr><td class="tambahan">No Pengikatan </td><td> 
                                                <?= ht_select("no_pengikatan", $listAdaPending, "style='width:100px'") ?>
                                                <?= ht_input("no_pengikatan_n", "style='width:151px'") ?>
                                            </td>
                                        </tr>
                                        <tr><td>Tanggal Pengikatan </td><td><?= ht_input("tgl_pengikatan", "class='dateNormal dateMask'") ?></td></tr>

                                        <tr><td class="tambahan">Tanggal Penyerahan Berkas Pengikatan </td><td><?= ht_input("tgl_penyerahan_berkas", "class='dateNormal dateMask'") ?></td></tr>
                                        <tr><td class="tambahan">Proses Pengikatan </td><td><?= ht_select("proses_pengikatan", $ListJnsProsespengikatan) ?></td></tr>

                                        <tr><td >No AJB</td>
                                            <td> 
                                                <?= ht_select("no_ajb", $listAdaPending, "style='width:100px'") ?>
                                                <?= ht_input("no_ajb_n", "style='width:151px'") ?>

                                            </td></tr>

                                        <tr>
                                            <td>Nama Pemilik Dokumen </td>
                                            <td><?= ht_input("appraisal") ?></td>
                                        </tr>                                            

                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">
                                        <tr class="showkjpp"><td class="w180">KJPP  </td><td  class="w300"> 
                                                <?= ht_input("kjpp_flag", "", "hidden") ?>
                                                <select style="width:55px" readonly="readonly"><option>YA</option></select>
                                                <?= ht_select("kjpp", $ListKjpp, "style='width:190px'"); ?>

                                            </td></tr>
                                        <tr><td class="w180">Alamat  </td><td  class="w300"> <?= ht_textarea("alamat_collateral") ?></td></tr>
                                        <tr><td >Kode Post Alamat </td><td><?= ht_input("collateral_zipcode") ?></td></tr>
                                        <tr><td>Luas Tanah   </td><td><?= ht_input("luas_tanah", "class='kendonumber'") ?></td></tr>
                                        <tr><td>Luas Bangunan   </td><td><?= ht_input("luas_bangunan", "class='kendonumber'") ?></td></tr>
                                        <tr><td>Total Taksasi Tanah </td><td><?= ht_input("harga_tanah", "class='kendorupiah'") ?></td></tr>
                                        <tr><td>Total Taksasi Bangunan </td><td><?= ht_input("harga_bangunan", "class='kendorupiah'") ?></td></tr>
                                        <tr><td>NJOP Tanah per m2  </td><td><?= ht_input("harga_tanah_imb", "class='kendorupiah'") ?></td></tr>
                                        <tr><td>NJOP Bangunan per m2  </td><td><?= ht_input("harga_bangunan_imb", "class='kendorupiah'") ?></td></tr>
                                        <tr><td>Tanggal Taksasi </td><td><?= ht_input("tgl_taksasi", "class='dateNormal dateMask'") ?></td></tr>
                                        <tr><td>Nama Penilai Taksasi </td><td><?= ht_input("penilai") ?></td></tr>
                                        <tr><td class="w180">Nama Notaris </td><td><?= ht_select("notaris", $ListNotaris) ?></td></tr>
                                        <tr><td>Nama Developer </td><td><?= ht_select("developer", $ListDeveloper) ?></td></tr>  

                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div class="diagonal_line">&nbsp;</div>
                        <table class="tbllayout">
                                <tr>
                                    <td>
                                        <table class="tbllayout">                                   
                                            <tr><td class="tambahan w180">Skim Pencairan </td><td class="w300"><?= ht_select("skim_pencairan", $ListSkimPencairan, "", false) ?></td></tr>  
                                            <tr class=''><td>SIUP </td><td>                             
        <?= ht_select("siup", $listAdaTidak, "style='width:100px'", false) ?>
        <?= ht_input("siup_n", "style='width:151px'") ?>

                                                </td></tr>  
                                            <tr class=''><td>Tanda Daftar Perusahaan </td><td>
        <?= ht_select("tdp", $listAdaTidak, "style='width:100px'", false) ?>
        <?= ht_input("tdp_n", "style='width:151px'") ?>
                                                </td></tr>
                                            <tr class=''><td>Others </td><td>
                                                    <?= ht_select("others", $listAdaTidak, "style='width:100px'", false) ?>
        <?= ht_input("others_n", "style='width:151px'") ?></td></tr>
                                            <tr class=''><td>No NPWP </td><td><?= ht_input("npwp") ?></td></tr>
                                            <tr class=''><td>No. GS/SU </td><td><?= ht_input("jml_jaminan") ?></td></tr>                                            
                                            <tr class=''><td>No Sertifikat Tanah</td><td><?= ht_input("no_surat_tanah") ?></td></tr>
                                            <tr class=''><td>Tgl. Sertifikat </td><td><?= ht_input("nilai_taksasi","class='dateNormal dateMask'") ?></td> </tr>
                                            <tr class=''><td class="tambahan">Jenis Sertifikat </td><td><?= ht_select("jenis_sertifikat",$ListJenisSertifikat) ?></td></tr>
                                            <tr class='skimshowhide'><td>Skim PKS </td><td> <?= ht_select("skim_pks", $ListSkimPKSDev) ?></td></tr>
                                            <tr class='skimshowhide'><td>Nama Proyek </td><td><?= ht_input("nama_perumahan") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Jenis Proyek </td><td><?= ht_input("jenis_proyek") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Kategori Proyek </td><td><?= ht_input("kategori_proyek") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Nomor PKS </td><td><?= ht_input("no_pks") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Total Unit di Bangun </td><td><?= ht_input("total_unitdibangun", "class='kendonumber'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Penguasaan Sertifikat Induk</td><td><?= ht_input("penguasaan_sertifikat") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">No Rekening Escrow</td><td><?= ht_input("no_rek_escrow") ?></td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout" class='skimshowhide '>                                   
                                            <tr class='skimPKSshowhide '><td class="tambahan w180">Cair Tahap Fondasi(Rp)</td><td class="w300"><?= ht_input("cair_tahap_fondasi", "class='kendorupiah'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Tanggal Cair Tahap Fondasi Off</td><td><?= ht_input("tgl_cair_tahap_fondasi", "class='dateNormal dateMask'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Keterangan-1</td><td><?= ht_input("ket_cair_tahap_fondasi") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Cair Tahap Topping Off(Rp)</td><td><?= ht_input("cair_tahap_topping", "class='kendorupiah'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Tanggal Cair Tahap Topping Off</td><td><?= ht_input("tgl_cair_tahap_topping", "class='dateNormal dateMask'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td>Keterangan-2</td><td><?= ht_input("ket_cair_tahap_topping") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Cair Tahap Bast(Rp)</td><td><?= ht_input("cair_tahap_bast", "class='kendorupiah'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Tanggal Cair Tahap Bast</td><td><?= ht_input("tgl_cair_tahap_bast", "class='dateNormal dateMask'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Keterangan-3</td><td><?= ht_input("ket_cair_tahap_bast") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Cair Tahap Dokumen(Rp)</td><td><?= ht_input("cair_tahap_dok", "class='kendorupiah'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Tanggal Cair Tahap Dokumen</td><td><?= ht_input("tgl_cair_tahap_dok", "class='dateNormal dateMask'") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td class="tambahan">Keterangan-4</td><td><?= ht_input("ket_cair_tahap_dok") ?></td></tr>
                                            <tr class='skimPKSshowhide'><td>Progress Pembangunan</td><td><?= ht_select("progress", $ListSelesaiBelum) ?></td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        <?php
                    }
                    if ($showInformasiAsuransiKerugian) {
                        ?>
                        <h1 class="judulfrm">Informasi Asuransi Kerugian</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr><td class="tambahan">Nomor Polis Asuransi Kerugian</td><td>                                                      
                                                <?= ht_select("no_polis_ass_kerugian", $listAdaPendingTidak, "style='width:100px'") ?>
                                                <?= ht_input("no_polis_ass_kerugian_n", "style='width:151px'") ?>
                                            </td>
                                        </tr>
                                        <tr><td class="w180">Asuransi Kerugian</td><td class="w300"><?= ht_select("asuransi_kerugian", $ListAsuransiKerugian) ?></td></tr>
                                        <tr><td class="tambahan">Berkas Polis Asuransi Kerugian</td><td><?= ht_select("berkas_asuransi_kerugian", $listAdaTidak) ?></td></tr>
                                        <tr><td>Premi Asuransi Kerugian</td><td><?= ht_input("premi_kerugian", "class='kendorupiah'") ?></td></tr>

                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">
                                        <tr><td class="w180">Nilai Pertanggungjawaban Asuransi Kerugian</td><td class="w300"><?= ht_input("nilai_pertanggungan_ass_kerugian", "class='kendorupiah'") ?></td></tr>
                                        <tr><td>Tanggal Asuransi Kerugian</td><td><?= ht_input("tgl_ass_kerugian", "class='dateNormal dateMask'") ?></td></tr>
                                        <tr><td>Tanggal Jatuh Tempo Asuransi Kerugian</td><td><?= ht_input("tgl_jt_ass_kerugian", "class='dateNormal dateMask'") ?></td></tr>

                                    </table>
                                </td>

                            </tr>
                        </table>
                        <?php
                    }
                    if ($showInformasiAsuransiJiwa) {
                        ?>
                        <h1 class="judulfrm">Informasi Asuransi Jiwa</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr><td class="tambahan">Nomor Polis Asuransi Jiwa</td><td>
                                                <?= ht_select("no_polis_ass_jiwa", $listAdaPendingTidak, "style='width:100px'") ?>
                                                <?= ht_input("no_polis_ass_jiwa_n", "style='width:151px'") ?>
                                            </td>
                                        </tr>
                                        <tr><td class="w180">Asuransi Jiwa</td><td class="w300"><?= ht_select("asuransi_jiwa", $ListAsuransiJiwa) ?></td></tr>

                                        <tr><td class="tambahan">Berkas Polis Asuransi Jiwa</td><td><?= ht_select("berkas_assuransi_jiwa", $listAdaTidak) ?></td></tr>
                                        <tr><td>Premi Asuransi Jiwa</td><td><?= ht_input("premi_jiwa", "class='kendorupiah'") ?></td></tr>

                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">
                                        <tr><td class="w180">Nilai Pertanggungjawaban Asuransi Jiwa</td><td class="w300"><?= ht_input("nilai_pertanggungan_ass_jiwa", "class='kendorupiah'") ?></td></tr>
                                        <tr><td>Tanggal Asuransi Jiwa</td><td><?= ht_input("tgl_ass_jiwa", "class='dateNormal dateMask'") ?></td></tr>
                                        <tr><td>Tanggal Jatuh Tempo Asuransi Jiwa</td><td><?= ht_input("tgl_jt_ass_jiwa", "class='dateNormal dateMask'") ?></td></tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                        <?php
                    }
                    if ($showInformasiFleksi) {
                        ?>
                        <h1 class="judulfrm">Informasi Fleksi</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr><td class="w180">No Jaminan</td><td class="w300">
                                                <?= ht_select("no_jaminan_fleksi", $listAdaPending, "style='width:100px'") ?>
                                                <?= ht_input("no_jaminan_fleksi_n", "style='width:151px'") ?>
                                            </td></tr>
                                        <tr><td>Jenis Jaminan </td><td class="w300"><?= ht_select("jns_jaminan_fleksi", $ListJnsJaminanFleksi) ?></td></tr>
                                        <tr><td>Surat Pernyataan</td><td><?= ht_input("srt_pernyataan_fleksi") ?></td></tr>
                                    </table>
                                </td>

                            </tr>
                        </table>
                        <?php
                    }
                    if ($showInformasiOto) {
                        ?>
                        <h1 class="judulfrm">Informasi Oto</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout"> 
                                        <tr><td>No BPKB</td><td>                        
                                                <?= ht_select("no_bpkb", $listAdaPending, "style='width:100px'") ?>
                                                <?= ht_input("no_bpkb_n", "style='width:151px'") ?>                                                    
                                            </td>
                                        </tr>
                                        <tr><td class="w180">Jenis Kendaraan</td><td class="w300"><?= ht_select("jenis_kendaraan", $ListJnsKendaraan) ?></td></tr>
                                        <tr><td>Merk</td><td><?= ht_select("merk", $listMerkKendaraan) ?></td></tr>
                                        <tr><td>No Polisi</td><td><?= ht_input("no_polisi") ?></td></tr>


                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">                                                
                                        <tr><td class="w180">No Rangka</td><td class="w300"><?= ht_input("no_rangka") ?></td></tr>
                                        <tr><td>No Mesin</td><td><?= ht_input("no_mesin") ?></td></tr>
                                        <tr><td>Nama Dealer</td><td><?= ht_input("nama_dealer") ?></td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <?php
                    }
                    if ($showEmergencyKon) {
                        ?>
                        <h1 class="judulfrm">Emergeny Contact</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr>
                                            <td class="w180">Nama Emergency Contact</td>
                                            <td class="w300"><?= ht_input("nama_emergency") ?></td>
                                        </tr>

                                        <tr>
                                            <td >No. Telp. Emergency Contact</td>
                                            <td ><?= ht_input("telp_emergency") ?></td>
                                        </tr>

                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">
                                        <tr>
                                            <td class="w180">Alamat Kantor </td>
                                            <td class="w300"><?= ht_textarea("alamat_kantor") ?></td>
                                        </tr>

                                        <tr>
                                            <td > Hubungan Keluarga</td>
                                            <td ><?= ht_input("hubungan") ?></td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </table>
                        <?php
                    }
                    if ($showInformasiLain) {
                        ?>
                        <h1 class="judulfrm">Informasi Lain</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr>
                                            <td class="w180">No. Kluis Dokumen Asli</td>
                                            <td class="w300"><?= ht_input("lokasi_dokumen_asli", "class=''"); ?> </td>
                                        </tr>

                                        <tr>
                                            <td>No. Kluis Dokumen Kerja</td><td><?= ht_input("lokasi_dokumen_copy", "class=''"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. Bantek Dokumen Asli</td><td><?= ht_input("amplop_asli", "class=''"); ?></td>
                                        </tr>

                                        <tr>
                                            <td>No. Bantek Dokumen Kerja</td><td><?= ht_input("amplop_copy", "class=''"); ?></td>
                                        </tr>



                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">
                                        <tr>
                                            <td class="w180">No. Amplop Asli</td><td  class="w300"><?= ht_input("amplopasli", "class=''"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. Amplop Kerja</td><td><?= ht_input("amplopcopy", "class=''"); ?></td>
                                        </tr>

                                        <tr>
                                            <td>Nama Sales</td><td><?= ht_input("sales"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>No Hp Sales</td><td><?= ht_input("hp_sales"); ?></td>
                                        </tr>


                                    </table>
                                </td>
                            </tr>

                        </table>

                        <?php
                    }

                    if ($showDtLunas) {
                        ?>
                        <h1 class="judulfrm">Data Pelunasan</h1>
                        <table class="tbllayout">
                            <tr>
                                <td>
                                    <table class="tbllayout">
                                        <tr>
                                            <td class="w180">Status Penyerahan</td>
                                            <td class="w300">
                                                <?= ht_select("serah", $ListSerah) ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>  Tanggal Pelunasan</td>
                                            <td> <?= ht_input("tgl_pelunasan", "class='dateNormal dateMask'") ?></td>
                                        </tr>

                                        <tr>
                                            <td>tanggal diserahkan</td>
                                            <td><?= ht_input("tgl_serah", "class='dateNormal dateMask'") ?></td>
                                        </tr>

                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout">
                                        <tr> <td class="w180"> Status Rekg. Pinjaman</td> <td class="w300"> <?= ht_select("status_rekg", $ListStatusRekg, "", false) ?></td> </tr>
                                        <tr> <td>  Nama Penerima</td> <td > <?= ht_input("pelunasan_penerima") ?></td> </tr>

                                        <tr><td>Keterangan</td><td><?= ht_input("pelunasan_keterangan") ?></td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <h1 class="judulfrm">Memo</h1>
                        <?= ht_textarea("memo", 'style="width:90%;height:180px;margin: 10px"') ?>
                        </table>

                        <?php
                    }
                    ?>
                    <div></div>
                    <input type="submit" name="action" value="simpan" style='margin:10px;' />
    <?php
}
?>
            </div>

        </form>
    </body>
</html>
<?php /*
  status_rekg
  no_bpkb
  no_ajb
  no_pengikatan
  no_polis_ass_jiwa
  no_polis_ass_kerugian
  status_rekg
 * 
 * 
 */
?>