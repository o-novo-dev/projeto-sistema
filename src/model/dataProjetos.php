<?php
require_once("./src/base/model.php");

class dataProjetos extends model {

  function  __construct() {
    $this->table = 'projetos';
    $this->pk = "id";
    parent::__construct();
    // $this->modulos = getModel('dataModulos');

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Projeto";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['col'] = '12';
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['site']['label'] = "Site";
    $this->inputs['site']['order'] = 2;
    $this->inputs['site']['col'] = '12';
    $this->inputs['site']['required'] = true;

    $this->inputs['dominio']['label'] = "Dominio";
    $this->inputs['dominio']['order'] = 3;
    $this->inputs['dominio']['col'] = '12';
    $this->inputs['dominio']['required'] = true;

    $this->inputs['ativo']['order'] = 4;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();
  }

  protected function validate(){
    $arrMessage = [];
    if((!isset($_POST['nome'])) or (empty($_POST['nome']))) {
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
}