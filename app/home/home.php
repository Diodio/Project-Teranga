<?php
require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
$userId = 1;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Stock global
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Stock
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="row">
        <div class="space-6"></div>
        <div class="row">
            <div class="col-sm-7">
                <div>
                    
                       <div class="control-group">
                            <div class="controls">
                                <select id="GRP_CMB" style="width: 225px">
                                    <option value="*" class="groups"> Type de produit </option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits en stock
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <table id="LIST_STOCKS" class="table table-bordered table-striped">
                                <thead class="thin-border-bottom">
                                    <tr>
                                        <th>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Produit
                                        </th>

                                        <th>
                                            <i class="ace-icon fa fa-caret-right blue"></i>Stock
                                        </th>

                                        <th class="hidden-480">
                                            <i class="ace-icon fa fa-caret-right blue"></i>Etat
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->




            <div class="vspace-12-sm"></div>

            <div class="col-sm-5">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat widget-header-small">
                        <h5 class="widget-title">
                            <i class="ace-icon fa fa-signal"></i>
                            Stock
                        </h5>

                        <div class="widget-toolbar no-border">
                            <div class="inline dropdown-hover">
                                <button class="btn btn-minier btn-primary">
                                    This Week
                                    <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                    <li class="active">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                            This Week
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Last Week
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            This Month
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Last Month
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div id="piechart-placeholder"></div>

                            <div class="hr hr8 hr-double"></div>

                            <div class="clearfix">
                                <div class="grid3">
                                    <span class="grey">
                                        <i class="ace-icon fa fa-square fa-2x green"></i>
                                       &nbsp; Dakar
                                    </span>
                                    <h4 class="bigger pull-right">1250</h4>
                                </div>

                                <div class="grid3">
                                    <span class="grey">
                                        <i class="ace-icon fa fa-square fa-2x" style="color:#2091CF"></i>
                                         Rufisque
                                    </span>
                                    <h4 class="bigger pull-right">941</h4>
                                </div>

                                <div class="grid3">
                                    <span class="grey">
                                        <i class="ace-icon fa fa-square fa-2x purple"></i>
                                        Yarakh
                                    </span>
                                    <h4 class="bigger pull-right">1050</h4>
                                </div>
                                
                                 <div class="grid3">
                                    <span class="grey">
                                        <i class="ace-icon fa fa-square fa-2x" style="color:#FEE074"></i>
                                        &nbsp; St Louis
                                    </span>
                                    <h4 class="bigger pull-right">600</h4>
                                </div>
                            </div>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    
    <script type="text/javascript">
            jQuery(function ($) {
                
            $("#GRP_CMB").select2();  

           loadStocks = function() {
             rowCount = 0;
            var url;
            url = '<?php echo App::getBoPath(); ?>/produit/ProduitController.php';
            if (oTableProduit != null)
                oTableProduit.fnDestroy();
            oTableProduit = $('#LIST_PRODUITS').dataTable({
               
                "aoColumnDefs": [{
                        "aTargets": [0],
                        "bSortable": false,
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).css('text-align', 'center');
                        },
                        "mRender": function(data, type, full) {
                            return '<label><input type="checkbox" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';
                        }
                    }
                ],
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
//                    
                },
                "fnDrawCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    
                },
                "preDrawCallback": function( settings ) {
                   
                },
                "bProcessing": false,
                "bServerSide": true,
                "sAjaxSource": url,
                "sPaginationType": "full_numbers",
                "fnServerData": function ( sSource, aoData, fnCallback ) {
                        /* Add some extra data to the sender */
                    aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST; ?>"});
                    aoData.push({"name": "familleId", "value": familleId});
                    aoData.push({"name": "offset", "value": "1"});
                    aoData.push({"name": "rowCount", "value": "10"});
                   
                        $.ajax( {
                          "dataType" : 'json',
                          "type" : "POST",
                          "url" : sSource,
                          "data" : aoData,
                          "success" : function(json) {
                              if(json.rc==-1){
                                 $.gritter.add({
                                    title: 'Notification',
                                    text: json.error,
                                    class_name: 'gritter-error gritter-light'
                                });
                              }else{
                                  fnCallback(json); 
                                  nbTotalChecked=json.iTotalRecords;
                              }
                           }
                        });
                    }
            });
        };
        
     //   loadProduit($("#GRP_CMB").val());


    loadFamilleProduit = function(){
            $.post("<?php echo App::getBoPath(); ?>/produit/FamilleProduitController.php", {userId: "<?php echo $userId;?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(data) {
                sData=$.parseJSON(data);
                if(sData.rc==-1){
                    $.gritter.add({
                            title: 'Notification',
                            text: sData.error,
                            class_name: 'gritter-error gritter-light'
                        });
                }else{
                    $("#GRP_CMB").loadJSON('{"groups":' + data + '}');
                }
            });
            }
            loadFamilleProduit();


            //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "Dakar",  data: 40, color: "#68BC31"},
				{ label: "Rufisque",  data: 25, color: "#2091CF"},
				{ label: "Yarah",  data: 15, color: "#AF4E96"},
				{ label: "St Louis",  data: 20, color: "#FEE074"},
// 				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data)

			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });

            });
        </script>