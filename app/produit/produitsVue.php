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
            Gestion des produits
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Produit
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                   
                    <div class="col-lg-1">
                         <button id="MNU_PRODUIT_NEW" data-toggle="dropdown"
                                    class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
                                    data-rel="tooltip" data-placement="top" title="Produit" style="
                                    height: 32px;
                                    width: 80px;
                                    margin-top: -1px;
                                    margin-left: 5px;">Nouveau
                            </button>
                    </div>
                </div>
            </div>
<!--            <h4 class="pink">
                <i class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
                <a href="#modal-table" role="button" class="green" data-toggle="modal"> Liste des produits </a>
            </h4>-->
            <div class="row">
                  <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_PRODUITS" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;width:10%">
                                   Id
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Désignation
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Stock provisoire
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Stock réel
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                </th>

                                <!--<th class="hidden-phone" style="border-left: 0px none;border-right: 0px none;">
                                </th>-->
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div>
            <div id="winModalProduit" class="modal fade" tabindex="-1">
            <form id="validation-form" class="form-horizontal" role="form">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Produit</h3>
                        </div>

                        <div class="modal-body" style="height: 200px;">
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
                                        <input type="text" id="stockProvisoire" readonly name="stockProvisoire" placeholder="" class="col-xs-10 col-sm-7" value="0.00">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock reel</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="stockReel" readonly name="stockReel" placeholder="" class="col-xs-10 col-sm-7" value="0.00">
                                    </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="SAVE" class="btn btn-small btn-info" >
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
        </div><!-- /.col -->
    </div><!-- /.row -->
 
</div><!-- /.page-content -->

