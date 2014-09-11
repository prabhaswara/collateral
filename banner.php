<?php 
session_start();
?>
<style>
	#nav_col123 {
		width: 100%;
		float: left;
		margin: 0 ;
		padding: 0;
		list-style: none;
		background-color: #f2f2f2;
		border-bottom: 1px solid #ccc; 
		border-top: 1px solid #ccc; }
	#nav_col123 li {
		float: left; }
	#nav_col123 li a {
		display: block;
		padding: 8px 15px;
		text-decoration: none;
		font-weight: bold;
		color: #069;
		border-right: 1px solid #ccc; 
		
		}

	#nav_col123 li a:hover {
		color: #c00;
		background-color: #fff; }
	
	#wrap_col123 {
		width: 100%;
		margin: 0 auto;
		background-color: #fff; 
                height:40px;
        
        }

</style>
<div style="height: 70px;">
    <img src="images/head_left.png" style="float:left">
    <div style="position: absolute;bottom: 50px;right:10px;color:#069">
        <div><?="Selamat datang, [".$_SESSION['colateral']['npp']."] ".$_SESSION['colateral']['nama'] ?></div>
        <div><?=$_SESSION['colateral']['cabang']  ?></div>
    
    </div>
</div>
<div id="wrap_col123">
	<ul id="nav_col123">
                <li><a href="col_monitoring.php" target="main">Monitoring</a></li>            
		<li><a href="col_frminput.php" target="main">Form Cads</a></li>
		<li><a href="col_sumPending.php" target="main">Summary </a></li>
		
                <?php if($_SESSION['colateral']['group']=="admin"){ ?>
                <li><a href="col_database.php" target="main">Database</a></li>
                <li><a href="col_admin_mn.php" target="main">Admin Menu</a></li>
                <?php } ?>
		<li><a href="logout.php" target="_parent">Logout</a></li>		
	</ul>
</div>

