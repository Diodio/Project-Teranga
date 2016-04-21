<?php
require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
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
$nomUsine = $_COOKIE['nomUsine'];
?>


<div class="page-content">
	<div class="page-header">
		<h1>
			Bon de Sortie <small> <i class="ace-icon fa fa-angle-double-right"></i>
				Destockage
			</small>
		</h1>
	</div>
	<!-- /.page-header -->
  <form id="validation-form">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->


			<div class="col-sm-5">

				<div class="row">
					<div class="col-sm-4">
						<label> Origine </label>
					</div>
					<div class="col-sm-6">
						 <input type="text" name="origine" id="origine" placeholder=""
                                                       style="width: 100%" class="col-xs-10 col-sm-7" value="<?php echo $nomUsine;?>" readonly="readonly">
					</div>
				</div>
				<div class="space-6"></div>
				<div class="row">
					<div class="col-sm-4">
						<label> Destination</label>
					</div>
					<div class="col-sm-6">
                                            <select id="CMBDESTINATIONS" name="CMBDESTINATIONS"  data-placeholder="" style="width: 99%">
                                                        <option value="*" class="usines">Selectionnez</option>
                                                </select>
					</div>
				</div>
				<div class="space-6"></div>
				<div class="row">
					<div class="col-sm-4">
						<label>Chauffeur</label>
					</div>
					<div class="col-sm-6">
						<input type="text" name="nomChauffeur" id="nomChauffeur" placeholder=""
							style="width: 100%" class="col-xs-10 col-sm-7">
					</div>
				</div>
				<div class="space-6"></div>
				<div class="row">
					<div class="col-sm-4">
						<label> Numéro Camion</label>
					</div>
					<div class="col-sm-6">
                                            <input type="text" name="numeroCamion" id="numeroCamion" placeholder=""
							style="width: 100%" class="col-xs-10 col-sm-7">
					</div>
				</div>
				
			</div>
			<div class="col-sm-5" style="margin-left: 12%">
				<div class="row">
					<div class="col-sm-5">
						<label> Numero Bon de sortie</label>
					</div>
					<div class="col-sm-6">
						<input type="text" name="numeroBonSortie" id="numeroBonSortie" placeholder=""
							style="width: 100%" class="col-xs-10 col-sm-7">
					</div>
				</div>
				<div class="space-6"></div>
				<div class="row">
					<div class="col-sm-5">
						<label> Date de sortie</label>
					</div>
					<div class="col-sm-6">
						<input type="text" id="dateBonSortie" placeholder=""
							style="width: 100%" class="col-xs-10 col-sm-7">
					</div>
				</div>
				<div class="space-6"></div>
				<div class="row input-append bootstrap-timepicker form-group">
					<div class="col-sm-5">
						<label> Heure de sortie</label>
					</div>
					<div class="col-sm-6">
						<input name="heureSortie" id="heureSortie" type="text"
									class="col-xs-10 col-sm-7">
					</div>
				</div>
				
			</div>
		</div>
		<div class="space-6"></div>
		 <div class="row">
             <h3 class="header smaller lighter green"><i class="ace-icon fa fa-th-large"></i>Ajout Produit</h3>
            <div class="col-sm-4">
                            <div class="row">
                                 <div class="col-sm-3">
                                     <label>  Désignation </label>
                                </div>
                                
                                <div class="col-sm-8">
                                        <div class="clearfix">
                                                <select id="CMB_DESIGNATIONS" data-placeholder=""  style="width:100%"     >
                                                    <option value="*" class="designations"></option>
                                                </select>
                                        </div>
                                </div>
                            </div>
                             <div class="space-6"></div>
                            <div class="row">
                                
                                <div class="col-sm-3">
                                    <label>  Stock (kg)</label>
                                </div>
                                <div class="col-sm-8">
                                        <div class="clearfix">
                                            <input type="text" id="stockReel" readonly="readonly" placeholder=""
                                                        class="col-xs-12 col-sm-12">
                                        </div>
                                </div>
                            </div>
                             <div class="space-6"></div>
                            <div class="row">
                                
                                <div class="col-sm-3">
                                    <label>Sortie (kg) <span id="labeldevise"></span> </label>
                                </div>
                                <div class="col-sm-8">
                                        <div class="clearfix">
                                                <input type="text" id="quantiteSortie" placeholder=""
                                                        class="col-xs-12 col-sm-12">
                                        </div>
                                </div>
                            </div>
           
                </div>
                <div class="col-sm-6">
                      <div class="row clearfix">
				<div class="col-md-12 column">
					<a id="add_row_colis" class="btn btn-primary btn-sm"  title="Ajouter une ligne"
						alt="Ajouter une ligne"><i
						class="ace-icon fa fa-plus-square"></i> </a> 
                                        <a id='delete_row_colis'
						class="btn btn-danger btn-sm" title="Supprimer une ligne"
						alt="Supprimer une ligne"> <i class="ace-icon fa fa-minus-square"></i>
					</a>
				</div>
			</div>
			<div class="space-6"></div>
			<div class="row clearfix">
				<div class="col-md-8 column">
					<table class="table table-bordered table-hover" id="tab_logic_colis">
						<thead>
							<tr>
								<th class="text-center">#</th>
                                                                <th class="text-center" style="width: 150px;">Nombre de colis</th>
								<th class="text-center" style="width: 150px;">Quantité</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addrColis0'>
								<td>1</td>
                                 <td><input type="number" id="nbColis0" name='nbColis0' class="form-control nbColis" /> </td> 
								
								<td>
                                                                    <select id="qteColis0" name="qteColis0" class="form-control qte" >
                                                                       <option value="*" class="qteColis0"></option> 
                                                                    </select>
                                                                     
								</td>
								
							</tr>
							<tr id='addrColis1'></tr>
						</tbody>
					</table>
				</div>
			</div>     
           </div>
             <div class="col-sm-2" style="margin-top: 3.2%;;margin-left: -9%;">
                 <div class="row">
                      <div class="form-group">
                          <button id="VOIR_COLISAGE" type="button" class="btn btn-lg btn-warning" data-toggle="popover" title="Voir colisage" >Voir colisage</button>
                     </div>
                  </div>
                    <div class="row">
                        <div class="form-group">
                            <a id="AJOUT_PRODUIT" class="btn btn-primary btn-lg"  title="Ajouter une ligne"
						alt="Ajouter une ligne"><i
						class="ace-icon fa fa-plus-square"></i>Ajouter </a> 
                        </div>
                    </div>
             </div>
