<html>

<body>
<marquee direction="left" behavior="alternate" scrolldelay="30" scrollamount="2"> </marquee>
<script language="javascript" src="ri32-fungsi.js"></script>


<?php
echo ("<br><br><a href=summary.php><b>MENU UTAMA</a>&nbsp&nbsp&nbsp<a href=laporan.htm>OUTPUT</a></b><br><br>");

Include ("koneksi.php");
mysql_select_db("griya");

$edit=mysql_query("SELECT * FROM data WHERE rekg_pinjaman='$id'");
$r=mysql_fetch_array($edit);

$a1 = ($r[max_kredit] - $r[cair_1] - $r[cair_2] - $r[cair_3] - $r[cair_4]);
$a1 = number_format($a1,0,',','.');

$r[max_kredit]	= number_format($r[max_kredit],0,',','.');
$r[cair_1]		= number_format($r[cair_1],0,',','.');
$r[cair_2]		= number_format($r[cair_2],0,',','.');
$r[cair_3]		= number_format($r[cair_3],0,',','.');
$r[cair_4]		= number_format($r[cair_4],0,',','.');



$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda

echo "<h2 ALIGN='CENTER'>EDIT DATA DEBITUR</h2>
<form id=postform name=biodata method=POST action=update_data_debitur.php>
<input type=hidden name=id value='$r[rekg_pinjaman]'>

<th><b>INFORMASI DEBITUR</b></th><BR><BR>
<table>
<tr>
<tr><td>NAMA LNC</td><td> : <input type=text name=lnc size=3 value='$r[lnc]'></tr> 

<tr><td>PRODUK</td><td> :
<input type=text name=produk size=30 value='$r[produk]'></td></tr>

<tr><td>JENIS</td>
<td> : <input type=text name=jenis size=50 value='$r[jenis]'></td></tr>

<tr><td>NO. APLIKASI</td>
<td> : <input type=text name=no_aplikasi size=50 value='$r[no_aplikasi]'></td></tr>

<tr><td>NO. REKENING PINJAMAN</td>
<td> : <input type=text name=rekg_pinjaman size=50 value='$r[rekg_pinjaman]' onkeyup='this.value=this.value.replace(/[^0-9]/g,'')'></td></tr>

<tr><td>NAMA DEBITUR</td>
<td> : <input type=text name=nama_debitur size=50 value='$r[nama_debitur]'></td></tr>

<tr><td>MAX KREDIT</td>
<body onLoad='document.postform.elements['max_kredit'].focus();'>
<td> : Rp. <input type=text name=max_kredit onKeyup='ri32();' size=15 value='$r[max_kredit]'></td></tr>

<tr><td>OUTSTANDING</td>
<body onLoad='document.postform.elements['outstanding'].focus();'>
<td> : Rp. <input type=text name=outstanding onKeyup='ri32();' size=15 value='$r[outstanding]'></td></tr>

<tr><td>NILAI JAMINAN</td>
<body onLoad='document.postform.elements['jaminan'].focus();'>
<td> : Rp. <input type=text name=jaminan onKeyup='ri32();' size=15 value='$r[jaminan]'></td></tr>

<tr><td>NILAI BANGUNAN</td>
<body onLoad='document.postform.elements['bangunan'].focus();'>
<td> : Rp. <input type=text name=bangunan onKeyup='ri32();' size=15 value='$r[bangunan]'></td></tr>

<tr><td>TENOR</td>
<td> : <input type=text name=tenor size=4 value='$r[tenor]'>   BULAN</td></tr>

<tr><td>TGL. PERJANJIAN KREDIT</td><td> :
<input type=text name=tgl_pk size=10 value='$r[tgl_pk]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_pk);return false;'></td></tr>

<tr><td>NAMA DEVELOPER/PENJUAL</td><td> :
<input type=text name=developer size=50 value='$r[developer]'>&nbsp<input type=text name=badan size=13 value='$r[badan]'> </td></tr>

<tr><td>NAMA PROYEK</td><td> :
<input type=text name=perumahan size=50 value='$r[perumahan]'></td></tr> 

<tr><td>JENIS PROYEK</td><td> :
<input type=text name=proyek size=50 value='$r[proyek]'></td></tr>

