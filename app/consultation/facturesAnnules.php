<?php
require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
if (!isset($_COOKIE['userId'])) {
    header('Location: ' . \App::getHome());
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
            Gestion des factures annulées
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des factures annulées
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="row">
        <div class="space-6"></div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <div class="col-lg-1">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-flat">
                            <h4 class="widget-title lighter">
                                <i class="ace-icon fa fa-star orange"></i>
                                Liste des factures annulées
                            </h4>

                            <div class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main no-padding">
                                <table id="LIST_FACTURES" class="table table-striped table-bordered table-hover">
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
                                                Numéro Facture
                                            </th>
                                            <th style="border-left: 0px none;border-right: 0px none;">
                                                Nom Client
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
                                                    <div class="infobox infobox-red infobox-small infobox-dark" style="width:200px">
                                                        <div class="infobox-icon">
                                                            <i class="icon-calendar"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <div class="infobox-content" id="INDIC_FACTURE_ANNULES">0</div>

                                                            <div class="infobox-content" style="width:150px">Factures annulées</div>

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
                                                                <span id="FactureDate"></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Client </div>
                                                            <div class="profile-info-value">
                                                                <span id="nomClient"></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Destination </div>
                                                            <div class="profile-info-value">
                                                                <span id="origine"></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Pays </div>
                                                            <div class="profile-info-value">
                                                                <span id="pays"></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Créé par  </div>
                                                            <div class="profile-info-value">
                                                                <span id="user"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="widget-title lighter">
                                                        <i class="ace-icon fa fa-star orange"></i>
                                                        Conteneur et Numero Plomb
                                                    </h4>

                                                    <table class="table table-bordered table-hover"id="tab_conteneur"> 
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Numero Conteneur</th>
                                                                <th class="text-center">numero plomb</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <div class="profile-user-info">
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Port de dechargement  </div>
                                                            <div class="profile-info-value">
                                                                <span id="portDechargement"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="widget-title lighter">
                                                        <i class="ace-icon fa fa-star orange"></i>
                                                        Liste des produits
                                                    </h4>
                                                    <table class="table table-bordered table-hover"id="tab_produit"> 
                                                        <thead>
                                                            <tr>
                                                                <th class=""></th>
                                                                <th class="">Détail de colis</th>
                                                                <th class="">Désignation</th>
                                                                <th class="">Prix unitaire</th>
                                                                <th class="">Poids net</th>
                                                                <th class="">Montant</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>


                                                    <div class="profile-user-info">
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Total colis </div>
                                                            <div class="profile-info-value">
                                                                <span id="totalColis"></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Poids Total </div>
                                                            <div class="profile-info-value">
                                                                <span id="PoidsTotal"></span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Montant HT </div>
                                                            <div class="profile-info-value">
                                                                <span id="MontantHt"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> Tva </label>
                                                            <div class="col-sm-7">
                                                                <input type="text" id="tva" name="tva" placeholder=""
                                                                       class="" value="0.18">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-6"></div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> Montant Ttc </label>
                                                            <div class="col-sm-7">
                                                                <input type="text" readonly id="montantTtc" name="montantTtc" placeholder=""
                                                                       class="" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-6"></div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> Mode de paiement </label>
                                                            <div class="col-sm-7">
                                                                <select id="modePaiement" class="">
                                                                    <option value="ESPECES">Especes</option>
                                                                    <option value="CHEQUE">Cheque</option>
                                                                    <option value="VIREMENT">Virement</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-6"></div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> No Cheque </label>
                                                            <div class="col-sm-7">
                                                                <div class="clearfix">
                                                                    <input type="text" readonly id="numCheque" placeholder=""
                                                                           class="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-6"></div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> Date de paiement </label>
                                                            <div class="col-sm-7">
                                                                <div class="clearfix">
                                                                    <input type="text" readonly id="datePaiement" placeholder=""
                                                                           class="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-6"></div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> Montant payé  (FCFA)</label>
                                                            <div class="col-sm-7">
                                                                <div class="clearfix">
                                                                    <input type="text" class="bolder"  id="avance" name="avance" placeholder=""
                                                                           class="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-6"></div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> Reliquat (FCFA)</label>
                                                            <div class="col-sm-7">
                                                                <div class="clearfix">
                                                                    <input type="text" class="bolder" readonly id="reliquat" name="reliquat" placeholder=""
                                                                           class="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="space-6"></div>
                                                    <div class="row">
                                                        <div class="space-12"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-5 control-label no-padding-right"
                                                                   for="form-field-1"> Reglé </label>
                                                            <div class="col-sm-7">
                                                                <div class="clearfix">
                                                                    <input type="checkbox" disabled="disabled" id="regleFacture" name="regleFacture" placeholder=""
                                                                           >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div style="float: right">
<!--                                                         <button id="SAVE" class="btn btn-small btn-info" > -->
<!--                                                             <i class="ace-icon fa fa-save"></i> -->
<!--                                                             Enregistrer -->
<!--                                                         </button> -->

<!--                                                     </div> -->
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
            var oTableFactures = null;
            var nbTotalFactureChecked = 0;
            var checkedFacture = new Array();
            // Check if an item is in the array

            checkedFactureContains = function (item) {
                for (var i = 0; i < checkedFacture.length; i++) {
                    if (checkedFacture[i] == item)
                        return true;
                }
                return false;
            };

            getIndicator = function() {
                var url;
                var user;
                url = '<?php echo App::getBoPath(); ?>/achat/FactureController.php';
                userProfil=$.cookie('profil');
                if(userProfil==='admin')
                   user = 'login=<?php echo $login; ?>';
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: user+'&ACTION=<?php echo App::ACTION_STAT_ANNULE; ?>&login=<?php echo $login?>&codeUsine=<?php echo $codeUsine; ?>',
                    cache: false,
                    success: function(data) {
                        $('#INDIC_ACHAT_VALIDES').text(data.nbValid);
                        $('#INDIC_ACHAT_NONVALIDES').text(data.nbNonValid);
                        $('#"INDIC_FACTURE_ANNULES"').text(data.nbAnnule);

//                        gStatTimer = setTimeout(function() {
//                            getIndicator();
//                        }, interval);
                    }
                });
            };
            getIndicator();
            
            // Persist checked Message when navigating
            persistChecked = function () {
                $('input[type="checkbox"]', "#LIST_FACTURES").each(function () {
                    if (checkedFactureContains($(this).val())) {
                        $(this).attr('checked', 'checked');
                    } else {
                        $(this).removeAttr('checked');
                    }
                });
            };
            $('table th input:checkbox').on('click', function () {
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox').each(function () {
                    this.checked = that.checked;
                    if (this.checked)
                    {
                        checkedFactureAdd($(this).val());
                        //MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                        $('#TAB_MSG_VIEW').hide();
                        nbTotalFactureChecked = checkedFacture.length;
                    }
                    else
                    {
                        checkedFactureRemove($(this).val());
//                        MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                        $('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });

            EnableAction = function ()
            {
                if (checkedFacture.length == 1)
                {
                    $('#MNU_ANNULATION').removeClass('disabled');
                    $('#MNU_IMPRIMER').removeClass('disabled');
                    var state = $('#stag' + checkedFacture[0]).val();
                    if (state == 1) {
                        $('#MNU_ANNULATION').addClass('disabled');
                        if ($.cookie('profil') == 'directeur') {
                            $('#MNU_ANNULATION').removeClass('disabled');
                        }
                    }
                    else if (state == 2) {

                        $('#MNU_ANNULATION').addClass('disabled');
                        if ($.cookie('profil') == 'directeur') {
                            $('#MNU_REMOVE').removeClass('disabled');
                        }
                    }
                }
                else if (checkedFacture.length > 1) {
                    $('#MNU_ANNULATION').removeClass('enable');
                    $('#MNU_IMPRIMER').removeClass('enable');
                    $('#MNU_REMOVE').addClass('disabled');
                    if ($.cookie('profil') == 'directeur') {
                        $('#MNU_ANNULATION').addClass('disabled');
                        $('#MNU_REMOVE').addClass('disabled');
                    }
                    bootbox.alert("Veuillez selectionnez une seule facture  SVP!");
                    //loadBons('*');
                }
                else {
                    $('#MNU_ANNULATION').removeClass('enable');
                    $('#MNU_IMPRIMER').removeClass('enable');
                    $('#MNU_ANNULATION').addClass('disabled');
                    $('#MNU_IMPRIMER').addClass('disabled');
                }
            };

            MessageSelected = function (click)
            {
                EnableAction();
                if (checkedFacture.length == 1) {
                    loadFactureSelected(checkedFacture[0]);
                    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                } else
                {
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();

                }
                if (checkedFacture.length == nbTotalFactureChecked) {
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function ()
            {
                EnableAction();
                if (checkedFacture.length === 1) {
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
            checkedFactureAdd = function (item) {
                if (!checkedMessageContains(item)) {
                    checkedFacture.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedFactureRemove = function (item) {
                var i = 0;
                while (i < checkedFacture.length) {
                    if (checkedFacture[i] == item) {
                        checkedFacture.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function (item) {
                for (var i = 0; i < checkedFacture.length; i++) {
                    if (checkedFacture[i] == item)
                        return true;
                }
                return false;
            };
            loadFactures = function () {
                nbTotalFactureChecked = 0;
                checkedFacture = new Array();
                var url = '<?php echo App::getBoPath(); ?>/facture/FactureController.php';
                if (oTableFactures != null)
                    oTableFactures.fnDestroy();
                oTableFactures = $('#LIST_FACTURES').dataTable({
                    "oLanguage": {
                        "sUrl": "<?php echo App::getHome(); ?>/datatable_fr.txt"
                    },
                    //"sDom": '<"top"i>rt<"bottom"lp><"clear">',
                    "aoColumnDefs": [
                        {
                            "aTargets": [0],
                            "bSort": false,
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                            },
                            "mRender": function (data, type, full) {
                                return '<label><input type="checkbox" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';
                            }
                        },
                        {
                            "aTargets": [1],
                            "bSortable": false,
                            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                            },
                            "mRender": function (data, type, full) {
                                var src = '<input type="hidden" id="stag' + full[0] + '" value="' + data + '">';
                                if (data == 0)
                                    src += '<span class=" tooltip-error" title="Annulé"><i class="ace-icon fa fa-trash red bigger-130 icon-only"></i></span>';
                                else if (data == 1)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Validé"><i class="ace-icon fa fa-check green bigger-130 icon-only"></i></span>';
                                return src;
                            }
                        }
                    ],
                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        persistChecked();
                        $(nRow).css('cursor','pointer');
                        $(nRow).on('click', 'td:not(:first-child)', function () {
                            checkbox = $(this).parent().find('input:checkbox:first');
                            if (!checkbox.is(':checked')) {
                                checkbox.prop('checked', true);
                                ;
                                checkedFactureAdd(aData[0]);
                                MessageSelected();

                            } else {
                                checkbox.removeAttr('checked');

                                checkedFactureRemove(aData[0]);
                                MessageUnSelected();
                            }
                        });
                    },
                    "fnDrawCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {

                    },
                    "preDrawCallback": function (settings) {

                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bInfo": true,
                    "sAjaxSource": url,
                    "sPaginationType": "full_numbers",
                    "fnServerData": function (sSource, aoData, fnCallback) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_FACTURE_ANNULES; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        aoData.push({"name": "codeUsine", "value": "<?php echo $codeUsine; ?>"});
                        $.ajax({
                            "dataType": 'json',
                            "type": "POST",
                            "url": sSource,
                            "data": aoData,
                            "success": function (json) {
                                if (json.rc == -1) {
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: json.error,
                                        class_name: 'gritter-error gritter-light'
                                    });
                                } else {
                                    $('table th input:checkbox').removeAttr('checked');
                                    fnCallback(json);
                                    nbTotalFactureChecked = json.iTotalRecords;
                                }

                            }
                        });
                    }
                });
            };

            loadFactures();
            loadFactureSelected = function (factureId)
            {
                var url;
                url = '<?php echo App::getBoPath(); ?>/facture/FactureController.php';

                $.post(url, {factureId: factureId, ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function (data) {
                    data = $.parseJSON(data);
                    $('#TAB_MSG_TITLE').text("Numero facture: " + data.numero);
                    $('#FactureDate').text(data.dateFacture);
                    $('#numFacture').text(data.numero);
                    $('#nomClient').text(data.nomClient);
                    $('#origine').text(data.adresse);
                    $('#pays').text(data.pays);
                    $('#user').text(data.user);
                    $('#totalColis').text(data.nbTotalColis);
                    $('#PoidsTotal').text(data.nbTotalPoids);
                    $('#MontantHt').text(data.montantHt);
                    $('#montantTtc').val(data.montantTtc);
                    if (data.modePaiement == '' && data.modePaiement == 'undefined')
                        $('#modePaiement').text(data.modePaiement);
                    $('#portDechargement').text(data.portDechargement);
                    if (data.numCheque !== null && data.numCheque !== "")
                        $('#numCheque').val(data.numCheque);
                    else
                        $('#numCheque').val('');
                    if (data.datePaiement !== null && data.datePaiement !== "")
                        $('#datePaiement').val(data.datePaiement);
                    else
                        $('#datePaiement').val('');
                    //colis
                    $('#tab_colis tbody').html("");
                    loadEditable = function (compteur)
                    {
                        $('#prix' + compteur).editable({
                            type: 'text',
                            name: 'prix',
                            title: "Saisir un montant",
                            id: 'id',
                            submit: 'OK',
                            emptytext: "Saisir un montant",
                            placement: "right",
                            validate: function (value) {


                                if (value === '')
                                    return 'Veuillez saisir  un montant S.V.P.';
                            },
                            placement: 'right',
                                    url: function (editParams) {
                                        var prix = editParams.value;
                                        function save() {
                                            var produitId = $('#prix' + compteur).closest('tr').attr('id');

                                            if ($.trim(prix) !== "") {
                                                var tot = 0;
                                                var qte = $('#quantite' + compteur).text();
                                                var montant = prix * parseFloat(qte);
                                                if (!isNaN(montant)) {
                                                    $('#montant' + compteur).text(montant);
                                                    $('#tab_produit .montant').each(function () {
                                                        if ($(this).html() !== 0)
                                                            tot += parseFloat($(this).html());
                                                    });
                                                    var Ttc = tot+(tot * (parseFloat($("#tva").val())/100));
                                                    $('#avance').val("");
                                                    $('#reliquat').val("");
                                                    $('#datePaiement').val("");
                                                    $('#numCheque').val("");
                                                    //$('#modePaiement').val("-1").change;
                                                    $('#transport').val("");
                                                }
                                                //console.log(tot);
                                                $('#MontantHt').text(tot);
                                                $('#montantTtc').val(Ttc);
                                                // saveAvance(checkedAchat[0], versement, $('.date-picker').val());
                                            }
                                            else {

                                                $.gritter.add({
                                                    title: 'Server notification',
                                                    text: "Veuillez saisir  un montant S.V.P.",
                                                    class_name: 'gritter-error gritter-light'
                                                });
                                            }
                                        }

                                        save(function () {
                                        });

                                    }

                        });
                    }
                    var tableColis = data.colis;
                    var trColisHTML = '';
                    $(tableColis).each(function (index, element) {
                        trColisHTML += '<tr><td>' + element.libelle + '</td><td>' + element.nombreCarton + '</td><td>' + element.quantiteParCarton + '</td></tr>';
                    });
                    $('#tab_colis tbody').append(trColisHTML);
                    trColisHTML = '';

                    $('#tab_conteneur tbody').html("");
                    var tableConteneur = data.conteneurs;
                    var trHTMLConteneur = '';
                    $(tableConteneur).each(function (indexC, elementC) {
                        trHTMLConteneur += '<tr><td>' + elementC.numConteneur + '</td><td>' + elementC.numPlomb + '</td></tr>';
                    });
                    $('#tab_conteneur tbody').append(trHTMLConteneur);
                    trHTMLConteneur = '';

                    $('#tab_produit tbody').html("");
                    var table = data.ligneFacture;
                    var trHTML = '';
                    $(table).each(function (index, element) {
                        var row = $('<tr id=' + element.id + ' />');
                        $("#tab_produit tbody").append(row);
                        var pu = '';
                        var mt = 0;
                        if (element.prixUnitaire !== 0 && element.prixUnitaire !== null) {
                            pu = element.prixUnitaire;
                        }
                        if (element.montant !== 0 && element.montant !== null) {
                            mt = element.montant;
                        }
                        row.append($('<td id="ligneId' + index + '">' + element.id + '</td>'));
                        row.append($('<td id="nbColis' + index + '">' + element.nbColis + '</td>'));
                        row.append($('<td id="designation' + index + '">' + element.produit + '</td>'));
                        row.append($('<td ><span class="editText" id="prix' + index + '">' + pu + '</span></td>'));
                        row.append($('<td  id="quantite' + index + '">' + element.quantite + '</td>'));
                        row.append($('<td class="montant" id="montant' + index + '">' + mt + '</td>'));
                        loadEditable(index);
                        // trHTML += '<tr><td>' + element.nbColis + '</td><td>' + element.produit + '</td><td>' + element.quantite + '</td><td>' + element.prixUnitaire + '</td><td>' + element.montant + '</td></tr>';
                    });
                    $('#tab_produit tbody').append(trHTML);
                    trHTML = '';
                    var infoAvance = data.reglement;
                    var mtAv = 0;
                    var rel = 0;
                    if (infoAvance !== null) {
                        $(infoAvance).each(function (index, element) {
                            mtAv += parseFloat(element.avance);
                        });
                        if (!isNaN(mtAv)) {
                            rel = data.montantTtc - mtAv;
                        }
                        $('#avance').val(mtAv);
                        $('#reliquat').val(rel);
//                    } 
//                    
                    }
                    else {
                        $('#avance').val("0.00");
                        $('#reliquat').val(data.montantTtc);
                    }

                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                    $('#TAB_MSG_VIEW').show();
                }).error(function (error) {
                });
            };


            $("#modePaiement").change(function () {
                if ($("#modePaiement").val() == 'CHEQUE') {
                    $("#numCheque").prop("readonly", false);
                    $("#datePaiement").prop("readonly", true);
                }
                else if ($("#modePaiement").val() == 'VIREMENT') {
                    $("#numCheque").prop("readonly", true);
                    $("#datePaiement").prop("readonly", false);
                }
                else {
                    $("#numCheque").prop("readonly", true);
                    $("#datePaiement").prop("readonly", true);

                }
            });
            $("#datePaiement").datepicker({
                autoclose: true,
                todayHighlight: true
            })
                    //show datepicker when clicking on the icon
                    .next().on(ace.click_event, function () {
                $(this).prev().focus();
            });
            $("#avance").keyup(function () {
                calculReliquat();
            });

            $("#tva").keyup(function () {
                var tva = parseFloat($("#tva").val());
                if (!isNaN(tva) && tva > 0) {
                    $('#montantTtc').val('');
                    var mtHt = parseFloat($('#MontantHt').text());
                    var mtTtc = 0;
                    mtTtc = mtHt + (mtHt * (tva / 100));
                    if(!isNaN(mtTtc) && mtTtc >0)
                        $('#montantTtc').val(mtTtc);
                    else
                        $('#montantTtc').val('');
                }
                else
                    $('#montantTtc').val('');
//        
            });
            function calculReliquat() {
                var rel = 0;
                var mt = parseFloat($("#montantTtc").val());
                var avance = parseFloat($("#avance").val());
                if (!isNaN(avance) && !isNaN(avance)) {
                    rel = mt - avance;
                    if (!isNaN(rel) && rel > 0) {
                        $("#reliquat").val(rel);
                        $('#regleFacture').attr("disabled", true);
                        $('#regleFacture').prop('checked', false);
                    }
                    else if (!isNaN(rel) && rel === 0) {
                        $('#regleFacture').attr("disabled", false);
                        $('#regleFacture').prop('checked', true);
                        $("#reliquat").val(0);
                    }
                    else {
                        $.gritter.add({
                            title: 'Notification',
                            text: 'Le montant saisi ne doit pas être supérieur au montant TTC',
                            class_name: 'gritter-error gritter-light'
                        });
                        $("#avance").val("");
                        $("#reliquat").val("");
                        $('#regleFacture').attr("disabled", true);
                        $('#regleFacture').prop('checked', false);
                    }
                }
                else {
                    $.gritter.add({
                        title: 'Notification',
                        text: 'Le montant avance ne doit pas être vide',
                        class_name: 'gritter-error gritter-light'
                    });
                }
            }

            $("#MNU_VALIDATION").click(function ()
            {
                if (checkedFacture.length == 0)
                    bootbox.alert("Veuillez selectionnez un facture");
                else if (checkedFacture.length == 1)
                {
                    bootbox.confirm("Voulez vous vraiment valider cet facture", "Non", "Oui", function (result) {
                        if (result) {
                            var factureId = checkedFacture[0];
                            $.post("<?php echo App::getBoPath(); ?>/facture/FactureController.php", {factureId: factureId, ACTION: "<?php echo App::ACTION_ACTIVER; ?>"}, function (data)
                            {
                                if (data.rc == 0)
                                {
                                    bootbox.alert("Facture validé");
                                }
                                else
                                {
                                    bootbox.alert(data.error);
                                }
                            }, "json");
                            $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/listebonsFactureVue.php", function () {
                            });
                        }
                    });
                }
                else if (checkedFacture.length > 1)
                {
                    bootbox.alert("Veuillez selectionnez un seule facture SVP!");
                }
            });
            $("#MNU_IMPRIMER").click(function ()
            {
                if (checkedFacture.length == 0)
                    bootbox.alert("Veuillez selectionnez un facture");
                else if (checkedFacture.length == 1)
                {
                    var factureId = checkedFacture[0];
                    window.open('<?php echo App::getHome(); ?>/app/pdf/facturePdf.php?factureId=' + factureId, 'nom_de_ma_popup', 'menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');

                }
                else if (checkedFacture.length > 1)
                {
                    bootbox.alert("Veuillez selectionnez une seul facture SVP!");
                }
            });


            $("#MNU_ANNULATION").click(function ()
            {
                if (checkedFacture.length == 0)
                    bootbox.alert("Veuillez selectionnez une facture");
                else if (checkedFacture.length >= 1)
                {
                    bootbox.confirm("Voulez vous vraiment annuler cette facture", function (result) {
                        if (result) {
                            var factureId = checkedFacture[0];
                            $.post("<?php echo App::getBoPath(); ?>/facture/FactureController.php", {factureId: factureId, ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function (data)
                            {
                                if (data.rc === 0)
                                {
                                    bootbox.alert("Facture annulée");
                                    loadFactures();
                                }
                                else
                                {
                                    bootbox.alert(data.error);
                                }
                            }, "json");

                        }
                    });
                }
            });


            $("#MNU_REMOVE").click(function ()
            {
                if (checkedBon.length == 0)
                    bootbox.alert("Veuillez selectionnez une facture");
                else if (checkedBon.length >= 1)
                {
                    bootbox.confirm("Voulez vous vraiment supprimer cette facture", function (result) {
                        if (result) {
                            var bonsortieId = checkedBon[0];
                            $.post("<?php echo App::getBoPath(); ?>/facture/FactureeController.php", {bonsortieId: bonsortieId, ACTION: "<?php echo App::ACTION_REMOVE; ?>"}, function (data)
                            {
                                if (data.rc === 0)
                                {
                                    bootbox.alert("Bon de sortie supprimé");
                                    getIndicator();
                                    loadFactures();

                                }
                                else
                                {
                                    bootbox.alert(data.error);
                                }
                            }, "json");

                        }
                    });
                }
            });
            
            ReglementProcess = function (factureId)
        {
           $('#SAVE').attr("disabled", true);
            var ACTION = '<?php echo App::ACTION_UPDATE; ?>';
            var frmData;
            //var achatId= factureId;
            var montantHt = $("#MontantHt").text();
            var tva = $("#tva").val();
            var montantTtc = $("#montantTtc").val();
            var modePaiement = $("#modePaiement").val();
            var numCheque = $("#numCheque").val();
            var datePaiement = $("#datePaiement").val();
            var avance = $("#avance").val();
            var reliquat = $("#reliquat").val();
            var Aregle = $("input:checkbox[name=regleAchat]:checked").val();
            var regle=false;
            if(Aregle === 'on')
                 regle=true;
             
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            var $table = $("#tab_produit");
            rows = [],
            header = [];

//$table.find("thead th").each(function () {
//    header.push($(this).html().trim());
//});
            header = ["ligneId","nbColis","libelle","pu","qte","montant"];
            $table.find("tbody tr").each(function () {
                var row = {};

                $(this).find("td").each(function (i) {
                    var key = header[i];
                    var value;
                        valueEditable = $(this).find('span').text();
                        valueTd = $(this).text();
                    if (typeof valueEditable !== "undefined")
                        value=valueEditable;
                    if (typeof valueTd !== "undefined")
                        value=valueTd;
                    row[key] = value;
                });

                rows.push(row);
            });
    
    
            var tbl=JSON.stringify(rows);
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('factureId', factureId);
            formData.append('montantHt', montantHt);
            formData.append('montantTtc', montantTtc);
            formData.append('tva', tva);
            formData.append('modePaiement', modePaiement);
            formData.append('numCheque', numCheque);
            formData.append('datePaiement', datePaiement);
            formData.append('avance', avance);
            formData.append('jsonProduit', tbl);
            formData.append('reliquat', reliquat);
            formData.append('regle', regle);
            formData.append('codeUsine', codeUsine);
            formData.append('login', login);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/facture/FactureController.php',
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'JSON',
                data: formData,
                success: function (data)
                {
                    if (data.rc == 0)
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.action,
                            class_name: 'gritter-success gritter-light'
                        });
                         $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_INFO_VIEW').show();
                   loadFactures();
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                        
                        $('#SAVE').attr("disabled", false);
                    };
                    
                },
                error: function () {
                    $('#SAVE').attr("disabled", false);
                    alert("failure - controller");
                }
            });

        };
        
        $("#SAVE").bind("click", function () {
            // alert(checkedAchat[0]);
             ReglementProcess(checkedFacture[0]);
         });


        });
    </script>