<TITLE>HAPUS DATA LNC</TITLE>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	table-layout: auto;
}
.style5 {
	font-size: 12px;
	font-weight: bold;
}
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.style10 {font-size: 18px}
.style11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<p><span class="style1"><a href="summary.php">MENU UTAMA</a>&nbsp&nbsp&nbsp<a href="maint.htm" class="style1">DATABASE</a>&nbsp&nbsp&nbsp</span> <BR>
  <BR>
  <style type="text/css">
table { 
   border: 1px solid #000000;
}
th {
   background-color : #FF9900;
   color            : #FFFFFF;
}
tr:hover{
   background-color : #CCCCCC;
}
  </style>
</p>
<p align="center"><span class="style11"> HAPUS DATABASE LNC</span></p>
<form method=get action=hapus_data.php>
  <p class="style2">&nbsp;</p>
  <p class="style2"><span class="style10">Nama LNC</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="style2">
    <select size="1" name="LNC">
      <option>PLL</option>
    </select>
  </span></p>
  <p class="style2">
    <input type=submit name=oke value=Cari>
  </p>
</form>
    
<?php
Include ("koneksi.php");

//Get values from form
$id=$_GET['LNC'];

mysql_select_db("collateral");

$del=mysql_query("delete from debitur WHERE LNC='$id'");


//Close database connection
mysql_close();

echo "Data LNC $id telah dihapus !!!";
?>
