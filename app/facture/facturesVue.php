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
            Gestion des factures <small> <i
                    class="ace-icon fa fa-angle-double-right"></i> Facture
            </small>
        </h1>
    </div>
    <!-- /.page-header -->
    
    <div class="row"><div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
         <form  id="validation-form" method="get">
             
             <div class="row">
           <div class="col-sm-6" >
                <div class="row" >
                        <div class="col-sm-2">
                            <label> Client</label>
                        </div>
                        <div class="col-sm-6">
                            <select id="CMB_CLIENTS" name="nomClient" data-placeholder=""  style="width:100%"     >
                                <option value="" class="clients"></option>
                            </select>
                        </div>
                    <a id="NEW_CLIENT" class="btn btn-primary btn-sm"  title="Nouveau client"
                        alt="Nouveau client"><i
                        class="ace-icon fa fa-plus-square"></i>  
                    </a>
                 </div>
               <div class="space-6"></div>
                 <div class="row">
                        <div class="col-sm-2">
                            <label> Refèrence</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="reference" name="reference"  style="width:100%" 
                                       class="col-xs-10 col-sm-7">
                            </div>
                 </div>
               <div class="space-6"></div>
                 <div class="row">
                        <div class="col-sm-2">
                            <label> Origine</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="origine" name="origine" placeholder=""  style="width:100%" 
                                       class="col-xs-10 col-sm-7">
                            </div>
                 </div>
                 <div class="space-6"></div>
                <div class="row" >
                        <div class="col-sm-2">
                            <label> Pays</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="pays" placeholder="" style="width:100%" 
                                       class="col-xs-10 col-sm-7">
                            </div>
                 </div>
                 <div class="space-6"></div>
                </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 45px;width: 173%;" >
                            <label class="col-sm-2 control-label no-padding-right"
                                   for="form-field-1"> Numero Facture</label>
                            <div class="col-sm-6">
                                <input type="text" id="numFacture" placeholder=""
                                       class="col-xs-10 col-sm-7">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 56px;width: 173%;">
                            <label class="col-sm-2 control-label no-padding-right"
                                   for="form-field-1"> Date Facture</label>
                            <div class="col-sm-6">
                                <input type="text" id="dateFacture" placeholder=""
                                       class="col-xs-10 col-sm-7">
                            </div>
                        </div>
                        <div class="input-append bootstrap-timepicker form-group" style="margin-top: 88px;" >
                            <label class="col-sm-4 control-label no-padding-right"
                                   for="form-field-1"> Heure de Facture</label>
                            <div class="bootstrap-timepicker col-sm-6" style="margin-left: -22px;;width: 70%;">
                                <input name="heureReception" id="heureFacture" type="text" class="col-xs-10 col-sm-7" />
                            </div>
                        </div>
                        <div class="row" style="margin-top: 132px;">
                    <div class="col-sm-2">
                        <label style="margin-left: 24%"> Devise</label>
                    </div>
                    <div class="col-sm-6" style="margin-left: 74px;">
                        <select id="devise" data-placeholder=""      >
                            <option value="FCFA">FCFA</option>
                            <option value="&euro;">&euro;</option>
                            <option value="$">US$</option>
                        </select>
                    </div>
                </div>
                       
               </div>
    </div>
        <div class="row">
