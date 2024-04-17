<?php
include_once("models/fournisseur_model.php");
$fournisseurs = getFournisseur();

?>

<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
                    <div class=" col-6 col-sm-5">
                    <h4 class="d-flex justify-content-start align-items-center fw-semibold">Liste des fournisseurs</h4>
                    </div>
                    <div class="col d-flex justify-content-end ">
                        <button class="btn btn-primary p-2 pt-0 pb-0"><a target="_blank" href="pdf.php?file=fournisseurs" class="fs-5 ti ti-printer text-white"></a></button>
                    </div>
                </div>
        <hr>

        

        <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                    <tr>
                        <th class="border-bottom-0 w-50">
                            <h6 class="fw-bolder mb-0">Nom</h6>
                        </th>
                        <th class="border-bottom-0 w-25">
                            <h6 class="fw-bolder mb-0">IFU</h6>
                        </th>
                        <th class="border-bottom-0 w-25">
                            <h6 class="fw-bolder mb-0">Contacts</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"></h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fournisseur = $fournisseurs->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class="fw-semibold "><?= $fournisseur['nom_fournisseur'] ?></td>
                            <td class="fw-semibod "><?= $fournisseur['ifu'] ?></td>
                            <td class="fw-semibol "><?= $fournisseur['contact'] ?> / <?= $fournisseur['contact2'] ?></td>
                            <td>
                                <button class="btn btn-outline-secondary" onclick="showPopup3(<?= $fournisseur['id_fournisseur'] ?>)"><i class="ti ti-history"></i> Historique</button>
                                <button class="btn btn-outline-warning ms-2" onclick="showPopup(<?= $fournisseur['id_fournisseur'] ?>)"><i class="ti ti-reload"></i> Modifier</button>
                                <button class="btn btn-outline-danger ms-2" onclick="showPopup2(<?= $fournisseur['id_fournisseur'] ?>)"><i class="ti ti-x"></i> Supprimer</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="popup1" class="popup">
        <button class="btn btn-danger fs-5  d-flex justify-content-center align-items-center fermer" onclick="hidePopup()">
            <i class="ti ti-x fs-5 fw-bolder"></i>
        </button>

        <h3 class="text-center">Modifier fournisseur</h3>
        <hr>
        
        <form action="controllers/fournisseur_controler.php" method="post">
            <input type="text" name="id_fournisseur" id="id_f" class="form-control" hidden>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom_f" class="form-control" required>
            </div> 
            <div class="mb-3">
                <label for="ifu" class="form-label">IFU</label>
                <input type="text" name="ifu" id="ifu_f" class="form-control" required>
            </div>  
            <div class="mb-3">
                <label for="ntel" class="form-label">N° de téléphone</label>
                <input type="number" name="ntel" id="tel_f" class="form-control">
            </div>  
            <div class="mb-3">
                <label for="ntel2" class="form-label">N° de téléphone 2<small>(optional)</small></label>
                <input type="number" name="ntel2" id="tel2_f" class="form-control">
            </div>
            <div class="d-flex justify-content-end align-items-end">
                <button type="reset" class="btn btn-outline-primary w-25 mt-3 me-3" onclick="hidePopup()">Annuler</button>
                <button type="submit" name="update_fournisseur" class="btn btn-primary w-25 mt-3">Modifier</button>
            </div>
        </form>
    </div>

    <div id="popup2" class="popup">
        <p>Voulez-vous réellement supprimer ce fournisseur:</p>
        <div>Nom : <span class="fw-bolder" id="nom_f2"></span></div>
        <div>IFU : <span class="fw-bolder" id="ifu_f2"></span></div>
        <div>Contacts : <span class="fw-bolder" id="contact_f2"></span></div>
        <form action="controllers/fournisseur_controler.php" method="post" class="mt-2">
            <input type="text" id="id_f2" name="id_fournisseur" hidden>
            <div class="d-flex justify-content-center align-items-center">
                <button type="reset" class="btn btn-outline-secondary  mt-3 me-3" onclick="hidePopup2()">Annuler</button>
                <button type="submit" name="delete_fournisseur" class="btn btn-danger mt-3">Supprimer</button>
            </div>
        </form>
    </div>

    <div id="popup3" class="popup">
        <button class="btn btn-danger fs-5  d-flex justify-content-center align-items-center fermer" onclick="hidePopup3()">
            <i class="ti ti-x fs-5 fw-bolder"></i>
        </button>   
    </div>

    <!-- Overlay pour masquer l'arrière-plan -->
    <div id="overlay"></div>
</div>

<style>
    .fermer{
        position: absolute;
        top: -15px;
        right: -15px;
        border-radius: 100%;
        width: 35px;
        height: 35px;
        color: #fff;
    }
    .card.info {
        height: 125px;
        padding-top: 10px;
    }

    .info .card-body {
        padding-top: 0
    }

    p.total {
        border-radius: 50%;
        height: 70px;
        width: 70px;
        color: #ffffff;
        font-weight: bold;
        font-size: 2.2rem;
        margin-bottom: 0;
    }

    thead,
    tbody tr:nth-child(even) {
        background-color: rgba(45, 45, 45, 0.05);
        /* couleur du texte sur la ligne impaire */
    }

    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 350px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
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
    // Fonction pour afficher la pop-up
    function showPopup(idFournisseur) {
        document.getElementById('popup1').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
        fetch('controllers/fournisseur_controler.php?id_fournisseur='+idFournisseur)
        .then(response => response.json())
        .then(f_data => {
            document.getElementById('id_f').value = f_data['id_fournisseur']; 
            document.getElementById('nom_f').value = f_data['nom_fournisseur']; 
            document.getElementById('ifu_f').value = f_data['ifu']; 
            document.getElementById('tel_f').value = f_data['contact']; 
            document.getElementById('tel2_f').value = f_data['contact2']; 
        }
        );
    }

    // Fonction pour masquer la pop-up
    function hidePopup() {
        document.getElementById('popup1').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function showPopup2(idFournisseur) {
      fetch('controllers/fournisseur_controler.php?id_fournisseur='+idFournisseur)
        .then(response => response.json())
        .then(f_data => {
            document.getElementById('id_f2').value = f_data['id_fournisseur']; 
            document.getElementById('nom_f2').innerText = f_data['nom_fournisseur']; 
            document.getElementById('ifu_f2').innerText = f_data['ifu']; 
            document.getElementById('contact_f2').innerText = f_data['contact'] + ' / ' + f_data['contact2']; 
        }
        );
        document.getElementById('popup2').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    // Fonction pour masquer la pop-up
    function hidePopup2() {
        document.getElementById('popup2').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function showPopup3(idFournisseur) {
        console.log(idFournisseur);
        document.getElementById('popup3').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
        fetch('controllers/fournisseur_controler.php?historique_fournisseur='+idFournisseur)
        .then(response => response.json())
        .then(bonData => {
            console.log(bonData);
        }
        );
    }

    // Fonction pour masquer la pop-up
    function hidePopup3() {
        document.getElementById('popup3').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }


    
</script>
