<?php
require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
if(!isset($_COOKIE['userId'])){
	header('Location: '.\App::getHome());
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
			Demoulage <small> <i class="ace-icon fa fa-angle-double-right"></i>
				Demoulage
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-sm-5">

			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat">
					<h4 class="widget-title lighter">
						<i class="ace-icon fa fa-star orange"></i> Liste des produits à
						demouler
					</h4>

					<div class="widget-toolbar">
						<a href="#" data-action="collapse"> <i
							class="ace-icon fa fa-chevron-up"></i>
						</a>
					</div>
				</div>

				<div class="widget-body">
					<div class="widget-main no-padding">
						<table id="LIST_DEMOULAGES"
							class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th class="center" style="border-right: 0px none;"><label> <input
											type="checkbox" value="*" name="allchecked" /> <span
											class="lbl"></span>
									</label>
									</th>
									<th style="border-left: 0px none; border-right: 0px none;">
										Désignation</th>
									<th style="border-left: 0px none; border-right: 0px none;">
										Stock Provisoire</th>
									<th style="border-left: 0px none; border-right: 0px none;">
										Stock Réel</th>

									<!--<th class="hidden-phone" style="border-left: 0px none;border-right: 0px none;">
                                </th>-->
								</tr>
							</thead>

							<tbody>

							</tbody>
						</table>
					</div>
					<!-- /.widget-main -->
				</div>
				<!-- /.widget-body -->
			</div>
			<!-- /.widget-box -->
		</div>
		<!-- /.col -->
		<div class="col-sm-7">
			<div class="widget-container-span">
				<div class="widget-box transparent">
					<div class="widget-header">

						<h4 class="lighter"></h4>
						<div class="widget-toolbar no-border">
							<ul class="nav nav-tabs" id="TAB_GROUP">

								<li id="TAB_INFO_VIEW" class="active"><a id="TAB_INFO_LINK"
									data-toggle="tab" href="#TAB_INFO"> <i
										class="green icon-dashboard bigger-110"></i> Demoulage
								</a>
								</li>

							</ul>
						</div>
					</div>
					<form id="validation-form" class="form-horizontal"
						onsubmit="return false;">
						<div class="widget-body">
							<div
								class="widget-main padding-12 no-padding-left no-padding-right">
								<div class="tab-content padding-4">
									<h4 class="widget-title lighter">
										<i class="ace-icon fa fa-star orange"></i>Produit: <span
											id="nomProduit"></span>
									</h4>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right"
											for="form-field-1" style="margin-left: -8%"> Numéro</label>
										<div class="col-sm-8">
											<input type="text" id="numero"
												name="numero" placeholder=""
												class="col-xs-10 col-sm-4" disabled>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right"
											for="form-field-1" style="margin-left: -8%"> Stock Provisoire
											(kg)</label>
										<div class="col-sm-8">
											<input type="text" id="stockProvisoire"
												name="stockProvisoire" placeholder=""
												class="col-xs-10 col-sm-4" disabled>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label no-padding-right"
											for="form-field-1" style="margin-top: 5px; margin-left: -8%">
											Quantité demoulée (kg)</label>
										<div class="col-sm-8">
											<input type="number" id="quantiteDemoulee"
												name="quantiteDemoulee" placeholder=""
												class="col-xs-10 col-sm-4" style="margin-top: 5px;">
										</div>
									</div>

									<div class="row ">
										<div class="col-md-12 column">
											<a id="add_row" class="btn btn-primary btn-sm"><i
												class="ace-icon fa fa-plus-square"></i> </a> <a
												id='delete_row' class="btn btn-danger btn-sm"
												title="Supprimer une ligne" alt="Supprimer une ligne"> <i
												class="ace-icon fa fa-minus-square"></i>
											</a>
										</div>
									</div>
									<div class="space-6"></div>
									<div class="row clearfix">
										<div class="col-md-8 column">
											<table class="table table-bordered table-hover"
												id="tab_logic">
												<thead>
													<tr>
														<th class="text-center">#</th>
														<th class="text-center">Nombre de carton</th>
														<th class="text-center">Quantité/Carton</th>
														<th class="text-center">Total</th>
													</tr>
												</thead>
												<tbody>
													<tr id='addr0'>
														<td>1</td>
														<td><input type="number" id="cart0" name='cart0'
															class="form-control" />
														</td>
														<td><input type="number" id="qte0" name='qte0'
															class="form-control" />
														</td>
														<td><input type="number" id="tot0" name='tot0'
															class="form-control tot" />
														</td>
													</tr>
													<tr id='addr1'></tr>
												</tbody>
											</table>
										</div>
									</div>
									<button id="SAVE" class="btn btn-small btn-info pull-right">
										<i class="fa fa-plus-square "></i> Valider
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!--/.span6-->
			</div>
		</div>
		<!-- /.row -->

		<script type="text/javascript">
            jQuery(function ($) {
            var oTableDemoulages= null;
            var nbTotalDemoulagesChecked=0;
            var checkedDemoulages = new Array();
            // Check if an item is in the array
           // var interval = 500;
           loadNumeroDemoulage = function () {
                    $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {ACTION: "<?php echo App::ACTION_GET_LAST_NUMBER; ?>"}, function (data) {
                    sData=$.parseJSON(data);
                        if(sData.rc==-1){
                            $.gritter.add({
                                    title: 'Notification',
                                    text: sData.error,
                                    class_name: 'gritter-error gritter-light'
                                });
                        }else{
                            $("#numero").val(sData.oId);
                        }
                });
                };
                
      var i=1;
     $("#add_row").click(function(){
    $('#addr'+i).html("<td>"+ (i+1) +"<td><input type='number' id='cart"+i+"' name='cart"+i+"' class='form-control'/></td>\n\
    <td><input type='number' id='qte"+i+"' name='qte"+i+"'  class='form-control'/></td>\n\
    <td><input type='number' id='tot"+i+"' name='tot"+i+"'  class='form-control tot'/></td>");
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++;
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });
         function calculPoids(index){
           var cart=parseFloat($("#cart"+index).val());
           var qte=parseFloat($("#qte"+index).val());
           var quantiteDemoulee=parseFloat($("#quantiteDemoulee").val());
           var sqte=0;
           var tot = 0;
           tot = cart * qte;
           if(!isNaN(tot)) {
               $("#tot"+index).val(tot);
               $('#tab_logic .tot').each(function () {
                if($(this).val()!=='')
                  sqte += parseFloat($(this).val());
                });
                if(sqte > quantiteDemoulee){
                    $.gritter.add({
                        title: 'Notification',
                        text: 'La quantité totale définie ne doit pas �tre supérieure a la quantite démoulée',
                        class_name: 'gritter-error gritter-light'
                    }); 
                    $("#qte"+index).val(""); 
                    $("#tot"+index).val(""); 
               }
               
               
               }
            else {
                $("#tot"+index).val("");
            }
       }
         $(document).delegate('#tab_logic tr td', 'click', function (event) {
       // var id = $(this).closest('tr').attr('id');
       // var counter = id.slice(-1);
        
       var id = $(this).closest('tr').attr('id');
       var counter = id.substring(4);
       
      $( "#qte"+counter ).keyup(function() {
            calculPoids(counter);
         });
         
       $( "#cart"+counter ).keyup(function() {
            calculPoids(counter);
         });
        
    });
    
           
        
         $( "#quantiteDemoulee" ).keyup(function() {
            verifiePoidsReel();
         });
         function verifiePoidsReel(){
           var stockProvisoire = parseFloat($("#stockProvisoire").val());
           var quantiteDemoulee=parseFloat($("#quantiteDemoulee").val());
         
            if(quantiteDemoulee > stockProvisoire) {
                $.gritter.add({
                    title: 'Notification',
                    text: 'La quantité démoulée ne doit pas être supérieure au stock provisoire ',
                    class_name: 'gritter-error gritter-light'
                }); 
               $("#quantiteDemoulee").val(""); 
           }
               
           
       };
       
       function verifierPoidsTotal(){
           var sqte=0;
           var quantiteDemoulee=parseFloat($("#quantiteDemoulee").val());
           $('#tab_logic .tot').each(function () {
                if($(this).val()!=='')
                  sqte += parseFloat($(this).val());
                });
           if(sqte > quantiteDemoulee){
               $.gritter.add({
                    title: 'Notification',
                    text: 'La quantité totale du colisage ne doit pas être supérieure à la quantité démoulée',
                    class_name: 'gritter-error gritter-light'
                });
               return false;
           }
           else if(sqte < quantiteDemoulee){$.gritter.add({
                title: 'Notification',
                text: 'La quantité totale du colisage ne doit pas être inférieure à la quantité démoulée ',
                class_name: 'gritter-error gritter-light'
            });
               return false;
           }
           else
               return true;
               
           
       }
            checkedDemoulagesContains = function(item) {
                for (var i = 0; i < checkedDemoulages.length; i++) {
                    if (checkedDemoulages[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_DEMOULAGES").each(function() {
                    if (checkedDemoulagesContains($(this).val())) {
                        $(this).attr('checked', 'checked');
                    } else {
                        $(this).removeAttr('checked');
                    }
                });
            };
             $('table th input:checkbox').on('click', function() {
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox').each(function() {
                    this.checked = that.checked;
                    if (this.checked)
                    {
                        checkedDemoulagesAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalDemoulagesChecked=checkedDemoulages.length;
                    }
                    else
                    {
                        checkedDemoulagesRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_DEMOULAGES tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedDemoulagesAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedDemoulagesRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedDemoulages.length==nbTotalDemoulagesChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
         
            $('#SAVE').attr("disabled", true);
            MessageSelected = function(click)
            {
                if (checkedDemoulages.length == 1){
                    $('#SAVE').attr("disabled", false);
                    loadDemoulagesSelected(checkedDemoulages[0]);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                } else  if (checkedDemoulages.length > 1){
                {
                    bootbox.alert("Veuillez selectionnez un seul produit SVP!");
                    loadDemoulages();
                    $('#SAVE').attr("disabled", true);
                    $('#numero').val("");
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("");
                    $('#quantiteDemoulee').val("");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                } 
                }
                if(checkedDemoulages.length==nbTotalDemoulagesChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedDemoulages.length === 1){
                   $('#SAVE').attr("disabled", false);
                    loadDemoulagesSelected(checkedDemoulages[0]);
		    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }
                else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#numero').val("");
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("");
                    $('#quantiteDemoulee').val("");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                   // $('#SAVE').attr("disabled", false);
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    $("#BTN_MSG_GROUP").popover('destroy');
                    $("#BTN_MSG_CONTENT").popover('destroy');
                }
                $('table th input:checkbox').removeAttr('checked');
            };

            // Add checked item to the array
            checkedDemoulagesAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedDemoulages.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedDemoulagesRemove = function(item) {
                var i = 0;
                while (i < checkedDemoulages.length) {
                    if (checkedDemoulages[i] == item) {
                        checkedDemoulages.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedDemoulages.length; i++) {
                    if (checkedDemoulages[i] == item)
                        return true;
                }
                return false;
            };
             loadDemoulages = function() {
                nbTotalDemoulagesChecked = 0;
                checkedDemoulages = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/produit/ProduitController.php';

                if (oTableDemoulages != null)
                    oTableDemoulages.fnDestroy();

                oTableDemoulages = $('#LIST_DEMOULAGES').dataTable({
                    "oLanguage": {
                    "sUrl": "<?php echo App::getHome(); ?>/datatable_fr.txt",
                    "oPaginate": {
                        "sNext": "",
                        "sLast": "",
                        "sFirst": null,
                        "sPrevious": null
                      }
                    },
                    "aoColumnDefs": [
                        {
                            "aTargets": [0],
                            "bSortable": false,
                            "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                            },
                            "mRender": function(data, type, full) {
                                return '<label><input type="checkbox" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';
                            }
                        }
                    ],
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        persistChecked();
                        $(nRow).css('cursor','pointer');
                        $(nRow).on('click', 'td:not(:first-child)', function(){
                            checkbox=$(this).parent().find('input:checkbox:first');
                            if(!checkbox.is(':checked')){
                                checkbox.prop('checked', true);;
                                checkedDemoulagesAdd(aData[0]);
                                MessageSelected();
                                
                            }else{
                                checkbox.removeAttr('checked');
                                
                                checkedDemoulagesRemove(aData[0]);
                                MessageUnSelected();
                            }
                        });
                    },
                    "fnDrawCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                       
                    },
                    "preDrawCallback": function( settings ) {
                       
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    //afficher nombre �l�ment
                    "bInfo": true,
                    "sAjaxSource": url,
                  //afficher nombre �l�ment
                    "sPaginationType": "full_numbers",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_DEMOULAGES; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        aoData.push({"name": "usineCode", "value": "<?php echo $codeUsine;?>"});
                        $.ajax( {
                          "dataType" : 'json',
                          "type" : "POST",
                          "url" : sSource,
                          "data" : aoData,
                          "success" : function(json) {
                              if(json.rc==-1){
                                 $.gritter.add({
                                    title: 'Notification',
                                    text: json.error,
                                    class_name: 'gritter-error gritter-light'
                                }); 
                              }else{
                                  $('table th input:checkbox').removeAttr('checked');
                                  fnCallback(json);
                                  nbTotalDemoulagesChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadDemoulages();
            loadDemoulagesSelected = function(produitId)
            {
                loadNumeroDemoulage();
                 var url;
                 url = '<?php echo App::getBoPath(); ?>/produit/ProduitController.php';

                $.post(url, {produitId: produitId, codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function(data) {
                  data = $.parseJSON(data);
                 // data = data[0];
                    $('#nomProduit').text(data.libelle);
                    $('#stockProvisoire').val(data.stockProvisoire);
                    //$('#quantiteDemoulee').val(data.quantiteDemoulee);
                    
               }).error(function(error) { });
            };

            $("#MNU_VALIDATION").click(function()
            {
                if (checkedDemoulages.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedDemoulages.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment valider cet achat", function(result) {
                    if(result){
                    var produitId = checkedDemoulages[0];
                    $.post("<?php echo App::getBoPath(); ?>/achat/DemoulagesController.php", {produitId: produitId, ACTION: "<?php echo App::ACTION_ACTIVER; ?>"}, function(data)
                    {
                        if (data.rc == 0)
                        {
                            bootbox.alert("Demoulages(s) validé(s)");
                            loadDemoulages();
                           
                        }
                        else
                        {
                            bootbox.alert(data.error);
                        }
                    }, "json");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {
//                        });
                         }
                    });
                }
            });

            $("#MNU_IMPRIMER").click(function()
                    {
                        if (checkedDemoulages.length == 0)
                            bootbox.alert("Veuillez selectionnez un achat");
                        else if (checkedDemoulages.length >= 1)
                        {
                        	window.open('<?php echo App::getHome(); ?>/app/pdf/achatPdf.php?produitId='+checkedDemoulages[0],'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');
                            
                        }
                    });
            
            $("#MNU_ANNULATION").click(function()
            {
                if (checkedDemoulages.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedDemoulages.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment annuler cet achat", function(result) {
                    if(result){
                    var produitId = checkedDemoulages[0];
                    $.post("<?php echo App::getBoPath(); ?>/achat/DemoulagesController.php", {produitId: produitId, ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function(data)
                    {
                        if (data.rc === 0)
                        {
                            bootbox.alert("Demoulages(s) annulés(s)");
                            
                        }
                        else
                        {
                            bootbox.alert(data.error);
                        }
                    }, "json");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {
                        });
                         }
                    });
                }
            });
            
        DemoulageProcess = function ()
        {
            
           $('#SAVE').attr("disabled", true);
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var numero= $('#numero').val();
            var quantiteDemoulee= $('#quantiteDemoulee').val();
            var stockProvisoire= $('#stockProvisoire').val();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            var $table = $("table");
            rows = [],
            header = [];

        //$table.find("thead th").each(function () {
        //    header.push($(this).html().trim());
        //});
        header = ["#","nbCarton","qte","total"];
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
            formData.append('produitId', checkedDemoulages[0]);
            formData.append('numero', numero);
            formData.append('stockProvisoire', stockProvisoire);
            formData.append('quantiteDemoulee', quantiteDemoulee);
            formData.append('jsonCarton', tbl);
            formData.append('codeUsine', codeUsine);
            formData.append('login', login);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php',
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
                        loadDemoulages();
                        // $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/demoulage/produitListe.php", function () {
//                         });
                        $('#numero').val("");
                        $('#stockProvisoire').val("");
                        $('#quantiteDemoulee').val("");
                        $("#tab_logic").find("tr:gt(0)").remove();
                        i=1;
                        $('#qte0').val("");
                        $('#tot0').val("");
                        $('#cart0').val("");
//                        j=$("#tab_logic").length;
//                        
//                        $("#addr"+(i-1)).html('');
//                        i--;
		   
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
                    $('#SAVE').attr("disabled", false);
                }
            });

        };
        $("#SAVE").bind("click", function () {
        $('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				quantiteDemoulee: {
                                    required: true
				},
				nombreParCarton: {
                                    required: true
				},
				nombreCarton: {
                                    required: true
				}
				
			},
	
			messages: {
				quantiteDemoulee: {
					required: "Champ obligatoire."
				},
				nombreParCarton: {
					required: "Champ obligatoire."
				},
				nombreCarton: {
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
                            if(verifierPoidsTotal())
                                DemoulageProcess();
			},
			invalidHandler: function (form) {
			}
		});


        });
            });
        </script>