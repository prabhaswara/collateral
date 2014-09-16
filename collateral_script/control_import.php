<?php

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 6000);
ini_set('max_execution_time', 6000);
ini_set('memory_limit', '-1');
//echo "test";
if (!empty($_FILES)) {
    $db_function = new db_function();
    $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
    $baris = $data->rowcount(0);

    if ($data->val(1, 1) == "[debitur]") {
        //kalau export dari sistem
        $table = "debitur";
        for ($i = 3; $i <= $baris; $i++) {
            if ($data->val($i, 1) == "[debitur_trail]") {
                $i++;
                $table = "debitur_trail";
            } else {
                if ($table == "debitur") {

                    insertDebitur($data, $i);
                } else {

                    insertDebiturTrail($data, $i);
                }
            }
        }
    } else {
        //kalau nulis biasa
        
        if($data->val(1, 156)=="USER UPDATE")
        {
            for ($i = 2; $i <= $baris; $i++) {
                insertDebitur($data, $i, "manual");
            }
        }
        else{
             $_SESSION['colateral']['message'] = showMessage("Format xls salah", "error", "-ses");
            header("location:col_import.php");
        exit;
        }
        
        
       // $_SESSION['colateral']['message']=$db_function->initTrail('xls', "1", $_SESSION['colateral']['npp']);
      
    }
    if (empty($_SESSION['colateral']['message'])) {
        $_SESSION['colateral']['message'] = showMessage("Data telah di export", "success", "-ses");
        header("location:col_import.php");
        exit;
    }
}
/*

  kalau di insert dari export sistem
  tgl_update, action= mengikuti data excel
  usercreate,userupdate=session data excel

  kalau bukan
  tgl_update, action= now
  usercreate,userupdate=session

 */

