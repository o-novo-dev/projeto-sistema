            <!-- .page-inner -->
            <div class="page-inner">
              <!-- .page-section -->
              <div class="page-section">
                <?= getflashdata() ?>
                <!-- grid row -->
                <div class="row">
                  <!-- grid column -->
                  <div class="col-lg-4">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <h6 class="card-header"> Detalhes </h6><!-- .nav -->
                      <nav class="nav nav-tabs flex-column border-0">
                        <a href="<?= BASE_URL ?>/usuario/perfil" class="nav-link <?=  empty($detalhes) ? "active": "" ?>">Usuário</a> 
                        <a href="<?= BASE_URL ?>/usuario/perfil/enderecos" class="nav-link <?=  $detalhes == "enderecos" ? "active": "" ?>">Endereços</a> 
                        <a href="<?= BASE_URL ?>/usuario/perfil/carteira" class="nav-link <?=  $detalhes == "carteira" ? "active": "" ?>">Sua carteira</a> 
                        <?php if (in_array($usuario->tipo,["Laboratório"])) : ?>
                        <a href="<?= BASE_URL ?>/usuario/perfil/empresa" class="nav-link <?=  $detalhes == "empresa" ? "active": "" ?>">Dados da Empresa</a> 
                        <?php endif; ?>
                        <a href="<?= BASE_URL ?>/usuario/perfil/senha" class="nav-link <?=  $detalhes == "senha" ? "active": "" ?>">Trocar senha</a> 
                      </nav><!-- /.nav -->
                    </div><!-- /.card -->
                  </div><!-- /grid column -->