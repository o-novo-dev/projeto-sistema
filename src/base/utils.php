<?php

function getController($controller, $param = ''){
  require_once("./src/controller/{$controller}.php");
  if (empty($param))
    return new $controller();
  else 
    return new $controller($param);
}  

function getModel($model, $param = ''){
  require_once("./src/model/{$model}.php");
  if (empty($param))
    return new $model();
  else 
    return new $model($param);
}

function redirect($page){
  header("Location: " . BASE_URL . "{$page}");
  exit;
}

function getPost($name){
  if (isset($_POST))
    return isset($_POST[$name]) ? $_POST[$name] : "";
  return "";
}

function indicator($msg, $alert) {
  return "
  <div class='row'>
    <div class='col-lg-12'>
      <div class='alert alert-{$alert} alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <a href='#' class='alert-link'>{$msg}</a>
      </div>
    </div>
  </div>
  ";
}

function setflashdata($msg) {
  $_SESSION['flash_message'] = $msg;
}

function getflashdata(){
  echo isset($_SESSION['flash_message']) ? $_SESSION['flash_message'] : "";
  unset($_SESSION['flash_message']);
}

function input($label, $name, $id, $value, $type, $select = [], $col = '12', $order, $required = false, $disabled = false){
  $display = $type == 'hidden' ? 'd-none' : '';
  if ($disabled) $required = false;
  $required = $required ? "required" : "";
  $disabled = $disabled ? "disabled" : "";

  if ($select !== null){
    $html = "
        <div class='col-md-{$col} mb-3 {$display}'>
          <label for='{$id}'>{$label}</label>
          <div class='form-label-group'>
            <select class='custom-select' id='{$id}' name='{$name}' {$required} {$disabled}>
              <option value=''> Selecionar... </option>";
              foreach ($select as  $valor) {
                $active = $value == $valor->id ?  "selected" : "";
                $html .="<option value='{$valor->id}' $active> {$valor->nome} </option>";
              }
      $html .="</select> <label for='{$id}'>{$label}</label>
          </div>
        </div>
    ";
    return $html;
  } else {
    return "
    
      <div class='col-md-{$col} mb-3 {$display}'>
        <label for='{$id}'>{$label}</label>
        <input name='{$name}' type='{$type}' class='form-control' id='{$id}' value='{$value}' placeholder='{$label}' {$required} {$disabled}>
      </div>
    
    ";
  }
}

function formCard($inputs, $titulo, $titulo_button = 'Alterar', $nome_id = 'formAdd', $multpart = false){
  $enctype = $multpart ? "enctype='multipart/form-data'" : "";
  $titulo = empty($titulo) ? "" : "<h6> {$titulo} </h6>";
  $html = "
  <!-- .card -->
  <div class='card card-fluid'>
    <div class='card-header'>
      $titulo
    </div>
    <!-- .card-body -->
    <div class='card-body'>
      <!-- form -->
      <form action='{$_SERVER['REDIRECT_URL']}' method='POST' id='{$nome_id}' {$enctype}>
        <div class='form-row'>";
       
          foreach($inputs as $key => $value) {
            //if (isset($value['value']))
              //print_r($inputs);
            $html .= input($value['label'], $value['name'], $value['id'], $value['value'], $value['type'], $value['select'], $value['col'], $value['order'], $value['required'], $value['disabled']);
          }
  $html .= " </div>
        <hr>
        <!-- .form-actions -->
        <div class='form-actions'>
          <button type='submit' value='perfil' class='btn btn-primary ml-auto'>{$titulo_button}</button>
        </div><!-- /.form-actions -->
      </form><!-- /form -->
    </div><!-- /.card-body -->
  </div><!-- /.card -->
  ";

  return $html;
}

/**
 * @param name Nome do input
 * @return array|false [message(string)|success(bool)|filename] | false não enviou nenhum imagem
 */
function upload($name, $dir){
  if(isset($_FILES[$name]))
  {
    if (($_FILES[$name]['size'] > 2097152)){
      return ['message' => 'Não é permitido imagem maior que 2 mega de tamanho.', 'success' => false];
    }

    $ext = strtolower(substr($_FILES[$name]['name'],-4)); //Pegando extensão do arquivo
    $new_name = md5(date("Y.m.d-H.i.s")) . $ext; //Definindo um novo nome para o arquivo
    $dir = DIR_PUBLIC . $dir; //Diretório para uploads 

    if (move_uploaded_file($_FILES[$name]['tmp_name'], $dir.$new_name)){ //Fazer upload do arquivo
      return ['message' => 'Upload realizado com successo.', 'success' => true, 'filename' => $new_name];
    } else {
      return ['message' => 'Falha ao gravar a imagem', 'success' => false, 'filename' => $new_name];
    }  
  } 

  return false;
}

/**
 * @param $filename
 */
function deleteFile($filename, $dir){
  $dir = DIR_PUBLIC . $dir;
  if (file_exists($dir.$filename))
    unlink($dir.$filename);
}


/**
 * formlários para Menus de Lateral esquerda.
 * 
 * @param colunas array com nomes das colunas
 * @param titulo titulo do formulário
 * @param inputs os campos configurados nas classes modelos
 * @return content html contendo o formulário para telas que tenham menu na lateral esquerda
 * 
 * @exemple echo formParaMenuLateral(['Modulo'], 'Cadastro de Modulos', $this->modulos->inputs);
 */
