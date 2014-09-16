<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_sumLegalitas.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>
            $(document).ready(function() {
                $('#jns_pencarian').change(function() {

                    window.location.href = "col_sumLegalitas.php?jns_pencarian=" + $('#jns_pencarian').val();
                });

                $('#tgl_point').change(function() {

                    window.location.href = "col_sumLegalitas.php?jns_pencarian=point&tgl_point=" + $('#tgl_point').val();
                });
            });

        </script>
    </head>
    <body>           



        <div style="margin:0px 50px;text-align: left;">
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" style="height: 100%">        
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="col_sumPending.php" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Summary Pending </a></li>
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Legalitas</a></li>
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="0" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="true" aria-expanded="true"><a href="col_SumCairTahap.php" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Pencairan Bertahap</a></li>
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
                                    <th width="110px" style="text-align: center">IMB</th>
                                    <th width="110px" style="text-align: center">SIUP</th>
                                    <th width="110px" style="text-align: center">TDP</th>
                                    <th width="110px" style="text-align: center">OTHERS</th>                 
                                    <th width="110px" style="text-align: center">TOTAL</th>
                                   
                                </tr>
                            </thead>

                            <?php
                            $row = 1;
                            if ($showtable) {
                                ?>
                                <tbody>
                                    <?php
                                    if (!$_GET['jns_pencarian'] != "point") {
                                        unset($_SESSION['colateral']['summery_legal']);
                                    }

                                    $tgl = date("Y-m-d");
                                    if ($_GET['jns_pencarian'] == "tgl") {
                                        $tgl = balikTgl($_POST['frm']['tgl_update']);
                                    }
                                    $sumIMB = 0;
                                    $sumSIUP = 0;
                                    $sumTDP = 0;
                                    $sumOTHERS = 0;

                                    $sumTOTAL = 0;
                                    $sumDEBITUR = 0;

                                    foreach ($dataLNC as $lnc) {
                                        $total = intval($countIMB[$lnc['singkatan']]) +
                                                intval($countSIUP[$lnc['singkatan']]) +
                                                intval($countTDP[$lnc['singkatan']]) +
                                                intval($countOTHERS[$lnc['singkatan']]);

                                        $sumIMB+=$countIMB[$lnc['singkatan']];
                                        $sumSIUP+=$countSIUP[$lnc['singkatan']];
                                        $sumTDP+=$countTDP[$lnc['singkatan']];
                                        $sumOTHERS+=$countOTHERS[$lnc['singkatan']];
                                        $sumTOTAL+=$total;
                                        $sumDEBITUR+=$countTotalDebitur[$lnc['singkatan']];

                                        if (!$_GET['jns_pencarian'] != "point") {
                                            $_SESSION['colateral']['summery_legal'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'imb', "jumlah" => $countIMB[$lnc['singkatan']]);
                                            $_SESSION['colateral']['summery_legal'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'siup', "jumlah" => $countSIUP[$lnc['singkatan']]);
                                            $_SESSION['colateral']['summery_legal'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'tdp', "jumlah" => $countTDP[$lnc['singkatan']]);
                                            $_SESSION['colateral']['summery_legal'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'total', "jumlah" => $total);
                                            $_SESSION['colateral']['summery_legal'][] = array("tanggal" => $tgl, "lnc" => $lnc['singkatan'], "jenis" => 'total_debitur', "jumlah" => $countTotalDebitur[$lnc['singkatan']]);
                                        }
                                        ?>
                                        <tr>
                                            <td  style="text-align: center"><?= $row++ ?></td>                        
                                            <td  style="text-align: center"><?= $lnc['singkatan'] ?></td>                        
                                            <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending IMB&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=status_imb"> <?= numsep(cleanNumber($countIMB[$lnc['singkatan']])) ?></a></td>
                                            <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending SIUP&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=siup"> <?= numsep(cleanNumber($countSIUP[$lnc['singkatan']])) ?></a></td>
                                            <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending TDP&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=tdp"> <?= numsep(cleanNumber($countTDP[$lnc['singkatan']])) ?></a></td>
                                            <td  style="text-align: center"><a href="col_sumDet.php?jenis=Pending Others&tgl=<?=$setTgl?>&lnc=<?= $lnc['singkatan'] ?>&jns=others"> <?= numsep(cleanNumber($countOTHERS[$lnc['singkatan']])) ?></a></td>
                                            <td style="text-align: center"><?= numsep($total) ?></td>
                                          
                                        </tr>
                                        <?php }
                                    ?> 
                                </tbody>
                                <?php
                                $sumIMB+=$countIMB[$lnc['singkatan']];
                                $sumSIUP+=$countSIUP[$lnc['singkatan']];
                                $sumTDP+=$countTDP[$lnc['singkatan']];
                                $sumOTHERS+=$countOTHERS[$lnc['singkatan']];
                                $sumTOTAL+=$total;
                                $sumDEBITUR+=$countTotalDebitur[$lnc['singkatan']];
                                ?>
                                <thead>
                                    <tr>
                                        <th style="text-align: center"></th>
                                        <th style="text-align: center"></th>
                                        <th style="text-align: center"><?= numsep($sumIMB) ?></th>
                                        <th style="text-align: center"><?= numsep($sumSIUP) ?></th>
                                        <th style="text-align: center"><?= numsep($sumTDP) ?></th>
                                        <th style="text-align: center"><?= numsep($sumOTHERS) ?></th>
                                        <th style="text-align: center"><?= numsep($sumTOTAL) ?></th>
                                    
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
    </body>
</html>