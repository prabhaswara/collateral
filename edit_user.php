<?php
Include ("koneksi.php");
mysql_select_db("collateral_db");

$edit=mysql_query("SELECT * FROM pegawai WHERE NPP='$_GET[id]'");
$r=mysql_fetch_array($edit);

echo "<h2>Edit User</h2>
<form method=POST action=update_user.php>
<input type=hidden name=id value='$r[NPP]'>

<table>
<tr><td>NPP</td><td> :
<input type=text name=NPP value='$r[NPP]'></td></tr>
<tr><td>PASSWORD</td><td> :
<input type=text name=PASSWORD> *) </td></tr>
<tr><td>NAMA LENGKAP</td>
<td> : <input type=text name=NAMA size=30
value='$r[NAMA]'></td></tr>
<tr><td>Jabatan</td>
<td> : <select name=JABATAN>
    <option>-SELECT-</option>
    <option>PEMIMPIN</option>
    <option>WK PEMIMPIN</option>
    <option>PENYELIA</option>
    <option>ASISTEN</option>
  </select>
</td></tr>
<tr><td>LNC</td>
<td> : <select name=CABANG>
          <option>-SELECT-</option>
          <option>DIVISI CNR</option>
          <option>ALL LNC</option>
          <option>MDL</option>
          <option>PBL</option>
          <option>PLL</option>
          <option>BAL</option>
          <option>SML</option>
          <option>YGL</option>
          <option>SBL</option>
          <option>DPL</option>
          <option>BJL</option>
          <option>MKL</option>
          <option>MNL</option>
          <option>JKL</option>
        </select>
</td></tr>
<tr><td colspan=2>*) Apabila password tidak diubah, 
dikosongkan saja</td></tr>
<tr><td colspan=2><input type=submit value=Update>
<input type=button value=Batal onclick=self.history.back()>
</td></tr>
</table>
</form>";
?>