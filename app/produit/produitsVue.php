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
            Gestion des produits
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Produit
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-lg-3">
                       <div class="control-group">
                            <div class="controls">
                                <select id="GRP_CMB" style="width: 225px">
                                    <option value="*" class="groups"> Famille de produit </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="btn-group">
                                    <button data-toggle="dropdown"
                                            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
                                            data-rel="tooltip" data-placement="top" title="Famille de produit" style="
    height: 32px;
    width: 80px;
    margin-top: -1px;
">
                                        <i class="icon-group icon-only icon-on-right"></i> Famille
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li id='MNU_GRP_NEW'><a href="#" id="GRP_NEW">Nouveau </a></li>
                                        <li class="divider"></li>
                                        <li id='MNU_GRP_EDIT'><a href="#" id="GRP_EDIT">Renommer</a></li>
                                        <li id='MNU_GRP_REMOVE'><a href="#" id="GRP_REMOVE">Supprimer</a></li>
                                    </ul>
                                </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="btn-group">
                                    <button data-toggle="dropdown"
                                            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
                                            data-rel="tooltip" data-placement="top" title="Famille de prodiot" style="
    height: 32px;
    width: 80px;
    margin-top: -1px;
">
                                        <i class="icon-group icon-only icon-on-right"></i> Produit
                                    </button>

                                    <ul class="dropdown-menu dropdown-info">
                                        <li id='MNU_PRODUIT_NEW'><a href="#" id="GRP_NEW">Nouveau </a></li>
                                        <li class="divider"></li>
                                        <li id='MNU_PRODUIT_EDIT'><a href="#" id="GRP_EDIT">Modifier</a></li>
                                        <li id='MNU_PRODUIT_REMOVE'><a href="#" id="GRP_REMOVE">Supprimer</a></li>
                                    </ul>
                                </div>
                    </div>
                </div>
            </div>
            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="#modal-table" role="button" class="green" data-toggle="modal"> Liste des produits </a>
            </h4>
            <div class="row">
                <div class="col-xs-12">
                    <!-- div.dataTables_borderWrap -->
                    <div>
                        <table id="LIST_PRODUITS" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>Désignation</th>
                                    <th>Poids Net</th>
                                    <th>Prix de vente</th>
                                    <th>Stock</th>
                                    <th>Seuil</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="winModalFamille" class="modal fade" tabindex="-1">
                 <form id="FRM_GROUP" class="form-horizontal" action="#" onsubmit="return false;" style="margin-bottom: 0px">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Famille de produit</h3>
                        </div>

                        <div class="modal-body">
                            <form id="FRM_PRODUIT" class="form-horizontal" role="form">
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Famille </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="FAMILLEPRODUIT" name="FAMILLEPRODUIT" placeholder="" class="col-xs-10 col-sm-6">
                                        <input type="hidden" id="ACTION" value="INSERT">
                                        <input type="hidden" id="nameFamilleProduit" value="">
                                        <input type="hidden" id="familleProduitId" value="">
                                    </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="FRM_FAMILLE_SAVE" class="btn btn-small btn-info" >
                                <i class="ace-icon fa fa-save"></i>
                                Enregistrer
                            </button>
                            
                            <button class="btn btn-small btn-danger" data-dismiss="modal">
                                <i class="ace-icon fa fa-times"></i>
                                Annuler
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                
                            </form>
            </div>
            
            <div id="winModalProduit" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Produit</h3>
                        </div>

                        <div class="modal-body" style="height: 340px;">
                            <form id="FRM_PRODUIT" class="form-horizontal" role="form">
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Famille de produit</label>
                                    <div class="col-sm-9">
                                        <select id="GRP_NEW_CMB" data-placeholder="" style="width: 225px">
                                            <option value="*" class="groups">Sélectionnez</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Désignation </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="designation" name="designation" placeholder="" class="col-xs-10 col-sm-8">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Poids brut</label>
                                    <div class="col-sm-6">
                                            <input type="text" id="poidsBrut" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                                    <div class="col-sm-2" style="margin-left: -20%;">
                                        <input type="number" id="pourcentage" placeholder="" class="col-xs-10 col-sm-7">&nbsp;%
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Poids Net</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly id="poidsNet" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Prix unitaire </label>
                                    <div class="col-sm-9">
                                            <input type="text" id="prixUnit" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock </label>
                                    <div class="col-sm-9">
                                            <input type="text" id="stock" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Seuil </label>
                                    <div class="col-sm-9">
                                            <input type="text" id="seuil" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="SAVE" class="btn btn-small btn-info" data-dismiss="modal">
                                <i class="ace-icon fa fa-save"></i>
                                Enregistrer
                            </button>
                            
                            <button id="CANCEL" class="btn btn-small btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                Annuler
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
 
</div><!-- /.page-content -->

