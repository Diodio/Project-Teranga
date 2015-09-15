<?php
require_once 'common/app.php';
require_once '../lib/i18n/class/l18n.class.php';
$i18n = new I18n ();
if(!isset($_COOKIE['partnerLanguage'])){
    header('Location: '.App::getWebsmsPath());
    exit;
}
$partnerId = $_COOKIE['partnerId'];
if(!isset($_COOKIE['userId'])){
    header('Location: '.App::getWebsmsPath());  
    exit();  
}
if(isset($_COOKIE['userLanguage']))
    $lang = $_COOKIE['userLanguage'];
else
     $lang =  $_COOKIE['partnerLanguage'];
//$lang = 'en'; // peut etre une variable de session
if (!$i18n->setLang ( $lang, 'lang' )) {
	die ( "La traduction n'existe pas." );
}

$username = $_COOKIE['userContactName'];
$customerId = $_COOKIE['customerId'];
$userId = $_COOKIE['userId'];
$userProfil = $_COOKIE['userProfil'];
$partnerCode = $_COOKIE['partnerCode'];
// if($parId==1)
// {
$logo = "logo_orange.png";
$navcolor = "#000";
$ucolor = "#FF6600";

$pgTitleGuide = $i18n->getText('KEY_GUIDE');
$pgAllTemplates = $i18n->getText('KEY_ALL_TEMPLATES');
$char = $i18n->getText('KEY_CHAR');
$remain = $i18n->getText('KEY_REMAIN');
$expiree= $i18n->getText('KEY_EXPIRE');
$det= $i18n->getText('KEY_CDETAILS');
$pgHeureDeb= $i18n->getText('KEY_HEURE_DEBUT');
$pgDashboard= $i18n->getText('KEY_TITLE_DASHBOARD');
$pgStatistique= $i18n->getText('KEY_TITLE_STATISTIQUE');
$pgTitleMessage = $i18n->getText('KEY_TITLE_MESSAGES');
$pgTitleContact = $i18n->getText('KEY_TITLE_CONTACTS');
$pgTitleParametre = $i18n->getText('KEY_TITLE_PARAMETRES');
$pgTitleCorbeille = $i18n->getText('KEY_TITLE_CORBEILLE');
$pgTitleEnvoiMessage = $i18n->getText('KEY_TITLE_ENVOIEMESSAGE');
$pgTitleLancerCampagn = $i18n->getText('KEY_TITLE_LANCERCAMPAGNE');
$pgTitleMesMessages = $i18n->getText('KEY_TITLE_MESMESSAGES');
$pgTitleMesCampagns = $i18n->getText('KEY_TITLE_MESCAMPAGNS');
$pgTitleBrouillon = $i18n->getText('KEY_BROUILLON');
$pgTitleBoutique = $i18n->getText('KEY_BOUTIQUE');
$pgTitleFormMessage = $i18n->getText('KEY_NOUVEAU_MESSAGE');
$pgMessageObjet = $i18n->getText('KEY_OBJET');
$pgMessageExpediteur = $i18n->getText('KEY_EXPEDITEUR');
$pgMessageDestinataire = $i18n->getText('KEY_DESTINATAIRES');
$pgMessageGroupe = $i18n->getText('KEY_GROUPE');
$pgMonde = $i18n->getText('KEY_MONDE');
$pgMessageMessage = $i18n->getText('KEY_MESSAGE');
$pgMessageEnterMessage = $i18n->getText('KEY_ENTRER_MESSAGE');
$pgMessageEnvoyer = $i18n->getText('KEY_ENVOYER');
$pgMessageEnregistrer = $i18n->getText('KEY_ENREGISTRER');
$pgMessageAnnuler = $i18n->getText('KEY_ANNULER');
$pgMessageInserModel = $i18n->getText('KEY_INSERER_MODELE');
$pgMessageChoiModel = $i18n->getText('KEY_CHOISIR_UN_MODELE_DE_MESSAGE');
$pgMessageMesModel = $i18n->getText('KEY_MES_MODELES');
$pgMessageSelectionModel = $i18n->getText('KEY_SELECTIONER_CE_MODELE');
$pgMessageSelection = $i18n->getText('KEY_SELECTIONNER');
$pgSelectionExpediteur = $i18n->getText('KEY_SELECTIONNER_EXPEDITEUR');
$pgAjoutDestinataire = $i18n->getText('KEY_AJOUT_DESTINATAIRE');
$pgSelectGroupe = $i18n->getText('KEY_SELECT_GROUP');
$pgMessageVide = $i18n->getText('KEY_MESSAGE_VIDE');
$pgMessageEnvoiImmediat = $i18n->getText('KEY_MESSAGE_ENVOIE_IMMEDIAT');
$pgMessagePlanifDate = $i18n->getText('KEY_MESSAGE_PLANIFIER_DATE');
$pgMessageDateEnvoie = $i18n->getText('KEY_MESSAGE_DATE_ENVOIE');
$pgBienvenu = $i18n->getText('KEY_BIENVENU');
$pgParametre = $i18n->getText('KEY_PARAMETRES');
$pgProfile = $i18n->getText('KEY_PROFIL');
$pgDeconn = $i18n->getText('KEY_DECONNEXION');
$pgMonCompte = $i18n->getText('KEY_MON_COMPTE');
$pgRecherche = $i18n->getText('KEY_RECHERCHE');
$pgChoisirSignature = $i18n->getText('KEY_CHOISIR_SIGNATURE');
$pgChoisirCategorie = $i18n->getText('KEY_CHOISIR_CATEGORIE');
$pgUtilisateurDeconnecte = $i18n->getText('KEY_UTILISATEUR_DECONNECTE');
$pgTitleUser = $i18n->getText('KEY_TITLE_USER');
$pgAccueil = $i18n->getText('KEY_ACCUEIL');
$pgApplication = $i18n->getText('KEY_APPLICATION');

/*
 * } else { $logo="logo_2smobile.png"; $navcolor="#99A2AE"; $ucolor="#DF00A2"; }
 */


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />

<title>2SMOBILE</title>

<meta name="description" content="Common form elements and layouts" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--basic styles-->

<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="assets/css/select2.css" />

<!--[if IE 7]>
          <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

<!--page specific plugin styles-->
<link rel="stylesheet" href="assets/css/fullcalendar.css" />
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
<link rel="stylesheet" href="assets/css/chosen.css" />
<link rel="stylesheet" href="assets/css/datepicker.css" />
<link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="assets/css/msdropdown/dd.css" />
<link rel="stylesheet" href="assets/css/msdropdown/flags.css" />
<link rel="stylesheet" href="assets/css/intlTelInput.css" />
<link rel="stylesheet" href="assets/css/jquery-loader.css" />
<!--page specific plugin styles-->

<link rel="stylesheet" href="assets/css/jquery.gritter.css" />
<!--fonts-->

<link rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

<!--ace styles-->

<link rel="stylesheet" href="assets/css/ace.min.css" />
<link rel="stylesheet" href="assets/css/ace-responsive.min.css" />
<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="assets/css/smsprogress.css" />
<!--[if lte IE 8]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

