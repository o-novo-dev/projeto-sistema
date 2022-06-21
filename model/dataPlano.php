<?php
require_once("./base/model.php");

class dataPlano extends model {

  function  __construct() {
    $this->table = 'plano';
    $this->pk = "id";
    parent::__construct();

    $tipo = getModel('dataPlanoTipos');
    $projetos = getModel('dataProjetos');

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Plano";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['plano_tipo_id']['label'] = "Tipo do Plano";
    $this->inputs['plano_tipo_id']['select'] = $tipo->selectAll();
    $this->inputs['plano_tipo_id']['order'] = 2;
    $this->inputs['plano_tipo_id']['required'] = true;

    $this->inputs['projeto_id']['label'] = "Projeto";
    $this->inputs['projeto_id']['select'] = $projetos->selectAll();
    $this->inputs['projeto_id']['order'] = 3;
    $this->inputs['projeto_id']['required'] = true;

    $this->inputs['ativo']['order'] = 4;
    $this->inputs['ativo']['value'] = 'Sim';

    /**
     * A função ordernar caso tenho configurado sua ordenação
     */
    $this->ordernar();

    /*$this->afterInsert = function() {};
    $this->beforeInsert = function($id) {};

    $this->afterUpdate = function($id) {};
    $this->beforeUpdate = function() {};

    $this->afterDelete = function($id) {};
    $this->beforeDelete = function() {};*/
  }

  protected function validate(){
    $arrMessage = [];
    if((!isset($_POST['nome'])) or (empty($_POST['nome']))) {
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Plano!!',
      ];
    } else if((!isset($_POST['plano_tipo_id'])) or (empty($_POST['plano_tipo_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Tipo do Plano!',
      ];
    } else if((!isset($_POST['projeto_id'])) or (empty($_POST['projeto_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Projeto!',
      ];
    } else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }
  
  public function selectWhere($where = []){
    $sql = "SELECT a.id, a.nome, a.plano_tipo_id, a.projeto_id, a.ativo, b.nome as tipo, c.nome as projeto
              FROM plano a
             INNER JOIN plano_tipos b ON b.id = a.plano_tipo_id
             INNER JOIN projetos c ON c.id = a.projeto_id
             WHERE a.ativo = 'Sim'
               AND b.ativo = 'Sim' 
               AND c.ativo = 'Sim'";
    foreach ($where as $key => $value) {
      $sql .= " AND {$key} = :{$key} ";
    }
    return $this->select($sql, $where);
  }
}