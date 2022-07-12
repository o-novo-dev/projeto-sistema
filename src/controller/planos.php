
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class planos extends controller {

  public $planos;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->planos = getModel('dataPlanos');
  }

  public function index(){
    $this->data['view_perfil'] = 'plano';
    $this->data['detalhes'] = '';

    if (!$this->planos->doGravarAjax()){

      $this->addJS('planos.js');
  
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_plano.php", 
        "./src/pages/usuario/plano/plano.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->planos->selectAll()]);
    else
      echo json_encode(['data' => $this->planos->selectWhere(['id' => $id])]);
  }
}
