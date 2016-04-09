<?php
$paramsConnexion = parse_ini_file("../../config/parameters.ini");
$usineCode = $_GET['codeUsine'];
$hostname = $paramsConnexion['host'];
$database = $paramsConnexion['dbname'];
$username = $paramsConnexion['user'];
$password = $paramsConnexion['password'];
$connexion = mysqli_connect($hostname, $username, $password) or trigger_error(mysqli_error(), E_USER_ERROR);
mysqli_set_charset($connexion, "utf8");
mysqli_select_db($connexion, $database);
$sql = "SELECT nomUsine FROM usine WHERE code='$usineCode'";
$Result = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
$row = mysqli_fetch_array($Result);
//Cette requete permet de recuperer les produits d'une usine
$sqlProduit="SELECT p.libelle designation, sr.stock stock FROM produit p, stock_reel sr WHERE stock<>0.00 AND p.id=sr.produit_id AND codeUsine='$usineCode' GROUP BY p.id";
$ResultProduit = mysqli_query($connexion, $sqlProduit) or die(mysqli_error($connexion));
?>

<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }

-->
</style>
<page orientation="paysage" format="A5" backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;heure;page" style="font-size: 12pt">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 40%; ">
                <span style="font-size: 20px;color:#68BC31" >MACFISH</span>
                <br>
                 <span style="font-size: 20px;color:#68BC31" >PRODUCTION SUARL</span>
                 <br><br>
                <span >TEL : 338218470 / 338363512</span>
            </td>
            <td style="width: 40%;">
                <span style="margin-left:30px;"></span>
            </td>
            <td style="width: 25%; color: #444444;">
                Dakar, le <?php echo date("d-m-Y");  ;?>
            </td>
        </tr>
    </table>
<!--     <br> -->
<!--     <br> -->
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:40%;"></td>
            <td style="width:40%; "><span  style="font-size: 25px;" >Stock Réel de <?php echo $row['nomUsine']; ?></span></td>
            <td ></td>
        </tr>
    </table>
    
    <br>
<!--     <br> -->
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 80%">Désignation</th>
            <th style="width: 20%;">Stock Réel</th>
        </tr>
    </table>
    
<?php
    $total =0;
    $totalPrix=0;
    $totalQuantite=0;
   while ($rowProduit = mysqli_fetch_array($ResultProduit)) {
//        $total =$total+ $rowProduit['montant'];
//        $totalPrix =$totalPrix+ $rowProduit['prixUnitaire'];
       $totalQuantite =$totalQuantite+ $rowProduit['stock'];
?>
    <table cellspacing="0"  style="width: 100%; height:100%; border: solid 0px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 80%; text-align: left"><?php echo $rowProduit['designation']; ?></td>
            <td style="width: 20%; text-align: left"><?php echo $rowProduit['stock']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 80%; text-align: left;">Total : </th>
            <th style="width: 20%; text-align: left;"><?php echo number_format($totalQuantite, 0, ',', ' '); ?>kg </th>
        </tr>
    </table>

  
</page>
