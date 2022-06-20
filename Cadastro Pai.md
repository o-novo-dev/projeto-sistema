# HTML PAGES

>diretório ./pages/[controller]/[method]/index.php

```html
<?php
  $colunas = ['Modulo'];
  $titulo = "Modulos";
  $inputs = $this->modulos->inputs;
?>
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
                                <?php
                                  foreach ($colunas as $key => $value) {
                                    echo "<th> {$value} </th>";
                                  }
                                ?>
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
        <h5 id="modalFormLabel" class="modal-title"><?= $titulo ?></h5>
      </div>
      <!-- /.modal-header -->
      <!-- .modal-body -->
      <div class="modal-body">
        <?= formCard($inputs, '', 'Salvar') ?>
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
```

# PHP Model

>diretório ./model/data[Tabela].php

```php
<?php
require_once("./base/model.php");

class data[Tabela] extends model {

  function  __construct() {
    $this->table = '[Tabela]';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Modulo";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['ativo']['order'] = 2;
    $this->inputs['ativo']['value'] = 'Sim';

    /**
     * A função ordernar caso tenho configurado sua ordenação
     */
    $this->ordernar();

    $this->afterInsert = function() {};
    $this->beforeInsert = function($id) {};

    $this->afterUpdate = function($id) {};
    $this->beforeUpdate = function() {};

    $this->afterDelete = function($id) {};
    $this->beforeDelete = function() {};
  }

  protected function validate(){
    $arrMessage = [];
    if((!isset($_POST['[campo]'])) or (empty($_POST['[campo]']))) {
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo [titulo p/ coluna]!',
      ];
    } else if((!isset($_POST['[campo]'])) or (empty($_POST['[campo]']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo [titulo p/ coluna]!',
      ];
    } else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }  
}
```

# PHP Controller

>diretório ./controller/[controller].php

```php
<?php 
require_once("./base/controller.php");
require_once("./controller/page404.php");

class [controller] extends controller {

  public $[model];
  
  /**
   * Obrigatório fazer a criação.
   */
  function __construct() {
    /**
     * utilizar o if para as paginas controladas pelo login
     */
    if (!isset($_SESSION['usuario'])) redirect("/login");
    parent::__construct();
    $this->[model] = getModel('data[model]');
  }

  /**
   * Obrigatório criar o index
   */
  public function index(){
    /**
     * JS se necessário
     */
    $this->addJS('[controller].js');
    /**
     * viewLogado contem o layout para paginas logados
     * o parametro pode ser array, quando requerer incluir outro layout
     */
    $this->viewLogado("./pages/[controller]/index.php");

    /**
     * view contem o layout para paginas não logado
     */
    $this->view("./pages/[controller]/index.php");
  }

  public function [method]($[param1] = '', $[param2] = ''){
    $this->data['id'] = $id;
    
    if (empty($[param1])) {
      $this->_pai();
    } else if ($[param1] == 'getJson') {
      echo json_encode(["data" => $this->[model]->selectAll()]);
    }
  }

  public function _pai(){
    if (!$this->[model]->doGravarAjax()){
      
      $this->addJS('[controller].js');
      $this->viewLogado([
        "./pages/[controller]/layout/header.php", 
        "./pages/[controller]/[method]/index.php", 
        "./pages/[controller]/layout/footer.php"
      ]);
    }
  }
```

# Javascript

>diretório ./public/assets/javascript/view/[controller].js

```javascript
var table
const load = (e) => {
  table = $('#datatable').DataTable( {
    ajax: base_url + '/[controller]/[method]/[param1]/[param2]', //retornar json
    responsive: true,
    dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
      <'table-responsive'tr>
      <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>`,
    language: {
      paginate: {
        previous: '<i class="fa fa-lg fa-angle-left"></i>',
        next: '<i class="fa fa-lg fa-angle-right"></i>'
      }
    },
    columns: [
      { data: '[nome]' },
      { data: 'id', className: 'align-middle text-right', orderable: false, searchable: false }
    ],
    columnDefs: [{
      targets: 1,
      render: function (data, type, row, meta) {
        let dataRow = JSON.stringify(row);
        return `
        <a class="btn btn-sm btn-icon btn-secondary" data-row='${dataRow}' data-toggle="modal" href="#modalForm"><i class="fa fa-pencil-alt"></i></a>
        <a class="btn btn-sm btn-icon btn-secondary" data-row='${dataRow}' data-toggle="modal" href="#modalFormDelete" data-tabela="[tabela]" data-campo="ativo" data-valor="Não" data-datatable="datatable"><i class="far fa-trash-alt"></i></a>
        <a class="btn btn-sm btn-icon btn-secondary" data-row='${dataRow}' href="${base_url}/[controller]/[method]/[param1]/${row.id}" role="button" data-toggle="tooltip" data-placement="top" title="[Titulo Filho]"><i class="fab fa-elementor"></i></a>
        `
      }
    }]
  } );


  $('#modalForm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var row = button.data('row')
    if (row !== undefined){
      document.getElementById('id').value = row.id // campos da tabela
      document.getElementById('nome').value = row.nome // campos da tabela
      document.getElementById('ativo').value = row.ativo // campos da tabela
    }
    //console.log(row);
  })

  
  $('#modalForm').on('hidden.bs.modal', function (event) {  
    document.getElementById('formAdd').reset();   
    document.getElementById('id').value = '';
    document.getElementById('ativo').value = 'Sim';
  })
}


const submitForm = (e) => {
  if (e !== undefined)
    e.preventDefault();

  var myForm = document.getElementById('formAdd');
  enviarViaAjax(myForm, "modalForm", "datatable")
}

/**
 *  Submit
 */
document.getElementById('formAdd').addEventListener('submit', submitForm);

/**
 *  Carregar
 */
window.addEventListener('load', load);
```