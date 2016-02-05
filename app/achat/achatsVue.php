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
			Achat de produits <small> <i
				class="ace-icon fa fa-angle-double-right"></i> Achat
			</small>
		</h1>
	</div>
	<!-- /.page-header -->
	<form id="validation-form">
		<div class="row">
			<div class="col-md-12">
				<!-- PAGE CONTENT BEGINS -->


				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-2">
							<label> Mareyeur</label>
						</div>
						<div class="col-sm-6">
                                                        <select id="CMB_MAREYEURS" name="mareyeurs" data-placeholder=""
                                                                style="width: 82%">
                                                                <option value="*" class="mareyeurs">Nom Mareyeur</option>
                                                        </select>
                                                        <a id="NEW_MAREYEUR" class="btn btn-primary btn-sm"  title="Nouveau mareyeur"
						alt="Nouveau mareyeur"><i
						class="ace-icon fa fa-plus-square"></i>  </a>
						</div>
					</div>
					<div class="space-6"></div>
					<div class="row">
						<div class="col-sm-2">
							<label> Reférence</label>
						</div>
						<div class="col-sm-6">
							<div class="clearfix">
								<input type="text" id="reference" name="reference"
									placeholder="" style="width: 100%" class="col-xs-10 col-sm-7">
							</div>
						</div>
					</div>
					<div class="space-6"></div>
					<div class="row">
						<div class="col-sm-2">
							<label> Origine</label>
						</div>
						<div class="col-sm-6">
							<div class="clearfix">
								<input type="text" id="adresse" name="adresse" placeholder=""
									style="width: 100%" class="col-xs-10 col-sm-7">
							</div>
						</div>
					</div>
					<div class="space-6"></div>
				</div>
				<div class="col-sm-6">
					<div class="form-group" style="margin-bottom: 45px; width: 173%;">
						<label class="col-sm-2 control-label no-padding-right"
							for="form-field-1"> Numero Achat</label>
						<div class="col-sm-6">
							<div class="clearfix">
								<input type="text" id="numAchat" placeholder=""
									class="col-xs-10 col-sm-7">
							</div>
						</div>
					</div>
					<div class="form-group" style="margin-bottom: 56px; width: 173%;">
						<label class="col-sm-2 control-label no-padding-right"
							for="form-field-1"> Date Achat</label>
						<div class="col-sm-6">
							<div class="clearfix">
								<input type="text" id="dateAchat" name="dateAchat"
									placeholder="" class="col-xs-10 col-sm-7">
							</div>
						</div>
					</div>
					<div class="input-append bootstrap-timepicker form-group"
						style="margin-top: 88px;">
						<label class="col-sm-4 control-label no-padding-right"
							for="form-field-1"> Heure de réception</label>
						<div class="bootstrap-timepicker col-sm-6"
							style="margin-left: -22px; width: 20%;">
							<div class="clearfix">
								<input name="heureReception" id="heureReception" type="text"
									class="col-xs-10 col-sm-7" />
							</div>
						</div>
					</div>

				</div>

			</div>
			<div class="row">
					<a id="add_row" class="btn btn-primary btn-sm"  title="Ajouter une ligne"
						alt="Ajouter une ligne"><i
						class="ace-icon fa fa-plus-square"></i> </a> 
                                        <a id='delete_row'
						class="btn btn-danger btn-sm" title="Supprimer une ligne"
						alt="Supprimer une ligne"> <i class="ace-icon fa fa-minus-square"></i>
					</a>
                                    <a id="NEW_PRODUIT" class="btn btn-primary btn-sm" style="float: right"><i
						class="ace-icon fa fa-plus-square"></i> Nouveau produit</a> 
			</div>
			<div class="space-6"></div>
			<div class="row">
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Désignation</th>
								<th class="text-center">Prix Unitaire</th>
								<th class="text-center">Quantité(kg)</th>
								<th class="text-center">Montant</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addr0'>
								<td>1</td>
								<td><select id="designation0" name="designation0"
									class="col-xs-10 col-sm-10">
										<option value="-1" id="designationSelect"
											class="designations0">selectionnez un produit</option>
								</select>
								</td>
                                                                <td><input type="text" readonly id="pu0" name='pu0' class="form-control" />
								</td>
								<td><input type="text" id="qte0" name='qte0'
									class="form-control qte" />
								</td>
								<td><input type="text" readonly id="montant0" name='montant0'
									class="form-control montant" />
								</td>
							</tr>
							<tr id='addr1'></tr>
						</tbody>
					</table>
			</div>
			<div class="row">
				<div class="col-md-12 column">
					<div class="col-sm-3"></div>
					<div class="col-sm-3"></div>
					<div class="col-sm-3"
						style="margin-left: 57.5%; margin-top: -10px;">
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right"
								for="form-field-1"> Total </label>
							<div class="col-sm-8">
								<input type="text" readonly id="poidsTotal" name="poidsTotal"
									placeholder="" class="col-xs-12 col-sm-10">
							</div>
						</div>
					</div>


					<div class="col-sm-3"
						style="margin-left: 82.5%; margin-top: -35px;">
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right"
								for="form-field-1"> total </label>
							<div class="col-sm-8">
								<input type="text" readonly id="montantTotal" name="montantTotal"
									placeholder="" class="col-xs-12 col-sm-10">
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="space-6"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-sm-8"></div>
					<div class="col-sm-4">
						<div class="form-group" style="margin-bottom: 40px;">
							<label class="col-sm-5 control-label no-padding-right"
								for="form-field-1"> Mode de paiement </label>
							<div class="col-sm-7">
								<div class="clearfix">
                                                                    <select disabled id="modePaiement" class="col-xs-12 col-sm-10">
										<option value=""></option>
										<option value="ESPECES">Especes</option>
										<option value="CHEQUE">Cheque</option>
										<option value="VIREMENT">Virement</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 86px;margin-top: 11%;">
							<label class="col-sm-5 control-label no-padding-right"
								for="form-field-1"> No Cheque </label>
							<div class="col-sm-7">
								<div class="clearfix">
									<input type="text" readonly id="numCheque" placeholder=""
										class="col-xs-12 col-sm-10">
								</div>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 132px;margin-top: 11%;">
							<label class="col-sm-5 control-label no-padding-right"
								for="form-field-1"> Date de paiement </label>
							<div class="col-sm-7">
								<div class="clearfix">
									<input type="text" readonly id="datePaiement" placeholder=""
										class="col-xs-12 col-sm-10">
								</div>
							</div>
						</div>
						<div class="form-group" style="margin-bottom: 177px;margin-top: 11%;">
							<label class="col-sm-5 control-label no-padding-right"
								for="form-field-1"> Avance  (FCFA)</label>
							<div class="col-sm-7">
								<div class="clearfix">
									<input type="text" readonly id="avance" name="avance" placeholder=""
										class="col-xs-12 col-sm-10">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label no-padding-right"
								for="form-field-1"> Reliquat (FCFA)</label>
							<div class="col-sm-7">
								<div class="clearfix">
									<input type="text" readonly id="reliquat" name="reliquat" placeholder=""
										class="col-xs-12 col-sm-10">
								</div>
							</div>
						</div>
                                            <div class="space-12"></div>
						<div class="form-group" style="margin-top: 43px;">
							<label class="col-sm-5 control-label no-padding-right"
								for="form-field-1"> Reglé </label>
							<div class="col-sm-7">
								<div class="clearfix">
                                                                    <input type="checkbox" disabled="disabled" id="regleAchat" name="regleAchat" placeholder=""
										>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 column" style="margin-top: 20px;">
						<button id="SAVE" class="btn btn-small btn-info pull-right"
							data-dismiss="modal">
							<i class="fa fa-plus-square "></i> Enregistrer
						</button>
					</div>
				</div>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</form>

        <div id="winModalMareyeur" class="modal fade" tabindex="-1">
            <form id="formMareyeur" class="form-horizontal"  onsubmit="return false;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Mareyeur</h3>
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
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Compte </label>
                                    <div class="col-sm-9">
                                        <input type="number" id="compte" name="compte" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                                </div>
                                <div class="modal-footer">
                    <button id="SAVE_MAREYEUR" class="btn btn-small btn-info">
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
        <div id="winModalProduit" class="modal fade" tabindex="-1">
            <form id="formProduit" class="form-horizontal" role="form">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Produit</h3>
                        </div>

                        <div class="modal-body" style="height: 240px;">
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Désignation </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="designation" name="designation" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock provisoire</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="stockProvisoire" name="stockProvisoire" placeholder="" class="col-xs-10 col-sm-7" value="0">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock reel</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="stockReel" name="stockReel" placeholder="" class="col-xs-10 col-sm-7" value="0">
                                    </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="SAVE_PRODUIT" class="btn btn-small btn-info" >
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
</div>
<!-- /.page-content -->