<script type="text/javascript">
    $(document).ready(function() {
         var oTableProduits = null;
            var nbTotalProduitsChecked=0;
            var checkedProduits = new Array();
//             $("#stockReel").prop("readonly", true);
            var produit=0;
            
            checkedProduitsContains = function(item) {
                for (var i = 0; i < checkedProduits.length; i++) {
                    if (checkedProduits[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_UTILISATEURS").each(function() {
                    if (checkedProduitsContains($(this).val())) {
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
                        checkedProduitsAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalProduitsChecked=checkedProduits.length;
                    }
                    else
                    {
                        checkedProduitsRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_PRODUITS tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedProduitsAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedProduitsRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedProduits.length==nbTotalProduitsChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
         
           // $('#SAVE').attr("disabled", true);
            MessageSelected = function(click)
            {
                if (checkedProduits.length == 1){
                    $('#SAVE').attr("disabled", false);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("0.00");
                    $('#stockReel').val("0.00");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedProduits.length==nbTotalProduitsChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedProduits.length === 1){
                   $('#SAVE').attr("disabled", false);
		    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }
                else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("0.00");
                    $('#stockReel').val("0.00");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    $('#SAVE').attr("disabled", false);
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    $("#BTN_MSG_GROUP").popover('destroy');
                    $("#BTN_MSG_CONTENT").popover('destroy');
                }
                $('table th input:checkbox').removeAttr('checked');
            };

            // Add checked item to the array
            checkedProduitsAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedProduits.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedProduitsRemove = function(item) {
                var i = 0;
                while (i < checkedProduits.length) {
                    if (checkedProduits[i] == item) {
                        checkedProduits.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedProduits.length; i++) {
                    if (checkedProduits[i] == item)
                        return true;
                }
                return false;
            };
            showPopover = function(idButton, colis){
            $("#" + idButton).popover({
                html: true,
                trigger: 'focus',
                placement: 'left',
                title: '<i class="icon-group icon-"></i> Détail colis ',
                content: colis
            }).popover('toggle');
         };
         
         removeProduit=function(produitIds){
                    bootbox.confirm("Voulez vous vraiment supprimer ce produit", function(result) {
                        if (result) {
                             var produitIdsChecked = produitIds;
                            $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {codeUsine:"<?php echo $codeUsine;?>", produitIds: produitIdsChecked + "", ACTION: "<?php echo App::ACTION_REMOVE; ?>"}, function(data) {
                                if (data.rc == 0){
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: "Produit supprimé",
                                        class_name: 'gritter-success gritter-light'
                                    });
                                    $('table th input:checkbox').removeAttr('checked');
                                     checkedProduits=new Array();
                                    loadProduits();
                                }
                                else{
                                    $.gritter.add({
                                        title: 'Notification',
                                        text: data.error,
                                        class_name: 'gritter-warning gritter-light'
                                    });
                                    
                               // $("#NOTIF_ALERT").append("<div class='alert alert-danger'> <button class='close' data-dismiss='alert'> <i class='icon-remove'></i></button><i class='icon-hand-right'></i> <?php// printf($pNotifSupUserAlert); ?> </div>");
                                }
                            }, "json");
                        }
                    });
                }
                
             loadProduits = function() {
                nbTotalProduitsChecked = 0;
                checkedProduits = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/produit/ProduitController.php';

                if (oTableProduits != null)
                    oTableProduits.fnDestroy();

                oTableProduits = $('#LIST_PRODUITS').dataTable({
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
                                return '<label><input type="checkbox" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';                             }
                        },
                            
                            {
                                "aTargets": [5],
                                "bSortable": false,
                                "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                    
                                    $(nTd).css('text-align', 'center');
                                    $(nTd).text('');
                                    $(nTd).addClass('td-actions');
                                    action=$('<div></div>');
                                    action.addClass('pull-right hidden-phone visible-desktop action-buttons');
                                    btnEdit=$('<a class="green" href="#"> '+
                                    '<i class="fa fa-pencil bigger-130"></i>'+
                                    '</a>');
                                    btnEdit.click(function(){
                                         $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {produitId: oData[0], codeUsine:"<?php echo $codeUsine;?>", ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function (data) {
                                        data = $.parseJSON(data);
                                        console.log(data);
                                        produit=oData[0];
                                        $('#designation').val(data.libelle);
                                        $('#libelleFacture').val(data.libelleFacture);
                                        $('#stockProvisoire').val(data.stockProvisoire);
                                        $('#stockReel').val(data.stockReel);
                                    });
                                       
                                        $('#winModalProduit').modal('show');
                                    });
                                    btnEdit.tooltip({
                                        title: 'Modifier'
                                    });
                                    //if (full[5] !== "Admin"){
                                    btnRemove=$('<a class="red" href="#">'+
                                                '<i class="fa fa-trash bigger-130"></i>'+
                                                '</a>');
                                    //}
                                    btnRemove.click(function(){
                                        removeProduit(oData[0]);
                                    });
                                    btnRemove.tooltip({
                                        title: 'Supprimer'
                                    });
                                    btnEdit.css({'margin-right': '10px', 'cursor':'pointer'});
                                    btnRemove.css({'cursor':'pointer'});
                                    action.append(btnEdit);
                                   // if(oData[4] !=="Admin"){
                                    action.append(btnRemove);
                                  //  }
                                    $(nTd).append(action);
                                }
                            }
                    ],
                    
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
//                        persistChecked();
//                        $(nRow).css('cursor','pointer');
//                        $(nRow).on('click', 'td:not(:first-child)', function(){
//                            checkbox=$(this).parent().find('input:checkbox:first');
//                            if(!checkbox.is(':checked')){
//                                checkbox.prop('checked', true);;
//                                checkedProduitsAdd(aData[0]);
//                                MessageSelected();
//                                
//                            }else{
//                                checkbox.removeAttr('checked');
//                                
//                                checkedProduitsRemove(aData[0]);
//                                MessageUnSelected();
//                            }
//                        });
                    },
                    "fnDrawCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                       
                    },
                    "preDrawCallback": function( settings ) {
                       
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bInfo": true,
                    "sAjaxSource": url,
                    "sPaginationType": "full_numbers",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        aoData.push({"name": "codeUsine", "value": "<?php echo $codeUsine;?>"});
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
                                  nbTotalProduitsChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadProduits();
        $("#MNU_PRODUIT_NEW").click(function()
        {
            $('#winModalProduit').modal('show');
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
         produitProcess = function (produit)
        {
            
            var ACTION 
            if(produit==0)       
               ACTION = '<?php echo App::ACTION_INSERT; ?>';
           else
              ACTION = '<?php echo App::ACTION_UPDATE; ?>';
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
            formData.append('produitId', produit);
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
                       loadProduits();
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
       $("#SAVE").bind("click", function () {
       $.validator.addMethod(
                "regexStockProvisoire",
                function(value, element, regexp) {
                    return this.optional(element) || regexp.test(value);
                },
                "Caracteres non autorises"
            );
    
            context=$(this);
       $('#validation-form').validate({
           
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
				designation: {
					required: true
				},
				stockProvisoire: {
					required: true,
                                        //regexStockProvisoire: /^[a-zA-Z0-9\u00E0-\u00FC ]+(&|\w)*$/ // /^[a-zA-Z\u00E0-\u00FC ]+$/ //regexGroupName: /^[a-zA-Z0-9\u00E0-\u00FC ]+(&|\w)*$/

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
				 produitProcess(produit);
				/// $('#winModalProduit').addClass('hide');
                            $('#winModalProduit').modal('hide');
                            $('#designation').val("");
                            $('#libelleFacture').val("");
                            $('#stockProvisoire').val("0.00");
                            $('#stockReel').val("0.00");
			},
			invalidHandler: function (form) {
			}
		});


       });

       
       
       
    });
</script>