<tr><td>KATEGORI PROYEK</td><td> :
<input type=text name=kategori size=50 value='$r[kategori]'></td></tr>

<tr><td>SKIM PKS</td><td> :
<input type=text name=skim size=50 value='$r[skim]'></td></tr>

<tr><td>NO. PKS</td><td> :
<input type=text name=pks size=50 value='$r[pks]'></td></tr>

<tr><td>TOTAL UNIT DIBANGUN</td><td> :
<input type=text name=unit size=4 value='$r[unit]'></td></tr>

<tr><td>MEDIA TRANSAKSI</td><td> :
<input type=text name=transaksi size=4 value='$r[transaksi]'></td></tr>

<tr><td>PENGIKATAN</td><td> :
<input type=text name=pengikatan size=4 value='$r[pengikatan]'></td></tr>

<tr><td>PENGUASAAN SERTIFIKAT INDUK</td><td> :
<input type=text name=induk size=4 value='$r[induk]'></td></tr>

<tr><td>NO. REKENING ESCROW</td><td> :
<input type=text name=escrow size=50 value='$r[escrow]'></td></tr>

<tr><td>CAIR TAHAP PONDASI</td><td> :
<body onLoad='document.postform.elements['cair_1'].focus();'>
Rp. <input type=text name=cair_1 onKeyup='ri32();' size=15 value='$r[cair_1]'>&nbsp<input type=text name=keterangan1 size=50 value='$r[keterangan1]'></td></tr>

<tr><td>TGL. CAIR TAHAP PONDASI</td><td> :
<input type=text name=tgl_cair_1 size=10 value='$r[tgl_cair_1]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_cair_1);return false;'></td></tr>

<tr><td>CAIR TAHAP TOPPING OFF</td><td> :
<body onLoad='document.postform.elements['cair_2'].focus();'>
Rp. <input type=text name=cair_2 onKeyup='ri32();' size=15 value='$r[cair_2]'>&nbsp<input type=text name=keterangan2 size=50 value='$r[keterangan2]'></td></tr>

<tr><td>TGL. CAIR TAHAP TOPPING OFF</td><td> :
<input type=text name=tgl_cair_2 size=10 value='$r[tgl_cair_2]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_cair_2);return false;'></td></tr>

<tr><td>CAIR TAHAP BAST</td><td> :
<body onLoad='document.postform.elements['cair_3'].focus();'>
Rp. <input type=text name=cair_3 onKeyup='ri32();' size=15 value='$r[cair_3]'>&nbsp<input type=text name=keterangan3 size=50 value='$r[keterangan3]'></td></tr>

<tr><td>TGL. CAIR TAHAP BAST</td><td> :
<input type=text name=tgl_cair_3 size=10 value='$r[tgl_cair_3]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_cair_3);return false;'></td></tr>

<tr><td>CAIR TAHAP DOKUMEN</td><td> :
<body onLoad='document.postform.elements['cair_4'].focus();'>
Rp. <input type=text name=cair_4 onKeyup='ri32();' size=15 value='$r[cair_4]'>&nbsp<input type=text name=keterangan4 size=50 value='$r[keterangan4]'></td></tr>

<tr><td>TGL. CAIR TAHAP DOKUMEN</td><td> :
<input type=text name=tgl_cair_4 size=10 value='$r[tgl_cair_4]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_cair_4);return false;'></td></tr>

<tr><td>SISA SALDO</td><td> :
Rp. <b><input type=text name=keterangan size=15 value='$a1' readonly></td></tr>

<tr><td>KETERANGAN</td><td> :
<input type=text name=keterangan size=76 value='$r[keterangan]'></td></tr>

<tr><td>PROGRESS PEMBANGUNAN</td><td> :
<input type=text colour=red name=progress size=10 value='$r[progress]'readonly> <select size='1' name='progress'>
          <option>BELUM</option>
          <option>SELESAI</option>
          

<br><br></td></tr>

<tr><td colspan=2><input type=submit value=Update>
<input type=button value=Batal onclick=self.history.back()>

</td></tr>
</table>
</form>
<script language='javascript'>
function disabled()
{
   document.biodata.lnc.disabled = false;
}
disabled()
</script>";


?>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<div align="center">
  <iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
  </iframe>
</body>
</html>