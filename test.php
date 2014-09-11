<?php

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=EXPORTCADS.xls ");
header("Content-Transfer-Encoding: binary ");

$name="gunawan";
$nlen=strlen(name);
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
pack('vCCvvvCCCC', 0x00, 0, $nlen, $sz, 0, $sheetIndex, 0, 0, 0, 0)
			. $name . $formulaData;
echo pack("ss", 0x0A, 0x00);


?>