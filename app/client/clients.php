<?php
// session_start();
require_once '../../common/app.php';
$lang='fr';
?>
<div class="row">	
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Clients</strong></h2>
                <div class="panel-actions">
                    <a href="#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                    <a href="#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="span9" style="margin-	;margin-bottom: 10px;">
                    <button id="BTN_NEW" type="button" class="btn btn-primary btn-flat">Nouveau</button>
                </div>
                </div>
                <table id="LIST_CLIENTS" class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>ID Client</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Adresse</th>
                            <th>Telephone</th>                                          
                        </tr>
                    </thead>   
                    <tbody>
                       							                                   
                    </tbody>
                </table>  
            </div>
        </div>
    </div><!--/col-->
</div><!--/row-->
<div id="winModalClient" class="modal hide" style="height: 472px;" >
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Nouveau</h4>
                </div>
            <div class="modal-body overflow-visible">
                <div class="row">
                    <form action="" method="post">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nf-email" class="form-control" placeholder="Nom">
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="nf-password" class="form-control" placeholder="Prenom">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="nf-password" class="form-control" placeholder="Adresse">
        </div>
        <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="text" id="telephone" name="nf-password" class="form-control" placeholder="Telephone">
        </div>
       
    </form>
                     <div class="panel-footer">
            <button type="submit" id="SAVE" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Enregistrer</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Annuler</button>
        </div>
            </div>
            </div>
            </div>
        </div>
</div>
           

<script type="text/javascript">
    $(document).ready(function() {
                var oTableClient = null;
                var checkedClient=new Array();
                var nbTotalChecked=0;
                loadClient = function () {
                    nbTotalChecked = 0;
                    var url;
                    url = '<?php echo App::getBoPath(); ?>/client/ClientController.php';
                    if (oTableClient != null)
                        oTableClient.fnDestroy();
                    oTableClient = $('#LIST_CLIENTS').dataTable({
                        "oLanguage": {
                            "sUrl": "<?php echo App::getHome(); ?>/lang/datatable_<?php echo $lang; ?>.txt"
                        },
                        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                       
                        },
                        "fnDrawCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        },
                        "preDrawCallback": function( settings ) {
                           
                        },
                        "bProcessing": false,
                        "bServerSide": true,
                        "sAjaxSource": url,
                        "fnServerData": function (sSource, aoData, fnCallback) {
                            /* Add some extra data to the sender */
                            aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST; ?>"});
                            aoData.push({"name": "offset", "value": "1"});
                            aoData.push({"name": "rowCount", "value": "10"});
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
                                        
                                        fnCallback(json);
                                    }
                                }
                            });
                        }
                    });
                     
                };
loadClient();
    $("#BTN_NEW").click(function(e)
    {
        //e.preventDefault();
        $('#winModalClient').removeClass('hide');
        $('#winModalClient').modal('show');
        //$("#MAIN_CONTENT").load("app/client/new_client.php", function() {
       // });


    });
    clientProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var nom= $('#nom').val();
            var prenom = $("#prenom").val();
            var adresse = $("#adresse").val();
            var telephone = $('#telephone').val();
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('nom', nom);
            formData.append('prenom', prenom);
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
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };
     $("#SAVE").bind("click", function () {
            clientProcess();
            $('#winModalClient').addClass('hide');
            $('#winModalClient').modal('hide');
        });
    });
</script>