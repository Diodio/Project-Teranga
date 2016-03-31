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
            Démoulage
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste démoulages
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
         
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                         <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-users orange"></i>
                            Liste démoulages
                        </h4>
                        <select id="CMB_TYPE" name="CMB_TYPE" data-placeholder="" class="" style="width: 200px;margin-right: 10px;">
                        <option value="*" class="types">Filtrer par type </option>
                         <option value="0" class="red bigger-120 icon-only">Démoulages annulés</option>
                         <option value="1" class="green bigger-120 icon-only">Démoulages validés</option>
                </select>
                                       <div class="btn-group">
                                            <button id="MNU_ANNULATION"
                                                    class="btn btn-primary btn-mini tooltip-info disabled"
                                                    data-rel="tooltip" data-placement="top"
                                                    title="Annuler Demoulage">
                                                <i class="icon-cloud-download icon-only"></i> Annuler
                                            </button>
                                        </div>
<!--                                         <div class="btn-group"> -->
<!--                                             <button id="MNU_REMOVE" -->
<!--                                                     class="btn btn-primary btn-mini tooltip-info disabled" -->
<!--                                                     data-rel="tooltip" data-placement="top" -->
<!--                                                     title="Supprimer D�moulage"> -->
<!--                                                 <i class="icon-cloud-download icon-only"></i> Supprimer -->
<!--                                             </button> -->
<!--                                         </div> -->
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
			</div>
                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_DEMOULAGES" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                 <label> 
                                         <input type="checkbox" value="*" name="allchecked"/> 
                                         <span class="lbl"></span> 
                                     </label> 
                                </th>
                                 <th style="border-left: 0px none;border-right: 0px none;">
                                    
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Date
                                </th>
                                 <th style="border-left: 0px none;border-right: 0px none;">
                                    Numero
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Produit
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Quantite avant démoulage
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Quantite démoulée
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Nombre de colis
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Colisage
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
            var oTableDemoulages= null;
            var nbTotalDemoulagesChecked=0;
            var checkedDemoulages = new Array();
            $('#CMB_TYPE').select2();
            // Check if an item is in the array
           // var interval = 500;
           
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
                enableRelevantDemoulageMenu();
                if (checkedDemoulages.length == 1){
                    $('#SAVE').attr("disabled", false);
                    //loadDemoulagesSelected(checkedDemoulages[0]);
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
                if(checkedDemoulages.length==nbTotalDemoulagesChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
                enableRelevantDemoulageMenu();
               if (checkedDemoulages.length === 1){
                   //$('#SAVE').attr("disabled", false);
                   // loadDemoulagesSelected(checkedDemoulages[0]);
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
            showPopover = function(idButton, colis){
            $("#" + idButton).popover({
                html: true,
                trigger: 'focus',
                placement: 'left',
                title: '<i class="icon-group icon-"></i> Détail colis ',
                content: colis
            }).popover('toggle');
         };
             loadDemoulages = function(etat) {
                nbTotalDemoulagesChecked = 0;
                checkedDemoulages = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php';

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
                        },
                        {
                            "aTargets": [1],
                            "bSortable": false,
                            "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                            },
                            "mRender": function(data, type, full) {
                               var src = '<input type="hidden" id="stag' + full[0] + '" value="' + data + '">';
                                if (data == 0)
                                    src += '<span class=" tooltip-error" title="Annulé"><i class="ace-icon fa fa-trash-o red bigger-130 icon-only"></i></span>';
                                else if (data == 1)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Validé"><i class="ace-icon fa fa-check-square-o green bigger-130 icon-only"></i></span>';
                              
                                return src;
                            }
                        },
                        {
                        "aTargets": [8],
                        "bSortable": false,
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).css('text-align', 'center');
                            $(nTd).text('');
                            $(nTd).addClass('td-actions');
                            action=$('<div></div>');
                            action.addClass('hidden-phone pull-right visible-desktop action-buttons');
                            
                            btnGrps=$('<button id="colis'+oData[0]+'" class="center btn btn-warning btn-mini" href="#">'+
                            '<i class="ace-icon fa fa-pencil bigger-130"></i>'+
                            '</button>');
                            btnGrps.click(function(){
                                $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {demoulageId: oData[0], codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_GET_COLIS_DEMOULAGE; ?>"}, function(data) {
                                data=$.parseJSON(data);
                                var htmlString="<div class='popover-medium' style='width: 550px;'> Liste des colis disponibles<hr>";
                                $.each(data , function(i) { 
                                    str= data [i].toString();
                                    var substr = str.split(',');
                                    htmlString+="<span><b>"+substr [0]+" colis de "+substr [1]+" kg<b></span><br /><hr>";
                                // htmlString+="<span><b> Quantité</b>: "+substr [1]+"</span><br /><hr>";
                                 
                                    //console.log(data [i]); 
                                  });
                                  htmlString+="</div>";
                                showPopover("colis"+oData[0], ""+htmlString+"");
                                });
                            });
                            btnGrps.tooltip({
                                title: 'Consulter Détail des colis'
                            });
                            btnGrps.css({'margin-right': '10px', 'cursor':'pointer'});
                            action.append(btnGrps);
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
                    "bLengthChange": true,
                    "bFilter": true,
                    //afficher nombre �l�ment
                    "bInfo": true,
                    "sAjaxSource": url,
                  //afficher nombre �l�ment
                    "sPaginationType": "full_numbers",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST_DEMOULE; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        aoData.push({"name": "usineCode", "value": "<?php echo $codeUsine;?>"});
                        aoData.push({"name": "etat", "value": etat});
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
            
            loadDemoulages('*');
            
            $('#CMB_TYPE').change(function() {
                if($('#CMB_TYPE').val()!=='*') {
                    loadDemoulages($('#CMB_TYPE').val());
                }
                else {
                    loadDemoulages('*');
                }
            });
            
             enableRelevantDemoulageMenu = function()
	{   
            if (checkedDemoulages.length == 1)
            {
                $('#MNU_ANNULATION').removeClass('disabled');
                $('#MNU_REMOVE').removeClass('disabled');
                var state = $('#stag' + checkedDemoulages[0]).val();
                 if (state == 1) {
                         $('#MNU_REMOVE').addClass('disabled');
                         $('#MNU_ANNULATION').removeClass('disabled');
                 }
                  else if (state == 0) {
                      //if($.cookie('profil')=='directeur') {
                        $('#MNU_REMOVE').removeClass('disabled');
                        $('#MNU_ANNULATION').addClass('disabled');
                   // }
                      
                  }
                          
            }
            else if (checkedDemoulages.length > 1){
               $('#MNU_REMOVE').addClass('disabled');
                $('#MNU_ANNULATION').addClass('disabled');
                bootbox.alert("Veuillez selectionnez un seul démoulage SVP!");
                loadDemoulages('*');
            }
            else{
                $('#MNU_REMOVE').addClass('disabled');
                $('#MNU_ANNULATION').addClass('disabled');

            }
            };
            loadDemoulagesSelected = function(produitId)
            {
               //enableRelevantDemoulageMenu();
            };

           

            
            $("#MNU_ANNULATION").click(function()
            {
                if (checkedDemoulages.length == 0)
                    bootbox.alert("Veuillez selectionnez un d�moulage");
                else if (checkedDemoulages.length == 1)
                {
                     bootbox.confirm("Voulez vous vraiment annuler ce demoulage", function(result) {
                    if(result){
                    var demoulageId = checkedDemoulages[0];
                   
                    $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {demoulageId: demoulageId, ACTION: "<?php echo App::ACTION_DESACTIVER; ?>"}, function(data)
                    {
                        if (data.rc === 0)
                        {
                            bootbox.alert("Demoulage annulé");
                            loadDemoulages($('#CMB_TYPE').val());
                        }
                        else
                        {
                            bootbox.alert(data.error);
                        }
                    }, "json");
                    }
                    });
                }
                else if (checkedDemoulages.length > 1)
                {
                	bootbox.alert("Veuillez choisir un seul d�moulage SVP!");
                }
            });
            
            $("#MNU_REMOVE").click(function()
            {
                if (checkedDemoulages.length == 0)
                    bootbox.alert("Veuillez selectionnez un demoulage");
                else if (checkedDemoulages.length >= 1)
                {
                     bootbox.confirm("Voulez vous vraiment supprimer ce demoulage", function(result) {
                    if(result){
                    var demoulageId = checkedDemoulages[0];
                    $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {demoulageId: demoulageId, ACTION: "<?php echo App::ACTION_REMOVE; ?>"}, function(data)
                    {
                        if (data.rc === 0)
                        {
                            bootbox.alert("Demoulage supprimé");
                             loadDemoulages($('#CMB_TYPE').val());
                        }
                        else
                        {
                            bootbox.alert(data.error);
                        }
                    }, "json");
                   
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
            formData.append('produitId', checkedDemoulages[0]);
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
                        loadDemoulages();
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