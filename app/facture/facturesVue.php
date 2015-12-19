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
     <form  id="validation-form" method="get">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->

        
           <div class="col-sm-6" >
                <div class="row" >
                        <div class="col-sm-2">
                            <label> Client</label>
                        </div>
                        <div class="col-sm-6">
                             <select id="CMB_CLIENTS" data-placeholder=""  style="width:100%"     >
                                <option value="*" class="clients"></option>
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
                            <label> Reference</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="reference" name="reference" placeholder=""  style="width:100%" 
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
                            <option value="EURO">Euro</option>
                            <option value="FCFA">FCFA</option>
                            <option value="US">US$</option>
                        </select>
                    </div>
                </div>
                       
               </div>

                </div>
        <div class="row">
            <div class="col-sm-6">
                            <div class="row">
                                <label class="col-sm-3 control-label no-padding-left"
                                        for="form-field-1"> Designation </label>
                                <div class="col-sm-7">
                                        <div class="clearfix">
                                                <input type="text" id="montantHt" placeholder=""
                                                        class="col-xs-12 col-sm-10">
                                        </div>
                                </div>
                            </div>
                             <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-3 control-label no-padding-left"
                                        for="form-field-1"> Prix unitaire </label>
                                <div class="col-sm-7">
                                        <div class="clearfix">
                                                <input type="text" id="montantHt" placeholder=""
                                                        class="col-xs-12 col-sm-10">
                                        </div>
                                </div>
                            </div>
           
                </div>
                <div class="col-sm-6">
                      <div class="row clearfix">
				<div class="col-md-12 column">
					<a id="add_row" class="btn btn-primary btn-sm"  title="Ajouter une ligne"
						alt="Ajouter une ligne"><i
						class="ace-icon fa fa-plus-square"></i> </a> 
                                        <a id='delete_row'
						class="btn btn-danger btn-sm" title="Supprimer une ligne"
						alt="Supprimer une ligne"> <i class="ace-icon fa fa-minus-square"></i>
					</a>
				</div>
			</div>
			<div class="space-6"></div>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nombre de colis</th>
								<th class="text-center">Quantite</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addr0'>
								<td>1</td>
                                                                <td><input type="number" id="ncolis0" name='ncolis0' 
 									class="col-xs-9 ncolis" /> </td> 
								
								<td><input type="text" id="qte0" name='qte0'
									class="form-control qte" />
								</td>
								
							</tr>
							<tr id='addr1'></tr>
						</tbody>
					</table>
				</div>
			</div>     
           </div>
            
            <div class="col-sm-4">
                
                <div class="row" style="margin-top:40px;">
                    <button id="SAVE" class="btn btn-small btn-info pull-right">
                            <i class="fa fa-plus-square "></i> Ajouter
                    </button>
            </div>
            </div>
        </div>
        </div>
        <div class="space-6"></div>
         <div class="col-sm-7">
			<div class="row clearfix">
				<div class="col-md-12 column">
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
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
			<div class="row" style="margin-top:40px;">
                        <label class="col-sm-3 control-label no-padding-right"
                                for="form-field-1"> Montant </label>
                        <div class="col-sm-7">
                                <div class="clearfix">
                                        <input type="text" id="montantHt" placeholder=""
                                                class="col-xs-12 col-sm-10">
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
        <div class="row">
            <div class="col-md-12 column">
                <div class="col-sm-3">
                    <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"
                                            for="form-field-1"> Total Colis </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="portDechargement" name="portDechargement" placeholder=""
                                                            class="col-xs-12 col-sm-9">
                                            </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="col-sm-3">
                     <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"
                                            for="form-field-1"> Poids total </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="portDechargement" name="portDechargement" placeholder=""
                                                            class="col-xs-12 col-sm-9">
                                            </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="col-sm-6" style="">
                   
                </div>
                
            </div>
        </div>
        <div class="space-6"></div>
        <div class="row">
                <div class="col-md-12">
                        <div class="col-sm-8">
                          
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <label class="col-sm-5 control-label no-padding-right"
                                        for="form-field-1"> Montant HT </label>
                                <div class="col-sm-7">
                                        <div class="clearfix">
                                                <input type="text" id="montantHt" placeholder=""
                                                        class="col-xs-12 col-sm-10">
                                        </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-5 control-label no-padding-right"
                                        for="form-field-1"> Tva </label>
                                <div class="col-sm-7">
                                    <div class="clearfix">
                                        <input type="text" id="tva" placeholder=""
                                               class="col-xs-12 col-sm-3" value="18">  &nbsp;%
                                    </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                <label class="col-sm-5 control-label no-padding-right"
                                        for="form-field-1"> Montant TTC </label>
                                <div class="col-sm-7">
                                    <div class="clearfix">
                                            <input type="text" id="montantTtc" placeholder=""
                                                    class="col-xs-12 col-sm-10">
                                    </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                                        <label class="col-sm-5 control-label no-padding-right"
                                                for="form-field-1"> Mode de paiement </label>
                                        <div class="col-sm-7">
                                                <div class="clearfix">
                                                        <select id="modePaiement" class="col-xs-12 col-sm-10">
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
                                        for="form-field-1"> Avance </label>
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
                                        for="form-field-1"> Reliquat </label>
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
    </div>
    <!-- /.row -->
    </form>

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
    
     <div id="winModalClient" class="modal fade">
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
            </form>
            </div>
