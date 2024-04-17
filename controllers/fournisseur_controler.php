<?php

require_once('../models/fournisseur_model.php');
session_start();

if (isset($_POST['new_fournisseur']) ){
    addFournisseur($_POST['nom'], $_POST['ifu'], $_POST['ntel'], $_POST['ntel2'],);
    $_SESSION['bon_pro_msg'] = "Fournisseur " . $_POST['nom'] . " - " .  $_POST['ifu'] . " créé avec succès.";
    header("Location:../?page=fournisseurs");
}

if (isset($_POST['update_fournisseur']) ){
    updateFournisseur($_POST['id_fournisseur'] ,$_POST['nom'], $_POST['ifu'], $_POST['ntel'], $_POST['ntel2'],);
    $_SESSION['bon_pro_msg'] = "Fournisseur modifié avec succès.";
    header("Location:../?page=fournisseurs");
}

if (isset($_POST['delete_fournisseur'])) {
    if (deleteFournisseur($_POST['id_fournisseur'])) {
        $_SESSION['bon_pro_msg'] = "Fournisseur supprimé avec succès.";
    } else {
        $_SESSION['bon_pro_msg_r'] = "Impossible de supprimé le fournisseur car déjà présent sur un bon provisoire.";
    }
    header("Location:../?page=fournisseurs");
}

if (isset($_GET['historique_fournisseur'])) {
    $bons = getHistoriqueBonFournisseur($_GET['historique_fournisseur']);
    echo json_encode($bons);
}

if (isset($_GET['id_fournisseur'])) {
    $fournisseur = getFournisseurById($_GET['id_fournisseur']);
    echo json_encode($fournisseur);
}

?>