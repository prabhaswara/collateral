<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_sumPending.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>
            $(document).ready(function() {
                $('#jns_pencarian').change(function() {

                    window.location.href = "col_sumPending.php?jns_pencarian=" + $('#jns_pencarian').val();
                });

                $('#tgl_point').change(function() {

                    window.location.href = "col_sumPending.php?jns_pencarian=point&tgl_point=" + $('#tgl_point').val();
                });


            });

        </script>
    </head>
    <body>           



        <div style="margin:0px 50px;text-align: left;">
            

            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" style="height: 100%">        
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Summary Pending</a></li>
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="col_sumLegalitas.php" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Legalitas</a></li>
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="false" aria-expanded="false"><a href="col_sumCairTahap.php" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Pencairan Bertahap</a></li>
                </ul>


                <div style="margin:5px">
                <form method="post">
                    <div style="height: 20px;margin-top: 20px;">
                        <?=
                        ht_select("jns_pencarian", array(
                            "tgl" => "Summary berdasar tanggal update trail",
                            "saat_ini" => "Summary berdasar tgl hari ini",
                            "point" => "Summary yang pernah disimpan"
                                ), "", false)
                        ?>

                        <?php
                        if ($_GET['jns_pencarian'] == "tgl") {
                            ?>
                            <?= ht_input("tgl_update", "class='dateNormal dateMask' style='width:100px'") ?>
                            <input type="Submit" name='action' value="cari" />
                            <?php
                        } else if ($_GET['jns_pencarian'] == "point") {
                            ?>

                            <?= ht_select("tgl_point", $ddl_tglpoint) ?>

                            <?php
                        }
                        ?>

                    </div>



                    <table class="tblLookup" border="1px" style="width:100%">
                        <thead>
                            <tr>
                                <th width="50px" style="text-align: center">NO</th>
                                <th width="70px" style="text-align: center">LNC</th>
                                <th width="110px" style="text-align: center">BPKB</th>
                                <th width="110px" style="text-align: center">AJB</th>
                                <th width="110px" style="text-align: center">SHT</th>
                                <th width="110px" style="text-align: center">POLIS ASURANSI JIWA</th>
                                <th width="110px" style="text-align: center">POLIS ASURANSI Kerugian</th>
                                <th width="110px" style="text-align: center">TOTAL</th>
                                <th  width="110px" style="text-align: center">JUMLAH DEBITUR</th>
                            </tr>
                        </thead>

                        <?php
                        $row = 1;
                        if ($showtable) {
                            ?>
                            <tbody>
                                <?php
                                if (!$_GET['jns_pencarian'] != "point") {
                                    unset($_SESSION['colateral']['summery_pending']);
                                }

                                $tgl = date("Y-m-d");
                                if ($_GET['jns_pencarian'] == "tgl") {
                                    $tgl = balikTgl($_POST['frm']['tgl_update']);
                                }
                                $sumBPKB = 0;
                                $sumAJB = 0;
                                $sumSHT = 0;
                                $sumJIWA = 0;
                                $sumRUGI;
                                $sumTOTAL = 0;
                                $sumDEBITUR = 0;

                                foreach ($dataLNC as $lnc) {
                                    $total = intval($countBPKB[$lnc['singkatan']]) +
                                            intval($countAJB[$lnc['singkatan']]) +
                                            intval($countSHT[$lnc['singkatan']]) +
                                            intval($countAssJiwa[$lnc['singkatan']]) +
                                            intval($countKerugian[$lnc['singkatan']]);

                                    $sumBPKB+=$countBPKB[$lnc['singkatan']];
                                    $sumAJB+=$countAJB[$lnc['singkatan']];
                                    $sumSHT+=$countSHT[$lnc['singkatan']];
                                    $sumJIWA+=$countAssJiwa[$lnc['singkatan']];
                                    $sumRUGI+=$countKerugian[$lnc['singkatan']];
                                    $sumTOTAL+=$total;
                                    $sumDEBITUR+=$countTotalDebitur[$lnc['singkatan']];

                                    if (!$_GET['jns_pencarian'] != "point") {
                                        $_SESSION['colateral']['summery_pending'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'bpkb', "jumlah" => $countBPKB[$lnc['singkatan']]);
                                        $_SESSION['colateral']['summery_pending'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'ajb', "jumlah" => $countAJB[$lnc['singkatan']]);
                                        $_SESSION['colateral']['summery_pending'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'sht', "jumlah" => $countAssJiwa[$lnc['singkatan']]);
                                        $_SESSION['colateral']['summery_pending'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'ass_jiwa', "jumlah" => $countSHT[$lnc['singkatan']]);
                                        $_SESSION['colateral']['summery_pending'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'kerugian', "jumlah" => $countKerugian[$lnc['singkatan']]);
                                        $_SESSION['colateral']['summery_pending'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'total', "jumlah" => $total);
                                        $_SESSION['colateral']['summery_pending'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'total_debitur', "jumlah" => $countTotalDebitur[$lnc['singkatan']]);
                                    }
                                    ?>
                                    <tr>
                                        <td  style="text-align: center"><?= $row++ ?></td>                        
                                        <td  style="text-align: center"><?= $lnc['singkatan'] ?></td>                        
                                        <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending BPKB&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=no_bpkb"> <?= numsep(cleanNumber($countBPKB[$lnc['singkatan']])) ?></a></td>
                                        <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending AJB&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=no_ajb"><?= numsep(cleanNumber($countAJB[$lnc['singkatan']])) ?></a></td>
                                        <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending SHT&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=no_pengikatan"><?= numsep(cleanNumber($countSHT[$lnc['singkatan']])) ?></a></td>
                                        <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending Asuransi Jiwa&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=no_polis_ass_jiwa"><?= numsep(cleanNumber($countAssJiwa[$lnc['singkatan']])) ?></a></td>
                                        <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending Kerugian&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=no_polis_ass_kerugian"><?= numsep(cleanNumber($countKerugian[$lnc['singkatan']])) ?></a></td>
                                        <td style="text-align: center"><?= numsep($total) ?></td>
                                        <td style="text-align: center"><a href="col_sumDet.php?jenis=Total Debitur Aktif&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=status_rekg"><?= numsep(intval($countTotalDebitur[$lnc['singkatan']])) ?></a></td>
       
                                    </tr>
                                    <?php }
                                ?> 
                            </tbody>
                            <?php
                            $sumBPKB+=$countBPKB[$lnc['singkatan']];
                            $sumAJB+=$countAJB[$lnc['singkatan']];
                            $sumSHT+=$countSHT[$lnc['singkatan']];
                            $sumJIWA+=$countAssJiwa[$lnc['singkatan']];
                            $sumRUGI+=$countKerugian[$lnc['singkatan']];
                            $sumTOTAL+=$total;
                            $sumDEBITUR+=$countTotalDebitur[$lnc['singkatan']];
                            ?>
                            <thead>
                                <tr>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center"><?= numsep($sumBPKB) ?></th>
                                    <th style="text-align: center"><?= numsep($sumAJB) ?></th>
                                    <th style="text-align: center"><?= numsep($sumSHT) ?></th>
                                    <th style="text-align: center"><?= numsep($sumJIWA) ?></th>
                                    <th style="text-align: center"><?= numsep($sumRUGI) ?></th>
                                    <th style="text-align: center"><?= numsep($sumTOTAL) ?></th>
                                    <th style="text-align: center"><?= numsep($sumDEBITUR) ?></th>
                                </tr>
                            </thead>
                            <?php
                        }
                        ?>


                    </table>
                    <?php if ($showtable && !$_GET['jns_pencarian'] != "point") { ?>
                        <div style="margin:10px 0px;"><input type="submit" name="action" value="Simpan Point" /></div>
                        <?php }
                    ?>

                </form>
                </div>

            </div>
        </div>
    </body>
</html>