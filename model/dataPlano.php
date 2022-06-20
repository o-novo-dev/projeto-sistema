<?php
require_once("./base/model.php");

class dataPlano extends model {

  function  __construct() {
    $this->table = 'Plano';
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
  
  public function selectWhere($where = []){
    
    $sql = "SELECT a.id, a.nome, a.plano_tipo_id, a.projeto_id, a.ativo, b.nome as tipo
              FROM plano a
             INNER JOIN plano_tipos b ON b.id = a.plano_tipo_id
             WHERE a.ativo = 'Sim'
               AND a.ativo = 'Sim' ";
    foreach ($where as $key => $value) {
      $sql .= " and {$key} = :{$key} ";
    }
    return $this->select($sql, $where);
  }
}