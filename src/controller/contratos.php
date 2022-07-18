
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class contratos extends controller {

  public $contratos;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->contratos = getModel('dataContratos');
  }

  public function index(){

    if (!$this->contratos->doGravarAjax()){

      $this->addJS('contratos.js');
  
      $this->viewLogado('./pages/contratos/index.php');
  
      $this->view('./pages/contratos/index.php');
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->contratos->selectAll()]);
    else
      echo json_encode(['data' => $this->contratos->selectWhere(['id' => $id])]);
  }
}