function formParaMenuLateral($colunas, $titulo, $inputs, $btnAddAtivo = true){
  $row = "";
  foreach ($colunas as $key => $value) {
    $row .= "<th> {$value} </th>";
  }
  $content = "
                      <!-- grid column -->
                      <div class='col-lg-8'>

                        <!-- .page-section -->
                        <div class='page-section'>
                          <!-- .card -->
                          <div class='card card-fluid'>
                            <div class='card-header'>
                              ". ($btnAddAtivo ? "<button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#modalForm'>Adicionar</button>" : "") ."
                            </div>
                            <!-- .card-body -->
                            <div class='card-body'>
                              <!-- .table -->
                              <table id='datatable' class='table dt-responsive nowrap w-100'>
                                <thead>
                                  <tr>
                                    {$row}
                                    <th style='width:100px; min-width:100px;'>&nbsp;</th>
                                  </tr>
                                </thead>
                                
                              </table><!-- /.table -->
                            </div><!-- /.card-body -->
                          </div><!-- /.card -->
                        </div><!-- /.page-section -->
                      
                      </div><!-- /grid column -->



    <div class='modal fade' id='modalForm' tabindex='-1' role='dialog' aria-labelledby='modalFormLabel' aria-hidden='true'>
      <!-- .modal-dialog -->
      <div class='modal-dialog modal-lg modal-dialog-scrollable' role='document'>
        <!-- .modal-content -->
        <div class='modal-content'>
          <!-- .modal-header -->
          <div class='modal-header'>
            <h5 id='modalFormLabel' class='modal-title'> {$titulo} </h5>
          </div>
          <!-- /.modal-header -->
          <!-- .modal-body -->
          <div class='modal-body'>
            ". formCard($inputs, '', 'Salvar') . "
          </div>
          <!-- /.modal-body -->
          <!-- .modal-footer -->
          <div class='modal-footer'>
            <button type='submit' form='formAdd' value='perfil' class='btn btn-primary ml-auto'>Salvar</button>
            <button type='button' class='btn btn-outline-secondary' data-dismiss='modal'>Fechar</button>
          </div>
          <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  ";

  return $content;
}

function fromFilhoMenuLateral($colunas, $titulo, $titulo_pai, $id, $inputs, $url, $btnAddAtivo = true){

  $row = "";
  foreach ($colunas as $key => $value) {
    $row .= "<th> {$value} </th>";
  }

  $url = BASE_URL . $url;

  $content = "
                <!-- .page-inner -->
                <div class='page-inner'>
                  <!-- .page-section -->
                  <div class='page-section'>
                    <?= getflashdata() ?>
                    <!-- grid row -->
                    <div class='row'>
                      <header class='page-title-bar'>
                        <nav aria-label='breadcrumb'>
                          <ol class='breadcrumb'>
                            <li class='breadcrumb-item active'>
                              <a href='{$url}'><i class='breadcrumb-icon fa fa-angle-left mr-2'></i>Voltar ao {$titulo_pai} </a>
                            </li>
                          </ol>
                        </nav>
                        <h1 class='page-title'>  {$titulo}  </h1>
                      </header>
                      <!-- grid column -->
                      <div class='col-lg-12'>

                        <!-- .page-section -->
                        <div class='page-section'>
                          <!-- .card -->
                          <div class='card card-fluid'>
                            <div class='card-header'>
                              " . ($btnAddAtivo ? "<button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#modalForm'>Adicionar</button>" : "") . "
                            </div>
                            <!-- .card-body -->
                            <div class='card-body'>
                              <!-- .table -->
                              <table id='datatable' class='table dt-responsive nowrap w-100'>
                                <thead>
                                  <tr>
                                    {$row}
                                    <th style='width:100px; min-width:100px;'>&nbsp;</th>
                                  </tr>
                                </thead>
                                
                              </table><!-- /.table -->
                            </div><!-- /.card-body -->
                          </div><!-- /.card -->
                        </div><!-- /.page-section -->
                      
                      </div><!-- /grid column -->



    <div class='modal fade' id='modalForm' tabindex='-1' role='dialog' aria-labelledby='modalFormLabel' aria-hidden='true'>
      <!-- .modal-dialog -->
      <div class='modal-dialog modal-lg modal-dialog-scrollable' role='document'>
        <!-- .modal-content -->
        <div class='modal-content'>
          <!-- .modal-header -->
          <div class='modal-header'>
            <h5 id='modalFormLabel' class='modal-title'>{$titulo}></h5>
          </div>
          <!-- /.modal-header -->
          <!-- .modal-body -->
          <div class='modal-body'>
             " . formCard($inputs, '', 'Salvar') . "
          </div>
          <!-- /.modal-body -->
          <!-- .modal-footer -->
          <div class='modal-footer'>
            <button type='submit' form='formAdd' value='perfil' class='btn btn-primary ml-auto'>Salvar</button>
            <button type='button' class='btn btn-outline-secondary' data-dismiss='modal'>Fechar</button>
          </div>
          <!-- /.modal-footer -->
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <script>
      var id = {$id};
    </script>
  ";

  return $content;
}