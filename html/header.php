<!--  Header Start -->
<style>
    /* Style pour arrondir uniquement le coin droit du bouton */
    .rounded-right {
      border-radius:0 2.25rem 2.25rem 0;
      
    }

    /* Style pour la boîte de notification */
    .notification-box {
      position: absolute;
      top: 60px; /* Ajustez la valeur selon vos besoins */
      left: 40px; /* Ajustez la valeur selon vos besoins */
      background-color: #fff;
      border: 1px solid #ccc;
      padding: 10px;
      display: none; /* Masquer initialement */
      width: 350px;
      overflow-y: auto;
      overflow-x: hidden;
      max-height:200px; /* A /* Ajustez la largeur selon vos besoins */
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2); /* Ajouter une ombre */
      border-radius: 5px; /* Ajouter des coins arrondis */
    }

    /* Style pour chaque notification */
    .notification {
      display:flex;
      align-items: end;
      margin-bottom: 10px;
    }

    /* Style pour l'icône */
    .notification-icon {
      margin-right: 10px;
    }

    /* Style pour le contenu de la notification */
    .notification-content {
      flex-grow: 1;
    }

    /* Style pour la date de notification */
    .notification-date {
      font-size: 0.8em;
      color: #888;
    }

    .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 28px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 34px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 50%;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(20px);
    -ms-transform: translateX(20px);
    transform: translateX(20px);
  }

  <?php
    include_once("models/user_model.php");
  ?>

  </style>
<header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light ">
            
          
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
<!--
            <li class="nav-item">
              <a class="nav-link nav-icon-hover"  onclick="toggleNotification()">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
-->

            <li class="nav-item mt-4 ms-4 ">
              <label class="switch">
              <input onchange="update_presence_dcli()" type="checkbox" id="toggleSwitch" <?php echo presence_dcli() === '1' ? "checked" : ""; ?>>
                <span class="slider"></span>
              </label>
            </li>
            <li class="nav-item mt-3 ms-4 d-none d-lg-inline-block">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher bon provisoire" style="width: 250px;">
                <div class="input-group-append">
                  <button class="btn btn-secondary pt-2 pb-2 rounded-right" type="button" >
                    <i class="ti ti-search"></i>
                  </button>
                </div>
              </div>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <span class="fs-5 fw-semi-bold"><?php echo ($_SESSION['bon_pro_nom'])[0] .". ". $_SESSION['bon_pro_prenom']?></span>    
            <li class="nav-item dropdown">
                
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <!--<a href="." class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Profil</p>
                    </a>-->
                    <a href="." class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-layout-dashboard fs-6"></i>
                      <p class="mb-0 fs-3">Tableau de bord</p>
                    </a>
                    <form action="./controllers/user_controler.php" method="post">
                      <input type="submit" name="logout" class="w-75 btn btn-outline-primary m-4 mb-0 mt-2 d-block" value="Déconnexion">
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>

<!-- Div pour afficher les notifications -->
<div class="notification-box" id="notificationBox">
  <!-- Contenu de la boîte de notification -->
  <div class="row d-flex justify-content-center align-items-center">
    <i class="col-1 rounded-circle bg-primary ti ti-user text-white m-2 me-0 mb-4 d-flex justify-content-center align-items-center" style="width: 30px; height:30px;"></i>
    <div class="col">
      <p class="mb-0">Un nouveau bon de commande a été émis par U. Utilisateur - Service Informatique</p>
      <p class="notification-date mt-0">20 mars 2024</p>
    </div>
  </div>
  <div class="row d-flex justify-content-center align-items-center">
    <i class="col-1 rounded-circle bg-primary ti ti-user text-white m-2 me-0 mb-4 d-flex justify-content-center align-items-center" style="width: 30px; height:30px;"></i>
    <div class="col">
      <p class="mb-0">Vous avez un nouveau message</p>
      <p class="notification-date mt-0">20 mars 2024</p>
    </div>
  </div>
  <div class="row d-flex justify-content-center align-items-center">
    <i class="col-1 rounded-circle bg-primary ti ti-user text-white m-2 me-0 mb-4 d-flex justify-content-center align-items-center" style="width: 30px; height:30px;"></i>
    <div class="col">
      <p class="mb-0">Vous avez un nouveau message</p>
      <p class="notification-date mt-0">20 mars 2024</p>
    </div>
  </div>
  
</div>






      </header>
      <!--  Header End -->

<script>
  function toggleNotification() {
    var notificationBox = document.getElementById("notificationBox");
    if (notificationBox.style.display == "block") {
      notificationBox.style.display = "none";
    } else {
      notificationBox.style.display = "block";
    }
  }

  function update_presence_dcli() {
    fetch('controllers/user_controler.php?update_presence_dcli=1')
        .then(response => response.text())
        .then(userData => {
          console.log("eee");
        })
        .catch(error => console.error('Erreur lors de la modification de la présence de l\'utilisateur:', error));
  }
</script>