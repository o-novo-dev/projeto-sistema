<?php
/*$arr = $this->query("select * from dev_pages");
$pages = [];
foreach($arr as $obj){
  $pages[$obj->tipo][$obj->param] = $obj->value;
}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> Dashboard | Looper - Bootstrap 4 Admin Theme </title>
    <meta property="og:title" content="Dashboard">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="https://uselooper.com">
    <meta property="og:url" content="https://uselooper.com">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <script type="application/ld+json">
      {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author":
        {
          "@type": "Person",
          "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Dashboard",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?= ASSETS_URL ?>/assets/apple-touch-icon.png">
    <link rel="shortcut icon" href="<?= ASSETS_URL ?>/assets/favicon.ico">
    <meta name="theme-color" content="#3063A0"><!-- End FAVICONS -->
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End GOOGLE FONT -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/assets/vendor/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/assets/vendor/flatpickr/flatpickr.min.css"><!-- END PLUGINS STYLES -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/assets/vendor/toastr/toastr.min.css" >
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/assets/stylesheets/theme.min.css" data-skin="default">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/assets/stylesheets/theme-dark.min.css" data-skin="dark">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/assets/stylesheets/custom.css">
    <script>
      var skin = localStorage.getItem('skin') || 'default';
      var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
      var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
      // Disable unused skin immediately
      disabledSkinStylesheet.setAttribute('rel', '');
      disabledSkinStylesheet.setAttribute('disabled', true);
      // add flag class to html immediately
      //if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script><!-- END THEME STYLES -->
    <script>base_url = "<?= BASE_URL ?>"</script>
  </head>
  <body>
    <!-- toasts container -->
    <div aria-live="polite" aria-atomic="true">
      <!-- Position it -->
      <div style="position: fixed; top: 0.5rem; right: 1rem; z-index: 2050">
        <!-- .toast -->
        <div id="toast1" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
          <div class="toast-header bg-success">
            <strong class="mr-auto text-warning" id="toast-title">Toast</strong>
          </div>
          <div class="toast-body border border-light bg-light">
            <p id="toast-message">Hello, world! This is a toast message.</p>
          </div>
        </div>
        <!-- /.toast -->
      </div>
    </div>
    <!-- /toasts container -->

    <!-- .app -->
    <div class="app">

      <!--[if lt IE 10]>
      <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
      <![endif]-->
      <!-- .app-header -->
      <header class="app-header app-header-dark">
        <!-- .top-bar -->
        <div class="top-bar">
          <!-- .top-bar-brand -->
          <div class="top-bar-brand">
            <!-- toggle aside menu -->
            <button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle aside menu -->
            <a href="<?= BASE_URL ?>/dashboard">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="28" viewBox="0 0 100 80">
                <defs>
                  <path id="a" d="M156.538 45.644v1.04a6.347 6.347 0 01-1.847 3.98L127.708 77.67a6.338 6.338 0 01-3.862 1.839h-1.272a6.34 6.34 0 01-3.862-1.839L91.728 50.664a6.353 6.353 0 010-9l9.11-9.117-2.136-2.138a3.171 3.171 0 00-4.498 0L80.711 43.913a3.177 3.177 0 00-.043 4.453l-.002.003.048.047 24.733 24.754-4.497 4.5a6.339 6.339 0 01-3.863 1.84h-1.27a6.337 6.337 0 01-3.863-1.84L64.971 50.665a6.353 6.353 0 010-9l26.983-27.008a6.336 6.336 0 014.498-1.869c1.626 0 3.252.622 4.498 1.87l26.986 27.006a6.353 6.353 0 010 9l-9.11 9.117 2.136 2.138a3.171 3.171 0 004.498 0l13.49-13.504a3.177 3.177 0 00.046-4.453l.002-.002-.047-.048-24.737-24.754 4.498-4.5a6.344 6.344 0 018.996 0l26.983 27.006a6.347 6.347 0 011.847 3.98zm-46.707-4.095l-2.362 2.364a3.178 3.178 0 000 4.501l2.362 2.364 2.361-2.364a3.178 3.178 0 000-4.501l-2.361-2.364z"/>
                </defs>
                <use fill="#346CB0" fill-rule="evenodd" class="fill-warning"  transform="translate(-63 -12)" xlink:href="#a"/>
              </svg>
              <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100" height="50" viewBox="0 0 368 134" preserveAspectRatio="xMidYMid meet">
              <g transform="translate(0.000000,134.000000) scale(0.100000,-0.100000)" fill="#fff" stroke-width="30" stroke="white">
                  <path d="M3165 1069 c-78 -33 -107 -54 -63 -47 16 3 36 -1 45 -8 16 -11 18 -44 23 -356 l5 -343 59 -30 c48 -24 72 -29 125 -29 80 1 125 19 184 73 62 58 89 123 89 221 1 100 -31 174 -91 218 -81 59 -161 51 -235 -24 l-46 -46 0 201 c0 155 -3 201 -12 200 -7 0 -44 -14 -83 -30z m274 -354 c39 -20 78 -69 91 -113 23 -83 7 -192 -36 -250 -46 -60 -106 -76 -167 -46 -68 35 -67 32 -67 204 0 172 0 170 65 204 38 20 78 20 114 1z"/>
                  <path d="M10 1050 c0 -5 14 -10 31 -10 45 0 67 -16 79 -58 13 -48 13 -595 0 -643 -11 -38 -41 -59 -85 -59 -14 0 -25 -4 -25 -10 0 -6 63 -10 170 -10 107 0 170 4 170 10 0 6 -14 10 -31 10 -75 0 -89 36 -89 228 l0 132 43 -7 c63 -12 157 -9 200 6 84 29 136 104 137 199 0 116 -73 189 -211 211 -84 14 -389 14 -389 1z m405 -66 c37 -24 65 -92 65 -155 0 -103 -60 -169 -154 -169 -103 0 -97 -11 -94 179 l3 166 40 5 c48 7 107 -5 140 -26z"/>
                  <path d="M1850 1050 c0 -5 14 -10 30 -10 19 0 40 -9 55 -25 l25 -24 0 -331 0 -331 -25 -24 c-15 -16 -36 -25 -55 -25 -16 0 -30 -4 -30 -10 0 -6 108 -10 303 -10 l304 0 33 105 c32 102 36 153 7 83 -20 -48 -76 -108 -114 -124 -49 -21 -276 -19 -297 2 -14 13 -16 58 -16 335 0 190 4 328 10 339 10 20 59 40 96 40 13 0 24 5 24 10 0 6 -65 10 -175 10 -110 0 -175 -4 -175 -10z"/>
                  <path d="M1343 925 c-29 -57 -110 -145 -133 -145 -5 0 -10 -4 -10 -10 0 -5 20 -10 44 -10 l45 0 3 -224 c3 -221 3 -225 27 -250 49 -52 132 -37 178 33 28 41 22 53 -10 23 -30 -29 -71 -28 -91 0 -13 19 -16 57 -16 220 l0 198 65 0 c58 0 65 2 65 20 0 18 -7 20 -65 20 l-64 0 -3 93 -3 92 -32 -60z"/>
                  <path d="M895 801 c-84 -22 -146 -83 -172 -170 -21 -73 -14 -191 15 -247 49 -96 156 -150 250 -124 56 15 126 79 148 135 20 54 14 83 -9 39 -90 -173 -337 -78 -337 129 l0 37 184 0 183 0 -8 43 c-4 23 -8 45 -9 49 0 14 -64 79 -90 93 -34 18 -116 26 -155 16z m90 -53 c15 -12 34 -36 41 -54 27 -64 27 -64 -111 -64 -119 0 -125 1 -125 20 0 90 125 153 195 98z"/>
                  <path d="M2743 801 c-74 -19 -122 -68 -123 -123 0 -36 19 -58 49 -58 22 0 41 33 41 74 0 70 64 105 129 71 38 -19 51 -49 51 -115 0 -44 -2 -48 -27 -54 -64 -16 -212 -97 -237 -129 -39 -51 -37 -124 4 -171 54 -61 131 -57 219 14 41 32 51 30 51 -6 0 -14 10 -30 25 -40 33 -22 84 -5 125 42 38 44 39 62 1 35 -55 -39 -58 -30 -63 184 -5 212 -9 230 -68 260 -36 18 -133 27 -177 16z m143 -427 c-7 -20 -81 -54 -115 -54 -39 0 -81 49 -81 95 0 48 42 93 125 131 l70 32 3 -96 c1 -52 1 -101 -2 -108z"/>
                </g>  
              </svg>
                 
            <!--  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28" viewbox="0 0 351 100">
                <defs>
                  <path id="a" d="M156.538 45.644v1.04a6.347 6.347 0 0 1-1.847 3.98L127.708 77.67a6.338 6.338 0 0 1-3.862 1.839h-1.272a6.34 6.34 0 0 1-3.862-1.839L91.728 50.664a6.353 6.353 0 0 1 0-9l9.11-9.117-2.136-2.138a3.171 3.171 0 0 0-4.498 0L80.711 43.913a3.177 3.177 0 0 0-.043 4.453l-.002.003.048.047 24.733 24.754-4.497 4.5a6.339 6.339 0 0 1-3.863 1.84h-1.27a6.337 6.337 0 0 1-3.863-1.84L64.971 50.665a6.353 6.353 0 0 1 0-9l26.983-27.008a6.336 6.336 0 0 1 4.498-1.869c1.626 0 3.252.622 4.498 1.87l26.986 27.006a6.353 6.353 0 0 1 0 9l-9.11 9.117 2.136 2.138a3.171 3.171 0 0 0 4.498 0l13.49-13.504a3.177 3.177 0 0 0 .046-4.453l.002-.002-.047-.048-24.737-24.754 4.498-4.5a6.344 6.344 0 0 1 8.996 0l26.983 27.006a6.347 6.347 0 0 1 1.847 3.98zm-46.707-4.095l-2.362 2.364a3.178 3.178 0 0 0 0 4.501l2.362 2.364 2.361-2.364a3.178 3.178 0 0 0 0-4.501l-2.361-2.364z"></path>
                </defs>
                <g fill="none" fill-rule="evenodd">
                  <path fill="currentColor" fill-rule="nonzero" d="M39.252 80.385c-13.817 0-21.06-8.915-21.06-22.955V13.862H.81V.936h33.762V58.1c0 6.797 4.346 9.026 9.026 9.026 2.563 0 5.237-.446 8.58-1.783l3.677 12.034c-5.794 1.894-9.694 3.009-16.603 3.009zM164.213 99.55V23.78h13.372l1.225 5.571h.335c4.457-4.011 10.585-6.908 16.491-6.908 13.817 0 22.174 11.031 22.174 28.08 0 18.943-11.588 29.863-23.957 29.863-4.903 0-9.694-2.117-13.594-6.017h-.446l.78 9.025V99.55h-16.38zm25.852-32.537c6.128 0 10.92-4.903 10.92-16.268 0-9.917-3.232-14.932-10.14-14.932-3.566 0-6.797 1.56-10.252 5.126v22.397c3.12 2.674 6.686 3.677 9.472 3.677zm69.643 13.372c-17.272 0-30.643-10.586-30.643-28.972 0-18.163 13.928-28.971 28.748-28.971 17.049 0 26.075 11.477 26.075 26.52 0 3.008-.558 6.017-.78 7.354h-37.663c1.56 8.023 7.465 11.589 16.491 11.589 5.014 0 9.36-1.337 14.263-3.9l5.46 9.917c-6.351 4.011-14.597 6.463-21.951 6.463zm-1.338-45.463c-6.462 0-11.031 3.454-12.702 10.363h23.622c-.78-6.797-4.568-10.363-10.92-10.363zm44.238 44.126V23.779h13.371l1.337 12.034h.334c5.46-9.025 13.595-13.371 22.398-13.371 4.902 0 7.465.78 10.697 2.228l-3.343 13.706c-3.454-1.003-5.683-1.56-9.806-1.56-6.797 0-13.928 3.566-18.608 13.483v28.749h-16.38z"></path>
                  <use class="fill-warning" xlink:href="#a"></use>
                </g>
              </svg> -->
            </a>
          </div><!-- /.top-bar-brand -->
          <!-- .top-bar-list -->
          <div class="top-bar-list">
            <!-- .top-bar-item -->
            <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
              <!-- toggle menu -->
              <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- /toggle menu -->
            </div><!-- /.top-bar-item -->
           
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
              <!-- .btn-account -->
              <div class="dropdown d-flex">
                <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="user-avatar user-avatar-md">
                    <img src="<?= ASSETS_URL ?>/assets/images/avatars/<?= $usuario->avatar == 'null' ? "unknown-profile.jpg" : $usuario->avatar ?>" alt="">
                  </span> 
                  <span class="account-summary pr-lg-4 d-none d-lg-block">
                    <span class="account-name"><?= $usuario->nome ?></span> 
                    <span class="account-description"><?= $usuario->tipo ?></span>
                  </span>
                </button> <!-- .dropdown-menu -->
                <div class="dropdown-menu">
                  <div class="dropdown-arrow ml-3"></div>
                  <h6 class="dropdown-header d-none d-md-block d-lg-none"> <?= $usuario->nome ?> </h6>
                  <a class="dropdown-item" href="<?= BASE_URL ?>/usuario/perfil"><span class="dropdown-icon oi oi-person"></span> Profile</a> 
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= BASE_URL ?>/usuario/logout"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                  <!-- comentário matheus <a class="dropdown-item" href="#">Help Center</a> 
                  <a class="dropdown-item" href="#">Ask Forum</a> 
                  <a class="dropdown-item" href="#">Keyboard Shortcuts</a> -->
                </div><!-- /.dropdown-menu -->
              </div><!-- /.btn-account -->
            </div><!-- /.top-bar-item -->
          </div><!-- /.top-bar-list -->
        </div><!-- /.top-bar -->
      </header><!-- /.app-header -->

      <!-- .app-aside -->
      <aside class="app-aside app-aside-expand-md app-aside-light">
        <!-- .aside-content -->
        <div class="aside-content">
          <!-- .aside-header -->
          <header class="aside-header d-block d-md-none">
            <!-- .btn-account -->
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
              <span class="user-avatar user-avatar-lg">
                <img src="<?= ASSETS_URL ?>/assets/images/avatars/<?= $usuario->avatar == 'null' ? "unknown-profile.jpg" : $usuario->avatar ?>" alt="">
              </span> 
              <span class="account-icon">
                <span class="fa fa-caret-down fa-lg"></span>
              </span> 
              <span class="account-summary">
                <span class="account-name"><?= $usuario->nome ?></span> 
                <span class="account-description"><?= $usuario->tipo ?></span>
              </span>
            </button> <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <!-- dropdown-items -->
              <div class="pb-3">
                <a class="dropdown-item" href="<?= BASE_URL ?>/usuario/perfil">
                  <span class="dropdown-icon oi oi-person"></span> Profile
                </a> 
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= BASE_URL ?>/usuario/logout">
                  <span class="dropdown-icon oi oi-account-logout"></span> Logout
                </a>
                <!-- comentário matheus <a class="dropdown-item" href="#">Help Center</a> 
                <a class="dropdown-item" href="#">Ask Forum</a> 
                <a class="dropdown-item" href="#">Keyboard Shortcuts</a> -->
              </div><!-- /dropdown-items -->
            </div><!-- /.dropdown-aside -->
          </header><!-- /.aside-header -->
          <!-- .aside-menu -->
          <div class="aside-menu overflow-hidden">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
              <!-- .menu -->
              <ul class="menu">
                <!-- .menu-item -->
                <li class="menu-item has-active">
                  <a href="<?= BASE_URL . '/dashboard' ?>" class="menu-link"><span class="menu-icon fas fa-home"></span> <span class="menu-text">Dashboard</span></a>
                </li><!-- /.menu-item -->

                <?php 
                if (count($menus) > 0){

                  foreach ($menus as $key => $menu) {
                    if (count($menu->submenus) == 0) {
                      echo "
                      <li class='menu-item'>
                        <a href='". BASE_URL."/{$menu->link}' class='menu-link'>
                          <span class='menu-icon {$menu->icone}'></span> 
                          <span class='menu-text'>{$menu->nome}</span>
                        </a>
                      </li>";
                    } else {
                      echo "
                      <li class='menu-item has-child'>
                        <a href='#' class='menu-link'>
                          <span class='menu-icon {$menu->icone}'></span> 
                          <span class='menu-text'>{$menu->nome}</span>
                        </a>
                        <ul class='menu'>
                      ";
                      
                      foreach ($menu->submenus as $key1 => $submenu) {
                        echo "
                        <li class='menu-item'>
                          <a href='{$submenu->link}' class='menu-link'>{$submenu->nome}</a>
                        </li>
                        ";
                      }
                      echo "
                        </ul>
                      </li>
                      ";
                    }
                  }
                
                }
                ?>
              </ul><!-- /.menu -->
            </nav><!-- /.stacked-menu -->
          </div><!-- /.aside-menu -->
          <!-- Skin changer -->
          <footer class="aside-footer border-top p-2">
            <button class="btn btn-light btn-block text-primary" data-toggle="skin"><span class="d-compact-menu-none">Night mode</span> <i class="fas fa-moon ml-1"></i></button>
          </footer><!-- /Skin changer -->
        </div><!-- /.aside-content -->
      </aside><!-- /.app-aside -->


      <!-- .app-main -->
      <main class="app-main">

