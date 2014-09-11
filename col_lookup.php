<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
include 'collateral_script/control_lookup.php';
?>   

<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>
            $(document).ready(function() {
                $("#type").change(function() {
                    window.location = "col_lookup.php?type=" + $("#type").val();
                });
            });

        </script>
    </head>
    <body>
    
        <div style="margin:0px 50px;text-align: left;">
                    
                    <h1 class="judulfrm">Parameter</h1>
            <form method="post">
                <table class="tbllayout">
                    <tr><td>Type</td><td><?= ht_select("type", $listTypeLookup) ?></td></tr>
                    <tr><td>Value</td><td><?= ht_input("value") ?></td></tr>         
                    <tr><td>LNC</td><td><?= ht_input("lnc") ?></td></tr>

                </table>
                <input type="Submit" name='action' value="<?= $action ?>" />
                <?php
                if ($action == "Edit") {
                    ?>
                    <input type="Submit" name='action' value="Batal" />
                    <?php
                }
                ?>

            </form>


            <table class="tblLookup" border="1px">
                <thead>
                    <tr>
                        <th width="400px">Value</th><th width="200px">LNC</th><th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listLookup))
                        foreach ($listLookup as $lookup) {
                            ?>
                            <tr>
                                <td><?= $lookup["value"] ?> </td>
                                <td><?= $lookup["lnc"] ?> </td>                    
                                <td>
                                    <a href="col_lookup.php?action=Edit&type=<?= $_GET['type'] ?>&value=<?= $lookup["value"] ?> "> <img src="images/edit.png"/> </a>
                                    <a onclick="return confirm('anda yakin ingin menghapus ?')" href="col_lookup.php?action=delete&type=<?= $_GET['type'] ?>&value=<?= $lookup["value"] ?> "><img src="images/delete.png"/></a>
                                </td>
                            </tr>

                            <?php
                        }
                    ?>
                </tbody>

            </table>
        </div>
   
</body>
</html>