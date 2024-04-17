<?php

require_once (__DIR__ ."/../connexion_db.php");

//SELECT LAST_INSERT_ID() AS last_id FROM users

function addFournisseur($nom, $ifu, $contact, $contact2){
    $req = execSQL(
        'INSERT INTO fournisseur(nom_fournisseur, ifu, contact, contact2) VALUES (?, ?, ?, ?)',
        array($nom, $ifu, $contact, $contact2)
    );
}


function updateFournisseur($id_fournisseur, $nom, $ifu, $contact, $contact2){
    $req = execSQL(
        'UPDATE fournisseur SET nom_fournisseur = ?, ifu = ?, contact = ?, contact2 = ? WHERE id_fournisseur = ?',
        array($nom, $ifu, $contact, $contact2, $id_fournisseur)
    );
}

function getFournisseur(){
    $req = execSQL(
        'SELECT * FROM fournisseur ORDER BY fournisseur.nom_fournisseur',
        array()
    );
    return $req;
}

function getFournisseurByID($id_fournisseur){
    $req = execSQL(
        'SELECT * FROM fournisseur WHERE id_fournisseur=?',
        array($id_fournisseur)
    );
    return $req->fetch();
}

function deleteFournisseur($id_fournisseur){
    // Vérifier s'il existe des bons associés à ce fournisseur dans la table bonpro
    $req_check = execSQL(
        'SELECT COUNT(*) as count_bons FROM  bonpro, fournisseur WHERE bonpro.fournisseur_bon = ? AND bonpro.fournisseur_bon = fournisseur.id_fournisseur',
        array($id_fournisseur)
    );

    $result_check = $req_check->fetch(PDO::FETCH_ASSOC);

    // S'il n'y a aucun bon associé à ce fournisseur
    if($result_check['count_bons'] == 0) {
        // Supprimer le fournisseur
        $req_delete = execSQL(
            'DELETE FROM fournisseur WHERE id_fournisseur=?',
            array($id_fournisseur)
        );
        return true;
    } else {
        // Il existe des bons associés à ce fournisseur, donc ne pas le supprimer
        return false;
    }
}


function getHistoriqueBonFournisseur($id_fournisseur){
    $req = execSQL(
        'SELECT * FROM bonpro, fournisseur WHERE bonpro.fournisseur_bon = ? AND bonpro.fournisseur_bon = fournisseur.id_fournisseur',
        array($id_fournisseur)
    );
    return $req->fetchall();
}

?>