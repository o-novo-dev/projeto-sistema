                  <!-- grid column -->
                  <div class="col-lg-8">

                    <!-- .page-section -->
                    <div class="page-section">
                      <!-- .card -->
                      <div class="card card-fluid">
                        <div class="card-header">
                          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalFormCarteira">Adicionar</button>
                        </div>
                        <!-- .card-body -->
                        <div class="card-body">
                          <!-- .table -->
                          <table id="data-carteira" class="table dt-responsive nowrap w-100">
                            <thead>
                              <tr>
                                <th> Tipo </th>
                                <th> Nome </th>
                                <th> Número </th>
                                <th> Data de Expiração </th>
                                <th style="width:100px; min-width:100px;">&nbsp;</th>
                              </tr>
                            </thead>
                            
                          </table><!-- /.table -->
                        </div><!-- /.card-body -->
                      </div><!-- /.card -->
                    </div><!-- /.page-section -->
                   
                  </div><!-- /grid column -->



<div class="modal fade" id="modalFormCarteira" tabindex="-1" role="dialog" aria-labelledby="modalFormCarteiraLabel" aria-hidden="true">
  <!-- .modal-dialog -->
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <!-- .modal-content -->
    <div class="modal-content">
      <!-- .modal-header -->
      <div class="modal-header">
        <h5 id="modalFormCarteiraLabel" class="modal-title">Dados do Cartão</h5>
      </div>
      <!-- /.modal-header -->
      <!-- .modal-body -->
      <div class="modal-body">
        <?= formCard($this->carteira->inputs, '', 'Salvar') ?>
      </div>
      <!-- /.modal-body -->
      <!-- .modal-footer -->
      <div class="modal-footer">
        <button type='submit' form="formAdd" value='perfil' class='btn btn-primary ml-auto'>Salvar</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>