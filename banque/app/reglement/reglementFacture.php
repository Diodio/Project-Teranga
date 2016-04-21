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
            Reglement des factures
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des factures à Regler
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
                                            margin-left: -40%;
                                        ">
                                        <i class="icon-group icon-only icon-on-right"></i> Action
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li id='MNU_REGLEMENT'><a href="#" id="GRP_NEW">Regler </a></li>
                                        <li class="divider"></li>
                                        <li id='MNU_IMPRIMER'><a href="#" id="GRP_NEW">Imprimer</a></li>
                                    </ul>
                                </div>
                    </div>
        </div>
     
        <div class="row">
            <div class="col-sm-5">
                
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des factures
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
     
                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_ACHATS" class="table table-striped table-bordered table-hover">
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
                                    Numero Facture
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Client
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
                                            Statistique
                                        </a>
                                    </li>
                                    <li id="TAB_MSG_VIEW">
                                        <a id="TAB_MSG_LINK" data-toggle="tab" href="#TAB_MSG">
                                            <i class="red icon-comments-alt bigger-110"></i>
                                            <span id="TAB_MSG_TITLE">...</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-12 no-padding-left no-padding-right">
                                <div class="tab-content padding-4">
                                    <div id="TAB_INFO" class="tab-pane in active">
                                        <div>

                                            <div class="span12 infobox-container">

                                                    <div class="infobox infobox-green infobox-small infobox-dark" style="width:200px">
                                                        <div class="infobox-icon">
                                                            <i class="icon-pause"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <div class="infobox-content" id="INDIC_FACTURE_REGLES">0</div>

                                                            <div class="infobox-content" style="width:150px">Factures réglées</div>

                                                        </div>
                                                    </div>

                                                    <div class="infobox infobox-orange infobox-small infobox-dark" style="width:200px">
                                                        <div class="infobox-icon">
                                                            <i class="icon-calendar"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <div class="infobox-content" id="INDIC_FACTURE_ANNULES">0</div>

                                                            <div class="infobox-content" style="width:150px">Reliquat a verser</div>

                                                        </div>
                                                    </div>
                                                    
                                                     <div class="infobox infobox-red infobox-small infobox-dark" style="width:200px">
                                                        <div class="infobox-icon">
                                                            <i class="icon fa-play"></i>
                                                        </div>

                                                        <div class="infobox-data" >
                                                            <div class="infobox-content" id="INDIC_FACTURE_NONREGLES">0</div>

                                                            <div class="infobox-content" style="width:150px">Factures non réglées </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-6"></div>
                                                    <br/>

                                                

                                            </div>
                                        </div>
                                    </div>

                    <div id="TAB_MSG" class="tab-pane">
                        <div class="slim-scroll" data-height="100">
                            <div class="span12">

                              <div class="profile-user-info">
                    <div class="profile-info-row">
                        <div class="profile-info-name">Date facture </div>
                        <div class="profile-info-value">
                            <span id="dateFacture"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Client</div>
                        <div class="profile-info-value">
                            <span id="client"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Adresse </div>
                        <div class="profile-info-value">
                            <span id="adresse"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Pays </div>
                        <div class="profile-info-value">
                            <span id="pays"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Créé par </div>
                        <div class="profile-info-value">
                            <span id="factureUser"></span>
                        </div>
                    </div>
                </div>
                <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits
                        </h4>
                <table class="table table-bordered table-hover"id="TABLE_FACTURES">
                    <thead>
                        <tr>
                              <th class="text-center">
                                        Nombre de colis
                                </th>
                                <th class="text-center">
                                        Désignation
                                </th>
                                <th class="text-center">
                                        Quantite (kg)
                                </th>
                                <th class="text-center">
                                        Prix Unitaire
                                </th>
                                <th class="text-center">
                                        Montant
                                </th>
                        </tr>
                    </thead>
                        <tbody>

                        </tbody>
                    </table>
                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name">Total colis </div>
                                <div class="profile-info-value">
                                    <span id="nbColis"></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Poids Total </div>
                                <div class="profile-info-value">
                                    <span id="PoidsTotal"></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Montant Total </div>
                                <div class="profile-info-value">
                                    <span id="MontantHt"></span>
                                </div>
                            </div>
                            
                            <div class="profile-info-row">
                                <div class="profile-info-name">Status </div>
                                <div class="profile-info-value">
                                    <span id="status"></span>
                                </div>
                            </div>
                        </div>
                                 <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des versements
                        </h4>
                    <table class="table table-bordered table-hover"id="tab_versement">
				<thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Montant</th>
                                    </tr>
                                </thead>
				<tbody>
					
				</tbody>
			</table>
                           <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name">Somme versé </div>
                                <div class="profile-info-value">
                                    <span id="sommeAvance"></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Reliquat </div>
                                <div class="profile-info-value">
                                    <span id="reliquat"></span>
                                </div>
                            </div>
                           </div>
                           <div id="VERSEMENT_FORM">
                               <h4 class="widget-title lighter">
                                    <i class="ace-icon fa fa-plus orange"></i>
                                    Ajouter un versement
                                </h4>
                               <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name">Date </div>
                                <div class="profile-info-value">
                                    <div class="col-xs-8 col-sm-5">
                                        <div class="input-group">
                                            <input class="form-control date-picker" id="dateVersement" name="dateVersement" type="text" data-date-format="dd-mm-yyyy" />
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                        </div>
                                </div>
                            </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Montant </div>
                                <div class="profile-info-value">
                                    <span id="versement"></span>
                                </div>
                            </div>
                           </div>
                        </div>
                                            </div>
                                        </div>

                                    </div><!--End TAB_MSG -->



                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--/.span6-->
            </div>
        </div><!-- /.row -->
    </div>
    </div>
    <script type="text/javascript">
            jQuery(function ($) {
            var oTableAchats= null;
            var nbTotalAchatChecked=0;
            var checkedFacture = new Array();
            // Check if an item is in the array
           // var interval = 500;
            $('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                        $(this).prev().focus();
                });
              $('#versement').editable({
                            type: 'text',
                            name: 'versement',
                            title: "Saisir un montant",
                            id: 'id',
                            submit : 'OK',
                            emptytext: "Saisir un montant",
                            validate:function(value){
                                //alert($('.date-picker').val());
                                if(value==='') return 'Veuillez saisir  un montant S.V.P.';
                                if($('.date-picker').val()==='') return 'Veuillez saisir  une date S.V.P.!';
                                   
                            },
                            placement: 'right',
                            url: function(editParams) {                             
                                var versement = editParams.value;
                                //alert(code);
                                function save() {
                                    if(versement !== ""){
                                        saveAvance(checkedFacture[0], versement, $('.date-picker').val());
                                    }
                                    else {
                                            
                                            $.gritter.add({
                                                title: 'Server notification',
                                                text: "Veuillez saisir  un montant S.V.P.",
                                                class_name: 'gritter-error gritter-light'
                                            });
                                    }
                                }
                                
                                save(function() {});

                            }
                          
                        });
                        
                         
           function saveAvance(factureId, versement, dateVersement)
                {
                    var ACTION = "<?php echo App::ACTION_INSERT_FACTURE; ?>";
                    $.ajax({
                        url: '<?php echo App::getBoPath(); ?>/reglement/ReglementController.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            ACTION: ACTION,
                            factureId: factureId,
                            versement: versement,
                            dateVersement: dateVersement,
                            codeUsine:"<?php echo $codeUsine;?>",
                            login:"<?php echo $login;?>"
                        },
                        success: function(data)
                        {
                             $('#winModalINFO').modal('hide');
                            if (data.rc == 0){
                                $.gritter.add({
                                    title: 'Server notification',
                                    text: "<?php printf("Versement enregistré avec succes"); ?>",
                                    class_name: 'gritter-success gritter-light'
                                });
                                $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/reglement/reglementFacture.php", function () {
                                });
                            }
                            else{
                                $.gritter.add({
                                    title: 'Server notification',
                                    text: data.error,
                                    class_name: 'gritter-error gritter-light'
                                });
                            };
                        },
                        error: function() {
                            alert("error");
                        }
                    });

                }
                
            getIndicator = function() {
                var url;
                var user;
                url = '<?php echo App::getBoPath(); ?>/facture/FactureController.php';
                userProfil=$.cookie('profil');
                if(userProfil==='admin')
                   user = 'login=<?php echo $login; ?>';
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: user+'&ACTION=<?php echo App::ACTION_STAT_REGLEMENTS; ?>&codeUsine=<?php echo $codeUsine; ?>',
                    cache: false,
                    success: function(data) {
                        $('#INDIC_FACTURE_REGLES').text(data.nbRegle);
                        $('#INDIC_FACTURE_NONREGLES').text(data.nbNonRegle);
                        $('#INDIC_ACHAT_ANNULES').text(data.nbAnnule);

//                        gStatTimer = setTimeout(function() {
//                            getIndicator();
//                        }, interval);
                    }
                });
            };
            getIndicator();
            checkedFactureContains = function(item) {
                for (var i = 0; i < checkedFacture.length; i++) {
                    if (checkedFacture[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_ACHATS").each(function() {
                    if (checkedFactureContains($(this).val())) {
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
                        checkedFactureAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalAchatChecked=checkedFacture.length;
                    }
                    else
                    {
                        checkedFactureRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_ACHATS tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedFactureAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedFactureRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedFacture.length==nbTotalAchatChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
            MessageSelected = function(click)
            {
                if (checkedFacture.length == 1){
                    loadFactureSelected(checkedFacture[0]);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedFacture.length==nbTotalAchatChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedFacture.length === 1){
                    loadFactureSelected(checkedFacture[0]);
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
            checkedFactureAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedFacture.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedFactureRemove = function(item) {
                var i = 0;
                while (i < checkedFacture.length) {
                    if (checkedFacture[i] == item) {
                        checkedFacture.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedFacture.length; i++) {
                    if (checkedFacture[i] == item)
                        return true;
                }
                return false;
            };
             loadFactures = function() {
                nbTotalAchatChecked = 0;
                checkedFacture = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/facture/FactureController.php';

                if (oTableAchats != null)
                    oTableAchats.fnDestroy();

                oTableAchats = $('#LIST_ACHATS').dataTable({
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
                        },
                        {
                            "aTargets": [1],
                            "bSortable": false,
                            "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                            },
                            "mRender": function(data, type, full) {
                               var src = '<input type="hidden" id="stag' + full[0] + '" value="' + data + '">';
                                if (data == 0)
                                    src += '<span class="tooltip-error" title="Non réglé"><i class="ace-icon fa fa-check-square-o red bigger-130 icon-only"></i></span>';
                                else if (data == 1)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Reliquat a verser"><i class="ace-icon fa fa-check-square-o orange bigger-130 icon-only"></i></span>';
                                else if (data == 2)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Réglée"><i class="ace-icon fa fa-check-square-o green bigger-130 icon-only"></i></span>';
                                return src;
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
                                checkedFactureAdd(aData[0]);
                                MessageSelected();
                                
                            }else{
                                checkbox.removeAttr('checked');
                                
                                checkedFactureRemove(aData[0]);
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
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_REGLEMENTS; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
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
                                  nbTotalAchatChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadFactures();
            loadFactureSelected = function(factureId)
            {
                 var url;
                 url = '<?php echo App::getBoPath(); ?>/facture/FactureController.php';

                $.post(url, {factureId: factureId, ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function(data) {
                    data = $.parseJSON(data);
                    $('#TAB_MSG_TITLE').text("Numero facture: "+ data.numero);
                    $('#dateFacture').text(data.dateFacture);
                    $('#client').text(data.nomClient);
                    $('#adresse').text(data.adresse);
                    $('#pays').text(data.pays);
                    $('#factureUser').text(data.user);
                    $('#MontantHt').text(data.montantHt);
                    $('#TABLE_FACTURES tbody').html("");
                    var table = data.ligneFacture;
                    var trHTML='';
                    var pT=0;
                    var nC=0;
                    $(table).each(function(index, element){
                        pT += parseFloat(element.quantite);
                        nC += parseFloat(element.nbColis);
                        trHTML += '<tr><td>' + element.nbColis + '</td><td>' + element.produit + '</td><td>' + element.prixUnitaire + '</td><td>' + element.quantite + '</td><td>' + element.montant + '</td></tr>';
                    });
                    $('#TABLE_FACTURES tbody').append(trHTML);
                    $('#nbColis').text(nC);
                    $('#PoidsTotal').text(pT);
                    if(data.regle==0){
                        $('#status').text('Non reglé');
                        $('#VERSEMENT_FORM').css("visibility", 'visible');
                    }
                    else if(data.regle==1) {
                        $('#status').text('Reliquat à verser');
                        $('#VERSEMENT_FORM').css("visibility", 'visible');
                    }
                    else if(data.regle==2) {
                        $('#status').text('Réglé');
                        $('#VERSEMENT_FORM').css("visibility", 'hidden');
                    }
                  $('#tab_versement tbody').html("");
                    var tableAvance = data.reglement;
                    var trHTMLAv='';
                    var mtAv=0;
                    var rel=0;
                    $(tableAvance).each(function(index, element){
                         mtAv += parseFloat(element.avance);
                        trHTMLAv += '<tr><td>' + element.datePaiement + '</td><td class="montant">' + element.avance + '</td></tr>';
                    });
                    $('#tab_versement tbody').append(trHTMLAv);
                    if(!isNaN(mtAv)) {
                        rel = data.montantHt - mtAv;
                        $('#sommeAvance').text(mtAv);
                         if(!isNaN(rel))
                            $('#reliquat').text(rel);
                    }
                    trHTMLAv='';  
                    trHTML='';
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                    $('#TAB_MSG_VIEW').show();
               }).error(function(error) { });
            };

//            $("#MNU_REGLEMENT").click(function()
//                    {
//                        if (checkedFacture.length == 0)
//                            bootbox.alert("Veuillez selectionnez une facture");
//                        else if (checkedFacture.length >= 1)
//                        {
//                             bootbox.confirm("Voulez vous vraiment régler cette facture", function(result) {
//                            if(result){
//                                
//                            	 $('#winModalReglement').addClass('show');
//             		            $('#winModalReglement').modal('show');
//                            var factureId = checkedFacture[0];
//                           
//                            $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/listebonsAchatVue.php", function () {
//                                });
//                                 }
//                            });
//                        }
//                    });

            $("#MNU_IMPRIMER").click(function()
                    {
                        if (checkedFacture.length == 0)
                            bootbox.alert("Veuillez selectionnez un facture");
                        else if (checkedFacture.length >= 1)
                        {
                        	window.open('<?php echo App::getHome(); ?>/app/pdf/facturePdf.php?factureId='+checkedFacture[0],'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1000, height=650');
                            
                        }
                    });
            
            $("#MNU_ANNULATION").click(function()
            {
                if (checkedFacture.length == 0)
                    bootbox.alert("Veuillez selectionnez un facture");
                else if (checkedFacture.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment annuler cet facture", function(result) {
                    if(result){
                    var factureId = checkedFacture[0];
                    $.post("<?php echo App::getBoPath(); ?>/facture/FactureController.php", {factureId: factureId, ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function(data)
                    {
                        if (data.rc === 0)
                        {
                            bootbox.alert("Achat(s) annulés(s)");
                        }
                        else
                        {
                            bootbox.alert(data.error);
                        }
                    }, "json");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/listebonsAchatVue.php", function () {
                        });
                         }
                    });
                }
            });
            });
        </script>