<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

 require_once('../../html2pdf.class.php');
$factureId = $_GET['factureId'];
$paramsConnexion = parse_ini_file("../../config/parameters.ini");
// $usineCode = $_GET['codeUsine'];
$hostname = $paramsConnexion['host'];
$database = $paramsConnexion['dbname'];
$username = $paramsConnexion['user'];
$password = $paramsConnexion['password'];
$connexion = mysqli_connect($hostname, $username, $password) or trigger_error(mysqli_error(), E_USER_ERROR);
mysqli_select_db($connexion, $database);
$sql = "SELECT numero FROM facture where id=$factureId";
$Result = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
$row = mysqli_fetch_array($Result);
    // get the HTML
    ob_start();
    include(dirname(__FILE__).'/factureContenuPdf.php');
   // include(dirname(__FILE__).'/res/exemple07b.php');
    $content = ob_get_clean();

    // convert to PDF
    require_once('../../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
//      $html2pdf->pdf->SetProtection(array('print'), 'spipu');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Facture_'.$row['numero'].'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    
    ?>
<script type="text/javascript">
       alert("og");
//     getIndicator = function() {
//                var url;
//                var user;
//                url = '<?php echo App::getBoPath(); ?>/achat/AchatController.php';
//                $.ajax({
//                    url: url,
//                    type: 'POST',
//                    dataType: 'JSON',
//                    data: 'ACTION=<?php echo App::ACTION_VIEW_DETAILS; ?>&achatId=70',
//                    cache: false,
//                    success: function(data) {~
//                        $('#ACHATS').text(data.id);
//                        $('#PRENOMCLIENT').text(data.nom);
//                        $('#NOMCLIENT').text(data.prenom);
//                      
//
//                    }
//                });
//            };
//            
//            getIndicator();
            
            
 </script>