<!--inline styles related to this page-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body style="z-index:-1;">
<!--    <div class="progress progress-striped" style="height: 9px; margin-bottom: 0px;">
        <div class="bar" role="progressbar" data-transitiongoal="100"></div>
    </div>-->
	<div class="navbar">
		<div class="navbar-inner" style="background-color:<?php echo $navcolor; ?>;">
			<div class="container-fluid">
				<a href="#" class="brand"> <small><img
						src="images/<?php echo $logo; ?>"></small>
				</a>
				<!--/.brand-->

				<ul class="nav ace-nav pull-right">
                                    
                                    <!--		<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="icon-tasks"></i>
								<span class="badge badge-grey" id="FORFAIT_RESTANT_NB_SMS">65 SMS</span>
							</a>

							<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
								<li class="nav-header">
									<i class="icon-ok" ></i>
                                                                        Forfait WEBSMS
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left"  id="FORFAIT_NAME">Total SMS</span>
											<span class="pull-right"  id="FORFAIT_NAME_STAT">90</span>
										</div>

										<div class="progress progress-mini " id="FORFAIT_NAME_PROGRESS">
											<div style="width:90%" class="bar" ></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left"  id="FORFAIT_ENVOYES_NB_SMS">SMS envoyes</span>
											<span class="pull-right">35</span>
										</div>

										<div class="progress progress-mini progress-danger"  id="FORFAIT_ENVOYES_NB_SMS_PROGRESS">
											<div style="width:35%" class="bar"></div>
										</div>
									</a>
								</li>

								

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left" id="FORFAIT_RESTANTS_NB_SMS">SMS restants</span>
											<span class="pull-right">65</span>
										</div>

										<div id="FORFAIT_RESTANTS_NB_SMS_PROGRESS" class="progress progress-mini progress-success progress-striped active">
											<div style="width:65%" class="bar"></div>
										</div>
									</a>
								</li>

								
							</ul>
						</li>
                                                -->

					<li class="grey"><a data-toggle="dropdown" class="dropdown-toggle"
						href="#"> <i class="icon-tasks"></i> <span
							class="badge badge-grey"><?php // echo $pgApplication; ?></span>
					</a>

                                            <ul id="all_apps"
							class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
							<li class="nav-header"><i class="icon-credit-card"></i><?php echo $pgApplication; ?> </li>
						</ul>
                                        </li>


					<li class="light-blue" style="background-color:<?php echo $ucolor; ?>;">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle"> <img
							class="nav-user-photo" src="assets/avatars/avatar2.png"
							alt="Jason's Photo" /> <span class="user-info"> <small> <?php printf($pgBienvenu); ?>,</small>
                                                        <span id="username_info"><?php echo $username; ?></span>
                                </span> <i class="icon-caret-down"></i>
					</a>
						<ul
							class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
							<li><a href="#" id="US_PARAM"> <i class="icon-cog"></i>
                                                               <?php printf($pgParametre); ?>
							</a></li>

							<li><a href="#" id="US_PROFIL"> <i class="icon-user"></i> <?php printf($pgProfile); ?>
							</a></li>

							<li class="divider"></li>

							<li><a href="#" id="US_LOGOUT"> <i class="icon-off"></i>
                                                               <?php printf($pgDeconn); ?>
							</a></li>
						</ul>
					</li>
				</ul>
				<!--/.ace-nav-->
			</div>
			<!--/.container-fluid-->
		</div>
		<!--/.navbar-inner-->
	</div>

	<div class="main-container container-fluid">
		<a class="menu-toggler" id="menu-toggler" href="#"> <span
			class="menu-text"></span>
		</a>

		<div class="sidebar" id="sidebar">
			<div class="sidebar-shortcuts" id="sidebar-shortcuts">
				<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					<button class="btn btn-small btn-success" data-rel="tooltip" data-placement="top" title="<?php printf($pgStatistique); ?>" id="SHORTCUT_STAT">
						<i class="icon-signal"></i>
					</button>

					<button class="btn btn-small btn-info" data-rel="tooltip" data-placement="top" title="<?php printf($pgTitleFormMessage); ?>" id="SHORTCUT_SEND_MSG">
						<i class="icon-pencil"></i>
					</button><button class="btn btn-small btn-warning" data-rel="tooltip" data-placement="top" title="<?php printf($pgTitleContact); ?>" id="SHORTCUT_CONTACT">
						<i class="icon-group"></i>
					</button>

					<button class="btn btn-small btn-danger" data-rel="tooltip" data-placement="top" title="<?php printf($pgTitleParametre); ?>" id="SHORTCUT_PARAM">
						<i class="icon-cogs"></i>
					</button>
				</div>

				<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
					<span class="btn btn-success"></span> <span class="btn btn-info"></span>

					<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
				</div>
			</div>
			<!--#sidebar-shortcuts-->

			<ul class="nav nav-list">

				<li id="MNU_DBD"><a href="#" id="DBD_VIEW"> <i
						class="icon-dashboard"></i> <span class="menu-text"> <?php printf($pgStatistique); ?>
					</span>
				</a></li>

				<li id="MNU_MSG"><a href="#" class="dropdown-toggle"> <i
						class="icon-desktop"></i> <span class="menu-text"> <?php printf($pgTitleMessage ); ?> </span>

						<b class="arrow icon-angle-down"></b>
				</a>

					<ul class="submenu">
						<li id="MNU_MSG_SEND"><a href="#" id="MSG_SEND"> <i
								class="icon-double-angle-right"></i> <?php printf($pgTitleEnvoiMessage  ); ?>
						</a></li>
						<li id="MNU_MSG_CPG"><a href="#" id="MSG_CPG"> <i
								class="icon-double-angle-right"></i> <?php printf($pgTitleLancerCampagn  ); ?>
						</a></li>
						<li id="MNU_MSG_LIST"><a href="#" id="MSG_LIST"> <i
								class="icon-double-angle-right"></i> <?php printf($pgTitleMesMessages  ); ?>
						</a></li>
						<li id="MNU_CPG_LIST"><a href="#" id="CPG_LIST"> <i
								class="icon-double-angle-right"></i> <?php printf($pgTitleMesCampagns  ); ?>
						</a></li>
						<li id="MNU_MSG_DRAFT"><a href="#" id="MSG_DRAFT"> <i
								class="icon-double-angle-right"></i> <?php printf($pgTitleBrouillon  ); ?> <span
								class="badge badge-primary hide" id="LB_DRAFT_INDIC">0</span>
						</a></li>
					</ul></li>
				<!--End MNU_MSG -->
				<li id="MNU_CON"><a href="#" id="CON_VIEW"> <i class="icon-group"></i>
						<span class="menu-text"> <?php printf($i18n->getText('KEY_CONTACTS')); ?> </span>
				</a></li>
				<!--End MNU_CARNET 
				<li id="MNU_CAL"><a href="#" id="CAL_VIEW"> <i class="icon-calendar"></i>
						<span class="menu-text"> Agenda </span>
				</a></li>-->
				<!--End MNU_AGENDA -->
				<li id="MNU_PARAM"><a  href="#" id="PAR_VIEW"> <i class="icon-cog"></i>
						<span class="menu-text"> <?php printf($pgTitleParametre); ?> </span>
				</a></li>
				<!--End MNU_PARAM -->
<!--				<li id="MNU_SHOP"><a href="#" id="SHOP_VIEW"> <i
						class="icon-dashboard"></i> <span class="menu-text"> <?php printf($pgTitleBoutique); ?> </span>
				</a></li>-->
				<!--End MNU_SHOP -->

				<li id="MNU_TRASH"><a href="#" id="TRASH_VIEW"> <i
						class="icon-trash"></i> <span class="menu-text"> <?php printf($pgTitleCorbeille); ?> </span>
				</a></li>
                                <?php if($userProfil=='ADM'){ ?>
				<li id="MNU_USER"><a href="#" id="USER_VIEW"> <i
						class="icon-user"></i> <span class="menu-text"> <?php printf($pgTitleUser); ?> </span>
				</a></li>
                                <?php } ?>
                                
                                <li id="MNU_GUIDE"><a href="#" id="GUIDE_VIEW"> <i
						class="icon-list-ul"></i> <span class="menu-text"> Guides </span>
				</a></li>


			</ul>
			<!--/.nav-list-->

			<div class="sidebar-collapse" id="sidebar-collapse">
				<i class="icon-double-angle-left"></i>
			</div>
		</div>

		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs">
				<ul class="breadcrumb" id="MENU_HAUT">
					<li><i class="icon-home home-icon"></i> <a href="#" id="BC_ACCUEIL"><?php printf($pgAccueil); ?> </a>

						<span class="divider"> <i class="icon-angle-right arrow-icon"></i>
					</span></li>

					
					<li class="active"><?php echo $pgStatistique; ?></li>
				</ul>
				<!--.breadcrumb-->

