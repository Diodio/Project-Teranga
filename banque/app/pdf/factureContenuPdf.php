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

$sqlProduit = "SELECT nbColis, libelle, prixUnitaire, quantite, montant FROM facture f,ligne_facture lf,produit p WHERE f.id=lf.facture_id AND lf.produit=p.id AND f.id=" . $factureId;
$ResultProduit = mysqli_query($connexion, $sqlProduit) or die(mysqli_error($connexion));

?>

<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }

-->
</style>
<page backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" style="font-size: 12pt">
    <bookmark title="Lettre" level="0" ></bookmark>
    <br>
    <br>
    <table cellspacing="0" style="border: 0px;width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td>
            <table cellspacing="0" style="width: 40%; text-align: center; font-size: 14px">
                <tr>
                    
                </tr>
            </table> 
            </td>
        </tr>
    </table>
    
     <table cellspacing="0" style="margin-top:-10px;border:1px;color:#444444;width: 92%; text-align: left;margin-left:40px; font-size: 14px">
        <tr>
            <td style="width:57.6%;">
                <table cellspacing="0" style="width: 100%; text-align: left;font-size: 100px">
                    <tr>
                        <td  >
                        <img alt="" src="../../assets/img/logo.png" style="margin-left:50px">  
                    </td>
                       <td>
                        <img  alt="" src="../../assets/img/trait.png" style="margin-left:60px">  
            </td>  
                    </tr>
                </table>
            </td>
           
             <td >
                <table cellspacing="0" style="width: 100%; text-align: left;font-size: 12px;">
                    <tr>
                        <td style="font-size: 16px;color:blue; ">
                            <b>MACFISH PRODUCTION SURL</b>
                        </td>
                    </tr>
                    <tr >
                        <td style="height: 15px;" >
                           <b> Quai de P�che Mole 10</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <b>Tel : (00) 221 33 821 84 70 � (00) 221 77 637 09 48</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <b>E-mail : macfishport@live.fr</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <b>Site : www.macfishproduction.sn</b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
    
    <table cellspacing="0" style="margin-top:-1px;border:1px;color:#444444;width: 90%; margin-left:40px; font-size: 14px">
        <tr>
            <td style="width:45%;">
                <table cellspacing="0" style="width: 90%; text-align: left;font-size: 10pt">
                    <tr >
                        <td>
                            Client (NOM, ADRESSE, PAYS, TELEPHONE)
                           
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b><?php echo $row['nom'];?></b><br>
                            <b><?php echo $row['adresse'];?></b><br>
                            <b><?php echo $row['pays'];?></b><br>
                            <b><?php echo $row['telephone'];?></b>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                        <img alt="" src="../../assets/img/trait.png">  
            </td>
             <td style="width:52.6%;">
                <table cellspacing="0" style="width: 100%; text-align: left;font-size: 12px">
                    <tr>
                        <td style="height: 15px;">
                            NUMERO FACTURE: <b><?php echo $row['numero'];?></b>&nbsp;&nbsp;
                        </td>
                    </tr>
                     <tr>
                        <td style="height: 15px;">
                            DATE FACTURE: <b><?php echo date('d/m/Y');?></b>
                        </td>
                    </tr>
                    <tr >
                        <td style="height: 15px;">
                            Mode de paiement: <b><?php if($row['modePaiement']!="undefined") echo $row['modePaiement'];?></b>
                        </td>
                    </tr>
                     <tr >
                        <td style="height: 15px; font-family:arial">
                            Bénéficiaire: <b>MACFISH PRODUCTION SURL</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            Notre banque: <b>BICIS (SENEGAL)</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            Adresse: <b>2, Avenue L S SENGHOR DAKAR</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            SWIFT: <b>BICISNDXXXX</b>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            IBAN: <b>SN08 SN01 0015 2001 7895 7000 0733</b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
    
    <br>
    <br>
    <table cellspacing="0" style="color:#444444;width: 60%; text-align: center;margin-left:40px; font-size: 14px">
        <tr>
            <td style="width:50%;">
                <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
                    <tr>
                        <td >
                            Port de chargement: <b>DAKAR / SENEGAL</b>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            Port de dechargement: <b><?php echo $row['portDechargement'];?></b>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            SHIP/AIR/ETC : <b>Expedition par voie maritime</b>
                        </td>
                    </tr>
                </table>
            </td>
             <td >
                 
                <table cellspacing="0" style="width: 85%; text-align: left;margin-left:2px;font-size: 10pt">
                   <?php while ($rowConteneur = mysqli_fetch_array($ResultConteneur)) {?>
                    <tr>
                        <td style="width: 60%">
                            No conteneur: <b><?php echo $rowConteneur['numConteneur'];?></b>
                        </td style="width: 40%">
                        <td >
                           No plomb : <b><?php echo $rowConteneur['numPlomb'];?></b>
                        </td>
                    </tr>
                   <?php } ?>

                </table>
            </td>
        </tr>
        
    </table>
    <br>
    <br>
    <table cellspacing="0"  style="width: 82%; border: solid 1px black; ; text-align: left;margin-left:40px; font-size: 10pt;">
        <tr>
            <th style="width: 15%">Nb colis</th>
            <th style="width: 40%">Désignation</th>
            <th style="width: 15%">Prix Unitaire</th>
            <th style="width: 20%;">Quantité</th>
            <th style="width: 20%;">Montant</th>
        </tr>
    </table>
    
