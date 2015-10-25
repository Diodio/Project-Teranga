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
            Gestion des bons d'achat
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des bons d'achat
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="row">
        <div class="space-6"></div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                    <div class="col-lg-1">
                        <div class="btn-group">
                                    <button data-toggle="dropdown"
                                            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
                                            data-rel="tooltip" data-placement="top" title="Famille de produit" style="
                                            height: 32px;
                                            width: 80px;
                                            margin-top: -1px;
                                        ">
                                        <i class="icon-group icon-only icon-on-right"></i> Action
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li id='MNU_GRP_NEW'><a href="#" id="GRP_NEW">Valider </a></li>
                                        <li class="divider"></li>
                                        <li id='MNU_GRP_EDIT'><a href="#" id="GRP_EDIT">Annuler</a></li>
                                        <li id='MNU_GRP_REMOVE'><a href="#" id="GRP_REMOVE">Supprimer</a></li>
                                    </ul>
                                </div>
                    </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des bons d'achat
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_MSG" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th class="center" style="border-left: 0px none;border-right: 0px none;"></th>                               
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Date
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">

                                    Numero Achat
                                </th>

                                <!--<th class="hidden-phone" style="border-left: 0px none;border-right: 0px none;">
                                </th>-->
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="center">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="hidden" id="stag" value="">
                                    <span class="badge badge-transparent tooltip-error" title="Non validé">
                                        <i class="ace-icon fa fa-wrench  bigger-130 orange"></i>
                                    </span>
                                </td>
                                <td>
                                    21/10/2015
                                </td>
                                <td>
                                    0001
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="hidden" id="stag" value="">
                                    <span class="badge badge-transparent tooltip-error" title="Non validé">
                                        <i class="ace-icon fa fa-wrench  bigger-130 orange"></i>
                                    </span>
                                </td>
                                <td>
                                    21/10/2015
                                </td>
                                <td>
                                    0002
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="hidden" id="stag" value="">
                                    <span class="badge badge-transparent tooltip-error" title="Non validé">
                                        <i class="ace-icon fa fa-wrench  bigger-130 orange"></i>
                                    </span>
                                </td>
                                <td>
                                    21/10/2015
                                </td>
                                <td>
                                    0003
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="center">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>
                                    <input type="hidden" id="stag" value="">
                                    <span class="badge badge-transparent tooltip-error" title="Non validé">
                                        <i class="ace-icon fa fa-wrench  bigger-130 orange"></i>
                                    </span>
                                    
                                </td>
                                <td>
                                    21/10/2015
                                </td>
                                <td>
                                    0004
                                </td>
                            </tr>

                        </tbody>
                    </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->




            <div class="vspace-12-sm"></div>

            <div class="col-sm-8">
                <div class="profile-user-info">
                    <div class="profile-info-row">
                        <div class="profile-info-name">Date achat </div>
                        <div class="profile-info-value">
                            <span id="MsgDate"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Numero Achat </div>
                        <div class="profile-info-value">
                            <span id="MsgDate"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Nom Mareyeur </div>
                        <div class="profile-info-value">
                            <span id="MsgDate"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Adresse </div>
                        <div class="profile-info-value">
                            <span id="MsgDate"></span>
                        </div>
                    </div>
                </div>
                
                    <table class="table table-bordered table-hover"id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							#
						</th>
						<th class="text-center">
							Désignation
						</th>
						<th class="text-center">
							Prix Unitaire
						</th>
						<th class="text-center">
							Poids brut (kg)
						</th>
						<th class="text-center">
							Pourcentage
						</th>
						<th class="text-center">
							Poids Net (kg)
						</th>
						<th class="text-center">
							Quantite (kg)
						</th>
						<th class="text-center">
							Montant
						</th>
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>
						1
						</td>
						<td> Poisson
                                                </td>
                                                <td>
                                                    2000
						</td>
                                                <td>300
						</td>
                                                <td>
                                                    10
						</td>
                                                <td>
                                                    240
						</td>
						<td>
                                                     30
                                                </td>
						<td>
                                                    14000
    						</td>
					</tr>
				</tbody>
			</table>
            </div><!-- /.colz -->
        </div><!-- /.row -->
    </div>
    
    <script type="text/javascript">
            jQuery(function ($) {
            var oTableStock= null;
        var familleId="";
            $("#GRP_CMB").select2();  
            if("<?php echo $profil ?>" === "admin") {
                $('#STAT_OTHER').addClass("hide");
                $('#STAT_ADMIN').removeClass("hide");
                $('#STAT_ADMIN').addClass("show");
            }
            else {
                $('#STAT_ADMIN').addClass("hide");
                $('#STAT_OTHER').removeClass("hide");
                $('#STAT_OTHER').addClass("show");
            }
           loadStocks = function(typeProduit) {
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
                            if(data <= full[1])
                                src+= '<td><span class="label label-danger arrowed">seuil atteint</span></td>';
                            else
                               src+= '<td><span class="label label-success arrowed-in arrowed-in-right">disponible</span></td>'; 
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
                    aoData.push({"name": "typeProduit", "value": typeProduit});
                    aoData.push({"name": "codeUsine", "value": "<?php echo $codeUsine?>"});
                    aoData.push({"name": "login","value": "<?php echo $login?>"});
                    if("<?php echo $login?>" === "admin")
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

        //   loadStocks($("#GRP_CMB").val());
            //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
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
                        console.log(data);
                        var head = [];
                        var value = [];
                        $.each(data, function(idx, obj) {
                                head.push(obj.libelle);
                                value.push(obj.nbStocks);
                        });
                        
                        console.log(value);
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
                        console.log('{"usine":' + dataUsine + '}');	
                        drawPieChart(placeholder, map);

                    }
                       
                    }).error(function(error) { alert("failure"); });;
            };
			if("<?php echo $profil ?>" === "admin") {
                            loadStats("<?php echo $codeUsine?>","<?php echo $login?>");
                        }
                        else 
                            loadStatsFamille($("#GRP_CMB").val(),"<?php echo $codeUsine?>","<?php echo $login?>");
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
                         
            $("#GRP_CMB").change(function() {
                if($("#GRP_CMB").val()!==null){
                    loadStocks($("#GRP_CMB").val());
                     loadStatsFamille($("#GRP_CMB").val(),"<?php echo $codeUsine?>","<?php echo $login?>");
                }
                else{
                 loadStocks('*');
                  loadStatsFamille('*',"<?php echo $codeUsine?>","<?php echo $login?>");
                }
            });

            });
        </script>