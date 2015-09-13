<?php
// session_start();
require_once '../../common/app.php';
$lang='fr';
?>
<div class="row">	
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Produits</strong></h2>
                <div class="panel-actions">
                    <a href="#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                    <a href="#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="span9" style="margin-left:11px;margin-bottom: 10px;">
                    <button id="BTN_NEW" type="button" class="btn btn-primary btn-flat">Nouveau</button>
                </div>
                </div>
                <table id="LIST_PRODUITS" class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="hidden"><i class="icon-male bigger-110"></i>  </th>
                            <th>Designation</th>
                            <th>Stock initial</th>    
                            <th>Prix unitaire</th>                               
                        </tr>
                    </thead>   
                    <tbody>
                       							                                   
                    </tbody>
                </table>  
            </div>
        </div>
    </div><!--/col-->
</div><!--/row-->
<div id="winModalProduit" class="modal hide" style="height: 472px;" >
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
            <label for="prenom">Libelle</label>
            <input type="text" id="libelle" name="libelle" class="form-control" placeholder="Libelle">
        </div>
        <div class="form-group">
            <label for="adresse">Quantite (kg)</label>
            <input type="text" id="quantite" name="quantite" class="form-control" placeholder="Quantite">
        </div>
        <div class="form-group">
            <label for="adresse">Prix unit.</label>
            <input type="text" id="prixUnit" name="quantite" class="form-control" placeholder="Prix Unitaire">
        </div>
        <div class="form-group">
            <label for="adresse">Seuil</label>
            <input type="text" id="seuil" name="quantite" class="form-control" placeholder="Seuil">
        </div>
       
    </form>
         <div class="panel-footer">
            <button type="submit" id="SAVE" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Enregistrer</button>
            <button id="CANCEL_PRODUIT"  class="btn btn-sm btn-danger"   data-dismiss="modal" >
            <i class="fa fa-ban"></i> Annuler</button>
        </div>
            </div>
            </div>
            </div>
        </div>
</div>
           

<script type="text/javascript">
    $(document).ready(function() {
                var oTableProduit = null;
                var checkedClient=new Array();
                var nbTotalChecked=0;
                
                var lastResults = [];
                $('#libelle').select2({
                        tags: [""],
                        tokenSeparators: [";", ",", " "],
                        //Allow manually entered text in drop down when no matches found                        
                        createSearchChoice:function(term) { 
                            if ($(lastResults).filter(function() {
                                strValue = this.VALUE+'';
                                return strValue.localeCompare(term)===0; 
                            }).length===0) {
                                return {id:term, VALUE:term};
                            } },
                        minimumInputLength: 2,
                    	ajax: {
                    		url: "<?php echo App::getBoPath(); ?>/produit/ProduitController.php", //The url of the json service
                            dataType: 'json',
                            quietMillis: 100, //How long the user has to pause their typing before sending the next request
                            data: function(term, page) { //Our search term and what page we are on
                                return {
                                    ACTION: "<?php echo App::ACTION_SEARCH; ?>",
                                    term: term
                                };
                            },
                            results: function(data, page) {
                            	lastResults = data;
                                return { results: data }
                            }
                        },                      
                        formatResult: function(contact) { 
                            if(contact.VALUE==contact.id)
                                rc="<div class='select2-user-result'><strong>"+contact.VALUE+"</strong></div>";
                            else {
                                if(contact.VALUE == null)
                                   str='';
                               else
                                   str=contact.VALUE;
                                rc="<div class='select2-user-result'><strong>"+str+"</strong> "+contact.id+"</div>";
                            }
                            return  rc;
                        },
                        formatSelection: function(contact) {						
							if(contact.VALUE==contact.id)
								rc=contact.VALUE;
							else 
                                                          if(contact.VALUE == null)  
                                                        rc=contact.id;
                                                        else rc=contact.VALUE+" ("+contact.id+")";
                            return rc; 
                        },
                        initSelection : function (element, callback) {
                                var data = [];
                                $(element.val().split(",")).each(function () {
                                        data.push({id: this, VALUE: this});
                                });
                                callback(data);
                        }
                    });
                    
                loadProduits = function () {
                    nbTotalChecked = 0;
                    var url;
                    url = '<?php echo App::getBoPath(); ?>/produit/ProduitController.php';
                    if (oTableProduit != null)
                        oTableProduit.fnDestroy();
                    oTableProduit = $('#LIST_PRODUITS').dataTable({
                        "oLanguage": {
                            "sUrl": "<?php echo App::getHome(); ?>/lang/datatable_<?php echo $lang; ?>.txt"
                        },
                        "aoColumnDefs": [
                        {
                            "aTargets": [0],
                            "bSortable": false,
                            "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('display', 'none');
                            },
                            "mRender": function(data, type, full) {
                                return '<label class="hidden"><input type="text" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';
                            }
                        }],
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
loadProduits();
    $("#BTN_NEW").click(function(e)
    {
        //e.preventDefault();
        $('#winModalProduit').removeClass('hide');
        $('#winModalProduit').modal('show');
        //$("#MAIN_CONTENT").load("app/client/new_client.php", function() {
       // });


    });
    produitProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var typeproduit= $('#typeProduit').val();
            var libelle = $("#libelle").val();
            var quantite = $("#quantite").val();
            var prixUnitaire = $("#prixUnit").val();
            var seuil = $("#seuil").val();
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('typeproduit', typeproduit);
            formData.append('libelle', libelle);
            formData.append('quantite', quantite);
            formData.append('prixUnitaire', prixUnitaire);
            formData.append('seuil', seuil);
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
                       
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                        
                    };
                    loadProduits();
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };
        $("#seuil").bind("focus", function () {
           if($("#quantite").val() !="") {
               var quantite = $("#quantite").val();
               var seuil;
               seuil = (parseInt(quantite) *25)/100;
               $("#seuil").val(seuil);
           }
                
        });
        
     $("#SAVE").bind("click", function () {
            produitProcess();
            $('#winModalProduit').addClass('hide');
            $('#winModalProduit').modal('hide');
        });

    });
</script>