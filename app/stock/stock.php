<?php
// session_start();
require_once '../../common/app.php';
$lang='fr';
?>
<div class="row">	
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Stocks</strong></h2>
                <div class="panel-actions">
                    <a href="#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                    <a href="#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="span9" style="margin-left:11px;margin-bottom: 10px;">
<!--                     <button id="BTN_NEW" type="button" class="btn btn-primary btn-flat">Nouveau</button> -->
<!--                 </div> -->
                </div>
                <table id="LIST_STOCKS" class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Produit</th>
                            <th>Quantite</th> 
                            <th>Seuil</th>
                            <th>Date Entree</th>
                            <th>Date sortie</th>       
                        </tr>
                    </thead>   
                    <tbody>
                       							                                   
                    </tbody>
                </table>  
            </div>
        </div>
    </div><!--/col-->
</div><!--/row-->
<div id="winModalProduit" class="modal hide" style="height: 672px;" >
<!--     <div class="modal-dialog"> -->
<!--             <div class="modal-content"> -->
<!--                 <div class="modal-header"> -->
<!--                     <button type="button" class="close" data-dismiss="modal">&times;</button> -->
<!--                     <h4 class="blue bigger">Nouveau</h4> -->
<!--                </div> -->
<!--             <div class="modal-body overflow-visible"> -->
<!--                 <div class="row"> -->
<!--          <form action="" method="post"> -->
<!--        <div class="form-group"> -->
<!--             <label for="prenom">Client</label> -->
<!--             <input type="text" id="client" name="client" class="form-control" placeholder="Client"> -->
<!--         </div> -->
<!--          <div class="form-group"> -->
<!--             <label for="select">Type Produit</label> -->
<!--                 <select id="typeProduit" class="form-control" size="1"> -->
<!--                     <option value="" class="types"></option> -->
<!--                 </select> -->
<!--          </div>	 -->
<!--         <div class="form-group"> -->
<!--             <label for="prenom">Produit</label> -->
<!--             <input type="text" id="produit" name="produit" class="form-control" placeholder="Produit"> -->
<!--         </div> -->
<!--         <div class="form-group"> -->
<!--             <label for="adresse">Prix</label> -->
<!--             <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix"> -->
<!--         </div> -->
<!--          <div class="form-group"> -->
<!--             <label for="prenom">Avance</label> -->
<!--             <input type="text" id="avance" name="avance" class="form-control" placeholder="Avance"> -->
<!--         </div> -->
<!--         <div class="form-group"> -->
<!--             <label for="adresse">Reliquat</label> -->
<!--             <input type="text" id="reliquat" name="reliquat" class="form-control" placeholder="Reliquat"> -->
<!--         </div> -->
<!--          <div class="form-group"> -->
<!--             <label for="prenom">A Livrer</label> -->
<!--             <select id="aLivrer" class="form-control" size="1"> -->
<!--                     <option value="oui" class="types"></option> -->
<!--                     <option value="non" class="types"></option> -->
<!--              </select> -->
<!--         </div> -->
<!--         <div class="form-group"> -->
<!--             <label for="adresse">Date livraison</label> -->
<!--             <input type="text" id="dateLivraison" name="dateLivraison" class="form-control" placeholder="Quantite"> -->
<!--         </div> -->
<!--         <div class="form-group"> -->
<!--             <label for="adresse">Lieu livraison</label> -->
<!--             <input type="text" id="lieuLivraison" name="lieuLivraison" class="form-control" placeholder="Quantite"> -->
<!--         </div> -->
       
<!--     </form> -->
<!--          <div class="panel-footer"> -->
<!--         </div> -->
<!--                   <div class="modal-footer"> -->
<!--                     <button id="SAVE" class="btn btn-sm btn-success"> -->
<!--                         <i class="icon-ok"></i>Enregistrer</button> -->

<!--                     <button id="CANCEL_COMMANDE" class="btn btn-sm btn-danger"   data-dismiss="modal"> -->
<!--                         <i class="icon-remove"></i>  Annuler</button> -->
<!--                 </div> -->
<!--             </div> -->
<!--             </div> -->
<!--             </div> -->
<!--         </div> -->
<!-- </div> -->
           

<script type="text/javascript">
    $(document).ready(function() {
                var oTableProduit = null;
                var checkedClient=new Array();
                var nbTotalChecked=0;
                $('#typeProduit').select2();
                loadTypeProduit = function(){
                    $.post("<?php echo App::getBoPath(); ?>/produit/TypeProduitController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID; ?>"}, function(data) {
                        sData=$.parseJSON(data);
                if(sData.rc==-1){
                    $.gritter.add({
                            title: 'Notification',
                            text: sData.error,
                            class_name: 'gritter-error gritter-light'
                        });
                }else
                    $("#typeProduit").loadJSON('{"types":' + data + '}');
                            
                    });
                };
                loadTypeProduit();
                
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
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('typeproduit', typeproduit);
            formData.append('libelle', libelle);
            formData.append('quantite', quantite);
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
    });
</script>