<?php
    while ($rowProduit = mysqli_fetch_array($ResultProduit)) {
?>
    <table cellspacing="0" style="width: 82%; border: solid 0px black;  text-align: left;margin-left:40px; font-size: 10pt;">
        <tr>
            <td style="border-left: 1px solid #000;border-right: 1px solid #000;width: 15%; text-align: left"><?php echo $rowProduit['nbColis'];?></td>
            <td style="border-right: 1px solid #000;width: 40%; text-align: left"><?php echo $rowProduit['libelle'];?></td>
            <td style="border-right: 1px solid #000;width: 15%; text-align: left"><?php echo $rowProduit['prixUnitaire'];?></td>
            <td style="border-right: 1px solid #000;width: 20%; text-align: left"><?php echo $rowProduit['quantite'];?></td>
            <td style="border-right: 1px solid #000;width: 20%; text-align: left;"><?php echo $rowProduit['montant'];?></td>
        </tr>
    </table>
<?php
    }
?>
    <table cellspacing="0" style="width: 82%; border: solid 1px black; ; text-align: center;margin-left:40px; font-size: 10pt;">
        <tr>
            <th style="width: 20%; text-align: left;"><?php echo $row['nbTotalColis'];?></th>
            <th style="width: 30%; text-align: left;"></th>
            <th style="width: 20%; text-align: left;"></th>
            <th style="border-left: 1px solid #000;width: 20%; text-align: left;"><?php echo $row['nbTotalPoids'];?></th>
            <th style="border-left: 1px solid #000;width: 20%; text-align: left;"><?php echo $row['montantHt'];?></th>
        </tr>
    </table>
    <br>
    
    <table cellspacing="0" style="margin-left: 35px;width: 90%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:50%;">Arrêté cette facture à la somme de <b><?php echo $row['montantHt'];?></b> <?php echo $row['devise'];?> HTVA</td>
            <td style="width:50%; "><span  style="font-size: 25px;" ></span></td>
            <td >
            </td>
        </tr>
        <tr>
             <td >
                 
            </td>  
            
        </tr>
        <tr>
             <td >
                 inconterm <b> <?php if($row['inconterm'] !="") echo $row['inconterm'];?></b>
            </td>  
            
        </tr>
    </table>
    <br>
     <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
            <tr>
                <td style="width:25%;"></td>
                <td style="width:25%"></td>
                <td style="width:30%"></td>
                <td style="width:20%"> Avance : <b><?php if($row['avance']==null) echo 0; else echo $row['avance'];?></b> <?php echo $row['devise'];?>
                    <br>
                Reliquat : <b><?php if($row['reliquat']==null) echo 0; else echo $row['reliquat'];?></b>  <?php echo $row['devise'];?>
                </td>
            </tr>
        </table>
        
        <page_footer> 
     <div style="color:green;text-align: center; border-top: 1px solid">
         QUAI DE PECHE - BP:27122 Dakar Colis
        RC: SN-DKR-2006B17900 NINEA: 0025442782V2
        SWIFT: BICISNDXXXX   N�COMPTE: SN08 SN01 0015 2001 7895 7000 0733
     </div>
     
 </page_footer>
    
</page>

