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
			Gestion des Bons de sortie <small> <i
				class="ace-icon fa fa-angle-double-right"></i> Destockage
			</small>
		</h1>
	</div>
	<!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
		
		<div class="col-sm-3">
				<h4 class="pink">
					<i
						class="ace-icon fa fa-hand-o-right icon-animated-hand-pointer blue"></i>
					<a href="#modal-table" role="button" class="green"
						data-toggle="modal"> Liste des bon de Sortie </a>
				</h4>
			</div>

			<div class="col-lg-3">
				<div class="control-group">
					<div class="controls">
						<select id="GRP_CMB" style="width: 225px">
							<option value="*" class="groups">type</option>
						</select>
					</div>
				</div>
			</div>
			<!-- PAGE CONTENT BEGINS -->
			
<!-- 			<div class="col-sm-6" > -->
<!-- 				<button id="MNU_MAREYEUR_NEW" class="btn btn-primary btn-xs" -->
<!-- 					title="Mareyeur"> -->
<!-- 					<i class="ace-icon fa fa-plus-square bigger-110"></i> Nouveau -->
<!-- 				</button> -->
<!-- 			</div> -->
			<div class="row">
				<div class="col-xs-12">
					<table id="grid-table"></table>
					<div id="grid-pager"></div>
				</div>
			</div>


			<div id="winModalMareyeur" class="modal fade" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-hidden="true">&times;</button>
							<h3 class="smaller lighter blue no-margin">Produit</h3>
						</div>

						<div class="modal-body" style="height: 300px;">
							<form id="FRM_MAREYEUR" class="form-horizontal" role="form">

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"
										for="form-field-1"> Numero </label>
									<div class="col-sm-9">
										<input type="text" id="nom" placeholder=""
											class="col-xs-10 col-sm-7">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"
										for="form-field-1"> Date</label>
									<div class="col-sm-9">
										<input type="text" id="adresse" placeholder=""
											class="col-xs-10 col-sm-7">
									</div>

								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"
										for="form-field-1"> Quantité</label>
									<div class="col-sm-9">
										<input type="text" id="telephone" placeholder=""
											class="col-xs-10 col-sm-7">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right"
										for="form-field-1"> Client </label>
									<div class="col-sm-9">
										<input type="number" id="compte" placeholder=""
											class="col-xs-10 col-sm-7">
									</div>
								</div>

							</form>
						</div>

						<div class="modal-footer">
							<button id="SAVE" class="btn btn-small btn-info"
								data-dismiss="modal">
								<i class="ace-icon fa fa-save"></i> Enregistrer
							</button>

							<button id="CANCEL" class="btn btn-small btn-danger"
								data-dismiss="modal">
								<i class="fa fa-times"></i> Annuler
							</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

</div>
<!-- /.page-content -->

