

<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Chez Dieyna</title>		
		
		<!-- Import google fonts - Heading first/ text second -->
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700' />
        <!--[if lt IE 9]>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="assets/ico/favicon.ico" type="image/x-icon" />    

	    <!-- Css files -->
	    <link href="assets/css/bootstrap.min.css" rel="stylesheet">		
		<link href="assets/css/jquery.mmenu.css" rel="stylesheet">		
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/climacons-font.css" rel="stylesheet">
		<link href="assets/plugins/xcharts/css/xcharts.min.css" rel=" stylesheet">		
		<link href="assets/plugins/fullcalendar/css/fullcalendar.css" rel="stylesheet">
		<link href="assets/plugins/morris/css/morris.css" rel="stylesheet">
		<link href="assets/plugins/jquery-ui/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
		<link href="assets/plugins/jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">	    
	    <link href="assets/css/style.min.css" rel="stylesheet">
		<link href="assets/css/add-ons.min.css" rel="stylesheet">	
                <link rel="stylesheet" href="assets/css/jquery.gritter.css" />	
                <link rel="stylesheet" href="assets/css/select2.css" />

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>

<body>
	<!-- start: Header -->
        <div class="navbar" role="navigation" style="background-color: #3c8dbc;">
	
		<div class="container-fluid">		
			
			<ul class="nav navbar-nav navbar-actions navbar-left">
				<li class="visible-md visible-lg"><a href="index.html#" id="main-menu-toggle"><i class="fa fa-th-large"></i></a></li>
				<li class="visible-xs visible-sm"><a href="index.html#" id="sidebar-menu"><i class="fa fa-navicon"></i></a></li>			
			</ul>
			
	        <ul class="nav navbar-nav navbar-right">
				<li class="dropdown visible-md visible-lg">
	        		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i><span class="badge">5</span></a>
                                </li>
				<li class="dropdown visible-md visible-lg">
	        		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span class="badge">3</span></a>
	        		<ul class="dropdown-menu">
						<li class="dropdown-menu-header">
							<strong>Notifications</strong>
							<div class="progress thin">
							  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
							    <span class="sr-only">30% Complete (success)</span>
							  </div>
							</div>
						</li>							
                        <li class="clearfix">
							<i class="fa fa-comment"></i> 
                            <a href="page-activity.html" class="notification-user"> Sharon Rose </a> 
                            <span class="notification-action"> replied to your </span> 
                            <a href="page-activity.html" class="notification-link"> comment</a>
                        </li>
                        <li class="clearfix">
                            <i class="fa fa-pencil"></i> 
                            <a href="page-activity.html" class="notification-user"> Nadine </a> 
                            <span class="notification-action"> just write a </span> 
                            <a href="page-activity.html" class="notification-link"> post</a>
                        </li>
                        <li class="clearfix">
                            <i class="fa fa-trash-o"></i> 
                            <a href="page-activity.html" class="notification-user"> Lorenzo </a> 
                            <span class="notification-action"> just remove <a href="#" class="notification-link"> 12 files</a></span> 
                        </li>                        
						<li class="dropdown-menu-footer text-center">
							<a href="page-activity.html">View all notification</a>
						</li>
	        		</ul>
	      		</li>
				<li class="dropdown visible-md visible-lg">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></a>					
					<ul class="dropdown-menu update-menu" role="menu">
						<li><a href="#"><i class="fa fa-database"></i> Database </a>
                        </li>
                        <li><a href="#"><i class="fa fa-bar-chart-o"></i> Connection </a>
                        </li>
                        <li><a href="#"><i class="fa fa-bell"></i> Notification </a>
                        </li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Message </a>
                        </li>
                        <li><a href="#"><i class="fa fa-flash"></i> Traffic </a>
                        </li>
						<li><a href="#"><i class="fa fa-credit-card"></i> Invoices </a>
                        </li>
                        <li><a href="#"><i class="fa fa-dollar"></i> Finances </a>
                        </li>
                        <li><a href="#"><i class="fa fa-thumbs-o-up"></i> Orders </a>
                        </li>
						<li><a href="#"><i class="fa fa-folder"></i> Directories </a>
                        </li>
                        <li><a href="#"><i class="fa fa-users"></i> Users </a>
                        </li>		
					</ul>
				</li>
				<li class="dropdown visible-md visible-lg">
                                    <span><i class="fa fa-user-md"></i>jhonsmith@mail.com</span>
	        	
	      		</li>
				<li><a href="index.html"><i class="fa fa-power-off"></i></a></li>
			</ul>
			
		</div>
		
	</div>
	<!-- end: Header -->
	
	<div class="container-fluid content">
	
		<div class="row">
				
			<!-- start: Main Menu -->
			<div class="sidebar ">
								
				<div class="sidebar-collapse">
					<div class="sidebar-header t-center" style="color: #3c8dbc; font-size: 36px;">
                                            <span class="title">Chez Dieyna</span>
                                        </div>										
					<div class="sidebar-menu">						
						<ul class="nav nav-sidebar">
                                                        <li><a id="MNU_DASH"><i class="fa fa-laptop"></i><span class="text"> Tableau de bord </span></a></li>
							<li><a id="MNU_CLIENT"><i class="fa fa-font"></i><span class="text"> Clients </span></a></li>
                                                        <li><a  href="#" id="MNU_COMMANDES"><i class="fa fa-file-text"></i><span class="text"> Commandes</span> <span class="fa fa-angle-down pull-right"></span></a></li>
                                                        <li><a id="passerCommande"><i class="fa fa-indent"></i><span class="text"> Nouvelle commande</span></a></li>
                                                        <li><a id="MNU_USAGEPRODUIT"><i class="fa fa-indent"></i><span class="text"> Consommation</span></a></li>
							<li><a id="MNU_PRODUIT"><i class="fa fa-picture-o"></i><span class="text"> Produits </span></a></li>
							<li><a id="MNU_TYPEARTICLE"><i class="fa fa-picture-o"></i><span class="text"> type article </span></a></li>		
							<li><a id="MNU_ARTICLE"><i class="fa fa-picture-o"></i><span class="text"> article </span></a></li>			
						</ul>
					</div>					
				</div>
				
				
			</div>
			<!-- end: Main Menu -->
		
		<!-- start: Content -->
		<div class="main">
		
			<div class="row">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Accueil</a></li>
