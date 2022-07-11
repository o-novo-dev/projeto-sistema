
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class menus extends controller {

  public $menus;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->menus = getModel('dataMenus');
  }

  public function index(){
    $this->data['view_perfil'] = 'menu';
    $this->data['detalhes'] = '';
    if (!$this->menus->doGravarAjax()){

      $this->addJS('menus.js');
  
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_menu.php", 
        "./src/pages/usuario/menu/menus.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->menus->selectAll()]);
    else
      echo json_encode(['data' => $this->menus->selectWhere(['id' => $id])]);
  }
}
