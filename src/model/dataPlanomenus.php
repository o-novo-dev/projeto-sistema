
<?php
require_once('./src/base/model.php');

class dataPlanomenus extends model {

  function  __construct($id = '') {
    $this->table = 'dev_plano_menus';
    $this->pk = 'id';
    parent::__construct();

    $this->inputs['id'] = [
      'label' => 'id',
      'name' => 'id',
      'id' => 'id',
      'value' => '',
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'hidden',
      'col' => '12',
      'order' => 0
    ];

    $this->inputs['nome'] = [
      'label' => 'nome',
      'name' => 'nome',
      'id' => 'nome',
      'value' => '',
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'hidden',
      'col' => '12',
      'order' => 1
    ];

    $this->inputs['ativo'] = [
      'label' => 'ativo',
      'name' => 'ativo',
      'id' => 'ativo',
      'value' => 'Sim',
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'hidden',
      'col' => '12',
      'order' => 2
    ];

    $this->inputs['plano_id'] = [
      'label' => 'plano_id',
      'name' => 'plano_id',
      'id' => 'plano_id',
      'value' => $id,
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'hidden',
      'col' => '12',
      'order' => 3
    ];

    $menus = getModel('dataMenus');
    $this->inputs['menu_id'] = [
      'label' => 'menu_id',
      'name' => 'menu_id',
      'id' => 'menu_id',
      'value' => '',
      'select' => $menus->selectAll(),
      'required' => false,
      'disabled' => false,
      'type' => 'text',
      'col' => '12',
      'order' => 4
    ];



    $this->ordernar();

    $this->afterInsert = function($data) {};
    $this->beforeInsert = function($data) {};

    $this->afterUpdate = function($data) {};
    $this->beforeUpdate = function($data) {};

    $this->afterDelete = function($id) {};
    $this->beforeDelete = function($id) {};
  }

  protected function validate(){
    if((!isset($_POST['menu_id'])) or (empty($_POST['menu_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Menu!',
      ];
    } else {
      return true;
    }

    echo json_encode($arrMessage);
    return false;
  }  

}