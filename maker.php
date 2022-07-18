<?php
require_once("./src/base/conectDB.php");

#region model
function model(){
  $opt = getopt("c:m:v:a:t:s:");
  if (count($opt) > 0){
    $filename = isset($opt['m']) ? $opt['m'] : $opt['all'];
    $tabela = $opt['t'];
    $reescrever = isset($opt['s']) ? $opt['s'] : "n";
  } else {
    $filename = readline("Nome do Arquivo:");
    $tabela = readline("Nome da Tabela:");
    if (file_exists("./src/model/{$filename}.php"))
      $reescrever = readline("Sobrescrever o Arquivo? (s/n)");
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
    \$sql = \"SELECT a.id, a.nome, a.plano_tipo_id, a.projeto_id, a.ativo, b.nome as tipo, c.nome as projeto
              FROM plano a
             INNER JOIN plano_tipos b ON b.id = a.plano_tipo_id
             INNER JOIN projetos c ON c.id = a.projeto_id
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
    
  if ($reescrever == "s")
    file_put_contents("./src/model/{$filename}.php", $content);
}
#endregion

#region controller
function controller() {
  $opt = getopt("c:m:v:a:t:s:");
  print_r($opt);
  if (count($opt) > 0){
    $filename = isset($opt['c']) ? $opt['c'] : $opt['all'];
    //$tabela = $opt['t'];
    $reescrever = isset($opt['s']) ? $opt['s'] : "n";
  } else {
    $filename = readline("Nome do Arquivo:");
    //$tabela = readline("Nome da Tabela:");
    if (file_exists("./src/controller/{$filename}.php"))
      $reescrever = readline("Sobrescrever o Arquivo? (s/n)");
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
    
  if ($reescrever == "s")
    file_put_contents("./src/controller/{$filename}.php", $content);
}
#endregion

#region view
function view(){
  echo 'vx';
}
#endregion

#region start
if ($argc > 1){
  if ($argv[1] == '-h'){
    echo "
    help - argumentos obrigatórios

    -c [filename] => Controller
    -m [filename] => Model
    -v [filename] => View
    -a --all [filename] => Todas opções acima
    -t [Nome] => Tabela do banco de dados
    -s [s/n] => sobrescrever?
    ";
  } else {
    $opt = getopt("c:m:v:a:t:s:");

    if (isset($opt['c'])){
      controller();
    } 
    if (isset($opt['m'])){
      model();
    }
    if (isset($opt['v'])){
      view();
    } 
    if (isset($opt['a'])){
      controller();
      model();
      view();
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