<?php
$to = "dicky_garkiyadi@yahoo.com";
$subject = "Coba-coba kirim email";
$isi = "Halo, apakabar ? sekarang kamu lagi sibuk apa? <b>balas</b>";
 
if (mail "sendmail_from : Teten" ($to, $subject, $isi)) 
{
	echo("<b>Pesan terkirim</b>");
} 
else 
{
	echo("<i>terjadi kesalahan, email tidak terkirim</i>");
}
 
?> 
 