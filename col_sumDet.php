<?php
include 'collateral_script/session_head.php';
include 'collateral_script/function.php';
include 'collateral_script/db_function.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'collateral_script/head.php'; ?>  

        <script>
            $(document).ready(function() {
                
                getColumnIndexByName = function(grid,columnName) {
                    var cm = grid.jqGrid('getGridParam','colModel');
                    for (var i=0,l=cm.length; i<l; i++) {
                        if (cm[i].name===columnName) {
                            return i; // return the index
                        }
                    }
                    return -1;
                }
                
                         jQuery("#gridTbl").jqGrid({
                url: 'col_json.php?mod=json_sumDet&tgl=<?=$_GET['tgl']?>&lnc=<?=$_GET['lnc']?>&jns=<?=$_GET['jns']?>',
                datatype: "json",
                colNames: ['NO. APLIKASI', 'NAMA DEBITUR', 'NO. REK. PINJAMAN', 'JENIS PRODUK', 'TGL. PK',
                    'NO. BPKB', 'NO. SHT','NO. POLIS JW','NO. POLIS KERUGIAN','TGL. ACTION','',''
                ],
                colModel: [{
                    name: 'noaplikasi',
                    index: 'noaplikasi',
                    width: 100, 
                    sortable: false
                }, {
                    name: 'namadebitur',
                    index: 'namadebitur',
                    width: 100, 
                    sortable: false
                }, {
                    name: 'no_rekg_pinjaman',
                    index: 'no_rekg_pinjaman',
                    width: 100, 
                    sortable: false
                }, {
                    name: 'produk',
                    index: 'produk',
                    width: 100, 
                    sortable: false
                }, {
                    name: 'tgl_pk',
                    index: 'tgl_pk',
                    width: 70,
                    sortable: false
                   
                }, {
                    name: 'no_bpkb',
                    index: 'no_bpkb',
                    width: 100, 
                    sortable: false
                },{
                    name: 'no_pengikatan',
                    index: 'no_pengikatan',
                    width: 100, 
                    sortable: false
                },{
                    name: 'no_polis_ass_jiwa',
                    index: 'no_polis_ass_jiwa',
                    width: 100, 
                    sortable: false
                    
                },{
                    name: 'no_polis_ass_kerugian',
                    index: 'no_polis_ass_kerugian',
                    width: 100,
                   sortable: false
                }, {
                    name: 'tgl_update',
                    index: 'tgl_update',
                    width: 70  , 
                    sortable: false                  
               
                }, {
                    name: 'no_trail',
                    index: 'no_trail',
                     hidden: true, 
                     sortable: false
                    
                },
                {name: 'showdet', width:'16',  sortable:false,align:'center',
                        formatter:function(){
                           return "<img border='0' style='cursor:pointer'  src='images/view_icon.png' />"
                      }
                }
                ],
                rowNum: 10,
                rowList: [10, 20, 30],
                pager: '#gridPager',
                
                viewrecords: true,
                sortable: false,
                shrinkToFit: true,
                caption: "Detail",
                height:220,
                
                beforeSelectRow:function (rowid, e) {
              
                var iCol = $.jgrid.getCellIndex(e.target);
                no_rekg_pinjaman=$("#gridTbl").jqGrid('getCell',rowid,'no_rekg_pinjaman');
                no_trail=$("#gridTbl").jqGrid('getCell',rowid,'no_trail');
                
                
                
                 if (iCol ==getColumnIndexByName($("#gridTbl"),'showdet')) {  
                        
                      $(location).attr('href',"col_trail.php?id="+no_rekg_pinjaman+"&no_trail="+no_trail);
                        
                       
                    }
                return true;
                }
            });
            $("#gridTbl").jqGrid('navGrid', '#gridPager', {
                edit: false,
                add: false,
                del: false,
                search:false
            });
            
            $("#gridTbl").jqGrid('setGridParam', { 'serializeGridData':refreshOnBeforeRequest });
            
            function refreshOnBeforeRequest (postData) {
               
                          
                
                var newPostData = $.extend(postData, {
                    'searchBy': $("#searchBy").val(),
                    'searchValue': $("#searchValue").val()
                  
                });
                
                return $.param(newPostData);
            };
            
            $("#btnFilter").click(function (e) {
                 $("#gridTbl").trigger("reloadGrid", [{page:1}]);     
            });
           
            
            });
        </script>
    </head>
    <body>           
        <div style="margin:0px 50px;text-align: left;">
            <h1 class="judulfrm">Detail <?=$_GET["jenis"]?></h1>
            
            <table style="margin:5px;">
                <tr><td width="200px">Per Tanggal</td><td width="5px">:</td><td><?=  balikTgl($_GET["tgl"])?></td></tr>
                <tr><td>LNC</td><td>:</td><td><?=$_GET["lnc"]?></td></tr>
                <tr><td>
                        <select id="searchBy" style="width:150px">
                            <option value="noaplikasi">No Aplikasi</option>
                            <option value="namadebitur">Nama Debitur</option>
                            <option value="no_rekg_pinjaman">No Rek Pinjaman</option>
                            
                        </select>
                        
                    </td><td>:</td><td>
                        <input  id="searchValue"/>
                        <button id="btnFilter">Filter</button>
                        
                    </td></tr>
                <tr>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
            </table>
            
            <table id="gridTbl"></table>
            <div id="gridPager"></div>
        </div>
    </body>
</html>