<!--				<div class="nav-search" id="nav-search">
					<form class="form-search" />
					<span class="input-icon"> <input type="text"
						placeholder="<?php echo $pgRecherche; ?> ..." class="input-small nav-search-input"
						id="nav-search-input" autocomplete="off" /> <i
						class="icon-search nav-search-icon"></i>
					</span>
					</form>
				</div>-->
				<!--#nav-search-->
			</div>

			<div class="page-content">

				<div id="MAIN_CONTENT"></div>
				<div id="winContainer"></div>

			</div>
			<!--/.page-content-->
		</div>
		<!--/.main-content-->
	</div>
	<!--/.main-container-->
        <a href="#" id="btn-scroll-up" style="margin-left:-10px;"
		class="btn-scroll-up btn btn-small btn-inverse"> <i
		class="icon-double-angle-up icon-only bigger-110"></i>
	</a>




	<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<!--New Message    -->
	<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<div id="winMessage" class="widget-box hide"
		style="width: 550px; position: fixed; bottom: 0; right: 0; z-index: 12 !important; margin-right: 20px; box-shadow: 0 0 4px grey;">
	
            <div id="windowHeader"
			class="widget-header widget-header-small header-color-grey">
                <h6 style="width:25%;">
				<i class="icon-p        encil"></i> <?php printf($pgTitleFormMessage); ?>
			</h6>
			<div class="widget-toolbar">
				<a href="#" data-action="reload"> <i class="icon-refresh"></i>
				</a> 
<!--                            <a href="#" data-action="collapse"> <i
					class="icon-chevron-down"></i>
				</a> -->
                            <a href="#" data-action="close"> <i class="icon-remove"></i>
				</a>
			</div>
		</div>

		<div style="overflow: hidden; width:100%;" class="widget-body">
			<div class="widget-main padding-4">
				<div data-height="360" data-spy="scroll"
					style="overflow: auto; position: relative; height: 360px;"
					data-target=".content">                                    
					<div id="MSG_CTN" class="content">
                      <form id="FRM_MSG" class="form-horizontal" style="margin-bottom: 0px;">	
						<div class="row-fluid">
							<div class="span12">
								
									<div class="control-group">
										<label class="control-label" for="msgSubject"><?php printf($pgMessageObjet); ?></label>
										<div class="controls">
											<input class="span12" type="text" id="msgSubject"
												name="subject" placeholder="" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="msgFrom"><?php printf($pgMessageExpediteur); ?></label>
										<div class="controls">
                                                                                    <select  class="span6" id="msgFrom" name="signature"
												data-placeholder="<?php echo $pgChoisirSignature; ?>">
												<option value="-1" class="signature"></option>

											</select>
										</div>
									</div>
									<div class="control-group depend">
										<label class="control-label" for="msgDA"><?php printf($pgMessageDestinataire); ?></label>
										<div class="controls">
											<input class="span12" type="text" id="msgDA"
												name="recipients" placeholder="" />
										</div>
									</div>
									<div class="control-group depend">
										<label class="control-label" for="form-field-select-4"><?php printf($pgMessageGroupe); ?></label>
										<div class="controls">
											<select class="span12 populate placeholder select2-offscreen"
											      multiple="" id="msgGroupe" name="groupes" data-placeholder="">
												<option value="-1" class="groups"></option>
												<option value="*" class="groups"><?php printf($pgMonde); ?></option>
											</select>

										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="msgText"><?php printf($pgMessageMessage); ?></label>
										<div class="controls">
											<textarea class="span12" rows="4" id="msgText" name="content"
												placeholder="<?php printf($pgMessageEnterMessage); ?>"></textarea>
                                                                                        <div class="progress sms-progress progress-success" id="progress" data-for="message" style="width: 100%;">
                                                                                                <div id="progressbar" class="bar" style="width: 0%; visibility: visible;"></div>
                                                                                        </div>
                                                                                        <span class="sms-info" id="sms-info" data-for="message">
                                                                                                <span id="count" class="characters" data-for="message">0</span> 
                                                                                                <span class="characters-postfix" data-for="message"><?php printf($char); ?></span>
                                                                                                <span class="characters-plural" data-for="message"></span>
                                                                                                <span class="main parts-warning" data-for="message" style="display: none;">
                                                                                                        <span class="parts" data-for="message" style="visibility: visible;">1</span> 
                                                                                                        <span class="parts-warning-postfix" data-for="message" style="visibility: visible;">messages</span>
                                                                                                </span>
                                                                                                <span id="chars-left" class="main chars-left" data-for="message">160</span> 
                                                                                                <span class="chars-left-postfix" data-for="message"></span>
                                                                                                <span class="chars-left-postfix-postfix" data-for="message"><?php printf($remain); ?></span>
                                    
                                                                                        </span>
										</div>
									</div>


									<div class="controls">
										<span class="span12"> <label class="blue"> <input
												id="sendNow_radio" name="sendingType" 
												value="I" type="radio" checked="true"  /> <span class="lbl"
												id="EXISTENT_GROUP_LABEL"> <?php printf($pgMessageEnvoiImmediat); ?></span>
										</label> <label class="blue"> <input id="sendSchedule_radio"
												name="sendingType" value="P" type="radio" /> <span
												class="lbl" id="NEW_GROUP_LABEL"> <?php printf($pgMessagePlanifDate); ?> </span>
                                                                                        <div class="span10" id="date_envoi"
													style="margin-left: 20px; margin-top: 5px;">

													<div class="span8">
														<div class="control-group">
															<div class="input-append datepicker">
																<label><h6><?php printf($pgMessageDateEnvoie); ?></h6></label> <input
																	class="span10 date ignore " id="msg_dtStartSending"
																	name="sendingDate" type="text"
																	data-date-format="dd-mm-yyyy" />
                                                                                                                                <span class="add-on">
                                                                                                                                        <i class="icon-calendar"></i>
																</span>
															</div>
														</div>
													</div>
													<!--/.span2-->
													<div class="vspace-6"></div>
													<div class="span2">
														<div class="input-append bootstrap-timepicker" style="margin-left: -3px;margin-top: 4px;">
															<label><h6><?php printf($pgHeureDeb); ?></h6></label> <input
																id="msg_tmStartSending" name="sendingTime" type="text"
																class="timepicker-default input-small" /> <span class="add-on"> <i
																class="icon-time"></i>
															</span>
														</div>
													</div>
													<!--/.span2-->


												</div>
										</label>
										</span>
									</div>


								

							</div>
							<!--/.span12-->
						</div>
						<!--/row-fluid-->
                      </form>
					</div>
					<div id="TPL_CTN" class="content hide">


						<div class="widget-box transparent">
							<div class="widget-header widget-header-small">
                                                            <h4 class="blue smaller" style="width:280px;">
									<i class="icon-rss orange"></i> <?php printf($pgMessageChoiModel); ?>
								</h4>
								<div style="width: 0px; position: relative; left: 82px"
									align="left">
									<select id="TPL_CMB" data-placeholder="<?php echo $pgChoisirCategorie; ?>"
										style="width: 175px">
                                                                                <option value="A" class="template"> <?php printf($pgAllTemplates); ?></option>
										<option value="U" class="template"><?php printf($pgMessageMesModel); ?></option>
									</select>
								</div>

							</div>

							<div class="widget-body" data-height="250" data-spy="scroll"
								style="overflow: auto; position: relative; /*height: 250px;*/"
								data-target="widget-main">
								<div class="widget-main padding-8">
                                                                    <div id="templateItems" class="profile-feed" ></div>
									<div id="tplItem" class="profile-activity clearfix hide " >
                                                                                    <div class="controls dropdown-toggle tooltip-info" data-rel="tooltip" data-placement="top" title="">
                                                                                        <input name="RADIO_TPL" type="radio" id="id" value="0" />
                                                                                        <span class="lbl ">
                                                                                            <span  id="title" style="font-size: 15px; font-weight:bold; margin-left: 5px;"></span> - 
                                                                                            <span id="description"></span></span>
                                                                                    
                                                                                    </div>