<script type="text/javascript">
//{id:"1",designation:"",pu:"",quantite:"",montant:""}
$(document).ready(function () {
    $('#CMB_MAREYEURS').select2();
    $('#designation0').select2();
    var mareyeurId;
    $.post("<?php echo App::getBoPath(); ?>/achat/AchatController.php", {ACTION: "<?php echo App::ACTION_GET_LAST_NUMBER; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#numAchat").val(sData.oId);
            }
    });
    var today = new Date();
    var dateAchat = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd;} if(mm<10){mm='0'+mm;} today = dd+'-'+mm+'-'+yyyy;dateAchat=yyyy+'-'+mm+'-'+dd;
    $('#dateAchat').attr('value', today);
    
    $('#heureReception').timepicker({
            minuteStep: 1,
            defaultTime: new Date(),
            showSeconds: false,
            showMeridian: false
        });
        
    loadProduit = function(index){
        $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {codeUsine: "<?php echo $codeUsine; ?>", ACTION: "<?php echo App::ACTION_LIST_PAR_USINE
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
    
     loadReferenceMareyeur = function () {
                    $.post("<?php echo App::getBoPath(); ?>/mareyeur/MareyeurController.php", {ACTION: "<?php echo App::ACTION_GET_LAST_NUMBER; ?>"}, function (data) {
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
              
                
    loadMareyeurs = function(){
        $.post("<?php echo App::getBoPath(); ?>/mareyeur/MareyeurController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#CMB_MAREYEURS").loadJSON('{"mareyeurs":' + data + '}');
            }
        });
    };
    loadMareyeurs();
    loadProduit(0);
    var i=1;
     $("#add_row").click(function(){
//      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='mail"+i+"' type='text' placeholder='Mail'  class='form-control input-md'></td><td><input  name='mobile"+i+"' type='text' placeholder='Mobile'  class='form-control input-md'></td>");


$('#addr'+i).html("<td>"+ (i+1) +"</td><td><select id='designation"+i+"' name='designation"+i+"' class='col-xs-10 col-sm-10'>\n\
<option value='-1' class='designations"+i+"'>sélectionnez un produit</option></select>\n\
</td>\n\
<td><input type='text' readonly id='pu"+i+"' name='pu"+i+"' class='form-control'/></td>\n\
<td><input type='text' id='qte"+i+"' name='qte"+i+"'  class='form-control qte'/></td>\n\
<td><input type='text' readonly id='montant"+i+"' name='montant"+i+"'  class='form-control montant'/>");
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
        // loadPrix('designation'+counter,'pu'+counter);
       //   calculPoidsNet(counter);
       //   calculMontant(counter);
         // calculMontantPoids();
         $( "#designation"+counter ).change(function() {
            calculMontant(counter);
       });
        $( "#pu"+counter ).keyup(function() {
           calculMontant(counter);
      });
      $( "#qte"+counter ).keyup(function() {
            calculMontant(counter);
       });
        
    });
    
   
    $("#modePaiement").change(function() {
        if($("#modePaiement").val() =='CHEQUE') {
            $("#numCheque").prop("readonly", false);
            $("#datePaiement").prop("readonly", true);
            $("#datePaiement").toggleDisabled();
        }
        else if($("#modePaiement").val() == 'VIREMENT') {
            $("#numCheque").prop("readonly",true );
            $("#datePaiement").prop("readonly", false);
        }
        else{
            $("#numCheque").prop("readonly", true);
            $("#datePaiement").prop("readonly", true);
            
        }
    });
//    $('#designation0').change(function() {
//        loadPrix('designation0','pu0');
//        });
 $("#datePaiement").datepicker({
                        autoclose: true,
                        todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                        $(this).prev().focus();
                });
    loadPrix = function(cmbDesignation, champPrix){
        //$('#tab_logic').click();
        if($("#"+cmbDesignation).val()!==null){
            $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {produitId: $("#"+cmbDesignation).val(), ACTION: "<?php echo App::ACTION_GET_PRODUCT; ?>"}, function(data) {
            data = $.parseJSON(data);
            $("#" + champPrix).val(data);
            });
        }
    };
    
     loadInfoMareyeur = function(mareyeurId){
        //$('#tab_logic').click();
        if(mareyeurId!==''){
            $.post("<?php echo App::getBoPath(); ?>/mareyeur/MareyeurController.php", {mareyeurId: mareyeurId, ACTION: "<?php echo App::ACTION_GET_MAREYEURS; ?>"}, function(data) {
            data = $.parseJSON(data);
            $("#adresse").val(data.adresse);
            $('#reference').val(data.reference);
            });
        }
    };
    
    $('#CMB_MAREYEURS').change(function() {
    if($('#CMB_MAREYEURS').val()!==null) {
        if($('#CMB_MAREYEURS').val()!=='*') {
            mareyeurId = $('#CMB_MAREYEURS').val()
            loadInfoMareyeur($('#CMB_MAREYEURS').val());
        }
        else {
            $('#adresse').val("");
            $('#reference').val("");
        }
    }
        });
    
            $("#montantTotal").bind("focus", function () {
            calculMontantPoids();
            
        });
            
        function calculPoidsNet(index){
           var pn;
           if($("#perc"+index).val() !=="") {
              var pourcentage = $("#perc"+index).val();
              var quantite = $("#qte"+index).val();
              pn = parseFloat(quantite) - ((parseFloat(quantite) * pourcentage)/100);
              if(!isNaN(pn))
                $("#pdN"+index).val(pn);
              
            }  
       }
       

         $( "#qte0" ).keyup(function() {
            calculMontant(0);
         }); 
         
          $( "#avance" ).keyup(function() {
            calculReliquat();
         }); 
        
       function calculMontant(index){
           var mt;
           var qte=parseFloat($("#qte"+index).val());
           if(!isNaN(qte)) {
              var pu = $("#pu"+index).val();
              mt = parseFloat(qte) * parseFloat(pu);
              if(!isNaN(mt)){
                $("#montant"+index).val(mt);
              }
            }
            else {
                $("#montant"+index).val("");
            }
            calculMontantPoids();
            calculReliquat();
       }
       function calculMontantPoids(){
           var pt=0;
           var pd=0;
          $('#tab_logic .montant').each(function () {
              if($(this).val()!=='')
                pt += parseFloat($(this).val());
            });
            $('#tab_logic .qte').each(function () {
                if($(this).val()!=='')
                pd+= parseFloat($(this).val());
            });
                if(!isNaN(pt))
                    $("#montantTotal").val(pt);
                if(!isNaN(pd))
                    $("#poidsTotal").val(pd);
        }
        

        
        function calculReliquat(){
          var rel=0;
           var mt=parseFloat($("#montantTotal").val());
           var avance=parseFloat($("#avance").val());
           if(!isNaN(avance) && !isNaN(avance)) {
           rel= mt - avance;
           if(!isNaN(rel) && rel>0) {
              $("#reliquat").val(rel);
              $('#regleAchat').attr("disabled", true);
              $('#regleAchat').prop('checked', false);
          }
           else if(!isNaN(rel) && rel===0) {
              $('#regleAchat').attr("disabled", false);
              $('#regleAchat').prop('checked', true);
              $("#reliquat").val(0);
          }  
          else{
              $.gritter.add({
                    title: 'Notification',
                    text: 'Le montant saisi ne doit pas être supérieur au montant TTC',
                    class_name: 'gritter-error gritter-light'
                });
              $("#avance").val("");
              $("#reliquat").val("");
              $('#regleAchat').attr("disabled", true);
              $('#regleAchat').prop('checked', false);
          }
        }
//        else {
//             $.gritter.add({
//                    title: 'Notification',
//                    text: 'Le montant avance ne doit pas être vide',
//                    class_name: 'gritter-error gritter-light'
//                });
//        }
        }
        
        AchatProcess = function ()
        {
            
           $('#SAVE').attr("disabled", true);
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var numAchat= $('#numAchat').val();
            var heureReception= $('#heureReception').val();
            var dateAchat = $('#dateAchat').val();;
            var mareyeur = mareyeurId;
            var poidsTotal = $("#poidsTotal").val();
            var MontantTotal = $("#montantTotal").val();
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
            var $table = $("table")
    rows = [],
    header = [];

//$table.find("thead th").each(function () {
//    header.push($(this).html().trim());
//});
header = ["#","designation","pu","qte","montant"];
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
    
    
            var tbl=JSON.stringify(rows);
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('numAchat', numAchat);
            formData.append('dateAchat', dateAchat);
            formData.append('heureReception', heureReception);
            formData.append('mareyeur', mareyeur);
            formData.append('poidsTotal', poidsTotal);
            formData.append('montantTotal', MontantTotal);
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
                url: '<?php echo App::getBoPath(); ?>/achat/AchatController.php',
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
                   // window.open('<?php echo App::getHome(); ?>/app/pdf/achatPdf.php?achatId='+data.oId,'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1000, height=650');
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {
                    });
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
                    alert("failure - controller");
                }
            });

        };
