                  <!-- grid column -->
                  <div class="col-lg-8">

                    <!-- .page-section -->
                    <div class="page-section">
                      <!-- .card -->
                      <div class="card card-fluid">
                        <div class="card-header">
                          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalForm">Adicionar</button>
                        </div>
                        <!-- .card-body -->
                        <div class="card-body">
                          <!-- .table -->
                          <table id="datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                              <tr>
                                <th> Projeto </th>
                                <th style="width:100px; min-width:100px;">&nbsp;</th>
                              </tr>
                            </thead>
                            
                          </table><!-- /.table -->
                        </div><!-- /.card-body -->
                      </div><!-- /.card -->
                    </div><!-- /.page-section -->
                   
                  </div><!-- /grid column -->



<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
  <!-- .modal-dialog -->
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <!-- .modal-content -->
    <div class="modal-content">
      <!-- .modal-header -->
      <div class="modal-header">
        <h5 id="modalFormLabel" class="modal-title">Projetos</h5>
      </div>
      <!-- /.modal-header -->
      <!-- .modal-body -->
      <div class="modal-body">
        <?= formCard($this->projetos->inputs, '', 'Salvar') ?>
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