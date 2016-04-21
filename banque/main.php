<?php
require '../common/app.php';
//if (!isset($_COOKIE['userId'])) {
//    header('Location: ' . \App::getHome());
//    exit();
//}
//$userId = $_COOKIE['userId'];
//$etatCompte = $_COOKIE['etatCompte'];
//$login = $_COOKIE['login'];
//$profil = $_COOKIE['profil'];
//$status = $_COOKIE['status'];
//$codeUsine = $_COOKIE['codeUsine'];
//$nomUtilisateur = $_COOKIE['nomUtilisateur'];
//$description = $_COOKIE['description'];
//$nomUsine = $_COOKIE['nomUsine'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>MacFish Production</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet"
              href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
              

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/css/datepicker.min.css" />
        <link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
        <!-- text fonts -->
        <link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="assets/css/ace.min.css"
              class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
                                <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
                        <![endif]-->

        <!--[if lte IE 9]>
                          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
                        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="assets/js/ace-extra.min.js"></script>
<!--        <script src="assets/js/jquery.maskedinput.min.js"></script>-->

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
                        <script src="assets/js/html5shiv.min.js"></script>
                        <script src="assets/js/respond.min.js"></script>
                        <![endif]-->
        <link rel="stylesheet" href="assets/css/jquery.gritter.css" />
        <link rel="stylesheet" href="assets/css/select2.css" />
        <link rel="stylesheet" href="assets/css/jchart.css" />
        <link rel="stylesheet" href="assets/css/all.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
        <link href="assets/css/bootstrap-editable.min.css" rel="stylesheet">
    </head>

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default">
            <script type="text/javascript">
                try {
                    ace.settings.check('navbar', 'fixed')
                } catch (e) {
                }
            </script>

            <div class="navbar-container" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left"
                        id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span>

                    <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand"> <small> <i
                                class="fa fa-leaf"></i> MacFish Production <?php echo $nomUsine;?>
                        </small>
                    </a>
                </div>
                

                <div class="navbar-buttons navbar-header pull-right"
                     role="navigation">
                    <ul class="nav ace-nav">



                        <li class="light-blue"><a data-toggle="dropdown" href="#"
                                                  class="dropdown-toggle"> <img class="nav-user-photo" style="border-radius: 51% !important;
    background-size: 32px 32px !important;
     -webkit-border-radius: 50% !important; 
    height: 28px !important;
    width: 26px !important;"
                                                          src="assets/avatars/default.png" alt="Administrateur" /> 
                                <span
                                                          class="user-info"> <small>Bienvenue,</small> <?php echo $nomUtilisateur;?>
                                </span> <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul
                                class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li><a href="#"> <i class="ace-icon fa fa-cog"></i> Settings
                                    </a>
                                </li>

                                <li><a href="profile.html"> <i class="ace-icon fa fa-user"></i>
                                        Profil: <?php echo $description;?>
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li><a href="#" id="US_LOGOUT"> <i
                                            class="ace-icon fa fa-power-off"></i> Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.navbar-container -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>

            <div id="sidebar" class="sidebar                  responsive">
                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'fixed')
                    } catch (e) {
                    }
                </script>
                <!--
        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div> /.sidebar-shortcuts -->

                <ul class="nav nav-list">

                    <li class="active"><a id="MNU_BORD" href="" class=""> <i
                                class="menu-icon fa fa-tachometer"></i> <span class="menu-text">
                                Tableau de bord </span>
                        </a> <b class="arrow"></b>
                    </li>
                    <li class="active"><a id="MNU_BORD" href="" class=""> <i
                                class="menu-icon fa fa-tachometer"></i> <span class="menu-text">
                                Mes comptes </span>
                        </a> <b class="arrow"></b>
                    </li>
                    <li class="active"><a id="MNU_BORD" href="" class=""> <i
                                class="menu-icon fa fa-tachometer"></i> <span class="menu-text">
                                Virement </span>
                        </a> <b class="arrow"></b>
                    </li>
                    <li class="active"><a id="MNU_BORD" href="" class=""> <i
                                class="menu-icon fa fa-tachometer"></i> <span class="menu-text">
                                Cheque </span>
                        </a> <b class="arrow"></b>
                    </li>
              </ul>
                <!-- /.nav-list -->

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse"></div>

                <script type="text/javascript">
                    try {
                        ace.settings.check('sidebar', 'collapsed')
                    } catch (e) {
                    }
                </script>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try {
                                ace.settings.check('breadcrumbs', 'fixed')
                            } catch (e) {
                            }
                        </script>

                        <ul class="breadcrumb">
                            <li><i class="ace-icon fa fa-home home-icon"></i> <a href="#">Accueil</a>
                            </li>
                            <li class="active">Tableau de bord</li>
                        </ul>
                        <!-- /.breadcrumb -->