function insertDebitur($data, $row, $type = "system") {

    $usercreate = $_SESSION['colateral']['npp'];
    $userupdate = $usercreate;
    $action = "now()";
    $tgl_update = "now()";

    if ($type == "system") {
        //print_r($data);
        $row;
        $action =  "'" . $data->val($row, 1). "'";
        $tgl_update = "'" . $data->val($row, 121) . "'";
        $usercreate = "'" . $data->val($row, 155) . "'";
        $userupdate = "'" . $data->val($row, 156) . "'";
    }
    if (cleanstr($data->val($row, 9)) != "") {
        $pesan = "";
        $db_function = new db_function();
        $sql = "delete from debitur where no_rekg_pinjaman='" . $data->val($row, 9) . "'";
        $pesan.=$db_function->exec($sql);
        
        /** // kalau insert manual hapus semua data debitur_trail
        if($type!="system"){
            $sql = "delete from debitur_trail where no_rekg_pinjaman='" . $data->val($row, 9) . "'";        
            $pesan.=$db_function->exec($sql);
        }*/

        $sql = "insert into debitur (action,input_date,LNC,NOAPLIKASI,NAMADEBITUR,TEMPATLAHIR,TGLLAHIR,CIF,no_rekg_pinjaman,afiliasi,instansi,produk,maksimum_kredit,no_pk,tgl_pk,jkw_kredit,fixed_rate,tgl_jt_pk,tgl_jt_fixed_rate,lokasi_dokumen_asli,amplop_asli,amplopasli,lokasi_dokumen_copy,amplop_copy,amplopcopy,jenis_sertifikat,jaminan,jml_jaminan,jenis_surat_tanah,alamat_collateral,luas_tanah,tgl_jt_surat_tanah,jenis_pengikatan,nilai_ht,no_covernote,no_covernote_n,tgl_covernote,jkw_covernote,tgl_jt_covernote,notaris,appraisal,jml_jaminan_n,no_ajb,no_ajb_n,no_surat_tanah,collateral_zipcode,luas_bangunan,nilai_taksasi,harga_tanah,harga_bangunan,harga_tanah_imb,harga_bangunan_imb,no_pengikatan,no_pengikatan_n,proses_pengikatan,tgl_pengikatan,tgl_penyerahan_berkas,developer,no_pks,skim_pks,status_imb,no_imb,nama_perumahan,kategori_proyek,jenis_proyek,total_unitdibangun,penguasaan_sertifikat,no_rek_escrow,cair_tahap_fondasi,tgl_cair_tahap_fondasi,ket_cair_tahap_fondasi,cair_tahap_topping,tgl_cair_tahap_topping,ket_cair_tahap_topping,cair_tahap_bast,tgl_cair_tahap_bast,ket_cair_tahap_bast,cair_tahap_dok,tgl_cair_tahap_dok,ket_cair_tahap_dok,proses_agunan,asuransi_jiwa,no_polis_ass_jiwa,no_polis_ass_jiwa_n,premi_jiwa,nilai_pertanggungan_ass_jiwa,tgl_ass_jiwa,tgl_jt_ass_jiwa,berkas_assuransi_jiwa,asuransi_kerugian,no_polis_ass_kerugian,no_polis_ass_kerugian_n,premi_kerugian,nilai_pertanggungan_ass_kerugian,tgl_ass_kerugian,tgl_jt_ass_kerugian,berkas_asuransi_kerugian,jenis_kendaraan,no_bpkb,no_bpkb_n,no_rangka,nama_dealer,merk,no_mesin,no_polisi,status_rekg,tgl_pelunasan,tgl_serah,pelunasan_penerima,pelunasan_keterangan,memo,skdr,siup,siup_n,tdp,tdp_n,others,others_n,serah,kendala,tgl_update,bunga,program,agama,npwp,kelamin,tgl_imb,penilai,tgl_taksasi,tinggal,cabang,no_ktp,ibu_kandung,jabatan,memo_appraisal,plafond_dimohon,nama_emergency,telp_emergency,alamat_kantor,hubungan,progress,sales,hp_sales,kjpp_flag,kjpp,status,tgl_update_app,tgl_update_los,tgl_update_asc,skim_pencairan,no_jaminan_fleksi,no_jaminan_fleksi_n,jns_jaminan_fleksi,srt_pernyataan_fleksi,usercreate,userupdate) values(";
        for ($col = 1; $col <= 156; $col++) {
            $value = $data->val($row, $col);
            if ($col == 1) {
                $sql.=$action . ",";
            } elseif ($col == 121) {
                $sql.= $tgl_update . ",";
            } elseif ($col == 155) {
                $sql.= $usercreate . ",";
            } elseif ($col == 156) {
                $sql.= $userupdate . ",";
            } else {
                $sql.="'" . $value . "',";
            }
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql.=")";
        $pesan = $db_function->exec($sql);
      
        if ($pesan != "") {
            //    echo $pesan;
        }
        
        if($type=="manual"){
            
            $sql="select no_trail from debitur_trail where no_rekg_pinjaman='" . $data->val($row, 9) . "' order by no_trail desc limit 1";
            $no_trail=$db_function->selectOnefield($sql);
            $no_trail=$no_trail==""?"1":($no_trail+1);
            
            $sql = "insert into debitur_trail (no_trail,insertfrom,input_date,LNC,NOAPLIKASI,NAMADEBITUR,TEMPATLAHIR,TGLLAHIR,CIF,no_rekg_pinjaman,afiliasi,instansi,produk,maksimum_kredit,no_pk,tgl_pk,jkw_kredit,fixed_rate,tgl_jt_pk,tgl_jt_fixed_rate,lokasi_dokumen_asli,amplop_asli,amplopasli,lokasi_dokumen_copy,amplop_copy,amplopcopy,jenis_sertifikat,jaminan,jml_jaminan,jenis_surat_tanah,alamat_collateral,luas_tanah,tgl_jt_surat_tanah,jenis_pengikatan,nilai_ht,no_covernote,no_covernote_n,tgl_covernote,jkw_covernote,tgl_jt_covernote,notaris,appraisal,jml_jaminan_n,no_ajb,no_ajb_n,no_surat_tanah,collateral_zipcode,luas_bangunan,nilai_taksasi,harga_tanah,harga_bangunan,harga_tanah_imb,harga_bangunan_imb,no_pengikatan,no_pengikatan_n,proses_pengikatan,tgl_pengikatan,tgl_penyerahan_berkas,developer,no_pks,skim_pks,status_imb,no_imb,nama_perumahan,kategori_proyek,jenis_proyek,total_unitdibangun,penguasaan_sertifikat,no_rek_escrow,cair_tahap_fondasi,tgl_cair_tahap_fondasi,ket_cair_tahap_fondasi,cair_tahap_topping,tgl_cair_tahap_topping,ket_cair_tahap_topping,cair_tahap_bast,tgl_cair_tahap_bast,ket_cair_tahap_bast,cair_tahap_dok,tgl_cair_tahap_dok,ket_cair_tahap_dok,proses_agunan,asuransi_jiwa,no_polis_ass_jiwa,no_polis_ass_jiwa_n,premi_jiwa,nilai_pertanggungan_ass_jiwa,tgl_ass_jiwa,tgl_jt_ass_jiwa,berkas_assuransi_jiwa,asuransi_kerugian,no_polis_ass_kerugian,no_polis_ass_kerugian_n,premi_kerugian,nilai_pertanggungan_ass_kerugian,tgl_ass_kerugian,tgl_jt_ass_kerugian,berkas_asuransi_kerugian,jenis_kendaraan,no_bpkb,no_bpkb_n,no_rangka,nama_dealer,merk,no_mesin,no_polisi,status_rekg,tgl_pelunasan,tgl_serah,pelunasan_penerima,pelunasan_keterangan,memo,skdr,siup,siup_n,tdp,tdp_n,others,others_n,serah,kendala,tgl_update,bunga,program,agama,npwp,kelamin,tgl_imb,penilai,tgl_taksasi,tinggal,cabang,no_ktp,ibu_kandung,jabatan,memo_appraisal,plafond_dimohon,nama_emergency,telp_emergency,alamat_kantor,hubungan,progress,sales,hp_sales,kjpp_flag,kjpp,status,tgl_update_app,tgl_update_los,tgl_update_asc,skim_pencairan,no_jaminan_fleksi,no_jaminan_fleksi_n,jns_jaminan_fleksi,srt_pernyataan_fleksi,userupdate) values(";
            $sql .= "'$no_trail','xls',";
            for ($col = 1; $col <= 156; $col++) {
                $value = $data->val($row, $col);
                if ($col == 1) {
                  //  $sql.=$action . ",";
                } elseif ($col == 121) {
                    $sql.= $tgl_update . ",";
                } elseif ($col == 155) {
                 //   $sql.= $usercreate . ",";
                } elseif ($col == 156) {
                    $sql.= $userupdate . ",";
                } else {
                    $sql.="'" . $value . "',";
                }
            }
            $sql = substr($sql, 0, strlen($sql) - 1);
            $sql.=")";
        //    echo $sql;exit;
            $pesan = $db_function->exec($sql);
        
        }
    }
}

function insertDebiturTrail($data, $row) {
    if (cleanstr($data->val($row, 9)) != "") {
        $pesan = "";
        $db_function = new db_function();
        $sql = "delete from debitur_trail where no_rekg_pinjaman='" . $data->val($row, 7) . "' and no_trail='" . $data->val($row, 156) . "'";
        $pesan.=$db_function->exec($sql);
      //  echo $sql;

        $sql = "insert into debitur_trail (LNC,NOAPLIKASI,NAMADEBITUR,TEMPATLAHIR,TGLLAHIR,CIF,no_rekg_pinjaman,afiliasi,instansi,produk,maksimum_kredit,no_pk,tgl_pk,jkw_kredit,fixed_rate,tgl_jt_pk,tgl_jt_fixed_rate,lokasi_dokumen_asli,amplop_asli,amplopasli,lokasi_dokumen_copy,amplop_copy,amplopcopy,jaminan,jml_jaminan,jenis_surat_tanah,alamat_collateral,luas_tanah,tgl_jt_surat_tanah,jenis_pengikatan,nilai_ht,jkw_covernote,notaris,appraisal,no_ajb,no_surat_tanah,collateral_zipcode,luas_bangunan,nilai_taksasi,harga_tanah,harga_bangunan,harga_tanah_imb,harga_bangunan_imb,no_pengikatan,tgl_covernote,tgl_jt_covernote,developer,skim_pks,no_imb,status_imb,nama_perumahan,asuransi_jiwa,no_polis_ass_jiwa,premi_jiwa,nilai_pertanggungan_ass_jiwa,tgl_ass_jiwa,tgl_jt_ass_jiwa,asuransi_kerugian,no_polis_ass_kerugian,premi_kerugian,nilai_pertanggungan_ass_kerugian,tgl_ass_kerugian,tgl_jt_ass_kerugian,jenis_kendaraan,no_bpkb,no_rangka,nama_dealer,merk,no_mesin,no_polisi,status_rekg,tgl_pelunasan,memo,skdr,siup,tdp,others,serah,kendala,tgl_update,bunga,program,agama,npwp,kelamin,tgl_imb,penilai,tgl_taksasi,tinggal,cabang,no_ktp,ibu_kandung,jabatan,memo_appraisal,plafond_dimohon,nama_emergency,telp_emergency,alamat_kantor,hubungan,progress,sales,hp_sales,kjpp,status,tgl_update_app,tgl_update_los,tgl_update_asc,skim_pencairan,input_date,no_covernote,no_covernote_n,no_pengikatan_n,tgl_penyerahan_berkas,proses_pengikatan,jenis_sertifikat,jenis_proyek,kategori_proyek,total_unitdibangun,penguasaan_sertifikat,no_rek_escrow,cair_tahap_fondasi,tgl_cair_tahap_fondasi,ket_cair_tahap_fondasi,cair_tahap_topping,tgl_cair_tahap_topping,ket_cair_tahap_topping,cair_tahap_bast,tgl_cair_tahap_bast,ket_cair_tahap_bast,cair_tahap_dok,tgl_cair_tahap_dok,ket_cair_tahap_dok,proses_agunan,no_polis_ass_kerugian_n,berkas_asuransi_kerugian,no_polis_ass_jiwa_n,berkas_assuransi_jiwa,no_jaminan_fleksi,no_jaminan_fleksi_n,jns_jaminan_fleksi,srt_pernyataan_fleksi,no_bpkb_n,tgl_serah,pelunasan_penerima,pelunasan_keterangan,siup_n,tdp_n,no_pks,tgl_pengikatan,others_n,kjpp_flag,no_ajb_n,jml_jaminan_n,userupdate,insertfrom,no_trail) values(";
        for ($col = 1; $col <= 156; $col++) {
            $value = $data->val($row, $col);

            $sql.="'" . $value . "',";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql.=")";
        $pesan.=$db_function->exec($sql);
        if ($pesan != "") {
         //   echo $pesan;
        }
    }
}

?>