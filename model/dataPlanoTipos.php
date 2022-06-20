<?php
require_once("./base/model.php");

class dataPlanoTipos extends model {

  function  __construct() {
    $this->table = 'plano_tipos';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Tipo do Plano";
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

  public function validate(){
    $arrMessage = [];
    if((!isset($_POST['nome'])) or (empty($_POST['nome']))) {
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Tipo do Plano!!',
      ];
    } else {
      return true;
    }

    echo json_encode($arrMessage);
    return false;
  }
}