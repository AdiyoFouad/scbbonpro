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
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom2" name="nom" requied>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom2" name="prenom" requred>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email2" name="email" requred>
                    </div>
                    <div class="mb-3">
                        <label for="departement" class="form-label">Département</label>
                        <select id="departement" class="form-select" name="departement" required>
                            <option value="" disabled selected>Sélectionner un département</option>
                            <option value="DE">DE</option>
                            <option value="Logistique">Logistique</option>
                            <option value="Comptabilité">Comptabilité</option>
                        </select>
                    </div>       
                    <div class="mb-3">
                        <label for="type_user" class="form-label">Type d'utilisateur</label>
                        <select id="type_user" class="form-select" name="type_user" required>
                            <option value="" disabled selected>Sélectionner un type d'utilisateur</option>
                            <option value="SIMPLE">Standard</option>
                            <option value="DE">DE</option>
                            <option value="CC">CC</option>
                            <option value="DCLI">DCLI</option>
                            <option value="DGA">DGA</option>
                            <option value="DAF">DAF</option>
                            <option value="ADMIN_G">Administrateur système</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                    </div>
                    
                    <div class="d-flex justify-content-end align-items-end">
                        <button type="reset" class="btn btn-outline-primary w-25 mt-3 me-3">Annuler</button>
                        <button type="submit" name="new_user" class="btn btn-primary w-25 mt-3">Ajouter</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
          
        </div>
      </div>

      <script>

     </script>