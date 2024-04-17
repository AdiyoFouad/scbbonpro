<style>
    .contenu {
        height: 80vh;
    }
</style>

<div class="container-fluid">

        <div class="container-fluid">
        <h4 class="fw-semibold mb-4  d-block d-lg-none">Ajouter un fournisseur</h4>
        <hr class="d-flex d-lg-none">
        <div class="contenu row d-block d-lg-flex align-items-center justify-content-center">
            <h3 class="col-12 col-lg-4 d-none d-lg-block fw-bolder text-align-center">Ajouter un fournisseur</h3>
            <div class="card col">
                <div class="card-body"> 
                    <form action="controllers/fournisseur_controler.php" method="post">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="" class="form-control" required>
                        </div> 
                        <div class="mb-3">
                            <label for="ifu" class="form-label">IFU</label>
                            <input type="text" name="ifu" id="" class="form-control" required>
                        </div>  
                        <div class="mb-3">
                            <label for="ntel" class="form-label">N° de téléphone</label>
                            <input type="number" name="ntel" id="" class="form-control">
                        </div>  
                        <div class="mb-3">
                            <label for="ntel2" class="form-label">N° de téléphone 2<small>(optional)</small></label>
                            <input type="number" name="ntel2" id="" class="form-control">
                        </div>
                        <div class="d-flex justify-content-end align-items-end">
                            <button type="reset" class="btn btn-outline-primary w-25 mt-3 me-3">Annuler</button>
                            <button type="submit" name="new_fournisseur" class="btn btn-primary w-25 mt-3">Ajouter</button>
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