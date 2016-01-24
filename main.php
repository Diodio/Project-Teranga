<?php
require 'common/app.php';
if (!isset($_COOKIE['userId'])) {
    header('Location: ' . \App::getHome());
    exit();
}
$userId = $_COOKIE['userId'];
$etatCompte = $_COOKIE['etatCompte'];
$login = $_COOKIE['login'];
$profil = $_COOKIE['profil'];
$status = $_COOKIE['status'];
$codeUsine = $_COOKIE['codeUsine'];
$nomUtilisateur = $_COOKIE['nomUtilisateur'];
$description = $_COOKIE['description'];

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
                    <a href="index.html" class="navbar-brand"> <small> <i
                                class="fa fa-leaf"></i> MacFish Production
                        </small>
                    </a>
                </div>
                
                <div class="navbar-header pull-center">
                    <a href="" class="navbar-brand"> <small> <i
                                class="fa fa-leaf"></i> <?php echo $codeUsine;?>
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right"
                     role="navigation">
                    <ul class="nav ace-nav">
                        <li class="grey"><a data-toggle="dropdown" class="dropdown-toggle"
                                            href="#"> <i class="ace-icon fa fa-tasks"></i> <span
                                    class="badge badge-grey">4</span>
                            </a>

                            <ul
                                class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header"><i class="ace-icon fa fa-check"></i>
                                    4 Tasks to complete</li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li><a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Software Update</span> <span
                                                        class="pull-right">65%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width: 65%" class="progress-bar"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li><a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Hardware Upgrade</span> <span
                                                        class="pull-right">35%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width: 35%"
                                                         class="progress-bar progress-bar-danger"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li><a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Unit Testing</span> <span
                                                        class="pull-right">15%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width: 15%"
                                                         class="progress-bar progress-bar-warning"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li><a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Bug Fixes</span> <span
                                                        class="pull-right">90%</span>
                                                </div>

                                                <div class="progress progress-mini progress-striped active">
                                                    <div style="width: 90%"
                                                         class="progress-bar progress-bar-success"></div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer"><a href="#"> See tasks with details <i
                                            class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="purple"><a data-toggle="dropdown"
                                              class="dropdown-toggle" href="#"> <i
                                    class="ace-icon fa fa-bell icon-animated-bell"></i> <span
                                    class="badge badge-important">8</span>
                            </a>

                            <ul
                                class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header"><i
                                        class="ace-icon fa fa-exclamation-triangle"></i> 8 Notifications
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                        <li><a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left"> <i
                                                            class="btn btn-xs no-hover btn-pink fa fa-comment"></i> New
                                                        Comments
                                                    </span> <span class="pull-right badge badge-info">+12</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li><a href="#"> <i class="btn btn-xs btn-primary fa fa-user"></i>
                                                Bob just signed up as an editor ...
                                            </a>
                                        </li>

                                        <li><a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left"> <i
                                                            class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                        New Orders
                                                    </span> <span class="pull-right badge badge-success">+8</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li><a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left"> <i
                                                            class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                                        Followers
                                                    </span> <span class="pull-right badge badge-info">+11</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer"><a href="#"> See all notifications <i
                                            class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="green"><a data-toggle="dropdown" class="dropdown-toggle"
                                             href="#"> <i
                                    class="ace-icon fa fa-envelope icon-animated-vertical"></i> <span
                                    class="badge badge-success">5</span>
                            </a>

                            <ul
                                class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header"><i class="ace-icon fa fa-envelope-o"></i>
                                    5 Messages</li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li><a href="#" class="clearfix"> <img
                                                    src="assets/avatars/avatar.png" class="msg-photo"
                                                    alt="Alex's Avatar" /> <span class="msg-body"> <span
                                                        class="msg-title"> <span class="blue">Alex:</span> Ciao
                                                        sociis natoque penatibus et auctor ...
                                                    </span> <span class="msg-time"> <i
                                                            class="ace-icon fa fa-clock-o"></i> <span>a moment ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li><a href="#" class="clearfix"> <img
                                                    src="assets/avatars/avatar3.png" class="msg-photo"
                                                    alt="Susan's Avatar" /> <span class="msg-body"> <span
                                                        class="msg-title"> <span class="blue">Susan:</span>
                                                        Vestibulum id ligula porta felis euismod ...
                                                    </span> <span class="msg-time"> <i
                                                            class="ace-icon fa fa-clock-o"></i> <span>20 minutes ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li><a href="#" class="clearfix"> <img
                                                    src="assets/avatars/avatar4.png" class="msg-photo"
                                                    alt="Bob's Avatar" /> <span class="msg-body"> <span
                                                        class="msg-title"> <span class="blue">Bob:</span> Nullam
                                                        quis risus eget urna mollis ornare ...
                                                    </span> <span class="msg-time"> <i
                                                            class="ace-icon fa fa-clock-o"></i> <span>3:15 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li><a href="#" class="clearfix"> <img
                                                    src="assets/avatars/avatar2.png" class="msg-photo"
                                                    alt="Kate's Avatar" /> <span class="msg-body"> <span
                                                        class="msg-title"> <span class="blue">Kate:</span> Ciao
                                                        sociis natoque eget urna mollis ornare ...
                                                    </span> <span class="msg-time"> <i
                                                            class="ace-icon fa fa-clock-o"></i> <span>1:33 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li><a href="#" class="clearfix"> <img
                                                    src="assets/avatars/avatar5.png" class="msg-photo"
                                                    alt="Fred's Avatar" /> <span class="msg-body"> <span
                                                        class="msg-title"> <span class="blue">Fred:</span>
                                                        Vestibulum id penatibus et auctor ...
                                                    </span> <span class="msg-time"> <i
                                                            class="ace-icon fa fa-clock-o"></i> <span>10:09 am</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer"><a href="inbox.html"> <?php echo $COOKIES['codeUsine'];?> <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

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

                    <li class=""><a href="#" class="dropdown-toggle"> <i
                                class="menu-icon fa fa-cogs"></i> <span class="menu-text">
                                Parametrage </span> <b class="arrow fa fa-angle-down"></b>
                        </a> <b class="arrow"></b>

                        <ul class="submenu">
                            <li id="MNU_MAREYEURS" class=""><a id="MAREYEURS" href="#"> <i
                                        class="menu-icon fa fa-caret-right"></i> Mareyeur
                                </a> <b class="arrow"></b>
                            </li>

                            <li id="MNU_CLIENTS" class=""><a id="CLIENTS" href="#"> <i
                                        class="menu-icon fa fa-desktop"></i> <span class="menu-text">
                                        Client </span>
                                </a> <b class="arrow"></b>
                            </li>

                            <li id="MNU_PRODUITS" class=""><a id="PRODUITS" href="#"> <i
                                        class="menu-icon fa fa-caret-right"></i> Produit
                                </a> <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                    
                    
                    <li class=""><a href="#" class="dropdown-toggle"> <i
                                class="fa fa-pencil fa-fw"></i> <span class="menu-text">
                                Bon d'Achat </span> <b class="arrow fa fa-angle-down"></b>
                        </a> <b class="arrow"></b>

                        <ul class="submenu">
                            <li id="AJOUTER_ACHATS" class=""><a id="ACHATS" href="#"> <i
                                        class="menu-icon fa fa-caret-right"></i> Nouveau
                                </a> <b class="arrow"></b>
                            </li>

                            <li id="LISTE_ACHATS" class=""><a id="CLIENTS" href="#"> <i
                                        class="menu-icon fa fa-desktop"></i> <span class="menu-text">
                                        Consulter liste </span>
                                </a> <b class="arrow"></b>
                            </li>
                           
                        </ul>
                    </li>
