<?php
require_once("./src/base/conectDB.php");

function model(){
  $opt = getopt("c:m:v:a:t:");
  if (count($opt) > 0){
    $filename = isset($opt['m']) ? $opt['m'] : $opt['all'];
    $tabela = $opt['t'];
  } else {
    $filename = readline("filename:");
    $tabela = readline("Nome tabela:");
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
      'type' => ".($value->Key == 'PRI' ? 'hidden' : ($value->Field == 'ativo' ? 'hidden' : 'text')).",
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

  $file = "
<?php
require_once('./src/base/model.php');

class data{$filename} extends model {

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

  echo $file;
}

function controller(){
  echo 'cx';
}

function view(){
  echo 'vx';
}

if ($argc > 1){
  if ($argv[1] == '-h'){
    echo "
    help - argumentos obrigatórios

    -c [filename] => Controller
    -m [filename] => Model
    -v [filename] => View
    -a --all [filename] => Todas opções acima
    -t [Nome] => Tabela do banco de dados
    ";
  } else {
    $opt = getopt("c:m:v:a:t:");

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