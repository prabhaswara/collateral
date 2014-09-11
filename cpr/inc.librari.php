<?php

function tgl_eng_to_ind($tgl){
  $tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)
      ."-".substr($tgl,0,4);
  return $tgl_ind;
}

function format_angka($angka) {
  $hasil = number_format($angka,0, ',','.');
  return $hasil;
}
?>