<!--                     <li class=""><a href="#" class="dropdown-toggle"> <i -->
<!--                                 class="fa fa-pencil fa-fw"></i> <span class="menu-text"> -->
<!--                                 Démoulage </span> <b class="arrow fa fa-angle-down"></b> -->
<!--                         </a> <b class="arrow"></b> -->
<!--                         <ul class="submenu"> -->
                            <li id="MNU_DEMOULAGE" class=""><a id="DEMOULAGES" href="#" class="dropdown-toggle"> <i
                                   class="menu-icon fa fa-pencil fa-fw"></i> <span class="menu-text">
                                        Démoulage </span>
                                </a> <b class="arrow"></b>
                           </li>
                            <li id="MNU_DEMOULAGE_LIST" class=""><a id="MNU_DEMOULAGE_LIST" href="#"> <i
                                        class="menu-icon fa fa-list"></i> <span class="menu-text">
                                        Stock Réel </span>
                                </a> <b class="arrow"></b>
                            </li>
<!--                         </ul> -->

                     <li class=""><a href="#" class="dropdown-toggle"> <i
                                class="menu-icon fa fa-list-alt"></i> <span class="menu-text">
                                Bon de Sortie </span> <b class="arrow fa fa-angle-down"></b>
                        </a> <b class="arrow"></b>
                        <ul class="submenu">
                            <li id="AJOUTER_SORTIE" class=""><a id="SORTIE" href="#"> <i
                                        class="menu-icon fa fa-caret-right"></i> Nouveau
                                </a> <b class="arrow"></b>
                            </li>

                            <li id="LISTE_SORTIE" class=""><a id="LISTESORTIE" href="#"> <i
                                        class="menu-icon fa fa-desktop"></i> <span class="menu-text">
                                        Consulter Liste </span>
                                </a> <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                      
                    <li class=""><a href="#" class="dropdown-toggle"> <i
                                class="menu-icon fa fa-pencil fa-fw"></i> <span class="menu-text">
                                Facture  </span>  <b class="arrow fa fa-angle-down"></b>
                        </a> <b class="arrow"></b>
                        <ul class="submenu">
                            <li id="AJOUTER_FACTURE" class=""><a id="FACTURE" href="#"> <i
                                        class="menu-icon fa fa-caret-right"></i> Nouveau
                                </a> <b class="arrow"></b>
                            </li>

                            <li id="LISTE_FACTURE" class=""><a id="LISTEFACTURE" href="#"> <i
                                        class="menu-icon fa fa-desktop"></i> <span class="menu-text">
                                        Consulter Liste </span>
                                </a> <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>



                      <li class=""><a href="#" class="dropdown-toggle"> <i
                                class="menu-icon fa fa-pencil fa-fw"></i> <span class="menu-text">
                                Reglement  </span>  <b class="arrow fa fa-angle-down"></b>
                        </a> <b class="arrow"></b>
                        <ul class="submenu">
                            <li id="REGLEMENT_ACHAT" class=""><a id="FACTURE" href="#"> <i
                                        class="menu-icon fa fa-caret-right"></i> Achat
                                </a> <b class="arrow"></b>
                            </li>

                            <li id="REGLEMENT_FACTURE" class=""><a id="LISTEFACTURE" href="#"> <i
                                        class="menu-icon fa fa-desktop"></i> <span class="menu-text">
                                        Facture </span>
                                </a> <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>


                    <li class=""><a href="calendar.html"> <i
                                class="menu-icon fa fa-calendar"></i> <span class="menu-text">
                                Consultations <span class="badge badge-transparent tooltip-error"
                                                    title="2 Important Events"> </span>
                            </span>
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

                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon"> <input type="text"
                                                                 placeholder="Search ..." class="nav-search-input"
                                                                 id="nav-search-input" autocomplete="off" /> <i
                                                                 class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div>
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

                $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/home/home.php", function () {

                });

                $("#MNU_PRODUITS").click(function (e) {
                	$("#MNU_PRODUITS").attr("Class", "active");
                    $("#MNU_MAREYEURS").attr("Class", "no-active");
                    $("#MNU_BORD").attr("Class", "no-active");
                    $("#MNU_CLIENTS").attr("Class", "no-active");
					$("#AJOUTER_ACHATS").attr("Class", "no-active");
					$("#LISTE_ACHATS").attr("Class", "no-active");
					$("#AJOUTER_SORTIE").attr("Class", "no-active");
					$("#AJOUTER_FACTURE").attr("Class", "no-active");
					$("#LISTE_FACTURE").attr("Class", "no-active");
					$("#LISTE_SORTIE").attr("Class", "no-active");
					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
					$("#MNU_DEMOULAGE").attr("Class", "no-active");
					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/produit/produitsVue.php", function () {
                    });

                });


                $("#MNU_MAREYEURS").click(function (e) {
                	$("#MNU_PRODUITS").attr("Class", "no-active");
                    $("#MNU_MAREYEURS").attr("Class", "active");
                    $("#MNU_BORD").attr("Class", "no-active");
                    $("#MNU_CLIENTS").attr("Class", "no-active");
					$("#AJOUTER_ACHATS").attr("Class", "no-active");
					$("#LISTE_ACHATS").attr("Class", "no-active");
					$("#AJOUTER_SORTIE").attr("Class", "no-active");
					$("#AJOUTER_FACTURE").attr("Class", "no-active");
					$("#LISTE_FACTURE").attr("Class", "no-active");
					$("#LISTE_SORTIE").attr("Class", "no-active");
					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
					$("#MNU_DEMOULAGE").attr("Class", "no-active");
					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/mareyeur/mareyeursVue.php", function () {
                    });
                });

                $("#MNU_CLIENTS").click(function (e) {
                	$("#MNU_PRODUITS").attr("Class", "no-active");
                    $("#MNU_MAREYEURS").attr("Class", "no-active");
                    $("#MNU_BORD").attr("Class", "no-active");
                    $("#MNU_CLIENTS").attr("Class", "active");
					$("#AJOUTER_ACHATS").attr("Class", "no-active");
					$("#LISTE_ACHATS").attr("Class", "no-active");
					$("#AJOUTER_SORTIE").attr("Class", "no-active");
					$("#AJOUTER_FACTURE").attr("Class", "no-active");
					$("#LISTE_FACTURE").attr("Class", "no-active");
					$("#LISTE_SORTIE").attr("Class", "no-active");
					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
					$("#MNU_DEMOULAGE").attr("Class", "no-active");
					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/client/clientsVue.php", function () {

                    });
                });

                $("#AJOUTER_ACHATS").click(function (e) {
                	$("#MNU_PRODUITS").attr("Class", "no-active");
                    $("#MNU_MAREYEURS").attr("Class", "no-active");
                    $("#MNU_BORD").attr("Class", "no-active");
                    $("#MNU_CLIENTS").attr("Class", "no-active");
					$("#AJOUTER_ACHATS").attr("Class", "active");
					$("#LISTE_ACHATS").attr("Class", "no-active");
					$("#AJOUTER_SORTIE").attr("Class", "no-active");
					$("#AJOUTER_FACTURE").attr("Class", "no-active");
					$("#LISTE_FACTURE").attr("Class", "no-active");
					$("#LISTE_SORTIE").attr("Class", "no-active");
					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
					$("#MNU_DEMOULAGE").attr("Class", "no-active");
					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatsVue.php", function () {

                    });
                });


                $("#US_LOGOUT").click(function () {
                    //alert($.cookie('userId') );
                    $.post("<?php echo App::getBoPath(); ?>/utilisateur/UtilisateurController.php", {ACTION: "<?php echo App::ACTION_SIGNOUT; ?>"}, function (data) {
                        if (data === '0') {
                            alert('Utilisateur dejadeconnecté');
                        } else {
                            var cookies = $.cookie();
                            $.each(cookies, function (k) {
                                $.removeCookie(k, {path: '/'});
                            });
                        }
                        window.location.replace("<?php echo App::getHome(); ?>");
                    });
                });

                $("#LISTE_ACHATS").click(function (e) {
                	$("#MNU_PRODUITS").attr("Class", "no-active");
                    $("#MNU_MAREYEURS").attr("Class", "no-active");
                    $("#MNU_BORD").attr("Class", "no-active");
                    $("#MNU_CLIENTS").attr("Class", "no-active");
					$("#AJOUTER_ACHATS").attr("Class", "no-active");
					$("#LISTE_ACHATS").attr("Class", "active");
					$("#AJOUTER_SORTIE").attr("Class", "no-active");
					$("#AJOUTER_FACTURE").attr("Class", "no-active");
					$("#LISTE_FACTURE").attr("Class", "no-active");
					$("#LISTE_SORTIE").attr("Class", "no-active");
					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
					$("#MNU_DEMOULAGE").attr("Class", "no-active");
					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/achat/achatListe.php", function () {

                    });
                });


                $("#AJOUTER_SORTIE").click(function (e) {
                	$("#MNU_PRODUITS").attr("Class", "no-active");
                    $("#MNU_MAREYEURS").attr("Class", "no-active");
                    $("#MNU_BORD").attr("Class", "no-active");
                    $("#MNU_CLIENTS").attr("Class", "no-active");
					$("#AJOUTER_ACHATS").attr("Class", "no-active");
					$("#LISTE_ACHATS").attr("Class", "no-active");
					$("#AJOUTER_SORTIE").attr("Class", "active");
					$("#AJOUTER_FACTURE").attr("Class", "no-active");
					$("#LISTE_FACTURE").attr("Class", "no-active");
					$("#LISTE_SORTIE").attr("Class", "no-active");
					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
					$("#MNU_DEMOULAGE").attr("Class", "no-active");
					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/bonSortie/bonSortieVue.php", function () {

                    });
                });

                $("#AJOUTER_FACTURE").click(function (e) {
                	 $("#MNU_PRODUITS").attr("Class", "no-active");
                     $("#MNU_MAREYEURS").attr("Class", "no-active");
                     $("#MNU_BORD").attr("Class", "no-active");
                     $("#MNU_CLIENTS").attr("Class", "no-active");
 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
 					$("#LISTE_ACHATS").attr("Class", "no-active");
 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
 					$("#AJOUTER_FACTURE").attr("Class", "active");
 					$("#LISTE_FACTURE").attr("Class", "no-active");
 					$("#LISTE_SORTIE").attr("Class", "no-active");
 					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/facturesVue.php", function () {

                    });
                });


                $("#LISTE_FACTURE").click(function (e) {
                	 $("#MNU_PRODUITS").attr("Class", "no-active");
                     $("#MNU_MAREYEURS").attr("Class", "no-active");
                     $("#MNU_BORD").attr("Class", "no-active");
                     $("#MNU_CLIENTS").attr("Class", "no-active");
 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
 					$("#LISTE_ACHATS").attr("Class", "no-active");
 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
 					$("#AJOUTER_FACTURE").attr("Class", "no-active");
 					$("#LISTE_FACTURE").attr("Class", "active");
 					$("#LISTE_SORTIE").attr("Class", "no-active");
 					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/facture/factureListe.php", function () {

                    });
                });
                
                $("#LISTE_SORTIE").click(function (e) {
                	 $("#MNU_PRODUITS").attr("Class", "no-active");
                     $("#MNU_MAREYEURS").attr("Class", "no-active");
                     $("#MNU_BORD").attr("Class", "no-active");
                     $("#MNU_CLIENTS").attr("Class", "no-active");
 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
 					$("#LISTE_ACHATS").attr("Class", "no-active");
 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
 					$("#AJOUTER_FACTURE").attr("Class", "no-active");
 					$("#LISTE_FACTURE").attr("Class", "no-active");
 					$("#LISTE_SORTIE").attr("Class", "active");
 					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/bonSortie/bonSortieListe.php", function () {

                    });
                });

                $("#REGLEMENT_FACTURE").click(function (e) {
                	 $("#MNU_PRODUITS").attr("Class", "no-active");
                     $("#MNU_MAREYEURS").attr("Class", "no-active");
                     $("#MNU_BORD").attr("Class", "no-active");
                     $("#MNU_CLIENTS").attr("Class", "no-active");
 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
 					$("#LISTE_ACHATS").attr("Class", "no-active");
 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
 					$("#AJOUTER_FACTURE").attr("Class", "no-active");
 					$("#LISTE_FACTURE").attr("Class", "no-active");
 					$("#LISTE_SORTIE").attr("Class", "no-active");
 					$("#REGLEMENT_FACTURE").attr("Class", "active");
 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/reglement/reglementFacture.php", function () {

                    });
                });

                $("#REGLEMENT_ACHAT").click(function (e) {
                	 $("#MNU_PRODUITS").attr("Class", "no-active");
                     $("#MNU_MAREYEURS").attr("Class", "no-active");
                     $("#MNU_BORD").attr("Class", "no-active");
                     $("#MNU_CLIENTS").attr("Class", "no-active");
 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
 					$("#LISTE_ACHATS").attr("Class", "no-active");
 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
 					$("#AJOUTER_FACTURE").attr("Class", "no-active");
 					$("#LISTE_FACTURE").attr("Class", "no-active");
 					$("#LISTE_SORTIE").attr("Class", "no-active");
 					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
 					$("#REGLEMENT_ACHAT").attr("Class", "active");
 					$("#MNU_DEMOULAGE").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/reglement/reglementAchat.php", function () {

                    });
                });

                $("#MNU_DEMOULAGE").click(function (e) {
                	 $("#MNU_PRODUITS").attr("Class", "no-active");
                     $("#MNU_MAREYEURS").attr("Class", "no-active");
                     $("#MNU_BORD").attr("Class", "no-active");
                     $("#MNU_CLIENTS").attr("Class", "no-active");
 					$("#AJOUTER_ACHATS").attr("Class", "no-active");
 					$("#LISTE_ACHATS").attr("Class", "no-active");
 					$("#AJOUTER_SORTIE").attr("Class", "no-active");
 					$("#AJOUTER_FACTURE").attr("Class", "no-active");
 					$("#LISTE_FACTURE").attr("Class", "no-active");
 					$("#LISTE_SORTIE").attr("Class", "no-active");
 					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
 					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
 					$("#MNU_DEMOULAGE").attr("Class", "active");
 					$("#MNU_DEMOULAGE_LIST").attr("Class", "no-active");
                     $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/demoulage/demoulage.php", function () {
                 });
                 });
                  $("#MNU_DEMOULAGE_LIST").click(function (e) {
                	  $("#MNU_PRODUITS").attr("Class", "no-active");
                      $("#MNU_MAREYEURS").attr("Class", "no-active");
                      $("#MNU_BORD").attr("Class", "no-active");
                      $("#MNU_CLIENTS").attr("Class", "no-active");
  					$("#AJOUTER_ACHATS").attr("Class", "no-active");
  					$("#LISTE_ACHATS").attr("Class", "no-active");
  					$("#AJOUTER_SORTIE").attr("Class", "no-active");
  					$("#AJOUTER_FACTURE").attr("Class", "no-active");
  					$("#LISTE_FACTURE").attr("Class", "no-active");
  					$("#LISTE_SORTIE").attr("Class", "no-active");
  					$("#REGLEMENT_FACTURE").attr("Class", "no-active");
  					$("#REGLEMENT_ACHAT").attr("Class", "no-active");
  					$("#MNU_DEMOULAGE").attr("Class", "no-active");
  					$("#MNU_DEMOULAGE_LIST").attr("Class", "active");
                     $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/demoulage/produitListe.php", function () {
                 });
                 });
                	
                	


            });
        </script>
    </body>
</html>
