<?php 
    require_once '../common/app.php';
    $parameters = parse_ini_file('../config/parameters.ini');
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>MacFish Production - Authentification</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
        
        <link rel="stylesheet" href="assets/css/select2.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="assets/css/ace.min.css" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout " style="background: #1c5d5a;">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container" >
                            <div class="center">
                                <h1>
                                    <i class="ace-icon fa fa-leaf green"></i>
                                    <span class="red">MacFish</span>
                                    <span class="white" id="id-text2"> Banque</span>
                                </h1>
                                <h4 class="white" id="id-company-text">&copy; MacFish Production - Banque</h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div  id="login-box" class="login-box visible widget-box no-border" >
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="ace-icon fa fa-coffee green"></i>
                                                Connectez vous à MacFish - Banque
                                            </h4>

                                            <div class="space-6"></div>

                                            <form>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input id="username" type="text" class="form-control" placeholder="Username" />
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input id="password" type="password" class="form-control" placeholder="Password" />
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>
                                                    <div class="space"></div>
                                                        <button id="btn-connect" class="width-50 btn btn-sm" style="background:#1c5d5a !important;border-color: #394557 !important; margin-left: 28%;"
">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110">Se connecter</span>
                                                        </button>
                                                     </fieldset>
                                            </form>
                                                    </div>

                                                    <div class="space-4"></div>
                                               

                                          
                                            <div class="space-6"></div>


                                        </div><!-- /.widget-main -->

                                       
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->

                    
                            </div><!-- /.position-relative -->

                            <div class="navbar-fixed-top align-right">
                                <br />
                                &nbsp;
                                <a id="btn-login-dark" href="#">Noir</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-blur" href="#">Bleu</a>
                                &nbsp;
                                <span class="blue">/</span>
                                &nbsp;
                                <a id="btn-login-light" href="#">Gris</a>
                                &nbsp; &nbsp; &nbsp;
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="assets/js/jquery.2.1.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/select2.min.js"></script>
        <script src="assets/js/jquery.loadJSON.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/jquery.cookie.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery.min.js'>" + "<" + "/script>");
        </script>

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

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function ($) {
                $(document).on('click', '.toolbar a[data-target]', function (e) {
                    e.preventDefault();
                    var target = $(this).data('target');
                    $('.widget-box.visible').removeClass('visible');//hide others
                    $(target).addClass('visible');//show target
                });
            });

            //you don't need this, just used for changing background
            jQuery(function ($) {
                $('#btn-login-dark').on('click', function (e) {
                    $('body').attr('class', 'login-layout');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-light').on('click', function (e) {
                    $('body').attr('class', 'login-layout light-login');
                    $('#id-text2').attr('class', 'grey');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-blur').on('click', function (e) {
                    $('body').attr('class', 'login-layout blur-login');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'light-blue');

                    e.preventDefault();
                });
                
       
                
                 seConnecter=function(){
                      var username=$('#username').val();
                      var password=$('#password').val();
                      var usineId=$('#LISTE_USINE').val();
                      if(username!=='' && password!=='' && usineId!=="*"){
                          var domainName='';
                         
                          var heure = new Date();
                          var m = 7200000; // 30 minutes
                          heure.setTime(heure.getTime() + m ); // l'heure actuelle + 30 minutes
                      $.ajax({
                            type: "POST",
                            url: "<?php echo \App::getBoPath();?>/utilisateur/UtilisateurController.php",
                            data: {
                                login: username,
                                password: password,
                                usineId:usineId,
                                ACTION: 'SIGNIN'
                            },
                            success: function(data) {
                                data=$.parseJSON(data);
                                console.log(heure);
                                if(data.rc==1){
                                    $.cookie('userId', data.infos.uid, { expires: heure, path: domainName });
                                    $.cookie('login', data.infos.login, { expires: heure, path: domainName });
                                    $.cookie('profil', data.infos.profil, { expires: heure, path: domainName});
                                    $.cookie('status', data.infos.status, { expires: heure, path: domainName });
                                    $.cookie('etatCompte', data.infos.etatCompte, { expires: heure, path: domainName });
                                    $.cookie('codeUsine', data.infos.codeUsine, { expires: heure, path: domainName});
                                    $.cookie('nomUsine', data.infos.nomUsine, { expires: heure, path: domainName});
                                    $.cookie('nomUtilisateur', data.infos.nomUtilisateur, { expires: heure, path: domainName});
                                    $.cookie('description', data.infos.description, { expires: heure, path: domainName});
                                    $.cookie('nomUsine', data.infos.nomUsine, { expires: heure, path: domainName});
                                    
                                  var url = "<?php echo \App::getHome();?>/main.php";
                                  document.location.href=url;
                                }else if(data.rc==0){
                                        bootbox.alert("Login ou mot de passe incorrect");
                                        return false;
                                }
                                else if(data.rc==-1){
                                        bootbox.alert("Cet utilisateur est desactivé. Veuillez contacter votre administrateur.");
                                        return false;
                                }
                                else {
                                       bootbox.alert("Login ou mot de passe incorrect");
                                  return false;
                              }
                                },
                                error: function(data) {
                                  bootbox.alert("Erreur de connexion");
                                  return false;
                                }
                            });
                      }else{
                        bootbox.alert("Les champs ne doivent pas être vide");
                        return false;
                      }
                   };
                   $('#btn-connect').click(function(e){
                       // seConnecter();
                       var url = "main.php";
                                  document.location.href=url;
                    e.preventDefault();
                    
                   });
                   
            });
        </script>
    </body>
</html>
