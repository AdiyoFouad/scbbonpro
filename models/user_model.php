<?php

require_once (__DIR__ ."/../connexion_db.php");


function seconnecter($email, $mdp) {
    $req = execSQL(
        'SELECT COUNT(*), id_user, nom, prenom, departement, email, type_user FROM users WHERE email = ? AND mdp = ?',
        array($email, $mdp)
    );
    $res = $req->fetch();
    if ($res[0] == 1) {
        $_SESSION['bon_pro_id_user'] = $res[1];
        $_SESSION['bon_pro_nom'] = $res[2];
        $_SESSION['bon_pro_prenom'] = $res[3];
        $_SESSION['bon_pro_departement'] = $res[4];
        $_SESSION['bon_pro_email'] = $res[5];
        $_SESSION['bon_pro_type_user'] = $res[6];
        $_SESSION['bon_pro_msg'] = "Vous interragissez en tant que ". $res[2] . " " . $res[3];
    }else {
        $_SESSION['bon_pro_msg_r'] = "Identifiant incorrect. Veuillez réessayez!";
    }
}

function getUsers(){
    $req = execSQL(
        'SELECT * FROM users ORDER BY nom , prenom',
        array()
    );
    return $req;
}

function creerUser($nom, $prenom, $email, $departement, $type_user, $mdp){
    $req = execSQL(
        'INSERT INTO users(nom, prenom, email, departement, type_user, mdp) VALUES(?, ?, ?, ?, ?, ? )',
        array($nom, $prenom, $email, $departement, $type_user, $mdp)
    );
}

function getUserById($user_id){
    $req = execSQL(
        'SELECT * FROM users WHERE id_user = ?',
        array($user_id)
    );
    $res = $req->fetch();
    return $res;
}

function getUsersByDepartement($departement){
    $req = $departement =='all'? execSQL(
        'SELECT * FROM users',
        array()
    ) : execSQL(
        'SELECT * FROM users WHERE departement = ?',
        array($departement)
    );
    $res = $req->fetchall();
    return $res;
}

function alterUser($nom, $prenom, $email, $departement, $type_user, $mdp, $user_id){
    $req = execSQL(
        'UPDATE users SET nom = ?, prenom = ?, email = ?, departement = ?, type_user = ?, mdp = ? WHERE id_user = ?',
        array($nom, $prenom, $email, $departement, $type_user, $mdp, $user_id)
    );
}

function deleteUser($id_utilisateur){
    // Vérifier s'il existe des éléments associés à cet utilisateur dans d'autres tables
    if ($id_utilisateur == $_SESSION['bon_pro_id_user']) {
        $_SESSION['bon_pro_msg_r'] = "Impossible de supprimer cet utilisateur car l'utilisateur est connecté(e).";

        return false;
    }
    $req_check = execSQL(
        'SELECT COUNT(*) as count_associations FROM bonpro, users WHERE bonpro.demandeur = ? AND bonpro.demandeur = users.id_user',
        array($id_utilisateur)
    );

    $result_check = $req_check->fetch(PDO::FETCH_ASSOC);

    // S'il n'y a aucune association avec cet utilisateur dans d'autres tables
    if($result_check['count_associations'] == 0) {
        // Supprimer l'utilisateur
        $req_delete = execSQL(
            'DELETE FROM users WHERE id_user=?',
            array($id_utilisateur)
        );
        $_SESSION['bon_pro_msg'] = "Utilisateur supprimé avec succès.";
        return true;
    } else {
        
        $_SESSION['bon_pro_msg_r'] = "Impossible de supprimer cet utilisateur car déjà présent sur un bon provisoire.";
  
        // Il existe des associations avec cet utilisateur dans d'autres tables, donc ne pas le supprimer
        return false;
    }
}

function presence_dcli() {
    $req = execSQL(
        'SELECT presence_dcli FROM users WHERE type_user = "DCLI"',
        array()
    );
    return $req->fetchall()[0][0];
}

function update_presence_dcli() {
    $req = execSQL(
        'UPDATE users SET presence_dcli = ? WHERE type_user = "DCLI"',
        array(!presence_dcli())
    );
}

?>