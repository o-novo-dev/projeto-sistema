
<?php
require_once('./src/base/model.php');

class dataContratos extends model {

  function  __construct() {
    $this->table = 'cad_contratos';
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
    $sql = "SELECT a.id, a.nome, a.ativo, a.dt_contrato, 
                   a.plano_id, a.empresa_id, a.status,  a.dt_fim, 
                   b.nome AS plano
              FROM cad_contratos a
             INNER JOIN dev_plano b ON b.id = a.plano_id
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
    $sqlMenus = "
      SELECT DISTINCT d.id, d.nome
        FROM cad_contratos a
       INNER JOIN dev_plano b ON a.plano_id = b.id
       INNER JOIN dev_plano_menus c ON b.id = c.plano_id
       INNER JOIN dev_menus d ON c.menu_id = d.id
       WHERE a.ativo = 'Sim'
         AND a.empresa_id = :empresa_id
         AND a.status = 'Pago'
         AND b.ativo = 'Sim'
         AND c.ativo = 'Sim'
         AND d.ativo = 'Sim'
         AND d.permissao = :tipo
    ";
    $menus = $this->select($sqlMenus, ['empresa_id' => $_SESSION['usuario']->empresa_id, 'tipo' => $_SESSION['usuario']->tipo]);

    foreach ($menus as $key => $menu) {        
      $menus[$key]->submenus = $this->select("
        SELECT id, nome, link, ativo, menu_id 
          FROM dev_menus_sub
        WHERE menu_id = :menu_id
          AND ativo = 'Sim'
      ", ['menu_id' => $menu->id]);
    }
    
    return $menus;
  }

}