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
          <div class="row">
                <div class="widget-box transparent">
                    
                    <div class="widget-header widget-header-flat" >
                         <span class="col-sm-2">
                             
                            <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Achats
                        </h4>

                        </span>
                        <span class="span4" style="margin-right: 5%;">
                            <select id="CMB_MAREYEURS" name="CMB_MAREYEURS" style="width: 180px;">
                                <option value="*" class="mareyeurs">Filtrer par mareyeur</option>
                                    
                            </select>
                        </span>
                        <span class="span8">
                            <select id="regle" name="regle" style="margin-left: -15px;">
                                    <option value="*" class="">Filtrer par type achat</option>
                                    <option value="2" class="green bigger-130 icon-only">Achats réglés</option>
                                    <option value="1" class="orange bigger-130 icon-only">Achats avec reliquat</option>
                                    <option value="0" class="red bigger-130 icon-only">Achats non réglés</option>
                            </select>
                            <span id="labelTo" style="margin-left: 20px;">Periode du</span>
                            <input
					        class="date-picker" id="dateDebut"
					        name="dateDebut" type="text"
					        data-date-format="dd-mm-yyyy" />
					    <span id="labelTo" style="margin-left: -1px;">au</span>
					    <input
					        class="date-picker" id="dateFin"
					        name="dateFin" type="text"
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
					                   
                                            
                                     
                        </span>
                         
                    </div>
                 
         <div style="margin-top: 15px; text-align:center" >
                    <div class="infobox infobox-green" style="width: 400px; height: 40px;">
                                 <div class="infobox-data">
                                     <span class="infobox-data-number">Poids total : <span id='poidsTotal'></span> KG</span>
                                 </div>
                         </div>
                         <div class="infobox infobox-blue" style=" width: 400px; height: 40px;">


                                 <div class="infobox-data" style="width:640px">
                                         <span class="infobox-data-number">Montant total : <span id='montantTotal'></span> F CFA</span>
                                 </div>
                         </div>
            </div>
          </div>
                                        
                    <div class="widget-body">
                     <div class="widget-main no-padding" style="margin-top:20px">
                      
                          <table id="LIST_ACHATS_INVENTAIRES" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                               
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
            $('#CMB_MAREYEURS').select2();
            // Check if an item is in the array
           // var interval = 500;
    getDate=function(debut){
        // GET CURRENT DATE
        var date = new Date();

        // GET YYYY, MM AND DD FROM THE DATE OBJECT
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth()+1).toString();
        var dd  = date.getDate().toString();

        // CONVERT mm AND dd INTO chars
        var mmChars = mm.split('');
        var ddChars = dd.split('');

        // CONCAT THE STRINGS IN YYYY-MM-DD FORMAT
        if(debut)
            return '01-'+(mmChars[1]?mm:"0"+mmChars[0]) + '-' +yyyy   ;
        return (ddChars[1]?dd:"0"+ddChars[0])+'-'+(mmChars[1]?mm:"0"+mmChars[0]) + '-' +yyyy   ;
    }
    $('#dateDebut').datepicker({autoclose: true,language:'fr',todayHighlight:true}).on(ace.click_event, function(){
             });
    $('#dateFin').datepicker({autoclose: true,language:'fr', todayHighlight:true}).prev().on(ace.click_event, function(){
//            $(this).prev().focus();
    });
    
   // $('#dateDebut').val(getDate(true));
   // $('#dateFin').val(getDate());
    loadMareyeur = function(){
    $.post("<?php echo App::getBoPath(); ?>/mareyeur/MareyeurController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                 $("#CMB_MAREYEURS").loadJSON('{"mareyeurs":' + data + '}');
            }
    });
    };
    loadMareyeur();
        loadInfosInventaire = function (mareyeurId,typeAchat, dateD, dateF) {
        var dateDebut='';
        var dateFin='';
        if(typeof(dateD)!=='undefined')
            dateDebut=dateD;
        if(typeof(dateF)!=='undefined')
            dateFin=dateF;
        $.post("<?php echo App::getBoPath(); ?>/achat/AchatController.php", {mareyeurId:mareyeurId, typeAchat:typeAchat,dateDebut:dateDebut,dateFin:dateFin,codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_GET_INFOS; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                console.log(sData.poidsTotal);
//                 $("#poidsTotal").text(sData.poidsTotal);
                $("#poidsTotal").text(parseFloat(sData.poidsTotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").toString())
               // $("#montantTotal").text(sData.montantTotal);
                $("#montantTotal").text(parseFloat(sData.montantTotal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").toString())
            }
    });
    };
    
                
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
            
             loadAchats = function(mareyeurId, dateDebut, dateFin, regle) {
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
                    "aoColumnDefs": [
                        {
                            "aTargets": [0],
                            "bSortable": false,
                            "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                            },
                            "mRender": function(data, type, full) {
                               var src = '<input type="hidden" id="stag' + full[1] + '" value="' + data + '">';
                                if (data == 2)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Réglé:"><i class="ace-icon fa fa-check-square-o green bigger-130 icon-only"></i></span>';
                                else if (data == 1)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Reliquat: '+full[6]+' F CFA"><i class="ace-icon fa fa-check-square-o orange red bigger-130 icon-only"></i></span>';
                                return src;
                            }
                        }
                    ],
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
                    "bLengthChange": true,
                    "bFilter": true,
                    //afficher nombre �l�ment
                    "bInfo": true,
                    "sAjaxSource": url,
                  //afficher nombre �l�ment
                    "sPaginationType": "full_numbers",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_INVENTAIRE_ACHATS; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        aoData.push({"name": "usineCode", "value": "<?php echo $codeUsine;?>"});
                        aoData.push({"name": "mareyeurId", "value": mareyeurId});
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
            dateformat = function (date) {
                if(date!==''){
                    var arr = date.split('-');
                    return arr[2] + '-' + arr[1] + '-' + arr[0];
                }
            };
            loadInfosInventaire($('#CMB_MAREYEURS').val(),$('#regle').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()));
            loadAchats($('#CMB_MAREYEURS').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()), $('#regle').val());

            $('#regle').change(function() {
                loadInfosInventaire($('#CMB_MAREYEURS').val(),$('#regle').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()));
                loadAchats($('#CMB_MAREYEURS').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()), $('#regle').val());
            });
            
            $('#CMB_MAREYEURS').change(function() {
                loadInfosInventaire($('#CMB_MAREYEURS').val(),$('#regle').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()));
                loadAchats($('#CMB_MAREYEURS').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()), $('#regle').val());
            });
            
            $("#BTN_SEARCH").click(function()
            {
                loadInfosInventaire($('#CMB_MAREYEURS').val(),$('#regle').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()));
                loadAchats($('#CMB_MAREYEURS').val(),dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()), $('#regle').val());
               // alert("dd");
            });
        $("#MNU_IMPRIMER").click(function()
        {
          window.open('<?php echo App::getHome(); ?>/app/pdf/stockPdf.php?codeUsine='+"<?php echo $codeUsine?>",'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');
         });
            });
        </script>
