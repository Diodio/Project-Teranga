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
                                   for="form-field-1"> Numero Commande</label>
                            <div class="col-sm-6">
                                <input type="text" id="reference" placeholder=""
                                       class="col-xs-10 col-sm-7">
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 56px;width: 173%;">
                            <label class="col-sm-2 control-label no-padding-right"
                                   for="form-field-1"> Date Commande</label>
                            <div class="col-sm-6">
                                <input type="text" id="reference" placeholder=""
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
							Désination
						</th>
						<th class="text-center">
							Prix Unitaire
						</th>
						<th class="text-center">
							Poids brut
						</th>
						<th class="text-center">
							Pourcentage
						</th>
						<th class="text-center">
							Poids Net
						</th>
						<th class="text-center">
							Quantite
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
                                                    <input type="text" id="pdB0" name='pdB0' class="form-control"/>
						</td>
                                                <td>
                                                    <input type="number" id="perc0" name='perc0' class="col-xs-9"/>
                                                    %
						</td>
                                                <td>
                                                    <input type="text" id="pdN0" name='pdN0' class="form-control"/>
						</td>
						<td>
                                                    <input type="text" id="qte0" name='qte0'  class="form-control"/>
						</td>
						<td>
                                                    <input type="text" id="montant0" name='montant0' class="form-control"/>
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
                 
                     <div class="col-sm-3" >
                     <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Poids Total </label>
                            <div class="col-sm-8">
                                <input type="text" id="poidsTotal" name="poidsTotal" placeholder="" class="col-xs-12 col-sm-12">
                            </div>
                    </div>
                     </div>
                     <div class="col-sm-3" >
                    <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Montant total </label>
                            <div class="col-sm-8">
                                <input type="text" id="montantTotal" name="montantTotal" placeholder="" class="col-xs-12 col-sm-12">
                            </div>
                    </div>
                     </div>
                
            </div>
        </div>
        <div class="space-6"></div>
        <div class="row">
            <div class="col-md-12 column">
                <div class="col-sm-3" >
                        <div class="form-group">
                               <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Mode de paiement </label>
                               <div class="col-sm-8">
                                   <select id="modePaiement" class="col-xs-12 col-sm-12">
                            <option value="Esp">Espèces</option>
                            <option value="ch">Chèque</option>
                            <option value="vir">Virement</option>
                        </select>
                               </div>
                       </div>
                     </div>
                     <div class="col-sm-3" >
                        <div class="form-group">
                               <label class="col-sm-4 control-label no-padding-right" for="form-field-1">  N° Chèque </label>
                               <div class="col-sm-8">
                        <input type="text" id="numCheque" placeholder=""
                                           class="col-xs-12 col-sm-12">
                               </div>
                       </div>
                     </div>
                     <div class="col-sm-3" >
                        <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Avance </label>
                                <div class="col-sm-8">
                                    <input type="text" id="avance" name="avance" placeholder="" class="col-xs-12 col-sm-12">
                                </div>
                        </div>
                     </div>
                     <div class="col-sm-3" >
                        <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Reliquat </label>
                                <div class="col-sm-8">
                                    <input type="text" id="reliquat" name="reliquat" placeholder="" class="col-xs-12 col-sm-12">
                                </div>
                        </div>
                     </div>
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
<td><input type='text' id='pdB"+i+"' name='pdB"+i+"' class='form-control'/></td>\n\
<td><input type='number' id='perc"+i+"' name='perc"+i+"' class='col-xs-9'/>%</td>\n\
<td><input type='text' id='pdN"+i+"' name='pdN"+i+"' class='form-control'/></td>\n\
<td><input type='text' id='qte"+i+"' name='qte"+i+"'  class='form-control'/></td>\n\
<td><input type='text' id='montant"+i+"' name='montant"+i+"'  class='form-control'/>");
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
       //$('#designation'+counter).change(function() {
          loadPrix('designation'+counter,'pu'+counter);
      //});
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
           
   });
</script>