<!--                         <div class="nav-search" id="nav-search"> -->
<!--                             <form class="form-search"> -->
<!--                                 <span class="input-icon"> <input type="text" -->
<!--                                                                  placeholder="Search ..." class="nav-search-input" -->
<!--                                                                  id="nav-search-input" autocomplete="off" /> <i -->
<!--                                                                  class="ace-icon fa fa-search nav-search-icon"></i> -->
<!--                                 </span> -->
<!--                             </form> -->
<!--                         </div> -->
                        <!-- /.nav-search -->
                    </div>

                    <div class="page-content">
                        <div id="MAIN_CONTENT"></div>
                        <div id="winContainer"></div>
                    </div>
                    <!-- /.page-content -->
                </div>
            </div>
            <!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120"> <span class="blue bolder">MacFish
                                Production</span> &copy; 2015
                        </span> &nbsp; &nbsp;

                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up"
               class="btn-scroll-up btn btn-sm btn-inverse"> <i
                    class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>
        <!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="assets/js/jquery.2.1.1.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

        <!--[if !IE]> -->
<!--        <script type="text/javascript">
                            window.jQuery || document.write("<script src='assets/js/jquery.min.js'>" + "<" + "/script>");
        </script>-->

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->
        <script src="assets/js/jquery-ui.custom.min.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>
        <script src="assets/js/jquery.sparkline.min.js"></script>
        <script src="assets/js/jquery.flot.min.js"></script>
        <script src="assets/js/jquery.flot.pie.min.js"></script>
        <script src="assets/js/jquery.flot.resize.min.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/jquery.loadJSON.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/bootbox.min.js"></script>

        <!-- ace scripts -->
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/js/jquery.cookie.js"></script>
        <script src="assets/js/grid.locale-fr.js"></script>
        <script src="assets/js/jquery.jqGrid.min.js"></script>
        <script src="assets/js/grid.locale-en.js"></script>
        <script src="assets/js/jchart.js"></script>
        <script src="assets/js/shieldui-lite-all.min.js"></script>
        <script src="assets/js/shortGridData.js"></script>
        
	<script src="assets/js/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/bootstrap-editable.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/grid.locale-fr.js"></script>
        <script src="assets/js/bootstrap-datepicker.min.js"></script>
        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function ($) {
//            	if("<?php echo $profil?>"==='gerant')
//            		 $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListeGerant.php", function () {
//                     });
//            	 else
//                $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/home/home.php", function () {
//                });
//                function manageProfil(profil){
//                    if(profil==='magasinier')
//                    {
//                        $('#PARAMETRAGE').removeClass("hidden");
//                        $('#BONACHAT').removeClass("hidden");
//                        $('#MNU_LIST_DEMOULAGES').removeClass("hidden");
//                        $('#MNU_CONSULTATION').removeClass("hidden");
//                        if($.cookie('codeUsine')!=='usine_dakar')
//                            $('#BONSORTIE').removeClass("hidden");
//                        $('#STOCK_REEL').removeClass("hidden");
//                    }
//                    else if(profil==='gerant') {
////                         $('#PARAMETRAGE').removeClass("hidden");
//                        $('#BONACHAT').removeClass("hidden");
////                         $('#STOCK_REEL').addClass("hidden");
////                         $('#LIST_USERS').addClass("hidden");
//                    }
//                    else if(profil==='admin'){
//                        $('#PARAMETRAGE').removeClass("hidden");
//                        $('#BONACHAT').removeClass("hidden");
//                        $('#MNU_LIST_DEMOULAGES').removeClass("hidden");
//                        $('#BONSORTIE').removeClass("hidden");
//                        $('#MNU_FACTURE').removeClass("hidden");
//                        $('#MNU_REGLEMENT').removeClass("hidden");
//                        $('#MNU_CONSULTATION').removeClass("hidden");
//                        $('#MNU_INVENTAIRE').removeClass("hidden");
//                        $('#STOCK_REEL').removeClass("hidden");
//                        $('#LIST_USERS').removeClass("hidden");
//                        $('#MNU_CORBEILLE').removeClass("hidden");
//                    }
//                    else if(profil==='directeur'){
//                        $('#PARAMETRAGE').removeClass("hidden");
//                        $('#BONACHAT').removeClass("hidden");
//                        $('#MNU_LIST_DEMOULAGES').removeClass("hidden");
//                        $('#BONSORTIE').removeClass("hidden");
//                        $('#MNU_FACTURE').removeClass("hidden");
//                        $('#MNU_REGLEMENT').removeClass("hidden");
//                        $('#LIST_USERS').removeClass("hidden");
//                        $('#MNU_LIST_DEMOULAGES').removeClass("hidden");
//                        $('#MNU_CONSULTATION').removeClass("hidden");
//                        $('#MNU_INVENTAIRE').removeClass("hidden");
//                        $('#STOCK_REEL').removeClass("hidden");
//                        $('#MNU_CORBEILLE').removeClass("hidden");
//                        
//                    }
//                }
//                manageProfil("<?php echo $profil;?>");
//                
//                $("#MNU_PRODUITS").click(function (e) {
//                	$("#MNU_PRODUITS").attr("Class", "active");
//                    $("#MNU_MAREYEURS").attr("Class", "no-active");
//                    $("#MNU_BORD").attr("Class", "no-active");
//                    $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#LIST_USERS").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active")
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/produit/produitsVue.php", function () {
//                    });
//
//                });
//
//
//                $("#MNU_MAREYEURS").click(function (e) {
//                	$("#MNU_PRODUITS").attr("Class", "no-active");
//                    $("#MNU_MAREYEURS").attr("Class", "active");
//                    $("#MNU_BORD").attr("Class", "no-active");
//                    $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//					$("#AJOUTER_ACHATS").attr("Class", "no-active");
//					$("#LISTE_ACHATS").attr("Class", "no-active");
//					$("#AJOUTER_SORTIE").attr("Class", "no-active");
//					$("#AJOUTER_FACTURE").attr("Class", "no-active");
//					$("#LIST_USERS").attr("Class", "no-active");
//					$("#STOCK_REEL").attr("Class", "no-active");
//					$("#LISTE_FACTURE").attr("Class", "no-active");
//					$("#LISTE_SORTIE").attr("Class", "no-active");
//					$("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active")
//					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
//					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
//					$("#MNU_DEMOULAGE").attr("Class", "no-active");
//					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//					$("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/mareyeur/mareyeursVue.php", function () {
//                    });
//                });
//
//                $("#MNU_CLIENTS").click(function (e) {
//                    $("#MNU_PRODUITS").attr("Class", "no-active");
//                    $("#MNU_MAREYEURS").attr("Class", "no-active");
//                    $("#MNU_BORD").attr("Class", "no-active");
//                    $("#MNU_CLIENTS").attr("Class", "active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active")
//                    $("#LIST_USERS").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/client/clientsVue.php", function () {
//
//                    });
//                });
//
//                $("#AJOUTER_ACHATS").click(function (e) {
//                	$("#MNU_PRODUITS").attr("Class", "no-active");
//                    $("#MNU_MAREYEURS").attr("Class", "no-active");
//                    $("#MNU_BORD").attr("Class", "no-active");
//                    $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//					$("#AJOUTER_ACHATS").attr("Class", "active");
//					$("#LISTE_ACHATS").attr("Class", "no-active");
//					$("#AJOUTER_SORTIE").attr("Class", "no-active");
//					$("#AJOUTER_FACTURE").attr("Class", "no-active");
//					$("#LISTE_FACTURE").attr("Class", "no-active");
//					$("#LISTE_SORTIE").attr("Class", "no-active");
//					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
//// 					$("#STOCK_REEL").attr("Class", "no-active");
//					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
//					$("#MNU_DEMOULAGE").attr("Class", "no-active");
//					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//// 					$("#LIST_USERS").attr("Class", "no-active");
//					$("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active")
//					$("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatsVue.php", function () {
//
//                    });
//                });
//
//
//                $("#US_LOGOUT").click(function () {
//                    //alert($.cookie('userId') );
//                    $.post("<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php", {userId:$.cookie('userId'), ACTION: "<?php echo App::ACTION_SIGNOUT; ?>"}, function (data) {
//                        if (data === '0') {
//                            alert('Utilisateur deja deconnect�');
//                        } else {
//                            var cookies = $.cookie();
//                            $.each(cookies, function (k) {
//                                $.removeCookie(k, {path: '/'});
//                            });
//                        }
//                        window.location.replace("<?php echo App::getHome(); ?>");
//                    });
//                });
//
//                $("#LISTE_ACHATS").click(function (e) {
//                	$("#MNU_PRODUITS").attr("Class", "no-active");
//                    $("#MNU_MAREYEURS").attr("Class", "no-active");
//                    $("#MNU_BORD").attr("Class", "no-active");
//                    $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
////                     $("#LIST_USERS").attr("Class", "no-active");
////                     $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    if("<?php echo $profil?>"!=='gerant'){
//                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {
//                        });
//                    }
//                    else {
//                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListeGerant.php", function () {
//                        });
//                    }
//                });
//
//
//                $("#AJOUTER_SORTIE").click(function (e) {
//                	$("#MNU_PRODUITS").attr("Class", "no-active");
//                    $("#MNU_MAREYEURS").attr("Class", "no-active");
//                    $("#MNU_BORD").attr("Class", "no-active");
//                    $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#LIST_USERS").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/bonSortie/bonSortieVue.php", function () {
//
//                    });
//                });
//
//                $("#AJOUTER_FACTURE").click(function (e) {
//                	 $("#MNU_PRODUITS").attr("Class", "no-active");
//                     $("#MNU_MAREYEURS").attr("Class", "no-active");
//                     $("#MNU_BORD").attr("Class", "no-active");
//                     $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
// 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
// 					$("#LISTE_ACHATS").attr("Class", "no-active");
// 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
// 					$("#AJOUTER_FACTURE").attr("Class", "active");
// 					$("#LISTE_FACTURE").attr("Class", "no-active");
// 					$("#LISTE_SORTIE").attr("Class", "no-active");
// 					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
// 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
// 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
// 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
// 					$("#LIST_USERS").attr("Class", "no-active");
// 					$("#STOCK_REEL").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/facturesVue.php", function () {
//
//                    });
//                });
//
//
//                $("#LISTE_FACTURE").click(function (e) {
//                	 $("#MNU_PRODUITS").attr("Class", "no-active");
//                     $("#MNU_MAREYEURS").attr("Class", "no-active");
//                     $("#MNU_BORD").attr("Class", "no-active");
//                     $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
// 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
// 					$("#LISTE_ACHATS").attr("Class", "no-active");
// 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
// 					$("#AJOUTER_FACTURE").attr("Class", "no-active");
// 					$("#LISTE_FACTURE").attr("Class", "active");
// 					$("#LISTE_SORTIE").attr("Class", "no-active");
// 					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
// 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
// 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
// 					$("#LIST_USERS").attr("Class", "no-active");
// 					$("#STOCK_REEL").attr("Class", "no-active");
// 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
// 					 $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/factureListe.php", function () {
//
//                    });
//                });
//                
//                $("#LISTE_SORTIE").click(function (e) {
//                	 $("#MNU_PRODUITS").attr("Class", "no-active");
//                     $("#MNU_MAREYEURS").attr("Class", "no-active");
//                     $("#MNU_BORD").attr("Class", "no-active");
//                     $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#LIST_USERS").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/bonSortie/bonSortieListe.php", function () {
//
//                    });
//                });
//
//                $("#REGLEMENT_FACTURE").click(function (e) {
//                	 $("#MNU_PRODUITS").attr("Class", "no-active");
//                     $("#MNU_MAREYEURS").attr("Class", "no-active");
//                     $("#MNU_BORD").attr("Class", "no-active");
//                     $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
// 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
// 					$("#LISTE_ACHATS").attr("Class", "no-active");
// 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
// 					$("#AJOUTER_FACTURE").attr("Class", "no-active");
// 					$("#LISTE_FACTURE").attr("Class", "no-active");
// 					$("#LISTE_SORTIE").attr("Class", "no-active");
// 					$("#REGLEMENT_FACTURE").attr("Class", "active");
// 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
// 					$("#STOCK_REEL").attr("Class", "no-active");
// 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
// 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
// 					$("#LIST_USERS").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/reglement/reglementFacture.php", function () {
//
//                    });
//                });
//
//                $("#REGLEMENT_ACHAT").click(function (e) {
//                	 $("#MNU_PRODUITS").attr("Class", "no-active");
//                     $("#MNU_MAREYEURS").attr("Class", "no-active");
//                     $("#MNU_BORD").attr("Class", "no-active");
//                     $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#LIST_USERS").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/reglement/reglementAchat.php", function () {
//
//                    });
//                });
//
//                $("#MNU_DEMOULAGE").click(function (e) {
//                	 $("#MNU_PRODUITS").attr("Class", "no-active");
//                     $("#MNU_MAREYEURS").attr("Class", "no-active");
//                     $("#MNU_BORD").attr("Class", "no-active");
//                     $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#LIST_USERS").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/demoulage/demoulageVue.php", function () {
//                 });
//                 });
//                 
//
//                $("#MNU_DEMOULAGE_LIST").click(function (e) {
//                	 $("#MNU_PRODUITS").attr("Class", "no-active");
//                     $("#MNU_MAREYEURS").attr("Class", "no-active");
//                     $("#MNU_BORD").attr("Class", "no-active");
//                     $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LIST_USERS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/demoulage/DemoulageListe.php", function () {
//                 });
//                 });
//                
//                  $("#STOCK_REEL").click(function (e) {
//                	  $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//  					$("#AJOUTER_ACHATS").attr("Class", "no-active");
//  					$("#LISTE_ACHATS").attr("Class", "no-active");
//  					$("#AJOUTER_SORTIE").attr("Class", "no-active");
//  					$("#AJOUTER_FACTURE").attr("Class", "no-active");
//  					$("#LISTE_FACTURE").attr("Class", "no-active");
//  					$("#LISTE_SORTIE").attr("Class", "no-active");
//  					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
//  					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
//  					$("#LIST_USERS").attr("Class", "no-active");
//  					$("#MNU_DEMOULAGE").attr("Class", "no-active");
//					$("#MNU_DEMOULAGE_LIST").attr("Class", "active");
//  					$("#STOCK_REEL").attr("Class", "active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/stock/stockReelListe.php", function () {
//                 });
//                 });
//                 
//                  $("#LIST_USERS").click(function (e) {
//                    $("#MNU_PRODUITS").attr("Class", "no-active");
//                    $("#MNU_MAREYEURS").attr("Class", "no-active");
//                    $("#MNU_BORD").attr("Class", "no-active");
//                    $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                    $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                    $("#LISTE_ACHATS").attr("Class", "no-active");
//                    $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                    $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_FACTURE").attr("Class", "no-active");
//                    $("#LISTE_SORTIE").attr("Class", "no-active");
//                    $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                    $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                    $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                    $("#LIST_USERS").attr("Class", "active");
//                    $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                    $("#STOCK_REEL").attr("Class", "no-active");
//                    $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                    $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/utilisateur/utilisateurListe.php", function () {
//                    });
//                 });
//
//
//
//                  $("#CONSULTATION_PRODUITS").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#CONSULTATION_ACHATSANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_BONSORTIESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                      $("#CONSULTATION_FACTURESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/consultation/produitDetail.php", function () {
//                      });
//                   });
//
//                  $("#CONSULTATION_ENTREES").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#CONSULTATION_ACHATSANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_BONSORTIESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_ENTREES").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/consultation/entreeListe.php", function () {
//                      });
//                   });
//                   
//                   $("#CONSULTATION_ACHATSANNULES").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                      $("#CONSULTATION_FACTURESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_BONSORTIESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_ACHATSANNULES").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/consultation/achatsAnnules.php", function () {
//                      });
//                   });
//
//                   $("#CONSULTATION_DEMOULAGESANNULES").click(function (e) {
//                       $("#MNU_PRODUITS").attr("Class", "no-active");
//                       $("#MNU_MAREYEURS").attr("Class", "no-active");
//                       $("#MNU_BORD").attr("Class", "no-active");
//                       $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                       $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                       $("#LISTE_ACHATS").attr("Class", "no-active");
//                       $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                       $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                       $("#LISTE_FACTURE").attr("Class", "no-active");
//                       $("#LISTE_SORTIE").attr("Class", "no-active");
//                       $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                       $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                       $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                       $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                       $("#LIST_USERS").attr("Class", "no-active");
//                       $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                       $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                       $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                       $("#STOCK_REEL").attr("Class", "no-active");
//                       $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                       $("#CONSULTATION_FACTURESANNULES").attr("Class", "no-active");
//                       $("#CONSULTATION_BONSORTIESANNULES").attr("Class", "no-active");
//                       $("#CONSULTATION_ACHATSANNULES").attr("Class", "no-active");
//                       $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "active");
//                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/consultation/DemoulageAnnules.php", function () {
//                       });
//                    });
//
//                   $("#CONSULTATION_BONSORTIESANNULES").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                      $("#CONSULTATION_FACTURESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_ACHATSANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_BONSORTIESANNULES").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/consultation/BonSortiesAnnules.php", function () {
//                      });
//                   });
//                   
//                   $("#CONSULTATION_FACTURESANNULES").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#CONSULTATION_ENTREES").attr("Class", "no-active");
//                      $("#CONSULTATION_ACHATSANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_BONSORTIESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#CONSULTATION_FACTURESANNULES").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/consultation/facturesAnnules.php", function () {
//                      });
//                   });
//                   
//                  $("#INVENTAIRE_ACHAT").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/inventaire/achatInventaire.php", function () {
//                      });
//                   });
//
//
//                  $("#INVENTAIRE_FACTURE").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/inventaire/factureInventaire.php", function () {
//                      });
//                   });
//
////                  $("#INVENTAIRE_FACTURE").click(function (e) {
////                      $("#MNU_PRODUITS").attr("Class", "no-active");
////                      $("#MNU_MAREYEURS").attr("Class", "no-active");
////                      $("#MNU_BORD").attr("Class", "no-active");
////                      $("#MNU_CLIENTS").attr("Class", "no-active");
////                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
////                      $("#LISTE_ACHATS").attr("Class", "no-active");
////                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
////                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
////                      $("#LISTE_FACTURE").attr("Class", "no-active");
////                      $("#LISTE_SORTIE").attr("Class", "no-active");
////                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
////                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
////                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
////                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
////                      $("#STOCK_REEL").attr("Class", "no-active");
////                      $("#LIST_USERS").attr("Class", "no-active");
////                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
////                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
////                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
////                      $("#INVENTAIRE_FACTURE").attr("Class", "active");
////                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/inventaire/factureInventaire.php", function () {
////                      });
////                   });
//
//                  $("#INVENTAIRE_GENERALE").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "no-active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#INVENTAIRE_GENERALE").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/inventaire/inventaireGeneral.php", function () {
//                      });
//                   });
//                   $("#MNU_DEVISE").click(function (e) {
//                      $("#MNU_PRODUITS").attr("Class", "no-active");
//                      $("#MNU_MAREYEURS").attr("Class", "no-active");
//                      $("#MNU_BORD").attr("Class", "no-active");
//                      $("#MNU_CLIENTS").attr("Class", "no-active");
//                    $("#MNU_DEVISE").attr("Class", "active");
//                      $("#AJOUTER_ACHATS").attr("Class", "no-active");
//                      $("#LISTE_ACHATS").attr("Class", "no-active");
//                      $("#AJOUTER_SORTIE").attr("Class", "no-active");
//                      $("#AJOUTER_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_FACTURE").attr("Class", "no-active");
//                      $("#LISTE_SORTIE").attr("Class", "no-active");
//                      $("#REGLEMENT_FACTURE").attr("Class", "no-active");
//                      $("#REGLEMENT_ACHAT").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE").attr("Class", "no-active");
//                      $("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
//                      $("#STOCK_REEL").attr("Class", "no-active");
//                      $("#LIST_USERS").attr("Class", "no-active");
//                      $("#CONSULTATION_PRODUITS").attr("Class", "no-active");
//                      $("#INVENTAIRE_ACHAT").attr("Class", "no-active");
//                      $("#CONSULTATION_DEMOULAGESANNULES").attr("Class", "no-active");
//                      $("#INVENTAIRE_FACTURE").attr("Class", "no-active");
//                      $("#INVENTAIRE_GENERALE").attr("Class", "active");
//                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/devise/devise.php", function () {
//                      });
//                   });

            });
        </script>
    </body>
</html>
