<?php
include ("koneksi.php");
mysql_select_db("absen");
echo("Hasil pencarian ");
$cari=$HTTP_GET_VARS['cari'];
$pilih=$HTTP_GET_VARS['pilih'];

$perintah="SELECT * FROM  kehadiran WHERE kehadiran.TGLMASUK like '%$cari%' ";
$hasil=mysql_query($perintah);
if (isset($hasil))
{
Echo ("data yang ditemukan : <BR><BR>");
While ($data=mysql_fetch_row($hasil))
{
Echo 
"a href=lihatpegawai.php";
echo date('d-m-Y');
}
}
else
{
Echo ("maaf , data yang anda cari tidak ada ");
}
?>
