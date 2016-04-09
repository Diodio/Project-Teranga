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
hr {
	height: none;
	border: none;
	border-top: 1px dashed grey;
}
-->
</style>
<page orientation="portrait" format="A4" backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="33mm" style="font-size: 12pt; background-image: url("../../assets/img/logo.png")">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 90%; text-align: center; font-size: 12px; margin-top: 20px;">
        <tr>
            <td style="width: 40%; ">
                <span style="font-size: 16px;color:#68BC31" >MACFISH</span>
                <br>
                 <span style="font-size: 16px;color:#68BC31" >PRODUCTION SUARL</span>
                 <br><br>
                <span >TEL : 338218470 / 338363512</span>
            </td>
            <td style="width: 40%;">
                <br>
                <br>
                <span  style="font-size: 16px;" >BON D'ACHAT
                N° <?php echo $row['numero']; ?></span>
            </td>
            <td style="width: 25%; color: #444444;">
                Dakar, le <?php echo date("d-m-Y");  ;?>
                
            </td>
        </tr>
    </table>
    <br>
    <div style="margin-left:40px; ">
    <table cellspacing="0" style="margin-top:-10px;color:#444444;width: 90%; text-align: left;  font-size: 12px">
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
    </div>
    <br>
     <div style="margin-left:40px;">
    <span  style="font-size: 12px;margin-top:-13px;font-weight: bold;" >Liste des produits</span>
<!--     <hr> -->
    <br>
    <table cellspacing="0" style="margin-top:-10px;width: 90%; border: solid 0px black; background: #E7E7E7; text-align: left; font-size: 9pt;">
        <tr>
            <th style="width: 25%; text-align: left;">Désignation</th>
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
    <table cellspacing="0" style="width: 90%; border: solid 0px black; background: #F7F7F7; text-align: left; font-size: 10px;">
        <tr>
            <td style="width: 25%; text-align: left"><?php echo $rowProduit['designation']; ?></td>
            <td style="width: 31%; text-align: right"><?php echo $rowProduit['prixUnitaire']; ?> </td>
            <td style="width: 26%; text-align: right"><?php echo $rowProduit['quantite']; ?></td>
            <td style="width: 25%; text-align: right;"><?php echo $rowProduit['montant']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="margin-top:3px;width: 90%; border: solid 0px black; background: #E7E7E7; text-align: center; font-size: 9pt;">
        <tr>
            <th style="width: 25%; text-align: left;">Total : </th>
            <th style="width: 31%; text-align: right;"><?php echo $totalPrix; ?> </th>
            <th style="width: 28%; text-align: right;"><?php echo $totalQuantite; ?> kg </th>
            <th style="width: 23%; text-align: right;"><?php echo $total; ?> </th>
        </tr>
    </table>
    <br>
    <div style="margin-left:40px;">
    <table cellspacing="0" style="text-align: center; font-size: 13px; margin-left: " >
        <tr>
            <td style="width: 25%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Mode de paiement </td>
            <td style="width: 30%;"><b><?php echo $row['modePaiement'] ?></b> </td>
        </tr>
    </table>
    <?php if($row['modePaiement'] =='CHEQUE') {?>
    <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">N° chèque </td>
            <td style="width: 25%;"><b><?php echo $row['numCheque'] ?></b> </td>
        </tr>
    </table>
    <?php }?>
    <?php if($row['modePaiement'] =='VIREMENT') {?>
    <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Date paiement </td>
            <td style="width: 25%;"><b><?php echo $row['datePaiement'] ?> </b> </td>
        </tr>
    </table>
    <?php }?>
   <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Avance </td>
            <td style="width: 25%;"><b><?php if($rowAvance['sommeAvance']!="") echo $rowAvance['sommeAvance']; else echo 0.00 ?> FCFA </b> </td>
        </tr>
    </table>
    <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Reliquat </td>
            <td style="width: 25%;"><b><?php echo  $total - $rowAvance['sommeAvance'] ?>  FCFA</b> </td>
        </tr>
    </table>
    <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Transport </td>
            <td style="width: 25%;"><b><?php if($row['transport']>0) echo $row['transport']; else echo "0"; ?>  FCFA</b> </td>
        </tr>
    </table>
     </div>
<!--    <nobreak>
        <br>
        <table cellspacing="0" style="margin-top:0px;width: 90%; text-align: left;">
            <tr>
                <td style="width:25%;">Le Comptable</td>
                <td style="width:25%"></td>
                <td style="width:38%"></td>
                <td style="width:25%"> Le Mareyeur</td>
            </tr>
        </table>
    </nobreak>-->
     </div>
