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
    header("location:col_sumLegalitas.php?jns_pencarian=tgl");exit;
}
$_POST['frm']['jns_pencarian']=$_GET['jns_pencarian'];
if(!empty($_POST)){
    
    $db_function = new db_function();
    
    if(strtolower( $_POST['action'])=="simpan point"){
        
        $data=$_SESSION['colateral']['summery_legal'];
        $tanggal=$data[0]['tanggal'];
        $setTgl=$tanggal;
        unset($_SESSION['colateral']['summery_legal']);
        $db_function->exec("delete summery_legal where tanggal='$tanggal'");
        foreach($data as $row){
            if(intval($row['jumlah'])!=0){
                $db_function->exec("insert into summery_legal values('".$row['tanggal']."',
                '".$row['lnc']."',
                '".$row['jenis']."',
                '".$row['jumlah']."')");
            }
            
        }
        header("location:col_sumLegalitas.php?jns_pencarian=point&tgl_point=".$tanggal);
        
        exit;   
    }
    $dataLNC=$db_function->selectAllRows("select UPPER(singkatan) singkatan from master_cab order by singkatan asc");
    
    if($_GET['jns_pencarian']=="saat_ini"){
        $setTgl=date("Y-m-d");
        $sql="select LNC as lnc,count(LNC) as jml from debitur where 1=1 :paramwhere: group by LNC";
        $sqlIMB= str_replace(":paramwhere:", "and status_imb='PENDING' ", $sql);
        $sqlSIUP= str_replace(":paramwhere:", "and siup='PENDING' ", $sql);
        $sqlTDP= str_replace(":paramwhere:", "and tdp='PENDING' ", $sql);
        $sqlOTHERS= str_replace(":paramwhere:", "and others='PENDING' ", $sql);
         //      echo $sqlIMB;
        $countIMB       =  pecahData($db_function->selectAllRows($sqlIMB));
        $countSIUP        =  pecahData($db_function->selectAllRows($sqlSIUP));
        $countTDP        =  pecahData($db_function->selectAllRows($sqlTDP));
        $countOTHERS    =  pecahData($db_function->selectAllRows($sqlOTHERS));
    
        $showtable=true;
        
        
        
 
    }
    else if($_GET['jns_pencarian']=="tgl"){
       
        if(!empty($_POST['frm']['tgl_update'])){
            
       
            $tgl_update=  balikTgl($_POST["frm"]['tgl_update'])." 23:59:59"; 
            $setTgl= balikTgl($_POST["frm"]['tgl_update']);
            $sql="select trail.LNC as lnc,count(trail.LNC) as jml from debitur join debitur_trail trail on debitur.no_rekg_pinjaman=trail.no_rekg_pinjaman
            join (
            select max(tgl_update) tgl_update,no_rekg_pinjaman from debitur_trail where tgl_update <= '$tgl_update'  group by no_rekg_pinjaman) bb
            on trail.no_rekg_pinjaman=bb.no_rekg_pinjaman and trail.tgl_update=bb.tgl_update
            where 1=1 :paramwhere: group by trail.lnc";

            $sqlIMB= str_replace(":paramwhere:", "and trail.no_imb='PENDING' ", $sql);
            $sqlSIUP= str_replace(":paramwhere:", "and trail.siup='PENDING' ", $sql);
            $sqlTDP= str_replace(":paramwhere:", "and trail.tdp='PENDING' ", $sql);
            $sqlOTHERS= str_replace(":paramwhere:", "and trail.others='PENDING' ", $sql);
            
           
          //  echo "test->".$sqlSIUP;exit;

            $countIMB       =  pecahData($db_function->selectAllRows($sqlIMB));
            $countSIUP        =  pecahData($db_function->selectAllRows($sqlSIUP));
            $countTDP        =  pecahData($db_function->selectAllRows($sqlTDP));
            $countOTHERS    =  pecahData($db_function->selectAllRows($sqlOTHERS));
         
         // print_r($dataAJB);
            $showtable=true;
        }
    }
    else if($_GET['jns_pencarian']=="point"){
        
        $data=$db_function->selectAllRows("select distinct tanggal from summery_legal order by tanggal desc");
        if(!empty($data))
        foreach($data as $row){
            $ddl_tglpoint[$row['tanggal']]=  balikTgl($row['tanggal']);
        }
        $tgl_point="";
        if(isset($_GET['tgl_point'])){
            $tgl_point=$_GET['tgl_point'];
            $_POST['frm']['tgl_point']=$tgl_point;
              
            $dataCount=array();
            $data=$db_function->selectAllRows("select * from summery_legal where tanggal='".$tgl_point."'");
            if(!empty($data))
            foreach($data as $row){
                $dataCount[$row['jenis']][strtoupper($row['lnc'])]=$row['jumlah']; 
            }
            
      
            $countIMB       =  $dataCount['imb'];
            $countSIUP        =  $dataCount['siup'];
            $countTDP        =  $dataCount['tdp'];
            $countOTHERS    =  $dataCount['others'];
            
         
        
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
