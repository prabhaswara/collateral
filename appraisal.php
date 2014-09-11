<TITLE> FORM APPRAISAL </TITLE>
<b><font face="Verdana" size="2"><a href="summary_app.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="menu_appraisal.htm">MENU APPRAISAL</a></font></b>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
body,td,th {
	font-size: 14px;
}
-->
</style>
<p>  <style type="text/css">
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
  
<html>
<head>
<meta http-equiv="Content-Language" content="id">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!--



function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
var key, keychar;
key = getkey(e);
if (key == null) return true;
 
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();
goods = goods.toLowerCase();
 
// check goodkeys
if (goods.indexOf(keychar) != -1)
    return true;
// control keys
if ( key==null || key==0 || key==8 || key==9 || key==27 )
   return true;
    
if (key == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
// else return false
return false;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>

<style type="text/css">
<!--
.style4 {color: #FFFFFF}
.style5 {color: #000000}
-->
</style>
</head>
<body>
<form method=get action=appraisal.php>
  <p class="style2"><b></b></p>
  <p class="style2">
    <input type=text name=cari size=50 VALUE="Ketik data yang dicari ..."
	  onFocus="if(this.value=='Ketik data yang dicari ...')
	  {this.value=''}" onBlur="if(this.value==''){this.value='Ketik data yang dicari ...'}" /> 
  </p>
  <p class="style2"> Kategori :  
  <p class="style2">
    <INPUT type=radio name=pilih value=NAMADEBITUR checked>
    Nama Debitur <BR>
    <INPUT type=radio name=pilih value=NOAPLIKASI>
    No. Aplikasi <br>
	<INPUT type=radio name=pilih value=no_rekg_pinjaman>
    No. Rekg. Pinjaman <br>
    <INPUT type=radio name=pilih value=no_surat_tanah>
    No. Sertifikat <br>
    <INPUT type=radio name=pilih value=alamat_collateral>
    Alamat Jaminan <BR>
    <INPUT type=radio name=pilih value=developer>
    Nama Developer
  <p class="style2"><input type=submit name=oke value=Cari>
  </p>
</form>
    
<div align="center">
  <?php
$oke=$_GET['oke'];
if ($oke=='Cari'){
Include ("koneksi.php");
mysql_select_db("collateral");

//Langkah 1
$batas   = 5;
$halaman = $_GET['halaman'];
if(empty($halaman)){
  $posisi  = 0;
  $halaman = 1;
}
else{
  $posisi=($halaman-1)* $batas;}

$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda
$warna  = $warna1;     // warna default


$tampil2    = "SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.produk <> 'FLEKSI' AND debitur.produk <> 'BNI Fleksi' AND debitur.produk <> '3610 0101 - BNI FLEKSI IND FLAT IDR' LIMIT $posisi, $batas";
$hasil2     = mysql_query($tampil2);
$jmldata    = mysql_num_rows($hasil2);
$jmlhalaman = ceil($jmldata/$batas);

if ($jumlah > 0) {
echo "<p align='left'>Maaf, data yang anda cari tidak ada pada database !!!";
}
else{
echo "<p align='left'>Ditemukan <b>$jmldata</b> data debitur dengan kriteria cari : <b>$cari</b></p>";
}
//Langkah 2
$nama  =$_GET['NAMADEBITUR'];
$apl   =$_GET['NOAPLIKASI'];
$pilih =$_GET['pilih'];
$cari  =$_GET['cari'];



$tampil= mysql_query("SELECT * FROM debitur WHERE $pilih LIKE '%$cari%' AND debitur.produk <> 'BNI Fleksi' AND debitur.produk <> 'FLEKSI' AND debitur.produk <> '3610 0101 - BNI FLEKSI IND FLAT IDR' ORDER BY debitur.tgl_taksasi DESC LIMIT $posisi,$batas");
$jumlah= mysql_num_rows($tampil);


if ($jumlah > 0) {

echo "<b>DAFTAR DEBITUR</b><BR><br><table cellpadding=4>
<tr>
<th>NO.</th>
<th>NAMA DEBITUR</th>
<th>ALAMAT JAMINAN</th>
<th>NO. SERTIFIKAT</th>
<th>LT</th>
<th>TAKSASI TANAH/M</th>
<th>TOTAL TAKSASI TANAH</th>
<th>LB</th>
<th>TAKSASI BANGUNAN/M</th>
<th>TOTAL TAKSASI BANGUNAN</th>
<th>TOTAL TAKSASI</th>
<th>PETUGAS</th>
<th>TGL. TAKSASI</th>
<th>ACTION</th></th>
</tr>";

$no=$posisi+1;
While ($r=mysql_fetch_array($tampil)){
if($warna == $warna1){
   $warna = $warna2;
}
else{
  $warna = $warna1;
}

$abc = @($r['harga_tanah']/$r['luas_tanah']);
$x1 = number_format($abc,0,',','.');
$bcd = @($r['harga_bangunan']/$r['luas_bangunan']);

$x2 = number_format($bcd,0,',','.');
$rrr1=number_format($r['harga_tanah'],0,',','.');
$rrr2=number_format($r['harga_bangunan'],0,',','.');
$rrr = $r['harga_tanah'] + $r['harga_bangunan'];
$ra= number_format($rrr,0,',','.');

echo "
<tr bgcolor=$warna>
<td>$no</td>
<td>$r[NAMADEBITUR]</td>
<td align='left'>$r[alamat_collateral]</td>
<td align='left'>$r[no_surat_tanah]</td>
<td align='right'>$r[luas_tanah]</td>
<td align='right'>$x1</td>
<td align='right'>$rrr1</td>
<td align='right'>$r[luas_bangunan]</td>
<td align='right'>$x2</td>
<td align='right'>$rrr2</td>
<td align='right'>$ra</td>
<td align='center'>$r[penilai]</td>
<td align='center'>$r[tgl_taksasi]</td>
<td align='center'><a href=edit_data_appraisal.php?id=$r[NOAPLIKASI]>Edit
</td>
</tr>";
      $no++;
}
echo "</table>";

}
}
?>

<form id ="postform" name="biodata" Method="post" Action="insert_app.php">

<script language="javascript" src="ri32-fungsi.js"></script>

<p align="left" style="margin-top: 0; margin-bottom: 0"><b>
<font face="Verdana" size="2">&nbsp;&nbsp;</font><font face="Verdana" size="1"></font></b></p>

<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>

<p align="center" style="margin-top: 0; margin-bottom: 0"><b>
<font face="Verdana" size="4">
<span style="font-family:Verdana,sans-serif;text-decoration: blink; color:#000000"> FORM INPUT DATA </span></font><span class="style5"><font size="4"><span style="font-family:Verdana,sans-serif;text-decoration: blink">APPRAISAL</span></font></span></b></p>
<p align="center" style="margin-top: 0; margin-bottom: 0"><b>
<font face="Arial Black">&nbsp;</font></b></p>
<div align="center">
  <table border="1" cellpadding="0" cellspacing="0" style="border-width:0; border-collapse: collapse; " bordercolor="#111111" width="902" height="90">
    <tr>
      <td colspan="5" height="20" style="height: 15.0pt; width: 902; font-size: 9.0pt; font-weight: 700; font-family: Arial, sans-serif; text-align: center; white-space: normal; color: white; font-style: normal; text-decoration: none; vertical-align: bottom; border: medium none; padding: 0px; background: #00CC00">
      <font size="2">INFORMASI DEBITUR</font></td>
    </tr>
  
  <tr>
      <td width="195" style="border-style:none; border-width:medium; " height="22">
      <font face="Arial" style="font-size: 9pt">Nama LNC</font></td>
      <td width="230" style="border-style: none; border-width: medium" height="22">
      <font face="Arial" style="font-size: 9pt">
      <select size="1" name="LNC" id="LNC" style="font-size: 8pt ; " >
            <option>BAL</option>
        </select></font></td>
      <td width="13" style="border-style: none; border-width: medium" height="22">&nbsp;</td>
      <td width="276" style="border-style: none; border-width: medium" height="22">
      <font face="Arial" style="font-size: 9pt">No. Aplikasi </font></td>
      <td width="255" style="border-style:none; border-width:medium; " height="22">
      <font face="Arial" style="font-size: 9pt">
    <input name=NOAPLIKASI id="NOAPLIKASI" size="40" style="font-size: 8pt; text-transform:uppercase ; "></font></td>
    </tr>
    <tr>
      <td width="195" style="border-style: none; border-width: medium" height="27">
      <font face="Arial" style="font-size: 9pt">Nama Debitur</font></td>
      <td width="230" style="border-style: none; border-width: medium" height="27">
      <font face="Arial" style="font-size: 9pt">    
      <input type="text" name="NAMADEBITUR" id="NAMADEBITUR" size="40" style="font-size: 8pt; text-transform:uppercase; "></font></td>
      <td width="13" style="border-style: none; border-width: medium" height="27">&nbsp;</td>
      <td width="276" style="border-style: none; border-width: medium" height="27"><font face="Arial" style="font-size: 9pt">Kode Cabang</font> </td>
      <td width="255" style="border-style: none; border-width: medium" height="27"><font face="Arial" style="font-size: 9pt">
        <input type="text" name="cabang"  onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')" size="5" style="font-size: 8pt; text-transform:uppercase ">
      </font></td>
    </tr>
	<tr>
      <td width="195" style="border-style: none; border-width: medium" height="19">&nbsp;</td>
      <td width="230" style="border-style: none; border-width: medium" height="19">&nbsp;</td>
      <td width="13" style="border-style:none; border-width:medium; " height="19"></td>
      <td width="276" style="border-style:none; border-width:medium; " height="19"></td>
      <td width="255" style="border-style:none; border-width:medium; " height="19"></td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 901" bgcolor="#FF3300">
    <colgroup>
      <col width="64" span="5" style="width:48pt">
    </colgroup>
    <tr height="20" style="height:15.0pt">
      <td colspan="5" height="20" style="height: 15.0pt; width: 901; color: white; font-size: 9.0pt; font-weight: 700; font-family: Arial, sans-serif; text-align: center; white-space: normal; font-style: normal; text-decoration: none; vertical-align: bottom; border: medium none; padding: 0px; background: #00CC00 ">
      <font size="2">INFORMASI PINJAMAN</font></td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0" bordercolor="#111111" width="902" height="7">
    <tr>
      <td width="165" style="border-style: none; border-width: medium" height="17">
      <font face="Arial" style="font-size: 9pt">Nama Produk</font></td>
      <td width="229" style="border-style: none; border-width: medium" height="17">
      <font face="Arial" size="1"><span style="font-size: 9pt">
      <select size="1" name="produk" style="position: relative;font-size: 8pt">
        <option>= SELECT =</option>
        <option>1970 0701 - BNI GRIYA MULTIGUNA</option>
        <option>3010 0101 - BNI GRIYA IND FLAT IDR</option>
        <option>3010 0201 - BNI GRIYA IND IDR</option>
        <option>3020 0201 - BNI KPR PLUS IDR</option>
        <option>3030 0201 - BNI GRIYA KEM-INS IDR</option>
        <option>3040 0101 - BNI GRIYA KEM-DE FLAT IDR</option>
        <option>3040 0201 - BNI GRIYA KEM- DEV IDR</option>
        <option>3050 0101 - BNI KPR FLAT AGEN PRO IDR</option>
        <option>3050 0201 - BNI GRIYA KEM-AGEN PR IDR</option>
        <option>3210 0101 - BNI OTO IND FLAT IDR</option>
        <option>3210 0101 - BNI OTO IND FLAT IDR</option>
        <option>3210 0101 - BNI OTO IND FLAT IDR</option>
        <option>3210 0201 - BNI OTO IND IDR</option>
        <option>3210 0201 - BNI OTO IND IDR</option>
        <option>3210 0201 - BNI OTO IND IDR</option>
        <option>3220 0201 - BNI AUTO PLUS IDR</option>
        <option>3230 0001 - BNI AUTO KEM - INS IDR</option>
        <option>3230 0201 - BNI OTO KEM - INS IDR</option>
        <option>3230 0201 - BNI OTO KEM - INS IDR</option>
        <option>3230 0201 - BNI OTO KEM - INS IDR</option>
        <option>3250 0201 - BNI OTO KEM - DEALER IDR</option>
        <option>3250 0201 - BNI OTO KEM - DEALER IDR</option>
        <option>3250 0201 - BNI OTO KEM - DEALER IDR</option>
        <option>3260 0201 - BNI OTO ANNIVERSARY IDR</option>
        <option>3260 0201 - BNI OTO ANNIVERSARY IDR</option>
        <option>3260 0201 - BNI OTO ANNIVERSARY IDR</option>
        <option>3410 0101 - BNI MULTIGUN IND FLAT IDR</option>
        <option>3410 0201 - BNI MULTIGUNA IND IDR</option>
        <option>3410 0301 - BNI MULTIGUNA IND ECH IDR</option>
        <option>3420 0201 - BNI KMG PLUS IDR</option>
        <option>3430 0201 - BNI MULTIGUNA KEM-INS IDR</option>
        <option>3440 0201 - BNI MULTIGUNA KEM-DEV IDR</option>
        <option>3610 0101 - BNI FLEKSI IND FLAT IDR</option>
        <option>3610 0101 - BNI FLEKSI IND FLAT IDR</option>
        <option>3630 0101 - BNI FLEKSI KEM-INS FLAT</option>
        <option>3940 0401 - BNI UMG IDR</option>
        <option>3940 1401 - BNI PINJAMAN PEGAWAI IDR</option>
        <option>3960 0101 - BNI PRODUKTIF FLAT IDR</option>
        <option>3960 0201 - BNI PRODUKTIF ANUITAS IDR</option>
      </select>
</span></font></td>
      <td width="8" style="border-style: none; border-width: medium" height="17"></td>
  <td width="248" style="border-style: none; border-width: medium" height="17">
  <font style="font-size: 9pt" face="Arial">Maksimum Kredit Dimohon </font></td>
  <td width="242" style="border-style: none; border-width: medium" height="17">
  <font face="Arial" style="font-size: 9pt"> 

   <body onLoad="document.postform.elements['plafond_diminta'].focus();"> 
  <input name="plafond_dimohon" type=text class="style2" onKeyup="ri32();"></font></td>
    </tr>
	<tr>
      <td width="165" style="border-style: none; border-width: medium" height="17"></td>
      <td width="229" style="border-style: none; border-width: medium" height="17">
  <font face="Arial" style="font-size: 9pt">&nbsp;    
  </font></td>
      <td width="8" style="border-style: none; border-width: medium" height="17"></td>
      <td width="248" style="border-style: none; border-width: medium" height="17"></td>
      <td width="242" style="border-style: none; border-width: medium" height="17"></td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 901">
    <colgroup>
      <col width="64" span="5" style="width:48pt">
    </colgroup>
    <tr height="20" style="height:15.0pt">
      <td colspan="5" height="20" style="height: 15.0pt; width: 901; color: white; font-size: 9.0pt; font-weight: 700; font-family: Arial, sans-serif; text-align: center; white-space: normal; font-style: normal; text-decoration: none; vertical-align: bottom; border: medium none; padding: 0px; background: #00CC00">
      <font size="2">INFORMASI COLLATERAL</font></td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0" bordercolor="#111111" width="901" height="364">
    <tr>
  <td width="205" style="border-style: none; border-width: medium" height="24" bgcolor="#FFFFFF">
  <font style="font-size: 9pt" face="Arial">Status Sertifikat </font></td>
  <td width="234" style="border-style: none; border-width: medium" height="24" bgcolor="#FFFFFF">
  <font face="Arial" size="1"><span style="font-size: 9pt">
  <select size="1" name="jaminan" style="position: relative; font-size: 8pt ; layer-background-color:  #0099FF; ">
    <option>= SELECT =</option>
    <option>INDUK</option>
    <option>SATUAN</option>
  </select>
  </span></font></td>
      <td width="13" height="24" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">&nbsp;</td>
  <td width="299" style="border-style: none; border-width: medium" height="24" bgcolor="#FFFFFF">
  <font face="Arial" style="font-size: 9pt">No. Sertifikat Tanah</font></td>
  <td width="259" style="border-style: none; border-width: medium" height="24" bgcolor="#FFFFFF">
  <font face="Arial" style="font-size: 9pt">    
  <input type="text" name="no_surat_tanah" size="40" style="font-size: 8pt; text-transform:uppercase ; ">
  </font></td>
    </tr>
    <tr>
  <td width="205" style="border-style: none; border-width: medium" height="24">
  <font style="font-size: 9pt" face="Arial">Jenis Jaminan </font></td>
  <td width="234" style="border-style: none; border-width: medium" height="24">
  <font face="Arial" size="1"><span style="font-size: 9pt">
  </span></font><font face="Arial" size="1"><span style="font-size: 9pt">
  <select size="1" name="jenis_surat_tanah" style="position: relative; layer-background-color:  #0099FF; font-size: 8pt; text-transform:uppercase">
            <option>= SELECT =</option>
            <option>AJB - AJB</option>
 <option>BPKB - BUKTI KEPEMILIKAN KENDARAAN BERMOTOR</option>
 <option>HGB - HAK GUNA BANGUNAN</option>
 <option>IMB - IZIN MENDIRIKAN BANGUNAN</option>
 <option>OTHER - SERTIFIKAT LAINNYA</option>
 <option>SHGB - SHGB</option>
 <option>SHM - SERTIFIKAT HAK MILIK</option>

		    
      </select>
  </span></font></td>
      <td width="13" height="24" style="border-style: none; border-width: medium">&nbsp;</td>
  <td width="299" style="border-style: none; border-width: medium" height="24"><font face="Arial" style="font-size: 9pt">No. GS/SU </font></td>
  <td width="259" style="border-style: none; border-width: medium" height="24">
  <font face="Arial" style="font-size: 9pt">
  <input type="text" name="jml_jaminan" size="40" style="font-size: 8pt; text-transform:uppercase ;">
</font></td>
    </tr>
    <tr>
      <td width="205" height="21" style="border-style: none; border-width: medium">
      <font face="Arial" style="font-size: 9pt">Alamat Jaminan </font></td>
      <td width="234" height="21" style="border-style: none; border-width: medium">
  <font face="Arial" style="font-size: 9pt">    
  <input type="text" name="alamat_collateral" size="50" style="font-size: 8pt; text-transform:uppercase"></font></td>
      <td width="13" height="21" style="border-style: none; border-width: medium">&nbsp;</td>
      <td width="299" height="21" style="border-style: none; border-width: medium">
      <font face="Arial" style="font-size: 9pt">Kode Pos Jaminan</font></td>
      <td width="259" height="21" style="border-style: none; border-width: medium">
  <font face="Arial" style="font-size: 9pt">    
  <input type="text" name="collateral_zipcode"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" size="10" style="font-size: 8pt; text-transform:uppercase"></font></td>
    </tr>
    <tr>
      <td width="205" height="24" style="border-style: none; border-width: medium">
      <font face="Arial" style="font-size: 9pt">Luas Tanah</font></td>
      <td width="234" height="24" style="border-style: none; border-width: medium">
  <font face="Arial" style="font-size: 9pt">    
  <input type="text" name="luas_tanah"  size="5" style="font-size: 8pt; text-transform:uppercase"> 
      m<sup>2</sup></font></td>
      <td width="13" height="24" style="border-style: none; border-width: medium">&nbsp;</td>
      <td width="299" height="24" style="border-style: none; border-width: medium">
      <font face="Arial" style="font-size: 9pt">Luas Bangunan</font></td>
      <td width="259" height="24" style="border-style: none; border-width: medium">
  <font face="Arial" style="font-size: 9pt">    
  <input type="text" name="luas_bangunan"  size="5" style="font-size: 8pt; text-transform:uppercase"> 
      m<sup>2</sup></font></td>
    </tr>
    <tr>
      <td height="25" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">Nama Pemilik Dokumen </font></td>
      <td height="25" style="border-style: none; border-width: medium"> <font face="Arial" size="1"><span style="font-size: 9pt"> </span></font><font face="Arial" style="font-size: 9pt">
      <input name="appraisal" type="text" id="appraisal" style="font-size: 8pt; text-transform:uppercase" size="40">

      </font></td>
      <td width="13" height="29" style="border-style: none; border-width: medium">&nbsp;</td>
      <td width="299" height="29" style="border-style: none; border-width: medium">
  <font style="font-size: 9pt" face="Arial">Tgl. Sertifikat </font></td>
      <td width="259" height="29" style="border-style: none; border-width: medium">
  <font face="Arial" style="font-size: 9pt">    
  <input type="text" id="nilai_taksasi" name="nilai taksasi" size="10" style="font-size: 8pt; text-transform:uppercase ; " onclick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.nilai_taksasi);return false;">
  </font></td>
    </tr>
    <tr>
      <td height="29" style="border-style: none; border-width: medium"> <font style="font-size: 9pt" face="Arial">Penilai Taksasi </font></td>
      <td height="29" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt"> <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_surat_tanah);return false;" > </a>
            <input type="text" name="penilai" size="40" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
      <td height="29" style="border-style: none; border-width: medium">&nbsp;</td>
      <td height="29" style="border-style: none; border-width: medium"> <font style="font-size: 9pt" face="Arial">Tgl. Jatuh Tempo Surat Tanah</font></td>
      <td height="29" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">        <input type="text" name="tgl_jt_surat_tanah" size="10" style="font-size: 8pt; text-transform:uppercase" onclick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_surat_tanah);return false;">
      </font></td>
    </tr>
    <tr>
      <td width="205" style="border-style: none; border-width: medium" height="25" bgcolor="#FFFFFF">
      <font face="Arial" style="font-size: 9pt">Total Taksasi Tanah</font></td>
      <td width="234" style="border-style: none; border-width: medium" height="25" bgcolor="#FFFFFF">
  <font face="Arial" style="font-size: 9pt">    
      <!--webbot bot="Validation" s-data-type="Number" s-number-separators=".," -->
	  <body onLoad="document.postform.elements['harga_tanah'].focus();"> 
	  <input type="text" name="harga_tanah" onKeyup="ri32();" size="20" style="font-size: 8pt; text-transform:uppercase"></font></td>
      <td width="13" height="25" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="299" height="25" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">
      <font face="Arial" style="font-size: 9pt">Total Taksasi Bangunan</font></td>
      <td width="259" height="25" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">
  <font face="Arial" style="font-size: 9pt">    
  <!--webbot bot="Validation" s-data-type="Number" s-number-separators=".," -->
  <body onLoad="document.postform.elements['harga_bangunan'].focus();"> 
  <input type="text" name="harga_bangunan"  onKeyup="ri32();" size="20" style="font-size: 8pt; text-transform:uppercase"></font></td>
    </tr>
    <tr>
      <td width="205" style="border-style: none; border-width: medium" height="25" bgcolor="#FFFFFF">
      <font face="Arial" style="font-size: 9pt">NJOP Tanah per m²</font></td>
      <td width="234" style="border-style: none; border-width: medium" height="25" bgcolor="#FFFFFF">
  <font face="Arial" style="font-size: 9pt">    
      <!--webbot bot="Validation" s-data-type="Number" s-number-separators=".," -->
	  <body onLoad="document.postform.elements['harga_tanah_imb'].focus();"> 
	  <input type="text" name="harga_tanah_imb"  onKeyup="ri32();" size="20" style="font-size: 8pt; text-transform:uppercase"></font></td>
      <td width="13" height="25" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="299" height="25" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">
      <font face="Arial" style="font-size: 9pt">NJOP Bangunan per m²</font></td>
      <td width="259" height="25" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">
  <font face="Arial" style="font-size: 9pt">    
  <!--webbot bot="Validation" s-data-type="Number" s-number-separators=".," -->
  <body onLoad="document.postform.elements['harga_bangunan_imb'].focus();"> 
  <input type="text" name="harga_bangunan_imb"  onKeyup="ri32();" size="20" style="font-size: 8pt; text-transform:uppercase"></font></td>
    </tr>
    <tr>
      <td height="29" style="border-style: none; border-width: medium"> <font style="font-size: 9pt" face="Arial"> Tgl. Taksasi</font></td>
      <td height="29" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">        <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_surat_tanah);return false;" > </a>
        <input type="text" name="tgl_taksasi" size="10" style="font-size: 8pt; text-transform:uppercase" onclick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_taksasi);return false;">
      </font></td>
  <td width="13" height="32" style="border-style: none; border-width: medium">&nbsp;</td>
      <td height="25" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">Nama Developer/Penjual</font></td>
      <td height="25" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">
        <!--webbot bot="Validation" s-data-type="Number" s-number-separators=".," -->
        <input type="text" name="developer" size="41" style="font-size: 8pt; text-transform:uppercase ; ">
      </font></td>
    </tr>
    <tr>
      <td width="205" height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font style="font-size: 9pt" face="Arial">No. IMB</font></td>
      <td width="234" height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="no_imb" size="20" style="font-size: 8pt; text-transform:uppercase; ">
      </font></td>
      <td width="13" height="27" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="299" height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">Skim PKS Developer</font></td>
      <td width="259" height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font face="Arial" size="1"><span style="font-size: 9pt">
        <select size="1" name="skim_pks" style="position: relative; font-size: 8pt">
          <option>= SELECT =</option>
          <option>READY STOCK</option>
          <option>KAVLING BANGUN</option>
          <option>INDENT</option>
        </select>
      </span></font></td>
    </tr>
    <tr>
      <td height="29" style="border-style: none; border-width: medium"> <font style="font-size: 9pt" face="Arial">Tgl. IMB </font></td>
      <td height="29" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="tgl_imb" size="10" style="font-size: 8pt; text-transform:uppercase" onclick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_imb);return false;">
        <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_surat_tanah);return false;" > </a></font></td>
      <td width="13" height="27" style="border-style: none; border-width: medium" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">Nama Perumahan/Project</font></td>
      <td height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">
        <!--webbot bot="Validation" s-data-type="Number" s-number-separators=".," -->
        <input type="text" name="nama_perumahan" size="41" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
    </tr>
    <tr>
      <td height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">Progress Pembangunan </font></td>
      <td height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"> <font face="Arial" style="font-size: 9pt">
        <!--webbot bot="Validation" s-data-type="Number" s-number-separators=".," -->
        <input type="text" name="progress" size="1" style="font-size: 8pt; text-transform:uppercase">