<!--											<div class="controls">
												 <span
													class="lbl"> <?php printf($pgMessageSelectionModel); ?></span>
											</div>-->

									</div>
								</div>
							</div>
						</div>

					</div>
					<!--/content-->
				</div>
				<!--/slim-scroll-->
			</div>
			<!--/widget-main-->
			<div class="widget-toolbox padding-8 clearfix" style="bottom: 0"
				id="TOOLBAR_MSG">
				<button id="FRM_MSG_SEND" class="btn btn-mini btn-primary pull-left">
					<i class="icon-ok"></i> <?php printf($pgMessageEnvoyer); ?>
				</button>
				&nbsp; &nbsp;
				<button id="FRM_MSG_SAVE" class="btn btn-mini btn-primary">
					<i class="icon-save"></i> <?php printf($pgMessageEnregistrer); ?>
				</button>
				&nbsp; &nbsp;
				<button id="FRM_MSG_CANCEL" class="btn btn-mini btn-danger">
					<i class="icon-trash"></i>  <?php printf($pgMessageAnnuler); ?>
				</button>
				<div class="btn-group pull-right dropup">
					<button id="FRM_TPL" class="btn btn-small btn-warning">
						<i class=" icon-comments-alt"></i> <?php printf($pgMessageInserModel); ?>
					</button>
				</div>
				<!--/btn-group-->
			</div>
			<div class="widget-toolbox padding-8 clearfix hide" style="bottom: 0"
				id="TOOLBAR_TPL">
				<button id="FRM_TPL_SELECT"
					class="btn btn-mini btn-primary pull-left">
					<i class="icon-ok"></i>  <?php printf($pgMessageSelection); ?>
				</button>
				&nbsp; &nbsp;
				<button id="FRM_TPL_CANCEL" class="btn btn-mini btn-danger">
					<i class="icon-trash"></i>  <?php printf($pgMessageAnnuler); ?>
				</button>
				<!--/btn-group-->
			</div>
		</div>
           
	</div>
	<!--/End window New Message-->


	<!--basic scripts-->

	<!--[if !IE]>-->
<!--	<script
		src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->
	<!--<![endif]-->
	<!--[if IE]>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <![endif]-->
	<!--[if !IE]>-->
	<script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");</script>
	<!--<![endif]-->
	<!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
	<script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");</script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!--page specific plugin scripts-->

	<!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->
<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
	<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
	<script src="assets/js/jquery.gritter.min.js"></script>
	<script src="assets/js/spin.min.js"></script>

	<!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->

	<script src="assets/js/chosen.jquery.min.js"></script>
	<script src="assets/js/chosen.jquery.js" type="text/javascript"></script>
	<script src="assets/js/fuelux/fuelux.wizard.min.js"></script>
	<script src="assets/js/fuelux/fuelux.spinner.min.js"></script>
	<script src="assets/js/x-editable/bootstrap-editable.min.js"></script>
	<script src="assets/js/x-editable/ace-editable.min.js"></script>

	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/date-time/bootstrap-timepicker.min.js"></script>
	<script src="assets/js/date-time/moment.min.js"></script>
	<script src="assets/js/date-time/daterangepicker.min.js"></script>
	<script src="assets/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/js/jquery.knob.min.js"></script>
	<script src="assets/js/jquery.autosize-min.js"></script>
	<script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
	<script src="assets/js/jquery.maskedinput.min.js"></script>
	<script src="assets/js/bootstrap-tag.min.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/date.js"></script>
	<script src="assets/js/additional-methods.min.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/select2.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
	<script src="assets/js/jquery.sparkline.min.js"></script>
	<script src="assets/js/flot/jquery.flot.min.js"></script>
	<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/js/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/js/bootstrap-modal-popover.js"></script>
        <script src="assets/js/underscore.js"></script>
        <script src="assets/js/jQuery.Spin.js"></script>
        <script src="assets/js/jquery-loader.js"></script>
	<!--ace scripts-->
	<script src="assets/js/ace-elements.min.js"></script>
	<script src="assets/js/ace.min.js"></script>
	<!--inline scripts related to this page-->
	
	<script src="assets/js/jquery.loadJSON.js"></script>	
	<script src="assets/js/msdropdown/jquery.dd.js"></script>
	<script src="assets/js/intlTelInput.js"></script>
        <script src="assets/js/utils.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-progressbar.js"></script>
        
	
	<!--  start import  scripts -->
    <script src="assets/js/import/csv.js"></script>
    <script src="assets/js/import/jszip.js"></script>
    <script src="assets/js/import/xlsx.js"></script>
    <script src="assets/js/import/json.js"></script>
    <script src="assets/js/import/import.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <script src="assets/js/jquery.md5.js"></script>
    
    
    <script src="assets/js/domains.js"></script>
    <!-- end import  scripts  -->

	<script type="text/javascript">
	        $(document).ready(function() {
                    getDraftIndicator();
                });
            loadCustomerAccountExpirationDate = function( customertId)
                {
                   $.post("<?php echo App::getBoPath(); ?>/customer/CustomerController.php", {customerId: customertId, ACTION: "<?php echo App::ACTION_GET_CUSTOMER_ACCOUNT_EXPIRATION_DATE; ?>"}, function(data) {
                            data = $.parseJSON(data);
                            if(data==-1){
                                    
                                }

                        });
                };
           //   loadCustomerAccountExpirationDate("<?php echo $customerId; ?>"); 
                 loadUserAccount = function( customertId)
            {
               $.post("<?php echo App::getBoPath(); ?>/customer/CustomerController.php", {customerId: "<?php echo $customerId; ?>", ACTION: "<?php echo App::ACTION_GET_CUSTOMER_ACCOUNT; ?>"}, function(data) {
                        data = $.parseJSON(data);
                        accountId=data.id; 
                        $('#remainingNumberOfSms').text(data.remainingNumberOfSms);
                        $('#subscriptionType').text(data.subscriptionType);
                        $('#product').text(data.product);
                        $('#accountExpirationDate').text(data.expirationDate);
                        var subscribe_type;
                        if(data.subscriptionType == 'POSTPAID'){
                            $('#bloc-date,#Bloc-Sms').hide();
                                subscribe_type = 2;     
                        }
                        else if(data.subscriptionType == 'PREPAID'){
                                subscribe_type = 1;
                        }
                      
                        });
                };  
                //verifier si la session n'est pas expiree
                //a appeler dans chaque fonction qui appele le controlleur
                function checkCookie(){
                       if($.cookie('userId')==null || $.cookie('customerId')==null){ 
                        bootbox.alert("<?php echo $expiree; ?>", function(result) {
                         if (result) {
                             var url = "<?php  echo \App::getHome();?>";
                             document.location.href=url;
                         }});}
                   };
                        
                var countForm = 0;
                var link="";
                var gStatTimer;
                var campaignId =0;
                var jsonMerge="";
                var nbmessage = 1;
		var counter = 1;
                var max_numb_of_words = 160;
                $.fn.editable.defaults.mode = 'popup';
                $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
                $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>' +
                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';
                // page par defaut
                swap();
                   // $.loader.open();
                    mnu_selected_id = "#MNU_DBD";
                    mnu_selected_parent_id = "";
                    $("#MNU_DBD").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/stats/stat.php", function() {
                       // $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/stats/stat.php";
                    });
                // fin page par defaut 
                //< !--USER ACTIONS -- >
                getAllApplication=function(){
                    $.post("<?php echo App::getBoPath(); ?>/common/SubscriptionController.php", {customerId: "<?php echo $customerId; ?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(data) 
                      {
                          if(data.rc==1){
                            $.each(data.infos, function(key, value){
                                appli=$('<li><a href="#"><div class="clearfix"><span class="pull-left"> <i class="btn btn-mini no-hover btn-success icon-envelope"></i>'+value.intitule+'</span> <span class="pull-right badge badge-success">'+value.title+'</span></div></a></li>');
                                 appli.click(function(){
                                     document.location.href='<?php echo App::getHome(); ?>/'+value.link;
                                 });
                                $('#all_apps').append(appli);
                            });
                            detail=$('<li><a href="#"> <?php echo $det; ?> <i class="icon-arrow-right"></i></a></li>');
                            $('#all_apps').append(detail);
                        }
                      }, "json");
                }
                getAllApplication();
                getDraftIndicator = function ()
                {
                    $.post("<?php echo App::getBoPath(); ?>/message/DraftController.php", {userId: "<?php echo $userId; ?>", partnerCode:<?php echo $partnerCode; ?>,ACTION: "<?php echo App::ACTION_COUNT; ?>"}, function(data) 
                      {
                		setDraftIndicator(data.count);
                      }, "json");
                }
                

                setDraftIndicator = function (nbDraft)
                {
                    $('#LB_DRAFT_INDIC').text(nbDraft);                    
                    if (nbDraft == 0)
                    {
                    	$('#LB_DRAFT_INDIC').hide();
                    }
                    else
                    {
                    	$('#LB_DRAFT_INDIC').show();
                    }
                }

                function setScroll(sHeight) {
                    $('.slim-scroll').each(function() {
                        var $this = $(this);
                        $this.slimScroll({
                        height: $this.data('height') || sHeight,
                        railVisible: true
                        });
                    });
                }
 
                $("#US_PARAM").click(function() {
                    checkCookie();
                    $.loader.open();
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/user/param.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/user/param.php";
                    });
                    
                });
                $("#US_PROFIL").click(function(){
                    checkCookie();
                    $.loader.open();
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/user/param.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/user/param.php";
                    });
