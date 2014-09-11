<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<h2>Laporan Pending Pengikatan </h2>
</form> <form action=start.html method=POST class="style1">
  MENU UTAMA &amp;nbsp&amp;nbspREPORT 
</form>


<table>

<tr>
<th>NO</th>
<th>NO.APLIKASI</th>
<th>NAMA DEBITUR</th>
<th>NO.REK.PINJAMAN</th>
<th>JENIS PRODUK</th>
<th>MAKSIMUM KREDIT</th>
<th>NILAI HT</th>
<th>NAMA NOTARIS</th>
<th>TGL. PK</th>
<th>HARI PENDING</th>
</tr>";

Include ("koneksi.php");
mysql_select_db("collateral_db");

$tampil=mysql_query("SELECT * FROM debitur ORDER BY tgl_pk");
$no=1;
While ($r=mysql_fetch_array($tampil)){

Echo "
<tr>
<td>$no</td>
<td>$r[LNC]</td>
<td>$r[NAMADEBITUR]</td>
<td>$r[no_rekg_pinjaman]</td>
<td>$r[produk]</td>
<td>$r[maksimum_kredit]</td>
<td>$r[nilai_ht]</td>
<td>$r[notaris]</td>
<td>$r[tgl_pk]</td>
<td>$r[NAMADEBITUR]</td>

</tr>";

      $no++;
}

echo "</table>";
?>
</body>
</html>
