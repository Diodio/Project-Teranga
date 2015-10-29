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

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->


           <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-2">
                        <label> Mareyeur</label>
                    </div>
                    <div class="col-sm-6">
                        <select id="CMB_MAREYEURS" data-placeholder=""  style="width:100%"     >
                            <option value="*" class="mareyeurs">Nom Mareyeur</option>
                        </select>
                    </div>
                </div>
               <div class="space-6"></div>
                <div class="row" >
                        <div class="col-sm-2">
                            <label> Reference</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="reference" placeholder="" style="width:100%" 
                                       class="col-xs-10 col-sm-7">
                            </div>
                 </div>
               <div class="space-6"></div>
                 <div class="row">
                        <div class="col-sm-2">
                            <label> Adresse</label>
                        </div>
                            <div class="col-sm-6">
                                <input type="text" id="adresse" placeholder=""  style="width:100%" 
                                       class="col-xs-10 col-sm-7">
                            </div>
                 </div>
                 <div class="space-6"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom: 45px;width: 173%;" >
                            <label class="col-sm-2 control-label no-padding-right"
                                   for="form-field-1"> Numero Achat</label>
                            <div class="col-sm-6">
                                <input type="text" id="numAchat" placeholder=""
                                       class="col-xs-10 col-sm-7">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 56px;width: 173%;">
                            <label class="col-sm-2 control-label no-padding-right"
                                   for="form-field-1"> Date Achat</label>
                            <div class="col-sm-6">
                                <input type="text" id="dateAchat" placeholder=""
                                       class="col-xs-10 col-sm-7">
                            </div>
                        </div>
                       
                    </div>

                </div>
        <div class="row clearfix">
            <div class="col-md-12 column">
                <a id="add_row" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-plus-square"></i></a>
                <a id='delete_row' class="btn btn-danger btn-sm" title="Supprimer une ligne" alt="Supprimer une ligne">
                        <i class="ace-icon fa fa-minus-square"></i>
                </a>
            </div>
        </div>
        <div class="space-6"></div>
            <div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							#
						</th>
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
							Pourcentage
						</th>
						<th class="text-center">
							Poids Net (kg)
						</th>
						<th class="text-center">
							Montant
						</th>
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>
						1
						</td>
						<td>
                                                    <select id="designation0" name="designation0" class="col-xs-10 col-sm-10">
                                                        <option value="-1" class="designations0">sélectionnez un produit</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="pu0" name='pu0' class="form-control"/>
						</td>
                                                <td>
                                                    <input type="text" id="qte0" name='qte0'  class="form-control qte"/>
						</td>
                                                <td>
                                                    <input type="number" id="perc0" name='perc0' class="col-xs-9"/>
                                                    %
						</td>
                                                <td>
                                                    <input type="text" id="pdN0" name='pdN0' class="form-control poidsNet"/>
						</td>
						<td>
                                                    <input type="text" id="montant0" name='montant0' class="form-control montant"/>
						</td>
					</tr>
                    <tr id='addr1'></tr>
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
                <div class="col-sm-3" style="margin-left: 35.5%;;margin-top: -10px;">
                    <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Total </label>
                            <div class="col-sm-8">
                                <input type="text" id="poidsTotal" name="poidsTotal" placeholder="" class="col-xs-12 col-sm-10">
                            </div>
                    </div>
                </div>
                 
                     
                    <div class="col-sm-3" style="margin-left: 82.5%;margin-top: -35px;">
                    <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">  total </label>
                            <div class="col-sm-8">
                                <input type="text" id="montantTotal" name="montantTotal" placeholder="" class="col-xs-12 col-sm-10">
                            </div>
                    </div>
                     </div>
                
            </div>
        </div>
        <div class="space-6"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-8">
                    
                </div>
                <div class="col-sm-4" >
                    <form class="form-horizontal">
                        <div class="form-group">
                               <label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Mode de paiement </label>
                               <div class="col-sm-7">
                                   <select id="modePaiement" class="col-xs-12 col-sm-10">
                                        <option value="Esp">Espèces</option>
                                        <option value="ch">Chèque</option>
                                        <option value="vir">Virement</option>
                                    </select>
                               </div>
                       </div>
                        <div class="form-group">
                               <label class="col-sm-5 control-label no-padding-right" for="form-field-1">  N° Chèque </label>
                               <div class="col-sm-7">
                        <input type="text" id="numCheque" placeholder=""
                                           class="col-xs-12 col-sm-10">
                               </div>
                       </div>
                        <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Avance </label>
                                <div class="col-sm-7">
                                    <input type="text" id="avance" name="avance" placeholder="" class="col-xs-12 col-sm-10">
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Reliquat </label>
                                <div class="col-sm-7">
                                    <input type="text" id="reliquat" name="reliquat" placeholder="" class="col-xs-12 col-sm-10">
                                </div>
                        </div>
                    </form>
                 </div>
            </div>
        <div class="row" style="margin-top: 12px;">
                <div class="col-md-12 column">
                    <button id="SAVE" class="btn btn-small btn-info pull-right" data-dismiss="modal">
                                <i class="fa fa-plus-square "></i>
                                Valider
                            </button>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</div>
