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
            Gestion des devises
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Devise
            </small>
        </h1>
    </div><!-- /.page-header -->


    <div class="row">
        <div class="space-6"></div>
        <div class="row">
            <div class="col-sm-7">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Devise
                        </h4>
                        
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                            <div class="profile-user-info">
                                <div class="profile-info-row">
                                        <div class="profile-info-name"> 
                                            1 <i class="fa fa-euro light-orange bigger-110"></i>
                                        </div>
                                        <div class="profile-info-value">
                                            <span id="euro"></span>  CFA
                                        </div>
                                </div>

                                <div class="profile-info-row">
                                        <div class="profile-info-name"> 1 
                                        <i class="fa fa-dollar light-orange bigger-110"></i></div>

                                        <div class="profile-info-value">
                                                <span id="dollar"></span>  CFA
                                        </div>
                                </div>
                        </div>
                            
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->



        </div><!-- /.row -->
    </div>
    
    <script type="text/javascript">
            jQuery(function ($) {
                
        loadDevise = function () {
        $.post("<?php echo App::getBoPath(); ?>/devise/DeviseController.php", {ACTION: "<?php echo App::ACTION_GET_DEVISE; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#euro").text(sData.euro);
                $("#dollar").text(sData.dollar);
            }
        });
    };
    
    loadDevise();
    
            $('#euro').editable({
                            type: 'text',
                            name: 'prix',
                            title: "Saisir un montant",
                            id: 'id',
                            submit: 'OK',
                            emptytext: "Saisir un montant",
                            placement: "right",
                            validate: function (value) {


                                if (value === '')
                                    return 'Veuillez saisir  un montant S.V.P.';
                            },
                            placement: 'right',
                                    url: function (editParams) {
                                        var montant = editParams.value;
                                        function save() {
                                            if ($.trim(montant) !== "") {
                                                saveDevise(1, '€', montant);
                                            }
                                            else {

                                                $.gritter.add({
                                                    title: 'Server notification',
                                                    text: "Veuillez saisir  un montant S.V.P.",
                                                    class_name: 'gritter-error gritter-light'
                                                });
                                            }
                                        }

                                        save(function () {
                                        });

                                    }

                        });
                        
                        $('#dollar').editable({
                            type: 'text',
                            name: 'prix',
                            title: "Saisir un montant",
                            id: 'id',
                            submit: 'OK',
                            emptytext: "Saisir un montant",
                            placement: "right",
                            validate: function (value) {


                                if (value === '')
                                    return 'Veuillez saisir  un montant S.V.P.';
                            },
                            placement: 'right',
                                    url: function (editParams) {
                                        var montant = editParams.value;
                                        function save() {
                                            if ($.trim(montant) !== "") {
                                                saveDevise(2, '‎$', montant);
                                            }
                                            else {

                                                $.gritter.add({
                                                    title: 'Server notification',
                                                    text: "Veuillez saisir  un montant S.V.P.",
                                                    class_name: 'gritter-error gritter-light'
                                                });
                                            }
                                        }

                                        save(function () {
                                        });

                                    }

                        });
                        
               function saveDevise(deviseId, devise, montant)
                {
                    var ACTION = "<?php echo App::ACTION_UPDATE; ?>";
                    $.ajax({
                        url: '<?php echo App::getBoPath(); ?>/devise/DeviseController.php',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            ACTION: ACTION,
                            deviseId: deviseId,
                            montant: montant,
                            devise: devise
                        },
                        success: function(data)
                        {
                             $('#winModalINFO').modal('hide');
                            if (data.rc == 0){
                                $.gritter.add({
                                    title: 'Server notification',
                                    text: "Devise modifie avec sicces",
                                    class_name: 'gritter-success gritter-light'
                                });
                            }
                            else{
                                $.gritter.add({
                                    title: 'Server notification',
                                    text: data.error,
                                    class_name: 'gritter-error gritter-light'
                                });
                            };
                        },
                        error: function() {
                            alert('error');
                        }
                    });

                }
            });
        </script>