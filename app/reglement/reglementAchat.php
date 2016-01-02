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
            Réglement des achats
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des achats à Regler
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
                                    Numéro Achat
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Maréyeur
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
                                                            <div class="infobox-content" id="INDIC_REGLEMENT_REGLES">0</div>

                                                            <div class="infobox-content" style="width:150px">Achats réglés</div>

                                                        </div>
                                                    </div>

                                                    <div class="infobox infobox-orange infobox-small infobox-dark" style="width:200px">
                                                        <div class="infobox-icon">
                                                            <i class="icon-calendar"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <div class="infobox-content" id="INDIC_REGLEMENT_A_VERSER">0</div>

                                                            <div class="infobox-content" style="width:150px">Reliquat a verser</div>

                                                        </div>
                                                    </div>
                                                    
                                                     <div class="infobox infobox-red infobox-small infobox-dark" style="width:200px">
                                                        <div class="infobox-icon">
                                                            <i class="icon fa-play"></i>
                                                        </div>

                                                        <div class="infobox-data" >
                                                            <div class="infobox-content" id="INDIC_REGLEMENT_NON_REGLE">0</div>

                                                            <div class="infobox-content" style="width:150px">Achats non réglées </div>
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
                        <div class="profile-info-name">Date achat </div>
                        <div class="profile-info-value">
                            <span id="AchatDate"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Nom Mareyeur </div>
                        <div class="profile-info-value">
                            <span id="AchatNomMareyeur"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Origine </div>
                        <div class="profile-info-value">
                            <span id="achatAdresseMareyeur"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Créé par </div>
                        <div class="profile-info-value">
                            <span id="achatUser"></span>
                        </div>
                    </div>
                </div>
                <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits
                        </h4>
                    <table class="table table-bordered table-hover"id="TABLE_ACHATS">
                        <thead>
                            <tr>
                                    <th class="text-center">
                                            Désignation
                                    </th>
                                    <th class="text-center">
                                            Prix Unitaire
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
				
				</tbody>
			</table>
                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name">Poids Total </div>
                                <div class="profile-info-value">
                                    <span id="PoidsTotal"></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Montant Total </div>
                                <div class="profile-info-value">
                                    <span id="MontantTotal"></span>
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
                            Liste des avances
                        </h4>
                    <table class="table table-bordered table-hover"id="tab_avance">
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
                                <div class="profile-info-name">Reliquat </div>
                                <div class="profile-info-value">
                                    <span id="reliquat"></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Date </div>
                                <div class="profile-info-value">
                                    <div class="col-xs-8 col-sm-5">
                                        <div class="input-group">
                                            <input class="form-control date-picker" id="dateAvance" name="dateAvance" type="text" data-date-format="dd-mm-yyyy" />
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
                                    <span id="avance"></span>
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
    
    <script type="text/javascript">
            jQuery(function ($) {
            var oTableAchats= null;
            var nbTotalAchatChecked=0;
            var checkedAchat = new Array();
            // Check if an item is in the array
           // var interval = 500;
            var today = new Date();
    var dateAchat = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    
    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd;} if(mm<10){mm='0'+mm;} today = dd+'/'+mm+'/'+yyyy;dateAchat=yyyy+'-'+mm+'-'+dd;
          $('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                        $(this).prev().focus();
                });
              $('#avance').editable({
                            type: 'text',
                            name: 'avance',
                            title: "Saisir un montant",
                            id: 'id',
                            submit : 'OK',
                            validate:function(value){
                                if(value==='') return 'Veuillez saisir  un montant S.V.P.';
                            },
                            placement: 'right',
                            url: function(editParams) {                             
                                var avance = editParams.value;
                                //alert(code);
                                function save() {
                                    if(avance !== ""){
                                        saveAvance(checkedAchat[0], avance);
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
                        
                         
           function saveAvance(achatId, avance)
                {
                    var ACTION = "<?php echo App::ACTION_UPDATE; ?>";
                    $.ajax({
                        url: '<?php echo App::getBoPath(); ?>/reglement/ReglementController.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            ACTION: ACTION,
                            achatId: achatId,
                            avance: avance
                        },
                        success: function(data)
                        {
                             $('#winModalINFO').modal('hide');
                            if (data.rc == 0){
                                $.gritter.add({
                                    title: 'Server notification',
                                    text: "<?php printf("Avance ajoute"); ?>",
                                    class_name: 'gritter-success gritter-light'
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
                url = '<?php echo App::getBoPath(); ?>/achat/AchatController.php';
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
                        $('#INDIC_REGLEMENT_REGLES').text(data.nbRegle);
                        $('#INDIC_REGLEMENT_NON_REGLE').text(data.nbNonRegle);
                        $('#INDIC_REGLEMENT_A_REGLER').text(data.nbARegler);
                    
                    }
                });
            };
            getIndicator();
            checkedAchatContains = function(item) {
                for (var i = 0; i < checkedAchat.length; i++) {
                    if (checkedAchat[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_ACHATS").each(function() {
                    if (checkedAchatContains($(this).val())) {
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
                        checkedAchatAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalAchatChecked=checkedAchat.length;
                    }
                    else
                    {
                        checkedAchatRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_ACHATS tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() !== '*') {
                    checkedAchatAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedAchatRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedAchat.length==nbTotalAchatChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
            MessageSelected = function(click)
            {
                if (checkedAchat.length == 1){
                    loadAchatSelected(checkedAchat[0]);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedAchat.length==nbTotalAchatChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedAchat.length === 1){
                    loadAchatSelected(checkedAchat[0]);
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
            checkedAchatAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedAchat.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedAchatRemove = function(item) {
                var i = 0;
                while (i < checkedAchat.length) {
                    if (checkedAchat[i] == item) {
                        checkedAchat.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedAchat.length; i++) {
                    if (checkedAchat[i] == item)
                        return true;
                }
                return false;
            };
             loadAchats = function() {
                nbTotalAchatChecked = 0;
                checkedAchat = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/achat/AchatController.php';

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
                                     src += '<span class="badge badge-transparent tooltip-error" title="Non réglé"><i class="ace-icon fa fa-check-square-o red bigger-130 icon-only"></i></span>';
                                else if (data == 1)
                                    src += '<span class=" tooltip-error" title="Reliquat a verser"><i class="ace-icon fa fa-check-square-o orange bigger-130 icon-only"></i></span>';
                                else if (data == 2)
                                    src += '<span class="badge badge-transparent tooltip-error" title="réglé"><i class="ace-icon fa fa-check-square-o green bigger-130 icon-only"></i></span>';

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
                                checkedAchatAdd(aData[0]);
                                MessageSelected();
                                
                            }else{
                                checkbox.removeAttr('checked');
                                
                                checkedAchatRemove(aData[0]);
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
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_REGLEMENTS; ?>"});
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
                                  nbTotalAchatChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadAchats();
            loadAchatSelected = function(achatId)
            {
                 var url;
                 url = '<?php echo App::getBoPath(); ?>/achat/AchatController.php';

                $.post(url, {achatId: achatId, ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function(data) {
                    data = $.parseJSON(data);
                    $('#TAB_MSG_TITLE').text("Numero achat: "+ data.numero);
                    $('#AchatDate').text(data.dateAchat);
                    $('#AchatNomMareyeur').text(data.nomMareyeur);
                    $('#achatAdresseMareyeur').text(data.adresse);
                    $('#achatUser').text(data.user);
                    $('#PoidsTotal').text(data.poidsTotal);
                    $('#MontantTotal').text(data.montantTotal);
                    $('#TABLE_ACHATS tbody').html("");
                    var table = data.ligneAchat;
                    var trHTML='';
                    $(table).each(function(index, element){
                        trHTML += '<tr><td>' + element.designation + '</td><td>' + element.prixUnitaire + '</td><td>' + element.quantite + '</td><td>' + element.montant + '</td></tr>';
                    });
                    $('#TABLE_ACHATS tbody').append(trHTML);
                    if(data.regle==0)
                        $('#status').text('Non reglé');
                    else if(data.regle==1)
                        $('#status').text('Reliquat à verser');
                    else if(data.regle==2)
                        $('#status').text('Réglé');
                  $('#tab_avance tbody').html("");
                    var tableAvance = data.reglement;
                    var trHTMLAv='';
                    var mtAv=0;
                    $(tableAvance).each(function(index, element){
                         mtAv += parseFloat(element.avance);
                        trHTMLAv += '<tr><td>' + element.datePaiement + '</td><td class="montant">' + element.avance + '</td></tr>';
                    });
                    $('#tab_avance tbody').append(trHTMLAv);
                    
                    if(!isNaN(mtAv)) {
                        var rel = data.montantTotal - mtAv;
                        $('#reliquat').text(rel);
                    }
                    trHTMLAv='';   
                    $('#TABLE_ACHATS tbody').html("");
                    var table = data.ligneAchat;
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

            getInfoReglement = function(achatId) {
                var url;
                url = '<?php echo App::getBoPath(); ?>/achat/AchatController.php';
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: 'ACTION=<?php echo App::ACTION_GET_INFOS; ?>&achatId='+achatId,
                    cache: false,
                    success: function(data) {
                        $('#rgl_montantRestant').text(data.nbRegle);
                        $('#rgl_avance').text(data.nbNonRegle);
                        $('#rgl_reliquat').text(data.nbAnnule);
                    
                    }
                });
            };
            $("#MNU_REGLEMENT").click(function()
            {
                if (checkedAchat.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedAchat.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment régler cet achat", function(result) {
                    if(result){
                    	 $('#winModalReglement').addClass('show');
     		            $('#winModalReglement').modal('show');
                    var achatId = checkedAchat[0];
                   
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/listebonsAchatVue.php", function () {
//                        });
                         }
                    });
                }
            });

            $("#MNU_IMPRIMER").click(function()
                    {
                        if (checkedAchat.length == 0)
                            bootbox.alert("Veuillez selectionnez un achat");
                        else if (checkedAchat.length >= 1)
                        {
                        	window.open('<?php echo App::getHome(); ?>/app/pdf/achatPdf.php','nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1000, height=650');
                            
                        }
                    });
            
            $("#MNU_ANNULATION").click(function()
            {
                if (checkedAchat.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedAchat.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment annuler cet achat", function(result) {
                    if(result){
                    var achatId = checkedAchat[0];
                    $.post("<?php echo App::getBoPath(); ?>/achat/AchatController.php", {achatId: achatId, ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function(data)
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
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/listebonsAchatVue.php", function () {
                        });
                         }
                    });
                }
            });
            });
        </script>