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
$ResultProduit1 = mysqli_query($connexion, $sqlProduit) or die(mysqli_error($connexion));

$sqlAvance="SELECT SUM(avance) sommeAvance FROM reglement_achat WHERE achat_id=" . $achatId;
$ResultAvance = mysqli_query($connexion, $sqlAvance) or die(mysqli_error($connexion));
$rowAvance = mysqli_fetch_array($ResultAvance);
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
                <span style="font-size: 18px;color:#68BC31" >MACFISH</span>
                <br>
                 <span style="font-size: 18px;color:#68BC31" >PRODUCTION SUARL</span>
                 <br><br>
                <span >TEL : 338218470 / 338363512</span>
            </td>
            <td style="width: 40%;">
                <br>
                <br>
                <span  style="font-size: 18px;" >BON D'ACHAT
                N° <?php echo $row['numero']; ?></span>
            </td>
            <td style="width: 25%; color: #444444;">
                Dakar, le <?php echo date("d-m-Y");  ;?>
                
            </td>
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="margin-top:-10px;color:#444444";width: 100%; text-align: center; font-size: 14px">
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
    <span  style="font-size: 14px;margin-top:-12px;font-weight: bold;" >Liste des produits</span>
    <hr>
    <br>
    <table cellspacing="0" style="margin-top:-45px;width: 100%; border: solid 0px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 18%; text-align: left;">Désignation</th>
            <th style="width: 35%; text-align: right;">Prix Unitaire</th>
            <th style="width: 22%; text-align: right;">Quantité</th>
            <th style="width: 25%;text-align: right;">Montant</th>
        </tr>
    </table>
    
