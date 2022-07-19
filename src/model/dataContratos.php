
<?php
require_once('./src/base/model.php');

class dataContratos extends model {

  function  __construct() {
    $this->table = 'contratos';
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
      'label' => 'Contrato',
      'name' => 'nome',
      'id' => 'nome',
      'value' => '',
      'select' => null,
      'required' => true,
      'disabled' => false,
      'type' => 'text',
      'col' => '12',
      'order' => 1
    ];

    $this->inputs['ativo'] = [
      'label' => 'ativo',
      'name' => 'ativo',
      'id' => 'ativo',
      'value' => '',
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'hidden',
      'col' => '12',
      'order' => 2
    ];

    $this->inputs['dt_contrato'] = [
      'label' => 'Data Contrato',
      'name' => 'dt_contrato',
      'id' => 'dt_contrato',
      'value' => '',
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'text',
      'col' => '12',
      'order' => 3
    ];

    $this->planos = getModel('dataPlanos');
    $this->inputs['plano_id'] = [
      'label' => 'Plano',
      'name' => 'plano_id',
      'id' => 'plano_id',
      'value' => '',
      'select' => $this->planos->selectAll(),
      'required' => false,
      'disabled' => false,
      'type' => 'text',
      'col' => '12',
      'order' => 4
    ];

    $this->inputs['empresa_id'] = [
      'label' => 'empresa_id',
      'name' => 'empresa_id',
      'id' => 'empresa_id',
      'value' => $_SESSION['usuario']->empresa_id,
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'hidden',
      'col' => '12',
      'order' => 5
    ];

    $this->inputs['status'] = [
      'label' => 'status',
      'name' => 'status',
      'id' => 'status',
      'value' => '',
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'text',
      'col' => '12',
      'order' => 6
    ];

    $this->inputs['dt_fim'] = [
      'label' => 'dt_fim',
      'name' => 'dt_fim',
      'id' => 'dt_fim',
      'value' => '',
      'select' => null,
      'required' => false,
      'disabled' => false,
      'type' => 'text',
      'col' => '12',
      'order' => 7
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
    return true;
  }  


  public function selectWhere($where = []){
    $sql = "SELECT a.id, a.nome, a.plano_id, a.ativo, b.nome as plano
              FROM contratos a
             INNER JOIN plano b ON b.id = a.plano_id
             WHERE a.ativo = 'Sim' 
               AND a.empresa_id = " . $_SESSION['usuario']->empresa_id;
    $andWhere = [];
    foreach ($where as $key => $value) {
      $sql .= " AND {$value['key']} = :{$value['param']} ";
      $andWhere = [$value['param'] => $value['valor']];
    }
    
    return $this->select($sql, $andWhere);
  }

  public function getMenus(){
    $sql = "
      SELECT DISTINCT g.id, g.nome, g.icone, g.link, g.ordem
        FROM contratos a
      INNER JOIN plano b ON a.plano_id = b.id
      INNER JOIN plano_tipos c ON b.plano_tipo_id = c.id
      INNER JOIN plano_detalhes d ON b.id = d.plano_id
      INNER JOIN modulos e ON d.modulo_id = e.id
      INNER JOIN modulos_menus f ON e.id = f.modulo_id
      INNER JOIN menus g ON f.menu_id = g.id
      WHERE a.ativo = 'Sim'
        AND a.empresa_id = :empresa_id
        AND a.status = 'Pago'
        AND g.ativo = 'Sim'
        AND f.ativo = 'Sim'
      ORDER BY g.ordem DESC
    ";
    $menus = $this->select($sql, ['empresa_id' => $_SESSION['usuario']->empresa_id]);
    foreach ($menus as $key => $menu) {
      
      $menus[$key]->submenus = $this->select("
        SELECT id, nome, link, ativo, menu_id 
          FROM submenus 
         WHERE menu_id = :menu_id
           AND ativo = 'Sim'
      ", ['menu_id' => $menu->id]);
    }

    return $menus;
  }

}