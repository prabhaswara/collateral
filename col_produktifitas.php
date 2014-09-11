<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_produktifitas.php';
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
                    <li class="ui-state-default <?=$cssInput ?>" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="?submn=input" class="ui-tabs-anchor" role="presentation" tabindex="-1" >SUMMARY INPUT</a></li>
                    <li class="ui-state-default <?=$cssEdit ?>" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="?submn=edit" href="" class="ui-tabs-anchor" role="presentation" tabindex="-1" >SUMMARY EDIT</a></li>
                </ul>
                <form method="POST">
                <table>
                    <tr><td width="200px">LNC</td><td><?= ht_select("lnc",$listLNC,"",false) ?></td></tr>
                    <tr><td>Tanggal</td><td><?=  ht_input("tgl1","class='dateMask dateNormal' style='width:110px'") ?> s/d <?=  ht_input("tgl2","class='dateMask dateNormal' style='width:110px'") ?></td></tr>
                    <tr><td></td><td><input type="submit" name="action" value="Cari" /></td></tr>
                </table>
                </form>
                
                <div style="margin:5px">
                    <table class="tblLookup" border="1px">
                        <thead>
                            <tr>
                                <th width="120px" style="text-align: center">LNC</th>
                                <th width="120px" style="text-align: center">NPP</th>
                                <th width="200px" style="text-align: center">NAMA</th>
                                <th width="150px" style="text-align: center">JML</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($dataTBL)){
                                $total=0;
                                foreach ($dataTBL as $row){
                            ?>
                            <tr>
                                <td><?=$row['lnc']?></td>
                                <td><?=$row['npp']?></td>
                                <td><?=$row['nama']?></td>
                                <td><a style="font-weight: bold" href="col_produktifitasDet.php?npp=<?=$row['npp']?>&nama=<?=$row['nama']?>&tgl1=<?=$_POST['frm']['tgl1']?>&tgl2=<?=$_POST['frm']['tgl2']?>&submn=<?=$_GET['submn'] ?>&lnc=<?=$row['lnc']?>"> <?=numsep($row['jml'])?></a></td>                                
                            </tr>
                            <?php
                            
                            $total+=$row['jml'];
                                }
                            
                            ?>
                        <thead>
                            <tr>
                                <th>Total</th><th></th><th></th><th><?=numsep($total)?></th>
                            </tr>
                        </thead>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </body>
</html>