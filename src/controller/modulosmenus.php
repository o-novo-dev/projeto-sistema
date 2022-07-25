<?php
  require_once('./src/base/controller.php');
  require_once('./src/controller/page404.php');

  class modulosmenus extends controller {

    public $modulosmenus;

    function __construct() {
      if (!isset($_SESSION['usuario'])) redirect('/login');

      parent::__construct();
      $this->modulosmenus = getModel('dataModulosmenus');
    }

    public function index($id){

      $this->modulosmenus = getModel('dataModulosMenus', $id);
      $data = getModel('dataModulos')->selectWhere(['id' => $id]);
      $this->data['id'] = $id;
      $this->data['view_perfil'] = 'modulo';
      $this->data['detalhes'] = '';

      if (count($data) > 0){
        if (!$this->modulosmenus->doGravarAjax()){
          
          $this->addJS('modulosmenus.js');
          $this->viewLogado([
            "./src/pages/usuario/layout/header.php", 
            "./src/pages/usuario/modulo/menus.php", 
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
        echo json_encode(['data' => $this->modulosmenus->selectAll()]);
      else{
        $this->modulosmenus = getModel('dataModulosmenus', $id);
        echo json_encode(['data' => $this->modulosmenus->selectWhere(['modulo_id' => $id])]);
      }
    }
  }