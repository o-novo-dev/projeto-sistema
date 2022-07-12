
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class planotipos extends controller {

  public $planotipos;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->planotipos = getModel('dataPlanoTipos');
  }

  public function index(){
    $this->data['view_perfil'] = 'plano';
    $this->data['detalhes'] = 'tipos';

    if (!$this->planotipos->doGravarAjax()){

      $this->addJS('planotipos.js');
  
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_plano.php", 
        "./src/pages/usuario/plano/tipo.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->planotipos->selectAll()]);
    else
      echo json_encode(['data' => $this->planotipos->selectWhere(['id' => $id])]);
  }
}