</div>
<!-- /.page-content -->


<script type="text/javascript">
//{id:"1",designation:"",pu:"",quantite:"",montant:""}
$(document).ready(function () {
    $('#CMB_CLIENTS').select2();
     $('#designation0').select2();
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
        
    loadProduit = function(index){
        $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {codeUsine: "usine_dakar", ACTION: "<?php echo App::ACTION_LIST_REEL_PAR_USINE
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#designation"+index).loadJSON('{"designations'+index+'":' + data + '}');
            }
        });
    };
    loadProduit(0);
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
    $('#CMB_CLIENTS').change(function() {
        if($('#CMB_CLIENTS').val()!=='*')
            loadInfoClient($('#CMB_CLIENTS').val());
        else {
            $('#nomClient').val("");
            $('#origine').val("");
        }
        });
    var i=1;
     $("#add_row").click(function(){
   $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input type='text' id='ncolis"+i+"' name='ncolis"+i+"' class='form-control ncolis'/></td><td><select id='designation"+i+"' name='designation"+i+"' class='col-xs-10 col-sm-10'>\n\
<option value='-1' class='designations"+i+"'>sélectionnez un produit</option></select>\n\
</td>\n\
<td><input type='text' id='qte"+i+"' name='qte"+i+"'  class='form-control qte'/></td>\n\
<td><input type='text' id='pu"+i+"' name='pu"+i+"' class='form-control'/></td>\n\
<td><input type='text' id='montant"+i+"' name='montant"+i+"'  class='form-control montant'/>");
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      $('#designation'+i).select2();
      loadProduit(i);
       
      i++;
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });


    
    $(document).delegate('#tab_logic tr td', 'click', function (event) {
        var id = $(this).closest('tr').attr('id');
        var counter = id.slice(-1);
          $( "#qte"+counter ).keyup(function() {
           calculMontant(counter);
           //  verifierPoids('designation'+counter, counter);
         }); 
         $( "#pu"+counter ).keyup(function() {
           calculMontant(counter);
           //  verifierPoids('designation'+counter, counter);
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
           var ncolis=0;
          $('#tab_logic .montant').each(function () {
              if($(this).val()!=='')
                pt += parseInt($(this).val());
            });
            $('#tab_logic .qte').each(function () {
                if($(this).val()!=='')
                pd+= parseFloat($(this).val());
            });
          $('#tab_logic .ncolis').each(function () {
              if($(this).val()!=='')
                ncolis += parseInt($(this).val());
            });
                if(!isNaN(pt))
                    $("#montantHt").val(pt);
                if(!isNaN(pd))
                    $("#poidsTotal").val(pd);
                 if(!isNaN(ncolis))
                    $("#nbTotalColis").val(ncolis);
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
        var reliquat=0;
        if($("#avance").val() !=='') {
            reliquat= parseFloat($("#montantTtc").val()) - parseFloat($("#avance").val());
            if(!isNaN(reliquat) && reliquat >=0)
                $("#reliquat").val(reliquat);
        }
        else {
            $("#reliquat").val(0); 
        }
      });

       
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
            var nbTotalColis = $("#nbTotalColis").val();
            var modePaiement = $("#modePaiement").val();
            var numCheque = $("#numCheque").val();
            var avance = $("#avance").val();
            var reliquat = $("#reliquat").val();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            var $table = $("#tab_logic");
            rows = [],
            header = [];

            $table.find("thead th").each(function () {
                header.push($(this).html().trim());
            });

            $table.find("tbody tr").each(function () {
                var row = {};

                $(this).find("td").each(function (i) {
                    var key = header[i];
                    var value;
                        valueSelect = $(this).find('select').val();
                        valueInput = $(this).find('input').val();
                    if (typeof valueInput !== "undefined")
                        value=valueInput;
                    if (typeof valueSelect !== "undefined")
                        value=valueSelect;
                    row[key] = value;
                });

                rows.push(row);
            });
            var tblConteneur=JSON.stringify(rows);
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('clientId', colisage);
            formData.append('numFacture', numFacture);
            formData.append('heureFacture', heureFacture);
            formData.append('devise', devise);
            formData.append('pays', pays);
            formData.append('portDechargement', portDechargement);
            formData.append('nbTotalColis', nbTotalColis);
            formData.append('montantHt', montantHt);
            formData.append('montantTtc', montantTtc);
            formData.append('modePaiement', modePaiement);
            formData.append('numCheque', numCheque);
            formData.append('avance', avance);
            formData.append('reliquat', reliquat);
            formData.append('jsonConteneur', tblConteneur);
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
        $("#SAVE").click(function()
        {
          factureProcess();
           
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
       				adresse: {
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
                            $('#winModalClient').addClass('hide');
                                $('#winModalClient').modal('hide');
       			},
       			invalidHandler: function (form) {
       			}
       		});
        });
});
</script>
