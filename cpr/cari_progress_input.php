<TITLE>CARI TGL INPUT</TITLE>
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
.style11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<p><span class="style1"><a href="summary.php">MENU UTAMA</a>&nbsp&nbsp&nbsp<a href="laporan.htm" class="style1">OUTPUT</a>&nbsp&nbsp&nbsp</span> <BR>
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
<form name=biodata method=get action=cari_progress_input.php>
  <p class="style2"><span class="style2">
    <font face="Arial">    </font> </span>  </p>
  <p class="style11"> <INPUT type=radio name=pilih value=progress checked>
  DAFTAR DEBITUR  PER TANGGAL INPUT <span class="style2"><font face="Arial">
  </font></span> 
  <p class="style11">
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <font size="2" face="Arial">Tgl. Awal </font></td>
      <td width="86%" style="border-style: none; border-width: medium" height="29"> <font face="Arial"><span class="style11"><span class="style2">
        <input type="date" name="tgl_awal" size="10" style="text-transform:uppercase;" onClick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_awal);return false;">
      </span></span> </font></td>
    </tr>
  </table>
  <table width="100%" height="31" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="14%" style="border-style: none; border-width: medium" height="29"> <font size="2" face="Arial">Tgl. Akhir</font></td>
      <td width="86%" style="border-style: none; border-width: medium" height="29"> <font face="Arial"><span class="style11"><span class="style2">
        <input type=date name=tgl_akhir size="10" style="text-transform:uppercase;" onClick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_akhir);return false;">
      </span></span> </font></td>
    </tr>
  </table>
  <p class="style11">
  <p class="style2">
    <input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">
<div align="center">
  <?php
