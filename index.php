<?php
session_start();




$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';



//session_destroy();

$user_id = $_SESSION['bon_pro_id_user'] ? $_SESSION['bon_pro_id_user'] : null;


if (!$user_id) {
  header("Location: login.php"); // Redirige vers login.php si l'utilisateur n'est pas spécifié
  exit(); // Assure que le script s'arrête ici pour éviter l'exécution du reste du code
}
$view = 'html/dashboard.php';
switch ($page) {
  case 'accueil':
      $view = 'html/dashboard.php';
      break;

  case 'bon_plus':
      $view = 'html/bon_plus.php';
      break;

  case 'bon_attente':
      $view = 'html/bon_attente.php';
      break;

  case 'bon_approuve':
      $view = 'html/bon_approuve.php';
      break;

  case 'bon_pret_a_payer':
      $view = 'html/bon_pret_a_payer.php';
      break;

  case 'bon_cloture':
      $view = 'html/bon_cloture.php';
      break;

  case 'bon_rejete':
      $view = 'html/bon_rejete.php';
      break;

  case 'bon_attente':
      $view = 'html/bon_attente.php';
      break;

  case 'fournisseur_plus':
      $view = 'html/fournisseur_plus.php';
      break;

  case 'fournisseurs':
      $view = 'html/fournisseurs.php';
      break;

  case 'utilisateur_plus':
      $view = 'html/utilisateur_plus.php';
      break;

  case 'utilisateurs':
      $view = 'html/utilisateurs.php';
      break;
  
    
  
  default:
    header("Location: /scbbonpro");
      break;
}


?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SCB - Bon Provisoire</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="manifest" href="manifest.json" />

  <script>
    if('serviceWorker' in navigator){
      navigator.serviceWorker.register('sw.js');
    };
  </script>
</head>

<style>
  
  body{
    z-index: 1;
  }
  .background{
    z-index: -100000;
    position: absolute;
    top:15vh;
    left:10%;
  width: 80%; /* Largeur de la div */
  height: 80vh; /* Hauteur de la div, 100vh signifie 100% de la hauteur de la fenêtre */
  background-image: url('assets/images/logos/favicon.png'); /* Chemin vers votre image */
  background-size: cover; /* Redimensionner l'image pour remplir complètement la div */
  background-position: center;
  opacity: 0.1;
  }
</style>

<body class="bg-light-primary">
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include_once('html/menu.php'); ?>
    
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <div class=background></div>
    <?php include_once('html/header.php'); ?>
    
    
                  
      
    <?php include_once($view); ?>
    <?php

        if(isset($_SESSION['bon_pro_msg']) && $_SESSION['bon_pro_msg'] != "") {
          echo "<div id=\"msgContainer\" class=\"msg w-lg-50 text-center alert alert-success\" role=\"alert\">". $_SESSION['bon_pro_msg'] ."</div>";
        }
        if(isset($_SESSION['bon_pro_msg_r']) && $_SESSION['bon_pro_msg_r'] != "") {
          echo "<div id=\"msgContainer2\" class=\"msg w-lg-50 text-center alert alert-danger\" role=\"alert\">". $_SESSION['bon_pro_msg_r'] ."</div>";
        }

     ?>
  
  </div>
  </div>

  
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>

  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>

  <script src="assets/js/dashboard_user.js"></script>
 
  
</body>
<style>
  .msg {
    z-index: -10000;
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3000000;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.msg.show {
    opacity: 1; 
}
</style>


<script>
  const msgContainer = document.getElementById('msgContainer');
  if (msgContainer) {
      msgContainer.classList.add('show');
      setTimeout(function () {
          msgContainer.classList.remove('show');
          <?php $_SESSION['bon_pro_msg'] = ""; ?>
      }, 3000);
  }

  const msgContainer2 = document.getElementById('msgContainer2');
  if (msgContainer2) {
      msgContainer2.classList.add('show');
      setTimeout(function () {
          msgContainer2.classList.remove('show');
          <?php $_SESSION['bon_pro_msg_r'] = ""; ?>
      }, 3000);
  }
</script>

</html>
