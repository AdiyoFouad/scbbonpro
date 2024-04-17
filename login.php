<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SCB - Gestion de Bon Provisoire</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php

    session_start();

  if(isset($_SESSION['bon_pro_msg']) && $_SESSION['bon_pro_msg'] != "") {
      echo "<div id=\"msgContainer\" class=\"msg w-lg-50 text-center alert alert-success\" role=\"alert\">". $_SESSION['bon_pro_msg'] ."</div>";
    }
    if(isset($_SESSION['bon_pro_msg_r']) && $_SESSION['bon_pro_msg_r'] != "") {
      echo "<div id=\"msgContainer2\" class=\"msg w-lg-50 text-center alert alert-danger\" role=\"alert\">". $_SESSION['bon_pro_msg_r'] ."</div>";
    }

     ?>
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <p class="text-center">Société des Ciments du Bénin - SCB Bouclier</p>
                <form method="post" action="./controllers/user_controler.php">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                  </div>
                  <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" id="mdp" required>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Se souvenir de moi
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="#" onclick="showPopup(1)">Mot de passe oublié ?</a>
                  </div>
                  <button type="submit" name="login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Se connecter</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Vous n'avez pas encore un compte?</p>
                    <a class="text-primary fw-bold ms-2" href="#" onclick="showPopup(2)">Faire une demande</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div id="popup" class="popup">
            
        <p id="popup_msg" class="fs-5"></p>
        <button class="btn btn-primary w-25 d-flex justify-content-center align-items-center me-3" id="fermer" onclick="hidePopup()">
          OK
        </button>
    </div>

    <!-- Overlay pour masquer l'arrière-plan -->
    <div id="overlay"></div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
<style>
.popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-width: 350px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;

        button{
          float: right;
        }
    }

    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

  .msg {
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

  function showPopup(print) {
        document.getElementById('popup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
        if (print === 1) {
          document.getElementById('popup_msg').innerText = "Merci de bien vouloir vous rapprocher du service informatique pour la modification de votre mot de passe.";
        } else {
          document.getElementById('popup_msg').innerText = "Merci de bien vouloir vous rapprocher du service informatique pour la création de votre compte.";
        }
    }

    // Fonction pour masquer la pop-up
    function hidePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
</script>

</html>