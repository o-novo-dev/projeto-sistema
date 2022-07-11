
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class projetos extends controller {

  public $projetos;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->projetos = getModel('dataProjetos');
  }

  public function index(){

    if (!$this->projetos->doGravarAjax()){
      $this->data['view_perfil'] = 'projeto';
      $this->data['detalhes'] = '';
      
      $this->addJS('projetos.js');
  
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_projeto.php", 
        "./src/pages/usuario/projeto/projeto.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->projetos->selectAll()]);
    else
      echo json_encode(['data' => $this->projetos->selectWhere(['id' => $id])]);
  }
}