<script type="text/javascript">

    var grid_data;
    //    var grid;

    loadMareyeurs = function () {
        $.post("<?php echo App::getBoPath(); ?>/mareyeur/MareyeurController.php", {userId: "<?php echo $userId; ?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function (data) {

            grid_data = $.parseJSON(data);
            jQuery(grid_selector).jqGrid({
                //direction: "rtl",

                //subgrid options
                //subGrid : false,
                //subGridModel: [{ name : ['No','Item Name','Qty'], width : [55,200,80] }],
                //datatype: "xml",
                subGridOptions: {
                    plusicon: "ace-icon fa fa-plus center bigger-110 blue",
                    minusicon: "ace-icon fa fa-minus center bigger-110 blue",
                    openicon: "ace-icon fa fa-chevron-right center orange"
                },
                //for this example we are using local data



                data: grid_data,
                datatype: "local",
                height: 250,
                colNames: [' ', 'nom', 'adresse', 'telephone', 'montant Financement'],
                colModel: [
                    {name: 'myac', index: '', width: 80, fixed: true, sortable: false, resize: false,
                        formatter: 'actions',
                        formatoptions: {
                            keys: true,
                            //delbutton: false,//disable delete button

                            delOptions: {recreateForm: true, beforeShowForm: beforeDeleteCallback},
                            //editformbutton:true, editOptions:{recreateForm: true, beforeShowForm:beforeEditCallback}
                        }
                    },
                    // 						{name:'id',index:'id', width:60, sorttype:"int", editable: true},
                    {name: 'nom', index: 'nom', width: 90, editable: true, sorttype: "date", editoptions: {size: "20", maxlength: "30"}},
                    {name: 'adresse', index: 'adresse', width: 150, editable: true, editoptions: {size: "20", maxlength: "30"}},
                    {name: 'telephone', index: 'telephone', width: 70, editable: true, editoptions: {size: "20", maxlength: "30"}},
                    {name: 'montantFinancement', index: 'montantFinancement', width: 90, editable: true, editoptions: {size: "20", maxlength: "30"}},
                ],
                viewrecords: true,
                rowNum: 10,
                rowList: [10, 20, 30],
                pager: pager_selector,
                altRows: true,
                //toppager: true,

                multiselect: true,
                //multikey: "ctrlKey",
                multiboxonly: true,
                loadComplete: function () {
                    var table = this;
                    setTimeout(function () {
                        styleCheckbox(table);

                        updateActionIcons(table);
                        updatePagerIcons(table);
                        enableTooltips(table);
                    }, 0);
                },
                editurl: "<?php echo App::getBoPath(); ?>/mareyeur/MareyeurController.php?ACTION=UPDATE", //nothing is saved
                dataType: 'json',
                caption: "Sortie"
            });
            $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size


            //switch element when editing inline
            function aceSwitch(cellvalue, options, cell) {
                setTimeout(function () {
                    $(cell).find('input[type=checkbox]')
                            .addClass('ace ace-switch ace-switch-5')
                            .after('<span class="lbl"></span>');
                }, 0);
            }
            //enable datepicker
            function pickDate(cellvalue, options, cell) {
                setTimeout(function () {
                    $(cell).find('input[type=text]')
                            .datepicker({format: 'yyyy-mm-dd', autoclose: true});
                }, 0);
            }


            //navButtons
            jQuery(grid_selector).jqGrid('navGrid', pager_selector,
                    {//navbar options
                        edit: true,
                        editicon: 'ace-icon fa fa-pencil blue',
                        add: true,
                        addicon: 'ace-icon fa fa-plus-circle purple',
                        del: true,
                        delicon: 'ace-icon fa fa-trash-o red',
                        search: true,
                        searchicon: 'ace-icon fa fa-search orange',
                        refresh: true,
                        refreshicon: 'ace-icon fa fa-refresh green',
                        view: true,
                        viewicon: 'ace-icon fa fa-search-plus grey',
                    },
                    {
                        //edit record form
                        closeAfterEdit: true,
                        width: 700,
                        recreateForm: true,
                        beforeShowForm: function (e) {
                            var form = $(e[0]);
                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                            style_edit_form(form);
                        }
                    },
            {
                //new record form
                //width: 700,
                closeAfterAdd: true,
                recreateForm: true,
                viewPagerButtons: false,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                            .wrapInner('<div class="widget-header" />')
                    style_edit_form(form);
                }
            },
            {
                //delete record form
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    if (form.data('styled'))
                        return false;

                    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                    style_delete_form(form);

                    form.data('styled', true);
                },
                onClick: function (e) {
                    //alert(1);
                }
            },
            {
                //search form
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                    style_search_form(form);
                },
                afterRedraw: function () {
                    style_search_filters($(this));
                }
                ,
                multipleSearch: true,
                /**
                 multipleGroup:true,
                 showQuery: true
                 */
            },
                    {
                        //view record form
                        recreateForm: true,
                        beforeShowForm: function (e) {
                            var form = $(e[0]);
                            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                        }
                    }
            )
        });

        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
            $(grid_selector).jqGrid('setGridWidth', $(".page-content").width());
        })
        //resize on sidebar collapse/expand
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(document).on('settings.ace.jqGrid', function (ev, event_name, collapsed) {
            if (event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed') {
                //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
                setTimeout(function () {
                    $(grid_selector).jqGrid('setGridWidth', parent_column.width());
                }, 0);
            }
        });

    };
    loadMareyeurs();






    function style_edit_form(form) {
        //enable datepicker on "sdate" field and switches for "stock" field
      //  form.find('input[name=sdate]').datepicker({format: 'yyyy-mm-dd', autoclose: true})

      //  form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
        //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
        //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');


        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

        buttons = form.next().find('.navButton a');
        buttons.find('.ui-icon').hide();
        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
    }

    function style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
    }

    function style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }
    function style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
    }

    function beforeDeleteCallback(e) {
        var form = $(e[0]);
        if (form.data('styled'))
            return false;

        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_delete_form(form);

        form.data('styled', true);
    }

    function beforeEditCallback(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
    }



    //it causes some flicker when reloading or navigating grid
    //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
    //or go back to default browser checkbox styles for the grid
    function styleCheckbox(table) {
        /**
         $(table).find('input:checkbox').addClass('ace')
         .wrap('<label />')
         .after('<span class="lbl align-top" />')
             
             
         $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
         .find('input.cbox[type=checkbox]').addClass('ace')
         .wrap('<label />').after('<span class="lbl align-top" />');
         */
    }


    //unlike navButtons icons, action icons in rows seem to be hard-coded
    //you can change them like this in here if you want
    function updateActionIcons(table) {
        /**
         var replacement =
         {
         'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
         'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
         'ui-icon-disk' : 'ace-icon fa fa-check green',
         'ui-icon-cancel' : 'ace-icon fa fa-times red'
         };
         $(table).find('.ui-pg-div span.ui-icon').each(function(){
         var icon = $(this);
         var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
         if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
         })
         */
    }

    //replace icons with FontAwesome icons like above
    function updatePagerIcons(table) {
        var replacement =
                {
                    'ui-icon-seek-first': 'ace-icon fa fa-angle-double-left bigger-140',
                    'ui-icon-seek-prev': 'ace-icon fa fa-angle-left bigger-140',
                    'ui-icon-seek-next': 'ace-icon fa fa-angle-right bigger-140',
                    'ui-icon-seek-end': 'ace-icon fa fa-angle-double-right bigger-140'
                };
        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function () {
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

            if ($class in replacement)
                icon.attr('class', 'ui-icon ' + replacement[$class]);
        })
    }

    function enableTooltips(table) {
        $('.navtable .ui-pg-button').tooltip({container: 'body'});
        $(table).find('.ui-pg-div').tooltip({container: 'body'});
    }

    //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

    $(document).one('ajaxloadstart.page', function (e) {
        $(grid_selector).jqGrid('GridUnload');
        $('.ui-jqdialog').remove();
    });


    SaveMareyeurProcess = function ()
    {

        var ACTION = '<?php echo App::ACTION_INSERT; ?>';
        var frmData;
        //             var familleproduit= $('#familleMareyeurId').val();
        var nom = $("#nom").val();
        var adresse = $("#adresse").val();
        var telephone = $("#telephone").val();
        var compte = $("#compte").val();

        var formData = new FormData();
        formData.append('ACTION', ACTION);
        //             formData.append('familleId', familleproduit);
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
    $("#MNU_MAREYEUR_NEW").click(function ()
    {
        //$("#groupName").val('');

        $('#winModalMareyeur .control-group').removeClass('error').addClass('info');
        $('#winModalMareyeur span.help-block').remove();
        $('#winModalMareyeur').modal('show');
    });

    $("#SAVE").bind("click", function () {
        SaveMareyeurProcess();
        $('#winModalMareyeur').addClass('hide');
        $('#winModalMareyeur').modal('hide');
        loadMareyeurs();
    });

</script>
