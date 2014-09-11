<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE );
error_reporting(E_ERROR |E_PARSE |E_CORE_ERROR);
session_start();
require 'jsonwrapper/jsonwrapper.php';

if(
        !$_SESSION['colateral']['group']=="admin" &&
        preg_match("/(col_admin_mn|col_lookup|col_inittrail|col_database|col_import|col_export)/", $_SERVER['PHP_SELF'])
  )
{
    exit;
}
if(empty($_SESSION['colateral'])){
    echo "<script>parent.location='login.php';</script>";exit;
     
    }
    
?>
