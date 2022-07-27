<?php
require_once("./src/base/conectDB.php");

#region model
function model(){
  $opt = getopt("c:m:v:a:t:s:");

  if (!isset($opt['m']) || !isset($opt['t'])){
    if (!isset($opt['m']))
      echo "abrigatório preencher o nome da modelo. -m";
    if (!isset($opt['t']))
      echo "abrigatório preencher o nome da tabela. -t";
    die();
  } 

  if (count($opt) > 0){
    $filename = isset($opt['m']) ? $opt['m'] : $opt['all'];
    $tabela = $opt['t'];
    $reescrever = isset($opt['s']) ? $opt['s'] : "Nao";
  } else {
    $filename = readline("Nome do Arquivo:");
    $tabela = readline("Nome da Tabela:");
    if (file_exists("./src/model/{$filename}.php"))
      $reescrever = readline("Sobrescrever o Arquivo? (Sim/Nao)");
  }
  
  $con = new conectDB();
  $dataColunas = $con->select("SHOW FULL FIELDS FROM {$tabela}");
  $inputs = "";
  $validate = "";
  foreach ($dataColunas as $key => $value) {
    $inputs .= "
    \$this->inputs['{$value->Field}'] = [
      'label' => '{$value->Field}',
      'name' => '{$value->Field}',
      'id' => '{$value->Field}',
      'value' => '',
      'select' => null,
      'required' => ".($value->Null == 'NO' ? "false" : 'true').",
      'disabled' => false,
      'type' => '".($value->Key == 'PRI' ? 'hidden' : ($value->Field == 'ativo' ? 'hidden' : 'text'))."',
      'col' => '12',
      'order' => {$key}
    ];\n";

    if($value->Key == 'PRI'){
      $pk = $value->Field;
    }

    if ($value->Null !== 'NO'){
      $validate .= "
      if((!isset(\$_POST['{$value->Field}'])) or (empty(\$_POST['{$value->Field}']))) {
        echo json_encode([
          'status' => 'false', 
          'title' => 'Falhou',
          'message' => 'Por favor, Preencher o campo {$value->Field}!',
        ]);
        return false;
      }\n";
    }
  }

  $filename = "data".ucfirst($filename);

  $content = "
<?php
require_once('./src/base/model.php');

class {$filename} extends model {

  function  __construct() {
    \$this->table = '{$tabela}';
    \$this->pk = '{$pk}';
    parent::__construct();

    {$inputs}


    \$this->ordernar();

    \$this->afterInsert = function(\$data) {};
    \$this->beforeInsert = function(\$data) {};

    \$this->afterUpdate = function(\$data) {};
    \$this->beforeUpdate = function(\$data) {};

    \$this->afterDelete = function(\$id) {};
    \$this->beforeDelete = function(\$id) {};
  }

  protected function validate(){
    {$validate}
    return true;
  }  


  public function selectWhere(\$where = []){
    \$sql = \"SELECT a.id, a.nome, a.plano_tipo_id, a.ativo, b.nome as tipo
              FROM dev_plano a
             INNER JOIN dev_plano_tipos b ON b.id = a.plano_tipo_id
             WHERE a.ativo = 'Sim' \";
    \$andWhere = [];
    foreach (\$where as \$key => \$value) {
      \$sql .= \" AND {\$value['key']} = :{\$value['param']} \";
      \$andWhere = [\$value['param'] => \$value['valor']];
    }
    
    return \$this->select(\$sql, \$andWhere);
  }

}";

  echo $content;

  if (file_exists("./src/model/{$filename}.php"))
    echo "Arquivo encontrado";
    
  if ($reescrever == "Sim")
    file_put_contents("./src/model/{$filename}.php", $content);
}
#endregion

