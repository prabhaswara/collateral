<?php

if (!empty($_POST)) {
    
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=EXPORTCADS_".str_replace("-", "", $_POST["frm"]["tgl_awal"])."_".str_replace("-", "", $_POST["frm"]["tgl_akhir"]).".xls ");
    header("Content-Transfer-Encoding: binary ");

    xlsBOF();
   
    $judulArray = array("TGL SIMPAN", "TGL. INPUT", "LNC", "NO. APLIKASI", "NAMA DEBITUR", "TEMPAT LAHIR", "TGL. LAHIR", "CIF", "NO.REKG. PINJAMAN", "AFILIASI", "INSTANSI", "PRODUK", "PLAFOND", "NO. PK", "TGL. PK", "JKW. KREDIT", "FIX RATE", "TGL. JT TEMPO", "TGL. JT FIX", "LOKASI DOK. ASLI", "NO.BANTEK ASLI", "NO. AMPLOP ASLI", "LOKASI DOK. COPY", "NO. BANTEK COPY", "NO. AMPLOP COPY", "JENIS SERTIFIKAT", "STATUS SERTIFIKAT", "NO. GS/SU", "JENIS SURAT TANAH", "ALAMAT OBYEK JAMINAN", "LUAS TANAH", "TGL.JT SURAT TANAH", "JENIS HT", "NILAI HT", "STATUS COVERNOTE", "NO COVERNOTE", "TGL. COVERNOTE", "JKW COVERNOTE", "TGL JT COVERNOTE", "NAMA NOTARIS", "NAMA PEMILIK JAMINAN", "JUMLAH JAMINAN", "STATUS AJB", "NO. AJB", "NO. KEPEMILIKAN TANAH", "COLLATERAL ZIPCODE", "LUAS BANGUNAN", "TGL. SERTIFIKAT", "HARGA TANAH", "HARGA BANGUNAN", "HARGA TANAH IMB/M2", "HARGA BANGUNAN IMB/M2", "STATUS PENGIKATAN", "NO. PENGIKATAN", "PROSES PENGIKATAN", "TGL PENGIKATAN", "TGL PENERAHAN BERKAS", "DEVELOPER", "NO PKS", "SKIM PKS", "STATUS IMB", "NO. IMB", "NAMA PROYEK", "KATEGORI PROYEK", "JENIS PROYEK", "TOTAL UNIT DI BANGUN", "PENGUASAAN SERTIFIKAT", "NO REK ESCROW", "CAIR TAHAP FONDASI", "TGL CAIR TAHAP FONDASI", "KET CAIR TAHAP FONDASI", "CAIR TAHAP TOPPING", "TANGGAL CAIR TAHAP TOPPING", "KET CAIR TAHAP TOPPING", "CAIR TAHAP BAST", "TANGGAL CAIR TAHAP BAST", "KET CAIR TAHAP BAST", "CAIR TAHAP DOK", "TANGGAL CAIR TAHAP DOK", "KET CAIR TAHAP DOK", "PROSES ANGGUNAN", "ASS. JIWA", "STATUS POLIS ASS JW", "NO.POLIS ASS JW", "PREMI ASS.JW", "NILAI PERTANGG ASS JW", "TGL. ASS JW", "TGL. JT ASS JW", "BERKAS ASURANSI JW", "ASS. KERUGIAN", "STATUS POLIS ASS KERUGIAN", "NO. POLIS ASS KERUGIAN", "PREMI KERUGIAN", "NILAI PERTGG ASS KERUGIAN", "TGL. ASS KERUGIAN", "TGL. JT ASS KERUGIAN", "BERKAS ASURANSI KERUGIAN", "JENIS KENDARAAN", "STATUS BPKB", "NO. BPKB", "NO. RANGKA", "NAMA DEALER", "MERK", "NO. MESIN", "NO. POLISI", "STATUS REKG", "TGL. LUNAS", "TANGGAL DISERAHKAN", "PENERIMA PELUNASAN", "KETERANGAN PELUNASAN", "MEMO", "SKDR", "STATUS SIUP", "SIUP", "STATUS TDP", "TDP", "STATUS OTHERS", "OTHERS", "STATUS PENYERAHAN JAMINAN", "KENDALA", "TGL. UPDATE", "BUNGA", "PROGRAM", "AGAMA", "NO. NPWP", "JENIS KELAMIN", "TGL. IMB", "PENILAI", "TGL. TAKSASI", "ALAMAT", "KODE CABANG", "NO. KTP", "IBU KANDUNG", "JABATAN", "MEMO APPRAISAL", "PLAFOND DIMOHON", "NAMA EMERGENCY", "NO.TELP. EMERGENCY", "ALAMAT KANTOR", "HUBUNGAN EMERGENCY", "PROGRESS BANGUNAN", "NAMA SALES", "NO. HP SALES", "STATUS KJPP", "KJPP", "STATUS APLIKASI", "TGL.UPDATE APP", "TGL.UPDATE LOS", "TGL.UPDATE ASC", "SKIM PENCAIRAN", "STATUS JAMINAN FLEKSI", "NO JAMINAN FLEKSI", "JENIS JAMINAN FLEKSI", "SURAT PERNYATAAN FLEKSI", "USER CREATE", "USER UPDATE");
    $db_function = new db_function();
    $sql = "select action,input_date,LNC,NOAPLIKASI,NAMADEBITUR,TEMPATLAHIR,TGLLAHIR,CIF,no_rekg_pinjaman,afiliasi,instansi,produk,maksimum_kredit,no_pk,tgl_pk,jkw_kredit,fixed_rate,tgl_jt_pk,tgl_jt_fixed_rate,lokasi_dokumen_asli,amplop_asli,amplopasli,lokasi_dokumen_copy,amplop_copy,amplopcopy,jenis_sertifikat,jaminan,jml_jaminan,jenis_surat_tanah,alamat_collateral,luas_tanah,tgl_jt_surat_tanah,jenis_pengikatan,nilai_ht,no_covernote,no_covernote_n,tgl_covernote,jkw_covernote,tgl_jt_covernote,notaris,appraisal,jml_jaminan_n,no_ajb,no_ajb_n,no_surat_tanah,collateral_zipcode,luas_bangunan,nilai_taksasi,harga_tanah,harga_bangunan,harga_tanah_imb,harga_bangunan_imb,no_pengikatan,no_pengikatan_n,proses_pengikatan,tgl_pengikatan,tgl_penyerahan_berkas,developer,no_pks,skim_pks,status_imb,no_imb,nama_perumahan,kategori_proyek,jenis_proyek,total_unitdibangun,penguasaan_sertifikat,no_rek_escrow,cair_tahap_fondasi,tgl_cair_tahap_fondasi,ket_cair_tahap_fondasi,cair_tahap_topping,tgl_cair_tahap_topping,ket_cair_tahap_topping,cair_tahap_bast,tgl_cair_tahap_bast,ket_cair_tahap_bast,cair_tahap_dok,tgl_cair_tahap_dok,ket_cair_tahap_dok,proses_agunan,asuransi_jiwa,no_polis_ass_jiwa,no_polis_ass_jiwa_n,premi_jiwa,nilai_pertanggungan_ass_jiwa,tgl_ass_jiwa,tgl_jt_ass_jiwa,berkas_assuransi_jiwa,asuransi_kerugian,no_polis_ass_kerugian,no_polis_ass_kerugian_n,premi_kerugian,nilai_pertanggungan_ass_kerugian,tgl_ass_kerugian,tgl_jt_ass_kerugian,berkas_asuransi_kerugian,jenis_kendaraan,no_bpkb,no_bpkb_n,no_rangka,nama_dealer,merk,no_mesin,no_polisi,status_rekg,tgl_pelunasan,tgl_serah,pelunasan_penerima,pelunasan_keterangan,memo,skdr,siup,siup_n,tdp,tdp_n,others,others_n,serah,kendala,tgl_update,bunga,program,agama,npwp,kelamin,tgl_imb,penilai,tgl_taksasi,tinggal,cabang,no_ktp,ibu_kandung,jabatan,memo_appraisal,plafond_dimohon,nama_emergency,telp_emergency,alamat_kantor,hubungan,progress,sales,hp_sales,kjpp_flag,kjpp,status,tgl_update_app,tgl_update_los,tgl_update_asc,skim_pencairan,no_jaminan_fleksi,no_jaminan_fleksi_n,jns_jaminan_fleksi,srt_pernyataan_fleksi,usercreate,userupdate from debitur ";
    $sql.="where tgl_update>= '".balikTgl($_POST["frm"]["tgl_awal"])." 00:00:00' and tgl_update<='".balikTgl($_POST["frm"]["tgl_akhir"])." 23:59:59'";
    
  
    $dataArray = $db_function->selectAllRows($sql);
    xlsWriteLabel(0, 0, "[debitur]");
    $row = 1;
    foreach ($judulArray as $col => $data) {
        xlsWriteLabel($row, $col, $data);
    }
    $row++;
    foreach ($dataArray as $data) {
        foreach ($judulArray as $col => $judul) {
            xlsWriteLabel($row, $col, $data[$col]);
        }
        $row++;
    }
    
    //insert trail
    $judulArrayTrail = array("LNC","NOAPLIKASI","NAMADEBITUR","TEMPATLAHIR","TGLLAHIR","CIF","no_rekg_pinjaman","afiliasi","instansi","produk","maksimum_kredit","no_pk","tgl_pk","jkw_kredit","fixed_rate","tgl_jt_pk","tgl_jt_fixed_rate","lokasi_dokumen_asli","amplop_asli","amplopasli","lokasi_dokumen_copy","amplop_copy","amplopcopy","jaminan","jml_jaminan","jenis_surat_tanah","alamat_collateral","luas_tanah","tgl_jt_surat_tanah","jenis_pengikatan","nilai_ht","jkw_covernote","notaris","appraisal","no_ajb","no_surat_tanah","collateral_zipcode","luas_bangunan","nilai_taksasi","harga_tanah","harga_bangunan","harga_tanah_imb","harga_bangunan_imb","no_pengikatan","tgl_covernote","tgl_jt_covernote","developer","skim_pks","no_imb","status_imb","nama_perumahan","asuransi_jiwa","no_polis_ass_jiwa","premi_jiwa","nilai_pertanggungan_ass_jiwa","tgl_ass_jiwa","tgl_jt_ass_jiwa","asuransi_kerugian","no_polis_ass_kerugian","premi_kerugian","nilai_pertanggungan_ass_kerugian","tgl_ass_kerugian","tgl_jt_ass_kerugian","jenis_kendaraan","no_bpkb","no_rangka","nama_dealer","merk","no_mesin","no_polisi","status_rekg","tgl_pelunasan","memo","skdr","siup","tdp","others","serah","kendala","tgl_update","bunga","program","agama","npwp","kelamin","tgl_imb","penilai","tgl_taksasi","tinggal","cabang","no_ktp","ibu_kandung","jabatan","memo_appraisal","plafond_dimohon","nama_emergency","telp_emergency","alamat_kantor","hubungan","progress","sales","hp_sales","kjpp","status","tgl_update_app","tgl_update_los","tgl_update_asc","skim_pencairan","input_date","no_covernote","no_covernote_n","no_pengikatan_n","tgl_penyerahan_berkas","proses_pengikatan","jenis_sertifikat","jenis_proyek","kategori_proyek","total_unitdibangun","penguasaan_sertifikat","no_rek_escrow","cair_tahap_fondasi","tgl_cair_tahap_fondasi","ket_cair_tahap_fondasi","cair_tahap_topping","tgl_cair_tahap_topping","ket_cair_tahap_topping","cair_tahap_bast","tgl_cair_tahap_bast","ket_cair_tahap_bast","cair_tahap_dok","tgl_cair_tahap_dok","ket_cair_tahap_dok","proses_agunan","no_polis_ass_kerugian_n","berkas_asuransi_kerugian","no_polis_ass_jiwa_n","berkas_assuransi_jiwa","no_jaminan_fleksi","no_jaminan_fleksi_n","jns_jaminan_fleksi","srt_pernyataan_fleksi","no_bpkb_n","tgl_serah","pelunasan_penerima","pelunasan_keterangan","siup_n","tdp_n","no_pks","tgl_pengikatan","others_n","kjpp_flag","no_ajb_n","jml_jaminan_n","userupdate","insertfrom","no_trail");
    $sql = "select LNC,NOAPLIKASI,NAMADEBITUR,TEMPATLAHIR,TGLLAHIR,CIF,no_rekg_pinjaman,afiliasi,instansi,produk,maksimum_kredit,no_pk,tgl_pk,jkw_kredit,fixed_rate,tgl_jt_pk,tgl_jt_fixed_rate,lokasi_dokumen_asli,amplop_asli,amplopasli,lokasi_dokumen_copy,amplop_copy,amplopcopy,jaminan,jml_jaminan,jenis_surat_tanah,alamat_collateral,luas_tanah,tgl_jt_surat_tanah,jenis_pengikatan,nilai_ht,jkw_covernote,notaris,appraisal,no_ajb,no_surat_tanah,collateral_zipcode,luas_bangunan,nilai_taksasi,harga_tanah,harga_bangunan,harga_tanah_imb,harga_bangunan_imb,no_pengikatan,tgl_covernote,tgl_jt_covernote,developer,skim_pks,no_imb,status_imb,nama_perumahan,asuransi_jiwa,no_polis_ass_jiwa,premi_jiwa,nilai_pertanggungan_ass_jiwa,tgl_ass_jiwa,tgl_jt_ass_jiwa,asuransi_kerugian,no_polis_ass_kerugian,premi_kerugian,nilai_pertanggungan_ass_kerugian,tgl_ass_kerugian,tgl_jt_ass_kerugian,jenis_kendaraan,no_bpkb,no_rangka,nama_dealer,merk,no_mesin,no_polisi,status_rekg,tgl_pelunasan,memo,skdr,siup,tdp,others,serah,kendala,tgl_update,bunga,program,agama,npwp,kelamin,tgl_imb,penilai,tgl_taksasi,tinggal,cabang,no_ktp,ibu_kandung,jabatan,memo_appraisal,plafond_dimohon,nama_emergency,telp_emergency,alamat_kantor,hubungan,progress,sales,hp_sales,kjpp,status,tgl_update_app,tgl_update_los,tgl_update_asc,skim_pencairan,input_date,no_covernote,no_covernote_n,no_pengikatan_n,tgl_penyerahan_berkas,proses_pengikatan,jenis_sertifikat,jenis_proyek,kategori_proyek,total_unitdibangun,penguasaan_sertifikat,no_rek_escrow,cair_tahap_fondasi,tgl_cair_tahap_fondasi,ket_cair_tahap_fondasi,cair_tahap_topping,tgl_cair_tahap_topping,ket_cair_tahap_topping,cair_tahap_bast,tgl_cair_tahap_bast,ket_cair_tahap_bast,cair_tahap_dok,tgl_cair_tahap_dok,ket_cair_tahap_dok,proses_agunan,no_polis_ass_kerugian_n,berkas_asuransi_kerugian,no_polis_ass_jiwa_n,berkas_assuransi_jiwa,no_jaminan_fleksi,no_jaminan_fleksi_n,jns_jaminan_fleksi,srt_pernyataan_fleksi,no_bpkb_n,tgl_serah,pelunasan_penerima,pelunasan_keterangan,siup_n,tdp_n,no_pks,tgl_pengikatan,others_n,kjpp_flag,no_ajb_n,jml_jaminan_n,userupdate,insertfrom,no_trail from debitur_trail ";
    $sql.="where tgl_update>= '".balikTgl($_POST["frm"]["tgl_awal"])." 00:00:00' and tgl_update<='".balikTgl($_POST["frm"]["tgl_akhir"])." 23:59:59'";
    
    $dataArray = $db_function->selectAllRows($sql);

    $row++;
    xlsWriteLabel($row,0,"[debitur_trail]");
    $row++;
    foreach ($judulArrayTrail as $col => $data) {
        xlsWriteLabel($row, ($col), $data);
    }
    $row++;
    foreach ($dataArray as $data) {
        foreach ($judulArrayTrail as $col => $judul) {
            xlsWriteLabel($row, ($col), $data[$col]);
        }
        $row++;
    }
    
    xlsEOF();
    exit();
}

function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
}

function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
    return;
}

function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
}

function xlsWriteLabel($Row, $Col, $Value) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}

?>
