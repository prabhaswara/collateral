<?php

function inputnya($name, $atribut = "", $type = "text"){
    $value = cleanstr($_POST[$name]);    
    $value = in_array($value, array(null,""))?$_GET[$name]:$value;
  
    return "<input type='$type' id='$name' name='$name' $atribut value='$value' />";
}
function selectnya($name,$options){
    
    $value = cleanstr($_POST[$name]);    
    $value = in_array($value, array(null,""))?$_GET[$name]:$value;
    
    $return = "<select id='$name' name='$name' $atribut>";    
   
    $return.="<option value='all'>- All -</option>";

    if (!empty($options))
        foreach ($options as $optVal => $optName) {
            $selected = ($optVal == $value) ? "selected='selected'" : "";
            $return.=
                    "<option value='$optVal' $selected >$optName</option>";
        }

    $return.=
            "</select>";

    return $return;
}
function selectLNC($name){
    $db_function=new db_function();
    
    $options=array();
    $data = $db_function->selectAllRows("select singkatan from master_cab order by singkatan asc");
    foreach ($data as $row) {
        $options[$row["singkatan"]] = $row["singkatan"];
    }

    $value = cleanstr($_POST[$name]);    
    $value = in_array($value, array(null,""))?$_GET[$name]:$value;
    
    $return = "<select id='$name' name='$name' $atribut>";    
   
    $return.="<option value='all'>- All -</option>";

    if (!empty($options))
        foreach ($options as $optVal => $optName) {
            $selected = ($optVal == $value) ? "selected='selected'" : "";
            $return.=
                    "<option value='$optVal' $selected >$optName</option>";
        }

    $return.=
            "</select>";

    return $return;
}

function numsep($number){
    return number_format($number,0,",",".");
}

function ht_input($name, $atribut = "", $type = "text") {

    
    $value = cleanstr($_POST['frm'][$name]);
    return "<input type='$type' id='$name' name='frm[$name]' $atribut value='$value' />";
}
function ht_textarea($name, $atribut = "") {   
    $value = cleanstr($_POST['frm'][$name]);
    return "<textarea id='$name' name='frm[$name]' $atribut>$value</textarea>";
}
function ht_select($name, $options, $atribut="", $pilih = true) {

    
    $value = cleanstr($_POST['frm'][$name]);
    
    
    $return = "<select id='$name' name='frm[$name]' $atribut>";

    if ($pilih)
        $return.="<option value=''>--pilih--</option>";

    if (!empty($options))
        foreach ($options as $optVal => $optName) {
            $selected = ($optVal == $value) ? "selected='selected'" : "";
            $return.=
                    "<option value='$optVal' $selected >$optName</option>";
        }

    $return.=
            "</select>";

    return $return;
}

function cleanstr($str) {
    return ($str == null) ? "" : trim($str);
}
function cleanNumber($str) {
    return ($str == null ||$str=="") ? "0" : trim($str);
}

function showMessage($messages, $type = "error",$id="") {//error success warning notice
    $print_msg = "";
    $showBox=false;
    if(is_array($messages))    {
        
        if (is_array($messages) && count($messages) > 1) {

            $print_msg = "<ul>";
            foreach ($messages as $message) {
                $print_msg.="<li>$message</li>";
            }
            $print_msg.="</ul>";
        }

        if (is_array($messages) && count($messages) == 1) {

            $print_msg = $messages[0];
        }
       
        if ($print_msg != "" && !empty($print_msg)) {
            $showBox=true;
        }
    }
    else if($messages!="" ){
         $showBox=true;
         $print_msg=$messages;
    }
    $box = $showBox?"<div id='alert-box$id' class='alert-box $type'><span>$type: </span> <img src='images/delete.png' class='close_box' id='close_box$id' /> <div>$print_msg </div>  </div>":"";

    return $box;
}
function isDate($date){//dd/MM/yyyy with leap years 100% integrated Valid years : from 1600 to 9999 
    $date=  str_replace("-", "/", $date);
  return 1 === preg_match(
    '~^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~',
    $date); 
}

function isDateDB($date){
    return 1 ===( preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date) ) ;  
    
}
function balikTgl($tgl){
    return implode("-", array_reverse(explode("-", $tgl)) );
}
function cleanDate($tgl){
    return in_array($tgl, array("00-00-0000","0000-00-00"))?"":$tgl;
}
function balikTglDate($tgl,$jam=false){
    $pecah=  explode(" ",$tgl);
    
    return implode("-", array_reverse(explode("-", $pecah[0])) ).($jam?" ".$pecah[1]:"");
}
?>