<script type="text/javascript">
    $(document).ready(function() {

        var nbTotalChecked=0;
        var checkedProduit = new Array();
        var oTableProduit = null;
        var familleId="";
    $("#GRP_CMB").select2
    $("#GRP_NEW_CMB").select2();
    
     // Add checked item to the array
        checkedProduitAdd = function(item) {
            if (!checkedProduitContains(item)) {
                checkedProduit.push(item);
            }
        }
        // Remove unchecked items from the array
        checkedProduitRemove = function(item) {
            var i = 0;
            while (i < checkedProduit.length) {
                if (checkedProduit[i] == item) {
                    checkedProduit.splice(i, 1);
                } else {
                    i++;
                }
            }
        }
        // Check if an item is in the array
        checkedProduitContains = function(item) {
            for (var i = 0; i < checkedProduit.length; i++) {
                if (checkedProduit[i] == item)
                    return true;
            }
            return false;
        }
        // Persist checked contact when navigating
        persistChecked = function() {
            $('input[type="checkbox"]', "#LIST_PRODUITS").each(function() {
                if (checkedProduitContains($(this).val())) {
                    $(this).attr('checked', 'checked');
                } else {
                    $(this).removeAttr('checked');
                }
            });
        };
        contactSelected = function()
        {
            enableContactMenu();
        }
        contactUnSelected = function()
        {
            disableContactMenu();
        }
         $('table th input:checkbox').on('click', function() {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox').each(function() {
                this.checked = that.checked;
                if (this.checked)
                {
                    checkedProduitAdd($(this).val());
                    contactSelected();
                    nbTotalChecked=checkedProduit.length;
                    alert(checkedProduit);
                }
                else
                {
                    checkedProduitRemove($(this).val());
                    if (checkedProduit.length == 0)
                        contactUnSelected();
                }
                $(this).closest('tr').toggleClass('selected');
            });
            });
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
            
           loadNewFamilleProduit = function(){
            $.post("<?php echo App::getBoPath(); ?>/produit/FamilleProduitController.php", {userId: "<?php echo $userId;?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(data) {
                sData=$.parseJSON(data);
                if(sData.rc==-1){
                    $.gritter.add({
                            title: 'Notification',
                            text: sData.error,
                            class_name: 'gritter-error gritter-light'
                        });
                }else{
                    $("#GRP_NEW_CMB").loadJSON('{"groups":' + data + '}');
                }
            });
            }
    loadFamilleProduit();
    loadNewFamilleProduit();
        $("#MNU_GRP_NEW").click(function()
        {
           $("#groupName").val('');
            $('#winModalFamille .control-group').removeClass('error').addClass('info');
            $('#winModalFamille span.help-block').remove();
            $('#winModalFamille').modal('show');
        });
        
        $("#MNU_PRODUIT_NEW").click(function()
        {
           //$("#groupName").val('');
          
            $('#winModalProduit .control-group').removeClass('error').addClass('info');
            $('#winModalProduit span.help-block').remove();
            $('#winModalProduit').modal('show');
        });
        
        $("#FRM_FAMILLE_SAVE").click(function()
        {
            $.validator.addMethod(
                "regexGroupName",
                function(value, element, regexp) {
                    return this.optional(element) || regexp.test(value);
                },
                "Les caracteres spéciaux ne sont pas autorisés"
            );
            context=$(this);
            $("#FRM_GROUP").validate({
                errorElement: 'span',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    FAMILLEPRODUIT: {
                        required: true,
//                        regexGroupName: /^[&-_a-zA-Z0-9\u00E0-\u00FC ]+(&|\w)*$/
                        regexGroupName: /[a-zA-Z0-9_&,\-\ ]/ // /^[a-zA-Z\u00E0-\u00FC ]+$/ //regexGroupName: /^[a-zA-Z0-9\u00E0-\u00FC ]+(&|\w)*$/
                    }
                },
                messages: {
                    FAMILLEPRODUIT: {
                        required: "Champ obligatoire"
                    }
                },
                errorPlacement: function(error, element) {
                    var container = $('<div />');
                    container.addClass('Ntooltip');
                    error.insertAfter(element);
                    error.wrap(container);
                    $("<div class='errorImage'></div>").insertAfter(error);
                },
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('help-block error');
                },
                success: function(e) {
                    $(e).closest('.control-group').removeClass('error').addClass('info');
                },
                submitHandler: function(form) {
                    var ACTION = $("#ACTION").val();
                    var familleId = $("#familleProduitId").val();
                    var libelle = $("#FAMILLEPRODUIT").val();
//                    var frmData = 'userId=<?php echo $userId; ?>&ACTION=' + ACTION + '&groupId=' + groupId + '&groupName=' + groupName;
                $.ajax({
                    url: '<?php echo App::getBoPath(); ?>/produit/FamilleProduitController.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                      //  userId: <?php echo $userId; ?>,
                        ACTION: ACTION,
                        familleId: familleId,
                        familleName: libelle
                    },
                success: function(data)
                {
                    $('#winModalFamille').modal('hide');
                    if (data.rc == 0){
                        //$("#GRP_CMB").val(familleId).change();
                        //loadContact(groupId);
                        $.gritter.add({
                            title: 'Notification',
                            text: data.action,
                            class_name: 'gritter-success gritter-light'
                        });
                        if(familleId!==""){
                            jsonText='{"value":'+familleId+', "text":"'+libelle+'"}';
                            jsonText=JSON.parse(jsonText);
                            familleId=familleId;
                            $("#GRP_CMB").select2("data", jsonText, true);
                        }
                        loadFamilleProduit();
                    }else{
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                    }
                },
                error: function() {
                    alert("failure");
                }
            });
                },
                invalidHandler: function(form) {
                }
            });
        });
          
          $("#MNU_GRP_EDIT").click(function()
        {
            var familleId = $("#GRP_CMB").val();
            if (familleId !== "*")
            {
                $.post("<?php echo App::getBoPath(); ?>/produit/FamilleProduitController.php", {familleId: familleId, ACTION: "<?php echo App::ACTION_VIEW; ?>"}, function(data) {
                    data = $.parseJSON(data);
                    $("#ACTION").val('<?php echo App::ACTION_UPDATE; ?>');
                    $("#familleProduitId").val(data.familleId);
                    $("#FAMILLEPRODUIT").val(data.familleName);
                });
                $('#winModalFamille .control-group').removeClass('error').addClass('info');
                $('#winModalFamille span.help-block').remove();
                $('#winModalFamille').modal('show');
            }
            else
                bootbox.alert("Veuillez choisir une famille de produit");
        });
        
        $("#MNU_GRP_REMOVE").click(function()
        {
            var familleId = $("#GRP_CMB").val();
            if (familleId != "*")
            {
                bootbox.confirm("Etes vous sur de vouloir supprimer", function(result) {
                    if (result) {
                        $.post("<?php echo App::getBoPath(); ?>/produit/FamilleProduitController.php", {familleId: familleId, ACTION: "<?php echo App::ACTION_REMOVE; ?>"}, function(data) {
                            bootbox.alert("Famille de produit supprimé");
                            loadFamilleProduit();
                            $('#GRP_CMB').val('*').change();
                        });
                    }
                });
            }
            else
                bootbox.alert("Veuillez choisir une famille de produit");
        });
        
       loadProduit = function(familleId) {
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
        
        loadProduit($("#GRP_CMB").val());
        
         produitProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var familleproduit= $('#GRP_NEW_CMB').val();
            var designation = $("#designation").val();
            var poidsBrut = $("#poidsBrut").val();
            var poidsNet = $("#poidsNet").val();
            var prixUnit = $("#prixUnit").val();
            var stock = $("#stock").val();
            var seuil = $("#seuil").val();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('familleId', familleproduit);
            formData.append('designation', designation);
            formData.append('poidsBrut', poidsBrut);
            formData.append('poidsNet', poidsNet);
            formData.append('prixUnitaire', prixUnit);
            formData.append('stock', stock);
            formData.append('seuil', seuil);
            formData.append('codeUsine', codeUsine);
            formData.append('login', login);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/produit/ProduitController.php',
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
                       loadProduit();
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                        
                    };
                    
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };
     $("#SAVE").bind("click", function () {
            produitProcess();
            $('#winModalProduit').addClass('hide');
            $('#winModalProduit').modal('hide');
        });