<!--             </form>-->
        </div>
        
        <div class="space-6"></div>
           <h3 class="header smaller lighter green"><i class="ace-icon fa fa-th-large"></i>Détails Produits ajoutés</h3>

         <div class="col-sm-12">
			<div class="row col-md-12 clearfix">
				<div class="col-md-12 column">
					<table class="table table-bordered table-hover" id="tab_produit">
						<thead>
							<tr>
                                <th class="text-center hidden"></th>
								<th class="text-center">Nombre de colis</th>
								<th class="text-center">Désignation</th>
								<th class="text-center">Quantité(kg)</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
                                    
				</div>
			</div>
             <div class="row">
                 <a id='delete_row_produit'
                        class="btn btn-danger btn-sm" title="Supprimer une ligne"
                        alt="Supprimer une ligne"> <i class="ace-icon fa fa-minus-square"></i>Supprimer
                </a>
             </div>
            <div class="space-6"></div> 
        <div class="row">
            <div class="col-md-12 column">
                
                <div class="col-sm-6">
                    <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"
                                            for="form-field-1"> Total colis </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="totalColis" name="totalColis" placeholder=""
                                                            class="col-xs-12 col-sm-9">
                                            </div>
                                    </div>
                                </div>
                            </div>
                </div>
                <div class="col-sm-6">
                     <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right"
                                            for="form-field-1"> Poids total </label>
                                    <div class="col-sm-5">
                                            <div class="clearfix">
                                                    <input type="text" id="qteTotal" name="qteTotal" placeholder=""
                                                            class="col-xs-12 col-sm-9">
                                            </div>
                                    </div>
                                </div>
                            </div>
                </div>
                
                
            </div>
        </div>
         </div>
	</div>
	
	<div class="row">
            <div class="col-sm-12" style="margin-top: 20px;">
                    <button id="SAVE" class="btn btn-small btn-info pull-right">
                            <i class="fa fa-plus-square "></i> Valider
                    </button>
            </div>
    </div>
	</form>
	<!-- /.col -->