//         $("#SAVE").bind("click", function () {
//             AchatProcess();
           
//         });
        
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
        //Validate
        $("#SAVE").bind("click", function () {
        $('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				reference: {
					required: true
				},
				adresse: {
					required: true
				},
				dateAchat: {
					required: true
				},
				heureReception: {
					required: true
				}
				
			},
	
			messages: {
				reference: {
					required: "Champ obligatoire."
				},
				adresse: {
					required: "Champ obligatoire."
				},
				dateAchat: {
					required: "Champ obligatoire."
				},
				heureReception: {
					required: "Champ obligatoire."
				},
				poidsTotal: {
                                        required:"Champ obligatoire."
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
				AchatProcess();
			},
			invalidHandler: function (form) {
			}
		});


        });
        
        $("#NEW_MAREYEUR").click(function ()
    {
         loadReferenceMareyeur();
        $('#winModalMareyeur').modal('show');
    });
    
    $("#NEW_PRODUIT").click(function()
        {
            $('#winModalProduit').modal('show');
        });
        
        SaveMareyeurProcess = function ()
    {

        var ACTION = '<?php echo App::ACTION_INSERT; ?>';
        var frmData;
        //             var familleproduit= $('#familleMareyeurId').val();
        var reference = $("#new_reference").val();
        var nom = $("#nom").val();
        var adresse = $("#new_adresse").val();
        var telephone = $("#telephone").val();
        var compte = $("#compte").val();

        var formData = new FormData();
        formData.append('ACTION', ACTION);
        formData.append('reference', reference);
        formData.append('nom', nom);
        formData.append('adresse', adresse);
        formData.append('telephone', telephone);
        formData.append('compte', compte);
        $.ajax({
            url: '<?php echo App::getBoPath(); ?>/mareyeur/MareyeurController.php',
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
                             //groupeId=groupId;
                            $("#CMB_MAREYEURS").select2("data", jsonText, true);
                            mareyeurId = data.oId;
                            //$("#CMB_MAREYEURS").val(data.oId);//.change();
                            $("#reference").val(reference);
                            $("#adresse").val(adresse);
                            
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
                
            },
            error: function () {
                alert("failure - controller");
            }
        });

    };
    
    $("#SAVE_MAREYEUR").click(function() {
    	 $('#formMareyeur').validate({
    			errorElement: 'div',
    			errorClass: 'help-block',
    			focusInvalid: false,
    			rules: {
    				new_reference: {
    					required: true
    				},
    				nom: {
    					required: true
    				},
    				new_adresse: {
    					required: true
    				}
    				
    			},

    			messages: {
    				new_reference: {
    					required: "Champ obligatoire."
    				},
    				nom: {
    					required: "Champ obligatoire."
    				},
    				new_adresse: {
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
    			SaveMareyeurProcess();
    		        //$('#winModalMareyeur').addClass('hide');
    		        $('#winModalMareyeur').modal('hide');
                        $('#nom').val("");
                        $('#new_adresse').val("");
                        $('#telephone').val("");
                        $('#compte').val("");
    			},
    			invalidHandler: function (form) {
    			}
    		});
                
               
    });
    function calculSeuil(){
           var stock = parseFloat($("#stockReel").val());
           if(!isNaN(stock) && stock!==0) {
            var seuil=0;
           if(stock > 0)
              seuil = (stock * 25)/100;
           return seuil;
       }
   }
     produitProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var designation = $("#designation").val();
            var stockProvisoire = $("#stockProvisoire").val();
            var stockReel = $("#stockReel").val();
            var seuil = calculSeuil();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('designation', designation);
            formData.append('stockProvisoire', stockProvisoire);
            formData.append('stockReel', stockReel);
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
                       var tableL=$("#tab_logic > tbody > tr").length;
                       for(i=0;i<tableL;i++)
                        loadProduit(i);
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
        
         //Validate
       $("#SAVE_PRODUIT").bind("click", function () {
       $('#formProduit').validate({
           
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				designation: {
					required: true
				},
				stockProvisoire: {
					required: true
				},
				stockReel: {
					required: true
				}
			},
	
			messages: {
				designation: {
					required: "Champ obligatoire."
				},
				stockProvisoire: {
					required: "Champ obligatoire."
				},
				stockReel: {
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
				 produitProcess();
                                 $('#winModalProduit').modal('hide');
                                 $('#designation').val("");
                                $('#stockProvisoire').val(0);
                                $('#stockReel').val(0);
			},
			invalidHandler: function (form) {
			}
		});

       });
});
</script>
