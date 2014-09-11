<?php
Include ("koneksi.php");
mysql_select_db("collateral_db");

mysql_query("DELETE FROM pegawai WHERE NPP='$_GET[id]'");
header('location:lihatuser.php');
?>