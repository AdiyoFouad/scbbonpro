<?php
include_once("models/bon_pro_model.php");

$bon = getBonById($bon_id); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon Provisoire - <?= $bon['ref'] ?></title>
</head>
<?php  ?>
<style type="text/css">
    .entete {
        height: 140px;
        font-size: 14px;
    }

    .entete .left{
        width: 40%;
        display: inline-block;
        float: left;
    }

    .entete .left img{
        width: 150px;
        margin: -20px 30px;
    }
    .entete .left p{
        text-align:center;
       margin-left: -5rem;
    }

    .entete .right{
        margin-top: 22px;
        width: 60%;
        float: right;
        font-size:18px; 
        font-family: Helvetica;  
    }

    .nbon p{
        border: 1px solid black;
        margin-top:1em;
        text-align:center;
        font-family: Arial, sans-serif;
        font-size:20px; 
        font-weight:bolder;
    }
    .fournisseur{
        border: 0.5px solid black;
        padding-top: -50px;
        font: arial;
        margin-bottom: 15px;
        margin-top: -15px;
    }

    .fournisseur p{
        margin:0;
        background: black;
        color: white;
        height:1.5rem;
        font-family: Arial, sans-serif;
        font-weight: bold;
        padding-left: 5px;
    }

    .contenu table{
        width: 100%;
        font-size: 20px;
        border-collapse: collapse;
        border: 0.5px solid black;
    }

    .contenu table td, .contenu table th{
        border: 0.5px solid black;
    }

    .contenu thead {  
        font-family: Arial, sans-serif;
        font-size: 18px;
        background: rgba(0,0,0, 0.07);
    }

    .contenu table #col1{
        width: 50%;
    }

    .contenu table #col2{
        width: 22%;
    }

    .contenu table #col3{
        width: 28%;
    }

    .mt {
        text-align:center;
    }

    .contenu table #ligne1 td:nth-child(3) {
        display: flex;
        text-align:center;
        border-bottom:0;
        font-weight: bold;
    }

    #designation {
        height:200px
    }

    #description {
        border-top: 1px dotted black;
        height:70px
    }

    .signature table{
        margin-top:5px;
        width:100%;
        font-size: 25px;
        min-height: 150px;
    }

    .signature table th{
        font-family: Arial, sans-serif;
        width:20%;
        padding-bottom: 5px;
    }

    .signature table td{
        text-align:center;
    }
    .signature table img{
        width:100px;
    }

    .heures_signature{
        font-size: 12px;
    }

    #p {
        text-decoration: underline
    }

    #bas table td{
        font-size: 10px;
        text-align: left
    }

    #bas {
        margin-top: .5em;
        border-top: 0.3px solid black;
    }

    .bon_bg{  
        background-image: url('assets/images/bon_pro/bg.png'); /* Chemin vers votre image */
        background-size: cover; /* Redimensionner l'image pour remplir complètement la div */
        background-position: center;
    }
    
    #proforma_container img{
        width:100%;
    }


</style>