//                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/user/profil.php", function() {
//                    link="<?php echo App::getHome(); ?>/app/user/profil.php";
//                    });
                });
                $("#US_LOGOUT").click(function(){
                    //alert($.cookie('userId') );
                    $.post("<?php echo App::getBoPath(); ?>/customer/UserController.php", { ACTION: "<?php echo App::ACTION_SIGNOUT; ?>"}, function(data) {
                        if(data==='0'){
                            alert('<?php echo $pgUtilisateurDeconnecte; ?>');
                        }else{
                            var cookies=$.cookie();
                            $.each(cookies, function(k){
                                $.removeCookie(k, { path: '/' });
                                //$.removeCookie(k,null, { path: '/' });
                            });
                        }
                                           // alert($.cookie('userId') );

                        window.location.replace("<?php echo App::getHome(); ?>");
                    });
                });
                
                //< !--USER ACTIONS END-->

                //< !--BREADCRUMBS ACTIONS -- >

                $("#BC_ACCUEIL").click(function(){
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_DBD";
                    mnu_selected_parent_id = "";
                    $("#MNU_DBD").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/stats/stat.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/stats/stat.php";
                    });
                });
                
                //< !--BREADCRUMBS ACTIONS END-->

                //<!--SHORTCUT ACTIONS -->
                                     
                $("#SHORTCUT_STAT").click(function(e){
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_DBD";
                    mnu_selected_parent_id = "";
                    $("#MNU_DBD").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/stats/stat.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/stats/stat.php";
                    });
                    
                });
                $("#SHORTCUT_SEND_MSG").click(function()
                {
                    messageForm('<?php echo App::ACTION_INSERT; ?>',null);                    
                });

		  messageForm = function (ACTION, messageId, content)
                {
                   
                    var nWin = countForm++;
                    var winMessage_id = 'winMessage' + nWin;
                    var frmMessage_id='FRM_MSG'+nWin;
                    var msgFrom_id='msgFrom'+nWin;
                    var newMessage = $('#winMessage').clone(true, true).attr('id', winMessage_id);
                    newMessage.find('#FRM_MSG').attr('id', frmMessage_id);
                    newMessage.find("#msgGroupe").select2(
                        {placeholder: "Select groups",
                        tokenSeparators: [";", ",", " "]}
                    );
                    if(typeof content !== "undefined"){
                        newMessage.find('#msgText').text(content);
                        var count= content.length; 
                        main=count * 100;
                        var value= (main / (max_numb_of_words * nbmessage));
                        
                        newMessage.find('#count').html(count);
                        chart_left = (max_numb_of_words * nbmessage) - count;
                        newMessage.find('#chars-left').html( chart_left );
                        newMessage.find('#progressbar').animate(
                        {
                            "width": value+'%'
                        }, 0);
                        }
                    newMessage.find("#msgFrom").select2();
                    newMessage.find("#TPL_CMB").select2();

                    newMessage.find('#msg_dtStartSending').datepicker({
                            autoclose: true,
                            orientation: 'auto',
                            todayHighlight:true,
                            language:'<?php echo $lang; ?>'
                        }).datepicker("setDate", new Date());
                     
                    newMessage.find('#msg_tmStartSending').timepicker({
                		minuteStep: 1,
                                template: 'dropdown',
                		showSeconds: false,
                		showMeridian: false
                	});  
                        if(ACTION!='<?php echo App::ACTION_UPDATE; ?>')
                        {
                                $.post( "<?php echo App::getBoPath(); ?>/group/GroupController.php", {userId: "<?php echo $userId; ?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(data) {
                                        newMessage.find("#msgGroupe").loadJSON('{"groups":'+data+'}');
                                }).error(function(error) {  checkCookie(); });               	

                                $.post( "<?php echo App::getBoPath(); ?>/customer/SignatureController.php", {customerId: "<?php echo $customerId; ?>", ACTION: "<?php echo App::ACTION_LIST_VALID; ?>"}, function(data) {
                                        newMessage.find("#msgFrom").loadJSON('{"signature":'+data+'}');
                                }).error(function(error) {  checkCookie(); });						

                                $.post( "<?php echo App::getBoPath(); ?>/common/TemplateCategoryController.php", {partnerId: "<?php echo $partnerId?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(data) {
                                        newMessage.find("#TPL_CMB").loadJSON('{"template":'+data+'}');
                                });					
                        }
                    
                    newMessage.find('#date_envoi').hide();
                    newMessage.find('#sendNow_radio').bind("click", function() { 
//                        if($(this).attr('checked')){
                            newMessage.find('#date_envoi').hide();
//                        }
                    }); 
                    newMessage.find('#sendSchedule_radio').bind("click", function() { 
//                        if($(this).attr('checked')){
//                            alert('cool');
                            newMessage.find('#date_envoi').show();
//                        }
                    }); 
                    
                    newMessage.find('#FRM_MSG_SEND').bind("click", function() { 
                        
                        messageValidation(messageId,'<?php echo App::ACTION_SEND; ?>',frmMessage_id,winMessage_id,nWin);
                    }); 
                    newMessage.find('#FRM_MSG_SAVE').bind("click", function() {
//                        $('#'+winMessage_id).loader();
                        messageProcess(messageId,'<?php echo App::ACTION_DRAFT; ?>',frmMessage_id,winMessage_id,nWin);
                    }); 
                    newMessage.find('#FRM_MSG_CANCEL').bind("click", function() {
                    	 $('#' + winMessage_id).remove();
                    });

                    newMessage.find('#FRM_TPL_SELECT').bind("click", function() {                   	            
                    	var tpl=$('input[name=RADIO_TPL]:radio:checked').parent().find('#description').text();
                        newMessage.find('#msgText').val(tpl);
                        $('#MSG_CTN'+nWin).show();
                    	$('#TPL_CTN'+nWin).hide();                   		
                    	$('#TOOLBAR_MSG'+nWin).show();
                        $('#TOOLBAR_TPL'+nWin).hide();  
                        main=tpl.length * 100;
                        var value= (main / (max_numb_of_words * nbmessage));
                        var count= tpl.length; 
			$('#'+frmMessage_id+' #count').html(count);
                        chart_left = (max_numb_of_words * nbmessage) - tpl.length;
                        $('#'+frmMessage_id+' #chars-left').html( chart_left );
                        $('#'+frmMessage_id+' #progressbar').animate(
			{
                            "width": value+'%',
			}, 0);
	                });
                    newMessage.find('#FRM_TPL_CANCEL').bind("click", function() {
                    	$('#MSG_CTN'+nWin).show();
                    	$('#TPL_CTN'+nWin).hide();
                   		
                    	$('#TOOLBAR_MSG'+nWin).show();
                        $('#TOOLBAR_TPL'+nWin).hide();                   		
	                });
                    newMessage.find('#TPL_CTN').attr('id', 'TPL_CTN' + nWin);
                    newMessage.find('#MSG_CTN').attr('id', 'MSG_CTN' + nWin);
                    newMessage.find('#TOOLBAR_TPL').attr('id', 'TOOLBAR_TPL' + nWin);
                    newMessage.find('#TOOLBAR_MSG').attr('id', 'TOOLBAR_MSG' + nWin);

                    newMessage.find('#FRM_TPL').bind("click", function() {
                        $('#TPL_CTN'+nWin).show();
                   		$('#MSG_CTN'+nWin).hide();
                   		$('#TOOLBAR_TPL'+nWin).show();
                   		$('#TOOLBAR_MSG'+nWin).hide();
                    });
                    
                   
                    newMessage.find('#msgText').on('keyup focus',function()
					
		{
			
			var text_area_box =$(this).val();			
			

			if(nbmessage == 1) {
				if(text_area_box.length > max_numb_of_words) {
					nbmessage = nbmessage + 1;
					$('#'+frmMessage_id+' .main').removeAttr( 'style' ); 
					$('#'+frmMessage_id+' .parts').html( nbmessage );
				}
			}
			if(nbmessage >= 2) {
				if(text_area_box.length > (max_numb_of_words * nbmessage)) {
					nbmessage = nbmessage + 1;
					$('#'+frmMessage_id+' .main').removeAttr( 'style' );
					$('#'+frmMessage_id+' .parts').html( nbmessage );
				}
                                if(text_area_box.length <= (max_numb_of_words * (nbmessage-1))){
                                        nbmessage = nbmessage - 1;
                                        $('#'+frmMessage_id+' .main').removeAttr( 'style' );
                                        $('#'+frmMessage_id+' .parts').html( nbmessage );
                                }
				
			}
                        
                        var main = text_area_box.length*100;
			
			var value= (main / (max_numb_of_words * nbmessage));
                        var count= text_area_box.length; 
		
			$('#'+frmMessage_id+' #count').html(count);
			
			$('#'+frmMessage_id+' #progressbar').animate(
			{
			"width": value+'%',
			}, 0);
                        chart_left = (max_numb_of_words * nbmessage) - text_area_box.length;
                        $('#'+frmMessage_id+' #chars-left').html( chart_left );
                        
                       
                        if(chart_left < 20) {                             
                             $('#'+frmMessage_id+' #progress').removeClass().addClass("progress sms-progress progress-danger"); 
                             $('#'+frmMessage_id+' #chars-left').removeClass().addClass("chars-left error");
                              
                        }
                        else 
                            if(chart_left < 50) {
                                $('#'+frmMessage_id+' #progress').removeClass().addClass("progress sms-progress progress-warning");
                                $('#'+frmMessage_id+' #chars-left').removeClass().addClass("chars-left warning");
                            }
                        else  {
                                $('#'+frmMessage_id+' #progress').removeClass().addClass("progress sms-progress progress-success");
                                $('#'+frmMessage_id+' #chars-left').removeClass().addClass("main chars-left");
                            }
                        
                             
                        
		});
                                        
                    $('#winContainer').append(newMessage); 
                   
                    
                    loadTemplate("A");    
                                        
                    newMessage.find('#TPL_CMB').bind("change", function() {
                        loadTemplate($("#TPL_CMB").val());                        
                    });
                    
                    $('#' + winMessage_id).show();
                    var lastResults = [];
					
                    newMessage.find('#msgDA').select2({
                        tags: [""],
                        tokenSeparators: [";", ",", " "],
                        //Allow manually entered text in drop down when no matches found                        
                        createSearchChoice:function(term) { 
                            if ($(lastResults).filter(function() {
                                strValue = this.VALUE+'';
                                return strValue.localeCompare(term)===0; 
                            }).length===0) {
                                return {id:term, VALUE:term};
                            } },
                        minimumInputLength: 2,
                    	ajax: {
                    		url: "<?php echo App::getBoPath(); ?>/contact/ContactController.php", //The url of the json service
                            dataType: 'json',
                            quietMillis: 100, //How long the user has to pause their typing before sending the next request
                            data: function(term, page) { //Our search term and what page we are on
                                return {
                                    ACTION: "<?php echo App::ACTION_SEARCH; ?>",  //action, customerId, term
                                    userId: <?php echo $userId; ?>,
                                    term: term
                                };
                            },
                            results: function(data, page) {
                            	lastResults = data;
                                return { results: data }
                            }
                        },                      
                        formatResult: function(contact) { 
                            if(contact.VALUE==contact.id)
                                rc="<div class='select2-user-result'><strong>"+contact.VALUE+"</strong></div>";
                            else {
                                if(contact.VALUE == null)
                                   str='';
                               else
                                   str=contact.VALUE;
                                rc="<div class='select2-user-result'><strong>"+str+"</strong> "+contact.id+"</div>";
                            }
                            return  rc;
                        },
                        formatSelection: function(contact) {						
							if(contact.VALUE==contact.id)
								rc=contact.VALUE;
							else 
                                                          if(contact.VALUE == null)  
                                                        rc=contact.id;
                                                        else rc=contact.VALUE+" ("+contact.id+")";
                            return rc; 
                        },
                        initSelection : function (element, callback) {
                                var data = [];
                                $(element.val().split(",")).each(function () {
                                        data.push({id: this, VALUE: this});
                                });
                                callback(data);
                        }
                    });
					
                    if(ACTION=='<?php echo App::ACTION_UPDATE; ?>')
                    {   checkCookie();
                        $.loader.open();
                        $.post("<?php echo App::getBoPath(); ?>/message/SimpleMessageController.php", {userId: "<?php echo $userId; ?>",messageId: messageId, ACTION: "<?php echo App::ACTION_VIEW; ?>"}, function(data) {
                        data=$.parseJSON(data);
                        newMessage.find('#msgSubject').val(data.subject);							
                        if(data.recipients!=''){
                            var dataDA = [];
                            $(data.recipients.split(",")).each(function () {
                                dataDA.push(this);
                            });							
                            newMessage.find('#msgDA').select2("val", dataDA);  	
                        }
                        newMessage.find('#msgText').val(data.content);
//                        newMessage.find('#msgText').focus();
                newMessage.find('#count').html(data.content.length);
                    var nbmessage=1;
                    if(data.content.length <=160){
                       newMessage.find('.main').removeAttr('style');
                        newMessage.find('.parts').html(nbmessage);
                    }
                    else {
                        var nb=0;
                        var nm = 160;
                        var content=data.content;
                        do {
                             nb=nb+1;
                           var ms =  content.substring(0,nm);
                            content = content.substring(nm);
                            } while (content.length > 160);
                            if (content.length !== 0) {
                                    nb=nb+1;
                            }
                            $('.main').removeAttr('style');
                             $('.parts').html(nb);
                    }
                        $.post( "<?php echo App::getBoPath(); ?>/group/GroupController.php", {userId: "<?php echo $userId; ?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(dataListGroup) {
                                newMessage.find("#msgGroupe").loadJSON('{"groups":'+dataListGroup+'}', {onLoaded: function () {
                                    var dataGroups = [];
                                    $(data.groups.split(",")).each(function () {							    
                                            dataGroups.push(this);
                                    });							
                                    newMessage.find('#msgGroupe').select2("val", dataGroups);
                                }
                        });
});               	

                        $.post( "<?php echo App::getBoPath(); ?>/customer/SignatureController.php", {customerId: "<?php echo $customerId; ?>", ACTION: "<?php echo App::ACTION_LIST_VALID; ?>"}, function(dataListSign) {
                                newMessage.find("#msgFrom").loadJSON('{"signature":'+dataListSign+'}', {onLoaded: function () {
                                    newMessage.find('#msgFrom').select2("val", data.signature);
                                }
                            });
                        }).error(function(error) {  checkCookie();});

                        $.post( "<?php echo App::getBoPath(); ?>/common/TemplateCategoryController.php", {partnerId: "<?php echo $partnerId?>", ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(data) {
                                newMessage.find("#TPL_CMB").loadJSON('{"template":'+data+'}');
                        });	

                        if(data.sendingType == 'I')
                             newMessage.find('#sendNow_radio').attr('checked','checked');
                        else if(data.sendingType == 'P') {
                            newMessage.find('#sendSchedule_radio').attr('checked','checked');
                            newMessage.find('#date_envoi').show();
                            newMessage.find('#msg_dtStartSending').val(data.sendingDate); 
                            newMessage.find('#msg_tmStartSending').val(data.sendingTime);
                        }
                        $.loader.close(true);
                });						
                    }
		        }
                        
                   
                loadTemplate = function (categoryId)
                {
                    $.post( "<?php echo App::getBoPath(); ?>/common/TemplateController.php", {customerId: "<?php echo $customerId; ?>", categoryId: categoryId, ACTION: "<?php echo App::ACTION_LIST; ?>"}, function(data) {
                        data=$.parseJSON(data);	
                        $("#templateItems").html("");
                        if(data.length!=0){
                            var tplItem_id="tplItem"+categoryId;
                            var tplItem = $('#tplItem').clone(true, true).attr('id', tplItem_id);
                            $('#templateItems').append(tplItem); 
                            $("#"+tplItem_id).show();
                            $("#"+tplItem_id).loadJSON(data);
                        }
                    });
                    
            	}
                      initMessageValidation = function(form){
                          $(form).validate({
		                errorElement: 'span',
		                errorClass: 'help-block',
		                focusInvalid: false,
		                rules: {                    
		                    signature: {
		                         notEqual: "-1" 
		                    },
		                    recipients: {
		                         required: function(element) {                             
		                            return ($("#" + frmMessageId + " #msgGroupe").val() == null);
		                         }                        
		                    },
		                    groups: {
		                        required: function(element) {
		                            return ($("#" + frmMessageId + " #msgDA").val() == "");
		                         } 
		                    },
		                    content: {
		                        required: true
		                    }
		                    
		                    
		                },
		                messages: {                    
		                    signature: {
		                         notEqual: "<?php printf($pgSelectionExpediteur); ?>" ,
		                    },
		                    recipients: {
		                         required: "<?php printf($pgAjoutDestinataire); ?>" ,
		                    },
		                    groups: {
		                        required: "<?php printf($pgSelectGroupe); ?>",
		                    },
		                    content: {
		                        required: "<?php printf($pgMessageVide); ?>",
		                    }
		                },
		                errorPlacement: function(error, element) {
		                    var container = $('<div />');
		                    container.addClass('Ntooltip');
		                    error.insertAfter(element);
		                    error.wrap(container);
		                    $("<div class='errorImage'></div>").insertAfter(error);
		                },
		                highlight: function(e) {
		                    $(e).closest('.control-group').removeClass('info').addClass('help-block error');
		                },
		                success: function(e) {
		                    $(e).closest('.control-group').removeClass('error help-block');
		                },
		                submitHandler: function(form) {
		                  
		                },
		                invalidHandler: function(form) {
		                }
		            });
                      };
                //Validation form message
		        messageValidation = function(messageId, ACTION, frmMessageId, winMessageId, nWin)
		        {
                            $("#" + winMessageId).find('#FRM_MSG_SEND').attr('disabled','disabled');
                            $.validator.addMethod("notEqual", function(value, element, param) {
		            return this.optional(element) || value != param;
		            });     
                            $("#" + frmMessageId).change(function(){ 
                            initMessageValidation(this);    
		            $(this).valid();
                            });		            
		            $("#" + frmMessageId).validate({
                                ignore: ".ignore",
		                errorElement: 'span',
		                errorClass: 'help-block',
		                focusInvalid: false,
		                rules: {                    
		                    signature: {
		                         notEqual: "-1" 
		                    },
		                    recipients: {
		                         required: function(element) {
		                            return ($("#" + frmMessageId + " #msgGroupe").val() === null);
		                         }                        
		                    },
		                    groupes: {
		                        required: function(element) {
		                            return ($("#" + frmMessageId + " #msgDA").val() === "");
		                         } 
		                    },
		                    content: {
		                        required: true
		                    
		                    }
		                },
		                messages: {                    
		                     signature: {
		                         notEqual: "<?php printf($pgSelectionExpediteur); ?>" 
		                    },
		                    recipients: {
		                         required: "<?php printf($pgAjoutDestinataire); ?>" 
		                    },
		                    groupes: {
		                        required: "<?php printf($pgSelectGroupe); ?>"
		                    },
		                    content: {
		                        required: "<?php printf($pgMessageVide); ?>"
		                    }
		                },
		                errorPlacement: function(error, element) {
		                    var container = $('<div />');
		                    container.addClass('Ntooltip');
		                    error.insertAfter(element);
		                    error.wrap(container);
		                    $("<div class='errorImage'></div>").insertAfter(error);
                                    
		                },
		                highlight: function(e) {
		                    $(e).closest('.control-group').removeClass('info').addClass('help-block error');
		                },
		                success: function(e) {
                                    if($(e).closest('.control-group').hasClass('depend')){
                                        $('.depend').removeClass('error help-block');
                                    }
		                    $(e).closest('.control-group').removeClass('error help-block');
		                },
		                submitHandler: function(form) {
		                  
		                },
		                invalidHandler: function(form) {
		                }
		            });
		            if($("#" + frmMessageId).valid()){ //
                                checkCookie();
                                var expirationDate;
                                $.post("<?php echo App::getBoPath(); ?>/customer/CustomerController.php", {customerId: "<?php echo $customerId; ?>", ACTION: "<?php echo App::ACTION_GET_CUSTOMER_ACCOUNT; ?>"}, function(data) {
                                 data = $.parseJSON(data);
                                 expirationDate=data.expirationDate;
                                 if(data.subscriptionType == 'POSTPAID'){
                                    messageProcess(messageId, ACTION, frmMessageId, winMessageId, nWin);
                                 }
                                 else {
                                     $.post("<?php echo App::getBoPath(); ?>/customer/CustomerController.php", {customerId: "<?php echo $customerId; ?>", ACTION: "<?php echo App::ACTION_GET_CUSTOMER_ACCOUNT_EXPIRATION_DATE; ?>"}, function(data,e) {
                                        data = $.parseJSON(data);
                                        if(data==-1){
                                                 //e.preventDefault();
                                                $.gritter.add({
                                                title: 'Notification',
                                                text: "L'état actuel de votre compte ne vous permet pas d'envoyer de message. Votre crédit a expiré le "+expirationDate+", veuillez recharger.",
                                                class_name: 'gritter-error gritter-light'
                                                });
                                                 //alert("date expiree");
                                        }
                                        else{
                                                if(data.remainingNumberOfSms>0){
                                                messageProcess(messageId, ACTION, frmMessageId, winMessageId, nWin);
                                                }else{
                                                  //  alert("pas de credit");
                                                    $.gritter.add({
                                                    title: 'Notification',
                                                    text: "L'état actuel de votre compte ne vous permet pas d'envoyer de message. Votre crédit est insuffisant, veuillez recharger.",
                                                    class_name: 'gritter-warning gritter-light'
                                                    });
                                                }
                                            }

                                    });
                        }
             });
                                }
                            else{
                                $("#" + winMessageId).find('#FRM_MSG_SEND').removeAttr("disabled");
                                }
		        };
		        //fin Validation
                        
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
    function mergeJSON(source1,source2){
    /*
     * Properties from the Souce1 object will be copied to Source2 Object.
     * Note: This method will return a new merged object, Source1 and Source2 original values will not be replaced.
     * */
    var mergedJSON = Object.create(source2);// Copying Source2 to a new Object

    for (var attrname in source1) {
        if(mergedJSON.hasOwnProperty(attrname)) {
          if ( source1[attrname]!=null && source1[attrname].constructor==Object ) {
              /*
               * Recursive call if the property is an object,
               * Iterate the object and set all properties of the inner object.
              */
              mergedJSON[attrname] = mergeJSON(source1[attrname], mergedJSON[attrname]);
          } 

        } else {//else copy the property from source1
            mergedJSON[attrname] = source1[attrname];

        }
      }

      return mergedJSON;
}
                        
                   
		        messageProcess = function (messageId,ACTION,frmMessageId,winMsgId,nWin)
		        {
                            $('#' + winMsgId).hide();
                            var jsonMerge;
                            var msgGroupe=$('#' + frmMessageId).find("#msgGroupe").val();
                            data=$('#' + frmMessageId).find('#msgFrom').select2('data');
                            var signatureName;
                            if(data !=null)
                                signatureName=data.text;
                            else
                                signatureName='';
                            var selections = $('#' + frmMessageId).find('#msgGroupe').select2('data');
                            groupsJson="";
                            $.each(selections, function(key, value){
                                if(key==0)
                                    groupsJson=value.text;
                                else
                                    groupsJson=groupsJson+", "+value.text;
                            });
                            var nbMessage = $('#' + frmMessageId).find('.parts').text();
                            var MessageLength = $('#' + frmMessageId).find('#count').text();
		            if(messageId!=null){
                                paramJson='{"userId": <?php echo $userId; ?>,"partnerCode":"<?php echo $partnerCode; ?>", "customerId": <?php echo $customerId; ?>, "messageId": "'+messageId+'", "ACTION": "'+ACTION+'", "groups":"'+ msgGroupe+'", "signatureName":"'+ signatureName+'", "groupName":"'+ groupsJson+'", "numberMessage":"'+ nbMessage+'", "messageLength":"'+ MessageLength+'"}';
                            }else{
                                paramJson='{"userId": <?php echo $userId; ?>,"partnerCode":"<?php echo $partnerCode; ?>", "customerId": <?php echo $customerId; ?>, "ACTION": "'+ACTION+'", "groups":"'+  msgGroupe+'", "signatureName":"'+ signatureName+'", "groupName":"'+ groupsJson+'", "numberMessage":"'+ nbMessage+'", "messageLength":"'+ MessageLength+'"}';
                            }    
                            json1=$.parseJSON(paramJson);
                            json2=$('#' + frmMessageId).serializeObject();
                            jsonMerge=mergeJSON(json1, json2);
		            $.ajax({
		                url: '<?php echo App::getBoPath(); ?>/message/SimpleMessageController.php', 
		                type: 'POST',
		                dataType: 'JSON',
		                data: jsonMerge,
		                success: function(data)
		                {
		                    $('#' + winMsgId).remove();
		                    if (data.rc == 0)
		                    {
		                        $.gritter.add({
		                            title: 'Notification',
		                            text: data.action,
		                            class_name: 'gritter-success gritter-light'
		                        });
		                        getDraftIndicator();
//                                        $.loader.close(true);
		                    }
		                    else
		                    {
		                        $.gritter.add({
		                            title: 'Notification',
		                            text: data.error,
		                            class_name: 'gritter-error gritter-light'
		                        });
//                                        $.loader.close(true);
		                    };
                                    if(link==="<?php echo App::getHome(); ?>/app/messages/messages.php?tmsg=MS" && ACTION==='SEND'){
                                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/messages/messages.php?tmsg=MS", function() {
                                            $.loader.close(true);
                                        });
                                    }else if(link==="<?php echo App::getHome(); ?>/app/messages/draft.php" && ACTION==='DRAFT'){
                                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/messages/draft.php", function() {
                                            $.loader.close(true);
                                        });
                                    }
                                    else if(link==="<?php echo App::getHome(); ?>/app/messages/draft.php" && ACTION==='SEND'){
                                        $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/messages/draft.php", function() {
                                            $.loader.close(true);
                                        });
                                    }
		                },
		                error: function() {
                                    $("#" + winMsgId).find('#FRM_MSG_SEND').removeAttr("disabled");
                                    $("#" + winMsgId).find('#FRM_MSG_SAVE').removeAttr("disabled");
                                    $.loader.close(true);
		                   //alert("failure");
                                  // alert($.cookie('partnerId'));
                                   //var cookies=$.cookie();
                                   //console.log(cookies);
                                   
                                    checkCookie();
                                    $('#' + winMsgId).show();
		                }
		            });   

		                  
		        };






                
                $("#SHORTCUT_CONTACT").click(function(e){
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_CON";
                    mnu_selected_parent_id = "";
                    $("#MNU_CON").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/contacts/contacts.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/contacts/contacts.php";
                    });
                });
                
               
                
                $("#SHORTCUT_PARAM").click(function(e){
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_PARAM";
                    mnu_selected_parent_id = "";
                    $("#MNU_PARAM").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/user/param.php", function() {
                        $.loader.close();
                        link="<?php echo App::getHome(); ?>/app/user/param.php";
                    });
                });

                //<!--SHORTCUT ACTIONS END-->    

                //<!--SIDEBAR ACTIONS -->

                var mnu_selected_id;
                var mnu_selected_parent_id;
                $("#MNU_DBD").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_DBD";
                    mnu_selected_parent_id = "";
                    $("#MNU_DBD").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/stats/stat.php", function() {
                        $.loader.close(true);
                        //alert( "Load was performed." );
                    });
                });

                $("#MSG_SEND").click(function(e)
                {
                    e.preventDefault();
                    messageForm('<?php echo App::ACTION_INSERT; ?>',null); 
                });
                $("#MSG_CPG").click(function(e)
                {
                    
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_MSG_CPG";
                    mnu_selected_parent_id = "#MNU_MSG";
                    $("#MNU_MSG").attr("Class", "active open");
                    $("#MNU_MSG_CPG").attr("Class", "active"); 
                    campaignId = 0;
                    //$("#MAIN_CONTENT").load("app/messages/fcampg.php", campaignId);
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/messages/fcampg.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/messages/fcampg.php";
                     });
                });
                $("#CPG_LIST").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_CPG_LIST";
                    mnu_selected_parent_id = "#MNU_MSG";
                    $("#MNU_MSG").attr("Class", "active open");
                    $("#MNU_CPG_LIST").attr("Class", "active");
                    clearTimeout(gStatTimer);
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/messages/messages.php?tmsg=CPG", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/messages/messages.php?tmsg=CPG";
                     });
                });              
                $("#MSG_LIST").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_MSG_LIST";
                    mnu_selected_parent_id = "#MNU_MSG";
                    $("#MNU_MSG").attr("Class", "active open");
                    $("#MNU_MSG_LIST").attr("Class", "active");
                    clearTimeout(gStatTimer);
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/messages/messages.php?tmsg=MS", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/messages/messages.php?tmsg=MS";
                    });
                });   
                $("#MSG_DRAFT").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_MSG_DRAFT";
                    mnu_selected_parent_id = "#MNU_MSG";
                    $("#MNU_MSG").attr("Class", "active open");
                    $("#MNU_MSG_DRAFT").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/messages/draft.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/messages/draft.php";
                    });
                }); 
                       
                
                $("#CON_VIEW").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_CON";
                    mnu_selected_parent_id = "";
                    $("#MNU_CON").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/contacts/contacts.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/contacts/contacts.php";
                    });
                });
                
                $("#CAL_VIEW").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    $.loader.open();
                    mnu_selected_id = "#MNU_CAL";
                    mnu_selected_parent_id = "";
                    $("#MNU_CAL").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/agenda/calendar.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/agenda/calendar.php";
                    });
                });
                
                $("#PAR_VIEW").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_PARAM";
                    mnu_selected_parent_id = "";
                    $("#MNU_PARAM").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/user/param.php", function() {
                        $.loader.close();
                        link="<?php echo App::getHome(); ?>/app/user/param.php";
                    });
                });  
                
                $("#GUIDE_VIEW").click(function(e)
                { 
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_GUIDE";
                    mnu_selected_parent_id = "";
                    $("#MNU_GUIDE").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/user/userGuide.php", function() {
                        $.loader.close();
                        link="<?php echo App::getHome(); ?>/app/user/userGuide.php";
                    });
                });
                
                
                $("#SHOP_VIEW").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_SHOP";
                    mnu_selected_parent_id = "";
                    $("#MNU_SHOP").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/store/store.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/store/store.php";
                    });
                });           
                $("#TRASH_VIEW").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_TRASH";
                    mnu_selected_parent_id = "";
                    $("#MNU_TRASH").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/trash/trash.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/trash/trash.php";
                    });
                });           
                
                $("#USER_VIEW").click(function(e)
                {
                    e.preventDefault();
                    swap();
                    checkCookie();
                    $.loader.open();
                    mnu_selected_id = "#MNU_USER";
                    mnu_selected_parent_id = "";
                    $("#MNU_USER").attr("Class", "active");
                    $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/user/users.php", function() {
                        $.loader.close(true);
                        link="<?php echo App::getHome(); ?>/app/user/users.php";
                    });
                });

                function swap()
                {
                    // $("#MNU_MSG").attr("Class","active open");
                    $(mnu_selected_id).removeClass("active");
                    $(mnu_selected_parent_id).removeClass("open");
                    $(mnu_selected_parent_id).removeClass("active");

                }

                //<!--SIDEBAR ACTIONS END-->
                
                
                
                

                $('.easy-pie-chart.percentage').each(function(){
                        var $box = $(this).closest('.infobox');
                        var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                        var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                        var size = parseInt($(this).data('size')) || 50;
                        $(this).easyPieChart({
                                barColor: barColor,
                                trackColor: trackColor,
                                scaleColor: false,
                                lineCap: 'butt',
                                lineWidth: parseInt(size/10),
                                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                                size: size
                        });
                })

                $('.sparkline').each(function(){
                        var $box = $(this).closest('.infobox');
                        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                        $(this).sparkline('html', {tagValuesAttribute:'data-values', type: 'bar', barColor: barColor , chartRangeMin:$(this).data('min') || 0} );
                });            
		 
        </script>


</body>
</html>