</div>
<!-- /.row -->

</div>
<!-- /.page-content -->


<script type="text/javascript">
//{id:"1",designation:"",pu:"",quantite:"",montant:""}
$(document).ready(function () {
    $('#CMBDESTINATIONS').select2();
    $('#CMB_DESIGNATIONS').select2();
     $('#qteColis0').select2();
     var colisage = []; 
     var totalColis=0;
     var qteTotal=0;
    var today = new Date();
    var dateAchat = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd;} if(mm<10){mm='0'+mm;} today = dd+'/'+mm+'/'+yyyy;dateAchat=yyyy+'-'+mm+'-'+dd;
    $('#dateBonSortie').attr('value', today);
    $('#heureSortie').timepicker({
            minuteStep: 1,
            defaultTime: new Date(),
            showSeconds: false,
            showMeridian: false
        });
    $.post("<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php", {codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_GET_LAST_NUMBER; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#numeroBonSortie").val(sData.oId);
            }
    });
    loadUsine = function(codeUsine){
    $.post("<?php echo App::getBoPath(); ?>/usine/UsineController.php", {ACTION: "<?php echo App::ACTION_LIST_VALID; ?>", codeUsine:codeUsine}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                 $("#CMBDESTINATIONS").loadJSON('{"usines":' + data + '}');
            }
    });
    };
    loadUsine("<?php echo $codeUsine;?>");
    loadProduit = function(){
        $.post("<?php echo App::getBoPath(); ?>/produit/ProduitController.php", {codeUsine: "<?php echo $codeUsine; ?>", ACTION: "<?php echo App::ACTION_LIST_REEL_PAR_USINE
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#CMB_DESIGNATIONS").loadJSON('{"designations":' + data + '}');
            }
        });
    };
    loadProduit();
    var i=1;
     $("#add_row_colis").click(function(){
     $('#addrColis'+i).html("<td>"+ (i+1) +"</td><td><input type='number' id='nbColis"+i+"' name='nbColis"+i+"' class='form-control nbColis'/></td>\n\
        <td><select id='qteColis"+i+"' name='qteColis"+i+"' class='form-control qte' ><option value='*' class='qteColis"+i+"'></option></select>");
      $('#tab_logic_colis').append('<tr id="addrColis'+(i+1)+'"></tr>');
        $('#qteColis'+i).select2();
        if($('#CMB_DESIGNATIONS').val()!=='*')
            loadQteColis($('#CMB_DESIGNATIONS').val(), i);
        
      i++;
  });
     $("#delete_row_colis").click(function(){
    	 if(i>1){
		 $("#addrColis"+(i-1)).html('');
		 i--;
		 }
	 });
     $("#delete_row_produit").click(function(){
     $('#tab_produit tbody tr:last').remove();
     console.log(colisage.length);
     var ln= colisage.length -1;
     delete colisage[ln];
     var nc=0;
     var qt=0;
     var mont=0;
     $('#tab_produit tbody').find('tr').each(function(){
        var $this = $(this);
        nc+=parseFloat($('td:eq(1)', $this).text());
        qt+=parseFloat($('td:eq(3)', $this).text());
        mont+=parseFloat($('td:eq(5)', $this).text());
        console.log(nc);
      });
      $('#totalColis').val(nc);
      $('#qteTotal').val(qt);
      $('#montantHt').val(mont);
      var Ttc = mont+(mont * (parseFloat($("#tva").val())/100));
        // montantTtc +=Ttc;
        $('#montantTtc').val(Ttc);
        });
  
 
