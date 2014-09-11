<style type="text/css">
<!--
.style1 {
	font-size: smaller;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

<?php

$NPP=$HTTP_POST_VARS['NPP'];
$NAMA=$HTTP_POST_VARS['NAMA'];
$PASSWORD=$HTTP_POST_VARS['PASSWORD'];
if ((!$NPP) or (!$PASSWORD))
echo "<br><br>Login Gagal salah User ID atau Password !!!  <BR>Harap Lakukan Login Ulang <a href=login.htm>LOGIN</a>";
else
{

$koneksi = mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("collateral",$koneksi);
$query_login = mysql_query("select count(*) as login from pegawai where npp='$NPP' and Password='$PASSWORD'",$koneksi) or die (mysql_error());
$row = mysql_fetch_array($query_login);
if ($row["login"]=="1")
{
		$con = mysql_connect("localhost","root","");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		echo "<BR><a href=summary.php><b>MODUL COLLATERAL</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=cpr/summary.php><b>MODUL PENCAIRAN BERTAHAP</b></a>
		      <BR><BR>Selamat Datang NPP $NPP, Selamat Beraktifitas.....!!!";
		mysql_close($con);
}
else
echo("<br><br>Login Gagal salah User ID atau Password !!!  <BR>Harap Lakukan Login Ulang <a href=login.htm>LOGIN</a>");
}

?>