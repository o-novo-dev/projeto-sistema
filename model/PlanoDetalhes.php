<?php
require_once("./base/model.php");

class dataPlanoDetalhes extends model {

  function  __construct($id = '') {
    $this->table = 'plano_detalhes';
    $this->pk = "id";
    parent::__construct();

    $this->modulos = getModel('dataModulos');

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['ativo']['order'] = 2;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->inputs['modulo_id']['label'] = "modulo";
    $this->inputs['modulo_id']['select'] = $this->modulos->selectAll();
    $this->inputs['modulo_id']['order'] = 3;
    $this->inputs['modulo_id']['required'] = true;

    $this->inputs['plano_id']['label'] = "Plano";
    $this->inputs['plano_id']['value'] = $id;
    $this->inputs['plano_id']['order'] = 4;
    $this->inputs['plano_id']['type'] = 'hidden';
    $this->inputs['plano_id']['col'] = '6';
    $this->inputs['plano_id']['required'] = true;

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
    } else if((!isset($_POST['order'])) or (empty($_POST['order']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Order!',
      ];
    } else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }
}