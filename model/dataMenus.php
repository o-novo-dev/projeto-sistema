<?php
require_once("./base/model.php");

class dataMenus extends model {

  function  __construct() {
    $this->table = 'menus';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Menu";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['link']['label'] = "Link";
    $this->inputs['link']['order'] = 2;
    $this->inputs['link']['required'] = true;

    $this->inputs['ativo']['order'] = 3;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();
  }

  protected function validate(){
    return true;
  }
}