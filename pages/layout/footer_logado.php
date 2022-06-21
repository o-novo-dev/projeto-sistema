      
<div class="modal fade" id="modalFormDelete" tabindex="-1" role="dialog" aria-labelledby="modalFormDeleteLabel" aria-hidden="true">
  <!-- .modal-dialog -->
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <!-- .modal-content -->
    <div class="modal-content">
      <!-- .modal-header -->
      <div class="modal-header">
        <h5 id="modalFormDeleteLabel" class="modal-title">Deletar Registro</h5>
      </div>
      <!-- /.modal-header -->
      <!-- .modal-body -->
      <div class="modal-body">
        <h4 id="labelDelete">Deseja deletar este registro ?</h4>
        <h6 id="labelRegistro"></h6>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" id="formDelete" method="post" >
          <input type="hidden" id="idDel" name="id" value="">
          <input type="hidden" id="tabelaDel" name="tabelaDel" value="">
          <input type="hidden" id="campoStatus" name="campoDel" value="">
          <input type="hidden" id="valorStatus" name="valorDel" value="">
          <input type="hidden" id="datatable" value="">
        </form>
      </div>
      <!-- /.modal-body -->
      <!-- .modal-footer -->
      <div class="modal-footer">
        <button type='submit' form="formDelete" value='perfil' class='btn btn-primary ml-auto'>Salvar</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
      
      
      </main><!-- /.app-main -->
    </div><!-- /.app -->
    <!-- BEGIN BASE JS -->
    <script src="<?= ASSETS_URL ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="<?= ASSETS_URL ?>/assets/vendor/pace/pace.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/stacked-menu/stacked-menu.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/flatpickr/flatpickr.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/chart.js/Chart.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/toastr/toastr.min.js"></script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="<?= ASSETS_URL ?>/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?= ASSETS_URL ?>/assets/javascript/pages/dashboard-demo.js"></script> <!-- END PAGE LEVEL JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/r-2.3.0/datatables.min.js"></script>

    <script src="<?= ASSETS_URL ?>/assets/javascript/view/utils.js"></script>
    <?php
      foreach ($this->arrJS as $key => $value) {
        echo "<script type='text/javascript' src='".ASSETS_URL."/assets/javascript/view/{$value}'></script>";
      }
    ?>
  </body>
</html>