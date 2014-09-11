

<script type="text/javascript" src="js/jqGrid/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.3.1.js"></script>
<script type="text/javascript" src="js/kendo/js/kendo.all.min.js"></script>
<script type="text/javascript" src="js/kendo/js/kendo.culture.id-ID.min.js"></script>
<script type='text/javascript' src='js/jqGrid/js/i18n/grid.locale-en.js'></script>
<script type="text/javascript" src="js/jqGrid/js/jquery.jqGrid.min.js"></script>

<link rel="stylesheet" href="style/collateral.css" />
<link rel="stylesheet" href="style/notification/box.css" />
<link rel="stylesheet" href="js/jquery-ui/jquery-ui.min.css" />
<link rel="stylesheet" href="js/kendo/css/kendo.common.min.css" />
<link rel="stylesheet" href="js/kendo/css/kendo.default.min.css" />

<link rel="stylesheet" href="js/jqGrid/css/ui.jqgrid.css" />

<style>
    input.ui-pg-input{
        width: auto;
    }
    select.ui-pg-selbox{
         width: auto;
    }
</style>
<script>

    $(document).ready(function() {
        $("input[type=submit],input[type=reset], button,.classbtn").button();
        
        $('.dateBack').datepicker({dateFormat:'dd-mm-yy',changeMonth: true,changeYear: true,yearRange: "-100:+0"});				
        $('.dateNormal').datepicker({dateFormat:'dd-mm-yy',changeMonth: true,changeYear: true});				
        $('.dateMask').mask('99-99-9999');
        $('.tooltip').tooltip();
        $(".searchbtn").button({icons: {
                primary: "ui-icon-locked"
            }});
        
         $(".kendorupiah").width(255).kendoNumericTextBox({
             culture: "id-ID",format: "c0",min:0             
        });
        $(".kendonumber").width(255).kendoNumericTextBox({
             culture: "id-ID",format: "n0"  ,min:0           
        });
        
        $(".kendonumberNoDes").width(255).kendoNumericTextBox({
            format: "#",min:0             
        });

    });
</script>
