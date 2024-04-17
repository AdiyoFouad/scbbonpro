<?php 

include_once("models/fournisseur_model.php");
$fournisseurs = getFournisseur();



?>


<style>
    .contenu {
        min-height: 80vh;
    }
</style>

<div class="container-fluid">

        <div class="container-fluid">
        <h4 class="fw-semibold mb-4  d-block d-lg-none">Nouveau bon provisoire</h4>
        <hr class="d-flex d-lg-none">
        <div class="contenu row d-block d-lg-flex align-items-center justify-content-center">
            <h3 class="col-12 col-lg-4 d-none d-lg-block fw-bolder text-align-center">Nouveau bon provisoire</h3>
            <div class="card col">
                <div class="card-body"> 
                    <form action="controllers/bon_controler.php" method="post"  enctype="multipart/form-data">
                        <div class="row">
                            
                            <div class="col-7 mb-3">
                                <label for="demandeur" class="form-label">Demandeur</label>
                                <input type="text" value="<?= $_SESSION['bon_pro_nom'] . ' ' . $_SESSION['bon_pro_prenom']?>" disabled name="demandeur" id="demandeur" class="form-control" required>
                            </div> 
                            <div class="col mb-3">
                                <label for="beneficiaire" class="form-label">Bénéficiaire</label>
                                <select id="beneficiaire" class="form-select" name="beneficiaire" required>
                                    <option disabled selected>Bénéficiaire</option>
                                    <option value="DAF">DAF</option>
                                    <option value="DGA">DGA</option>
                                    <option value="DCLI">DCLI</option>
                                </select>
                            </div>
                        </div> 
                        <div class="mb-3">
                            <label for="libelle" class="form-label">Désignation</label>
                            <textarea name="libelle" id="libelle" rows="3" class="form-control" required></textarea>
                        </div>  
                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant</label>
                            <input type="number" name="montant" id="montant" class="form-control">
                        </div> 
                        <div class="mb-3">
                            <label for="fournisseur" class="form-label">Fournisseur</label>
                            <select id="fournisseur" class="form-select" name="fournisseur" required>
                                <option disabled selected>Fournisseur</option>
                                <?php while ($fournisseur = $fournisseurs->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <option value=<?= $fournisseur['id_fournisseur'] ?> ><?= $fournisseur['nom_fournisseur'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div> 
                        <div class="mb-3">
                            <label for="motivation" class="form-label">Motivation des engagements</label>
                            <textarea name="motivation" id="motivation" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="proforma" class="form-label">Facture proforma</label>
                            <input type="file" name="proforma" id="proforma" class="form-control" placeholder="Aucun fichier (.jpg, .jpeg, .png)" accept="image/*" size="10000">
                        </div> 

                        <div class="d-flex justify-content-end align-items-end">
                            <button type="reset" class="btn btn-outline-primary w-25 mt-3 me-3">Annuler</button>
                            <button type="submit" name="new_bon" class="btn btn-primary w-25 mt-3">Créer</button>
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