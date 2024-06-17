<?php

require_once (__DIR__ ."/../connexion_db.php");

function newRef(){
    $req = execSQL('SELECT MAX(id_bon) AS last_id FROM bonpro', array());
    $last_id = $req->fetch()['last_id'] + 1;

    $formatted_id = str_pad($last_id, 4, '0', STR_PAD_LEFT); 

    $ref = $formatted_id . '-' . date('Y');

    return $ref;
}

function p_dcli() {
    $req = execSQL(
        'SELECT presence_dcli FROM users WHERE type_user = "DCLI"',
        array()
    );
    return $req->fetchall()[0][0];
}

function nouveauBon($ref, $beneficiaire, $libelle, $montant, $motivation, $url_proforma, $fournisseur) {
    $validationFinale = ($p_dcli() === false) ? 'DGA' : 'DCLI';

    $req = execSQL(
        'INSERT INTO bonpro(ref, demandeur, beneficiaire, libelle, montant, motivation, url_proforma, fournisseur_bon, validation_finale) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
        array($ref, $_SESSION['bon_pro_id_user'], $beneficiaire, $libelle, $montant, $motivation, $url_proforma, $fournisseur, $validationFinale)
    );
}

function bons_en_attente(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user = demandeur AND id_user= ? AND fournisseur_bon = id_fournisseur 
        AND (
            (date_appro_cc IS NULL)
            OR (date_appro_cc IS NOT NULL AND appro_cc = true AND date_appro_daf IS NULL)
            OR (date_appro_daf IS NOT NULL AND appro_daf = true AND date_appro_de IS NULL)
            OR (date_appro_de IS NOT NULL AND appro_de = true AND date_appro_dga IS NULL)
            OR (date_appro_dga IS NOT NULL AND appro_dga = true AND date_appro_dcli IS NULL AND validation_finale = "DCLI")
        ) ORDER BY ref DESC',
        array($_SESSION['bon_pro_id_user'])
    );
    return $req;
}

function bons_en_attente_cc(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND date_appro_cc IS NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_daf(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user = demandeur AND fournisseur_bon = id_fournisseur AND appro_cc = true AND date_appro_daf IS NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_de(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_daf = true AND date_appro_de IS NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_dga(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_de = true AND date_appro_dga IS NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_en_attente_dcli(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND date_appro_dcli IS NULL AND appro_dga = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_rejete_cc(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_cc = false AND date_appro_cc IS NOT NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_rejete_daf(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_cc = true AND appro_daf = false AND date_appro_daf IS NOT NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_rejete_de(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_daf = true AND appro_de = false AND date_appro_de IS NOT NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_rejete_dga(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_de = true AND appro_dga = false AND date_appro_dga IS NOT NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_rejete_dcli(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_dcli = false  AND date_appro_dcli IS NOT NULL ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_rejete() {
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur 
        WHERE id_user = demandeur 
          AND id_user = ? 
          AND fournisseur_bon = id_fournisseur 
          AND (
            (date_appro_dga IS NOT NULL AND appro_dga = false)
            OR (date_appro_cc IS NOT NULL AND appro_cc = false)
            OR (date_appro_daf IS NOT NULL AND appro_daf = false)
            OR (date_appro_de IS NOT NULL AND appro_de = false)
            OR (date_appro_dcli IS NOT NULL AND appro_dcli = false)
          )
        ORDER BY ref DESC',
        array($_SESSION['bon_pro_id_user'])
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


function bons_approuve(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND id_user = ? 
        AND (
            (date_appro_dga IS NOT NULL AND appro_dga = true AND validation_finale = "DGA")
            OR (appro_dcli = true)
            )
        ORDER BY ref DESC',
        array($_SESSION['bon_pro_id_user'])  
    );
    return $req;
}

function bons_approuve_cc(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_cc = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_approuve_daf(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_daf = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_approuve_de(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_de = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_approuve_dga(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_dga = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_approuve_dcli(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur AND appro_dcli = true ORDER BY ref DESC',
        array()
    );
    return $req;
}

function bons_pret_a_payer(){
    $req = execSQL(
        'SELECT * FROM bonpro, users, fournisseur WHERE id_user=demandeur AND fournisseur_bon = id_fournisseur 
        AND (
            (date_appro_dga IS NOT NULL AND appro_dga = true AND validation_finale = "DGA")
            OR (appro_dcli = true)
            )
        ORDER BY ref DESC',
        array()  
    );
    return $req;
}


function payer_bon($id_bon){
    $req = execSQL(
        'UPDATE bonpro SET date_paiement = ?, payer = true WHERE id_bon = ?',
        array(date('Y-m-d H:i:s'), $id_bon)
    );
}


?>