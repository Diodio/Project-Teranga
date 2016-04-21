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
            Inventaire Général
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Inventaire Général
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
          <div class="row">
                <div class="widget-box transparent">
                    
                    <div class="widget-header widget-header-flat" >
                         <span class="col-sm-2">
                             
                            <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Inventaire
                        </h4>

                        </span>
                        
                         
                    </div>
                    <div class="space-6"></div>
                    <div class="row">
                        <span class="col-sm-3"></span>
                    <span class="col-sm-8">
                          <span id="labelTo" style="margin-left: 20px;">Période du</span>
                            <input
					        class="date-picker" id="dateDebut"
					        name="dateDebut" type="text"
					        data-date-format="dd-mm-yyyy" />
					    <span id="labelTo" style="margin-left: -1px;">au</span>
					    <input
					        class="date-picker" id="dateFin"
					        name="dateFin" type="text"
					        data-date-format="dd-mm-yyyy" />
					    <button data-toggle="dropdown" id="BTN_SEARCH" style="align-content: center;margin-top: -3px;"
					            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
					            data-rel="tooltip" data-placement="top" title="consulter">
					        <i class="fa fa-search bigger-120 white" style="margin-left: 1px;"></i> 
					    </button>
					    
					    <button data-toggle="dropdown" id="BTN_IMPRIMER" style="align-content: center;margin-top: -3px;"
					            class="btn btn-mini btn-primary dropdown-toggle tooltip-info"
					            data-rel="tooltip" data-placement="top" title="Imprimer">
					        <i class="fa fa-print bigger-120 white" style="margin-left: 1px;"></i> 
					    </button>
					                   
                                            
                                     
                        </span>
                        </div>
                    <div style="margin-top: 8%">       
                        
         <div style="margin-top: 15px; text-align:center" >
                    <div class="infobox infobox-green" style="width: 500px; height: 40px;">
                                 <div class="infobox-data">
                                     <span class="infobox-data-number"><span class="medium-high">Somme Achat : </span><span id='sommeAchat'>0.00</span> F CFA</span>
                                 </div>
                         </div>
                         <div class="infobox infobox-blue" style=" width: 400px; height: 40px;">


                                 <div class="infobox-data" style="width:640px">
                                     <span class="infobox-data-number"><span class="medium-high">Somme vente : </span><span id='sommeVente'>0.00</span> F CFA</span>
                                 </div>
                         </div>
            </div>
                 
         <div style="margin-top: 15px; text-align:center" >
                    <div class="infobox infobox-green" style="width: 500px; height: 40px;">
                                 <div class="infobox-data">
                                     <span class="infobox-data-number"><span class="medium-high">Bénéfice globale : </span><span id='beneficeGlobal'>0.00</span> F CFA</span>
                                 </div>
                         </div>
                         <div class="infobox infobox-blue" style=" width: 400px; height: 40px;">


                                 <div class="infobox-data" style="width:640px">
                                     <span class="infobox-data-number"><span class="medium-high">Bénéfice actuelle : </span><span id='beneficeActuelle'>0.00</span> F CFA</span>
                                 </div>
                         </div>
            </div>
          </div>
          </div>
                   
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
        
        
       <script type="text/javascript">
            jQuery(function ($) {
            var oTableAchats= null;
            var nbTotalAchatsChecked=0;
            var checkedAchats = new Array();
            // Check if an item is in the array
           // var interval = 500;
    getDate=function(debut){
        // GET CURRENT DATE
        var date = new Date();

        // GET YYYY, MM AND DD FROM THE DATE OBJECT
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth()+1).toString();
        var dd  = date.getDate().toString();

        // CONVERT mm AND dd INTO chars
        var mmChars = mm.split('');
        var ddChars = dd.split('');

        // CONCAT THE STRINGS IN YYYY-MM-DD FORMAT
        if(debut)
            return '01-'+(mmChars[1]?mm:"0"+mmChars[0]) + '-' +yyyy   ;
        return (ddChars[1]?dd:"0"+ddChars[0])+'-'+(mmChars[1]?mm:"0"+mmChars[0]) + '-' +yyyy   ;
    }
    $('#dateDebut').datepicker({autoclose: true,language:'fr',todayHighlight:true}).on(ace.click_event, function(){
             });
    $('#dateFin').datepicker({autoclose: true,language:'fr', todayHighlight:true}).prev().on(ace.click_event, function(){
//            $(this).prev().focus();
    });
    
   // $('#dateDebut').val(getDate(true));
   // $('#dateFin').val(getDate());
    loadInfosInventaire = function (dateD, dateF) {
        var dateDebut='';
        var dateFin='';
        if(typeof(dateD)!=='undefined')
            dateDebut=dateD;
        if(typeof(dateF)!=='undefined')
            dateFin=dateF;
        $.post("<?php echo App::getBoPath(); ?>/inventaire/InventaireController.php", {dateDebut:dateDebut,dateFin:dateFin,codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_GET_INFOS; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                console.log(sData.poidsTotal);
                $("#sommeAchat").text(parseFloat(sData.sommeAchat, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").toString());
                $("#sommeVente").text(parseFloat(sData.sommeVente, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").toString());
                $("#beneficeGlobal").text(parseFloat(sData.beneficeGlobal, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").toString());
                $("#beneficeActuelle").text(parseFloat(sData.beneficeActuel, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").toString());
            }
    });
    };
    
            // Persist checked Message when navigating
            
   
            dateformat = function (date) {
                if(date!==''){
                    var arr = date.split('-');
                    return arr[2] + '-' + arr[1] + '-' + arr[0];
                }
            };
            loadInfosInventaire(dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()));

            $("#BTN_SEARCH").click(function()
            {
                loadInfosInventaire(dateformat($('#dateDebut').val()),dateformat($('#dateFin').val()));
            });
        $("#MNU_IMPRIMER").click(function()
        {
          window.open('<?php echo App::getHome(); ?>/app/pdf/stockPdf.php?codeUsine='+"<?php echo $codeUsine?>",'nom_de_ma_popup','menubar=no, scrollbars=no, top=100, left=100, width=1100, height=650');
         });
            });
        </script>