<!--             <form  id="formProduit" method="get">-->
             <h3 class="header smaller lighter green"><i class="ace-icon fa fa-th-large"></i>Produits</h3>
            <div class="col-sm-4">
                            <div class="row">
                                 <div class="col-sm-3">
                                     <label>  Désignation </label>
                                </div>
                                
                                <div class="col-sm-8">
                                        <div class="clearfix">
                                                <select id="CMB_DESIGNATIONS" data-placeholder=""  style="width:100%"     >
                                                    <option value="*" class="designations"></option>
                                                </select>
                                        </div>
                                </div>
                            </div>
                             <div class="space-6"></div>
                            <div class="row">
                                
                                <div class="col-sm-3">
                                    <label>  Stock (kg)</label>
                                </div>
                                <div class="col-sm-8">
                                        <div class="clearfix">
                                            <input type="text" id="stockReel" readonly="readonly" placeholder=""
                                                        class="col-xs-12 col-sm-12">
                                        </div>
                                </div>
                            </div>
                             <div class="space-6"></div>
                            <div class="row">
                                
                                <div class="col-sm-3">
                                    <label>  Prix <span id="labeldevise"></span> </label>
                                </div>
                                <div class="col-sm-8">
                                        <div class="clearfix">
                                                <input type="text" id="prixUnitaire" placeholder=""
                                                        class="col-xs-12 col-sm-12">
                                        </div>
                                </div>
                            </div>
           
                </div>
                <div class="col-sm-6">
                      <div class="row clearfix">
				<div class="col-md-12 column">
					<a id="add_row_colis" class="btn btn-primary btn-sm"  title="Ajouter une ligne"
						alt="Ajouter une ligne"><i
						class="ace-icon fa fa-plus-square"></i> </a> 
                                        <a id='delete_row_colis'
						class="btn btn-danger btn-sm" title="Supprimer une ligne"
						alt="Supprimer une ligne"> <i class="ace-icon fa fa-minus-square"></i>
					</a>
				</div>
			</div>
			<div class="space-6"></div>
			<div class="row clearfix">
				<div class="col-md-8 column">
					<table class="table table-bordered table-hover" id="tab_logic_colis">
						<thead>
							<tr>
								<th class="text-center">#</th>
                                                                <th class="text-center" style="width: 150px;">Nombre de colis</th>
								<th class="text-center" style="width: 150px;">Quantité</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addrColis0'>
								<td>1</td>
                                                                <td><input type="number" id="nbColis0" name='nbColis0' 
 									class="form-control nbColis" /> </td> 
								
								<td>
                                                                    <select id="qteColis0" name="qteColis0" class="form-control qte" >
                                                                       <option value="*" class="qteColis0"></option> 
                                                                    </select>
<!--                                                                    <input type="number" id="qteColis0" name='qteColis0'
									class="form-control qte" />-->
                                                                     
								</td>
								
							</tr>
							<tr id='addrColis1'></tr>
						</tbody>
					</table>
				</div>
			</div>     
           </div>
             <div class="col-sm-2" style="margin-top: 4.3%;margin-left: -9%;">
                 <div class="row">
                      <div class="form-group">
                      <a id="VOIR_COLISAGE" class="btn btn-primary btn-sm"  title="Voir le colisage"
						alt="Voir le colisage"><i
						class="ace-icon fa fa-plus-square"></i>Voir colisage </a> 
                     </div>
                 </div>
                    <div class="row">
                        <div class="form-group">
                            
                            <a id="AJOUT_PRODUIT" class="btn btn-primary btn-sm"  title="Ajouter une ligne"
						alt="Ajouter une ligne"><i
						class="ace-icon fa fa-plus-square"></i>Ajouter </a> 
                        </div>
                    </div>
             </div>
