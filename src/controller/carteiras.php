<?php
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class carteiras extends controller {

  public $carteiras;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');

    parent::__construct();
    $this->carteiras = getModel('dataCarteira');
  }

  public function index(){
    $this->data['view_perfil'] = 'perfil';
    $this->data['detalhes'] = 'carteiras';

    if (!$this->carteiras->doGravarAjax()){

      $this->addJS('carteiras.js');
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu.php", 
        "./src/pages/usuario/perfil/carteira.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->carteiras->selectByUsuario()]);
  }
}