%        </font></td>
      <td height="17" style="border-style: none; border-width: medium"></td>
      <td height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"><font face="Arial" style="font-size: 9pt"> KJPP</font></td>
      <td height="27" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"><font face="Arial" style="font-size: 9pt">
        <input type="text" name="kjpp" size="41" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
    </tr>
    <tr>
      <td height="23" style="border-style: none; border-width: medium"><font face="Arial" style="font-size: 9pt">Status Aplikasi</font></td>
      <td height="23" style="border-style: none; border-width: medium"><font face="Arial" size="1"><span style="font-size: 9pt">
        <select size="1" name="status" style="position: relative; font-size: 8pt">
          <option>= SELECT =</option>
          <option>PROSES</option>
          <option>CANCEL</option>
          <option>REJECT</option>
        </select>
      </span></font></td>
      <td height="23" style="border-style: none; border-width: medium"></td>
      <td height="23" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"><font face="Arial" style="font-size: 9pt">Skim Pencairan</font></td>
      <td height="23" bgcolor="#FFFFFF" style="border-style: none; border-width: medium"><font face="Arial" size="1"><span style="font-size: 9pt">
        <select size="1" name="skim_pencairan" style="position: relative; font-size: 8pt">
          <option>= SELECT =</option>
          <option>BERTAHAP</option>
          <option>SEKALIGUS</option>
        </select>
      </span></font></td>
    </tr>
    <tr>
      <td height="23" style="border-style: none; border-width: medium">&nbsp;</td>
      <td height="23" style="border-style: none; border-width: medium">&nbsp;</td>
      <td height="23" style="border-style: none; border-width: medium"></td>
      <td height="23" bgcolor="#FFFFFF" style="border-style: none; border-width: medium">&nbsp;</td>
      <td height="23" bgcolor="#FFFFFF" style="border-style: none; border-width: medium">&nbsp;</td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 900">
    <colgroup>
    <col width="64" span="5" style="width:48pt">
    </colgroup>
    <tr height="20" style="height:15.0pt">
      <td colspan="5" height="20" style="height: 15.0pt; width: 900; color: white; font-size: 9.0pt; font-weight: 700; font-family: Arial, sans-serif; text-align: center; white-space: normal; font-style: normal; text-decoration: none; vertical-align: bottom; border: medium none; padding: 0px; background: #00CC00"> <font size="2">INFORMASI OTO COLLATERAL</font></td>
    </tr>
  </table>
  <table width="900" height="118" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="171" style="border-style: none; border-width: medium" height="21"> <font face="Arial" style="font-size: 9pt">Jenis Kendaraan</font></td>
      <td width="225" style="border-style: none; border-width: medium" height="21"> <font face="Arial" size="1"><span style="font-size: 9pt">
        <select size="1" name="jenis_kendaraan" style="position: relative; font-size: 8pt; text-transform:uppercase">
          <option>= SELECT =</option>
          <option>KENDARAAN RODA 2</option>
          <option>KENDARAAN RODA 4</option>
        </select>
      </span></font></td>
      <td width="11" style="border-style: none; border-width: medium" height="21">&nbsp;</td>
      <td width="241" style="border-style: none; border-width: medium" height="21"> <font face="Arial" style="font-size: 9pt">Merk</font></td>
      <td width="247" style="border-style: none; border-width: medium" height="21"> <font face="Arial" size="1"><span style="font-size: 9pt">
        <select size="1" name="merk" style="position: relative; font-size: 8pt; text-transform:uppercase">
          <option>= SELECT =</option>
          <option>AUDI</option>
          <option>DAIHATSU</option>
          <option>HONDA</option>
          <option>HYUNDAI</option>
          <option>KIA</option>
          <option>YAMAHA</option>
          <option>SUZUKI</option>
          <option>KAWASAKI</option>
          <option>TOYOTA</option>
        </select>
      </span></font></td>
    </tr>
    <tr>
      <td width="170" style="border-style: none; border-width: medium" height="21"> <font face="Arial" style="font-size: 9pt">No. BPKB</font></td>
      <td width="225" style="border-style: none; border-width: medium" height="21"> <font face="Arial" size="1"><span style="font-size: 9pt">
        <select size="1" name="no_bpkb" style="position: relative; font-size: 8pt; ">
          <option>= SELECT =</option>
          <option>PENDING</option>
          <option>ADA</option>
        </select>
      </span></font></td>
      <td width="11" style="border-style: none; border-width: medium" height="21">&nbsp;</td>
      <td width="241" style="border-style: none; border-width: medium" height="21"> <font face="Arial" style="font-size: 9pt">No. Mesin</font></td>
      <td width="247" style="border-style: none; border-width: medium" height="21"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="no_mesin" size="20" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
    </tr>
    <tr>
      <td width="170" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">No. Rangka</font></td>
      <td width="225" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="no_rangka" size="20" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
      <td width="11" style="border-style: none; border-width: medium" height="25">&nbsp;</td>
      <td width="241" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">No. Polisi</font></td>
      <td width="247" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="no_polisi" size="20" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
    </tr>
    <tr>
      <td width="170" style="border-style: none; border-width: medium" height="24"> <font face="Arial" style="font-size: 9pt">Nama Dealer</font></td>
      <td width="225" style="border-style: none; border-width: medium" height="24"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="nama_dealer" size="20" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
      <td width="11" style="border-style: none; border-width: medium" height="24">&nbsp;</td>
      <td width="241" style="border-style: none; border-width: medium" height="24">&nbsp;</td>
      <td width="247" style="border-style: none; border-width: medium" height="24">&nbsp;</td>
    </tr>
    <tr>
      <td width="170" style="border-style: none; border-width: medium" height="17"></td>
      <td width="225" style="border-style: none; border-width: medium" height="17"></td>
      <td width="11" style="border-style: none; border-width: medium" height="17"></td>
      <td width="241" style="border-style: none; border-width: medium" height="17"></td>
      <td width="247" style="border-style: none; border-width: medium" height="17"></td>
    </tr>
  </table>
 
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 900">
    <colgroup>
    <col width="64" span="5" style="width:48pt">
    </colgroup>
    <tr height="20" style="height:15.0pt">
      <td colspan="5" height="20" style="height: 15.0pt; width: 900; color: white; font-size: 9.0pt; font-weight: 700; font-family: Arial, sans-serif; text-align: center; white-space: normal; font-style: normal; text-decoration: none; vertical-align: bottom; border: medium none; padding: 0px; background: #00CC00"> <font size="2">INFORMASI LAINNYA</font></td>
    </tr>
  </table>
  <table width="900" height="44" border="1" cellpadding="0" cellspacing="0" bordercolor="#111111" style="border-collapse: collapse; border-width: 0">
    <tr>
      <td width="171" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">Nama Sales</font></td>
      <td width="225" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="sales" size="20" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
      <td width="11" style="border-style: none; border-width: medium" height="25">&nbsp;</td>
      <td width="241" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">No. Telp. Sales </font></td>
      <td width="247" style="border-style: none; border-width: medium" height="25"> <font face="Arial" style="font-size: 9pt">
        <input type="text" name="hp_sales" size="20" style="font-size: 8pt; text-transform:uppercase">
      </font></td>
    </tr>
    <tr>
      <td width="171" style="border-style: none; border-width: medium" height="17"></td>
      <td width="225" style="border-style: none; border-width: medium" height="17"></td>
      <td width="11" style="border-style: none; border-width: medium" height="17"></td>
      <td width="241" style="border-style: none; border-width: medium" height="17"></td>
      <td width="247" style="border-style: none; border-width: medium" height="17"></td>
    </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 900">
    <colgroup>
    <col width="64" span="5" style="width:48pt">
    </colgroup>
    <tr height="20" style="height:15.0pt">
      <td colspan="5" height="20" style="height: 15.0pt; width: 900; color: white; font-size: 9.0pt; font-weight: 700; font-family: Arial, sans-serif; text-align: center; white-space: normal; font-style: normal; text-decoration: none; vertical-align: bottom; border: medium none; padding: 0px; background: #00CC00"> <font size="2">MEMO APPRAISAL </font></td>
    </tr>
  </table>
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0" bordercolor="#111111" width="901" height="228">
    <tr>
      <td width="108" height="222" style="border-style: none; border-width: medium">&nbsp;      </td>
      <td style="border-style: none; border-width: medium" height="222" width="773">
      <font face="Arial">
      <textarea rows="10" name="memo_appraisal" cols="85" style="font-family: Arial"></textarea></font></td>
    </tr>
  
  <tr>
      <td style="border-style: none; border-width: medium" height="1">
      </td>
      <td width="773" style="border-style: none; border-width: medium" height="1">
      </td>
      
  </tr>
  
  <tr>
      <td style="border-style: none; border-width: medium" height="1">
      </td>
      <td width="773" style="border-style: none; border-width: medium" height="1">
      </td>
      <td width="2" style="border-style: none; border-width: medium" height="1">
      </td>
      <td width="2" style="border-style: none; border-width: medium" height="1">
      </td>
      <td width="4" style="border-style: none; border-width: medium" height="1">
      </td>
    </tr>
  </table>
</div>
<p align="center">
  <input type="submit" value="Submit"><input type="reset" value="Reset"></p>
</div>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<div align="center">
  <iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
  </iframe>
  
</div>
</body>
</html>