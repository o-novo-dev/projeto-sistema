
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
      $this->data['view_perfil'] = 'perfil';
      $this->data['detalhes'] = 'contratos';
      
      $this->addJS('contratos.js');
  
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu.php", 
        "./src/pages/contratos/index.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);  
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->contratos->selectAll()]);
    else
      echo json_encode(['data' => $this->contratos->selectWhere(['id' => $id])]);
  }
}
