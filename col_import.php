<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include "excel_reader2.php";
include 'collateral_script/control_import.php';
?>   

<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>
        $(document).ready(function() {
            $("#close_box-ses").click(function(){
                    $("#alert-box-ses").hide( "slow" );
                });
        });
        
        </script>
    </head>
    <body>
    <div style="margin:0px 50px;text-align: left;">
                    
                    <h1 class="judulfrm">Import Ke Database</h1>
                    <?php 
                        if(isset($_SESSION['colateral']['message'])){
                            echo $_SESSION['colateral']['message'];
                            unset($_SESSION['colateral']['message']);
                        }
                    ?>
                    
            <form method="post" enctype="multipart/form-data">
                <table class="tbllayout">
                    <tr><td>Pilih File Excel</td><td>
                        <input name="userfile" type="file"/>                        
                    </td></tr>
                </table>
                <input type="Submit" name='action' value="Import" />
            </form>
        </div>
  
</body>
</html>