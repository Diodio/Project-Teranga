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
            Gestion des utilisateurs
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Liste des utilisateurs
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
         
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-users orange"></i>
                            Liste des utilisateurs
                        </h4>
                        <a id="MNU_AJOUTER" class="btn btn-primary btn-sm" style="margin-left: 10px;margin-bottom: 10px;"><i
                                        class="ace-icon fa fa-plus-square"></i> Nouveau</a> 
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                          
                    </div>
                        
                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_USERS" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Nom Complet
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                   Login
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Usine
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Détail
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
</div>
        
       <script type="text/javascript">
    $(document).ready(function () {
            var oTableUsers = null;
            var nbTotalUsersChecked=0;
            var checkedUsers = new Array();
            // Check if an item is in the array
           // var interval = 500;
           
     alert("cc");
            checkedUsersContains = function(item) {
                for (var i = 0; i < checkedUsers.length; i++) {
                    if (checkedUsers[i] == item)
                        return true;
                }
                return false;
            };
            // Persist checked Message when navigating
            
            
            persistChecked = function() {
                $('input[type="checkbox"]', "#LIST_USERS").each(function() {
                    if (checkedUsersContains($(this).val())) {
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
                        checkedUsersAdd($(this).val());
                      //  MessageSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                        nbTotalUsersChecked=checkedUsers.length;
                    }
                    else
                    {
                        checkedUsersRemove($(this).val());
                   //    MessageUnSelected();
                        $('#TAB_GROUP a[href="#TAB_INFO"]').tab('show');
			$('#TAB_MSG_VIEW').hide();
                    }
                    $(this).closest('tr').toggleClass('selected');
                });
            });
            
             $('#LIST_USERS tbody').on('click', 'input[type="checkbox"]', function() {
                context=$(this);
                if ($(this).is(':checked') && $(this).val() != '*') {
                    checkedUsersAdd($(this).val());
                    MessageSelected();
                } else {
                    checkedUsersRemove($(this).val());
                    MessageUnSelected();
                }
                ;
                if(!context.is(':checked')){
                    $('table th input:checkbox').removeAttr('checked');
                }else{
                    if(checkedUsers.length==nbTotalUsersChecked){
                        $('table th input:checkbox').prop('checked', true);
                    }
                }
            });
            
         
           // $('#SAVE').attr("disabled", true);
            MessageSelected = function(click)
            {
                if (checkedUsers.length == 1){
                    $('#SAVE').attr("disabled", false);
                    loadDemoulagesSelected(checkedUsers[0]);
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
                if(checkedUsers.length==nbTotalUsersChecked){
                    $('table th input:checkbox').prop('checked', true);
                }
            };
            MessageUnSelected = function()
            {
               if (checkedUsers.length === 1){
                   $('#SAVE').attr("disabled", false);
                    loadDemoulagesSelected(checkedUsers[0]);
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
            checkedUsersAdd = function(item) {
                if (!checkedMessageContains(item)) {
                    checkedUsers.push(item);
                }
            };
            // Remove unchecked items from the array
            checkedUsersRemove = function(item) {
                var i = 0;
                while (i < checkedUsers.length) {
                    if (checkedUsers[i] == item) {
                        checkedUsers.splice(i, 1);
                    } else {
                        i++;
                    }
                }
            };
            checkedMessageContains = function(item) {
                for (var i = 0; i < checkedUsers.length; i++) {
                    if (checkedUsers[i] == item)
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
             loadUsers = function() {
                nbTotalUsersChecked = 0;
                checkedUsers = new Array();
                var url =  '<?php echo App::getBoPath(); ?>/utilis/UtilisateurController.php';

                if (oTableUsers != null)
                    oTableUsers.fnDestroy();

                oTableUsers = $('#LIST_USERS').dataTable({
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
                        "aTargets": [3],
                        "bSortable": false,
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
//                            $(nTd).css('text-align', 'center');
//                            $(nTd).text('');
//                            $(nTd).addClass('td-actions');
//                            action=$('<div></div>');
//                            action.addClass('hidden-phone pull-right visible-desktop action-buttons');
//                            
//                            btnGrps=$('<button id="colis'+oData[0]+'" class="center btn btn-warning btn-mini" href="#">'+
//                            '<i class="ace-icon fa fa-pencil bigger-130"></i>'+
//                            '</button>');
//                            btnGrps.click(function(){
//                                $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {produitId: oData[0], codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_GET_COLIS; ?>"}, function(data) {
//                                data=$.parseJSON(data);
//                                var htmlString="<div class='popover-medium' style='width: 550px;'> Liste des colis disponible<hr>";
//                                $.each(data , function(i) { 
//                                    str= data [i].toString();
//                                    var substr = str.split(',');
//                                    htmlString+="<span><b>"+substr [0]+" colis de "+substr [1]+" kg<b></span><br /><hr>";
//                                  });
//                                  htmlString+="</div>";
//                                showPopover("colis"+oData[0], ""+htmlString+"");
//                                });
//                            });
//                            btnGrps.tooltip({
//                                title: 'Liste des colis disponible'
//                            });
//                            btnGrps.css({'margin-right': '10px', 'cursor':'pointer'});
//                            action.append(btnGrps);
//                            $(nTd).append(action);
                           
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
//                                checkedUsersAdd(aData[0]);
//                                MessageSelected();
//                                
//                            }else{
//                                checkbox.removeAttr('checked');
//                                
//                                checkedUsersRemove(aData[0]);
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
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "sAjaxSource": url,
                    "sPaginationType": "simple",
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                        aoData.push({"name": "ACTION", "value": "<?php echo App::ACTION_LIST; ?>"});
                        aoData.push({"name": "offset", "value": "1"});
                        aoData.push({"name": "rowCount", "value": "10"});
                        userProfil=$.cookie('profil');
                        if(userProfil==='admin'){
                            aoData.push({"name": "codeUsine", "value": "*"});
                        }
                        else
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
                                  nbTotalUsersChecked=json.iTotalRecords;
                              }
                                
                           }
                        });
                    }
                });
            };
            
            loadUsers();
         

            });
        </script>