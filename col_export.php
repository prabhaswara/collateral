<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_export.php';
?>   

<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>
           

        </script>
    </head>
    <body>
    <div style="margin:0px 50px;text-align: left;">
                    
                    <h1 class="judulfrm">Export To excel</h1>
            <form method="post">
                <table class="tbllayout">
                    <tr><td>Tanggal Update</td><td>
                        <?= ht_input("tgl_awal", "class='dateNormal dateMask' style='width:100px'") ?>
                            s/d
                        <?= ht_input("tgl_akhir", "class='dateNormal dateMask' style='width:100px'") ?>
                        
                        </td></tr>
                    

                </table>
                <input type="Submit" name='action' value="Export to excel" />
               

            </form>


        </div>
   
</body>
</html>