<?php 
    session_start();   
    if(empty($_SESSION['colateral'])){
        header('location:login.php');
    }
    
?>
<html>

<head>
<link rel="shortcut icons" href="bnilogo.ico"/>
<title>CADS</title>

<meta name="Microsoft Theme" content="axis 011">
</head>
<frameset rows="110,*" cols="*" framespacing="0" framepadding='0' frameborder="0" border="0">
    <frame name="banner" scrolling="no" noresize marginwidth="0" marginheight="0" src="banner.php" />
    <frame name="main" src="col_monitoring.php" marginwidth="10" target="_self" scrolling="auto"/>  
</frameset>   
</html>