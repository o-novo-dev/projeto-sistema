                  <!-- grid column -->
                  <div class="col-lg-8">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <h6 class="card-header"> Dados do Usuário </h6><!-- .card-body -->
                      <div class="card-body">
                        <!-- form -->
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                          <input type="hidden" name="id" value="<?= $usuario->id ?>">
                          <!-- form-group -->
                          <div class="form-group">
                            <label for="input01">Atual Senha</label>
                            <input name="atual_senha" type="password" class="form-control" id="input01" value="" required>
                          </div>
                          <!-- /form row -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input03">Nova Senha</label>
                            <input name="senha" type="password" class="form-control" id="input03" value="" required>
                          </div>
                          <!-- /.form-group -->
                          <hr>
                          <!-- .form-actions -->
                          <div class="form-actions">
                            <button type="submit" class="btn btn-primary ml-auto">Alterar</button>
                          </div><!-- /.form-actions -->
                        </form><!-- /form -->
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->
                  </div><!-- /grid column -->