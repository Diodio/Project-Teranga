<?php
$paramsConnexion = parse_ini_file("../../config/parameters.ini");
//$empotageId = $_GET['factureId'];
$hostname = $paramsConnexion['host'];
$database = $paramsConnexion['dbname'];
$username = $paramsConnexion['user'];
$password = $paramsConnexion['password'];
$connexion = mysqli_connect($hostname, $username, $password) or trigger_error(mysqli_error(), E_USER_ERROR);
mysqli_set_charset($connexion, "utf8");
mysqli_select_db($connexion, $database);
$sql = "SELECT * FROM empotage, client WHERE client.id=client_id AND empotage.id=" . $empotageId;
$Result = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
$row = mysqli_fetch_array($Result);

$sqlConteneur = "SELECT * FROM conteneur WHERE empotage_id=" . $empotageId;
$ResultConteneur = mysqli_query($connexion, $sqlConteneur) or die(mysqli_error($connexion));
//$rowConteneur = mysqli_fetch_array($ResultConteneur);

$sqlProduit = "SELECT nbColis, libelle, prixUnitaire, quantite, montant FROM empotage f,ligne_empotage lf,produit p WHERE f.id=lf.empotage_id AND lf.produit_id=p.id AND f.id=" . $empotageId;
$ResultProduit = mysqli_query($connexion, $sqlProduit) or die(mysqli_error($connexion));

?>
<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }

-->
</style>
<page backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;heure;page" style="font-size: 12pt">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 40%; ">
                <span style="font-size: 20px;color:#68BC31;" >MACFISH</span>
                <br>
                 <span style="font-size: 20px;color:#68BC31;" >PRODUCTION SUARL</span>
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
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:30%;"></td>
            <td style="width:30%; "><span  style="font-size: 25px;" >Empotage</span></td>
            <td style="font-size: 14px;width:30%;text-align: right">Numero: <?php echo $row['numero']; ?></td>
        </tr>
    </table>
    
<!--     <br> -->
<!--     <br> -->
    <table cellspacing="0" style="color:#444444;width: 100%; text-align: left; font-size: 14px">
       <tr>
         <td >
                    Client: <?php echo $row['nom']; ?>
            </td>
        </tr>
        <tr >
            <td style="width: 50%">
                <?php 
                $usine=$row['codeUsine'];
                   $sql1 = "SELECT nomUsine FROM usine WHERE code='$usine'";
                    $Result1 = mysqli_query($connexion, $sql1) or die(mysqli_error($connexion));
                    $row1 = mysqli_fetch_array($Result1);
                
                ?>
                Destination: <?php echo $row1['nomUsine']; ?>
            </td>
           
        </tr>
        <tr>
         <td >
                    Pays: <?php echo $row['pays']; ?>
            </td>
        </tr>
        
    </table>
       
    
    <br>
<!--     <br> -->
<h2>Liste des produits</h2>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 20%">Nombre de colis</th>
            <th style="width: 40%">Désignation</th>
            <th style="width: 40%; text-align: right;">Quantité(kg)</th>
        </tr>
    </table>
    
<?php
    $nbColis=0;
    $total =0;
    $totalPrix=0;
   while ($rowProduit = mysqli_fetch_array($ResultProduit)) {
       $total =$total+ $rowProduit['quantite'];
       $nbColis =$nbColis+ $rowProduit['nbColis'];
      // $totalPrix =$totalPrix+ $rowProduit['prixUnitaire'];
?>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 20%; text-align: left"><?php echo $rowProduit['nbColis']; ?></td>
            <td style="width: 40%; text-align: left"><?php echo $rowProduit['libelle']; ?></td>
            <td style="width: 40%; text-align: right;"><?php echo $rowProduit['quantite']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 50%; text-align: left;"><?php echo number_format($nbColis); ?> </th>
            <th style="width: 50%; text-align: right;"><?php echo number_format($total); ?> kg</th>
        </tr>
    </table>
    <br>
    
<h2>Conteneur et Numero Plomb</h2>
      <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 20%">Numero content</th>
            <th style="width: 40%">Numero plomb</th>
        </tr>
    </table>
    
<?php
    
   while ($rowConteneur = mysqli_fetch_array($ResultConteneur)) {
      
      // $totalPrix =$totalPrix+ $rowProduit['prixUnitaire'];
?>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 20%; text-align: left"><?php echo $rowConteneur['numConteneur']; ?></td>
            <td style="width: 40%; text-align: left"><?php echo $rowConteneur['numPlomb']; ?></td>
        </tr>
    </table>
<?php
    }
?>
   
    <br>
    
<!--    <nobreak>
        <br>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:25%;">Le Peseur</td>
                <td style="width:25%"></td>
                <td style="width:38%"></td>
                <td style="width:25%"> Le Mareyeur</td>
            </tr>
        </table>
    </nobreak>-->
</page>

