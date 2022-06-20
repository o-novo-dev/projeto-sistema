<?php
require_once("./base/model.php");

class dataSubmenus extends model {

  function  __construct($id = '') {
    $this->table = 'submenus';
    $this->pk = "id";
    parent::__construct();

    $this->menus = getModel('dataMenus');

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Submenu";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['link']['label'] = "Link";
    $this->inputs['link']['order'] = 2;
    $this->inputs['link']['required'] = true;

    $this->inputs['ativo']['order'] = 3;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->inputs['menu_id']['label'] = "submenu";
    $this->inputs['menu_id']['value'] = $id;
    $this->inputs['menu_id']['order'] = 2;
    $this->inputs['menu_id']['type'] = 'hidden';
    $this->inputs['menu_id']['col'] = '6';
    $this->inputs['menu_id']['required'] = true;

    $this->ordernar();
  }

  protected function validate(){
    return true;
  }
}