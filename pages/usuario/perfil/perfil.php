                  <!-- grid column -->
                  <div class="col-lg-8">
                    <!-- .card -->
                    <div class="card card-fluid">
                      <h6 class="card-header"> Dados do Usuário </h6><!-- .card-body -->
                      <div class="card-body">
                        <!-- form -->
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                          <input type="hidden" name="id" value="<?= $usuario->id ?>">
                          <!-- .media -->
                          <div class="media mb-3">
                            <!-- avatar -->
                            <div class="user-avatar user-avatar-xl fileinput-button">
                              <div class="fileinput-button-label"> Change photo </div><img src="<?= ASSETS_URL ?>/assets/images/avatars/unknown-profile.jpg" alt=""> 
                              <input id="fileupload-avatar" type="file" name="avatar" form="">
                            </div><!-- /avatar -->
                            <!-- .media-body -->
                            <div class="media-body pl-3">
                              <h3 class="card-title"> Public avatar </h3>
                              <h6 class="card-subtitle text-muted"> Click the current avatar to change your photo. </h6>
                              <p class="card-text">
                                <small>JPG, GIF or PNG 400x400, &lt; 2 MB.</small>
                              </p><!-- The avatar upload progress bar -->
                              <div id="progress-avatar" class="progress progress-xs fade">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                              </div><!-- /avatar upload progress bar -->
                            </div><!-- /.media-body -->
                          </div><!-- /.media -->
                        
                          <!-- form-group -->
                          <div class="form-group">
                            <label for="input01">Nome completo</label>
                            <input name="nome" type="text" class="form-control" id="input01" value="<?= $usuario->nome ?>" required>
                          </div>
                          <!-- /form row -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input03">Email</label>
                            <input name="email" type="email" class="form-control" id="input03" value="<?= $usuario->email ?>" required disabled>
                          </div>
                          <!-- /.form-group -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input04">CPF ou CNPJ</label>
                            <input name="cpf_cnpj" type="text" class="form-control" id="input04" value="<?= $usuario->cpf_cnpj ?>" required>
                          </div>
                          <!-- /.form-group -->
                          <!-- .form-group -->
                          <div class="form-group">
                            <label for="input05">Telefone</label>
                            <input name="telefone" type="text" class="form-control" id="input05" value="<?= $usuario->telefone ?>" required>
                          </div>
                          <!-- /.form-group -->
                          <hr>
                          <!-- .form-actions -->
                          <div class="form-actions">
                            <button type="submit" value="perfil" class="btn btn-primary ml-auto">Alterar</button>
                          </div><!-- /.form-actions -->
                        </form><!-- /form -->
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->
                  </div><!-- /grid column -->