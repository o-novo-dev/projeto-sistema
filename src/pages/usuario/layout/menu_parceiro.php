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
                        <a href="<?= BASE_URL ?>/usuario/parceiro" class="nav-link <?=  empty($detalhes) ? "active": "" ?>">Lista de Parceiros</a> 
                      </nav><!-- /.nav -->
                    </div><!-- /.card -->
                  </div><!-- /grid column -->