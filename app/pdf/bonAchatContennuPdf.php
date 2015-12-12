<?php
$paramsConnexion = parse_ini_file("../../config/parameters.ini");
$achatId = $_GET['achatId'];
$hostname = $paramsConnexion['host'];
$database = $paramsConnexion['dbname'];
$username = $paramsConnexion['user'];
$password = $paramsConnexion['password'];
$connexion = mysqli_connect($hostname, $username, $password) or trigger_error(mysqli_error(), E_USER_ERROR);
mysqli_set_charset($connexion, "utf8");
mysqli_select_db($connexion, $database);
$sql = "SELECT * FROM mareyeur,achat WHERE mareyeur.id=mareyeur_id AND achat.id=" . $achatId;
$Result = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
$row = mysqli_fetch_array($Result);
//Cette requete permet de recuperer les produits d'un achat
$sqlProduit="SELECT p.libelle designation,al.prixUnitaire prixUnitaire,al.quantite quantite,al.montant montant FROM achat a, ligne_achat al, produit p WHERE a.id=al.achat_id AND al.produit_id=p.id AND a.id=" . $achatId;
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
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:40%;"></td>
            <td style="width:30%; "><span  style="font-size: 25px;" >BON D'ACHAT</span></td>
            <td >Numero: <?php echo $row['numero']; ?></td>
        </tr>
    </table>
    <table cellspacing="0" style="color:#444444";width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td >
                Mareyeur: <?php echo $row['nom']; ?>
            </td>
        </tr>
        <tr>
        <td >
                Origine: <?php echo $row['adresse']; ?>
        </td>
        </tr>
        <tr>
        <td >
                Heure de reception: <?php echo $row['heureReception']; ?>
        </td>
        </tr>
    </table>
    
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 42%">Désignation</th>
            <th style="width: 18%;">Prix Unitaire</th>
            <th style="width: 15%; text-align: right;">Quantité</th>
            <th style="width: 25%;text-align: right;">Montant</th>
        </tr>
    </table>
    
<?php
    $total =0;
    $totalPrix=0;
    $totalQuantite=0;
   while ($rowProduit = mysqli_fetch_array($ResultProduit)) {
       $total =$total+ $rowProduit['montant'];
       $totalPrix =$totalPrix+ $rowProduit['prixUnitaire'];
       $totalQuantite =$totalQuantite+ $rowProduit['quantite'];
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 42%; text-align: left"><?php echo $rowProduit['designation']; ?></td>
            <td style="width: 18%; text-align: left"><?php echo $rowProduit['prixUnitaire']; ?> </td>
            <td style="width: 15%; text-align: right"><?php echo $rowProduit['quantite']; ?></td>
            <td style="width: 25%; text-align: right;"><?php echo $rowProduit['montant']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 18%; text-align: left;">Total : </th>
            <th style="width: 31%; text-align: right;"><?php echo number_format($totalPrix, 2, ',', ' '); ?> </th>
            <th style="width: 26%; text-align: right;"><?php echo number_format($totalQuantite, 0, ',', ' '); ?>kg </th>
            <th style="width: 25%; text-align: right;"><?php echo number_format($total, 2, ',', ' '); ?> </th>
        </tr>
    </table>
    <br>
    
    <nobreak>
        <br>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:25%;">Le Comptable</td>
                <td style="width:25%"></td>
                <td style="width:38%"></td>
                <td style="width:25%"> Le Mareyeur</td>
            </tr>
        </table>
    </nobreak>
    
    <br/><br/><br/>
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 40%; ">
                <span style="font-size: 20px;color:blue" >MACFISH</span>
                <br>
                 <span style="font-size: 20px;color:blue" >PRODUCTION SUARL</span>
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
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:40%;"></td>
            <td style="width:30%; "><span  style="font-size: 25px;" >BON D'ACHAT</span></td>
            <td >Numero: <?php echo $row['numero']; ?></td>
        </tr>
    </table>
    <table cellspacing="0" style="color:#444444";width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td >
                Mareyeur: <?php echo $row['nom']; ?>
            </td>
        </tr>
        <tr>
        <td >
                Origine: <?php echo $row['adresse']; ?>
        </td>
        </tr>
        <tr>
        <td >
                Heure de reception: <?php echo $row['heureReception']; ?>
        </td>
        </tr>
    </table>
    
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 42%">Désignation</th>
            <th style="width: 18%;">Prix Unitaire</th>
            <th style="width: 15%; text-align: right;">Quantité</th>
            <th style="width: 25%;text-align: right;">Montant</th>
        </tr>
    </table>
    
<?php
    $total =0;
    $totalPrix=0;
    $totalQuantite=0;
   while ($rowProduit = mysqli_fetch_array($ResultProduit)) {
       $total =$total+ $rowProduit['montant'];
       $totalPrix =$totalPrix+ $rowProduit['prixUnitaire'];
       $totalQuantite =$totalQuantite+ $rowProduit['quantite'];
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 42%; text-align: left"><?php echo $rowProduit['designation']; ?></td>
            <td style="width: 18%; text-align: left"><?php echo $rowProduit['prixUnitaire']; ?> </td>
            <td style="width: 15%; text-align: right"><?php echo $rowProduit['quantite']; ?></td>
            <td style="width: 25%; text-align: right;"><?php echo $rowProduit['montant']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 18%; text-align: left;">Total : </th>
            <th style="width: 31%; text-align: right;"><?php echo number_format($totalPrix, 2, ',', ' '); ?> </th>
            <th style="width: 26%; text-align: right;"><?php echo number_format($totalQuantite, 0, ',', ' '); ?>kg </th>
            <th style="width: 25%; text-align: right;"><?php echo number_format($total, 2, ',', ' '); ?> </th>
        </tr>
    </table>
    <br>
    
    <nobreak>
        <br>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:25%;">Le Comptable</td>
                <td style="width:25%"></td>
                <td style="width:38%"></td>
                <td style="width:25%"> Le Mareyeur</td>
            </tr>
        </table>
    </nobreak>
</page>
