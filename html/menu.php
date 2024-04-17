<style>
.nav-small-cap {
    cursor: pointer;
}

.sidebar-item{
  display:none;
}

.show-submenu{
  display:block;
}

</style>

<aside class="left-sidebar bg-light-primary">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-center mt-3">
          <a href="." class="text-nowrap logo-img">
            <img src="assets/images/logos/logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">accueil</span>
            </li>
            <li class="sidebar-item d-block" style="opacity=1;">
              <a class="sidebar-link" href="?" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu ">Tableau de bord</span>
              </a>
            </li>
            <li class="nav-small-cap row" id="menu_bonpro">
              <span class="hide-menu col-10">bons provisoires</span>
              <i class="ti ti-chevron-right col-2 fs-4 fw-bolder mt-1"></i>
            </li>
            <li class="sidebar-item" data-target="menu_bonpro">
              <a class="sidebar-link" href="?page=bon_plus" aria-expanded="false">
                <span>
                  <i class="ti ti-checklist text-success"></i>
                </span>
                <span class="hide-menu">Nouveau bon</span>
              </a>
            </li>
            <li class="sidebar-item" data-target="menu_bonpro">
              <a class="sidebar-link" href="?page=bon_attente" aria-expanded="false">
                <span>
                  <i class="ti ti-cards text-primary"></i>
                </span>
                <span class="hide-menu">Bons en attente</span>
              </a>
            </li>
            <li class="sidebar-item" data-target="menu_bonpro">
              <a class="sidebar-link" href="?page=bon_approuve" aria-expanded="false">
                <span>
                  <i class="ti ti-square-x text-danger"></i>
                </span>
                <span class="hide-menu">Bons approuvés</span>
              </a>
            </li>
            <li class="sidebar-item" data-target="menu_bonpro">
              <a class="sidebar-link" href="?page=bon_regularise" aria-expanded="false">
                <span>
                  <i class="ti ti-square-x text-danger"></i>
                </span>
                <span class="hide-menu">Bons à régulariser</span>
              </a>
            </li>
            <li class="sidebar-item" data-target="menu_bonpro">
              <a class="sidebar-link" href="?page=bon_cloture" aria-expanded="false">
                <span>
                  <i class="ti ti-square-x text-danger"></i>
                </span>
                <span class="hide-menu">Bons clôturés</span>
              </a>
            </li>
            
            <li class="sidebar-item" data-target="menu_bonpro">
              <a class="sidebar-link" href="?page=bon_rejete" aria-expanded="false">
                <span>
                  <i class="ti ti-square-x text-danger"></i>
                </span>
                <span class="hide-menu">Bons rejetés</span>
              </a>
            </li>
            <li class="nav-small-cap row" id="fournisseurs">
              <span class="hide-menu col-10">fournisseurs</span>
              <i class="ti ti-chevron-right col-2 fs-4 fw-bolder mt-1"></i>
            </li>
            <li class="sidebar-item" data-target="fournisseurs">
              <a class="sidebar-link" href="?page=fournisseur_plus" aria-expanded="false">
                <span>
                  <i class="ti ti-checklist text-success"></i>
                </span>
                <span class="hide-menu">Nouveau</span>
              </a>
            </li>
            <li class="sidebar-item" data-target="fournisseurs">
              <a class="sidebar-link" href="?page=fournisseurs" aria-expanded="false">
                <span>
                  <i class="ti ti-cards text-primary"></i>
                </span>
                <span class="hide-menu">Liste</span>
              </a>
            </li>
            <?php if ($_SESSION['bon_pro_type_user'] === 'ADMIN_G') : ?>
                <li class="nav-small-cap row" id="menu-utilisateurs">
                    <span class="hide-menu col-10">Utilisateurs</span>
                    <i class="ti ti-chevron-right col-2 fs-4 fw-bolder mt-1"></i>
                </li>
                <li class="sidebar-item" data-target="menu-utilisateurs">
                    <a class="sidebar-link" href="?page=utilisateur_plus" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Créer</span>
                    </a>
                </li> 
                <li class="sidebar-item" data-target="menu-utilisateurs">
                    <a class="sidebar-link" href="?page=utilisateurs" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Liste</span>
                    </a>
                </li>
            <?php endif; ?>
   
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
</aside>

<script>

  let menus = document.querySelectorAll('.nav-small-cap');
  menus.forEach(menu => {
    menu.addEventListener("click", function () {
      let submenus = document.querySelectorAll('[data-target="' + menu.getAttribute("id") +'"]');
      submenus.forEach(element => {
      element.classList.toggle("show-submenu");
    });

    let icone = menu.querySelector('.ti');
    icone.classList.toggle("ti-chevron-right");
    icone.classList.toggle("ti-chevron-up");

    });
  });

  
</script>