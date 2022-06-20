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
            <a href="<?= BASE_URL ?>/usuario/plano/tipos" class="nav-link <?=  $detalhes == 'tipos' ? "active": "" ?>">Tipos</a>
            <a href="<?= BASE_URL ?>/usuario/plano" class="nav-link <?=  empty($detalhes) ? "active": "" ?>">Plano</a> 
            <a href="<?= BASE_URL ?>/usuario/plano/detalhes" class="nav-link <?=  $detalhes == 'detalhes' ? "active": "" ?>">Detalhes</a> 
            <a href="<?= BASE_URL ?>/usuario/plano/precos" class="nav-link <?=  $detalhes == 'precos' ? "active": "" ?>">Preços</a> 
          </nav><!-- /.nav -->
        </div><!-- /.card -->
      </div><!-- /grid column -->