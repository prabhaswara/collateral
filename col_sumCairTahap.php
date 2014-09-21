<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_sumCairTahap.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  


    </head>
    <body>           



        <div style="margin:0px 50px;text-align: left;">


            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" style="height: 100%">        
                <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="false" aria-expanded="false"><a href="col_sumPending.php" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Summary Pending</a></li>
                    <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="col_sumLegalitas.php" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Legalitas</a></li>
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab-3" tabindex="0" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="true" aria-expanded="true"><a href="" class="ui-tabs-anchor" role="presentation" tabindex="-1" >Pencairan Bertahap</a></li>
                </ul>


                <div style="margin:5px">

                    <table class="tblLookup" border="1px" style="width:100%">
                        <thead>
                            <tr>
                                <th align="center" rowspan="2" width="80px">LNC</th>
                                <th align="center" rowspan="2">TOTAL DEBITUR</th>
                                <th align="center" colspan="4">PEMBANGUNAN IN PROGRESS</th>
                                <th align="center" colspan="2">TOTAL PENCAIRAN BERTAHAP</th>
                                <th align="center" rowspan="2">PROGRESS PENYELESAIAN</th>
                            </tr>
                            <tr>
                                <th align="center" width="120px">PONDASI</th>
                                <th align="center" width="120px">TOPPING OFF</th>
                                <th align="center" width="120px">BAST</th>
                                <th align="center" width="120px">DOKUMEN</th>
                                <th align="center" width="120px">IN PROGRESS</th>
                                <th align="center" width="120px">SELESAI</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            foreach ($dataLNC as $lnc) {
                                $inprogress=  intval($countFondasi[$lnc['singkatan']])+
                                             intval($countTopping[$lnc['singkatan']])+
                                             intval($countBast[$lnc['singkatan']])+
                                             intval($countTahapDok[$lnc['singkatan']]);
                                $persen= floatval($countSelesai[$lnc['singkatan']])/floatval($countDebitur[$lnc['singkatan']])*100;
                                                
                            ?> 
                            <tr>
                                <td  style="text-align: center"><?= $lnc['singkatan'] ?></td>                        
                                <td  style="text-align: center"><a href="col_sumDetCair.php?jns=debitur&lnc=<?= $lnc['singkatan'] ?>"><?= numsep(cleanNumber($countDebitur[$lnc['singkatan']])) ?></a></td> 
                                <td  style="text-align: center"><a href="col_sumDetCair.php?jns=pondasi&lnc=<?= $lnc['singkatan'] ?>"><?= numsep(cleanNumber($countFondasi[$lnc['singkatan']])) ?></a></td>
                                <td  style="text-align: center"><a href="col_sumDetCair.php?jns=topping&lnc=<?= $lnc['singkatan'] ?>"><?= numsep(cleanNumber($countTopping[$lnc['singkatan']])) ?></a></td>
                                <td  style="text-align: center"><a href="col_sumDetCair.php?jns=bast&lnc=<?= $lnc['singkatan'] ?>"><?= numsep(cleanNumber($countBast[$lnc['singkatan']])) ?></a></td>
                                <td  style="text-align: center"><a href="col_sumDetCair.php?jns=dokumen&lnc=<?= $lnc['singkatan'] ?>"><?= numsep(cleanNumber($countTahapDok[$lnc['singkatan']])) ?></a></td>
                                <td  style="text-align: center"><a href="col_sumDetCair.php?jns=inprogress&lnc=<?= $lnc['singkatan'] ?>"><?= numsep(cleanNumber($inprogress)) ?></a></td>
                                <td  style="text-align: center"><a href="col_sumDetCair.php?jns=selesai&lnc=<?= $lnc['singkatan'] ?>"><?= numsep(cleanNumber($countSelesai[$lnc['singkatan']])) ?></a></td>
                                <td  style="text-align: center"><?=$persen?> %</td>
                                        
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </body>
</html>