#region controller
function controller() {
  $opt = getopt("c:m:v:a:t:s:");
  if (!isset($opt['c']) || !isset($opt['t'])){
    if (!isset($opt['c']))
      echo "abrigatório preencher o nome da controller. -c";
    /*if (!isset($opt['t']))
      echo "abrigatório preencher o nome da tabela. -t";*/
    die();
  } 

  print_r($opt);
  if (count($opt) > 0){
    $filename = isset($opt['c']) ? $opt['c'] : $opt['all'];
    //$tabela = $opt['t'];
    $reescrever = isset($opt['s']) ? $opt['s'] : "Nao";
  } else {
    $filename = readline("Nome do Arquivo:");
    //$tabela = readline("Nome da Tabela:");
    if (file_exists("./src/controller/{$filename}.php"))
      $reescrever = readline("Sobrescrever o Arquivo? (Sim/Nao)");
  }
  
  

  $model = ucfirst($filename);
  $content = "
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class {$filename} extends controller {

  public \${$filename};

  function __construct() {
    if (!isset(\$_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    \$this->{$filename} = getModel('data{$model}');
  }

  public function index(){

    if (!\$this->{$filename}->doGravarAjax()){

      \$this->addJS('{$filename}.js');
  
      \$this->data['formParaMenuLateral'] = formParaMenuLateral(['Coluna', 'Coluna', 'Coluna', 'Coluna'], 'Titulo', \$this->contratos->inputs, false);

      \$this->viewLogado('./pages/{$filename}/index.php');
  
      \$this->view('./pages/{$filename}/index.php');
    }
  }

  public function get(\$id = ''){
    if (empty(\$id))
      echo json_encode(['data' => \$this->{$filename}->selectAll()]);
    else
      echo json_encode(['data' => \$this->{$filename}->selectWhere(['id' => \$id])]);
  }
}
";
  echo $content;

  if (file_exists("./src/controller/{$filename}.php"))
    echo "Arquivo encontrado";
    
  if ($reescrever == "Sim")
    file_put_contents("./src/controller/{$filename}.php", $content);
}
#endregion

#region view
function view(){
  $opt = getopt("c:m:v:a:t:s:");
  if (!isset($opt['v']) || !isset($opt['t'])){
    if (!isset($opt['v']))
      echo "abrigatório preencher o nome da modelo. -m";
    if (!isset($opt['t']))
      echo "abrigatório preencher o nome da tabela. -t";
    die();
  } 
  
  if (count($opt) > 0){
    $filename = isset($opt['v']) ? $opt['v'] : $opt['all'];
    $tabela = $opt['t'];
    $reescrever = isset($opt['s']) ? $opt['s'] : "Nao";
  } else {
    $filename = readline("Nome do Arquivo:");
    $tabela = readline("Nome da Tabela:");
    if (file_exists("./src/controller/{$filename}.php"))
      $reescrever = readline("Sobrescrever o Arquivo? (Sim/Nao)");
  }

  $con = new conectDB();
  $dataColunas = $con->select("SHOW FULL FIELDS FROM {$tabela}");
  $setInputs = "";
  $clearInputs = "";
  foreach ($dataColunas as $key => $value) {
    $setInputs .= "\t\t\t\tdocument.getElementById('{$value->Field}').value = row.{$value->Field} // campos da tabela";
    $clearInputs .= "\t\tdocument.getElementById('{$value->Field}').value = '';";
  }
  $content = "
  var table
  const load = (e) => {
    table = $('#datatable').DataTable( {
      ajax: base_url + '/{$filename}/get', //retornar json
      responsive: true,
      dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
        <'table-responsive'tr>
        <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>`,
      language: {
        paginate: {
          previous: '<i class=\"fa fa-lg fa-angle-left\"></i>',
          next: '<i class=\"fa fa-lg fa-angle-right\"></i>'
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
          <a class='btn btn-sm btn-icon btn-secondary' data-row='\${dataRow}' data-toggle='modal' href='#modalForm'><i class='fa fa-pencil-alt'></i></a>
          <a class='btn btn-sm btn-icon btn-secondary' data-row='\${dataRow}' data-toggle='modal' href='#modalFormDelete' data-tabela='{$tabela}' data-campo='ativo' data-valor='Não' data-datatable='datatable'><i class='far fa-trash-alt'></i></a>
          <!-- <a class='btn btn-sm btn-icon btn-secondary' data-row='\${dataRow}' href='\${base_url}/[controller]/[method]/[param1]/\${row.id}' role='button' data-toggle='tooltip' data-placement='top' title='[Titulo Filho]'><i class='fab fa-elementor'></i></a> -->
          `
        }
      }]
    } );
  
  
    $('#modalForm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var row = button.data('row')
      if (row !== undefined){
        {$setInputs}
      }
      //console.log(row);
    })
  
    
    $('#modalForm').on('hidden.bs.modal', function (event) {  
      document.getElementById('formAdd').reset();   
      {$clearInputs}
    })
  }
  
  
  const submitForm = (e) => {
    if (e !== undefined)
      e.preventDefault();
  
    var myForm = document.getElementById('formAdd');
    enviarViaAjax(myForm, 'modalForm', 'datatable')
  }
  
  /**
   *  Submit
   */
  document.getElementById('formAdd').addEventListener('submit', submitForm);
  
  /**
   *  Carregar
   */
  window.addEventListener('load', load);
  ";

  echo $content;

  if (file_exists("./public/assets/javascript/view/{$filename}.js"))
    echo "Arquivo encontrado";
    
  if ($reescrever == "Sim")
    file_put_contents("./public/assets/javascript/view/{$filename}.js", $content);

  $content = "
  <?= \$formHTML ?>
  ";

  echo $content;

  if (file_exists("./src/pages/{$filename}/index.php"))
    echo "Arquivo encontrado";
    
  if ($reescrever == "Sim")
    file_put_contents("./src/pages/{$filename}/index.php", $content);
}
#endregion

#region start
if ($argc > 1){
  if ($argv[1] == '-h'){
    echo "
    /*****************************************************************************/
    /******************** Maker.php Developer Help *******************************/
    /*****************************************************************************/
    /*****************************************************************************/

    help - argumentos obrigatórios

    usage: php maker.php -c usuario -t tbl_usuario -s Sim
    usage: php maker.php -m usuario -t tbl_usuario -s Sim
    usage: php maker.php -v usuario -t tbl_usuario -s Sim

    -c          Controller
    -m          Model
    -v          View
    -r          Relatório
    -a --all    Todas opções acima
    -t          Tabela do banco de dados
    -s          Sim/Não => Sobrescrever?
    ";
  } else {
    $opt = getopt("c:m:v:a:t:s:");

    if (isset($opt['c'])){
      controller();
    } else
    if (isset($opt['m'])){
      model();
    } else
    if (isset($opt['v'])){
      view();
    } else
    if (isset($opt['a'])){
      controller();
      model();
      view();
    } else {
      echo "utilize o help -h para descobrir os parametros.";
    }
  } 
} else {
  echo "
  c - Controller
  m - Model
  v - View
  a - Todas opções
  s - Sair
  ";
  do {
    $opt = readline("\nOpção: ");
    switch ($opt) {
      case 'c':
        controller();
        break;
      case 'm':
        model();
        break;
      case 'v':
        view();
        break;
      case 'a':
        controller();
        model();
        view();
        break;
      default:
        # code...
        break;
    }
  } while ($opt !== 's');
}
#endregion