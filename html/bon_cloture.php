<?php
include_once("models/bon_pro_model.php");

if ($_SESSION['bon_pro_type_user'] === 'SIMPLE') {
    $bons = bons_cloture();
} else if ($_SESSION['bon_pro_type_user'] === 'CC'){
    $bons = bons_cloture_cc();
}



?>

<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-6 col-sm-5">
            <h4 class=" fw-semibold">Bons clôturés</h4>
            </div>
            <div class="col d-flex justify-content-end ">
                <button class="btn btn-primary p-2 pt-0 pb-0"><a target="_blank" href="pdf.php?file=liste_bon_regularise" class="fs-5 ti ti-printer text-white"></a></button>
            </div>
        </div>
        <hr>

        <div class="card rounded-0 mb-3 p-0">
            <div class="card-body pt-1 pb-0">
                <div id="filtres" class="row">
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_demande" class="form-label">Demandeur</label>
                        <select id="type_demande" class="form-select" onchange="applyTicketFilters()">
                            <option value="Tout" selected>Tout</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Montant</label>
                        <select id="type_equipement" class="form-select" onchange="applyTicketFilters()">
                            <option value="Tout" selected>Tout</option>
                            <option value="Matériel">< 500000F</option>
                            <option value="Logiciel">>= 500000F</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Période <small class="fw-normal">(Début)</small></label>
                        <input class="form-control" type="date">
                    </div>
                    <div class="mb-3 col-6 col-sm-3">
                        <label for="type_equipement" class="form-label">Période <small class="fw-normal">(Fin)</small></label>
                        <input class="form-control" type="date">
                    </div>
                    
                </div>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4 bg-light">
                    <tr>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"></h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Reférence</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Demandeur</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Libellé</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Bénéficiaire</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Montant</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Date de Paiement</h6>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php while ($bon = $bons->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr onclick="showBonPro(<?php $bon_pro=$bon;echo $bon['id_bon']; ?>)">
                            <td ><i class="ti ti-cards fw-semibold"></i></td>
                            <td><?= $bon['ref'] ?></td>
                            <td> <?= $bon['nom'][0]. '. ' .$bon['prenom'] ?></td>      
                            <td><?= strlen($bon['libelle']) > 30 ? substr($bon['libelle'], 0, 35) . '...' : $bon['libelle'] ?></td>
                            <td class="text-center"><?= $bon['beneficiaire'] ?></td>
                            <td><?= $bon['montant'] ?> F</td>
                            <td><?= date('d-m-Y', strtotime($bon['date_paiement'])) ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success rounded-3 fw-semibold"> </span>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="popup1" class="popup">
        <button class="fermer btn btn-danger fs-5  d-flex justify-content-center align-items-center" id="fermer" onclick="hidePopup()">
            <i class="ti ti-x fs-5 fw-bolder"></i>
        </button>


        <div id="pdf-content"></div>

        <div class="row mt-2">
            <?php if ($_SESSION['bon_pro_type_user'] == 'DAF') : ?>
                <div class="col-3 mb-0"></div>
                <form class="col-6 mb-0" action="controllers/bon_controler.php" method="post">
                    <input type="text" name="id_bon" id="id_bon_approuve" hidden>
                    <button type="submit" class="btn btn-outline-success w-100 fs-4 fw-bolder" name="payer_bon">Payer</button>
                </form>
            <?php endif;?>
        </div>
    </div>


    <!-- Overlay pour masquer l'arrière-plan -->
    <div id="overlay"></div>
    
</div>

<style>

    #pdf-content, #pdf-content object{
        width:100%;
        height:80vh;
    }

    #pdf-content {

    }

    .loader {
        border: 4px solid #f3f3f3; 
        border-top: 4px solid #3498db; 
        border-radius: 50%; 
        width: 50px; 
        height: 50px; 
        animation: spin 2s linear infinite; 
        position: absolute;
        top:35%;
        left:48%;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .table-responsive tbody tr:hover {
        background-color: rgba(45, 5, 90, 0.1);
        cursor: pointer;
        color:white;
    }

    .popup {
        width:50%;
        height: auto;
        display:none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    .fermer {
        position: absolute;
        top: -15px;
        right: -15px;
        border-radius: 100%;
        width: 35px;
        height: 35px;
        color: #fff;
    }
    

    .table-responsive thead,
    .table-responsive tbody tr:nth-child(even) {
        background-color: rgba(45, 45, 45, 0.05);
        /* couleur du texte sur la ligne impaire */
    }

    

    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
</style>

<script>

    function showBonPro(idbon) {
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('popup1').style.display = 'block';
        document.getElementById('pdf-content').innerHTML = '<div class="loader"></div>';

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(this.readyState == 4){
                if(this.status == 200){
                    var pdfData = this.responseText;
                    document.getElementById('pdf-content').innerHTML = '<object data="data:application/pdf;base64,'+ pdfData+'" type="application/pdf">Imposible d\'ouvrir le bon</object>';
                    
                } else {
                    // Gérer les erreurs de chargement du PDF
                    document.getElementById('pdf-content').innerHTML = 'Erreur lors du chargement du PDF';
                }
                // Masquer le loader
                document.getElementById('loader').style.display = 'none';
            }
        };
        xhr.open("GET", "pdf.php?file=bon&id_bon_afficher="+ idbon);
        xhr.send();  
    }

    
    

    // Fonction pour masquer la pop-up
    function hidePopup() {
        document.getElementById('popup1').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function showPopup2() {
      console.log();
        document.getElementById('popup1').style.display = 'none';
        document.getElementById('popup2').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    // Fonction pour masquer la pop-up
    function hidePopup2() {
        document.getElementById('popup2').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }


    
    
</script>
 