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
$nomUsine = $_COOKIE['nomUsine'];
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Entrées de bon de sortie
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Entrées
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="row">
        <div class="space-6"></div>
        <div class="row">
                          <div class="col-sm-2"> 
       							 <select id="CMBORIGINE" name="CMBORIGINE"  data-placeholder="" style="width: 99%">
                                                        <option value="*" class="usines">Filtrer par usine</option>
                                                </select>
                            </div>
            <div class="col-sm-12">
                    <div class="col-lg-1">
                        <div class="btn-group">
                                    
<!--                                     <ul class="dropdown-menu dropdown-info"> -->

<!--                                         <li id='MNU_IMPRIMER' class="disabled"><a href="#" id="GRP_NEW">Imprimer</a></li> -->
<!--                                         <li class="divider"></li> -->
<!--                                         <li id='MNU_ANNULATION' class="disabled"><a href="#" id="GRP_EDIT">Annuler</a></li> -->
<!--                                          <li class="divider"></li> -->
<!--                                         <li id='MNU_REMOVE' class="disabled"><a href="#" id="GRP_REMOVE">Supprimer</a></li> -->
<!--                                     </ul> -->
                                </div>
                    </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des entrées: sorties venant des autres usines
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_BONS" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th class="center" style="border-left: 0px none;border-right: 0px none;"></th>                               
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Date
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Numero
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Nombre de colis
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Quantité(kg)
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
            <div class="col-sm-7">
                <div class="widget-container-span">
                    <div class="widget-box transparent">
                        <div class="widget-header">

                            <h4 class="lighter"></h4>
                            <div class="widget-toolbar no-border">
                                <ul class="nav nav-tabs" id="TAB_GROUP">

                                    <li id="TAB_INFO_VIEW" class="active">
                                        <a id="TAB_INFO_LINK" data-toggle="tab" href="#TAB_INFO">
                                            <i class="green icon-dashboard bigger-110"></i>
                                            Statistique
                                        </a>
                                    </li>
                                    <li id="TAB_MSG_VIEW">
                                        <a id="TAB_MSG_LINK" data-toggle="tab" href="#TAB_MSG">
                                            <i class="red icon-comments-alt bigger-110"></i>
                                            <span id="TAB_MSG_TITLE">...</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-12 no-padding-left no-padding-right">
                                <div class="tab-content padding-4">
                                    <div id="TAB_INFO" class="tab-pane in active">
                                        <div>

                                            <div class="span12 infobox-container">
                                               
                                                    <div class="infobox infobox-orange infobox-small infobox-dark" style="width:200px">
                                                        <div class="infobox-icon">
                                                            <i class="icon-pause"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            

                                                            <div class="infobox-content" style="width:150px">Entrées <?php echo $nomUsine?> (kg) </div>
                                                            <div class="infobox-content" id="INDIC_BON">0 kg</div>

                                                        </div>
                                                    </div>
                                            
                                                    <div class="space-6"></div>
                                                    <br/>

                                                

                                            </div>
                                        </div>
                                    </div>

                    <div id="TAB_MSG" class="tab-pane">
                        <div class="slim-scroll" data-height="100">
                            <div class="span12">

                              <div class="profile-user-info">
                    <div class="profile-info-row">
                        <div class="profile-info-name">Date </div>
                        <div class="profile-info-value">
                            <span id="Date"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Créé a </div>
                        <div class="profile-info-value">
                            <span id="Origine"></span> par <span id="User"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Numéro camion </div>
                        <div class="profile-info-value">
                            <span id="NumeroCamion"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Chauffeur </div>
                        <div class="profile-info-value">
                            <span id="Chauffeur"></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name">Destination </div>
                        <div class="profile-info-value">
                            <span id="Destination"></span>
                        </div>
                    </div>
                    
                </div>
                <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits
                        </h4>
                    <table class="table table-bordered table-hover"id="TABLE_BONS">
                        <thead>
                            <tr>
                                    <th class="text-center">
                                            Désignation
                                    </th>
                                    <th class="text-center">
                                            Quantite (kg)
                                    </th>
                                    <th class="text-center" style="width: 120px;">
                                            Détail colis
                                    </th>
                            </tr>
                        </thead>
				<tbody>
				
				</tbody>
			</table>
                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name">Total colis </div>
                                <div class="profile-info-value">
                                    <span id="totalColis"></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name">Poids Total </div>
                                <div class="profile-info-value">
                                    <span id="PoidsTotal"></span>
                                </div>
                            </div>
                        </div>
                                            </div>
                                        </div>

                                    </div><!--End TAB_MSG -->



                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--/.span6-->
            </div>
        </div><!-- /.row -->
    </div>
    </div>
    
    <script type="text/javascript">
            jQuery(function ($) {
            	$('#CMBORIGINE').select2();
            var oTableBons= null;
            var nbTotalBonChecked=0;
            var checkedBon = new Array();
            // Check if an item is in the array
           // var interval = 500;
            getIndicator = function(codeUsineDest) {
                var url;
                var user;
                url = '<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php';
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: '&codeUsineDest='+codeUsineDest+'&ACTION=<?php echo App::ACTION_STAT_ENTREE; ?>',
                    cache: false,
                    success: function(data) {
                        
//                        $('#INDIC_BON_STLOUIS').text(data.nbStLouis);
//                        $('#INDIC_BON_RUFISQUE').text(data.nbRufisque);
                        $('#INDIC_BON').text(data.nbEntree+" kg");

//                        
                    }
                });
            };
            getIndicator("<?php echo $codeUsine?>");

            loadUsine = function(codeUsine){
                $.post("<?php echo App::getBoPath(); ?>/usine/UsineController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID; ?>", codeUsine:codeUsine}, function (data) {
                    sData=$.parseJSON(data);
                        if(sData.rc==-1){
                            $.gritter.add({
                                    title: 'Notification',
                                    text: sData.error,
                                    class_name: 'gritter-error gritter-light'
                                });
                        }else{
                             $("#CMBORIGINE").loadJSON('{"usines":' + data + '}');
                        }
                });
                };
                loadUsine("<?php echo $codeUsine;?>");
                
                $('#CMBORIGINE').change(function() {
                    if($('#CMBORIGINE').val()!=='*') {
                    	loadBons($('#CMBORIGINE').val(), "<?php echo $codeUsine;?>");
                    }
                    else {
                    	loadBons('*', "<?php echo $codeUsine;?>");
                    }
                });
                
            checkedBonContains = function(item) {
                for (var i = 0; i < checkedBon.length; i++) {
                    if (checkedBon[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_BONS").each(function() {
                    if (checkedBonContains($(this).val())) {
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
                        checkedBonAdd($(this).val());
                        //MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalBonChecked=checkedBon.length;
                    }
                    else
                    {
                        checkedBonRemove($(this).val());
//                        MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
            $('#LIST_BONS tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedBonAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedBonRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedBon.length==nbTotalBonChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
            MessageSelected = function(click)
            {
            	EnableAction();
                if (checkedBon.length == 1){
                    loadBonSelected(checkedBon[0]);
                    $('#TAB_MSG_VIEW').show();
		    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }else
                {
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    
                }
                if(checkedBon.length==nbTotalBonChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            
            
            
            
            enableRelevantAchatMenu = function()
	{   
            if (checkedBon.length == 1)
            {
                $('#MNU_ANNULATION').removeClass('disabled');
                $('#MNU_IMPRIMER').removeClass('disabled');
                $('#MNU_REMOVE').removeClass('disabled');
                var state = $('#stag' + checkedBon[0]).val();
                 if (state == 1) {
                        $('#MNU_REMOVE').addClass('disabled');
                        $('#MNU_ANNULATION').addClass('disabled');
                       // $('#MNU_REMOVE').removeClass('disabled');
                  } 
                  else if (state == 2) {
                       $('#MNU_REMOVE').removeClass('disabled');
                  }
                          
            }
            else if (checkedBon.length > 1){
                $('#MNU_ANNULATION').removeClass('enable');
                $('#MNU_IMPRIMER').removeClass('enable');
                $('#MNU_REMOVE').removeClass('enable');
                $('#MNU_IMPRIMER').addClass('disabled');
                $('#MNU_REMOVE').addClass('disabled');
                $('#MNU_ANNULATION').addClass('disabled');
                 bootbox.alert("Veuillez selectionnez une seule entrée SVP!");
//                  loadBons();
            }
            else{
                $('#MNU_ANNULATION').removeClass('enable');
                $('#MNU_IMPRIMER').removeClass('enable');
                $('#MNU_ANNULATION').addClass('disabled');
                $('#MNU_IMPRIMER').addClass('disabled');

            }
            };
            
            
            MessageUnSelected = function()
            {
            	EnableAction();
               if (checkedBon.length === 1){
                    loadBonSelected(checkedBon[0]);
		    $('#TAB_MSG_VIEW').show();
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                }
                else
                {
                    $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
                    $('#TAB_MSG_VIEW').hide();
                    $("#BTN_MSG_GROUP").popover('destroy');
                    $("#BTN_MSG_CONTENT").popover('destroy');
                }
                $('table th input:checkbox').removeAttr('checked');
            };

            EnableAction = function()
        	{   
                    if (checkedBon.length == 1)
                    {
                        $('#MNU_ANNULATION').removeClass('disabled');
                        $('#MNU_IMPRIMER').removeClass('disabled');
                        var state = $('#stag' + checkedBon[0]).val();
                         if (state == 1) {
                                 $('#MNU_ANNULATION').addClass('disabled');
                              if($.cookie('profil')=='directeur') {
                                $('#MNU_ANNULATION').removeClass('disabled');
                             }
                          } 
                          else if (state == 2) {
                              
                              $('#MNU_ANNULATION').addClass('disabled');
                              if($.cookie('profil')=='directeur') {
                                $('#MNU_REMOVE').removeClass('disabled');
                            }
                          }
                    }
                    else if (checkedBon.length > 1){
                        $('#MNU_ANNULATION').removeClass('enable');
                        $('#MNU_IMPRIMER').removeClass('enable');
                        $('#MNU_REMOVE').addClass('disabled');
                         if($.cookie('profil')=='directeur') {
                            $('#MNU_ANNULATION').addClass('disabled');
                            $('#MNU_REMOVE').addClass('disabled');
                         }
                         bootbox.alert("Veuillez selectionnez un seul achat SVP!");
                        loadBons('*', "<?php echo $codeUsine;?>");
                    }
                    else{
                        $('#MNU_ANNULATION').removeClass('enable');
                        $('#MNU_IMPRIMER').removeClass('enable');
                        $('#MNU_ANNULATION').addClass('disabled');
                        $('#MNU_IMPRIMER').addClass('disabled');
                    }
           };

            // Add checked item to the array
            checkedBonAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedBon.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedBonRemove = function(item) {
                var i = 0;
                while (i < checkedBon.length) {
                    if (checkedBon[i] == item) {
                        checkedBon.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedBon.length; i++) {
                    if (checkedBon[i] == item)
                        return true;
                }
                return false;
            };
             loadBons = function(codeUsineOrigine, codeUsineDest) {
                nbTotalBonChecked = 0;
                checkedBon = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php';

                if (oTableBons != null)
                    oTableBons.fnDestroy();

                oTableBons = $('#LIST_BONS').dataTable({
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
                                    src += '<span class=" tooltip-error" title="Non validé"><i class="ace-icon fa fa-wrench orange bigger-130 icon-only"></i></span>';
                                else if (data == 1)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Validé"><i class="ace-icon fa fa-check-square-o green bigger-130 icon-only"></i></span>';
                                else if (data == 2)
                                    src += '<span class="badge badge-transparent tooltip-error" title="Annulé"><i class="ace-icon fa fa-trash-o red bigger-130 icon-only"></i></span>';
                                return src;
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
                                checkedBonAdd(aData[0]);
                                MessageSelected();
                                
                            }else{
                                checkbox.removeAttr('checked');
                                
                                checkedBonRemove(aData[0]);
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
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_GET_ENTREE; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        aoData.push({"name": "profil", "value": $.cookie('profil')});
                        aoData.push({"name": "codeUsineDest", "value": codeUsineDest});
                        if(codeUsineOrigine!=='*')
                        aoData.push({"name": "codeUsineOrigine", "value": codeUsineOrigine});
                        else
                        	aoData.push({"name": "codeUsineOrigine", "value": '*'});   
                        
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
                                  nbTotalBonChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            loadBons('*', "<?php echo $codeUsine;?>");
            var bonId=0;
            loadBonSelected = function(bonsortieId)
            {
                bonId=bonsortieId;
                 var url;
                 url = '<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php';
                 
                $.post(url, {bonsortieId: bonsortieId, ACTION: "<?php echo App::ACTION_VIEW_DETAILS; ?>"}, function(data) {
                    data = $.parseJSON(data);
                    $('#TAB_MSG_TITLE').text("Numero: "+ data.numero);
                    $('#Date').text(data.date+' à '+ data.heure);
                    $('#Origine').text(data.origine);
                    $('#NumeroCamion').text(data.numCamion);
                    $('#Chauffeur').text(data.chauffeur);
                    $('#Destination').text(data.destination);
                    $('#User').text(data.user);
                    $('#totalColis').text(data.totalColis);
                    $('#PoidsTotal').text(data.poidsTotal);
                    $('#TABLE_BONS tbody').html("");
                    var table = data.ligneBonSortie;
                    var trHTML='';
                    $(table).each(function(index, element){
                        var pid=element.id;
                        trHTML += '<tr id='+element.id+'><td>' + element.designation + '</td><td>' + element.quantite + '</td><td><button id="colis'+pid+'" class="btnColis center btn btn-warning btn-mini" href="#">'+
                            '<i class="ace-icon fa fa-pencil bigger-130"></i>'+
                            '</button></td></tr>';
                        
                    });
                    $('#TABLE_BONS tbody').append(trHTML);
                    trHTML='';
                    $('#TAB_GROUP a[href="#TAB_MSG"]').tab('show');
                    $('#TAB_MSG_VIEW').show();
               }).error(function(error) { });
            };
            $('#TABLE_BONS').on('click', '.btnColis', function()
            {
                 var id = $(this).closest('tr').attr('id');
                // var counter = id.substring(4);
                getColis(bonId, id);
            });
            
             showPopover = function(idButton, colis){
            $("#" + idButton).popover({
                html: true,
                trigger: 'focus',
                placement: 'left',
                title: '<i class="icon-group icon-"></i> Détail colis ',
                content: colis
            }).popover('toggle');
         };
         
            function getColis(bonsortieId, produitId){
            var html='';
             var html="<div class='popover-medium' style='width: 550px;'> Liste des colis disponibles<hr>";
            var urlColis = '<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php';
                $.post(urlColis, {bonsortieId:bonsortieId,produitId: produitId,ACTION: "<?php echo App::ACTION_GET_COLIS_BONSORTIE; ?>"}, function(dataColis) {
                  dataColis = $.parseJSON(dataColis);
               // dataColis = dataColis[0];
                 console.log(dataColis);
                $(dataColis).each(function(index, element){
                        html+="<span><b>"+element.nbCarton+" colis de "+element.quantiteParCarton+" kg<b></span><br /><hr>";
                });
                 html+="</div>";
                 console.log(html);
                 showPopover("colis"+produitId, ""+html+"");
                });
               
            }
            
            $("#MNU_IMPRIMER").click(function()
                    {
                        if (checkedBon.length == 0)
                            bootbox.alert("Veuillez selectionnez un bon de sortie");
                        else if (checkedBon.length >= 1)
                        {
                        	window.open('<?php echo App::getHome(); ?>/app/pdf/bonSortiePdf.php?bonSortieId='+checkedBon[0],'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1200, height=650');
                            
                        }
                    });
            });
        </script>
