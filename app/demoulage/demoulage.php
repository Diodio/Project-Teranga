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
            Demoulage des produits
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Demoulage
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
            <div class="col-sm-5">
                
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits a demouler
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_DEMOULAGES" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Designation
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Stock Initial
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Stock Final
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
            <div class="col-sm-7">
                <div class="widget-container-span">
                    <div class="widget-box transparent">
                        <div class="widget-header">

                            <h4 class="lighter"></h4>
                            <div class="widget-toolbar no-border">
                                <ul class="nav nav-tabs" id="TAB_GROUP">

                                    <li id="TAB_INFO_VIEW" class="active">
                                        <a id="TAB_INFO_LINK" data-toggle="tab" href="#TAB_INFO">
                                            <i class="green icon-dashboard bigger-110"></i>
                                            Demoulage
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                     <form id="validation-form" class="form-horizontal"  onsubmit="return false;">
                        <div class="widget-body">
                            <div class="widget-main padding-12 no-padding-left no-padding-right">
                                <div class="tab-content padding-4">
                                 <h4 class="widget-title lighter">
                                 <i class="ace-icon fa fa-star orange"></i>Produit: Sole
                                 </h4>
                               <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock Intial (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" disabled >
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Stock Final (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Stock Final (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Nombre Kg / Carton</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Nombre Carton</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div><!--/.span6-->
            </div>
        </div><!-- /.row -->
        
       <script type="text/javascript">
            jQuery(function ($) {
            var oTableDemoulages= null;
            var nbTotalDemoulagesChecked=0;
            var checkedDemoulages = new Array();
            // Check if an item is in the array
           // var interval = 500;
           
            checkedDemoulagesContains = function(item) {
                for (var i = 0; i < checkedDemoulages.length; i++) {
                    if (checkedDemoulages[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_DEMOULAGES").each(function() {
                    if (checkedDemoulagesContains($(this).val())) {
                        $(this).attr('checked', 'checked');
                    } else {
                        $(this).removeAttr('checked');
                    }
                });
            };
             $('table th input:checkbox').on('click', function() {
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox').each(function() {
                    this.checked = that.checked;
                    if (this.checked)
                    {
                        checkedDemoulagesAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalDemoulagesChecked=checkedDemoulages.length;
                    }
                    else
                    {
                        checkedDemoulagesRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_DEMOULAGES tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedDemoulagesAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedDemoulagesRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedDemoulages.length==nbTotalDemoulagesChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
            enableRelevantDemoulagesMenu = function()
	{   
            if (checkedDemoulages.length == 1)
            {
                $('#MNU_VALIDATION').removeClass('disabled');
                $('#MNU_ANNULATION').removeClass('disabled');
                $('#MNU_IMPRIMER').removeClass('disabled');
                var state = $('#stag' + checkedDemoulages[0]).val();
                 if (state == 1) {
                         // $('#MNU_VALIDATION').removeClass('enable');
                         $('#MNU_VALIDATION').addClass('disabled');
                         $('#MNU_ANNULATION').addClass('disabled');
                  } 
                  else if (state == 2) {
                      //$('#MNU_ANNULATION').removeClass('enable');
                      $('#MNU_VALIDATION').addClass('disabled');
                      $('#MNU_ANNULATION').addClass('disabled');
                  }
                          
            }
            else if (checkedDemoulages.length > 1){
                $('#MNU_VALIDATION').removeClass('enable');
                $('#MNU_ANNULATION').removeClass('enable');
                $('#MNU_IMPRIMER').removeClass('enable');
                $('#MNU_VALIDATION').addClass('disabled');
                $('#MNU_ANNULATION').addClass('disabled');
                $('#MNU_IMPRIMER').addClass('disabled');
            }
            else{
                $('#MNU_VALIDATION').removeClass('enable');
                $('#MNU_ANNULATION').removeClass('enable');
                $('#MNU_IMPRIMER').removeClass('enable');
                $('#MNU_VALIDATION').addClass('disabled');
                $('#MNU_ANNULATION').addClass('disabled');
                $('#MNU_IMPRIMER').addClass('disabled');
            }
            };
            
            MessageSelected = function(click)
            {
                 enableRelevantDemoulagesMenu();
                if (checkedDemoulages.length == 1){
                    loadDemoulagesSelected(checkedDemoulages[0]);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedDemoulages.length==nbTotalDemoulagesChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
                 enableRelevantDemoulagesMenu();
               if (checkedDemoulages.length === 1){
                    loadDemoulagesSelected(checkedDemoulages[0]);
		    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }
                else
                {
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    $("#BTN_MSG_GROUP").popover('destroy');
                    $("#BTN_MSG_CONTENT").popover('destroy');
                }
                $('table th input:checkbox').removeAttr('checked');
            };

            // Add checked item to the array
            checkedDemoulagesAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedDemoulages.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedDemoulagesRemove = function(item) {
                var i = 0;
                while (i < checkedDemoulages.length) {
                    if (checkedDemoulages[i] == item) {
                        checkedDemoulages.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedDemoulages.length; i++) {
                    if (checkedDemoulages[i] == item)
                        return true;
                }
                return false;
            };
             loadDemoulages = function() {
                nbTotalDemoulagesChecked = 0;
                checkedDemoulages = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/produit/ProduitController.php';

                if (oTableDemoulages != null)
                    oTableDemoulages.fnDestroy();

                oTableDemoulages = $('#LIST_DEMOULAGES').dataTable({
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
                                return '<label><input type="checkbox" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';
                            }
                        }
                    ],
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        persistChecked();
                        $(nRow).css('cursor','pointer');
                        $(nRow).on('click', 'td:not(:first-child)', function(){
                            checkbox=$(this).parent().find('input:checkbox:first');
                            if(!checkbox.is(':checked')){
                                checkbox.prop('checked', true);;
                                checkedDemoulagesAdd(aData[0]);
                                MessageSelected();
                                
                            }else{
                                checkbox.removeAttr('checked');
                                
                                checkedDemoulagesRemove(aData[0]);
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
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_DEMOULAGES; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        userProfil=$.cookie('profil');
                        if(userProfil==='admin'){
                            aoData.push({"name": "codeUsine", "value": "*"});
                        }
                        else
                            aoData.push({"name": "codeUsine", "value": "<?php echo $codeUsine;?>"});
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
                                  nbTotalDemoulagesChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadDemoulages();
            loadDemoulagesSelected = function(achatId)
            {
                 var url;
                 url = '<?php echo App::getBoPath(); ?>/achat/DemoulagesController.php';

                $.post(url, {achatId: achatId, ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function(data) {
                    data = $.parseJSON(data);
                    $('#TAB_MSG_TITLE').text("Numero achat: "+ data.numero);
                    $('#DemoulagesDate').text(data.dateDemoulages);
                    $('#DemoulagesNomMareyeur').text(data.nomMareyeur);
                    $('#achatAdresseMareyeur').text(data.adresse);
                    $('#achatUser').text(data.user);
                    $('#PoidsTotal').text(data.poidsTotal);
                    $('#MontantTotal').text(data.montantTotal);
                    $('#TABLE_ACHATS tbody').html("");
                    var table = data.ligneDemoulages;
                    var trHTML='';
                    $(table).each(function(index, element){
                        trHTML += '<tr><td>' + element.designation + '</td><td>' + element.prixUnitaire + '</td><td>' + element.quantite + '</td><td>' + element.montant + '</td></tr>';
                    });
                    $('#TABLE_ACHATS tbody').append(trHTML);
                    trHTML='';
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                    $('#TAB_MSG_VIEW').show();
               }).error(function(error) { });
            };

            $("#MNU_VALIDATION").click(function()
            {
                if (checkedDemoulages.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedDemoulages.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment valider cet achat", function(result) {
                    if(result){
                    var achatId = checkedDemoulages[0];
                    $.post("<?php echo App::getBoPath(); ?>/achat/DemoulagesController.php", {achatId: achatId, ACTION: "<?php echo App::ACTION_ACTIVER; ?>"}, function(data)
                    {
                        if (data.rc == 0)
                        {
                            bootbox.alert("Demoulages(s) validé(s)");
                        }
                        else
                        {
                            bootbox.alert(data.error);
                        }
                    }, "json");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {
                        });
                         }
                    });
                }
            });

            $("#MNU_IMPRIMER").click(function()
                    {
                        if (checkedDemoulages.length == 0)
                            bootbox.alert("Veuillez selectionnez un achat");
                        else if (checkedDemoulages.length >= 1)
                        {
                        	window.open('<?php echo App::getHome(); ?>/app/pdf/achatPdf.php?achatId='+checkedDemoulages[0],'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');
                            
                        }
                    });
            
            $("#MNU_ANNULATION").click(function()
            {
                if (checkedDemoulages.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedDemoulages.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment annuler cet achat", function(result) {
                    if(result){
                    var achatId = checkedDemoulages[0];
                    $.post("<?php echo App::getBoPath(); ?>/achat/DemoulagesController.php", {achatId: achatId, ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function(data)
                    {
                        if (data.rc === 0)
                        {
                            bootbox.alert("Demoulages(s) annulés(s)");
                            
                        }
                        else
                        {
                            bootbox.alert(data.error);
                        }
                    }, "json");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {
                        });
                         }
                    });
                }
            });
            });
        </script>