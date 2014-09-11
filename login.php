<?php 
include 'collateral_script/function.php'; 
include 'collateral_script/db_function.php';
include 'collateral_script/control_login.php'; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login CADS</title>
        <?php include 'collateral_script/head.php'; ?>  
    </head>
    <body>
        <form method="POST">
             <center style="margin-top:100px">
            
			<div style="width:500px;border:1px solid #0d515a;padding:0px">
			<div style="padding:10px;margin:0px;background-color:#0d515a;color:white;font-weight:bold;">
				COLLATERAL ALERT DETECTION SYSTEM
			</div>
            <table style='margin:10px'>
				
				<tr>
					<td rowspan=2>
					<img src='images/login.jpg'/>
					</td>
					<td>
						<table cellspacing=8>
							<tr><td width='100px' align='right'>NPP</td><td><?=ht_input("npp","style='width:200px'") ?></td></tr>
							<tr><td align='right'>Password</td><td><?=ht_input("password","style='width:200px'","password") ?></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<input type=submit value=LOGIN>
						<input type=reset value=BATAL>
					</td>
				</tr>
				<tr>
					<td colspan=2>
					<?=$errorBox?>
					</td>
				</tr>
			</table>
            </div>
            
        </center>
        </form>
   
        
    </body>
</html>
