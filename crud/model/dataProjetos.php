<?php
require_once("./base/model.php");

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
    
    // $this->inputs['modulos_id']['label'] = "Modulo";
    // $this->inputs['modulos_id']['select'] = $this->modulos->selectAll();
    // $this->inputs['modulos_id']['order'] = 2;
    // $this->inputs['modulos_id']['col'] = '6';
    // $this->inputs['modulos_id']['required'] = true;

    $this->inputs['ativo']['order'] = 2;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();
  }

  protected function validate(){
    return true;
  }
}