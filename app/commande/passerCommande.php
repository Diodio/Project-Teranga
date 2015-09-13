<?php
// session_start();
require_once '../../common/app.php';
$lang='fr';
?>
<div class="row">	
    <div class="col-lg-6">
        <div class="panel panel-default">
          
            <div class="panel-body">
         <form action="" method="post">
       <div class="form-group">
            <label for="prenom">Nom Client</label>
                <input type="text" id="client" name="client" class="form-control" placeholder="Client">
        </div>
        <div class="form-group">
            <label for="prenom">Telephone</label>
            <input type="text" id="produit" name="produit" class="form-control" placeholder="Produit">
        </div>
    </form>
                  
        </div>
        </div>
    </div>	
    
    <div class="col-lg-6">
        <div class="panel panel-default">
          
            <div class="panel-body">
        <div class="form-group">
            <label for="nf-email">Date Commande</label>
            <input type="email" id="nf-email" name="nf-email" class="form-control">
        </div>
             <div class="form-group">
            <label for="nf-email">Numéro commande</label>
            <input type="email" id="nf-email" name="nf-email" class="form-control" value="00001">
            </div>
            </div>
        </div>
    </div>
	<div class="col-lg-12">
        <div class="panel panel-default">
         
            <div class="panel-body">
         <form action="" method="post">
       
        
         <div class="form-group">
            <label for="select">Désignation</label>
            <input type="text" id="client" name="client" class="form-control" >
         </div>	
        <div class="form-group">
            <label for="prenom">Quantité</label>
            <input type="text" id="produit" name="produit" class="form-control" >
        </div>
    </form>
         <div class="panel-footer">
             <button id="SAVE" class="btn btn-sm btn-success">
                        <i class="icon-ok"></i>Ajouter</button>
        </div>
                  
        </div>
        </div>
    </div>		
</div><!--/row-->

<div class="row">	
    <div class="col-lg-12">
        <div class="panel panel-default">  
            <div class="panel-heading">
                <h2><i class="fa fa-table red"></i><span class="break"></span><strong>Detail de la commande</strong></h2>
            </div>
                <table id="LIST_COMMANDES" class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Quantité</th>
                            <th>Designation</th>
                            <th>Prix unit.</th>                              
                        </tr>
                    </thead>   
                    <tbody>
                        <tr>
                            <td>3</td>
                            <td>Hamburger cp</td>
                            <td>1400</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Pizza</td>
                            <td>3900</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>chawarma</td>
                            <td>3000</td>
                        </tr>
                    
                    </tbody>
                </table>  
        </div>
    </div><!--/col-->
</div><!--/row-->           

<div class="row">	
    <div class="col-lg-4" style="float: right;">
        <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h2><i class="fa fa-indent red"></i><strong>Facturation</strong></h2>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="nf-email">Montat total</label>
                        <input type="email" id="nf-email" name="nf-email" class="form-control">
                        <label for="nf-email">Avance</label>
                        <input type="email" id="nf-email" name="nf-email" class="form-control">
                        <label for="nf-email">Reliquat</label>
                        <input type="email" id="nf-email" name="nf-email" class="form-control">
                    </div>
                 </div>  
            <div class="panel-footer">
             <button id="SAVE" class="btn btn-sm btn-success">
                        <i class="icon-ok"></i>Valider</button>
        </div>
        </div>
    </div><!--/col-->
</div><!--/row-->      

<script type="text/javascript">
    $(document).ready(function() {
                var oTableProduit = null;
                var checkedClient=new Array();
                var nbTotalChecked=0;
                $('#typeProduit').select2();
                $('#LIST_COMMANDES').select2();
                
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