<!-- /.page-content -->


<script type="text/javascript">
//{id:"1",designation:"",pu:"",quantite:"",montant:""}
$(document).ready(function () {
    $('#CMB_MAREYEURS').select2();
    $('#designation0').select2();
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
    if(dd<10){dd='0'+dd;} if(mm<10){mm='0'+mm;} today = dd+'/'+mm+'/'+yyyy;dateAchat=yyyy+'-'+mm+'-'+dd;
    $('#dateAchat').attr('value', today);

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
<td><input type='text' id='pu"+i+"' name='pu"+i+"' class='form-control'/></td>\n\
<td><input type='text' id='qte"+i+"' name='qte"+i+"'  class='form-control qte'/></td>\n\
<td><input type='number' id='perc"+i+"' name='perc"+i+"' class='col-xs-9'/>%</td>\n\
<td><input type='text' id='pdN"+i+"' name='pdN"+i+"' class='form-control'/></td>\n\
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
          loadPrix('designation'+counter,'pu'+counter);
          calculPoidsNet(counter);
          calculMontant(counter);
          calculMontantPoids();
      $( "#qte"+counter ).keyup(function() {
            calculMontant(counter);
         });
         $( "#perc"+counter ).keyup(function() {
            calculPoidsNet(counter);
         });  
    });
    

    $("#modePaiement").change(function() {
        if($("#modePaiement").val() ==='ch') {
            $("#chDiv").removeClass("hide");
            $("#chDiv").addClass("show");
        }
        else {
            $("#chDiv").removeClass("show");
            $("#chDiv").addClass("hide");
        }
    });
    $('#designation0').change(function() {
        loadPrix('designation0','pu0');
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
        if($('#CMB_MAREYEURS').val()!=='*')
            loadInfoMareyeur($('#CMB_MAREYEURS').val());
        else {
            $('#adresse').val("");
            $('#reference').val("");
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
              pn = parseInt(quantite) - ((parseInt(quantite) * pourcentage)/100);
              if(!isNaN(pn))
                $("#pdN"+index).val(pn);
              
            }  
       }
       

         $( "#qte0" ).keyup(function() {
            calculMontant(0);
         }); 
         $( "#perc0" ).keyup(function() {
            calculPoidsNet(0);
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
          $('#tab_logic .montant').each(function () {
                pt += parseInt($(this).val());
            });
            $('#tab_logic .qte').each(function () {
                pd+= parseFloat($(this).val());
            });
                if(!isNaN(pt))
                    $("#montantTotal").val(pt);
                if(!isNaN(pd))
                    $("#poidsTotal").val(pd);
        }
        
        AchatProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var numAchat= $('#numAchat').val();
           // var dateAchat = dateAchat;
            var mareyeur = $("#CMB_MAREYEURS").val();
            var poidsTotal = $("#poidsTotal").val();
            var MontantTotal = $("#montantTotal").val();
            var modePaiement = $("#modePaiement").val();
            var numCheque = $("#numCheque").val();
            var avance = $("#avance").val();
            var reliquat = $("#reliquat").val();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            var $table = $("table")
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
    
    
            var tbl=JSON.stringify(rows);
            console.log(tbl);
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('numAchat', numAchat);
            formData.append('dateAchat', dateAchat);
            formData.append('mareyeur', mareyeur);
            formData.append('poidsTotal', poidsTotal);
            formData.append('montantTotal', MontantTotal);
            formData.append('modePaiement', modePaiement);
            formData.append('numCheque', numCheque);
            formData.append('avance', avance);
            formData.append('jsonProduit', tbl);
            formData.append('reliquat', reliquat);
            formData.append('codeUsine', codeUsine);
            formData.append('login', login);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/achat/achatController.php',
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
                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/listebonsAchatVue.php", function () {
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
            AchatProcess();
           
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