<!--     <br/> -->
    <hr>
    <br/>
       <table cellspacing="0" style="width: 90%; text-align: center; font-size: 12px">
        <tr>
            <td style="width: 40%; ">
                <span style="font-size: 16px;color:#68BC31" >MACFISH</span>
                <br>
                 <span style="font-size: 16px;color:#68BC31" >PRODUCTION SUARL</span>
                 <br><br>
                <span >TEL : 338218470 / 338363512</span>
            </td>
            <td style="width: 40%;">
                <br>
                <br>
                <span  style="font-size: 16px;" >BON D'ACHAT
                N° <?php echo $row['numero']; ?></span>
            </td>
            <td style="width: 25%; color: #444444;">
                Dakar, le <?php echo date("d-m-Y");  ;?>
                
            </td>
        </tr>
    </table>
    <br>
    <div style="margin-left:40px;">
    <table cellspacing="0" style="margin-top:-10px;color:#444444;width: 90%; text-align: left;  font-size: 12px">
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
    </div>
    <br>
     <div style="margin-left:40px;">
    <span  style="font-size: 12px;margin-top:-13px;font-weight: bold;" >Liste des produits</span>
<!--     <hr> -->
    <br>
    <table cellspacing="0" style="margin-top:-10px;width: 90%; border: solid 0px black; background: #E7E7E7; text-align: left; font-size: 9pt;">
        <tr>
            <th style="width: 25%; text-align: left;">Désignation</th>
            <th style="width: 35%; text-align: right;">Prix Unitaire</th>
            <th style="width: 22%; text-align: right;">Quantité</th>
            <th style="width: 25%;text-align: right;">Montant</th>
        </tr>
    </table>
    
<?php
    $total1 =0.0;
    $totalPrix1=0.0;
    $totalQuantite1=0.0;
   while ($rowProduit1 = mysqli_fetch_array($ResultProduit1)) {
       $total1 = floatval($total1) + floatval($rowProduit1['montant']);
       $totalPrix1 = floatval($totalPrix1) + floatval($rowProduit1['prixUnitaire']);
       $totalQuantite1 = floatval($totalQuantite1) + floatval($rowProduit1['quantite']);
?>
    <table cellspacing="0" style="width: 90%; border: solid 0px black; background: #F7F7F7; text-align: left; font-size: 10px;">
        <tr>
            <td style="width: 25%; text-align: left"><?php echo $rowProduit1['designation']; ?></td>
            <td style="width: 31%; text-align: right"><?php echo $rowProduit1['prixUnitaire']; ?> </td>
            <td style="width: 26%; text-align: right"><?php echo $rowProduit1['quantite']; ?></td>
            <td style="width: 25%; text-align: right;"><?php echo $rowProduit1['montant']; ?> </td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="margin-top:3px;width: 90%; border: solid 0px black; background: #E7E7E7; text-align: center; font-size: 9pt;">
        <tr>
            <th style="width: 25%; text-align: left;">Total : </th>
            <th style="width: 31%; text-align: right;"><?php echo $totalPrix1; ?> </th>
            <th style="width: 28%; text-align: right;"><?php echo $totalQuantite1; ?> kg </th>
            <th style="width: 23%; text-align: right;"><?php echo $total1; ?> </th>
        </tr>
    </table>
    <br>
    <div style="margin-left:40px;">
    <table cellspacing="0" style="text-align: center; font-size: 13px; margin-left: " >
        <tr>
            <td style="width: 25%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Mode de paiement </td>
            <td style="width: 30%;"><b><?php echo $row['modePaiement'] ?></b> </td>
        </tr>
    </table>
    <?php if($row['modePaiement'] =='CHEQUE') {?>
    <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">N° chèque </td>
            <td style="width: 25%;"><b><?php echo $row['numCheque'] ?></b> </td>
        </tr>
    </table>
    <?php }?>
    <?php if($row['modePaiement'] =='VIREMENT') {?>
    <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Date paiement </td>
            <td style="width: 25%;"><b><?php echo $row['datePaiement'] ?></b> </td>
        </tr>
    </table>
    <?php }?>
   <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Avance </td>
            <td style="width: 25%;"><b><?php if($rowAvance['sommeAvance']!="") echo $rowAvance['sommeAvance']; else echo 0.00 ?> FCFA</b></td>
        </tr>
    </table>
    <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Reliquat </td>
            <td style="width: 25%;"><b><?php echo  $total - $rowAvance['sommeAvance'] ?> FCFA</b> </td>
        </tr>
    </table>
        <table cellspacing="0" style="text-align: center; font-size: 13px;">
        <tr>
            <td style="width: 30%;"> </td>
            <td style="width: 25%;"></td>
            <td style="width: 20%;">Transport </td>
            <td style="width: 25%;"><b><?php if($row['transport']>0) echo $row['transport']; else echo "0"; ?>  FCFA</b> </td>
        </tr>
    </table>
     </div>
<!--    <nobreak>
        <br>
        <table cellspacing="0" style="margin-top:0px;width: 90%; text-align: left;">
            <tr>
                <td style="width:25%;">Le Comptable</td>
                <td style="width:25%"></td>
                <td style="width:38%"></td>
                <td style="width:25%"> Le Mareyeur</td>
            </tr>
        </table>
    </nobreak>-->
     </div>
</page>
