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
                                                            <input type="text" readonly id="numAchat" placeholder=""
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
					<a id="add_row" class="btn btn-primary btn-sm"  title="Ajouter une ligne de produit"
						alt="Ajouter une ligne"><i
						class="ace-icon fa fa-plus-square"></i> </a> 
                                        <a id='delete_row'
						class="btn btn-danger btn-sm" title="Supprimer une ligne de produit"
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
								<th class="text-center">Quantité(kg)</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addr0'>
								<td>1</td>
								<td><select id="designation0" name="designation0"
									class="des col-xs-10 col-sm-10">
										<option value="-1" id="designationSelect"
											class="designations0">selectionnez un produit</option>
								</select>
								</td>
                                                                <td><input type="text" readonly autocomplete="off" id="qte0" name='qte0'
									class="form-control qte" />
								</td>
							</tr>
							<tr id='addr1'></tr>
						</tbody>
					</table>
			</div>
			<div class="row">
				<div class="col-md-12 column">
					<div class="col-sm-9"></div>
						
					</div>


					<div class="col-sm-3"
						style="margin-left: 78.5%; margin-top: -10px;">
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right"
								for="form-field-1"> Total </label>
							<div class="col-sm-8">
								<input type="text" readonly id="poidsTotal" name="poidsTotal"
									placeholder="" class="col-xs-12 col-sm-10">
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
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Libellé facture </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="libelleFacture" name="libelleFacture" placeholder="" class="col-xs-10 col-sm-7">
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
    $.post("<?php echo App::getBoPath(); ?>/achat/AchatController.php", {codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_GET_LAST_NUMBER; ?>"}, function (data) {
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


$('#addr'+i).html("<td>"+ (i+1) +"</td><td><select id='designation"+i+"' name='designation"+i+"' class='des col-xs-10 col-sm-10'>\n\
<option value='-1' class='designations"+i+"'>sélectionnez un produit</option></select>\n\
</td>\n\
<td><input type='text' id='qte"+i+"' readonly autocomplete='off' name='qte"+i+"'  class='form-control qte'/></td>");
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
         
 
  $('#tab_logic').on('change', '.des', function()
    {
         var trouve=0;
       var id = $(this).closest('tr').attr('id');
       var counter = id.substring(4);
        if($( "#designation"+counter ).val()!== '-1')
               $("#qte"+counter).prop("readonly", false);
        else
            $("#qte"+counter).prop("readonly", true);
       
        var valueSelected = $( "#designation"+counter ).val();
            $('#tab_logic tbody tr td').each(function () {
                value = $(this).find('select').val();
                if(typeof value !=="undefined"){
                   if(value==valueSelected){
                       trouve+=1;
                   }
                }
            });
            if(trouve > 1){
                $.gritter.add({
                    title: 'Notification',
                    text: 'Ce produit existe deja, Veuillez changer de produit',
                    class_name: 'gritter-error gritter-light'
                });
                $( "#designation"+counter ).select2('val','-1');
                $("#qte"+counter).prop("readonly", true);
            }
    //set to work, you have the cells, the entire row, and the cell containing the button.
});
    $(document).delegate('#tab_logic tr td', 'click', function (event) {
       var id = $(this).closest('tr').attr('id');
       var counter = id.substring(4);
      
      $( "#qte"+counter ).keyup(function() {
            calculPoids(counter);
       });

    });
    
   
    
 
    
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
    
           
            
       
            
        

         $( "#qte0" ).keyup(function() {
            calculPoids();
         }); 
         
        
       
       function calculPoids(){
           var pt=0;
           var pd=0;
         
            $('#tab_logic .qte').each(function () {
                if($(this).val()!=='')
                pd+= parseFloat($(this).val());
            });
               
            if(!isNaN(pd))
                $("#poidsTotal").val(pd);
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
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            var $table = $("table")
    rows = [],
    header = [];

//$table.find("thead th").each(function () {
//    header.push($(this).html().trim());
//});
header = ["#","designation","qte"];
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
            formData.append('codeUsine', codeUsine);
            formData.append('login', login);
            formData.append('jsonProduit', tbl);
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
                    if("<?php echo $profil?>"!=='gerant'){
                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {
                        });
                    }
                    else {
                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListeGerant.php", function () {
                        });
                    }
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
            var libelleFacture = $("#libelleFacture").val();
            var stockProvisoire = $("#stockProvisoire").val();
            var stockReel = $("#stockReel").val();
            var seuil = calculSeuil();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('designation', designation);
            formData.append('libelleFacture', libelleFacture);
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