$("#MNU_PRODUIT_EDIT").click(function()
        {
            if (!$(this).hasClass('disabled')) {
                if (checkedProduit.length > 1) {
                    bootbox.alert("Veullez selectionnez un produit");
                    loadProduit($("#GRP_CMB").val());
                    checkedProduit = new Array();
                    disableContactMenu();
                }
                else
                {
                    var produitId = checkedProduit[0];
                    alert(produitId);
            if (produitId !== "*")
            {
                $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {produitId: produitId, ACTION: "<?php echo App::ACTION_VIEW; ?>"}, function(data) {
                    data = $.parseJSON(data);
                    $("#ACTION").val('<?php echo App::ACTION_UPDATE; ?>');
                    $("#familleProduitId").val(data.familleId);
                    $("#description").val(data.description);
                    $("#poidsNet").val(data.poidsNet);
                    $("#prixUnit").val(data.prixUnitaire);
                    $("#stock").val(data.stock);
                    $("#seuil").val(data.seuil);
                });
                $('#winModalProduit .control-group').removeClass('error').addClass('info');
                $('#winModalProduit span.help-block').remove();
                $('#winModalProduit').modal('show');
            }
                }
            }
    });
    
        $("#winModalProduit").bind("click", function () {
            calculPoidsNet();
            calculSeuil();
            
        });
        
        $("#seuil").bind("focus", function () {
            calculSeuil();
            
        });
        function calculPoidsNet(){
           var pn;
           if($("#pourcentage").val() !=="") {
              var pourcentage = $("#pourcentage").val();
              var poidsBrut = $("#poidsBrut").val();
              pn = parseInt(poidsBrut) - ((parseInt(poidsBrut) * pourcentage)/100);
              if(!isNaN(pn))
                $("#poidsNet").val(pn);
              
            }  
       }
       
       function calculSeuil(){
           var stock = $("#stock").val();
            var seuil;
           if(stock !=="") {
              seuil = (parseInt(stock) * 25)/100;
              if(!isNaN(seuil))
                $("#seuil").val(seuil);
            }  
       }
    });
</script>