<body>
    
    <div class="entete">
        <div class="left">
            <img src="assets/images/logos/favicon.png" alt="" >
            <p>Société des Ciments du Bénin<br>Ciment Bouclier</p>
        </div>
        <div class="right">
            <table>
                <tr>
                    <td>Date de création: </td>
                    <td><?= date('H:i:s d-m-Y', strtotime($bon['date_de_creation'])) ?></td>
                </tr>
                <tr>
                    <td>Demandeur: </td>
                    <td><?= $bon['nom'] . ' ' . $bon['prenom'] ?></td>
                </tr>
                <tr>
                    <td>Bénéficiaire :</td>
                    <td><?= $bon['beneficiaire'] ?></td>
                </tr>
            </table>
        </div>    
    </div>
    <div class="bon_bg">
        <div class="nbon">
            <p>BON PROVISOIRE N° <?= $bon['ref'] ?></p>   
        </div>
        <div class="fournisseur">
            <p>FOURNISSEUR</p>
            <table>
                <tr>
                    <td>Nom :</td>
                    <td><?= $bon['nom_fournisseur'] ?></td>
                </tr>
                <tr>
                    <td>IFU :</td>
                    <td><?= $bon['ifu'] ?></td>
                </tr>
                <tr>
                    <td>Contact :</td>
                    <td><?= $bon['contact'] ?></td>
                </tr>
            </table>
        </div>
        <div class="contenu">
            <table>
                <thead>
                    <tr>
                        <th id="col1">Désignation des dépenses</th>
                        <th id="col2">Sections analytiques</th>
                        <th id="col3">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="ligne1">
                        <td><div id="designation"><?= $bon['libelle'] ?> </div></td>
                        <td></td>
                        <td><?= $bon['montant'] . ' F' ?></td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td>Montant</td>
                        <td class="mt"><?= $bon['montant'] . ' F' ?></td>
                    </tr>
                    <tr>
                        <td>AIB 3% ou 5%(1)</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Net à payer</td>
                        <td class="mt"><?= $bon['montant'] . ' F' ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Motivation des engagements <small>(Description succinte)</small>:</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div id="description"><?= $bon['motivation'] ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="signature">
            <table>
                <thead>
                    <tr>
                        <th>C.C</th>
                        <th>D.C.L.I</th>
                        <th>D.E</th>
                        <th>D.G.A</th>
                        <th>D.A.F</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php if ($bon['date_appro_cc'] !== null) : ?>
                                <?php if ($bon['appro_cc']) : ?>
                                    <img src="assets/images/bon_pro/approuve.png" alt="">
                                <?php else : ?>
                                    <img src="assets/images/bon_pro/rejet.png" alt="">
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($bon['date_appro_dcli'] !== null) : ?>
                                <?php if ($bon['appro_dcli']) : ?>
                                    <img src="assets/images/bon_pro/approuve.png" alt="">
                                <?php else : ?>
                                    <img src="assets/images/bon_pro/rejet.png" alt="">
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($bon['date_appro_de'] !== null) : ?>
                                <?php if ($bon['appro_de']) : ?>
                                    <img src="assets/images/bon_pro/approuve.png" alt="">
                                <?php else : ?>
                                    <img src="assets/images/bon_pro/rejet.png" alt="">
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($bon['date_appro_dga'] !== null) : ?>
                                <?php if ($bon['appro_dga']) : ?>
                                    <img src="assets/images/bon_pro/approuve.png" alt="">
                                <?php else : ?>
                                    <img src="assets/images/bon_pro/rejet.png" alt="">
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($bon['date_appro_daf'] !== null) : ?>
                                <?php if ($bon['appro_daf']) : ?>
                                    <img src="assets/images/bon_pro/approuve.png" alt="">
                                <?php else : ?>
                                    <img src="assets/images/bon_pro/rejet.png" alt="">
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="heures_signature">
                        <td><?= $bon['date_appro_cc'] ? date('d-m-Y à H:i:s', strtotime($bon['date_appro_cc'])) : "" ?></td>
                        <td><?= $bon['date_appro_dcli'] ? date('d-m-Y à H:i:s', strtotime($bon['date_appro_dcli'])) : "" ?></td>
                        <td><?= $bon['date_appro_de'] ? date('d-m-Y à H:i:s', strtotime($bon['date_appro_de'])) : "" ?></td>
                        <td><?= $bon['date_appro_dga'] ? date('d-m-Y à H:i:s', strtotime($bon['date_appro_dga'])) : "" ?></td>
                        <td><?= $bon['date_appro_daf'] ? date('d-m-Y à H:i:s', strtotime($bon['date_appro_daf'])) : "" ?></td>
                    </tr>
                </tbody>
            </table>
            <p id="p">
                Pour acquis: <br>
                Signature: <br>
                Nom et Prénom:
            </p>
        </div>
    </div>
    <div id="bas">
        <table>
            <tr>
                <td>(1):</td>
                <td>3% pour les prestataires de services immatriculés</td>
            </tr>
            <tr>
                <td></td>
                <td>5% pour les prestataires de services non immatriculés</td>
            </tr>
        </table> 
    </div>

    <div id="proforma_container">
        <?php if (substr($bon['url_proforma'], -4) === ".jpg") : ?>
            <img src="<?= $bon['url_proforma'] ?>" alt="">
        <?php endif; ?>
    </div>

    <div id="recu_container">

    </div>

  
</body>


</html>