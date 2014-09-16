<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('max_execution_time', 0);

$sql="select lnc,count(tgl_cair_tahap_fondasi) from debitur where progress='BELUM SELESAI' and skim_pencairan='PARTIAL DROW DOWN' ".
     "and skim_pks in('KAVLING BANGUN','INDENT') and tgl_cair_tahap_fondasi not in(null,'','0000-00-00')";
?>