<!--						<li><i class="fa fa-laptop"></i>Dashboard</li>						  	-->
					</ol>
				</div>
			</div>	
                    <div class="row">
                        <div id="MAIN_CONTENT"></div>
                       <div id="winContainer"></div>
                    </div>
		</div>
		<!-- end: Content -->
		<br><br><br>
		
		
                </div>
		
	</div><!--/container-->
		
	

	
	<div class="clearfix"></div>
	
		
	<!-- start: JavaScript-->
	<!--[if !IE]>-->

			<script src="assets/js/jquery-2.1.1.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<![endif]-->

	<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.1.1.min.js'>"+"<"+"/script>");
		</script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script type="text/javascript">
	 	window.jQuery || document.write("<script src='assets/js/jquery-1.11.1.min.js'>"+"<"+"/script>");
		</script>
		
	<![endif]-->
	<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>	
	
	
	<!-- page scripts -->
	<script src="assets/plugins/jquery-ui/js/jquery-ui-1.10.4.min.js"></script>
	<script src="assets/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script src="assets/plugins/moment/moment.min.js"></script>
	<script src="assets/plugins/fullcalendar/js/fullcalendar.min.js"></script>
	<!--[if lte IE 8]>
		<script language="javascript" type="text/javascript" src="assets/plugins/excanvas/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.stack.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.spline.min.js"></script>
	<script src="assets/plugins/xcharts/js/xcharts.min.js"></script>
	<script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
	<script src="assets/plugins/placeholder/jquery.placeholder.min.js"></script>
	<script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="assets/plugins/morris/js/morris.min.js"></script>
	<script src="assets/plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/jvectormap/js/gdp-data.js"></script>	
	<script src="assets/plugins/gauge/gauge.min.js"></script>
	
	<script src="assets/js/jquery.loadJSON.js"></script>	
	<!-- theme scripts -->
	<script src="assets/js/SmoothScroll.js"></script>
	<script src="assets/js/jquery.mmenu.min.js"></script>
	<script src="assets/js/core.min.js"></script>
	<script src="assets/plugins/d3/d3.min.js"></script>	
        <script src="assets/js/jquery.gritter.min.js"></script>
        <script src="assets/js/select2.min.js"></script>
	
	<!-- inline scripts related to this page -->
        <script>
            
        $("#MAIN_CONTENT").load("app/menuaccueil/menuaccueil.php", function() {
         });
        $("#MNU_COMMANDES").click(function(e)
                {
                     e.preventDefault();
                     $("#MAIN_CONTENT").load("app/commande/commande.php", function() {
                    });         
           
                });
        $("#passerCommande").click(function(e)
                {
                     e.preventDefault();
                     $("#MAIN_CONTENT").load("app/commande/passerCommande.php", function() {
                    });         
           
                });
        
	$("#MNU_CLIENT").click(function(e)
        {
             e.preventDefault();
             $("#MAIN_CONTENT").load("app/client/clients.php", function() {
            });         
   
        });  
         
	$("#MNU_TYPEARTICLE").click(function(e)
        {
             e.preventDefault();
             $("#MAIN_CONTENT").load("app/article/typearticles.php", function() {
            });         
   
        }); 
         
	$("#MNU_ARTICLE").click(function(e)
        {
             e.preventDefault();
             $("#MAIN_CONTENT").load("app/article/articles.php", function() {
            });         
   
        });
        
	$("#MNU_PRODUIT").click(function(e)
        {
             e.preventDefault();
             $("#MAIN_CONTENT").load("app/produit/produits.php", function() {
            });         
   
        }); 
	$("#MNU_USAGEPRODUIT").click(function(e)
        {
             e.preventDefault();
             $("#MAIN_CONTENT").load("app/produit/usageProduit.php", function() {
            });         
   
        }); 
	$("#MNU_DEPENSE").click(function(e)
        {
             e.preventDefault();
             $("#MAIN_CONTENT").load("app/depense/depenses.php", function() {
            });         
   
        });
	$("#MNU_FOURNISSEUR").click(function(e)
        {
             e.preventDefault();
             $("#MAIN_CONTENT").load("app/fournisseur/fournisseurs.php", function() {
            });         
   
        });  
	$("#MNU_STOCK").click(function(e)
	        {
	             e.preventDefault();
	             $("#MAIN_CONTENT").load("app/stock/stock.php", function() {
	            });         
	   
	        }); 
	</script>
	<!-- end: JavaScript-->
	
</body>
</html>