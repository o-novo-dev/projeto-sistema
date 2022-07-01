<?php
require_once("./src/base/model.php");

class dataPages extends model {

  function  __construct($id = '') {
    $this->table = 'pages';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = false;
    
    $this->inputs['ativo']['order'] = 2;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->inputs['projeto_id']['label'] = "Projeto";
    $this->inputs['projeto_id']['value'] = $id;
    $this->inputs['projeto_id']['order'] = 4;
    $this->inputs['projeto_id']['type'] = 'hidden';
    $this->inputs['projeto_id']['col'] = '6';
    $this->inputs['projeto_id']['required'] = true;

    /**
     * A função ordernar caso tenho configurado sua ordenação
     */
    $this->ordernar();

  }

  protected function validate(){
    $arrMessage = [];
    if((!isset($_POST['nome'])) or (empty($_POST['nome']))) {
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Detalhe do Plano!',
      ];
    } else if((!isset($_POST['plano_id'])) or (empty($_POST['plano_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Plano!',
      ];
    } else if((!isset($_POST['modulo_id'])) or (empty($_POST['modulo_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Modulo!',
      ];
    } else if((!isset($_POST['ordem'])) or (empty($_POST['ordem']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Ordem!',
      ];
    } else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }

  public function selectWhere($where = []){
    $sql = "SELECT a.id, a.nome, a.ativo, a.plano_id, a.modulo_id, b.nome as plano, c.nome as modulo, a.ordem
              FROM plano_detalhes a
             INNER JOIN plano b ON a.plano_id = b.id
             INNER JOIN modulos c ON a.modulo_id = c.id
             WHERE a.ativo = 'Sim'
               AND b.ativo = 'Sim'
               AND c.ativo = 'Sim' ";
    foreach ($where as $key => $value) {
      $sql .= " and {$key} = :{$key} ";
    }
    return $this->select($sql, $where);
  }
}