<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_trail.php';
?>   

<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>

            $(document).ready(function() {

                $("#close_box").click(function(){
                    $("#alert-box").hide( "slow" );
                });
                 $("#close_box-ses").click(function(){
                    $("#alert-box-ses").hide( "slow" );
                });
                
                $("#no_trail").change(function() {
                    window.location.href = "col_trail.php?id=<?=$_GET['id'] ?>&no_trail="+$("#no_trail").val();
                });
            });
        </script>
    </head>
    <body>           
       
        <form method="POST">
            <div style="margin:0px 50px;text-align: left;">
                    
                    <h1>Riwayat Data Debitur</h1>
                    <table class="tbllayout">
                        <tr>
                            <td colspan="2">
                                <?= ht_select("no_trail",$ListNoTrail) ?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td width='100px'>user create</td>
                            <td><?=$usersCreate['NPP'].", ".$usersCreate['NAMA']?></td>
                        </tr>
                        <tr>
                            <td >date create</td>
                            <td><?php
                            
                            $buf=  explode(" ", $trailSekarang['tgl_update']);
                            if(isset($buf[1])){
                                echo balikTgl($buf[0])." ".$buf[1];
                            }
                                    
                            ?>
                            
                            </td>
                        </tr>
                    </table>
                    
                    <?= $messageBox ?>
                    <?php 
                        if(isset($_SESSION['colateral']['message'])){
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
                                        <td class="w180">Nomor Aplikasi </td><td class="w300"> 
                                            <?=$cekTrail->printTrail("noaplikasi");?>
                                           
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
                                                <?=$cekTrail->printTrail("lnc");?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class='tambahan'>Input Date</td><td>
                                                <?=$cekTrail->printTrail("input_date");?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Produk</td><td>
                                                <?=$cekTrail->printTrail("produk");?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Produk Program</td><td>
                                                <?=$cekTrail->printTrail("program");?>
                                                    
                                            </td>
                                        </tr>
                                        <tr>         
                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout" >                                    
                                        <tr>                           
                                            <td class="w180">CIF</td><td class="w300"> <?= $cekTrail->printTrail("cif") ?></td>
                                        </tr>
                                        <tr>                          
                                            <td>Norek Pinjaman </td><td> 
                                                <?=$cekTrail->printTrail("no_rekg_pinjaman");?>
                                                
                                            </td>
                                        </tr>
                                        <tr>                           
                                            <td>Norek Afiliasi</td><td> <?= $cekTrail->printTrail("afiliasi") ?></td>
                                        </tr>
                                        <tr>                            
                                            <td>Kode Cabang</td><td> <?= $cekTrail->printTrail("cabang") ?></td>
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
                                            <td class="w180">Nama Debitur </td><td  class="w300"><?= $cekTrail->printTrail("namadebitur") ?> </td>

                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td><td><?= $cekTrail->printTrail("tempatlahir") ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td><td><?= $cekTrail->printTrail("tgllahir") ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td><td><?= $cekTrail->printTrail("agama") ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td><td><?= $cekTrail->printTrail("kelamin") ?>  </td>
                                        </tr>

                                        <tr>
                                            <td>Nama Tempat Kerja/Usaha</td><td> <?= $cekTrail->printTrail("instansi") ?> </td>
                                        </tr>

                                        <tr>
                                            <td>Alamat Tempat Tinggal </td><td><?= $cekTrail->printTrail("tinggal") ?> </td>
                                        </tr>
                                        <tr>
                                                <td >Permohonan SKDR</td>
                                                <td><?= $cekTrail->printTrail("skdr"); ?> </td>
                                            </tr>     
                                        <tr>                         
                                    </table>
                                </td>
                                <td>
                                    <table class="tbllayout" >
                                        <tr> 
                                            <td class="w180">No Perjanjian Kredit</td><td class="w300"><?= $cekTrail->printTrail("no_pk") ?>  </td>
                                        </tr>
                                        <tr><td >Maksimum Kredit</td><td><?= $cekTrail->printTrail("maksimum_kredit", "rp") ?></td></tr>

                                        <tr>
                                            <td>Tgl Perjanjian Kredit </td><td> <?= $cekTrail->printTrail("tgl_pk", "tgl") ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Jangka Waktu Kredit (bulan) </td><td> <?= $cekTrail->printTrail("jkw_kredit","number") ?>  </td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Jatuh Tempo Perjanjian</td><td> <?= $cekTrail->printTrail("tgl_jt_pk", "class='dateNormal' ") ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Rate Bunga (%)  </td><td><?= $cekTrail->printTrail("bunga") ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Masa fix rate (bulan)  </td><td><?= $cekTrail->printTrail("fixed_rate","number") ?>  </td>
                                        </tr>

                                        <tr><td >Tgl. Berakhir Masa Fixed Rate</td><td><?= $cekTrail->printTrail("tgl_jt_fixed_rate", "class='dateNormal'") ?></td></tr>
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
        <?= $cekTrail->printTrail("jaminan") ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Proses Agunan
                                                </td>
                                                <td>
        <?= $cekTrail->printTrail("proses_agunan") ?>
                                                </td>
                                            </tr>
                                            <tr><td>Jenis Jaminan </td><td><?= $cekTrail->printTrail("jenis_surat_tanah") ?></td></tr>
                                            <tr><td>Tanggal JTP Surat Tanah</td><td><?= $cekTrail->printTrail("tgl_jt_surat_tanah", "tgl") ?></td></tr>

                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">
                                            <tr><td class="tambahan w180">Covernote</td><td class="w300">
        <?= $cekTrail->printTrail("no_covernote") ?>
        <?= $cekTrail->printTrail("no_covernote_n", "style='width:151px' class='covernoteshowhide'") ?>
                                                </td></tr>

                                            <tr class="covernoteshowhide"><td>Jangka Waktu Covernote(bln)</td><td><?= $cekTrail->printTrail("jkw_covernote") ?></td></tr>
                                            <tr class="covernoteshowhide"><td>Tanggal Covernote</td><td><?= $cekTrail->printTrail("tgl_covernote", "tgl") ?></td></tr>
                                            <tr class="covernoteshowhide"><td>Tanggal JTP Covernote</td><td><?= $cekTrail->printTrail("tgl_jt_covernote", "tgl") ?></td></tr>

                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div class="diagonal_line">&nbsp;</div>
                            <table class="tbllayout">
                                <tr>
                                    <td>
                                        <table class="tbllayout">
                                            <tr><td class="tambahan w180">Banyaknya Jaminan </td><td class='w300'><?= $cekTrail->printTrail("jml_jaminan_n","number") ?></td>
                                            <tr><td >No IMB</td>
                                                <td> 
        <?= $cekTrail->printTrail("status_imb") ?>
        <?= $cekTrail->printTrail("no_imb") ?>

                                                </td></tr>

                                            <tr><td>Tanggal IMB</td><td><?= $cekTrail->printTrail("tgl_imb", "tgl") ?></td></tr>
                                            <tr><td >Nilai HT </td><td><?= $cekTrail->printTrail("nilai_ht", "rp") ?></td></tr>

                                            <tr><td>Jenis Pengikatan</td><td><?= $cekTrail->printTrail("jenis_pengikatan") ?></td></tr>
                                            <tr><td class="tambahan">No Pengikatan </td><td> 
        <?= $cekTrail->printTrail("no_pengikatan") ?>
        <?= $cekTrail->printTrail("no_pengikatan_n") ?>
                                                </td>
                                            </tr>
                                            <tr><td>Tanggal Pengikatan </td><td><?= $cekTrail->printTrail("tgl_pengikatan", "tgl") ?></td></tr>

                                            <tr><td class="tambahan">Tanggal Penyerahan Berkas Pengikatan </td><td><?= $cekTrail->printTrail("tgl_penyerahan_berkas", "tgl") ?></td></tr>
                                            <tr><td class="tambahan">Proses Pengikatan </td><td><?= $cekTrail->printTrail("proses_pengikatan") ?></td></tr>
                                            
                                            <tr><td >No AJB</td>
                                                <td> 
        <?= $cekTrail->printTrail("no_ajb") ?>
        <?= $cekTrail->printTrail("no_ajb_n") ?>

                                                </td></tr>
                                            
                                            <tr>
                                                <td>Nama Pemilik Dokumen </td>
                                                <td><?= $cekTrail->printTrail("appraisal") ?></td>
                                            </tr>                                            

                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">
                                            <tr class="showkjpp"><td class="w180">KJPP  </td><td  class="w300"> 
                                                    <?= $cekTrail->printTrail("kjpp_flag") ?>
                                                    
                                                    <?= $cekTrail->printTrail("kjpp"); ?>
                                                    
                                                </td></tr>
                                            <tr><td class="w180">Alamat  </td><td  class="w300"> <?= $cekTrail->printTrail("alamat_collateral") ?></td></tr>
                                            <tr><td >Kode Post Alamat </td><td><?= $cekTrail->printTrail("collateral_zipcode") ?></td></tr>
                                            <tr><td>Luas Tanah   </td><td><?= $cekTrail->printTrail("luas_tanah","number") ?></td></tr>
                                            <tr><td>Luas Bangunan   </td><td><?= $cekTrail->printTrail("luas_bangunan","number") ?></td></tr>
                                            <tr><td>Total Taksasi Tanah </td><td><?= $cekTrail->printTrail("harga_tanah", "rp") ?></td></tr>
                                            <tr><td>Total Taksasi Bangunan </td><td><?= $cekTrail->printTrail("harga_bangunan", "rp") ?></td></tr>
                                            <tr><td>NJOP Tanah per m2  </td><td><?= $cekTrail->printTrail("harga_tanah_imb", "rp") ?></td></tr>
                                            <tr><td>NJOP Bangunan per m2  </td><td><?= $cekTrail->printTrail("harga_bangunan_imb", "rp") ?></td></tr>
                                            <tr><td>Tanggal Taksasi </td><td><?= $cekTrail->printTrail("tgl_taksasi", "tgl") ?></td></tr>
                                            <tr><td>Nama Penilai Taksasi </td><td><?= $cekTrail->printTrail("penilai") ?></td></tr>
                                            <tr><td class="w180">Nama Notaris </td><td><?= $cekTrail->printTrail("notaris") ?></td></tr>
                                            <tr><td>Nama Developer </td><td><?= $cekTrail->printTrail("developer") ?></td></tr>  

                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <div class="diagonal_line">&nbsp;</div>
                            <table class="tbllayout">
                                <tr>
                                    <td>
                                        <table class="tbllayout">                                   
                                            <tr><td class="tambahan w180">Skim Pencairan </td><td class="w300"><?= $cekTrail->printTrail("skim_pencairan") ?></td></tr>  
                                            <tr class='skimshowhide'><td>SIUP </td><td>                             
        <?= $cekTrail->printTrail("siup") ?>
        <?= $cekTrail->printTrail("siup_n") ?>

                                                </td></tr>  
                                            <tr class='skimshowhide'><td>Tanda Daftar Perusahaan </td><td>
        <?= $cekTrail->printTrail("tdp") ?>
        <?= $cekTrail->printTrail("tdp_n") ?>
                                                </td></tr>
                                            <tr class='skimshowhide'><td>Others </td><td>
                                                    <?= $cekTrail->printTrail("others") ?>
        <?= $cekTrail->printTrail("others_n") ?></td></tr>
                                            <tr class='skimshowhide'><td>No NPWP </td><td><?= $cekTrail->printTrail("npwp") ?></td></tr>
                                            <tr class='skimshowhide'><td>No. GS/SU </td><td><?= $cekTrail->printTrail("jml_jaminan") ?></td></tr>                                            
                                            <tr class='skimshowhide'><td>No Sertifikat Tanah</td><td><?= $cekTrail->printTrail("no_surat_tanah") ?></td></tr>
                                            <tr class='skimshowhide'><td>Tgl. Sertifikat </td><td><?= $cekTrail->printTrail("nilai_taksasi","tgl") ?></td> </tr>
                                            <tr class='skimshowhide'><td class="tambahan">Jenis Sertifikat </td><td><?= $cekTrail->printTrail("jenis_sertifikat") ?></td></tr>
                                            <tr class='skimshowhide'><td>Nama Proyek </td><td><?= $cekTrail->printTrail("nama_perumahan") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Jenis Proyek </td><td><?= $cekTrail->printTrail("jenis_proyek") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Kategori Proyek </td><td><?= $cekTrail->printTrail("kategori_proyek") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Nomor PKS </td><td><?= $cekTrail->printTrail("no_pks") ?></td></tr>
                                            <tr class='skimshowhide'><td>Skim PKS </td><td> <?= $cekTrail->printTrail("skim_pks") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Total Unit di Bangun </td><td><?= $cekTrail->printTrail("total_unitdibangun","number") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Penguasaan Sertifikat Induk</td><td><?= $cekTrail->printTrail("penguasaan_sertifikat") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">No Rekening Escrow</td><td><?= $cekTrail->printTrail("no_rek_escrow") ?></td></tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout" class='skimshowhide '>                                   
                                            <tr class='skimshowhide '><td class="tambahan w180">Cair Tahap Fondasi(Rp)</td><td class="w300"><?= $cekTrail->printTrail("cair_tahap_fondasi", "rp") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Tanggal Cair Tahap Fondasi Off</td><td><?= $cekTrail->printTrail("tgl_cair_tahap_fondasi", "tgl") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Keterangan-1</td><td><?= $cekTrail->printTrail("ket_cair_tahap_fondasi") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Cair Tahap Topping Off(Rp)</td><td><?= $cekTrail->printTrail("cair_tahap_topping", "rp") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Tanggal Cair Tahap Topping Off</td><td><?= $cekTrail->printTrail("tgl_cair_tahap_topping", "tgl") ?></td></tr>
                                            <tr class='skimshowhide'><td>Keterangan-2</td><td><?= $cekTrail->printTrail("ket_cair_tahap_topping") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Cair Tahap Bast(Rp)</td><td><?= $cekTrail->printTrail("cair_tahap_bast", "rp") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Tanggal Cair Tahap Bast</td><td><?= $cekTrail->printTrail("tgl_cair_tahap_bast", "tgl") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Keterangan-3</td><td><?= $cekTrail->printTrail("ket_cair_tahap_bast") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Cair Tahap Dokumen(Rp)</td><td><?= $cekTrail->printTrail("cair_tahap_dok", "rp") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Tanggal Cair Tahap Dokumen</td><td><?= $cekTrail->printTrail("tgl_cair_tahap_dok", "tgl") ?></td></tr>
                                            <tr class='skimshowhide'><td class="tambahan">Keterangan-4</td><td><?= $cekTrail->printTrail("ket_cair_tahap_dok") ?></td></tr>
                                            <tr class='skimshowhide'><td>Progress Pembangunan</td><td><?= $cekTrail->printTrail("progress") ?></td></tr>
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
        <?= $cekTrail->printTrail("no_polis_ass_kerugian") ?>
        <?= $cekTrail->printTrail("no_polis_ass_kerugian_n") ?>
                                                </td>
                                            </tr>
                                            <tr><td class="w180">Asuransi Kerugian</td><td class="w300"><?= $cekTrail->printTrail("asuransi_kerugian") ?></td></tr>
                                            <tr><td class="tambahan">Berkas Polis Asuransi Kerugian</td><td><?= $cekTrail->printTrail("berkas_asuransi_kerugian") ?></td></tr>
                                            <tr><td>Premi Asuransi Kerugian</td><td><?= $cekTrail->printTrail("premi_kerugian", "rp") ?></td></tr>

                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">
                                            <tr><td class="w180">Nilai Pertanggungjawaban Asuransi Kerugian</td><td class="w300"><?= $cekTrail->printTrail("nilai_pertanggungan_ass_kerugian", "rp") ?></td></tr>
                                            <tr><td>Tanggal Asuransi Kerugian</td><td><?= $cekTrail->printTrail("tgl_ass_kerugian", "tgl") ?></td></tr>
                                            <tr><td>Tanggal Jatuh Tempo Asuransi Kerugian</td><td><?= $cekTrail->printTrail("tgl_jt_ass_kerugian", "tgl") ?></td></tr>

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
        <?= $cekTrail->printTrail("no_polis_ass_jiwa") ?>
        <?= $cekTrail->printTrail("no_polis_ass_jiwa_n") ?>
                                                </td>
                                            </tr>
                                            <tr><td class="w180">Asuransi Jiwa</td><td class="w300"><?= $cekTrail->printTrail("asuransi_jiwa") ?></td></tr>

                                            <tr><td class="tambahan">Berkas Polis Asuransi Jiwa</td><td><?= $cekTrail->printTrail("berkas_assuransi_jiwa") ?></td></tr>
                                            <tr><td>Premi Asuransi Jiwa</td><td><?= $cekTrail->printTrail("premi_jiwa", "rp") ?></td></tr>

                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">
                                            <tr><td class="w180">Nilai Pertanggungjawaban Asuransi Jiwa</td><td class="w300"><?= $cekTrail->printTrail("nilai_pertanggungan_ass_jiwa", "rp") ?></td></tr>
                                            <tr><td>Tanggal Asuransi Jiwa</td><td><?= $cekTrail->printTrail("tgl_ass_jiwa", "tgl") ?></td></tr>
                                            <tr><td>Tanggal Jatuh Tempo Asuransi Jiwa</td><td><?= $cekTrail->printTrail("tgl_jt_ass_jiwa", "tgl") ?></td></tr>

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
        <?= $cekTrail->printTrail("no_jaminan_fleksi") ?>
        <?= $cekTrail->printTrail("no_jaminan_fleksi_n") ?>
                                                </td></tr>
                                            <tr><td>Jenis Jaminan </td><td class="w300"><?= $cekTrail->printTrail("jns_jaminan_fleksi") ?></td></tr>
                                            <tr><td>Surat Pernyataan</td><td><?= $cekTrail->printTrail("srt_pernyataan_fleksi") ?></td></tr>
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
        <?= $cekTrail->printTrail("no_bpkb") ?>
        <?= $cekTrail->printTrail("no_bpkb_n") ?>                                                    
                                                </td>
                                            </tr>
                                            <tr><td class="w180">Jenis Kendaraan</td><td class="w300"><?= $cekTrail->printTrail("jenis_kendaraan") ?></td></tr>
                                            <tr><td>Merk</td><td><?= $cekTrail->printTrail("merk") ?></td></tr>
                                            <tr><td>No Polisi</td><td><?= $cekTrail->printTrail("no_polisi") ?></td></tr>


                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">                                                
                                            <tr><td class="w180">No Rangka</td><td class="w300"><?= $cekTrail->printTrail("no_rangka") ?></td></tr>
                                            <tr><td>No Mesin</td><td><?= $cekTrail->printTrail("no_mesin") ?></td></tr>
                                            <tr><td>Nama Dealer</td><td><?= $cekTrail->printTrail("nama_dealer") ?></td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
        <?php
    }
    if($showEmergencyKon){
     ?>
                            <h1 class="judulfrm">Emergeny Contact</h1>
                            <table class="tbllayout">
                                <tr>
                                    <td>
                                        <table class="tbllayout">
                                            <tr>
                                                <td class="w180">Nama Emergency Contact</td>
                                                <td class="w300"><?= $cekTrail->printTrail("nama_emergency") ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td >No. Telp. Emergency Contact</td>
                                                <td ><?= $cekTrail->printTrail("telp_emergency") ?></td>
                                            </tr>
                                            
                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">
                                            <tr>
                                                <td class="w180">Alamat Kantor </td>
                                                <td class="w300"><?= $cekTrail->printTrail("alamat_kantor") ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td > Hubungan Keluarga</td>
                                                <td ><?= $cekTrail->printTrail("hubungan") ?></td>
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
                                                <td class="w300"><?= $cekTrail->printTrail("lokasi_dokumen_asli"); ?> </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>No. Kluis Dokumen Kerja</td><td><?= $cekTrail->printTrail("lokasi_dokumen_copy"); ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. Bantek Dokumen Asli</td><td><?= $cekTrail->printTrail("amplop_asli"); ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>No. Bantek Dokumen Kerja</td><td><?= $cekTrail->printTrail("amplop_copy"); ?></td>
                                            </tr>
                                            
                                            
                                            
                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">
                                            <tr>
                                                <td class="w180">No. Amplop Asli</td><td  class="w300"><?= $cekTrail->printTrail("amplopasli"); ?></td>
                                            </tr>
                                            <tr>
                                                <td>No. Amplop Kerja</td><td><?= $cekTrail->printTrail("amplopcopy"); ?></td>
                                            </tr>
                                                                                   
                                            <tr>
                                                <td>Nama Sales</td><td><?= $cekTrail->printTrail("sales"); ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Hp Sales</td><td><?= $cekTrail->printTrail("hp_sales"); ?></td>
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
        <?= $cekTrail->printTrail("serah") ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>  Tanggal Pelunasan</td>
                                                <td> <?= $cekTrail->printTrail("tgl_pelunasan", "tgl") ?></td>
                                            </tr>

                                            <tr>
                                                <td>tanggal diserahkan</td>
                                                <td><?= $cekTrail->printTrail("tgl_serah", "tgl") ?></td>
                                            </tr>

                                        </table>
                                    </td>
                                    <td>
                                        <table class="tbllayout">
                                            <tr> <td class="w180"> Status Rekg. Pinjaman</td> <td class="w300"> <?= $cekTrail->printTrail("status_rekg") ?></td> </tr>
                                            <tr> <td>  Nama Penerima</td> <td > <?= $cekTrail->printTrail("pelunasan_penerima") ?></td> </tr>

                                            <tr><td>Keterangan</td><td><?= $cekTrail->printTrail("pelunasan_keterangan") ?></td></tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <h1 class="judulfrm">Memo</h1>
                            <?= $cekTrail->printTrail("memo") ?>
                            <h1 class="judulfrm"> Kendala Pengikatan</h1>
                            <?=        $cekTrail->printTrail("kendala") ?>
                           
<?php                              
    }
    
    ?>
                        <?php
                    }
                    ?>
                </div>
         
        </form>
    </body>
</html>