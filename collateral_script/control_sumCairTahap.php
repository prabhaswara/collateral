<?php

ini_set('max_execution_time', 0);

$showtable=false;
$ddl_tglpoint=array();
$setTgl="";

if(empty($_GET["jns_pencarian"])){
    header("location:col_sumCairTahap.php?jns_pencarian=tgl");exit;
}
$_POST['frm']['jns_pencarian']=$_GET['jns_pencarian'];
if(!empty($_POST)){
    
    $db_function = new db_function();
    
    if(strtolower( $_POST['action'])=="simpan point"){
        
        $data=$_SESSION['colateral']['summery_bertahap'];
        $tanggal=$data[0]['tanggal'];
        $setTgl=$tanggal;
        unset($_SESSION['colateral']['summery_bertahap']);
        $db_function->exec("delete summery_bertahap where tanggal='$tanggal'");
        foreach($data as $row){
            if(intval($row['jumlah'])!=0){
                $db_function->exec("insert into summery_bertahap values('".$row['tanggal']."',
                '".$row['lnc']."',
                '".$row['jenis']."',
                '".$row['jumlah']."')");
            }
            
        }
        header("location:col_sumCairTahap.php?jns_pencarian=point&tgl_point=".$tanggal);
        
        exit;   
    }
    $dataLNC=$db_function->selectAllRows("select UPPER(singkatan) singkatan from master_cab order by singkatan asc");
    
    if($_GET['jns_pencarian']=="saat_ini"){
			
		$sql="select lnc,count(tgl_cair_tahap_fondasi)jml from debitur where  skim_pencairan='PARTIAL DROW DOWN' ".
			 "and skim_pks in('KAVLING BANGUN','INDENT') and progress <> '' group by lnc";
		$countDebitur =  pecahData($db_function->selectAllRows($sql));

		$sql="select lnc,count(tgl_cair_tahap_fondasi)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
			 "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_fondasi  in(null,'','0000-00-00') group by lnc";

		$countFondasi  =  pecahData($db_function->selectAllRows($sql));

		$sql="select lnc,count(tgl_cair_tahap_topping)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
			 "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_fondasi >'0000-00-00' and tgl_cair_tahap_topping in(null,'','0000-00-00') group by lnc";
		$countTopping  =  pecahData($db_function->selectAllRows($sql));

		$sql="select lnc,count(tgl_cair_tahap_bast)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
			 "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_topping >'0000-00-00' and tgl_cair_tahap_bast in(null,'','0000-00-00') group by lnc";
		$countBast  =  pecahData($db_function->selectAllRows($sql));

		$sql="select lnc,count(tgl_cair_tahap_dok)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
			 "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_bast >'0000-00-00' and tgl_cair_tahap_dok in(null,'','0000-00-00') group by lnc";
		$countTahapDok  =  pecahData($db_function->selectAllRows($sql));

		$sql="select lnc,count(tgl_cair_tahap_dok)jml from debitur where progress='SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
			 "and skim_pks in('KAVLING BANGUN','INDENT')  group by lnc";
		$countSelesai  =  pecahData($db_function->selectAllRows($sql));
		
	  
    
        $showtable=true;     

    }
    else if($_GET['jns_pencarian']=="tgl"){
       
        $tgl_update=  balikTgl($_POST["frm"]['tgl_update'])." 23:59:59"; 
        if(!empty($_POST['frm']['tgl_update'])){
         $sql="select trail.LNC as lnc,count(trail.LNC) as jml from debitur join debitur_trail trail on debitur.no_rekg_pinjaman=trail.no_rekg_pinjaman
            join (
            select max(tgl_update) tgl_update,no_rekg_pinjaman from debitur_trail where tgl_update <= '$tgl_update'  group by no_rekg_pinjaman) bb
            on trail.no_rekg_pinjaman=bb.no_rekg_pinjaman and trail.tgl_update=bb.tgl_update
            where 1=1 :paramwhere: group by trail.lnc";

		
		$sqlDebitur= str_replace(":paramwhere:", "and trail.skim_pencairan='PARTIAL DROW DOWN' and trail.skim_pks in('KAVLING BANGUN','INDENT') and trail.progress <>'' ", $sql);
        $sqlFondasi= str_replace(":paramwhere:", "and trail.progress='BELUM SELESAI' and trail.skim_pencairan='PARTIAL DROW DOWN' and trail.skim_pks in('KAVLING BANGUN','INDENT') and trail.tgl_cair_tahap_fondasi  in(null,'','0000-00-00') ", $sql);
        $sqlTopping= str_replace(":paramwhere:", "and trail.progress='BELUM SELESAI' and trail.skim_pencairan='PARTIAL DROW DOWN' and trail.skim_pks in('KAVLING BANGUN','INDENT') and trail.tgl_cair_tahap_fondasi >'0000-00-00' and trail.tgl_cair_tahap_topping in(null,'','0000-00-00') ", $sql);
        $sqlBast= str_replace(":paramwhere:", "and trail.progress='BELUM SELESAI' and trail.skim_pencairan='PARTIAL DROW DOWN' and trail.skim_pks in('KAVLING BANGUN','INDENT') and trail.tgl_cair_tahap_topping >'0000-00-00' and trail.tgl_cair_tahap_bast in(null,'','0000-00-00') ", $sql);
		$sqlTahapDok= str_replace(":paramwhere:","and trail.progress='BELUM SELESAI' and trail.skim_pencairan='PARTIAL DROW DOWN' and trail.skim_pks in('KAVLING BANGUN','INDENT') and trail.tgl_cair_tahap_bast >'0000-00-00' and trail.tgl_cair_tahap_dok in(null,'','0000-00-00') ", $sql);
		$sqlSelesai= str_replace(":paramwhere:", "and trail.progress='SELESAI' and trail.skim_pencairan='PARTIAL DROW DOWN' and trail.skim_pks in('KAVLING BANGUN','INDENT') ", $sql);
			
		
		
		$countDebitur =  pecahData($db_function->selectAllRows($sqlDebitur));	
		$countFondasi  =  pecahData($db_function->selectAllRows($sqlFondasi));
		$countTopping  =  pecahData($db_function->selectAllRows($sqlTopping));
		$countBast  =  pecahData($db_function->selectAllRows($sqlBast));
		$countTahapDok  =  pecahData($db_function->selectAllRows($sqlTahapDok));		
		$countSelesai  =  pecahData($db_function->selectAllRows($sqlSelesai));	
       
           
            $showtable=true;
        }
    }
    else if($_GET['jns_pencarian']=="point"){
        
        $data=$db_function->selectAllRows("select distinct tanggal from summery_bertahap order by tanggal desc");
        if(!empty($data))
        foreach($data as $row){
            $ddl_tglpoint[$row['tanggal']]=  balikTgl($row['tanggal']);
        }
        $tgl_point="";
        if(isset($_GET['tgl_point'])){
            $tgl_point=$_GET['tgl_point'];
            $_POST['frm']['tgl_point']=$tgl_point;	   			
		
			$countDebitur =  $dataCount['debitur'];
			$countFondasi  =  $dataCount['fondasi'];
			$countTopping  =  $dataCount['topping'];
			$countBast  =  $dataCount['bast'];
			$countTahapDok  =  $dataCount['tahapdok'];
			$countSelesai  =  $dataCount['selesai'];           
         
        
            if($tgl_point==""){
                $showtable=false;
            }else{
                $showtable=true;
            }
            
        }
        
        
      
   
    }
    
}
$dataLNC=$db_function->selectAllRows("select UPPER(singkatan) singkatan from master_cab order by singkatan asc");

 function pecahData($dtSql){
   
        $data=array();
        foreach ($dtSql as $row){
            $data[strtoupper($row['lnc'])]=$row['jml'];
        }
       
        return $data;
    }
    
/*
ini_set('max_execution_time', 0);

$db_function=new db_function();

$sql="select lnc,count(tgl_cair_tahap_fondasi)jml from debitur where  skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and progress <> '' group by lnc";
$countDebitur =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_fondasi)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_fondasi  in(null,'','0000-00-00') group by lnc";

$countFondasi  =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_topping)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_fondasi >'0000-00-00' and tgl_cair_tahap_topping in(null,'','0000-00-00') group by lnc";
$countTopping  =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_bast)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_topping >'0000-00-00' and tgl_cair_tahap_bast in(null,'','0000-00-00') group by lnc";
$countBast  =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_dok)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_bast >'0000-00-00' and tgl_cair_tahap_dok in(null,'','0000-00-00') group by lnc";
$countTahapDok  =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_dok)jml from debitur where progress='SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT')  group by lnc";
$countSelesai  =  pecahData($db_function->selectAllRows($sql));


$dataLNC=$db_function->selectAllRows("select UPPER(singkatan) singkatan from master_cab order by singkatan asc");
    

 function pecahData($dtSql){
        $data=array();
        foreach ($dtSql as $row){
            $data[strtoupper($row['lnc'])]=$row['jml'];            
        }
        return $data;
}
*/
?>

