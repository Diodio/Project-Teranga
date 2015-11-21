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
            Bon de sortie <small> <i
                    class="ace-icon fa fa-angle-double-right"></i> Facture
            </small>
        </h1>
    </div>
    <!-- /.page-header -->
     <form  id="validation-form" method="get">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->


           <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-2">
                        <label> Colisage</label>
                    </div>
                    <div class="col-sm-6">
                        <select id="CMB_COLISAGES" data-placeholder=""  style="width:100%"     >
                            <option value="*" class="colisages">Numéro</option>
                        </select>
                    </div>
                </div>
               <div class="space-6"></div>
                <div class="row" >
                        <div class="col-sm-2">
                            <label> Client</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="nomClient" placeholder="" style="width:100%" 
                                       class="col-xs-10 col-sm-7">
                            </div>
                 </div>
               <div class="space-6"></div>
                 <div class="row">
                        <div class="col-sm-2">
                            <label> Origine</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="origine" placeholder=""  style="width:100%" 
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
        <div class="space-6"></div>
            <div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table table-bordered table-hover" id="LISTESORTIE">
				<thead>
					<tr >
						
						<th class="text-center">
							Désignation
						</th>
						<th class="text-center">
							Prix Unitaire
						</th>
						<th class="text-center">
							Quantite (kg)
						</th>
						<th class="text-center">
							Montant
						</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
        <div class="row">
            <div class="col-md-12 column">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3" style="margin-left: 64.6%;;margin-top: -10px;">
                    <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Total </label>
                            <div class="col-sm-8">
                                <input type="text" id="poidsTotal" name="poidsTotal" placeholder="" class="col-xs-12 col-sm-10">
                            </div>
                    </div>
                </div>
                <div class="col-sm-3">
                </div>
                
            </div>
        </div>
        <div class="space-6"></div>
        <div class="row">
                <div class="col-md-12">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"
                                            for="form-field-1"> Port de déchargement </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="portDechargement" name="portDechargement" placeholder=""
                                                            class="col-xs-12 col-sm-7">
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-6"></div>
                            <div class="row">
                            
			<div class="row clearfix">
				<div class="col-md-12 column">
					<a id="add_row" class="btn btn-primary btn-sm"><i
						class="ace-icon fa fa-plus-square"></i> </a> <a id='delete_row'
						class="btn btn-danger btn-sm" title="Supprimer une ligne"
						alt="Supprimer une ligne"> <i class="ace-icon fa fa-minus-square"></i>
					</a>
				</div>
			</div>
			<div class="space-6"></div>
			<div class="row clearfix">
				<div class="col-md-6 column">
					<table class="table table-bordered table-hover" id="tab_logic">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">N° conteneur</th>
								<th class="text-center">N° plomb</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addr0'>
								<td>1</td>
								<td><input type="text" id="cont0" name='cont0'
									class="form-control" />
								</td>
								<td><input type="text" id="plb0" name='plb0'
									class="form-control" />
								</td>
							</tr>
							<tr id='addr1'></tr>
						</tbody>
					</table>
				</div>
			</div>
                            </div>
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
    
</div>
<!-- /.page-content -->


<script type="text/javascript">
//{id:"1",designation:"",pu:"",quantite:"",montant:""}
$(document).ready(function () {
    $('#CMB_COLISAGES').select2();
    var bonsortieId;
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
        
    
    loadColisages = function(){
        $.post("<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#CMB_COLISAGES").loadJSON('{"colisages":' + data + '}');
            }
        });
    };
    loadColisages();
    loadInfoColisage = function(colisageId){
        if(colisageId!==''){
            $.post("<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php", {colisageId: colisageId, ACTION: "<?php echo App::ACTION_GET_COLISAGES; ?>"}, function(data) {
            data = $.parseJSON(data);
           //bonsortieId=data.id;
            $("#nomClient").val(data.nomClient);
            $('#origine').val(data.origine);
            $('#LISTESORTIE tbody').html("");
            var table = data.ligneBonSortie;
            var trHTML='';
            var tot=0;
            $(table).each(function(index, element){
                var montant=parseInt(element.prixUnitaire) * parseFloat(element.quantite);
                if(typeof montant==='undefined')
                    montant = 0;
                tot = tot+montant;
                trHTML += '<tr><td>' + element.designation + '</td><td>' + element.prixUnitaire + '</td><td>' + element.quantite + '</td><td>' + montant + '</td></tr>';
            });
            $('#LISTESORTIE tbody').append(trHTML);
            trHTML='';
            var poidsTotal=data.poidsTotal;
             if(poidsTotal==="")
                poidsTotal=0;
            $('#poidsTotal').val(poidsTotal);
            if(typeof tot==='undefined')
                tot=0;
            $('#montantHt').val(tot);
            var montantTtc = tot + (tot * 0.18);
            if(typeof montantTtc==='undefined')
                montantTtc=0;
            $('#montantTtc').val(montantTtc);
            });
            
        }
    };
    $('#CMB_COLISAGES').change(function() {
        if($('#CMB_COLISAGES').val()!=='*')
            loadInfoColisage($('#CMB_COLISAGES').val());
        else {
            $('#nomClient').val("");
            $('#origine').val("");
        }
        });
    var i=1;
     $("#add_row").click(function(){
    $('#addr'+i).html("<td>"+ (i+1) +"<td><input type='text' id='cont"+i+"' name='cont"+i+"' class='form-control'/></td>\n\
    <td><input type='text' id='plb"+i+"' name='plb"+i+"'  class='form-control'/></td>");
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++;
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

    $("#modePaiement").change(function() {
        if($("#modePaiement").val() ==='ch') {
            $("#numCheque").removeAttr("readOnly");
            
        }
        else {
            $("#numCheque").attr("readOnly");
        }
    });
    
      

       
        factureProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var colisage = $("#CMB_COLISAGES").val();
            var numFacture= $('#numFacture').val();
            var heureFacture= $('#heureFacture').val();
            var devise= $('#devise').val();
            var pays= $('#pays').val();
            var portDechargement = $("#portDechargement").val();
            var montantHt = $("#montantHt").val();
            var montantTtc = $("#montantTtc").val();
            var modePaiement = $("#modePaiement").val();
            var numCheque = $("#numCheque").val();
            var avance = $("#avance").val();
            var reliquat = $("#reliquat").val();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('colisage', colisage);
            formData.append('numFacture', numFacture);
            formData.append('heureFacture', heureFacture);
            formData.append('devise', devise);
            formData.append('pays', pays);
            formData.append('portDechargement', portDechargement);
            formData.append('montantHt', montantHt);
            formData.append('montantTtc', montantTtc);
            formData.append('modePaiement', modePaiement);
            formData.append('numCheque', numCheque);
            formData.append('avance', avance);
            formData.append('reliquat', reliquat);
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
                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/listeFactures.php", function () {
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
});
</script>
