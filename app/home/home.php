<?php
require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
if(!isset($_COOKIE['userId'])){
	header('Location: '.\App::getHome());
	exit();
}
$userId = $_COOKIE['userId'];
$etatCompte = $_COOKIE['etatCompte'];
$login = $_COOKIE['login'];
$profil = $_COOKIE['profil'];
$status = $_COOKIE['status'];
$codeUsine = $_COOKIE['codeUsine'];
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
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits en stock
                        </h4>
                        <div class="col-md-12 column">
                          <a id="MNU_IMPRIMER" class="btn btn-primary btn-sm" style="float: left; margin-top: -5%;margin-left: 86%"><i
						     class="ace-icon fa fa-plus-square"></i> Imprimer</a> 
						 </div>
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
                            
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            
                            <div id="STAT_ADMIN">
                                <div id="piechart-placeholder"></div>

                                <div class="hr hr8 hr-double"></div>

                                <div class="clearfix" id="NB_STATS">

                                </div>    
                            </div>
<!--                            <div id="STAT_OTHER" class="hide" data-width="300"  >
                                <div id="STAT_PRODUIT" ></div>
 
                            </div>-->
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.colz -->
        </div><!-- /.row -->
    </div>
    
    <script type="text/javascript">
            jQuery(function ($) {
            var oTableStock= null;
//            if("<?php echo $profil ?>" === "admin") {
//                $('#STAT_OTHER').addClass("hide");
//                $('#STAT_ADMIN').removeClass("hide");
//                $('#STAT_ADMIN').addClass("show");
//            }
//            else {
//                $('#STAT_ADMIN').addClass("hide");
//                $('#STAT_OTHER').removeClass("hide");
//                $('#STAT_OTHER').addClass("show");
//            }
           loadStocks = function() {
             rowCount = 0;
            var url;
            url = '<?php echo App::getBoPath(); ?>/stock/StockController.php';
            if (oTableStock != null)
                oTableStock.fnDestroy();
            oTableStock = $('#LIST_STOCKS').dataTable({
               
               "aoColumnDefs": [{
                        "aTargets": [2],
                        "bSortable": false,
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).css('text-align', 'center');
                        },
                        "mRender": function(data, type, full) {
                            var src="";
                            if(parseFloat(full[1]) < parseFloat(full[2])){
                                src+= '<td><span class="label label-danger arrowed">seuil atteint</span></td>';
                            } else{
                               src+= '<td><span class="label label-success arrowed-in arrowed-in-right">disponible</span></td>'; 
                           }
                            return src;
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
                    aoData.push({"name": "codeUsine", "value": "<?php echo $codeUsine?>"});
                    aoData.push({"name": "login","value": "<?php echo $login?>"});
                    if("<?php echo $profil?>" == "admin" || "<?php echo $profil?>" == "directeur" )
                        aoData.push({"name": "profil", "value": "<?php echo $profil?>"});
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
        

            loadStocks();
            //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'100%' , 'min-height':'150px'});
//			  var data = [
//				{ label: "Dakar",  data: 40, color: "#68BC31"},
//				{ label: "Rufisque",  data: 25, color: "#2091CF"},
//				{ label: "Yarah",  data: 15, color: "#AF4E96"},
//				{ label: "St Louis",  data: 20, color: "#FEE074"},
//// 				{ label: "other",  data: 10, color: "#FEE074"}
//			  ]
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
			// drawPieChart(placeholder, data)

			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			// placeholder.data('chart', data);
			// placeholder.data('draw', drawPieChart);
                       loadStatsFamille = function(familleId,codeUsine, login){
                           $.post("<?php echo App::getBoPath(); ?>/stock/StockController.php", {userId:"<?php echo $userId;?>", familleId:familleId,login:login,codeUsine:codeUsine, ACTION: "<?php echo App::ACTION_STAT_FAMILLE; ?>"}, function(data) {
                             data = $.parseJSON(data);
                    if(data.rc==-1){
                        $.gritter.add({
                                title: 'Notification',
                                text: data.error,
                                class_name: 'gritter-error gritter-light'
                            });
                    }else {
                        var head = [];
                        var value = [];
                        $.each(data, function(idx, obj) {
                                head.push(obj.libelle);
                                value.push(obj.nbStocks);
                        });
                        
                            $("#STAT_OTHER").jChart({
                              name: "Famille SOMPATE",
                              headers: head,
                              values: value,
                              footers: [100000,200000,300000,400000,500000],
                              colors: ["#1000ff","#006eff","#00b6ff","#00fff6","#00ff90"]

                              });
                               }
                       
                            }).error(function(error) { alert("failure"); });;
                        };

        loadStats = function(codeUsine, login)
            {
              var map = [];
              var color = '';
                $.post("<?php echo App::getBoPath(); ?>/stock/StockController.php", {userId:"<?php echo $userId;?>",login: login,codeUsine:codeUsine, ACTION: "<?php echo App::ACTION_STAT; ?>"}, function(data) {
                 data = $.parseJSON(data);
                    if(data.rc==-1){
                        $.gritter.add({
                                title: 'Notification',
                                text: data.error,
                                class_name: 'gritter-error gritter-light'
                            });
                    }else {
                        var dataUsine='';
                        $('#NB_STATS').empty();
                        $.each(data, function () {
                            map.push({label: this.nomUsine, data: this.nbStocks, color: this.couleur, operator: this.nomUsine});
                            dataUsine += '{"value":"'+this.nomUsine+'","text":"'+this.nomUsine+'"},';
                            $('#NB_STATS').append(' <div class="grid3"> <span class="grey"><i class="icon-user"></i><small>&nbsp; '+this.nomUsine+'</span><span  class="bigger pull-right" >'+this.nbStocks+'</small> </span>   </div>');

                        });
                        dataUsine = dataUsine.substr(0, dataUsine.length-1);
                        dataUsine ='['+dataUsine+']';
                        drawPieChart(placeholder, map);

                    }
                       
                    }).error(function(error) { alert("failure"); });;
            };
			if("<?php echo $profil ?>" === "admin" || "<?php echo $login?>" === "directeur" ) {
                            loadStats("*","<?php echo $login?>");
                        }
                        else 
                             loadStats("<?php echo $codeUsine?>","<?php echo $login?>");
                           // loadStatsFamille($("#GRP_CMB").val(),"<?php echo $codeUsine?>","<?php echo $login?>");
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

			   $("#MNU_IMPRIMER").click(function()
				   {
				   window.open('<?php echo App::getHome(); ?>/app/pdf/stockGlobalPdf.php','nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');
				   });

            });
        </script>