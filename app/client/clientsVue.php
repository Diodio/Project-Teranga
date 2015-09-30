<?php
    require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
    $userId = 1;
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Gestion des clients
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Client
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                  
                
                    <div class="col-lg-1">
                        <div class="btn-group">
                                    <button data-toggle="dropdown" id='MNU_CLIENT_NEW'
                                            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
                                            data-rel="tooltip" data-placement="top" title="Famille de prodiot" style="height: 32px;width: 80px; margin-top: -1px;
">
                                        <i class="icon-group icon-only icon-on-right"></i> Nouveau
                                    </button>

<!--                                     <ul class="dropdown-menu dropdown-info"> -->
<!--                                         <li id='MNU_CLIENT_NEW'><a href="#" id="CLIENT_NEW">Nouveau </a></li> -->
<!--                                         <li class="divider"></li> -->
<!--                                         <li id='MNU_CLIENT_EDIT'><a href="#" id="CLIENT_EDIT">Modifier</a></li> -->
<!--                                         <li class="divider"></li> -->
<!--                                         <li id='MNU_CLIENT_REMOVE'><a href="#" id="CLIENT_REMOVE">Supprimer</a></li> -->
<!--                                     </ul> -->
                                </div>
                    </div>
                </div>
            </div>
            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="#modal-table" role="button" class="green" data-toggle="modal"> Liste des clients </a>
            </h4>
            <div class="row">
                <div class="col-xs-12">
                    <!-- div.dataTables_borderWrap -->
                    <div>
                        <table id="LIST_CLIENTS" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Telephone</th>
                                    <th ></th>
                                </tr>
                            </thead>

                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    
            
            <div id="winModalClient" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Client</h3>
                        </div>

                        <div class="modal-body" style="height: 200px;">
                            <form id="FRM_CLIENT" class="form-horizontal" role="form">
                          
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nom </label>
                                    <div class="col-sm-9">
                                            <input type="text" id="nom" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Adresse</label>
                                    <div class="col-sm-9">
                                            <input type="text" id="adresse" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                                    
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telephone</label>
                                    <div class="col-sm-9">
                                        <input type="text"  id="telephone" placeholder="" class="col-xs-10 col-sm-7">
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
        var checkedClient = new Array();
        var oTableClient = null;
        var familleId="";
    $("#CLIENT_CMB").select2
    $("#CLIENT_NEW_CMB").select2();
     // Add checked item to the array
        checkedClientAdd = function(item) {
            if (!checkedClientContains(item)) {
                checkedClient.push(item);
            }
        }
        // Remove unchecked items from the array
        checkedClientRemove = function(item) {
            var i = 0;
            while (i < checkedClient.length) {
                if (checkedClient[i] == item) {
                    checkedClient.splice(i, 1);
                } else {
                    i++;
                }
            }
        }
        // Check if an item is in the array
        checkedClientContains = function(item) {
            for (var i = 0; i < checkedClient.length; i++) {
                if (checkedClient[i] == item)
                    return true;
            }
            return false;
        }
        // Persist checked contact when navigating
        persistChecked = function() {
            $('input[type="checkbox"]', "#LIST_CLIENTS").each(function() {
                if (checkedClientContains($(this).val())) {
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
                    checkedClientAdd($(this).val());
                    contactSelected();
                    nbTotalChecked=checkedClient.length;
                    alert(checkedClient);
                }
                else
                {
                    checkedClientRemove($(this).val());
                    if (checkedClient.length == 0)
                        contactUnSelected();
                }
                $(this).closest('tr').toggleClass('selected');
            });
            });
 
        $("#MNU_CLIENT_NEW").click(function()
        {
           $("#groupName").val('');
            $('#winModalFamille .control-group').removeClass('error').addClass('info');
            $('#winModalFamille span.help-block').remove();
            $('#winModalFamille').modal('show');
        });
        
        $("#MNU_CLIENT_NEW").click(function()
        {
           //$("#groupName").val('');
          
            $('#winModalClient .control-group').removeClass('error').addClass('info');
            $('#winModalClient span.help-block').remove();
            $('#winModalClient').modal('show');
        });
        
        
       loadClients = function() {
             rowCount = 0;
            var url;
            url = '<?php echo App::getBoPath(); ?>/client/ClientController.php';
            if (oTableClient != null)
                oTableClient.fnDestroy();
            oTableClient = $('#LIST_CLIENTS').dataTable({
               
                "aoColumnDefs": [{
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
                        "aTargets": [4],
                        "bSortable": false,
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).css('text-align', 'left');
                            $(nTd).text('');
                            //$(nTd).addClass('td-actions');
                            action=$('<div></div>');
                            action.addClass('inline pos-rel');
                            
                             btnAdd=$('<button class="btn btn-xs btn-success" href="#">'+
                            '<i class="ace-icon fa fa-plus bigger-120"></i>'+
                            '</button>');
                            btnAdd.click(function(){
                            //    contactForm('<?php echo App::ACTION_UPDATE; ?>', oData[0]);
                            });
                            btnAdd.tooltip({
                                title: 'Ajouter'
                            });
                            
                            btnEdit=$('<button class="btn btn-xs btn-info" href="#">'+
                            '<i class="ace-icon fa fa-pencil bigger-120"></i>'+
                            '</button>');
                            btnEdit.click(function(){
                            //    contactForm('<?php echo App::ACTION_UPDATE; ?>', oData[0]);
                            });
                            btnEdit.tooltip({
                              title: 'Modifier'
                            });
                            btnRemove=$('<button class="btn btn-xs btn-danger" href="#">'+
                                        '<i class="ace-icon fa fa-trash-o bigger-120"></i>'+
                                        '</button>');
                            btnRemove.click(function(){
                               // actionRemoveContact(oData[0]);
                            });
                            btnRemove.tooltip({
                               title: 'Supprimer'
                            });
                            btnEdit.css({'margin-left': '1px', 'cursor':'pointer'});
                            btnEdit.css({'margin-right': '1px'});
                            btnRemove.css({'cursor':'pointer'});
                            action.append(btnAdd);
                            action.append(btnEdit);
                            action.append(btnRemove);
                            $(nTd).append(action);
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
        
        loadClients();
        
         produitProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
//             var familleproduit= $('#familleClientId').val();
            var nom = $("#nom").val();
            var adresse = $("#adresse").val();
            var telephone = $("#telephone").val();
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
//             formData.append('familleId', familleproduit);
            formData.append('nom', nom);
            formData.append('adresse', adresse);
            formData.append('telephone', telephone);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/client/ClientController.php',
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
                  //  loadClientss();
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };
     $("#SAVE").bind("click", function () {
            produitProcess();
            $('#winModalClient').addClass('hide');
            $('#winModalClient').modal('hide');
        });
$("#MNU_CLIENT_EDIT").click(function()
        {
            if (!$(this).hasClass('disabled')) {
                if (checkedClient.length > 1) {
                    bootbox.alert("Veullez selectionnez un produit");
                    loadClients($("#CLIENT_CMB").val());
                    checkedClient = new Array();
                    disableContactMenu();
                }
                else
                {
                    var produitId = checkedClient[0];
                    alert(produitId);
            if (produitId !== "*")
            {
                $.post("<?php echo App::getBoPath(); ?>/produit/ClientController.php", {produitId: produitId, ACTION: "<?php echo App::ACTION_VIEW; ?>"}, function(data) {
                    data = $.parseJSON(data);
                    $("#ACTION").val('<?php echo App::ACTION_UPDATE; ?>');
                    $("#familleClientId").val(data.familleId);
                    $("#description").val(data.description);
                    $("#poidsNet").val(data.poidsNet);
                    $("#stock").val(data.stock);
                    $("#seuil").val(data.seuil);
                });
                $('#winModalClient .control-group').removeClass('error').addClass('info');
                $('#winModalClient span.help-block').remove();
                $('#winModalClient').modal('show');
            }
                }
            }
    });

    });
</script>