//    $(document).delegate('#tab_logic_colis tr td', 'change', function (event) {
//        var id = $(this).closest('tr').attr('id');
//        var counter = id.slice(-1);
//        if($('#qteColis'+counter).val()!=='*'){
//          //$( "#qte"+counter ).keyup(function() {
//            verifierPoids('qteColis'+counter, counter);
//        }
//    });
    
//    $('#tab_logic_colis').on('keyup', '.nbColis', function()
//    {
//        alert('dd');
//    });
//    
//    $('#tab_logic_colis').on('change', '.qte', function()
//    {
//       alert('oo'); 
//    });
    
    
     function verifierPoids(qte, counter ){
           var nbColis=parseFloat($("#nbColis"+counter).val());
           console.log(nbColis);
          if(qte!=='*'){
           if(isNaN(nbColis)) {
                $.gritter.add({
                    title: 'Notification',
                   text: 'Veuillez saisir le nombre de colis',
                    class_name: 'gritter-error gritter-light'
                });
                 $("#nbColis"+counter).val("");
                 $('#qteColis'+counter).val("*").change();
            }
            else{
                if(nbColis > qte ){
                  $.gritter.add({
                    title: 'Notification',
                    text: 'Le nombre de colis ou la quantité saisi ne correspond pas au colisage du produit choisi',
                    class_name: 'gritter-error gritter-light '
                });  
                 $("#nbColis"+counter).val("");
                 $('#qteColis'+counter).val("*").change();
                }
                }
            }
            
       }
       $( "#AJOUT_PRODUIT" ).click(function(){
        ajoutLigne();
        });
       function validColisage(){
           var res=0;
           var tabColis=[];
           var produitId = $('#CMB_DESIGNATIONS').val();
           $("#tab_logic_colis tbody tr").each(function(iter) {
            
        var row={};
            var colis=0;
            var quantite=0;
            colis=$(this).find('#nbColis'+iter).val();
            quantite = $(this).find('#qteColis'+iter).select2('data').text;
             if(typeof colis!=='function' && typeof quantite!=='function'){
                    row["produitId"] = produitId;
                    row["nombreCarton"] = colis;
                    row["quantiteParCarton"] = quantite;
            }
            tabColis.push(row);
        });
        var jsonColis=JSON.stringify(tabColis);
        return jsonColis;        
       }
      function ajoutLigne(){
        var pd=0;
        var nbColis=0;
        var i=0;
        var jsonColis = validColisage();
        console.log(jsonColis);
        $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {jsonColis:jsonColis, codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_VERIFY_COLISAGE
                            ; ?>"}, function(data) {
        data=$.parseJSON(data);
         if(data.rc==0)
            if(data.oId>0){
               $.gritter.add({
                title: 'Notification',
                text: 'Le nombre de colis saisi est supérieur à celui du stock réel. Veuillez voir le colisage SVP!',
                class_name: 'gritter-error gritter-light'
            }); 
            }
            else {
        var produitId = $('#CMB_DESIGNATIONS').val();
         var flag = false;
        $('#tab_produit tbody').find('tr').each(function(){
            var $this = $(this);
            if(produitId == $('td:eq(0)', $this).text()){
                flag = true;
                return false;
            }
        });
        if(flag){
             $.gritter.add({
                    title: 'Notification',
                    text: 'Ce produit existe deja, Veuillez changer de produit',
                    class_name: 'gritter-error gritter-light'
                });
                var rowCount = $('#tab_logic_colis tr').length;
                for (var i = 1; i<rowCount; i++) {
                    $("#addrColis"+(i)).html('');
                }
                $('#quantiteSortie').val('');
                $('#nbColis0').val('');
                $('#qteColis0').val('*').change();
                $('#CMB_DESIGNATIONS').val('*').change();
            return;
        }
        
      $('#tab_logic_colis .qte').each(function () {
            if($(this).val()!=='')
                pd+= parseFloat($(this).select2('data').text);
      });
      $('#tab_logic_colis .nbColis').each(function () {
          if($(this).val()!==''){
            nbColis += parseInt($(this).val());
            i++;
          }
        });
        
      //  var produitId = $('#CMB_DESIGNATIONS').val();
        var designationR = $('#CMB_DESIGNATIONS').select2('data').text;
        var designation = designationR.replace(/\(.*?\)/g, '');
        var quantiteSortie = $('#quantiteSortie').val();
       //var rows=[];
       

       
        if(produitId==='*'){
               $.gritter.add({
                    title: 'Notification',
                    text: 'Veuillez choisir un produit',
                    class_name: 'gritter-error gritter-light'
                });
        }
        else if(quantiteSortie===''){
             $.gritter.add({
                    title: 'Notification',
                    text: 'Veuillez sasir la quantite de sortie',
                    class_name: 'gritter-error gritter-light'
                });
       }
       else if(nbColis===0){
            $.gritter.add({
                    title: 'Notification',
                    text: 'Veuillez sasir le nombre de colis',
                    class_name: 'gritter-error gritter-light'
                });
        }
       
        else  {
       var header=["nbColis","qte"];
       var tblColis=[];
      var pNet=0;
        var it=0;
        //var row={};
        $('#tab_logic_colis tbody tr').find('td').each(function(){
            
                var $this = $(this);
                var ncolis=$('#nbColis'+it).val();
                var qte = $('#qteColis'+it).select2('data').text;
                if(typeof ncolis!=='undefined' && typeof qte!=='undefined'){
                   
                    pNet+=parseFloat($('#nbColis'+it).val()) * parseFloat($('#qteColis'+it).select2('data').text);
                    it++;
                }
                
        });
        if(pNet>quantiteSortie){
            $.gritter.add({
                title: 'Notification',
                text: 'La quantité définie ne doit pas etre supérieure à la quantité de sortie (voir colisage)',
                class_name: 'gritter-error gritter-light'
            });
        }
        else if(pNet<quantiteSortie){
            $.gritter.add({
                title: 'Notification',
                text: 'La quantité définie ne doit pas etre inférieure à la quantité de sortie (voir colisage)',
                class_name: 'gritter-error gritter-light'
            });
        }
        else {
        var iter=0;
        $("#tab_logic_colis tbody tr").each(function(iter) {
         //   var row='{';
           // $(this).find('td#nbColis'+iter).eq(1).val();
            //$(this).find('select').val();
            
        var row={};
            var colis=0;
            var quantite=0;
            colis=$(this).find('#nbColis'+iter).val();
            quantite = $(this).find('#qteColis'+iter).select2('data').text;
             if(typeof colis!=='function' && typeof quantite!=='function'){
                    row["produitId"] = produitId;
                    row["nbColis"] = colis;
                    row["qte"] = quantite;
                    
            }
            colisage.push(row);
        });
        
        console.log(JSON.stringify(colisage));
        totalColis+=nbColis;
        qteTotal+=pNet;
        var data="<tr><td class='hidden'>"+produitId+"</td><td>"+nbColis+"</td><td>"+designation+"</td> <td>"+pNet+"</td></tr>";
        $('#tab_produit tbody').append(data);
        $('#totalColis').val(totalColis);
        $('#qteTotal').val(qteTotal);
        $('#CMB_DESIGNATIONS').val('*').change();
        $('#quantiteSortie').val('');
        var rowCount = $('#tab_logic_colis tr').length;
        for (var i = 1; i<rowCount; i++) {
            $("#addrColis"+(i)).html('');
        }
        $('#nbColis0').val('');
        $('#qteColis0').val('*').change();
        $('#prixUnitaire').val(''); 
        $('#stockReel').val('');
       }
       }
       
       } });
    }
    $('#CMB_DESIGNATIONS').change(function() {
        if($('#CMB_DESIGNATIONS').val()!=='*') {
            $('#qteColis0').val("*").change();
            loadQuantiteStock($('#CMB_DESIGNATIONS').val());
            loadQteColis($('#CMB_DESIGNATIONS').val(), 0);
        }
        
    });
    
    $("#quantiteSortie").keyup(function() {
           var stockReel = parseFloat($("#stockReel").val());
           var quantiteSortie = parseFloat($("#quantiteSortie").val());
           if(!isNaN(stockReel)){
               if(quantiteSortie > stockReel){
                   $.gritter.add({
                        title: 'Notification',
                        text: 'La quantite de sortie ne doit pas être supérieur au stock réel (voir colisage)',
                        class_name: 'gritter-error gritter-light'
                    });
                   $("#quantiteSortie").val('');
               }
            }
            else {
                $.gritter.add({
                        title: 'Notification',
                        text: 'La stock réel ne doit pas être vide',
                        class_name: 'gritter-error gritter-light'
                    });
                   $("#quantiteSortie").val('');
            }
//        
      });
  
   loadQuantiteStock = function (produitId) {
        $.post("<?php echo App::getBoPath(); ?>/stock/StockController.php", {produitId:produitId, codeUsine:"<?php echo $codeUsine;?>", ACTION: "<?php echo App::ACTION_GET_STOCK; ?>"}, function (data) {
        sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                if(sData.nbStocks>0)
                    $("#stockReel").val(sData.nbStocks);
                else{
                    $.gritter.add({
                        title: 'Notification',
                        text: 'Ce produit est en rupture de stock',
                        class_name: 'gritter-error gritter-light'
                    });
                     $('#CMB_DESIGNATIONS').val("*").change();
                     $('#stockReel').val("");
                }
            }
    });
    };
   loadQteColis = function(produitId, index){
        $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {produitId: produitId, codeUsine:"<?php echo $codeUsine;?>",ACTION: "<?php echo App::ACTION_GET_INFOS
                ; ?>"}, function(data) {
            sData=$.parseJSON(data);
            if(sData.rc==-1){
                $.gritter.add({
                        title: 'Notification',
                        text: sData.error,
                        class_name: 'gritter-error gritter-light'
                    });
            }else{
                $("#qteColis"+index).loadJSON('{"qteColis'+index+'":' + data + '}');
            }
        });
    };
    showPopover = function(idButton, colis){
        $("#" + idButton).popover({
            html: true,
            trigger: 'auto',
            placement: 'top',
            title: '<i class="icon-group icon-"></i> Détail colis ',
            content: colis
        }).popover('toggle');
     };    
         
     $( "#VOIR_COLISAGE" ).click(function(){
         if( $('#CMB_DESIGNATIONS').val() !=='*') {
         $("#VOIR_COLISAGE").popover('destroy');
        $.post("<?php echo App::getBoPath(); ?>/demoulage/DemoulageController.php", {produitId: $('#CMB_DESIGNATIONS').val(), codeUsine:"<?php echo $codeUsine;?>", ACTION: "<?php echo App::ACTION_GET_COLIS; ?>"}, function(data) {
        data=$.parseJSON(data);

        var htmlString="<a class='close' id='closed' style='position: absolute; top: 0; right: 6px;'>&times;</a>";
        htmlString+="<div class='popover-medium' style='width: 550px;'> Liste des colis disponibles<hr>";
        $.each(data , function(i) { 
            str= data [i].toString();
            var substr = str.split(',');
            htmlString+="<span><b>"+substr [0]+" colis de "+substr [1]+" kg<b></span><br /><hr>";
        // htmlString+="<span><b> Quantité</b>: "+substr [1]+"</span><br /><hr>";

          });
          htmlString+="</div>";
        showPopover("VOIR_COLISAGE", ""+htmlString+"");
        });
        }
    });   
         
          BonSortieProcess = function ()
        {
            $('#SAVE').attr("disabled", true);
            var ACTION = '<?php echo App::ACTION_INSERT; ?>';
            var origine = '<?php echo $codeUsine?>';
            var numeroBonSortie = $("#numeroBonSortie").val();
            var heureSortie= $('#heureSortie').val();
            var numeroCamion = $("#numeroCamion").val();
            var nomChauffeur = $("#nomChauffeur").val();
            var totalColis = $("#totalColis").val();
            var poidsTotal = $("#qteTotal").val();
            var codeUsine = "<?php echo $codeUsine ?>";
            var codeUsineDestination = $("#CMBDESTINATIONS").val();
            var login = "<?php echo $login ?>";
            var $table = $("#tab_produit");
            rows = [],
            header = [];
            header = ["produitId","nombreCarton","designation","qte"];
            $table.find("tbody tr").each(function () {
                var row = {};

                $(this).find("td").each(function (i) {
                    var key = header[i];
                    var value;
                       // valueSelect = $(this).find('select').val();
                        valueInput = $(this).html();
                    if (typeof valueInput !== "undefined")
                        value=valueInput;
                   
                    row[key] = value;
                });

                rows.push(row);
            });
            var tbl=JSON.stringify(rows);
            console.log(tbl);
            var formData = new FormData();
            formData.append('ACTION', ACTION);
            formData.append('dateBonSortie', dateAchat);
            formData.append('heureSortie', heureSortie);
            formData.append('origine', origine);
            formData.append('numeroBonSortie', numeroBonSortie);
            formData.append('numeroCamion', numeroCamion);
            formData.append('nomChauffeur', nomChauffeur);
            formData.append('jsonProduit', tbl);
            formData.append('jsonColis', JSON.stringify(colisage));
            formData.append('totalColis', totalColis);
            formData.append('poidsTotal', poidsTotal);
            formData.append('codeUsine', codeUsine);
            formData.append('codeUsineDestination', codeUsineDestination);
            formData.append('login', login);
            $.ajax({
                url: '<?php echo App::getBoPath(); ?>/bonsortie/BonSortieController.php',
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
                       $("#MAIN_CONTENT").load("<?php echo App::getHome(); ?>/app/bonSortie/bonSortieListe.php", function () {
                        });
                    } 
                    else
                    {
                        $.gritter.add({
                            title: 'Notification',
                            text: data.error,
                            class_name: 'gritter-error gritter-light'
                        });
                         $('#SAVE').attr("disabled", false);
                        
                    };
                    
                },
                error: function () {
                    alert("failure - controller");
                    $('#SAVE').attr("disabled", false);
                }
            });

        };  
        
        //Validate
        $("#SAVE").bind("click", function () {
        $.validator.addMethod("notEqual", function(value, element, param) {
            return this.optional(element) || value != param;
        });     
        $('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: false,
			ignore: "",
			rules: {
			
                        CMBDESTINATIONS: {
                            notEqual: "*" 
                        },
                        
                        qteTotal: {
                            required:true
                        },
                        
			 totalColis: {
                            required:true
                        },
                        
			 nomChauffeur: {
                            required:true
                        },
                        
			 numeroCamion: {
                            required:true
                        }	
			},
	
			messages: {
                            CMBDESTINATIONS: {
                                notEqual:"Champ obligatoire."
                            },
                            qteTotal: {
                                required:"Champ obligatoire."
                            },
                             totalColis: {
                                required:"Champ obligatoire."
                        },
                        
			 nomChauffeur: {
                            required:"Champ obligatoire."
                        },
                        
			 numeroCamion: {
                            required:"Champ obligatoire."
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
                            BonSortieProcess();
			},
			invalidHandler: function (form) {
			}
		});

        });
   });
</script>
