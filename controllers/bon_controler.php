<?php


require_once('../models/fournisseur_model.php');
require_once('../models/bon_pro_model.php');
session_start();



if (isset($_POST['new_bon']) ){
    $ref = newRef();
    $url_proforma = '';

    
    
    if (isset($_FILES['proforma']) AND $_FILES['proforma']['error'] == 0) {
    // Testons si le fichier n'est pas trop gros
        if ($_FILES['proforma']['size'] <= 100000000000){
            $infosfichier = pathinfo($_FILES['proforma']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            $url_proforma = 'uploads/proforma_bon_' . $ref . '.' .$extension_upload;
            
            if (in_array($extension_upload, $extensions_autorisees)){
                move_uploaded_file($_FILES['proforma']['tmp_name'], '../' . $url_proforma );
                //echo "L'envoi a bien été effectué !";
            }
        }
    }
    
   nouveauBon($ref, $_POST['beneficiaire'], $_POST['libelle'], $_POST['montant'],$_POST['motivation'], $url_proforma, $_POST['fournisseur']);


   $_SESSION['bon_pro_msg'] = "Bon provisoire n°" . $ref . " créé avec succès.";
   header("Location:../?page=bon_attente");
}

if (isset($_POST['approbation']) ){
    switch ($_SESSION['bon_pro_type_user']) {
        case 'DAF':
            action_daf(true, $_POST['id_bon_approuve']);
            break;
        case 'DCLI':
            action_dcli(true, $_POST['id_bon_approuve']);
            break;
        case 'DGA':
            action_dga(true, $_POST['id_bon_approuve']);
            break;
        case 'DE':
            action_de(true, $_POST['id_bon_approuve']);
            break;
        case 'CC':
            action_cc(true, $_POST['id_bon_approuve']);
            break;
        
        default:
            # code...
            break;
    }  
    header("Location:../?page=bon_approuve");
}

if (isset($_POST['rejet']) ){
    switch ($_SESSION['bon_pro_type_user']) {
        case 'DAF':
            action_daf(false, $_POST['id_bon_rejet']);
            break;
        case 'DCLI':
            action_dcli(false, $_POST['id_bon_rejet']);
            break;
        case 'DGA':
            action_dga(false, $_POST['id_bon_rejet']);
            break;
        case 'DE':
            action_de(false, $_POST['id_bon_rejet']);
            break;
        case 'CC':
            action_cc(false, $_POST['id_bon_rejet']);
            break;
        
        default:
            # code...
            break;
    }  
    header("Location:../?page=bon_rejete");
}

if (isset($_POST['payer_bon']) ){
    payer_bon($_POST['id_bon']);
}

if (isset($_GET['id_bon'])){
    $bon = getBonById($_GET['id_bon']);
    echo json_encode($bon);
}



?>