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
            Inventaires Achats
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Achats
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
         
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Période
                        </h4>
                       
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
					<div class="col-sm-4" style="float: right;margin-top: -38px;">
					<select id="CMB_TYPE" name="CMB_TYPE" data-placeholder="" class="col-xs-10 col-sm-7">
<!-- 					     <option value="*" class="types">Filtré par achats</option> -->
                         <option value="0" class="green bigger-130 icon-only">Achats réglés</option>
                         <option value="1" class="orange bigger-130 icon-only">Achats non réglés</option>
               		 </select>
					</div>
					<div style="margin-top: -38px;margin-left: 9%;">
					    <span id="labelFrom">Du</span>
					    <input
					        class="date-picker" id="dateDebutAchat"
					        name="dateDebutAchat" type="text"
					        data-date-format="dd-mm-yyyy" />
					    <span id="labelTo" style="margin-left: -1px;">au</span>
					    <input
					        class="date-picker" id="dateFinAchat"
					        name="dateFinAchat" type="text"
					        data-date-format="dd-mm-yyyy" />
					    <button data-toggle="dropdown" id="BTN_SEARCH" style="align-content: center;margin-top: -3px;"
					            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
					            data-rel="tooltip" data-placement="top" title="consulter">
					        <i class="fa fa-search bigger-120 white" style="margin-left: 1px;"></i> 
					    </button>
					    
					    <button data-toggle="dropdown" id="BTN_IMPRIMER" style="align-content: center;margin-top: -3px;"
					            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
					            data-rel="tooltip" data-placement="top" title="Imprimer">
					        <i class="fa fa-print bigger-120 white" style="margin-left: 1px;"></i> 
					    </button>
					</div>
                    <div class="widget-body">
                        <div class="widget-main no-padding" style="margin-top:20px">
                          <table id="LIST_ACHATS_INVENTAIRES" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                Id
