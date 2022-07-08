<?php
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class carteira extends controller {

  public $carteira;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');

    parent::__construct();
    $this->carteira = getModel('dataCarteira');
  }

  public function index(){

    if (!$this->carteira->doGravarAjax()){

      $this->addJS('carteira.js');
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
      echo json_encode(['data' => $this->carteira->selectByUsuario()]);
  }
}