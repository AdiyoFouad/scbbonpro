<?php

require_once('../models/user_model.php');
session_start();

if (isset($_POST['login']) ){
    seconnecter($_POST['email'],$_POST['mdp']);
    header('Location:../');
}

if (isset($_POST['logout']) ){
    session_destroy();
    session_start();
    $_SESSION['bon_pro_msg'] = "Vous êtes actuellement déconnecté(e).";
    header('Location:../');
}

if (isset($_POST['new_user']) ){
    creerUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['departement'], $_POST['type_user'], $_POST['mdp']);
    $_SESSION['bon_pro_msg'] = "Utilisateur " . $_POST['nom'] . " " .  $_POST['prenom'] . " créé avec succès.";
    header("Location:../?page=utilisateurs");
}

if (isset($_POST['alter_user']) ){
    alterUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['departement'], $_POST['type_user'], $_POST['mdp'], $_POST['user_id']);
    $_SESSION['bon_pro_msg'] = "Utilisateur " . $_POST['nom'] . " " .  $_POST['prenom'] . " modifié avec succès.";
    header("Location:../?page=utilisateurs");
}

if (isset($_GET['id'])) {
    $user = getUserById($_GET['id']);
    echo json_encode($user);
}

if (isset($_GET['departement'])) {
    $users = getUsersByDepartement($_GET['departement']);
    echo json_encode($users);
}

if (isset($_POST['delete_user'])) {
    deleteUser($_POST['id_user']);
    header("Location:../?page=utilisateurs");
}

?>