<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<center><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="1">
<div align="left"><br>
  <span class="style1"><a href=utama.htm>MENU UTAMA</a> - <a href=loginregistrasi.php>REGISTRASI</a> - <a href=menuutama.php>MAINTENANCE </a> - <a href=proses.php>PROSES</a> - <a href="laporan.htm">LAPORAN</a> - <a href=logout.php>LOGOUT</a><BR>
  <?php
Include ("koneksi.php");
mysql_select_db("collateral_db");
//$data[3]=date("Y/m/d");
//Echo ("<br>PT. Bank Negara Indonesia (Persero), Tbk<BR>");
//Echo ("Cabang Majalaya<BR>");
//Echo ("Daftar Hadir<BR>");
//Echo ("<img src=BNI.jpg alt=gambar >");
echo "<br>";
Echo ("<TABLE border=1>");

Echo 
("<TR><TD align=center>NO</TD>
<td width="21" align="center"><b>No</b></td>
  <td align="center"><b>Nama LNC</b></td>
  <td align="center"><b>No.Aplikasi</b></td>
  <td align="center"><b>Nama Debitur</b></td>
  <td align="center"><b>No.Rek. Pinjaman</b></td>
  <td align="center"><b>Jenis Produk</b></td>
  <td align="center"><b>Maksimum Kredit</b></td>
  <td align="center"><b>Nilai HT</b></td>
  <td align="center"><b>Nama Notaris</b></td>
  <td align="center"><b>Tgl. PK</b></td>
  <td align="center"><b>Hari Pending</b></td></TR>");

$perintah="SELECT debitur.LNC, debitur.NOAPLIKASI, debitur.NAMADEBITUR, debitur.no_rekg_pinjaman, 
debitur.produk, debitur.maksimum_kredit, debitur.nilai_ht, debitur.notaris, debitur.tgl_pk 
FROM debitur WHERE debitur.no_pengikatan='BLM ADA'";
$tampil_data=mysql_query($perintah);
While ($data=mysql_fetch_row($tampil_data))
{
Echo ("<TR><TD>$data[0]</TD><TD>$data[1]</TD><TD>$data[2]</TD><TD align=center>$data[3]</TD>
       <TD align=center>$data[4]</TD><TD align=center>$data[5]</TD><TD align=center>$data[6]</TD>
       <TD align=center>$data[7]</TD><TD align=center>$data[8]</TD><TD align=center>$data[9]</TD>;
}
Echo("</TABLE>");
?>
  </span></div>
