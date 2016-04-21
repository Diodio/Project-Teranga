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
            Gestion des utilisateurs
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des utilisateurs
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
         
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-users orange"></i>
                            Liste des utilisateurs
                        </h4>
                                        <div class="btn-group">
                                            <button id="BTN_NEW"
                                                    class="btn btn-primary btn-mini tooltip-info"
                                                    data-rel="tooltip" data-placement="top"
                                                    title="Nouveau">
                                                <i class="icon-cloud-upload icon-only"></i> Nouveau
                                            </button>
                                        </div>
                                       <div class="btn-group">
                                            <button id="BTN_ACTIVER"
                                                    class="btn btn-primary btn-mini tooltip-info"
                                                    data-rel="tooltip" data-placement="top"
                                                    title="Activer">
                                                <i class="icon-cloud-download icon-only"></i> Activer
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button id="BTN_DESACTIVER"
                                                    class="btn btn-primary btn-mini tooltip-info"
                                                    data-rel="tooltip" data-placement="top"
                                                    title="Desactiver">
                                                <i class="icon-cloud-download icon-only"></i> Desactiver
                                            </button>
                                        </div>
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                          
                    </div>
                        
                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_UTILISATEURS" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th style="width: 5%;"></th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Nom Complet
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                   Profil
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                   Login
                                </th>
                                   <th style="border-left: 0px none;border-right: 0px none;">
                                   Mot de passe
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Usine
                                </th>
                                <th class="center"><i class="smaller-70"></i>
                                                Statut</th>
                                <th class="center" style="width: 10%;"></th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
            <div id="winModalUser" class="modal fade">
            <form id="validation-form" class="form-horizontal"  onsubmit="return false;">
                <div class="modal-dialog">
                    <div class="modal-content" >
                        <div class="modal-header" style="margin-top:-5px">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Nouveau utilisateur</h3>
                        </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nom Complet </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="nom" name="nom" placeholder="" class="col-xs-10 col-sm-7" style="margin-top: 10px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: -5px;"> Login </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="login" name="login" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: -5px;"> Mot de passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" id="motDePasse" name="motDePasse" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: -11px;"> Confirmer mot de passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" id="confMotDePasse" name="confMotDePasse" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>

                                </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: -11px;"> Usine</label>
                                        <div class="col-sm-9" style="margin-top: -4px;margin-left: -12px;">
                                            <select id="CMB_USINE" name="CMB_USINE" data-placeholder="" class="col-xs-10 col-sm-7">
                                                <option value="-1" class="usines">Selectionnez</option>
                                        </select>
                                        </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: -4px;"> Profil</label>
                                    <div class="col-sm-9" style="margin-left: -12px;">
                                        <select id="CMB_PROFIL" name="CMB_PROFIL" data-placeholder="" class="col-xs-10 col-sm-7">
                                                <option value="-1" class="profils">Selectionnez</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                    <button id="SAVE" class="btn btn-small btn-info">
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
            </form>
            </div>
