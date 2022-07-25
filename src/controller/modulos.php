<?php
  require_once('./src/base/controller.php');
  require_once('./src/controller/page404.php');

  class modulos extends controller {

    public $modulos;

    function __construct() {
      if (!isset($_SESSION['usuario'])) redirect('/login');

      parent::__construct();
      $this->modulos = getModel('dataModulos');
    }

    public function index(){
      if (!$this->modulos->doGravarAjax()){
        $this->data['view_perfil'] = 'modulo';
        $this->data['detalhes'] = '';

        $this->addJS('modulos.js');
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/layout/menu_modulo.php", 
          "./src/pages/usuario/modulo/modulo.php", 
          "./src/pages/usuario/layout/footer.php"
        ]);
      }
    }



    public function get($id = ''){
      if (empty($id))
        echo json_encode(['data' => $this->modulos->selectAll()]);
      else
        echo json_encode(['data' => $this->modulos->selectWhere(['id' => $id])]);
    }
  }