<!--             </form>-->
        </div>
        
        <div class="space-6"></div>
           <h3 class="header smaller lighter green"><i class="ace-icon fa fa-th-large"></i>Détails produit</h3>

         <div class="col-sm-7">
			<div class="row col-md-12 clearfix">
				<div class="col-md-12 column">
					<table class="table table-bordered table-hover" id="tab_produit">
						<thead>
							<tr>
                                                                <th class="text-center hidden"></th>
								<th class="text-center">Nombre de colis</th>
								<th class="text-center">Désignation</th>
								<th class="text-center">Poids net</th>
								<th class="text-center">Prix unitaire</th>
								<th class="text-center">Montant</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
             
        <div class="row">
            <div class="col-md-12 column">
                
                <div class="col-sm-6">
                    <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"
                                            for="form-field-1"> Total colis </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="totalColis" name="totalColis" placeholder=""
                                                            class="col-xs-12 col-sm-9">
                                            </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="col-sm-6">
                     <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"
                                            for="form-field-1"> Poids total </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="qteTotal" name="qteTotal" placeholder=""
                                                            class="col-xs-12 col-sm-9">
                                            </div>
                                    </div>
                                </div>
                            </div>
                </div>
                
                
            </div>
        </div>
         </div>
         
        <div class="col-sm-5">
             <div class="space-6"></div>
            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-5 control-label no-padding-right"
                                            for="form-field-1"> Port de déchargement </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="portDechargement" name="portDechargement" placeholder=""
                                                            class="col-xs-12 col-sm-9">
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<a id="add_row_cont" class="btn btn-primary btn-sm"><i
						class="ace-icon fa fa-plus-square"></i> </a> <a id='delete_row_cont'
						class="btn btn-danger btn-sm" title="Supprimer une ligne"
						alt="Supprimer une ligne"> <i class="ace-icon fa fa-minus-square"></i>
					</a>
				</div>
			</div>
			<div class="space-6"></div>
			<div class="row clearfix">
				<div class="col-md-9 column">
					<table class="table table-bordered table-hover" id="tab_conteneur">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">N° conteneur</th>
								<th class="text-center">N° plomb</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addrcont0'>
								<td>1</td>
								<td><input type="text" id="cont0" name='cont0'
									class="form-control" />
								</td>
								<td><input type="text" id="plb0" name='plb0'
									class="form-control" />
								</td>
							</tr>
							<tr id='addrcont1'></tr>
						</tbody>
					</table>
				</div>
			</div>
            
        </div>
        <div class="space-6"></div>
        <div class="row">
                <div class="col-md-12">
                        <div class="col-sm-6">
                            <div class="row">
                                <label class="col-sm-3 control-label no-padding-right"
                                        for="form-field-1"> Montant HT <span id="labelmontantHt"></span> </label>
                                <div class="col-sm-7">
                                        <div class="clearfix">
                                            <input type="text" id="montantHt" name="montantHt" placeholder=""
                                                        class="col-xs-12 col-sm-10">
                                        </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-3 control-label no-padding-right"
                                        for="form-field-1"> Tva </label>
                                <div class="col-sm-7">
                                    <div class="clearfix">
                                        <input type="text" id="tva" name="tva" placeholder=""
                                               class="col-xs-12 col-sm-3" value="18">  &nbsp;%
                                    </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-3 control-label no-padding-right"
                                        for="form-field-1"> Montant TTC <span id="labelmontantTtc"></span> </label>
                                <div class="col-sm-7">
                                    <div class="clearfix">
                                        <input type="text" id="montantTtc" name="montantTtc" placeholder=""
                                                    class="col-xs-12 col-sm-10">
                                    </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-3 control-label no-padding-right"
                                        for="form-field-1"> Reglé </label>
                                <div class="col-sm-7">
                                    <div class="clearfix">
                                           <input type="checkbox" disabled="disabled" id="regleFacture" name="regleFacture" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            
                             
                        </div>
                        <div class="col-sm-4">
                            
                            <div class="row">
                                        <label class="col-sm-5 control-label no-padding-right"
                                                for="form-field-1"> Mode de paiement </label>
                                        <div class="col-sm-7">
                                                <div class="clearfix">
                                                    <select id="modePaiement" name="modePaiement" class="col-xs-12 col-sm-10">
                                                                <option value="Esp">Especes</option>
                                                                <option value="ch">Cheque</option>
                                                                <option value="vir">Virement</option>
                                                        </select>
                                                </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-5 control-label no-padding-right"
                                        for="form-field-1"> No Cheque </label>
                                <div class="col-sm-7">
                                        <div class="clearfix">
                                                <input type="text" readonly id="numCheque" placeholder=""
                                                        class="col-xs-12 col-sm-10">
                                        </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-5 control-label no-padding-right"
                                        for="form-field-1"> Avance <span id="labelavance"></span> </label>
                                <div class="col-sm-7">
                                        <div class="clearfix">
                                                <input type="text" id="avance" name="avance" placeholder=""
                                                        class="col-xs-12 col-sm-10">
                                        </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-5 control-label no-padding-right"
                                        for="form-field-1"> Reliquat <span id="labelreliquat"></span> </label>
                                <div class="col-sm-7">
                                        <div class="clearfix">
                                                <input type="text" id="reliquat" name="reliquat" placeholder=""
                                                        class="col-xs-12 col-sm-10">
                                        </div>
                                </div>
                        </div>
                        </div>
                </div>
        </div>
        <!-- /.col -->
    
    <!-- /.row -->
    

    <div class="row">
        <div class="col-sm-8">
        </div>
            <div class="col-sm-2" style="margin-top: 20px;">
                    <button id="FACTURE_PROFORMA" class="btn btn-small btn-info pull-right">
                            <i class="fa fa-plus-square "></i> Facture ProForma
                    </button>
            </div>
            <div class="col-sm-2" style="margin-top: 20px;">
                    <button id="SAVE" class="btn btn-small btn-info pull-right">
                            <i class="fa fa-plus-square "></i> Valider
                    </button>
            </div>
    </div>
    
    </form>
    
     <div id="winModalClient" class="modal fade" tabindex="-1">
            <form id="formClient" class="form-horizontal"  onsubmit="return false;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Client</h3>
                        </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Refèrence </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="new_reference" name="new_reference" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nom </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="nom" name="nom" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Adresse</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="new_adresse" name="new_adresse" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telephone</label>
                                    <div class="col-sm-9">
                                        <input type="text"  id="telephone" name="telephone" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="SAVE_CLIENT" class="btn btn-small btn-info">
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
            </form></div>
            </div>
    </div>
