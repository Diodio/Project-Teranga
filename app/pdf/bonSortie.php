<?php
$paramsConnexion = parse_ini_file("../../config/parameters.ini");
$hostname = $paramsConnexion['host'];
$database = $paramsConnexion['dbname'];
$username = $paramsConnexion['user'];
$password = $paramsConnexion['password'];
$connexion = mysqli_connect($hostname, $username, $password) or trigger_error(mysqli_error(), E_USER_ERROR);
mysqli_set_charset($connexion, "utf8");
mysqli_select_db($connexion, $database);
$sql = "SELECT * FROM mareyeur,achat WHERE mareyeur.id=mareyeur_id AND achat.id=75";
$Result = mysqli_query($connexion, $sql) or die(mysqli_error($connexion));
$row = mysqli_fetch_array($Result);
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
            <td style="width:50%; "><span  style="font-size: 25px;" >BON DE SORTIE</span></td>
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
            <th style="width: 52%">Désignation</th>
            <th style="width: 13%">Prix Unitaire</th>
            <th style="width: 10%; text-align: right;">Quantité</th>
            <th style="width: 25%;text-align: right;">Montant</th>
        </tr>
    </table>
    
<?php
    $nb = rand(5, 11);
    $produits = array();
    $total = 0;
    for ($k=0; $k<$nb; $k++) {
        $num = rand(100000, 999999);
        $nom = "le produit n°".rand(1, 100);
        $qua = rand(1, 20);
        $prix = rand(100, 9999)/100.;
        $total+= $prix*$qua;
        $produits[] = array($num, $nom, $qua, $prix, rand(0, $qua));
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: left; font-size: 10pt;">
        <tr>
            <td style="width: 52%; text-align: left"><?php echo $nom; ?></td>
            <td style="width: 13%; text-align: left"><?php echo number_format($prix, 2, ',', ' '); ?> &euro;</td>
            <td style="width: 10%; text-align: center"><?php echo $qua; ?></td>
            <td style="width: 25%; text-align: right;"><?php echo number_format($prix*$qua, 2, ',', ' '); ?> &euro;</td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 87%; text-align: right;">Total : </th>
            <th style="width: 13%; text-align: right;"><?php echo number_format($total, 2, ',', ' '); ?> &euro;</th>
        </tr>
    </table>
    <br>
    
    <nobreak>
        <br>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:25%;">Le Peseur</td>
                <td style="width:25%"></td>
                <td style="width:38%"></td>
                <td style="width:25%"> Le Mareyeur</td>
            </tr>
        </table>
    </nobreak>
</page>

