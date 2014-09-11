<html>
<body>
<marquee direction="left" behavior="alternate" scrolldelay="30" scrollamount="2"></marquee>
</body>
</html>

<?php
echo ("<br><br><a href=summary.php><b>MENU UTAMA</a>&nbsp&nbsp&nbsp<a href=cads_menu.htm>CADS MENU</a>&nbsp&nbsp&nbsp
<a href=menu_laporan.htm>REPORTING</a></b><br><br>");

Include ("koneksi.php");
mysql_select_db("collateral_db");

$edit=mysql_query("SELECT * FROM debitur WHERE no_surat_tanah='$id'");
$r=mysql_fetch_array($edit);

$warna1 = "#A6D000";   // baris genap berwarna hijau tua
$warna2 = "#D5F35B";   // baris ganjil berwarna hijau muda

echo "<h2 ALIGN='CENTER'>EDIT DATA DEBITUR</h2>
<form name=biodata method=POST action=update_data_debitur.php>
<input type=hidden name=id value='$r[NOAPLIKASI]'>

<th><b>INFORMASI DEBITUR</b></th>
<table>
<tr>
<tr><td>Nama LNC</td><td> :
<input type=text name=LNC size=8 value='$r[LNC]'></td></tr> 

<tr><td>No. Aplikasi</td><td> :
<input type=text name=NOAPLIKASI size=50 value='$r[NOAPLIKASI]'></td></tr>

<tr><td>Nama Debitur</td>
<td> : <input type=text name=NAMADEBITUR size=50 value='$r[NAMADEBITUR]'></td></tr>

<tr><td>Tempat Lahir</td>
<td> : <input type=text name=TEMPATLAHIR size=50 value='$r[TEMPATLAHIR]'></td></tr>

<tr><td>Tgl. Lahir</td><td> :
<input type=text name=TGLLAHIR size=8 value='$r[TGLLAHIR]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.TGLLAHIR);return false;'></td></tr>

<tr><td>CIF</td><td> :
<input type=text name=CIF size=50 value='$r[CIF]'></td></tr>

<tr><td>No. Rekg. Pinjaman</td><td> :
<input type=text name=no_rekg_pinjaman size=50 value='$r[no_rekg_pinjaman]'></td></tr>

<tr><td>No. Rekg. Afiliasi</td><td> :
<input type=text name=afiliasi size=50 value='$r[afiliasi]'></td></tr>

<tr><td><b>INFORMASI PINJAMAN</b></tr></td>
<tr><td>Jenis Produk</td><td> :
<input type=text name=produk size=50 value='$r[produk]'></td></tr>

<tr><td>Maksimum Kredit</td><td> :
<input type=text name=maksimum_kredit size=50 value='$r[maksimum_kredit]'></td></tr>

<tr><td>No. Perjanjian Kredit</td><td> :
<input type=text name=no_pk size=50 value='$r[no_pk]'></td></tr>

<tr><td>Tgl. Perjanjian Kredit</td><td> :
<input type=text name=tgl_pk size=8 value='$r[tgl_pk]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_pk);return false;'></td></tr>

<tr><td>Jangka Waktu Kredit</td><td> :
<input type=text name=jkw_kredit size=8 value='$r[jkw_kredit]'> bulan</td></tr>

<tr><td>Tgl. Jatuh Tempo PK</td><td> :
<input type=text name=tgl_jt_pk size=8 value='$r[tgl_jt_pk]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_pk);return false;'></td></tr>

<tr><td>Masa Fixed</td><td> :
<input type=text name=fixed_rate size=8 value='$r[fixed_rate]'> bulan</td></tr>

<tr><td>Tgl. Berakhir Fixed Rate</td><td> :
<input type=text name=tgl_jt_fixed_rate size=8 value='$r[tgl_jt_fixed_rate]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_fixed_rate);return false;'></td></tr>

<tr><td><b>INFORMASI COLLATERAL</b></tr></td>
<tr><td>Status Sertifikat Tanah</td><td> :
<input type=text name=jaminan size=50 value='$r[jaminan]'></td></tr>

<tr><td>Jenis Surat Tanah</td><td> :
<input type=text name=jenis_surat_tanah size=50 value='$r[jenis_surat_tanah]'></td></tr>

<tr><td>No. Surat Tanah</td><td> :
<input type=text name=no_surat_tanah size=50 value='$r[no_surat_tanah]'></td></tr>

<tr><td>No. GS/SU</td><td> :
<input type=text name=jml_jaminan size=50 value='$r[jml_jaminan]'></td></tr>

<tr><td>Alamat Collateral</td><td> :
<input type=text name=alamat_collateral size=50 value='$r[alamat_collateral]'></td></tr>

<tr><td>Kode Pos Jaminan</td><td> :
<input type=text name=collateral_zipcode size=50 value='$r[collateral_zipcode]'></td></tr>

<tr><td>Luas Tanah</td><td> :
<input type=text name=luas_tanah size=8 value='$r[luas_tanah]'> m<sup>2</td></tr>

<tr><td>Luas Bangunan</td><td> :
<input type=text name=luas_bangunan size=8 value='$r[luas_bangunan]'> m<sup>2</td></tr>

<tr><td>Tgl. Jatuh Tempo Surat Tanah</td><td> :
<input type=text name=tgl_jt_surat_tanah size=8 value='$r[tgl_jt_surat_tanah]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_surat_tanah);return false;'></td></tr>

<tr><td>Total Nilai Taksasi</td><td> :
<input type=text name=nilai_taksasi size=50 value='$r[nilai_taksasi]'></td></tr>

<tr><td>Taksasi Tanah per m<sup>2</sup></td><td> :
<input type=text name=harga_tanah size=50 value='$r[harga_tanah]'></td></tr>

<tr><td>Taksasi Bangunan per m<sup>2</sup></td><td> :
<input type=text name=harga_bangunan size=50 value='$r[harga_bangunan]'></td></tr>

<tr><td>NJOP Tanah per m<sup>2</sup></td><td> :
<input type=text name=harga_tanah_imb size=50 value='$r[harga_tanah_imb]'></td></tr>

<tr><td>NJOP Bangunan per m<sup>2</sup></td><td> :
<input type=text name=harga_bangunan_imb size=50 value='$r[harga_bangunan_imb]'></td></tr>

<tr><td>Nama Appraisal</td><td> :
<input type=text name=appraisal size=50 value='$r[appraisal]'></td></tr>

<tr><td>No. AJB</td><td> :
<input type=text name=no_ajb size=50 value='$r[no_ajb]'></td></tr>

<tr><td>Jenis Pengikatan</td><td> :
<input type=text name=jenis_pengikatan size=50 value='$r[jenis_pengikatan]'></td></tr>

<tr><td>No. Pengikatan</td><td> :
<input type=text name=no_pengikatan size=50 value='$r[no_pengikatan]'></td></tr>

<tr><td>Nilai Pengikatan</td><td> :
<input type=text name=nilai_ht size=50 value='$r[nilai_ht]'></td></tr>

<tr><td>Tgl. Covernote</td><td> :
<input type=text name=tgl_covernote size=8 value='$r[tgl_covernote]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_covernote);return false;'></td></tr>

<tr><td>Jangka Waktu Covernote</td><td> :
<input type=text name=jkw_covernote size=8 value='$r[jkw_covernote]'> bulan</td></tr>

<tr><td>Tgl. Jatuh Tempo Covernote</td><td> :
<input type=text name=tgl_jt_covernote size=8 value='$r[tgl_jt_covernote]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_covernote);return false;'></td></tr>

<tr><td>Nama Notaris</td><td> :
<input type=text name=notaris size=50 value='$r[notaris]'></td></tr>

<tr><td>Nama Developer/Penjual</td><td> :
<input type=text name=developer size=50 value='$r[developer]'></td></tr>

<tr><td>Skim PKS Developer</td><td> :
<input type=text name=skim_pks size=50 value='$r[skim_pks]'></td></tr>

<tr><td>Nama Perumahan</td><td> :
<input type=text name=nama_perumahan size=50 value='$r[nama_perumahan]'></td></tr>

<tr><td>Status IMB</td><td> :
<input type=text name=status_imb size=50 value='$r[status_imb]'></td></tr>

<tr><td>No. IMB</td><td> :
<input type=text name=no_imb size=50 value='$r[no_imb]'></td></tr>

<tr><td><b>INFORMASI ASURANSI JIWA</b></tr></td>
<tr><td>Asuransi Jiwa</td><td> :
<input type=text name=asuransi_jiwa size=50 value='$r[asuransi_jiwa]'></td></tr>

<tr><td>Nilai Pertanggungan Ass. Jiwa</td><td> :
<input type=text name=nilai_pertanggungan_ass_jiwa size=50 value='$r[nilai_pertanggungan_ass_jiwa]'></td></tr>

<tr><td>No. Polis Ass. Jiwa</td><td> :
<input type=text name=no_polis_ass_jiwa size=50 value='$r[no_polis_ass_jiwa]'></td></tr>

<tr><td>Tgl. Asuransi Jiwa</td><td> :
<input type=text name=tgl_ass_jiwa size=8 value='$r[tgl_ass_jiwa]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_ass_jiwa);return false;'></td></tr>

<tr><td>Premi Asuransi Jiwa</td><td> :
<input type=text name=premi_jiwa size=50 value='$r[premi_jiwa]'></td></tr>

<tr><td>Tgl. Jatuh Tempo Ass. Jiwa</td><td> :
<input type=text name=tgl_jt_ass_jiwa size=8 value='$r[tgl_jt_ass_jiwa]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_ass_jiwa);return false;'></td></tr>

<tr><td><b>INFORMASI ASURANSI KERUGIAN</b></tr></td>
<tr><td>Asuransi Kerugian</td><td> :
<input type=text name=asuransi_kerugian size=50 value='$r[asuransi_kerugian]'></td></tr>

<tr><td>Nilai Pertanggungan Ass. Kerugian</td><td> :
<input type=text name=nilai_pertanggungan_ass_kerugian size=50 value='$r[nilai_pertanggungan_ass_kerugian]'></td></tr>

<tr><td>No. Polis Ass. Kerugian</td><td> :
<input type=text name=no_polis_ass_kerugian size=50 value='$r[no_polis_ass_kerugian]'></td></tr>

<tr><td>Tgl. Asuransi Kerugian</td><td> :
<input type=text name=tgl_ass_kerugian size=8 value='$r[tgl_ass_kerugian]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_ass_kerugian);return false;'></td></tr>

<tr><td>Premi Asuransi Kerugian</td><td> :
<input type=text name=premi_kerugian size=50 value='$r[premi_kerugian]'></td></tr>

<tr><td>Tgl. Jatuh Tempo Ass. Kerugian</td><td> :
<input type=text name=tgl_jt_ass_kerugian size=8 value='$r[tgl_jt_ass_kerugian]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_jt_ass_kerugian);return false;'></td></tr>

<tr><td><b>INFORMASI OTO COLLATERAL</b></tr></td>
<tr><td>Jenis Kendaraan</td><td> :
<input type=text name=jenis_kendaraan size=50 value='$r[jenis_kendaraan]'></td></tr>

<tr><td>Merk</td><td> :
<input type=text name=merk size=50 value='$r[merk]'></td></tr>

<tr><td>No. BPKB</td><td> :
<input type=text name=no_bpkb size=50 value='$r[no_bpkb]'></td></tr>

<tr><td>No. Mesin</td><td> :
<input type=text name=no_mesin size=50 value='$r[no_mesin]'></td></tr>

<tr><td>No. Rangka</td><td> :
<input type=text name=no_rangka size=50 value='$r[no_rangka]'></td></tr>

<tr><td>No. Polisi</td><td> :
<input type=text name=no_polisi size=50 value='$r[no_polisi]'></td></tr>

<tr><td>Nama Dealer</td><td> :
<input type=text name=nama_dealer size=50 value='$r[nama_dealer]'></td></tr>

<tr><td><b>INFORMASI LAIN</b></tr></td>
<tr><td>Kluis Dokumen Asli</td><td> :
<input type=text name=lokasi_dokumen_asli size=50 value='$r[lokasi_dokumen_asli]'></td></tr>

<tr><td>No. Bantek Dokumen Asli</td><td> :
<input type=text name=amplop_asli size=50 value='$r[amplop_asli]'></td></tr>

<tr><td>No. Amplop Asli</td>
<td>  : <input type=text name=amplopasli size=50 value='$r[amplopasli]'></td></tr>

<tr><td>Kluis Dokumen Copy</td><td> :
<input type=text name=lokasi_dokumen_copy size=50 value='$r[lokasi_dokumen_copy]'></td></tr>

<tr><td>No. Bantek Dokumen Copy</td><td> :
<input type=text name=amplop_copy size=50 value='$r[amplop_copy]'></td></tr>

<tr><td>No. Amplop Copy</td>
<td> : <input type=text name=amplopcopy size=50 value='$r[amplopcopy]'></td></tr>

<tr><td>Status Rekening</td><td> :
<input type=text name=status_rekg size=50 value='$r[status_rekg]'></td></tr>

<tr><td>Tgl. Pelunasan</td>
<td> : <input type=text name=tgl_pelunasan size=8 value='$r[tgl_pelunasan]' onClick='if(self.gfPop)gfPop.fPopCalendar(document.biodata.tgl_pelunasan);return false;'></td></tr>

<tr><td>Penyerahan Jaminan Setelah Pelunasan</td>
<td> : <select size='1' name='serah' size=50>
       <option>=           SELECT           =</option>
       <option>SUDAH</option>
       <option>BELUM</option>

<tr><td><b>LEGALITAS USAHA</b></tr></td>
<tr><td>SIUP</td>
<td> : <input type=text name=siup size=50 value='$r[siup]'></td></tr>

<tr><td>TDP</td>
<td> : <input type=text name=tdp size=50 value='$r[tdp]'></td></tr>

<tr><td>OTHERS</td>
<td> : <input type=text name=others size=50 value='$r[others]'></td></tr>

<tr><td><b>MEMO</b></tr></td>
<tr><td>Memo</td>
<td> : <textarea name=memo cols=38 rows=7>$r[memo]
</textarea></td></tr>

<tr><td>Kendala Pengikatan</td>
<td> : <select size='1' name='kendala' size=70>
       <option>=           SELECT           =</option>
       <option>SPLITZING</option>
       <option>SERTIFIKAT INDUK DIBLOKIR</option>
       <option>PROSES PEMEKARAN WILAYAH</option>
       <option>BIAYA BELUM DIBAYAR</option>
       <option>DEVELOPER PAILIT</option>
       <option>AKUISISI DEVELOPER</option>
       <option>WORKLOAD PROSES DI BPN</option>
       <option>KESALAHAN PROSES BALIK NAMA</option>
       <option>REVISI PBB</option>
       <option>GANTI BLANKO SERTIFIKAT</option>
       <option>PENINGKATAN  STATUS  KEPEMILIKAN  TANAH</option>
       <option>ROYA PARTIAL</option>
	   <option>DOUBLE GS</option>
       </select>     $r[kendala] 
<br><br></td></tr>

<tr><td colspan=2><input type=submit value=Update>
<input type=button value=Batal onclick=self.history.back()>

</td></tr>
</table>
</form>";
?>
<!--  PopCalendar(tag name and id must match) Tags should not be enclosed in tags other than the html body tag. -->
<div align="center">
  <iframe width=174 height=189 name="gToday:normal:./calender/agenda.js" id="gToday:normal:./calender/agenda.js" src="./calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
  </iframe>