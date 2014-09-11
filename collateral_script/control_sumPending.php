<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('max_execution_time', 0);

$showtable=false;
$ddl_tglpoint=array();
$setTgl="";

if(empty($_GET["jns_pencarian"])){
    header("location:col_sumPending.php?jns_pencarian=tgl");exit;
}
$_POST['frm']['jns_pencarian']=$_GET['jns_pencarian'];
if(!empty($_POST)){
    
    $db_function = new db_function();
    
    if(strtolower( $_POST['action'])=="simpan point"){
        
        $data=$_SESSION['colateral']['summery_pending'];
        $tanggal=$data[0]['tanggal'];
        $setTgl=$tanggal;
        unset($_SESSION['colateral']['summery_pending']);
        $db_function->exec("delete summery_pending where tanggal='$tanggal'");
        foreach($data as $row){
            if(intval($row['jumlah'])!=0){
                $db_function->exec("insert into summery_pending values('".$row['tanggal']."',
                '".$row['lnc']."',
                '".$row['jenis']."',
                '".$row['jumlah']."')");
            }
            
        }
        header("location:col_sumPending.php?jns_pencarian=point&tgl_point=".$tanggal);
        
        exit;   
    }
    $dataLNC=$db_function->selectAllRows("select UPPER(singkatan) singkatan from master_cab order by singkatan asc");
    
    if($_GET['jns_pencarian']=="saat_ini"){
        $setTgl=date("Y-m-d");
        $sql="select LNC as lnc,count(LNC) as jml from debitur where 1=1 :paramwhere: group by LNC";
        $sqlBPKB= str_replace(":paramwhere:", "and no_bpkb='PENDING' ", $sql);
        $sqlAJB= str_replace(":paramwhere:", "and no_ajb='PENDING' ", $sql);
        $sqlSHT= str_replace(":paramwhere:", "and no_pengikatan='PENDING' ", $sql);
        $sqlPolisAssJiwa= str_replace(":paramwhere:", "and no_polis_ass_jiwa='PENDING' ", $sql);
        $sqlPolisAssRugi= str_replace(":paramwhere:", "and no_polis_ass_kerugian='PENDING' ", $sql);
        $sqlTotalDebitur= str_replace(":paramwhere:", "and status_rekg='AKTIF' ", $sql);
                
        $countBPKB       =  pecahData($db_function->selectAllRows($sqlBPKB));
        $countAJB        =  pecahData($db_function->selectAllRows($sqlAJB));
        $countSHT        =  pecahData($db_function->selectAllRows($sqlSHT));
        $countAssJiwa    =  pecahData($db_function->selectAllRows($sqlPolisAssJiwa));
        $countKerugian   =  pecahData($db_function->selectAllRows($sqlPolisAssRugi));   
        $countTotalDebitur   =  pecahData($db_function->selectAllRows($sqlTotalDebitur));   
        $showtable=true;
        
        
        
 
    }
    else if($_GET['jns_pencarian']=="tgl"){
       
        if(!empty($_POST['frm']['tgl_update'])){
            
            $setTgl= balikTgl($_POST["frm"]['tgl_update']);
            $tgl_update=  balikTgl($_POST["frm"]['tgl_update'])." 23:59:59";    
            $sql="select trail.LNC as lnc,count(trail.LNC) as jml from debitur_trail trail 
            join (select max(tgl_update) tgl_update,no_rekg_pinjaman from debitur_trail where tgl_update <= '$tgl_update'  group by no_rekg_pinjaman) bb
            on trail.no_rekg_pinjaman=bb.no_rekg_pinjaman and trail.tgl_update=bb.tgl_update
            where 1=1 :paramwhere: group by trail.lnc";

            $sqlBPKB= str_replace(":paramwhere:", "and trail.no_bpkb='PENDING' ", $sql);
            $sqlAJB= str_replace(":paramwhere:", "and trail.no_ajb='PENDING' ", $sql);
            $sqlSHT= str_replace(":paramwhere:", "and trail.no_pengikatan='PENDING' ", $sql);
            $sqlPolisAssJiwa= str_replace(":paramwhere:", "and trail.no_polis_ass_jiwa='PENDING' ", $sql);
            $sqlPolisAssRugi= str_replace(":paramwhere:", "and trail.no_polis_ass_kerugian='PENDING' ", $sql);
            $sqlTotalDebitur= str_replace(":paramwhere:", "and trail.status_rekg='AKTIF' ", $sql);
           
           
          //  echo "test->".$sqlAJB;exit;

            $countBPKB       =  pecahData($db_function->selectAllRows($sqlBPKB));
            $countAJB        =  pecahData($db_function->selectAllRows($sqlAJB));
            $countSHT        =  pecahData($db_function->selectAllRows($sqlSHT));
            $countAssJiwa    =  pecahData($db_function->selectAllRows($sqlPolisAssJiwa));
            $countKerugian   =  pecahData($db_function->selectAllRows($sqlPolisAssRugi));
            
            $countTotalDebitur =  pecahData($db_function->selectAllRows($sqlTotalDebitur));
         // print_r($dataAJB);
             $showtable=true;
           
           
        }
    }
    else if($_GET['jns_pencarian']=="point"){
        
        $data=$db_function->selectAllRows("select distinct tanggal from summery_pending order by tanggal desc");
        if(!empty($data))
        foreach($data as $row){
            $ddl_tglpoint[$row['tanggal']]=  balikTgl($row['tanggal']);
        }
        $tgl_point="";
        if(isset($_GET['tgl_point'])){
            $tgl_point=$_GET['tgl_point'];
            $setTgl=$tgl_point;
            $_POST['frm']['tgl_point']=$tgl_point;
             
            $dataCount=array();
            $data=$db_function->selectAllRows("select * from summery_pending where tanggal='".$tgl_point."'");
            if(!empty($data))
            foreach($data as $row){
                $dataCount[$row['jenis']][strtoupper($row['lnc'])]=$row['jumlah']; 
            }
            
            $countBPKB       =  $dataCount['bpkb'];
            $countAJB        =  $dataCount['ajb'];
            $countSHT        =  $dataCount['sht'];
            $countAssJiwa    =  $dataCount['ass_jiwa'];
            $countKerugian   =  $dataCount['kerugian'];
            
            $countTotalDebitur =  $dataCount['total_debitur'];
            
            if($tgl_point==""){
                $showtable=false;
            }else{
                $showtable=true;
            }
            
        }
        
        
      
   
    }
        
    
    
   
    
}
 function pecahData($dtSql){
   
        $data=array();
        foreach ($dtSql as $row){
            $data[strtoupper($row['lnc'])]=$row['jml'];
        }
       
        return $data;
    }
?>
