          <div class="page">
            <!-- .page-cover -->
            <header class="page-cover">
              <div class="text-center">
                <?php if($usuario->avatar !== 'null') : ?>
                  <a href="#" class="user-avatar user-avatar-xl"><img src="<?= ASSETS_URL ?>/assets/images/avatars/<?= $usuario->avatar ?>" alt=""></a>
                <?php else :  ?>
                  <a href="#" class="user-avatar user-avatar-xl"><img src="<?= ASSETS_URL ?>/assets/images/avatars/unknown-profile.jpg" alt=""></a>
                <?php endif; ?>
                <h2 class="h4 mt-2 mb-0"> <?= $usuario->nome ?> </h2>
              </div><!-- .cover-controls -->
            </header><!-- /.page-cover -->
            <!-- .page-navs -->
            <nav class="page-navs">
              <!-- .nav-scroller -->
              <div class="nav-scroller">
                <!-- .nav -->
                <div class="nav nav-center nav-tabs">
                  <?php if (in_array($usuario->tipo,["Admin"])) : ?>
                    <a class="nav-link <?= $view_perfil == "overview" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/overview">Visão Geral</a> 
                    <a class="nav-link <?= $view_perfil == "perfil" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/perfil">Sua Conta</a>
                    <a class="nav-link <?= $view_perfil == "parceiro" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/parceiro/usuarios/<?= $usuario->empresa_id ?>">Parceiros</a> 
                    <a class="nav-link <?= $view_perfil == "projeto" && $detalhes == "page" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/projeto/page/ ?>">Landing page</a>
                    <a class="nav-link <?= $view_perfil == "menu" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/menu">Menu</a> 
                    <a class="nav-link <?= $view_perfil == "plano" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/plano">Plano</a> 
                  <?php endif; ?>
                  
                  <?php if (in_array($usuario->tipo,["Cliente"])) : ?>
                    <a class="nav-link <?= $view_perfil == "perfil" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/perfil">Sua Conta</a>
                  <?php endif; ?>

                  <?php if (in_array($usuario->tipo,["Laboratório"])) : ?>
                    <a class="nav-link <?= $view_perfil == "perfil" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/perfil">Sua Conta</a>
                  <?php endif; ?>

                  <?php if (in_array($usuario->tipo,["Clínica"])) : ?>
                    <a class="nav-link <?= $view_perfil == "perfil" ? "active" : "" ?>" href="<?= BASE_URL ?>/usuario/perfil">Sua Conta</a>
                  <?php endif; ?>
                </div><!-- /.nav -->
              </div><!-- /.nav-scroller -->
            </nav><!-- /.page-navs -->