<!--                                     <label> -->
<!--                                         <input type="checkbox" value="*" name="allchecked"/> -->
<!--                                         <span class="lbl"></span> -->
<!--                                     </label> -->
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Numéro
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Date
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Maréyeur
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Quantité
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Montant
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
            </div><!-- /.col -->
        
        
       <script type="text/javascript">
            jQuery(function ($) {
            var oTableAchats= null;
            var nbTotalAchatsChecked=0;
            var checkedAchats = new Array();
            // Check if an item is in the array
           // var interval = 500;
            $('#dateDebutAchat').datepicker({autoclose: true,language:'fr',todayHighlight:true}).on(ace.click_event, function(){
             });
    $('#dateFinAchat').datepicker({autoclose: true,language:'fr', todayHighlight:true}).prev().on(ace.click_event, function(){
//            $(this).prev().focus();
    });
    
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
           var stockReel=parseFloat($("#stockReel").val());
           var sqte=0;
           var tot = 0;
           tot = cart*qte;
           if(!isNaN(tot)) {
               $("#tot"+index).val(tot);
               $('#tab_logic .tot').each(function () {
                if($(this).val()!=='')
                  sqte += parseFloat($(this).val());
                });
                if(sqte > stockReel){
                    $.gritter.add({
                        title: 'Notification',
                        text: 'La quantité totale définie est supérieure au stock réel',
                        class_name: 'gritter-error gritter-light'
                    }); 
                    $("#qte"+index).val(""); 
                   $("#tot"+index).val("0"); 
               }
            }
            else {
                $("#tot"+index).val("0");
            }
       }
         $(document).delegate('#tab_logic tr td', 'click', function (event) {
        var id = $(this).closest('tr').attr('id');
        var counter = id.slice(-1);
       
      $( "#qte"+counter ).keyup(function() {
            calculPoids(counter);
         });
        
    });
    
           
        $( "#stockReel" ).keyup(function() {
            verifiePoidsReel();
         });
         
         function verifiePoidsReel(index){
           var stockProvisoire = parseFloat($("#stockProvisoire").val());
           var stockReel=parseFloat($("#stockReel").val());
         
           if(stockReel>=stockProvisoire) {
                    $.gritter.add({
                        title: 'Notification',
                        text: 'Le stock réel défini doit etre inférieur au stock provisoire',
                        class_name: 'gritter-error gritter-light'
                    }); 
                   $("#stockReel").val("0"); 
               }
       }
            checkedAchatsContains = function(item) {
                for (var i = 0; i < checkedAchats.length; i++) {
                    if (checkedAchats[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_ACHATS_INVENTAIRES").each(function() {
                    if (checkedAchatsContains($(this).val())) {
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
                        checkedAchatsAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalAchatsChecked=checkedAchats.length;
                    }
                    else
                    {
                        checkedAchatsRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_ACHATS_INVENTAIRES tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedAchatsAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedAchatsRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedAchats.length==nbTotalAchatsChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
         
            $('#SAVE').attr("disabled", true);
            MessageSelected = function(click)
            {
                if (checkedAchats.length == 1){
                    $('#SAVE').attr("disabled", false);
                    loadAchatsSelected(checkedAchats[0]);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("");
                    $('#stockReel').val("");
                    $('#nombreCarton').val("");
                    $('#nombreParCarton').val("");
                    
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedAchats.length==nbTotalAchatsChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedAchats.length === 1){
                   $('#SAVE').attr("disabled", false);
                    loadAchatsSelected(checkedAchats[0]);
		    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }
                else
                {
                    $('#SAVE').attr("disabled", true);
                    $('#nomProduit').text("");
                    $('#stockProvisoire').val("");
                    $('#stockReel').val("");
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
            checkedAchatsAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedAchats.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedAchatsRemove = function(item) {
                var i = 0;
                while (i < checkedAchats.length) {
                    if (checkedAchats[i] == item) {
                        checkedAchats.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedAchats.length; i++) {
                    if (checkedAchats[i] == item)
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
             loadAchats = function(dateDebut, dateFin, regle) {
                nbTotalAchatsChecked = 0;
                checkedAchats = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/produit/AchatController.php';

                if (oTableAchats != null)
                    oTableAchats.fnDestroy();

                oTableAchats = $('#LIST_ACHATS_INVENTAIRES').dataTable({
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
//                             "aTargets": [0],
//                             "bSortable": false,
//                             "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
//                                 $(nTd).css('text-align', 'center');
//                             },
//                             "mRender": function(data, type, full) {
//                                 return '<label><input type="checkbox" id="' + data + '" value="' + data + '"><span class="lbl"></span></label>';
//                             }
                        },
                        {
                        "aTargets": [4],
                        "bSortable": false,
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).css('text-align', 'center');
                            $(nTd).text('');
                            $(nTd).addClass('td-actions');
                            action=$('<div></div>');
                            action.addClass('hidden-phone pull-right visible-desktop action-buttons');
                            
                            btnGrps.tooltip({
                                title: 'Consulter Détail des colis'
                            });
                            $(nTd).append(action);
                           
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
                                checkedAchatsAdd(aData[0]);
                                MessageSelected();
                                
                            }else{
                                checkbox.removeAttr('checked');
                                
                                checkedAchatsRemove(aData[0]);
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
                    "bInfo": false,
                    "sAjaxSource": url,
                    "sPaginationType": "simple",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_INVENTAIRE_ACHATS; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        userProfil=$.cookie('profil');
                        if(userProfil==='admin'){
                            aoData.push({"name": "codeUsine", "value": "*"});
                        }
                        else
                        aoData.push({"name": "codeUsine", "value": "<?php echo $codeUsine;?>"});
                        aoData.push({"name": "dateDebut", "value": dateDebut});
                        aoData.push({"name": "dateFin", "value": dateFin});
                        aoData.push({"name": "regle", "value": regle});
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
                                  nbTotalAchatsChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadAchats();
            loadAchatsSelected = function(produitId)
            {
                 var url;
                 url = '<?php echo App::getBoPath(); ?>/produit/ProduitController.php';

                $.post(url, {produitId: produitId, ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function(data) {
                  data = $.parseJSON(data);
                 // data = data[0];
                    $('#nomProduit').text(data.designation);
                    $('#stockProvisoire').val(data.stockProvisoire);
                    //$('#stockReel').val(data.stockReel);
                    
               }).error(function(error) { });
            };

            $("#MNU_VALIDATION").click(function()
            {
                if (checkedAchats.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedAchats.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment valider cet achat", function(result) {
                    if(result){
                    var produitId = checkedAchats[0];
                    $.post("<?php echo App::getBoPath(); ?>/achat/AchatsController.php", {produitId: produitId, ACTION: "<?php echo App::ACTION_ACTIVER; ?>"}, function(data)
                    {
                        if (data.rc == 0)
                        {
                            bootbox.alert("Achats(s) validé(s)");
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


            
            $("#MNU_ANNULATION").click(function()
            {
                if (checkedAchats.length == 0)
                    bootbox.alert("Veuillez selectionnez un achat");
                else if (checkedAchats.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment annuler cet achat", function(result) {
                    if(result){
                    var produitId = checkedAchats[0];
                    $.post("<?php echo App::getBoPath(); ?>/achat/AchatsController.php", {produitId: produitId, ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function(data)
                    {
                        if (data.rc === 0)
                        {
                            bootbox.alert("Achats(s) annulés(s)");
                            
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
            
            var stockReel= $('#stockReel').val();
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
            formData.append('produitId', checkedAchats[0]);
            formData.append('stockReel', stockReel);
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
                        loadAchats();
                        $('#nombreCarton').val("");
                        $('#nombreParCarton').val("");
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
				stockReel: {
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
				stockReel: {
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
				DemoulageProcess();
			},
			invalidHandler: function (form) {
			}
		});
        });

        $("#MNU_IMPRIMER").click(function()
        {
          window.open('<?php echo App::getHome(); ?>/app/pdf/stockPdf.php?codeUsine='+"<?php echo $codeUsine?>",'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');
         });
            });
        </script>