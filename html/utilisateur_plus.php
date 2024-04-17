<style>
    .contenu {
        height: 80vh;
    }
</style>

<div class="container-fluid">

        <div class="container-fluid">
        <h4 class="fw-semibold mb-4  d-block d-lg-none">Ajouter un utilisateur</h4>
        <hr class="d-flex d-lg-none">
        <div class="contenu row d-block d-lg-flex align-items-center justify-content-center">
            <h3 class="col-12 col-lg-4 d-none d-lg-block fw-bolder text-align-center">Ajouter un utilisateur</h3>
            <div class="card col">
                <div class="card-body"> 
                <form action="controllers/user_controler.php" method="post">
            <input type="text" id="user_id2" name="user_id" hidden>
            <div class="">
                <span class="me-3 fw-semibold">Administrateur :</span>
                <label for="non2" class="me-2">
                    <input id="non2" type="radio" name="administrateur" value="0">
                    Non
                </label>

                <label for="oui2" class="me-2 ">
                    <input id="oui2" type="radio" name="administrateur" value="1" class=radio>
                    Oui
                </label>
            </div>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom2" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom2" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email2" name="email" required>
            </div>
            <div class="mb-3">
                <label for="departement" class="form-label">Département</label>
                <select id="departement2" class="form-select" name="departement" required>
                    <option disabled selected>Département</option>
                    <option value="DE">DE</option>
                    <option value="Logistique">Logistique</option>
                    <option value="Comptabilité">Comptabilité</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="mdp2" name="mdp" required>
            </div>
            
            <div class="d-flex justify-content-end align-items-end">
                <button type="reset" name="signaler" class="btn btn-outline-primary w-25 mt-3 me-3">Annuler</button>
                <button type="submit" name="signaler" class="btn btn-primary w-25 mt-3">Ajouter</button>
            </div>
        </form>
                </div>
            </div>
        </div>
          
        </div>
      </div>

      <script>

function chargerEquipement() {

  document.getElementById('equipements').innerHTML = '<option></option>';
    
    fetch('controllers/equipement_controler.php?type=' + document.getElementById('type_equipement').value +'&user_id=' + <?php echo $_SESSION['id_user'];?>)
        .then(response => response.json())
        .then(equipements => {
            equipements.forEach(function (equipement) {
                var option = document.createElement('option');
                option.value = equipement.id_equipement;
                option.textContent = equipement.désignation + " - " + equipement.caractéristique;
                document.getElementById('equipements').appendChild(option);
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des équipements:', error));
}

        
      </script>