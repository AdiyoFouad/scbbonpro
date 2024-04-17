<?php

$host = 'localhost';
$dbname = 'scbbonpro';
$charset = 'utf8';
$username = 'root';
$password = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$bdd->exec("SET time_zone = '+02:00'");

$bdd->exec("CREATE TABLE IF NOT EXISTS `scbbonpro`.`users` ( `id_user` INT NOT NULL AUTO_INCREMENT , `nom` VARCHAR(25) NOT NULL , `prenom` VARCHAR(25) NOT NULL , `email` VARCHAR(25) NOT NULL , `mdp` VARCHAR(8) NOT NULL , `departement` ENUM('DE','Logistique','Commercial','Comptabilité') NOT NULL , `administrateur` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id_user`)) ENGINE = InnoDB");



function execSQL($sql, $param) {
    global $bdd;
    $bdd->exec("SET time_zone = '+01:00'");
    $req = $bdd->prepare($sql);
    $req->execute($param);
    return $req;
}

function getLastId() {
    global $bdd;
    return $bdd->lastInsertId();
}

function envoyerMail($objet, $msg) {
    // Paramètres du serveur SMTP
    $smtp_server = 'smtp.votreserveur.com';
    $smtp_port = 587;
    $smtp_username = 'votre_adresse@example.com';
    $smtp_password = 'votre_mot_de_passe';

    // Destinataire et contenu de l'e-mail
    $to = 'hadonon@cimmentbouclier.com';
    $subject = $objet;
    $message = $msg;
    $headers = "From: ". $_SESSION['email'] ."\r\n" .
            "Reply-To: hadonon@cimmentbouclier.com\r\n" .
            "X-Mailer: PHP/" . phpversion();

    // Configuration des paramètres SMTP
    ini_set('SMTP', $smtp_server);
    ini_set('smtp_port', $smtp_port);
    ini_set('sendmail_from', $smtp_username);

    // Envoi de l'e-mail
    mail($to, $subject, $message, $headers);

}

?>
