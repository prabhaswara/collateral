<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CONTOH SCRIPT NOMINAL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language=”javascript” src=”ri32-fungsi.js”></script>

<script>
    function kurensi(nilai)
    {
    bk = nilai.replace(/[^\d]/g,”");
    ck = “”;
    panjangk = bk.length;
    j = 0;
    for (i = panjangk; i > 0; i–)
    {
    j = j + 1;
    if (((j % 3) == 1) && (j != 1))
    {
    ck = bk.substr(i-1,1) + “.” + ck;
    xk = bk;
    }
    else
    {
    ck = bk.substr(i-1,1) + ck;
    xk = bk;
    }
    }
    return ck;
    }

    function ri32()
    {
    ttm = document.getElementById( ‘postform’ ).elements['jumlah_transaksi'].value;
    strtt= ttm.toString();
    kttm = kurensi(strtt);

    document.getElementById( ‘postform’ ).elements['jumlah_transaksi'].value = kttm;
    }
</script>



    <?php
    if(isset($_POST['submit'])){
    $nilai=str_replace('.','',$_POST['jumlah_transaksi']);
    echo "Nilai Sebenarnya : ".$nilai;
    }else{
    unset($_POST['submit']);
    }
    ?>

    <html>
    <head>
    <title>Ri32 Community</title>
	
    <script language=”javascript” src=”ri32-fungsi.js”></script>

    </head>
    <body onLoad=”document.postform.elements['jumlah_transaksi'].focus();”>

    <form id="postform" name="postform" method="post" action="nominal.php">
    <input style="text-align:right"; name="jumlah_transaksi" onKeyup="ri32();" value=0>
    <input type=submit name=submit value=Kirim>
    </form>

    </body>
    </html>