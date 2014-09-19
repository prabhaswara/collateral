<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('max_execution_time', 0);

$sql="select lnc,count(tgl_cair_tahap_fondasi)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_fondasi >'0000-00-00' and tgl_cair_tahap_topping in(null,'','0000-00-00')";
$countFondasi  =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_topping)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_topping >'0000-00-00' and tgl_cair_tahap_bast in(null,'','0000-00-00')";
$countTopping  =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_bast)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_bast >'0000-00-00' and tgl_cair_tahap_dok in(null,'','0000-00-00')";
$countBast  =  pecahData($db_function->selectAllRows($sql));

$sql="select lnc,count(tgl_cair_tahap_dok)jml from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_dok >'0000-00-00' ";
$countBast  =  pecahData($db_function->selectAllRows($sql));

 function pecahData($dtSql){
   
        $data=array();
        foreach ($dtSql as $row){
            $data[strtoupper($row['lnc'])]=$row['jml'];
        }
       
        return $data;
    }
?>