<?php
    $total =0.0;
    $totalPrix=0.0;
    $totalQuantite=0.0;
   while ($rowProduit = mysqli_fetch_array($ResultProduit)) {
       $total = floatval($total) + floatval($rowProduit['montant']);
       $totalPrix = floatval($totalPrix) + floatval($rowProduit['prixUnitaire']);
       $totalQuantite = floatval($totalQuantite) + floatval($rowProduit['quantite']);
?>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left"><?php echo $rowProduit['designation']; ?></td>
            <td style="width: 31%; text-align: right"><?php echo $rowProduit['prixUnitaire']; ?> </td>
            <td style="width: 26%; text-align: right"><?php echo $rowProduit['quantite']; ?></td>
            <td style="width: 25%; text-align: right;"><?php echo $rowProduit['montant']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="margin-top:3px;width: 100%; border: solid 0px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 18%; text-align: left;">Total : </th>
            <th style="width: 31%; text-align: right;"><?php echo $totalPrix; ?> </th>
            <th style="width: 28%; text-align: right;"><?php echo $totalQuantite; ?> kg </th>
            <th style="width: 23%; text-align: right;"><?php echo $total; ?> </th>
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Mode de paiement </td>
            <td style="width: 25%; text-align: right;"><?php echo $row['modePaiement'] ?> </td>
        </tr>
    </table>
    <?php if($row['modePaiement'] =='CHEQUE') {?>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">N° chèque </td>
            <td style="width: 25%; text-align: right;"><?php echo $row['numCheque'] ?> </td>
        </tr>
    </table>
    <?php }?>
    <?php if($row['modePaiement'] =='VIREMENT') {?>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Date paiement </td>
            <td style="width: 25%; text-align: right;"><?php echo $row['datePaiement'] ?> </td>
        </tr>
    </table>
    <?php }?>
   <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Avance </td>
            <td style="width: 25%; text-align: right;"><?php if($rowAvance['sommeAvance']!="") echo $rowAvance['sommeAvance']; else echo 0 ?> </td>
        </tr>
    </table>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Reliquat </td>
            <td style="width: 25%; text-align: right;"><?php echo  $total - $rowAvance['sommeAvance'] ?> </td>
        </tr>
    </table>
    <nobreak>
        <br>
        <table cellspacing="0" style="margin-top:0px;width: 100%; text-align: left;">
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
    <table cellspacing="0" style="margin-top:-45px;width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 40%; ">
                <span style="font-size: 20px;color:#68BC31" >MACFISH</span>
                <br>
                 <span style="font-size: 20px;color:#68BC31" >PRODUCTION SUARL</span>
                 <br><br>
                <span >TEL : 338218470 / 338363512</span>
            </td>
            <td style="width: 40%;">
                <br>
                <br>
                <span  style="font-size: 25px;" >BON D'ACHAT
                N° <?php echo $row['numero']; ?></span>
            </td>
            <td style="width: 25%; color: #444444;">
                Dakar, le <?php echo date("d-m-Y");  ;?>
                
            </td>
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="margin-top:-10px;color:#444444";width: 100%; text-align: center; font-size: 14px">
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
    <span  style="font-size: 14px;margin-top:-12px;font-weight: bold;" >Liste des produits</span>
    <hr>
    <br>
    <table cellspacing="0" style="margin-top:-40px;width: 100%; border: solid 0px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 18%; text-align: left;">Désignation</th>
            <th style="width: 35%; text-align: right;">Prix Unitaire</th>
            <th style="width: 22%; text-align: right;">Quantité</th>
            <th style="width: 25%;text-align: right;">Montant</th>
        </tr>
    </table>
    
<?php
    $total =0.0;
    $totalPrix=0.0;
    $totalQuantite=0.0;
   while ($rowProduit1 = mysqli_fetch_array($ResultProduit1)) {
       $total = floatval($total) + floatval($rowProduit1['montant']);
       $totalPrix = floatval($totalPrix) + floatval($rowProduit1['prixUnitaire']);
       $totalQuantite = floatval($totalQuantite) + floatval($rowProduit1['quantite']);
?>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left"><?php echo $rowProduit1['designation']; ?></td>
            <td style="width: 31%; text-align: right"><?php echo $rowProduit1['prixUnitaire']; ?> </td>
            <td style="width: 26%; text-align: right"><?php echo $rowProduit1['quantite']; ?></td>
            <td style="width: 25%; text-align: right;"><?php echo $rowProduit1['montant']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 100%; border: solid 0px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 18%; text-align: left;">Total : </th>
            <th style="width: 31%; text-align: right;"><?php echo $totalPrix; ?> </th>
            <th style="width: 28%; text-align: right;"><?php echo $totalQuantite; ?> kg </th>
            <th style="width: 23%; text-align: right;"><?php echo $total; ?> </th>
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Mode de paiement </td>
            <td style="width: 25%; text-align: right;"><?php echo $row['modePaiement'] ?> </td>
        </tr>
    </table>
    <?php if($row['modePaiement'] =='CHEQUE') {?>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">N° chèque </td>
            <td style="width: 25%; text-align: right;"><?php echo $row['numCheque'] ?> </td>
        </tr>
    </table>
    <?php }?>
    <?php if($row['modePaiement'] =='VIREMENT') {?>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Date paiement </td>
            <td style="width: 25%; text-align: right;"><?php echo $row['datePaiement'] ?> </td>
        </tr>
    </table>
    <?php }?>
   <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Avance </td>
            <td style="width: 25%; text-align: right;"><?php if($rowAvance['sommeAvance']!="") echo $rowAvance['sommeAvance']; else echo 0 ?> </td>
        </tr>
    </table>
    <table cellspacing="0" style="text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 18%; text-align: left;"> </td>
            <td style="width: 31%; text-align: right;"></td>
            <td style="width: 26%; text-align: right;">Reliquat </td>
            <td style="width: 25%; text-align: right;"><?php echo  $total - $rowAvance['sommeAvance'] ?> </td>
        </tr>
    </table>
    <nobreak>
        <br>
        <table cellspacing="0" style="margin-top:0px;width: 100%; text-align: left;">
            <tr>
                <td style="width:25%;">Le Comptable</td>
                <td style="width:25%"></td>
                <td style="width:38%"></td>
                <td style="width:25%"> Le Mareyeur</td>
            </tr>
        </table>
    </nobreak>
</page>
