<?
session_start();
if (session_is_registered("user"))
{
session_destroy();
}
echo "<br>Terima kasih atas kunjungan anda.....! ";

?>