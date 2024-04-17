<?php
//include_once("models/user_model.php");

//$users = getUsers(); // Récupérer les utilisateurs
?>

<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-6 col-sm-5">
            <h4 class=" fw-semibold">Bons à régulariser</h4>
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
                            <h6 class="fw-semibold mb-0">Date</h6>
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        <tr onclick="showBonPro()">
                            <td><i class="ti ti-cards fw-semibold"></i></td>
                          <td>11/03/2024</td>
                          <td>DCLI/2024/005</td>
                          <td> D. Magengo</td>      
                          <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                          <td class="text-center">DGA</td>
                          <td>150 000 F</td>
                          <td>
                              <div class="d-flex align-items-center gap-2">
                                  <span class="badge bg-success rounded-3 fw-semibold"> </span>
                              </div>
                          </td>
                        </tr>
                        <tr>
                            <td><i class="ti ti-cards fw-semibold"></i></td>
                          <td>11/03/2024</td>
                          <td>DCLI/2024/005</td>
                          <td> D. Magengo</td>      
                          <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                          <td class="text-center">DCLI</td>
                          <td>12 150 000 F</td>
                          <td>
                              <div class="d-flex align-items-center gap-2">
                                  <span class="badge bg-success rounded-3 fw-semibold"> </span>
                              </div>
                          </td>
                        </tr>
                        <tr>
                            <td><i class="ti ti-cards fw-semibold"></i></td>
                          <td>11/03/2024</td>
                          <td>DCLI/2024/005</td>
                          <td> D. Magengo</td>      
                          <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                          <td class="text-center">DGA</td>
                          <td>150 000 F</td>
                          <td>
                              <div class="d-flex align-items-center gap-2">
                                  <span class="badge bg-success rounded-3 fw-semibold"> </span>
                              </div>
                          </td>
                        </tr>
                        <tr>
                            <td><i class="ti ti-cards fw-semibold"></i></td>
                          <td>11/03/2024</td>
                          <td>DCLI/2024/005</td>
                          <td> D. Magengo</td>      
                          <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</td>
                          <td class="text-center">DGA</td>
                          <td>150 000 F</td>
                          <td>
                              <div class="d-flex align-items-center gap-2">
                                  <span class="badge bg-success rounded-3 fw-semibold"> </span>
                              </div>
                          </td>
                        </tr>
                   <!-- 
                    <?php //while ($user = $users->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><?php echo $user['id_user']; ?></h6></td>
                            <td class="border-bottom-0">
                                <p class="fw-normal mb-0"><?php echo $user['nom']; ?></p>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal text-wap mb-0"><?php echo $user['prenom']; ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0"><?php echo $user['departement']; ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0"><?php echo $user['email']; ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-normal mb-0"><?php echo $user['mdp']; ?></h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" class="btn btn-warning me-1" onclick="showPopup2(<?php echo $user['id_user']; ?>)">Modifier</button>
                                    
                                </div>
                            </td>
                        </tr>
                    <?php //endwhile; ?>
                    -->
                </tbody>
            </table>
        </div>
    </div>

    <div id="popup1" class="popup">
        <button class="btn btn-danger fs-5  d-flex justify-content-center align-items-center fermer"  onclick="hidePopup()">
            <i class="ti ti-x fs-5 fw-bolder"></i>
        </button>

        

        <?php 
            $file = "liste_bon_regularise";
            require_once('test2.php'); 
        ?>

        <div class="row">
            <div class="col-3"></div>
            
            <div class="col-6">
                <button type="submit" class="btn btn-outline-secondary w-100" name="rejeter" onclick="showPopup2()">Ajouter facture normalisée</button>
            </div>
        </div>
    </div>

    <div id="popup2" class="popup">
            <button class="fermer btn btn-danger fs-5  d-flex justify-content-center align-items-center" id="fermer2" onclick="hidePopup2()">
                <i class="ti ti-x fs-5 fw-bolder"></i>
            </button>
            <form action="controllers/ticket_controler.php" method="post">
                        
                        <div class="mb-3">
                            <label for="ntel" class="form-label">Facture normalisée</label>
                            <input type="file" name="ntel2" id="" class="form-control">
                        </div> 

                        <div class="d-flex justify-content-end align-items-end">
                            <button type="reset" name="signaler" class="btn btn-outline-primary w-25 mt-3 me-3" onclick="hidePopup2()">Annuler</button>
                            <button type="submit" name="signaler" class="btn btn-primary w-25 mt-3">Soumettre</button>
                        </div>
                    </form>
    </div>

    <!-- Overlay pour masquer l'arrière-plan -->
    <div id="overlay"></div>
</div>

<style>

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
    function showBonPro() {
        document.getElementById('overlay').style.display = 'block';
        
        document.getElementById('popup1').style.display = 'block';
    }
    // Fonction pour afficher la pop-up
    

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


    function filterUsers() {
    // Récupérer la valeur du filtre
    var selectedFilter = document.getElementById('type_equipement').value;

    // Envoyer une requête AJAX pour récupérer les utilisateurs en fonction du filtre
    fetch('controllers/user_controler.php?departement=' + selectedFilter)
        .then(response => response.json())
        .then(usersData => {
            // Mettre à jour le tableau des utilisateurs avec les données récupérées
            updateUsersTable(usersData);
            console.log(usersData);
        })
        .catch(error => console.error('Erreur lors de la récupération des utilisateurs:', error));
}

function updateUsersTable(usersData) {
    // Effacer le tableau actuel
    var tableBody = document.querySelector('tbody');
    tableBody.innerHTML = '';

    if (usersData.length === 0) {
        // Afficher un message si la liste des utilisateurs est vide
        var emptyRow = document.createElement('tr');
        emptyRow.innerHTML = `
            <td colspan="7" class="text-center">Aucun utilisateur trouvé</td>
        `;
        tableBody.appendChild(emptyRow);
    } else {
        // Reconstruire le tableau avec les nouvelles données
        usersData.forEach(user => {
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="border-bottom-0"><h6 class="fw-semibold mb-0">${user.id_user}</h6></td>
                <td class="border-bottom-0"><p class="fw-normal mb-0">${user.nom}</p></td>
                <td class="border-bottom-0"><h6 class="fw-normal text-wap mb-0">${user.prenom}</h6></td>
                <td class="border-bottom-0"><h6 class="fw-normal mb-0">${user.departement}</h6></td>
                <td class="border-bottom-0"><h6 class="fw-normal mb-0">${user.email}</h6></td>
                <td class="border-bottom-0"><h6 class="fw-normal mb-0">${user.mdp}</h6></td>
                <td class="border-bottom-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-warning me-1" onclick="showPopup2(${user.id_user})">Modifier</button>
                    </div>
                </td>
            `;

            tableBody.appendChild(newRow);
        });
    }
}


    
</script>
