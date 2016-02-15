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
            Inventaires Achats
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Achats
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
         
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat" >
                        <h4 class="widget-title lighter" >
                            <i class="ace-icon fa fa-star orange"></i>
                           Achat
                        </h4>
                       
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                        <div style="margin-top: -40px;margin-left: 9%;">
					       <div class="infobox infobox-green" style="width: 300px; height: 51px;">
                                                            <div class="infobox-data">
                                                                    <span class="infobox-data-number">Poids total 3000 FCFA</span>
                                                            </div>
                                                    </div>
                                                    <div class="infobox infobox-blue" style=" width: 320px; height: 51px;">
                                                            

                                                            <div class="infobox-data" style="width:500px">
                                                                    <span class="infobox-data-number">Montant total 30000000 Kg</span>
                                                            </div>
                                                    </div>
					</div>
                    </div>
                                        
                    <div class="widget-body">
                     <div class="widget-main no-padding" style="margin-top:20px">
                      <div class="row">
                       <div class="col-sm-9 infobox-container" style="float: left; margin-bottom: 20px;width:600px">
                         <label>  <i class="ace-icon fa orange"></i>
                            Période:</label>
                                    <span id="labelFrom">Du</span>
					    <input
					        class="date-picker" id="dateDebutAchat"
					        name="dateDebutAchat" type="text"
					        data-date-format="dd-mm-yyyy" />
					    <span id="labelTo" style="margin-left: -1px;">au</span>
					    <input
					        class="date-picker" id="dateFinAchat"
					        name="dateFinAchat" type="text"
					        data-date-format="dd-mm-yyyy" />
					    <button data-toggle="dropdown" id="BTN_SEARCH" style="align-content: center;margin-top: -3px;"
					            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
					            data-rel="tooltip" data-placement="top" title="consulter">
					        <i class="fa fa-search bigger-120 white" style="margin-left: 1px;"></i> 
					    </button>
					    
					    <button data-toggle="dropdown" id="BTN_IMPRIMER" style="align-content: center;margin-top: -3px;"
					            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
					            data-rel="tooltip" data-placement="top" title="Imprimer">
					        <i class="fa fa-print bigger-120 white" style="margin-left: 1px;"></i> 
					    </button>
					                   <div class="col-sm-4">
                                            <select id="regle" name="regle" data-placeholder="" class="col-xs-10 col-sm-7" style="margin-left: 175%; margin-top: -35px;">
                                            <option value="*" class="">Filtrez par achat</option>
                                            <option value="2" class="green bigger-130 icon-only">Achats réglés</option>
                                            <option value="1" class="orange bigger-130 icon-only">Achats avec reliquat</option>
                                            <option value="0" class="orange bigger-130 icon-only">Achats non réglés</option>
                                            </select>
                                       </div>
                            </div>
                            </div>
                          <table id="LIST_ACHATS_INVENTAIRES" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                Id
<!--                                     <label> -->
<!--                                         <input type="checkbox" value="*" name="allchecked"/> -->
<!--                                         <span class="lbl"></span> -->
<!--                                     </label> -->
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Numéro
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Date
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Maréyeur
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Quantité
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Montant
                                </th>

                                <!--<th class="hidden-phone" style="border-left: 0px none;border-right: 0px none;">
                                </th>-->
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        
        
       <script type="text/javascript">
            jQuery(function ($) {
            var oTableAchats= null;
            var nbTotalAchatsChecked=0;
            var checkedAchats = new Array();
            // Check if an item is in the array
           // var interval = 500;
    
    $('#dateDebutAchat').datepicker({autoclose: true,language:'fr',todayHighlight:true}).on(ace.click_event, function(){
             });
    $('#dateFinAchat').datepicker({autoclose: true,language:'fr', todayHighlight:true}).prev().on(ace.click_event, function(){
//            $(this).prev().focus();
    });
         function calculPoids(index){
           var cart=parseFloat($("#cart"+index).val());
           var qte=parseFloat($("#qte"+index).val());
           var stockReel=parseFloat($("#stockReel").val());
           var sqte=0;
           var tot = 0;
           tot = cart*qte;
           if(!isNaN(tot)) {
               $("#tot"+index).val(tot);
               $('#tab_logic .tot').each(function () {
                if($(this).val()!=='')
                  sqte += parseFloat($(this).val());
                });
                if(sqte > stockReel){
                    $.gritter.add({
                        title: 'Notification',
                        text: 'La quantité totale définie est supérieure au stock réel',
                        class_name: 'gritter-error gritter-light'
                    }); 
                    $("#qte"+index).val(""); 
                   $("#tot"+index).val("0"); 
               }
            }
            else {
                $("#tot"+index).val("0");
            }
       }
       
         
            // Persist checked Message when navigating
            
             loadAchats = function(dateDebut, dateFin, regle) {
                nbTotalAchatsChecked = 0;
                checkedAchats = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/achat/AchatController.php';

                if (oTableAchats != null)
                    oTableAchats.fnDestroy();

                oTableAchats = $('#LIST_ACHATS_INVENTAIRES').dataTable({
                    "oLanguage": {
                    "sUrl": "<?php echo App::getHome(); ?>/datatable_fr.txt",
                    "oPaginate": {
                        "sNext": "",
                        "sLast": "",
                        "sFirst": null,
                        "sPrevious": null
                      }
                    },
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        $(nRow).css('cursor','pointer');
                        $(nRow).on('click', 'td:not(:first-child)', function(){
                            checkbox=$(this).parent().find('input:checkbox:first');
                            if(!checkbox.is(':checked')){
                                checkbox.prop('checked', true);;
                                checkedAchatsAdd(aData[0]);
                                MessageSelected();
                                
                            }else{
                                checkbox.removeAttr('checked');
                                
                                checkedAchatsRemove(aData[0]);
                                MessageUnSelected();
                            }
                        });
                    },
                    "fnDrawCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                       
                    },
                    "preDrawCallback": function( settings ) {
                       
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "sAjaxSource": url,
                    "sPaginationType": "simple",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_INVENTAIRE_ACHATS; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        userProfil=$.cookie('profil');
                        
                        if(userProfil==='admin'){
                            aoData.push({"name": "codeUsine", "value": "*"});
                        }
                        else
                        aoData.push({"name": "codeUsine", "value": "<?php echo $codeUsine;?>"});
                        
                        aoData.push({"name": "dateDebut", "value": dateDebut});
                        aoData.push({"name": "dateFin", "value": dateFin});
                        aoData.push({"name": "regle", "value": regle});
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
                                  $('table th input:checkbox').removeAttr('checked');
                                  fnCallback(json);
                                  nbTotalAchatsChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadAchats($('#dateDebut').val(),$('#dateFin').val(), $('#regle').val());

            $('#regle').change(function() {
                loadAchats($('#dateDebut').val(),$('#dateFin').val(), $('#regle').val());
            });
        $("#MNU_IMPRIMER").click(function()
        {
          window.open('<?php echo App::getHome(); ?>/app/pdf/stockPdf.php?codeUsine='+"<?php echo $codeUsine?>",'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');
         });
            });
        </script>