</div>
<!-- /.page-content -->


<script type="text/javascript">
//{id:"1",designation:"",pu:"",quantite:"",montant:""}
$(document).ready(function () {
    $('#CMB_CLIENTS').select2();
     $('#CMB_DESIGNATIONS').select2();
     $('#qteColis0').select2();
     var colisage = [];
     var totalColis=0;
     var qteTotal=0;
     var mtTotal=0;
     var montantTtc=0;
    $.post("<?php echo App::getBoPath(); ?>/facture/FactureController.php", {ACTION: "<?php echo App::ACTION_GET_LAST_NUMBER; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#numFacture").val(sData.oId);
            }
    });
    var today = new Date();
    var dateAchat = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd;} if(mm<10){mm='0'+mm;} today = dd+'/'+mm+'/'+yyyy;dateAchat=yyyy+'-'+mm+'-'+dd;
    $('#dateFacture').attr('value', today);
    
    $('#heureFacture').timepicker({
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false
        });
     //devise
     $('#labeldevise').text("("+$('#devise').val()+")");
     $('#labelmontantHt').text("("+$('#devise').val()+")");
     $('#labelmontantTtc').text("("+$('#devise').val()+")");
     $('#labelavance').text("("+$('#devise').val()+")");
     $('#labelreliquat').text("("+$('#devise').val()+")");
     
     $('#devise').change(function() {
        if($('#devise').val()!==''){
            $('#labeldevise').text("("+$('#devise').val()+")");
            $('#labelmontantHt').text("("+$('#devise').val()+")");
            $('#labelmontantTtc').text("("+$('#devise').val()+")");
            $('#labelavance').text("("+$('#devise').val()+")");
            $('#labelreliquat').text("("+$('#devise').val()+")");
        }
    
        });
    loadProduit = function(){
        $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {codeUsine: "usine_dakar", ACTION: "<?php echo App::ACTION_LIST_PRODUITS
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#CMB_DESIGNATIONS").loadJSON('{"designations":' + data + '}');
            }
        });
    };
    loadProduit();
    loadClients = function(){
        $.post("<?php echo App::getBoPath(); ?>/client/ClientController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#CMB_CLIENTS").loadJSON('{"clients":' + data + '}');
            }
        });
    };
    loadClients();
    loadInfoClient = function(clientId){
        if(clientId!=='*'){
            $.post("<?php echo App::getBoPath(); ?>/client/ClientController.php", {clientId: clientId, ACTION: "<?php echo App::ACTION_GET_INFO_CLIENT; ?>"}, function(data) {
                data = $.parseJSON(data);
               //bonsortieId=data.id;
                $("#reference").val(data.reference);
                $('#origine').val(data.origine);
            });
        }
    };
    
        //Gestion des colis
        loadQuantiteStock = function (produitId) {
        $.post("<?php echo App::getBoPath(); ?>/stock/StockController.php", {produitId:produitId, codeUsine:"<?php echo $codeUsine;?>", ACTION: "<?php echo App::ACTION_GET_STOCK; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#stockReel").val(sData.nbStocks);
            }
    });
    };
        $('#CMB_DESIGNATIONS').change(function() {
        if($('#CMB_DESIGNATIONS').val()!=='*') {
            loadQuantiteStock($('#CMB_DESIGNATIONS').val());
            loadQteColis($('#CMB_DESIGNATIONS').val(), 0);
        }
        
        });
     loadQteColis = function(produitId, index){
        $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {produitId: produitId, ACTION: "<?php echo App::ACTION_GET_INFOS
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#qteColis"+index).loadJSON('{"qteColis'+index+'":' + data + '}');
            }
        });
    };
    $('#CMB_CLIENTS').change(function() {
    if($('#CMB_CLIENTS').val()!==null) {
        if($('#CMB_CLIENTS').val()!=='')
            loadInfoClient($('#CMB_CLIENTS').val());
        else {
            $('#nomClient').val("");
            $('#origine').val("");
        }
    }
        });
     var i=1;
     $("#add_row_colis").click(function(){
     $('#addrColis'+i).html("<td>"+ (i+1) +"</td><td><input type='text' id='nbColis"+i+"' name='nbColis"+i+"' class='form-control nbColis'/></td>\n\
        <td><select id='qteColis"+i+"' name='qteColis"+i+"' class='form-control qte' ><option value='*' class='qteColis"+i+"'></option></select>");
      $('#tab_logic_colis').append('<tr id="addrColis'+(i+1)+'"></tr>');
        $('#qteColis'+i).select2();
        if($('#CMB_DESIGNATIONS').val()!=='*')
            loadQteColis($('#CMB_DESIGNATIONS').val(), i);
        
      i++;
  });
     $("#delete_row_colis").click(function(){
    	 if(i>1){
		 $("#addrColis"+(i-1)).html('');
		 i--;
		 }
	 });


  
       $(document).delegate('#tab_logic_colis tr td select', 'change', function (event) {
        var id = $(this).closest('tr').attr('id');
        var counter = id.slice(-1);
       // $( "#qteColis"+counter ).change(function() {
            //alert("gg");
                verifierPoids($('#qteColis'+counter).val(), counter);
        //   });
            });      
    
    function ajoutLigne(){
        var nbColis=1;
        var pd=0;
        var nbColis=0;
        var mtTtc=0;
        var i=0;
        var trouve=0;
        var produitId = $('#CMB_DESIGNATIONS').val();
         var flag = false;
            $('#tab_produit tbody').find('tr').each(function(){
                var $this = $(this);
                if(produitId == $('td:eq(0)', $this).text()){
                    flag = true;
                    return false;
                }
            });
        if(flag){
             $.gritter.add({
                    title: 'Notification',
                    text: 'Ce produit existe deja, Veuillez changer de produit',
                    class_name: 'gritter-error gritter-light'
                });
                var rowCount = $('#tab_logic_colis tr').length;
                for (var i = 1; i<rowCount; i++) {
                    $("#addrColis"+(i)).html('');
                }
                $('#stockReel').val('');
                $('#prixUnitaire').val('');
                $('#nbColis0').val('');
                $('#qteColis0').val('*').change();
                $('#CMB_DESIGNATIONS').val('*').change();
            return;
        }
        
        $('#tab_logic_colis .qte').each(function () {
            if($(this).val()!=='')
                pd+= parseFloat($(this).select2('data').text);
        });
      $('#tab_logic_colis .nbColis').each(function () {
          if($(this).val()!==''){
            nbColis += parseInt($(this).val());
            i++;
          }
        });
      //  var produitId = $('#CMB_DESIGNATIONS').val();
        var designation = $('#CMB_DESIGNATIONS').select2('data').text;
        var prix = $('#prixUnitaire').val();
       //var rows=[];
       var header=["#","nbColis","qte"]
             var $table=$('#tab_logic_colis');
            $table.find("tbody tr").each(function () {
                var row = {};
                
                $(this).find("td").each(function (i) {
                    row["produitId"] = produitId;
                    var key = header[i];
                    var value;
                    valueInput = $(this).find('input').val();
                     if (typeof valueInput !== "undefined")
                        value=valueInput;
                    
                    row[key] = value;
                });

                colisage.push(row);
            });
            console.log( JSON.stringify(colisage));
//        var item = new Array();
//        item.push($("#CMB_DESIGNATIONS").val());
//        item.push($('#nbColis'+(i)).val());
//        item.push($('#qteColis'+(i)).val()); 
//        colisage.push(item);
//        console.log(colisage);
        if(produitId==='*' || nbColis===0 || prix===''){
               $.gritter.add({
                    title: 'Notification',
                    text: 'Les champs ne doivent pas etre vide',
                    class_name: 'gritter-error gritter-light'
                });
        }
        else {
        var montant = parseInt(prix) * pd;
        totalColis+=nbColis;
        qteTotal+=pd;
        mtTotal+=montant;
        var data="<tr><td class='hidden'>"+produitId+"</td><td>"+nbColis+"</td><td>"+designation+"</td> <td>"+pd+"</td><td>"+prix+"</td><td>"+montant+"</td></tr>";
        $('#tab_produit tbody').append(data);
        $('#totalColis').val(totalColis);
        $('#qteTotal').val(qteTotal);
        $('#montantHt').val(mtTotal);
         mtTtc = mtTotal+(mtTotal * parseFloat($("#tva").val())/100);
         montantTtc +=mtTtc;
        $('#montantTtc').val(montantTtc);
        $('#CMB_DESIGNATIONS').val('*').change();
        $('#prixUnitaire').val('');
        var rowCount = $('#tab_logic_colis tr').length;
        for (var i = 1; i<rowCount; i++) {
            $("#addrColis"+(i)).html('');
        }
        $('#nbColis0').val('');
        $('#qteColis0').val('*').change();
        $('#prixUnitaire').val(''); 
        $('#stockReel').val('');
       }
    }
    
        
       
     $( "#AJOUT_PRODUIT" ).click(function(){
         
        ajoutLigne();
  });
 function verifierPoids(qte, counter ){
           //var produitId = designation;
           var nbColis=parseInt($("#nbColis"+counter).val());
          // var qte=parseInt($("#qteColis"+counter).val());
          console.log('counter'+counter);
          //console.log('qte'+qte);
          if(qte!=='*'){
           if(isNaN(qte)) {
                    $.gritter.add({
                    title: 'Notification',
                    text: 'Veuillez choisir une quantité',
                    class_name: 'gritter-error gritter-light'
                });
                 $("#nbColis"+counter).val("");
                 $('#qteColis'+counter).val("*").change();
                }
            else{
                if(nbColis > qte ){
                  $.gritter.add({
                    title: 'Notification',
                    text: 'Le nombre de colis ou la quantite saisi ne correspond pas au colisage du produit choisi',
                    class_name: 'gritter-error gritter-light'
                });  
                 $("#nbColis"+counter).val("");
                 $('#qteColis'+counter).val("*").change();
                }
                    

                }
            }
            
       }
       
   showPopover = function(idButton, colis){
            $("#" + idButton).popover({
                html: true,
                trigger: 'focus',
                placement: 'top',
                title: '<i class="icon-group icon-"></i> Détail colis ',
                content: colis
            }).popover('toggle');
         };    
       
  $( "#VOIR_COLISAGE" ).click(function(){
         $("#VOIR_COLISAGE").popover('destroy')
        $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {produitId: $('#CMB_DESIGNATIONS').val(), ACTION: "<?php echo App::ACTION_GET_COLIS; ?>"}, function(data) {
        data=$.parseJSON(data);
        var htmlString="";
        htmlString+="<div class='popover-medium' style='width: 550px;'> Liste des colis disponible<hr>";
        $.each(data , function(i) { 
            str= data [i].toString();
            var substr = str.split(',');
            htmlString+="<span><b>"+substr [0]+" colis de "+substr [1]+" kg<b></span><br /><hr>";
        // htmlString+="<span><b> Quantité</b>: "+substr [1]+"</span><br /><hr>";

            //console.log(data [i]); 
          });
          htmlString+="</div>";
        showPopover("VOIR_COLISAGE", ""+htmlString+"");
        });
    });      
  function calculMontant(index){
           var mt;
           var qte=parseInt($("#qte"+index).val());
           if(!isNaN(qte)) {
              var pu = $("#pu"+index).val();
              mt = parseInt(qte) * parseInt(pu);
              if(!isNaN(mt)){
                $("#montant"+index).val(mt);
              }
            }
            else {
                $("#montant"+index).val("");
            }
            calculMontantPoids();
       }
       function calculMontantPoids(){
           var pt=0;
           var pd=0;
           var nbColis=0;
          $('#tab_logic .montant').each(function () {
              if($(this).val()!=='')
                pt += parseInt($(this).val());
            });
            $('#tab_logic .qte').each(function () {
                if($(this).val()!=='')
                pd+= parseFloat($(this).val());
            });
          $('#tab_logic .nbColis').each(function () {
              if($(this).val()!=='')
                nbColis += parseInt($(this).val());
            });
                if(!isNaN(pt))
                    $("#montantHt").val(pt);
                if(!isNaN(pd))
                    $("#poidsTotal").val(pd);
                 if(!isNaN(nbColis))
                    $("#nbTotalColis").val(nbColis);
        }
 var j=1;
     $("#add_row_cont").click(function(){
   $('#addrcont'+j).html("<td>"+ (j+1) +"</td><td><input type='text' id='cont"+j+"' name='cont"+j+"'  class='form-control'/></td>\n\
<td><input type='text' id='plb"+j+"' name='plb"+j+"' class='form-control'/></td>");
      $('#tab_conteneur').append('<tr id="addrcont'+(j+1)+'"></tr>');
     
       
      j++;
  });
     $("#delete_row_cont").click(function(){
    	 if(j>1){
		 $("#addrcont"+(j-1)).html('');
		 j--;
		 }
	 });
    $("#modePaiement").change(function() {
        if($("#modePaiement").val() ==='ch') {
            $("#numCheque").attr("readonly", false); 
        }
        else {
            $("#numCheque").attr("readonly", true); 
        }
    });
    
      $("#avance").keyup(function() {
          calculReliquat();
//        var reliquat=0;
//        if($("#avance").val() !=='') {
//            reliquat= parseFloat($("#montantTtc").val()) - parseFloat($("#avance").val());
//            if(!isNaN(reliquat) && reliquat >0)
//                $("#reliquat").val(reliquat);
//            else {
//                $("#reliquat").val(0); 
//            }
//        }
//        else {
//            $("#reliquat").val(0); 
//        }
      });
 function calculReliquat(){
          var rel=0;
           var mt=parseInt($("#montantTtc").val());
           var avance=parseInt($("#avance").val());
           rel= mt - avance;
           if(!isNaN(rel) && rel>0) 
              $("#reliquat").val(rel);
           else if(!isNaN(rel) && rel===0) {
              $('#regleFacture').attr("disabled", false);
              $("#reliquat").val(0);
          }  
          else
              $("#reliquat").val("");
          $('#regleFacture').attr("disabled", true);
        }
       function SimpletabToJson (tableId, head){
           var $table = $("#"+tableId);
            rows = [],
            header = head;



            $table.find("tbody tr").each(function () {
                var row = {};

                $(this).find("td").each(function (i) {
                    var key = header[i];
                    var value;
                    valueTd = $(this).text();
                    if (typeof valueTd !== "undefined")
                        value=valueTd;
                   
                    row[key] = value;
                });

                rows.push(row);
            });
            return JSON.stringify(rows);
       }
       function tabToJson (tableId, head){
           var $table = $("#"+tableId);
            rows = [],
            header = head;

//            $table.find("thead th").each(function () {
//                header.push($(this).html().trim());
//            });

            $table.find("tbody tr").each(function () {
                var row = {};

                $(this).find("td").each(function (i) {
                    var key = header[i];
                    var value;
                        valueSelect = $(this).find('select').val();
                        valueInput = $(this).find('input').val();
                        valueTd = $(this).val();
                    if (typeof valueInput !== "undefined")
                        value=valueInput;
                    if (typeof valueSelect !== "undefined")
                        value=valueSelect;
                    row[key] = value;
                });

                rows.push(row);
            });
            return JSON.stringify(rows);
       }
        factureProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var colisage = $("#CMB_CLIENTS").val();
            var numFacture= $('#numFacture').val();
            var heureFacture= $('#heureFacture').val();
            var devise= $('#devise').val();
            var pays= $('#pays').val();
            var portDechargement = $("#portDechargement").val();
            var montantHt = $("#montantHt").val();
            var montantTtc = $("#montantTtc").val();
            var nbTotalColis = $("#totalColis").val();
            var nbTotalPoids = $("#qteTotal").val();
            var modePaiement = $("#modePaiement").val();
            var numCheque = $("#numCheque").val();
            var avance = $("#avance").val();
            var reliquat = $("#reliquat").val();
            var codeUsine = "<?php echo $codeUsine ?>";
            
            var Aregle = $("input:checkbox[name=regleFacture]:checked").val();
            var regle=false;
            if(Aregle === 'on')
                 regle=true;
            var login = "<?php echo $login ?>";
            var headerColis = ["#","nColis","qteColis"];
            var headerConteneur = ["#","nConteneur","nPlomb"];
            var headerProduit = ["produitId","nColis","designation","pnet","pu","montant"];
            //var tblColis=tabToJson('tab_logic_colis', headerColis );
            var tblConteneur=tabToJson('tab_conteneur', headerConteneur );
            var tblProduit=SimpletabToJson('tab_produit', headerProduit );
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('clientId', colisage);
            formData.append('numFacture', numFacture);
            formData.append('heureFacture', heureFacture);
            formData.append('devise', devise);
            formData.append('pays', pays);
            formData.append('portDechargement', portDechargement);
            formData.append('nbTotalColis', nbTotalColis);
            formData.append('nbTotalPoids', nbTotalPoids);
            formData.append('montantHt', montantHt);
            formData.append('montantTtc', montantTtc);
            formData.append('modePaiement', modePaiement);
            formData.append('numCheque', numCheque);
            formData.append('avance', avance);
            formData.append('reliquat', reliquat);
            formData.append('regle', regle);
            formData.append('jsonConteneur', tblConteneur);
            formData.append('jsonProduit', tblProduit);
            formData.append('codeUsine', codeUsine);
            formData.append('login', login);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/facture/factureController.php',
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
                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/factureListe.php", function () {
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
//        $("#SAVE").click(function()
//        {
//          factureProcess();
//           
//        });
        
        $("#SAVE").bind("click", function () {
        $('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				nomClient: {
					required: true
				},
				reference: {
					required: true
				},
				origine: {
					required: true
				},
				totalColis: {
					required: true
				},
				qteTotal: {
					required: true
				},
				portDechargement: {
					required: true
				},
				montantHt: {
					required: true
				},
				tva: {
					required: true
				},
				montantTtc: {
					required: true
				},
				modePaiement: {
					required: true
				}
			},
	
			messages: {
				nomClient: {
					required: "Champ obligatoire."
				},
				reference: {
					required: "Champ obligatoire."
				},
				origine: {
					required: "Champ obligatoire."
				},
				totalColis: {
					required: "Champ obligatoire."
				},
				qteTotal: {
					required: "Champ obligatoire."
				},
				portDechargement: {
					required: "Champ obligatoire."
				},
				montantHt: {
					required: "Champ obligatoire."
				},
				tva: {
					required: "Champ obligatoire."
				},
				montantTtc: {
					required: "Champ obligatoire."
				},
				modePaiement: {
					required: "Champ obligatoire."
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
				factureProcess();
			},
			invalidHandler: function (form) {
			}
		});


        });
        $("#FACTURE_PROFORMA").click(function()
        {
             window.open('<?php echo App::getHome(); ?>/app/pdf/factureProformaPdf.php','nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1200, height=650');

        });
        
        function html2json() {
   var json = '{';
   var otArr = [];
   var tbl2 = $('#tab_logic tr').each(function(i) {        
      x = $(this).children();
      var itArr = [];
      x.each(function() {
         itArr.push('"' + $(this).text() + '"');
      });
      otArr.push('"' + i + '": [' + itArr.join(',') + ']');
   });
   json += otArr.join(",") + '}';

   return json;
}

 $("#NEW_CLIENT").click(function()
        {
            $('#winModalClient').modal('show');
        });
        
        SaveClientProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var reference= $('#new_reference').val();
            var nom = $("#nom").val();
            var adresse = $("#new_adresse").val();
            var telephone = $("#telephone").val();
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('reference', reference);
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
                        if(data.oId!==""){
                            jsonText='{"value":'+data.oId+', "text":"'+nom+'"}';
                            jsonText=JSON.parse(jsonText);
                            $("#CMB_CLIENTS").select2("data", jsonText, true);
                            $("#reference").val(reference);
                            $("#origine").val(adresse);
                            
                            //alert($("#CMB_MAREYEURS").val());
                        }
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                        
                    };
                  //  loadClients();
                },
                error: function () {
                    alert("failure - controller");
                }
            });

        };
        loadNumberReference = function () {
        $.post("<?php echo App::getBoPath(); ?>/client/ClientController.php", {ACTION: "<?php echo App::ACTION_GET_LAST_NUMBER; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#new_reference").val(sData.oId);
            }
    });
    };
    
    loadNumberReference();
        $("#SAVE_CLIENT").click(function() {
       	 $('#formClient').validate({
       			errorElement: 'div',
       			errorClass: 'help-block',
       			focusInvalid: false,
       			rules: {
       				new_adresse: {
       					required: true
       				},
       				nom: {
       					required: true
       				}
       				
       			},

       			messages: {
       				new_adresse: {
       					required: "Champ obligatoire."
       				},
       				nom: {
       					required: "Champ obligatoire."
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
       			 SaveClientProcess();
                          //$('#winModalClient').addClass('hide');
                                $('#winModalClient').modal('hide');
       			},
       			invalidHandler: function (form) {
       			}
       		});
        });
});
</script>