</div>
        
       <script type="text/javascript">
    $(document).ready(function () {
            var oTableUsers = null;
            var nbTotalUsersChecked=0;
            var checkedUsers = new Array();
            
            var utilisateurId=0;
            // Check if an item is in the array
           // var interval = 500;
           
           $("#CMB_USINE").select2();
           $("#CMB_PROFIL").select2();
           $("#BTN_NEW").click(function()
           {
            $('#winModalUser').modal('show');
           });
           loadUsines = function(){
                $.post("<?php echo App::getBoPath(); ?>/usine/UsineController.php", {ACTION: "<?php echo App::ACTION_LIST
                        ; ?>"}, function(data) {
                    sData=$.parseJSON(data);
                    if(sData.rc==-1){
                        $.gritter.add({
                                title: 'Notification',
                                text: sData.error,
                                class_name: 'gritter-error gritter-light'
                            });
                    }else{
                        $("#CMB_USINE").loadJSON('{"usines":' + data + '}');
                    }
                });
            };
            
            loadProfils = function(){
                $.post("<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php", {ACTION: "<?php echo App::ACTION_LIST_PROFIL
                        ; ?>"}, function(data) {
                    sData=$.parseJSON(data);
                    if(sData.rc==-1){
                        $.gritter.add({
                                title: 'Notification',
                                text: sData.error,
                                class_name: 'gritter-error gritter-light'
                            });
                    }else{
                        $("#CMB_PROFIL").loadJSON('{"profils":' + data + '}');
                    }
                });
            };
            loadUsines();
            loadProfils();
            checkedUsersContains = function(item) {
                for (var i = 0; i < checkedUsers.length; i++) {
                    if (checkedUsers[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_UTILISATEURS").each(function() {
                    if (checkedUsersContains($(this).val())) {
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
                        checkedUsersAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalUsersChecked=checkedUsers.length;
                    }
                    else
                    {
                        checkedUsersRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_UTILISATEURS tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedUsersAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedUsersRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedUsers.length==nbTotalUsersChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
         
           // $('#SAVE').attr("disabled", true);
            MessageSelected = function(click)
            {
                if (checkedUsers.length == 1){
                    $('#SAVE').attr("disabled", false);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("");
                    $('#stockReel').val("");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedUsers.length==nbTotalUsersChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedUsers.length === 1){
                   $('#SAVE').attr("disabled", false);
		    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }
                else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("");
                    $('#stockReel').val("");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    $('#SAVE').attr("disabled", false);
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    $("#BTN_MSG_GROUP").popover('destroy');
                    $("#BTN_MSG_CONTENT").popover('destroy');
                }
                $('table th input:checkbox').removeAttr('checked');
            };

            // Add checked item to the array
            checkedUsersAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedUsers.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedUsersRemove = function(item) {
                var i = 0;
                while (i < checkedUsers.length) {
                    if (checkedUsers[i] == item) {
                        checkedUsers.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedUsers.length; i++) {
                    if (checkedUsers[i] == item)
                        return true;
                }
                return false;
            };
            showPopover = function(idButton, colis){
            $("#" + idButton).popover({
                html: true,
                trigger: 'focus',
                placement: 'left',
                title: '<i class="icon-group icon-"></i> Détail colis ',
                content: colis
            }).popover('toggle');
         };
             loadUsers = function() {
                nbTotalUsersChecked = 0;
                checkedUsers = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php';

                if (oTableUsers != null)
                    oTableUsers.fnDestroy();

                oTableUsers = $('#LIST_UTILISATEURS').dataTable({
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
                                return '<label><input type="checkbox" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';                             }
                        },
                        {   
                            "aTargets": [1],
                            "bSortable": false,
                                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                             },
                                "mRender": function (data, type, full) {
                                    var src = '<input type="hidden" >';
                                    if (full[1] != null && full[1] !== '1')
                                        src += '<span class="infobox-red tooltip-error"  title="Desactivé"><i class="fa fa-check"></i></span>';
                                    else
                                        src += '<span class="infobox-green tooltip-error"  title="Activé"><i class="fa fa-check"></i></span>';
                                    
                                return src;
                            }
                          },
                            {   
                                "aTargets": [7],
                                "bSortable": false,
                                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                                    $(nTd).css('text-align', 'center');
                                 },
                                    "mRender": function (data, type, full) {
                                        var src = '<input type="hidden" >';
                                        if (full[7] != null && full[7] == '0')
                                            src += '<span class="infobox-red tooltip-error"  title="Hors ligne"><i class="fa fa-circle"></i></span>';
                                        else if (full[7] != null && full[7] == '1')
                                            src += '<span class="infobox-green tooltip-error"  title="En ligne"><i class="fa fa-circle"></i></span>';

                                    return src;
                                }
                              },
                            {
                                "aTargets": [8],
                                "bSortable": false,
                                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                    
                                    $(nTd).css('text-align', 'center');
                                    $(nTd).text('');
                                    $(nTd).addClass('td-actions');
                                    action=$('<div></div>');
                                    action.addClass('pull-right hidden-phone visible-desktop action-buttons');
                                    btnEdit=$('<a class="green" href="#"> '+
                                    '<i class="fa fa-pencil bigger-130"></i>'+
                                    '</a>');
                                    btnEdit.click(function(){
                                         $.post("<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php", {utilisateurId: oData[0], ACTION: "<?php echo App::ACTION_VIEW; ?>"}, function (data) {
                                        data = $.parseJSON(data);
                                        console.log(oData[0]);
                                        utilisateurId=oData[0];
                                        $('#nom').val(data.nomUtilisateur);
                                        $('#login').val(data.login);
                                        $('#motDePasse').val(data.password);
                                        $('#confMotDePasse').val(data.password);
                                        $('#CMB_USINE').val(data.usine_id).change();
                                        $('#CMB_PROFIL').val(data.profil_id).change();
                            });
                                       
                                        $('#winModalUser').modal('show');
                                    });
                                    btnEdit.tooltip({
                                        title: 'Modifier'
                                    });
                                    //if (full[5] !== "Admin"){
                                    btnRemove=$('<a class="red" href="#">'+
                                                '<i class="fa fa-trash bigger-130"></i>'+
                                                '</a>');
                                    //}
                                    btnRemove.click(function(){
                                        removeUser(oData[0]);
                                    });
                                    btnRemove.tooltip({
                                        title: 'Supprimer'
                                    });
                                    btnEdit.css({'margin-right': '10px', 'cursor':'pointer'});
                                    btnRemove.css({'cursor':'pointer'});
                                    action.append(btnEdit);
                                   // if(oData[4] !=="Admin"){
                                    action.append(btnRemove);
                                  //  }
                                    $(nTd).append(action);
                                }
                            }
                    ],
                    
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
//                        persistChecked();
//                        $(nRow).css('cursor','pointer');
//                        $(nRow).on('click', 'td:not(:first-child)', function(){
//                            checkbox=$(this).parent().find('input:checkbox:first');
//                            if(!checkbox.is(':checked')){
//                                checkbox.prop('checked', true);;
//                                checkedUsersAdd(aData[0]);
//                                MessageSelected();
//                                
//                            }else{
//                                checkbox.removeAttr('checked');
//                                
//                                checkedUsersRemove(aData[0]);
//                                MessageUnSelected();
//                            }
//                        });
                    },
                    "fnDrawCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                       
                    },
                    "preDrawCallback": function( settings ) {
                       
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bInfo": true,
                    "sAjaxSource": url,
                    "sPaginationType": "full_numbers",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        aoData.push({"name": "usineCode", "value": "<?php echo $codeUsine;?>"});
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
                                  nbTotalUsersChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadUsers();
             SaveOrEditProcess = function (utilisateurId)
        {
            
            var ACTION;
            ACTION='<?php echo App::ACTION_INSERT; ?>';
                
            var nom= $('#nom').val();
            var login = $("#login").val();
            var password = $("#motDePasse").val();
            var usineId = $("#CMB_USINE").val();
            var profilId = $("#CMB_PROFIL").val();
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('utilisateurId', utilisateurId);
            formData.append('utilisateurNom', nom);
            formData.append('utilisateurLogin', login);
            formData.append('password', password);
            formData.append('usineId', usineId);
            formData.append('profilId', profilId);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php',
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
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                        
                    };
                    loadUsers();
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };
         $("#CANCEL").click(function()
           {
            $('#nom').val("");
            $('#login').val("");
            $('#motDePasse').val("");
            $('#confMotDePasse').val("");
            $('#CMB_USINE').val("-1").change();
            $('#CMB_PROFIL').val("-1").change();
            utilisateurId=0;
           });
         $("#SAVE").click(function() {
         $.validator.addMethod(
            "assertConfirmPwdTrue",
            function(value, element, regexp) {
                //return value===regexp;
                var pwd = $("#motDePasse").val();
                var pwdconf = $("#confMotDePasse").val();
                if(pwd !== pwdconf){
                    return false;
                }
                else{
                    return true;
                }
            },
            "les mots de passe ne sont pas identiques"
        );
        $.validator.addMethod("notEqual", function(value, element, param) {
		            return this.optional(element) || value != param;
		            });   
       	 $('#validation-form').validate({
       			errorElement: 'div',
       			errorClass: 'help-block',
       			focusInvalid: false,
       			rules: {
       				nom: {
       					required: true
       				},
       				login: {
       					required: true
       				},
       				motDePasse: {
       					required: true
       				},
       				confMotDePasse: {
       					required: true,
                                        assertConfirmPwdTrue: true
       				},
       				CMB_USINE: {
       					notEqual: "-1"
       				},
       				CMB_PROFIL: {
       					notEqual: "-1"
       				}
       				
       			},

       			messages: {
       				nom: {
       					required: "Champ obligatoire."
       				},
       				login: {
       					required: "Champ obligatoire."
       				},
       				motDePasse: {
       					required: "Champ obligatoire."
       				},
       				confMotDePasse: {
       					required: "Champ obligatoire.",
                                        assertConfirmPwdTrue: "Les mots de passe ne sont pas identiques"
       				},
       				CMB_USINE: {
       					notEqual: "Champ obligatoire."
       				},
       				CMB_PROFIL: {
       					notEqual: "Champ obligatoire."
       				}
       			},


       			highlight: function (e) {
       				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
       			},

       			success: function (e) {
       				$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
       				$(e).remove();
       			},

       			errorPlacement: function (error, element) {
       				 error.insertAfter(element);
       			},

       			submitHandler: function (form) {
                        SaveOrEditProcess(utilisateurId);
                        $('#winModalUser').modal('hide');
                        $('#nom').val("");
                        $('#login').val("");
                        $('#motDePasse').val("");
                        $('#confMotDePasse').val("");
                        $('#CMB_USINE').val("-1").change();
                        $('#CMB_PROFIL').val("-1").change();
                        utilisateurId=0;
       			},
       			invalidHandler: function (form) {
       			}
       		});
        });
        removeUser=function(usersId){
                    bootbox.confirm("Voulez vous vraiment supprimer cet utilisateur", function(result) {
                        if (result) {
                             var userIdsChecked = usersId;
                            $.post("<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php", {userIds: userIdsChecked + "", ACTION: "<?php echo App::ACTION_REMOVE; ?>"}, function(data) {
                                if (data.rc == 0){
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: "Utilisateur supprime",
                                        class_name: 'gritter-success gritter-light'
                                    });
                                    $('table th input:checkbox').removeAttr('checked');
                                     checkedUser=new Array();
                                    loadUsers();
                                }
                                else{
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: 'Impossible de supprimer cet utilisateur',
                                        class_name: 'gritter-warning gritter-light'
                                    });
                                    
                               // $("#NOTIF_ALERT").append("<div class='alert alert-danger'> <button class='close' data-dismiss='alert'> <i class='icon-remove'></i></button><i class='icon-hand-right'></i> <?php// printf($pNotifSupUserAlert); ?> </div>");
                                }
                            }, "json");
                        }
                    });
                }

        $("#BTN_ACTIVER").click(function () {
                    if(checkedUsers.length!=0){
                        userCheckedId = checkedUsers[0];
                        bootbox.confirm("Etes vous sur de vouloir activer cet utilisateur", function(result) {
                        if (result) {
                             var userIdsChecked = checkedUsers;
                            $.post("<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php", {userIds: userIdsChecked + "", ACTION: "<?php echo App::ACTION_ACTIVER; ?>"}, function(data) {
                                if (data.rc == 0){
                                     if(data.oId!==0){
                                    $.gritter.add({
                                    title: 'Notification',
                                    text: data.oId+" Utilisateur activé",
                                    class_name: 'gritter-success gritter-light'
                                    });
                                }else{ $.gritter.add({
                                    title: 'Notification',
                                    text: " Utilisateur non activé",
                                    class_name: 'gritter-warning gritter-light'
                                    }); }
                                    $('table th input:checkbox').removeAttr('checked');
                                    checkedUsers=new Array();
                                    loadUsers();
                                }
                                else{
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: data.error,
                                        class_name: 'gritter-error gritter-light'
                                    });
                                }
                            }, "json");
                        }
                });
                    }else{
                        bootbox.alert("Veuillez choisir un utilisateur");
                    }
                });
                $("#BTN_ACTIVER").tooltip({
                    title: 'Activer un utilisateur'
                });
                $("#BTN_DESACTIVER").click(function () {
                     if(checkedUsers.length!=0){
                     userCheckedId = checkedUsers[0];
                        bootbox.confirm("Voulez vous desactiver cet utilisateur", function(result) {
                        if (result) {
                            var userIdsChecked = checkedUsers;
                            $.post("<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php", {userIds: userIdsChecked + "", ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function(data) {
                                if (data.rc == 0){
                                    if(data.oId!==0){
                                    $.gritter.add({
                                    title: 'Notification',
                                    text: data.oId+" utilisateur desactivé",
                                    class_name: 'gritter-success gritter-light'
                                    });
                                }else{ $.gritter.add({
                                    title: 'Notification',
                                    text: "Utilisateur non desactivé",
                                    class_name: 'gritter-warning gritter-light'
                                    }); }
                                $('table th input:checkbox').removeAttr('checked');
                                checkedUsers=new Array();
                                loadUsers();
                                }
                                else{
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: data.error,
                                        class_name: 'gritter-error gritter-light'
                                    });
                                }
                            }, "json");
                        }
                });
              
                    }else{
                        bootbox.alert("Veuillez choisir un utilisateur");
                    }
                });
                $("#BTN_DESACTIVER").tooltip({
                    title: 'Desactiver un utilisateur'
                });
     });
        </script>