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
                <div class="col-xs-12" style="margin-top: 12px;">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
            <div id="winModalProduit" class="modal fade" tabindex="-1">
            <form id="validation-form" class="form-horizontal" role="form">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="smaller lighter blue no-margin">Produit</h3>
                        </div>

                        <div class="modal-body" style="height: 240px;">
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Désignation </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="designation" name="designation" placeholder="" class="col-xs-10 col-sm-7">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock provisoire</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="stockProvisoire" name="stockProvisoire" placeholder="" class="col-xs-10 col-sm-7" value="0">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock reel</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="stockReel" name="stockReel" placeholder="" class="col-xs-10 col-sm-7" value="0">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Seuil </label>
                                    <div class="col-sm-9">
                                            <input type="text" id="seuil" placeholder="" class="col-xs-10 col-sm-7" value="0">
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

        $("#MNU_PRODUIT_NEW").click(function()
        {
           //$("#groupName").val('');
          
//            $('#winModalProduit .control-group').removeClass('error').addClass('info');
//            $('#winModalProduit span.help-block').remove();
            $('#winModalProduit').modal('show');
        });
        
   
       var grid_data;
    //    var grid;

    loadProduit = function () {
        $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {ACTION: "<?php echo App::ACTION_LIST; ?>"}, function (data) {
            $.extend($.jgrid,$.jgrid.regional['fr']);
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
                height: 350,
                colNames: [' ', 'Désignation', 'stock provisoire', 'stock reel'],
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
                    {name: 'designation', index: 'designation', width: 90, editable: true, editoptions: {size: "20", maxlength: "30"}},
                    {name: 'stockProvisoire', index: 'stockProvisoire', width: 150, editable: false, editoptions: {size: "20", maxlength: "30"}},
                    {name: 'stockReel', index: 'stockReel', width: 70, editable: false}
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
                editurl: "<?php echo App::getBoPath(); ?>/produit/ProduitController.php?ACTION=UPDATE", //nothing is saved
                dataType: 'json',
                caption: "Liste des produits"
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
                        del: true,
                        delicon: 'ace-icon fa fa-trash-o red',
                        refresh: true,
                        refreshicon: 'ace-icon fa fa-refresh green',
                        
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
    loadProduit();
    
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
       function calculSeuil(){
           var stock = parseFloat($("#stockReel").val());
           if(!isNaN(stock) && stock!==0) {
            var seuil=0;
           if(stock > 0)
              seuil = (stock * 25)/100;
           return seuil;
       }
   }
         produitProcess = function ()
        {
            
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var frmData;
            var designation = $("#designation").val();
            var stockProvisoire = $("#stockProvisoire").val();
            var stockReel = $("#stockReel").val();
            var seuil = calculSeuil();
            var codeUsine = "<?php echo $codeUsine ?>";
            var login = "<?php echo $login ?>";
            
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('designation', designation);
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
                       loadProduit();
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
					required: true
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
				 produitProcess();
				 $('#winModalProduit').addClass('hide');
                                 $('#winModalProduit').modal('hide');
			},
			invalidHandler: function (form) {
			}
		});


       });

       
       
       
    });
</script>
