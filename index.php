<?php 
    require_once 'common/app.php';
    $parameters = parse_ini_file('config/parameters.ini');
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link href="assets/css/bootstrap.min.css"/>
    <link href="assets/css/jquery-ui-1.10.3.custom.min.css"/>
    <title>MacFish Production</title>

  </head>
  <body>
      
    <script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script type="text/javascript">
        function getCustomerIeBrowser () {
              var customerBrowser = navigator.userAgent.toLowerCase();
              
              return (customerBrowser.indexOf('msie') != -1) ? parseInt(customerBrowser.split('msie')[1]) : null;
        }

        var ieBrowser = getCustomerIeBrowser();

        if ( (ieBrowser != null) && (ieBrowser < 9) ) {            
             location.href="update-browser.html";
            }
    $(document).ready(function(){
        var dn;
        var domainName='/';
        var heure = new Date();
        var m = 24*60*60*1000; //24 h
        var url=''+window.location;
        var subDomainTemp;
        
        function extractDom(url) {
                var domain;
                //find & remove protocol (http, ftp, etc.) and get domain
                if (url.indexOf("://") > -1) {
                    //cas du 213 où on a [..]/2smobile/2smobile/[..]
                    if(url.split('/')[3]===url.split('/')[4]){
                        domain = url.split('/')[2]+'/'+url.split('/')[3];
                    }else{
                        if((url.split('/')[3]==='')||(url.split('/')[3]==='index.php')){
                            var s=url.split('/')[2];
                            domain= s.split('.')[1]+'.'+s.split('.')[2];
                        }else{
                        domain = url.split('/')[2];
                        }
                      }
                }
                else {
                    if(url.split('/')[1]===url.split('/')[2]){
                        domain = url.split('/')[0]+'/'+url.split('/')[1];
                    }else{
                        domain = url.split('/')[0];
                        domain= domain.split('.')[1]+domain.split('.')[2];
                    }
                }
                //find & remove port number
                domain = domain.split(':')[0];

                return domain;
            }
        
        function extractWithProtocol(url) {
                var domain;
                
                if(url.split('/')[3]===url.split('/')[4]){
                    //cas du 213 où on a [..]/2smobile/2smobile/[..]
                    domain = url.split('/')[0]+'//'+url.split('/')[2]+'/'+url.split('/')[3];
                }else{
                 //   if(url.split('/')[3]!==''){
                    //cas du localhost/2smobile/portail
                        domain = url.split('/')[0]+'//'+url.split('/')[2];
                 //   }
                }
                
            return domain;
            }
            
        var subDomain=extractWithProtocol(url);
         
        subDomainTemp=subDomain;
        subDomain='';
       var deb=subDomainTemp;
        var beC;
        
        
//        var dn1=extractDom(url);
//        if((dn1=='localhost')||(dn1=='213.154.64.120/2smobile')){
//            beC=deb+"/2smobile/backend/src/bo/common/DomainController.php";
//        }else{
//            beC=deb+"/src/bo/common/DomainController.php";
//        }
//        
//        heure.setTime(heure.getTime() + m ); //l'heure actuelle + 24h 
        var url = "signin.php";
        document.location.href=url;
        //
//            type: "POST",
//            url: beC,
//            data: {
//                domainName: dn1,
//                ACTION: 'VIEW'
//            },
//            success: function(data) {
//                data=$.parseJSON(data);
//                
//                if(data.rc==='1'){
//                    //creation des cookies
//                    $.cookie('partnerId', data.infos.id, { expires: heure, path: domainName, domain:subDomain });
//                    $.cookie('partnerCode', data.infos.code, { expires: heure, path: domainName, domain:subDomain });
//                    $.cookie('partnerName', data.infos.name, { expires: heure, path: domainName, domain:subDomain});
//                    $.cookie('partnerTrademark', data.infos.trademark, { expires: heure, path: domainName, domain:subDomain});
//                    $.cookie('partnerCellular', data.infos.cellular, { expires: heure, path: domainName, domain:subDomain});
//                    $.cookie('partnerFax', data.infos.fax, { expires: heure, path: domainName, domain:subDomain});
//                    $.cookie('partnerTemplate', data.infos.template, { expires: heure, path: domainName, domain:subDomain });
//                    $.cookie('partnerEmail', data.infos.email, { expires: heure, path: domainName, domain:subDomain });
//                    $.cookie('partnerLanguage', data.infos.lgeCode, { expires: heure, path: domainName, domain:subDomain });
//                    $.cookie('partnerServer', data.infos.server, { expires: heure, path: domainName, domain:subDomain });
//                    $.cookie('partnerBackend', data.infos.backend, { expires: heure, path: domainName, domain:subDomain });
//                    $.cookie('partnerBackoffice', data.infos.backoffice, { expires: heure, path: domainName, domain:subDomain});
//                    $.cookie('partnerPortailOnLocal', data.infos.portailOnLocal, { expires: heure, path: domainName, domain:subDomain});
//                    $.cookie('partnerBoOnLocal', data.infos.boOnLocal, { expires: heure, path: domainName, domain:subDomain});
//                    $.cookie('partnerDebit', data.infos.debit, { expires: heure, path: domainName, domain:subDomain});
//                    
////                    var url = deb+"/2smobile/portail/signin.php";
//                    var url = data.infos.server+"/signin.php";
//                    document.location.href=url;
//                }else{
//                    alert(data.error);
//                }
//              return false;
//            },
//            error: function(data) {
//              alert("Erreur de connexion &agrav; internet");
//              return false;
//            }
//        });
        
    });
    </script>
  </body>
</html>

