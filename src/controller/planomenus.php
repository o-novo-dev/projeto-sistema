
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class planomenus extends controller {

  public $planomenus;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
  }

  public function index($id){
    $this->data['view_perfil'] = 'plano';
    $this->data['detalhes'] = 'menus';
    $this->data['id'] = $id;
    
    $this->planomenus = getModel('dataPlanomenus', $id);
    $data = getModel('dataPlanos')->selectWhere([
      ['key' => 'a.id', 'param' => 'id', 'valor' => $id]
    ]);

    if (count($data) > 0){
      if (!$this->planomenus->doGravarAjax()){

        $this->addJS('planomenus.js');
    
        $this->data['form'] = fromFilhoMenuLateral(['Menu'], 'Menus', 'Plano', $id, $this->planomenus->inputs, '/usuario/plano');
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/plano/menus.php", 
          "./src/pages/usuario/layout/footer.php"
        ]);
      }
    } else {
      $page404 = new page404();
      $page404->index();
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->planomenus->selectAll()]);
    else
      echo json_encode(['data' => $this->planomenus->selectWhere(['id' => $id])]);
  }
}
