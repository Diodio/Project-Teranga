<?php
$paramsConnexion = parse_ini_file("../../config/parameters.ini");
//$factureId = $_GET['factureId'];
$hostname = $paramsConnexion['host'];
$database = $paramsConnexion['dbname'];
$username = $paramsConnexion['user'];
$password = $paramsConnexion['password'];
$connexion = mysqli_connect($hostname, $username, $password) or trigger_error(mysqli_error(), E_USER_ERROR);
mysqli_set_charset($connexion, "utf8");
mysqli_select_db($connexion, $database);
$sql = "SELECT * FROM facture, client WHERE client.id=client_id AND facture.id=" . $factureId;
$Result = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
$row = mysqli_fetch_array($Result);

$sqlConteneur = "SELECT * FROM conteneur WHERE facture_id=" . $factureId;
$ResultConteneur = mysqli_query($connexion, $sqlConteneur) or die(mysqli_error($connexion));
//$rowConteneur = mysqli_fetch_array($ResultConteneur);

$sqlProduit = "SELECT nbTotalColis, libelle, prixUnitaire, quantite, montant FROM facture f,ligne_facture lf,produit p WHERE f.id=lf.facture_id AND lf.produit=p.id AND f.id=" . $factureId;
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
                <span >TEL : 33 821 84 70 / 33 836 35 12</span>
                 <br><br>
                <span >Email : macfishrufisque@orange.sn</span>
                 <br><br>
                <span >Site : www.macfishproduction.sn</span>
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
            <td style="width:60%; "><span  style="font-size: 25px;" >Facture Pro-Forma N° <?php echo $row['numero'];?></span></td>
            <td ></td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0" style="border: solid 1px black;color:#444444;width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width:50%;">
                Information client 
                <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
                    <tr>
                        <td >
                            Nom: <?php echo $row['nom'];?>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Adresse:  <?php echo $row['adresse'];?>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Telephone: <?php echo $row['telephone'];?>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Pays: <?php echo $row['pays'];?>
                        </td>
                    </tr>
                </table>
            </td>
             <td style="width:50%;">
                Paiement 
                <table cellspacing="0" style="width: 50%; text-align: left;font-size: 10pt">
                    <tr>
                        <td >
                            Mode de paiement: <?php echo $row['modePaiement'];?>
                        </td>
                    </tr><tr>
                        <td >
                           Avance : <?php echo $row['avance'];?>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Notre banque: BICIS (SENEGAL)
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Adresse: 2, Avenue L S SENGHOR DAKAR
                        </td>
                    </tr>
                    <tr>
                        <td >
                            SWIFT: BICISNDXXXX
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Numero compte: SN08 SN01 0015 2001 7895 7000 0733
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
    
    <br>
    <br>
    <table cellspacing="0" style="color:#444444";width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width:50%;">
                <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
                    <tr>
                        <td >
                            Port de chargement: DAKAR / SENEGAL
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Port de dechargement: <?php echo $row['portDechargement'];?>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            SHIP/AIR/ETC : Expedition par voie maritime
                        </td>
                    </tr>
                </table>
            </td>
             <td >
                 
                <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
                   <?php while ($rowConteneur = mysqli_fetch_array($ResultConteneur)) {?>
                    <tr>
                        <td style="width: 42%">
                            Numero conteneur: <?php echo $rowConteneur['numConteneur'];?>
                        </td style="width: 52%">
                        <td >
                           Numero plomb : <?php echo $rowConteneur['numPlomb'];?>
                        </td>
                    </tr>
                   <?php } ?>

                </table>
            </td>
        </tr>
        
    </table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: left; font-size: 10pt;">
        <tr>
            <th style="width: 15%">Nombre de colis</th>
            <th style="width: 40%">Désignation</th>
            <th style="width: 15%">Prix Unitaire</th>
            <th style="width: 20%;">Quantité</th>
            <th style="width: 10%;">Montant</th>
        </tr>
    </table>
    
<?php
    while ($rowProduit = mysqli_fetch_array($ResultProduit)) {
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 15%; text-align: left"><?php echo $rowProduit['nbTotalColis'];?></td>
            <td style="width: 40%; text-align: left"><?php echo $rowProduit['libelle'];?></td>
            <td style="width: 15%; text-align: left"><?php echo $rowProduit['prixUnitaire'];?></td>
            <td style="width: 20%; text-align: left"><?php echo $rowProduit['quantite'];?></td>
            <td style="width: 10%; text-align: left;"><?php echo $rowProduit['montant'];?></td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 15%; text-align: left;"><?php echo $row['nbTotalColis'];?></th>
            <th style="width: 40%; text-align: left;"></th>
            <th style="width: 15%; text-align: left;"></th>
            <th style="width: 20%; text-align: left;"><?php echo $row['nbTotalPoids'];?></th>
            <th style="width: 10%; text-align: left;"><?php echo $row['montantTtc'];?></th>
        </tr>
    </table>
    <br>
    
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:40%;">Arrêté cette facture à la somme de <?php echo $row['montantTtc'];?> <?php echo $row['devise'];?> TTC</td>
            <td style="width:60%; "><span  style="font-size: 25px;" ></span></td>
            <td ></td>
        </tr>
    </table>
</page>

