<?php
        class db_function{
        
        private $host="localhost";
        private $user="root";
        private $password="";
        
        private $database="collateral_db";
        
        private $con="";
    
        
        function konek(){
            $this->con=mysql_connect($this->host,$this->user,$this->password);
            mysql_select_db($this->database, $this->con);
        }
        function tutup(){
           mysql_close($this->con);
        }
        function exec($sql){
            $this->konek();
            mysql_query($sql,$this->con);
            $pesan= mysql_error($this->con);
            $this->tutup();
            return $pesan;
        }
        
        /*insertfrom_prm: init, xls
         * 
         */
        function initTrail($insertfrom_prm,$no_trail_prm,$userupdate_prm){
            $sql="insert into debitur_trail(LNC, NOAPLIKASI, NAMADEBITUR, TEMPATLAHIR, TGLLAHIR, CIF, no_rekg_pinjaman, afiliasi, instansi, produk, maksimum_kredit, no_pk, tgl_pk, jkw_kredit, fixed_rate, tgl_jt_pk, tgl_jt_fixed_rate, lokasi_dokumen_asli, amplop_asli, amplopasli, lokasi_dokumen_copy, amplop_copy, amplopcopy, jaminan, jml_jaminan, jenis_surat_tanah, alamat_collateral, luas_tanah, tgl_jt_surat_tanah, jenis_pengikatan, nilai_ht, jkw_covernote, notaris, appraisal, no_ajb, no_surat_tanah, collateral_zipcode, luas_bangunan, nilai_taksasi, harga_tanah, harga_bangunan, harga_tanah_imb, harga_bangunan_imb, no_pengikatan, tgl_covernote, tgl_jt_covernote, developer, skim_pks, no_imb, status_imb, nama_perumahan, asuransi_jiwa, no_polis_ass_jiwa, premi_jiwa, nilai_pertanggungan_ass_jiwa, tgl_ass_jiwa, tgl_jt_ass_jiwa, asuransi_kerugian, no_polis_ass_kerugian, premi_kerugian, nilai_pertanggungan_ass_kerugian, tgl_ass_kerugian, tgl_jt_ass_kerugian, jenis_kendaraan, no_bpkb, no_rangka, nama_dealer, merk, no_mesin, no_polisi, status_rekg, tgl_pelunasan, memo, skdr, siup, tdp, others, serah, kendala, tgl_update, bunga, program, agama, npwp, kelamin, tgl_imb, penilai, tgl_taksasi, tinggal, cabang, no_ktp, ibu_kandung, jabatan, memo_appraisal, plafond_dimohon, nama_emergency, telp_emergency, alamat_kantor, hubungan, progress, sales, hp_sales, kjpp, status, tgl_update_app, tgl_update_los, tgl_update_asc, skim_pencairan, input_date, no_covernote, no_covernote_n, no_pengikatan_n, tgl_penyerahan_berkas, proses_pengikatan, jenis_sertifikat, jenis_proyek, kategori_proyek, total_unitdibangun, penguasaan_sertifikat, no_rek_escrow, cair_tahap_fondasi, tgl_cair_tahap_fondasi, ket_cair_tahap_fondasi, cair_tahap_topping, tgl_cair_tahap_topping, ket_cair_tahap_topping, cair_tahap_bast, tgl_cair_tahap_bast, ket_cair_tahap_bast, cair_tahap_dok, tgl_cair_tahap_dok, ket_cair_tahap_dok, proses_agunan, no_polis_ass_kerugian_n, berkas_asuransi_kerugian, no_polis_ass_jiwa_n, berkas_assuransi_jiwa, no_jaminan_fleksi, no_jaminan_fleksi_n, jns_jaminan_fleksi, srt_pernyataan_fleksi, no_bpkb_n, tgl_serah, pelunasan_penerima, pelunasan_keterangan, siup_n, tdp_n, no_pks, tgl_pengikatan, others_n, kjpp_flag, no_ajb_n, jml_jaminan_n, userupdate,no_trail,insertfrom)
            (
            select debitur.LNC, debitur.NOAPLIKASI, debitur.NAMADEBITUR, debitur.TEMPATLAHIR, debitur.TGLLAHIR, debitur.CIF, debitur.no_rekg_pinjaman, debitur.afiliasi, debitur.instansi, debitur.produk, debitur.maksimum_kredit, debitur.no_pk, debitur.tgl_pk, debitur.jkw_kredit, debitur.fixed_rate, debitur.tgl_jt_pk, debitur.tgl_jt_fixed_rate, debitur.lokasi_dokumen_asli, debitur.amplop_asli, debitur.amplopasli, debitur.lokasi_dokumen_copy, debitur.amplop_copy, debitur.amplopcopy, debitur.jaminan, debitur.jml_jaminan, debitur.jenis_surat_tanah, debitur.alamat_collateral, debitur.luas_tanah, debitur.tgl_jt_surat_tanah, debitur.jenis_pengikatan, debitur.nilai_ht, debitur.jkw_covernote, debitur.notaris, debitur.appraisal, debitur.no_ajb, debitur.no_surat_tanah, debitur.collateral_zipcode, debitur.luas_bangunan, debitur.nilai_taksasi, debitur.harga_tanah, debitur.harga_bangunan, debitur.harga_tanah_imb, debitur.harga_bangunan_imb, debitur.no_pengikatan, debitur.tgl_covernote, debitur.tgl_jt_covernote, debitur.developer, debitur.skim_pks, debitur.no_imb, debitur.status_imb, debitur.nama_perumahan, debitur.asuransi_jiwa, debitur.no_polis_ass_jiwa, debitur.premi_jiwa, debitur.nilai_pertanggungan_ass_jiwa, debitur.tgl_ass_jiwa, debitur.tgl_jt_ass_jiwa, debitur.asuransi_kerugian, debitur.no_polis_ass_kerugian, debitur.premi_kerugian, debitur.nilai_pertanggungan_ass_kerugian, debitur.tgl_ass_kerugian, debitur.tgl_jt_ass_kerugian, debitur.jenis_kendaraan, debitur.no_bpkb, debitur.no_rangka, debitur.nama_dealer, debitur.merk, debitur.no_mesin, debitur.no_polisi, debitur.status_rekg, debitur.tgl_pelunasan, debitur.memo, debitur.skdr, debitur.siup, debitur.tdp, debitur.others, debitur.serah, debitur.kendala, debitur.action, debitur.bunga, debitur.program, debitur.agama, debitur.npwp, debitur.kelamin, debitur.tgl_imb, debitur.penilai, debitur.tgl_taksasi, debitur.tinggal, debitur.cabang, debitur.no_ktp, debitur.ibu_kandung, debitur.jabatan, debitur.memo_appraisal, debitur.plafond_dimohon, debitur.nama_emergency, debitur.telp_emergency, debitur.alamat_kantor, debitur.hubungan, debitur.progress, debitur.sales, debitur.hp_sales, debitur.kjpp, debitur.status, debitur.tgl_update_app, debitur.tgl_update_los, debitur.tgl_update_asc, debitur.skim_pencairan, debitur.input_date, debitur.no_covernote, debitur.no_covernote_n, debitur.no_pengikatan_n, debitur.tgl_penyerahan_berkas, debitur.proses_pengikatan, debitur.jenis_sertifikat, debitur.jenis_proyek, debitur.kategori_proyek, debitur.total_unitdibangun, debitur.penguasaan_sertifikat, debitur.no_rek_escrow, debitur.cair_tahap_fondasi, debitur.tgl_cair_tahap_fondasi, debitur.ket_cair_tahap_fondasi, debitur.cair_tahap_topping, debitur.tgl_cair_tahap_topping, debitur.ket_cair_tahap_topping, debitur.cair_tahap_bast, debitur.tgl_cair_tahap_bast, debitur.ket_cair_tahap_bast, debitur.cair_tahap_dok, debitur.tgl_cair_tahap_dok, debitur.ket_cair_tahap_dok, debitur.proses_agunan, debitur.no_polis_ass_kerugian_n, debitur.berkas_asuransi_kerugian, debitur.no_polis_ass_jiwa_n, debitur.berkas_assuransi_jiwa, debitur.no_jaminan_fleksi, debitur.no_jaminan_fleksi_n, debitur.jns_jaminan_fleksi, debitur.srt_pernyataan_fleksi, debitur.no_bpkb_n, debitur.tgl_serah, debitur.pelunasan_penerima, debitur.pelunasan_keterangan, debitur.siup_n, debitur.tdp_n, debitur.no_pks, debitur.tgl_pengikatan, debitur.others_n, debitur.kjpp_flag, debitur.no_ajb_n, debitur.jml_jaminan_n, '$userupdate_prm','$no_trail_prm','$insertfrom_prm'
            from debitur left join debitur_trail on debitur.noaplikasi = debitur_trail.noaplikasi 
            where debitur_trail.noaplikasi is null
            )";
          
            $this->konek();
            mysql_query($sql,$this->con);
            $pesan= mysql_error($this->con);
            $this->tutup();
            return $pesan;
        }
        
        //hanya untuk InnoDB ternyata MyISAM ngk bisa 
        function excecTransaction($arraySql){
            $pesan= "";
            $this->konek();
            mysql_query("START TRANSACTION",$this->con);
           
            foreach($arraySql as $sql){
              
                mysql_query($sql,$this->con);
                $pesan= mysql_error($this->con);                
                if($pesan!=""){        
                
                    break;
                }
            }
            if($pesan==""){
                mysql_query("COMMIT",$this->con);
                 echo "COMMIT";
            }
            else{
                $pesan= mysql_error($this->con);
                mysql_query("ROLLBACK",$this->con);
                echo "roolback";
            }
            
            $this->tutup();
            return $pesan;
        }
        function selectLookup($type,$lnc="*"){
            $sql="select value from lookup where type='$type' and (lnc like'%*%' or lnc like'%".$lnc."%') order by value asc";
           
          
            $listData= $this->selectAllRows($sql);
            $return=array();
            foreach($listData as $data){
            $return[$data['value']]=$data['value'];
            }
            return $return;
            
        }
        
        function selectAllRows($sql){
            $this->konek();
            $query=mysql_query($sql,$this->con) or die(mysql_error());
         
            $result=array();
            $row=0;
            while($item = mysql_fetch_array($query))
            {
                $result[$row++]=$item;
               
            }
           $this->tutup();
            return $result;
        }
        function selectOneRows($sql){
           
            $this->konek();
            $query=mysql_query($sql);
            $rows = mysql_fetch_array($query);
            $this->tutup();
            return $rows;
        }
        function selectOnefield($sql){
           
                      $this->konek();
            $query=mysql_query($sql);
            $result="";
            $row=0;
            if($item = mysql_fetch_array($query))
            {
             
                $result=$item[0];
               
            }
           $this->tutup();
            return $result;
        }
    }          

?>