<?php

require_once (__DIR__ ."/../connexion_db.php");

function newRef(){
    $req = execSQL('SELECT MAX(id_bon) AS last_id FROM bonpro', array());
    $last_id = $req->fetch()['last_id'] + 1;

    $formatted_id = str_pad($last_id, 4, '0', STR_PAD_LEFT); 

    $ref = $formatted_id . '-' . date('Y');

    return $ref;
}

function nouveauBon($ref, $beneficiaire, $libelle, $montant,$motivation, $url_proforma, $fournisseur){
    
    $req = execSQL(
        'INSERT INTO bonpro(ref, demandeur, beneficiaire, libelle, montant, motivation, url_proforma, fournisseur_bon) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
        array($ref, $_SESSION['bon_pro_id_user'], $beneficiaire, $libelle, $montant, $motivation, $url_proforma, $fournisseur)
    );
}

function bons_en_attente(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_dga = false ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_daf(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_dcli = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_de(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_daf = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_dga(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_de = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_dcli(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND date_appro_dcli IS NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function getBonById($id_bon){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_bon = ? AND id_user=demandeur AND fournisseur_bon = id_fournisseur',
        array($id_bon)
    );
    return $req->fetch();   
}

function action_daf($action, $id_bon){
    $req = execSQL(
        'UPDATE bonpro SET appro_daf = ?, date_appro_daf = ? WHERE id_bon = ?',
        array($action, date('Y-m-d H:i:s'), $id_bon)
    );
}

function action_dga($action, $id_bon){
    $req = execSQL(
        'UPDATE bonpro SET appro_dga = ?, date_appro_dga = ? WHERE id_bon = ?',
        array($action, date('Y-m-d H:i:s'), $id_bon)
    );
}

function action_de($action, $id_bon){
    $req = execSQL(
        'UPDATE bonpro SET appro_de = ?, date_appro_de = ? WHERE id_bon = ?',
        array($action, date('Y-m-d H:i:s'), $id_bon)
    );
}

function action_dcli($action, $id_bon){
    $req = execSQL(
        'UPDATE bonpro SET appro_dcli = ?, date_appro_dcli = ? WHERE id_bon = ?',
        array($action, date('Y-m-d H:i:s'), $id_bon)
    );
}

function action_cc($action, $id_bon){
    $req = execSQL(
        'UPDATE bonpro SET appro_cc = ?, date_appro_cc = ? WHERE id_bon = ?',
        array($action, date('Y-m-d H:i:s'), $id_bon)
    );
}



?>