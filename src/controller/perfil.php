<?php
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class perfil extends controller {

  function __construct() {

    if (!isset($_SESSION['usuario'])) redirect('/login');
    parent::__construct();
  }

  public function index(){
    $this->usuario = getModel('dataUsuario');
    $this->data['view_perfil'] = 'perfil';
    $this->data['detalhes'] = '';

    if($_POST){
      $this->usuario->doUpdatePerfil($_POST);
    }
    $this->viewLogado([
      "./src/pages/usuario/layout/header.php", 
      "./src/pages/usuario/layout/menu.php", 
      "./src/pages/usuario/perfil/perfil.php", 
      "./src/pages/usuario/layout/footer.php"
    ]);
  }

  public function get($id = ''){
  }
}