<html>

<head>
<meta http-equiv="Content-Language" content="id">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>FORM INPUT DD</title>

<style type="text/css">
<!--
.style2 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body>

<form name="biodata" Method="post" Action="insertdd.php">

<p align="left" style="margin-top: 0; margin-bottom: 0"><b>
<font face="Verdana" size="1"><a href="summary_bso.php">MENU UTAMA</a>&nbsp;&nbsp;&nbsp;
<a href="bso_menu.htm">BSO MENU</a><a href="cari_debitur.php"> </a></font></b></p>

<p align="left" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>

<p align="center" style="margin-top: 0; margin-bottom: 0"><b><font face="Verdana" size="5">
FORM INPUT REVIEW DUE DILIGENT VENDOR </font></b></p>
<p align="left" style="margin-top: 0; margin-bottom: 0"><b>
<font face="Arial Black">&nbsp;</font></b></p>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0" bordercolor="#111111" width="100%" height="240">
  <tr>
    <td width="32%" style="border-style: none; border-width: medium" height="33">
    <font face="Arial" size="2">Nama LNC</font></td>
    <td width="68%" style="border-style: none; border-width: medium" height="33">
    <font face="Arial">
    <span class="style2">
    <select size="1" name="LNC">
      <option>PLL</option>
    </select>
    </span></font></td>
  </tr>
  <tr>
    <td style="border-style: none; border-width: medium" height="28"> <font size="2" face="Arial">Agency Status </font></td>
    <td style="border-style: none; border-width: medium" height="28"> <font face="Arial">
      <select size="1" name="bulan">
        <option>= SELECT =</option>
        <option>NEW</option>
        <option>EXISTING</option>
      </select>
</font></td>
  </tr>
  <tr>
    <td width="32%" style="border-style: none; border-width: medium" height="27">
    <font face="Arial" size="2">Jumlah Pending BPKB </font></td>
    <td width="68%" style="border-style: none; border-width: medium" height="27">
    <font face="Arial">    
    <input type="text" name="bpkb" size="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')">
    </font></td>
  </tr>
  <tr>
    <td width="32%" style="border-style: none; border-width: medium" height="28">
      <font face="Arial" size="2">Jumlah Pending AJB </font></td>
    <td width="68%" style="border-style: none; border-width: medium" height="28">
    <font face="Arial">    
    <input type="text" name="ajb" size="10" onKeyUp="this.value=this.value.replace(/[^0-9]/g,'')">
    </font></td>
  </tr>
  <tr>
    <td style="border-style: none; border-width: medium" height="35"> <font face="Arial" size="2">Jumlah Pending SHT </font></td>
    <td style="border-style: none; border-width: medium" height="35"> <font face="Arial">
      <input type="text" name="sht" size="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')">
    </font></td>
  </tr>
  <tr>
    <td style="border-style: none; border-width: medium" height="35"> <font face="Arial" size="2">Jumlah Pending Asuransi Jiwa </font></td>
    <td style="border-style: none; border-width: medium" height="35"> <font face="Arial">
      <input type="text" name="ass_jw" size="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')">
    </font></td>
  </tr>
  <tr>
    <td width="32%" style="border-style: none; border-width: medium" height="35">
    <font face="Arial" size="2">Jumlah Pending Asuransi Kerugian </font></td>
    <td width="68%" style="border-style: none; border-width: medium" height="35">
    <font face="Arial">
    <input type="text" name="ass_kerugian" size="10" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')">
</font></td>
  </tr>
  <tr>
    <td width="32%" style="border-style: none; border-width: medium" height="17"></td>
    <td width="68%" style="border-style: none; border-width: medium" height="17"></td>
  </tr>
</table>

<p align="center">
  <input type="submit" value="Submit"><input type="reset" value="Reset"></p>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

</body>

</html>