$oke=$_GET['oke'];
if ($oke=='Cari'){
Include ("koneksi.php");
Include ("inc.librari.php");
mysql_select_db("griya");

//Langkah 1
$batas   = 99999;
$halaman = $_GET['halaman'];
if(empty($halaman)){
  $posisi  = 0;
  $halaman = 1;
}
else{
  $posisi=($halaman-1)* $batas;}

$warna1 = "#DBDBA6";   // baris genap berwarna tua
$warna2 = "#F2F2DF";   // baris ganjil berwarna muda
$warna  = $warna1;     // warna default

//Langkah 2
$cari=$_GET['cari'];
$pilih=$_GET['pilih'];
$lnc=$_GET['lnc'];
$no_aplikasi=$_GET['no_aplikasi'];
$produk=$_GET['produk'];
$nama=$_GET['nama'];
$plafond=$_GET['plafond'];
$developer=$_GET['developer']; 
$perumahan=$_GET['perumahan'];
$skim=$_GET['skim'];
$tahap_1=$_GET['tahap_1'];
$tgl_tahap_1=$_GET['tgl_tahap_1'];
$tahap_2=$_GET['tahap_2'];
$tgl_tahap_2=$_GET['tgl_tahap_2'];
$tahap_3=$_GET['tahap_3'];
$tgl_tahap_3=$_GET['tgl_tahap_3'];


if($pilih == "progress")
{
$a = "DAFTAR DEBITUR PER TANGGAL INPUT";
}
elseif($pilih == "no_polis_ass_jiwa")
{
$a = "MONITORING ASURANSI JIWA";
}
elseif($pilih == "no_polis_ass_kerugian")
{
$a = "MONITORING ASURANSI KERUGIAN";
}
elseif($pilih == "no_ajb")
{
$a = "MONITORING PENYELESAIAN AKTA JUAL BELI";
}

$tampil=mysql_query("SELECT * FROM data WHERE data.tgl_input between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'
                    ORDER BY data.tgl_input ASC");
$jumlah= mysql_num_rows($tampil);

//ngitung jumlah 
$max    = "SELECT SUM(max_kredit) AS total_max FROM data WHERE data.tgl_input between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ";
$result = mysql_query($max) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx    = $t['total_max'];

$cair1  = "SELECT SUM(cair_1) AS total_max FROM data WHERE data.tgl_input between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'";
$result = mysql_query($cair1) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx1   = $t['total_max'];

$cair2  = "SELECT SUM(cair_2) AS total_max FROM data WHERE data.tgl_input between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'";
$result = mysql_query($cair2) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx2   = $t['total_max'];

$cair3  = "SELECT SUM(cair_3) AS total_max FROM data WHERE data.tgl_input between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'";
$result = mysql_query($cair3) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx3   = $t['total_max'];

$cair4  = "SELECT SUM(cair_4) AS total_max FROM data WHERE data.tgl_input between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]'";
$result = mysql_query($cair4) or die 
         (mysql_error());
  $t    = mysql_fetch_array($result);
$xxx4   = $t['total_max'];

$xy 	= ($xxx - $xxx1- $xxx2 - $xxx3 - $xxx4);
$xxxy   = number_format($xy,0,',','.');



if ($jumlah > 0) {

echo "<p class=style11><b>$a</b></p><table cellpadding=4>
<tr>
<th>NO.</th>
<th width=20>TGL. INPUT</th>
<th width=20>NAMA LNC</th>
<th>PRODUK</th>
<th>NO.REKG. PINJAMAN</th>
<th>NAMA DEBITUR</th>
<th widht=30>MAX KREDIT</th>
<th>TGL. PK</th>
<th>PENJUAL</th>
<th>PERUMAHAN</th>
<th>ESCROW</th>
<th width=65>STATUS</th>
</tr>";

$no=$posisi+1;
While ($r=mysql_fetch_array($tampil)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}

$a1 = ($r[max_kredit] - $r[cair_1] - $r[cair_2] - $r[cair_3] - $r[cair_4]);
$a1	= number_format($a1,0,',','.');

$r[max_kredit]	= number_format($r[max_kredit],0,',','.');
$r[cair_1]		= number_format($r[cair_1],0,',','.');
$r[cair_2]		= number_format($r[cair_2],0,',','.');
$r[cair_3]		= number_format($r[cair_3],0,',','.');
$r[cair_4]		= number_format($r[cair_4],0,',','.');




if ($r[progress]=='SELESAI'){	
Echo "
<tr bgcolor=$warna>
<td><b>$no</td>
<td align='center'><b>$r[tgl_input]</td>
<td align='center'><b>$r[lnc]</td>
<td td align='center'><b>$r[produk]</td>
<td align='center'><b>$r[rekg_pinjaman]</td>
<td align='left'><b>$r[nama_debitur]</td>
<td align='right'><b>$r[max_kredit]</td>
<td align='center'><b>$r[tgl_pk]</td>
<td align='center'><b>$r[developer]</td>
<td align='center'><b>$r[perumahan]</td>
<td align='center'><b>$r[escrow]</td>
<td align='center'><b>$r[progress]</td>

</tr>";
      $no++;
}
else {
Echo "

<tr bgcolor=$warna>
<td>$no</td>
<td align='center'><b>$r[tgl_input]</td>
<td align='center'><b>$r[lnc]</td>
<td align='center'><b>$r[produk]</td>
<td align='center'><b>$r[rekg_pinjaman]</td>
<td><b>$r[nama_debitur]</td>
<td align='right'><b>$r[max_kredit]</td>
<td align='center'><b>$r[tgl_pk]</td>
<td align='center'><b>$r[developer]</td>
<td align='center'><b>$r[perumahan]</td>
<td align='center'><b>$r[escrow]</td>
<td align='center'><b>IN PROGRESS</td>

</tr>";
      $no++;
}
}
echo "</table>";


//Langkah 3 : Hitung total data
$tampil2    = mysql_query("SELECT * FROM data WHERE data.tgl_input between '$_GET[tgl_awal]' AND '$_GET[tgl_akhir]' ");
$jmldata    = mysql_num_rows($tampil2);
$jmldata	= number_format($jmldata,0,',','.');

echo "<b><p class=style11>TOTAL DATA INPUT PERIODE $_GET[tgl_awal] S/D $_GET[tgl_akhir]: <br>$jmldata</font> DEBITUR</p></b></font> ";
}
else{
echo "<b><p class=style11>Maaf, data <b>$a dari $pilih</b> yang anda cari tidak ada pada database !!!</b>";

}
}
?>
</div>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>