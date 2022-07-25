<?php
require_once("./src/base/model.php");

class dataModulosMenus extends model {

  function  __construct($id = '') {
    $this->table = 'dev_modulos_menus';
    $this->pk = "id";
    parent::__construct();

    $this->menus = getModel('dataMenus');

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['ativo']['order'] = 2;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->inputs['menu_id']['label'] = "Menu";
    $this->inputs['menu_id']['select'] = $this->menus->selectAll();
    $this->inputs['menu_id']['order'] = 3;
    $this->inputs['menu_id']['required'] = true;

    $this->inputs['modulo_id']['label'] = "Modulo";
    $this->inputs['modulo_id']['value'] = $id;
    $this->inputs['modulo_id']['order'] = 4;
    $this->inputs['modulo_id']['type'] = 'hidden';
    $this->inputs['modulo_id']['col'] = '6';
    $this->inputs['modulo_id']['required'] = true;

    $this->ordernar();
  }

  protected function validate(){
    return true;
  }

  public function selectWhere($where = []){   
    $sql = "SELECT a.id, a.nome, a.ativo, a.modulo_id, a.menu_id, b.nome as menu
              FROM dev_modulos_menus a
             INNER JOIN dev_menus b on b.id = a.menu_id
             WHERE a.ativo = 'Sim'
               AND b.ativo = 'Sim' ";
    foreach ($where as $key => $value) {
      $sql .= " and {$key} = :{$key} ";
    }
    return $this->select($sql, $where);
  }
}