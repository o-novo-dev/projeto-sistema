
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class submenus extends controller {

  public $submenus;
  private $menu_id;

  function __construct($menu_id = '') {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->menu_id = $menu_id;
    $this->submenus = getModel('dataSubmenus', $menu_id);
  }

  public function index(){
    $menus = getModel('dataMenus', $this->menu_id);
    $data = $menus->selectWhere(['id' => $this->menu_id]);
    if (count($data) > 0){

      $this->data['id'] = $this->menu_id;
      $this->data['view_perfil'] = 'menu';
      $this->data['detalhes'] = 'submenus';
      if (!$this->submenus->doGravarAjax()){

        $this->addJS('submenus.js');
    
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/menu/submenus.php", 
          "./src/pages/usuario/layout/footer.php"
        ]);
      } else {
        $page404 = new page404();
        $page404->index();
      }
    }
  }

  public function get($id = ''){
    
    if (empty($id))
      echo json_encode(['data' => $this->submenus->selectAll()]);
    else {
      $this->submenus = getModel('dataSubmenus', $id);
      echo json_encode(['data' => $this->submenus->selectWhere(['menu_id' => $id])]);
    }
  }
}
