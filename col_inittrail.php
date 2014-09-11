<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
$db_function =new db_function();
if(!empty($_POST)){
    $user=$_SESSION['colateral']['npp'];   
    $error=$db_function->initTrail('init', "1", "");
    
    echo $error;
}


$row=$db_function->selectOnefield("select count(*)from debitur left join debitur_trail on debitur.noaplikasi = debitur_trail .noaplikasi where debitur_trail.noaplikasi is null");
        

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  
    </head>
    <body>
        <div style="margin:0px 50px;text-align: left;">
            <h1 class="judulfrm">Inisialisasi Trail</h1>
            <div style="margin:10px;">
                <form method="POST">
                    <h3><?=$row ?> data tidak ada auditrail </h3>
                    <input type="submit" value="Inisialisasi Trail" name="action" />
                </form>
                
            </div>
        </div>
    </body>
</html>