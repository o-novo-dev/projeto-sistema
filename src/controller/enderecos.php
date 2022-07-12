<?php
  require_once('./src/base/controller.php');
  require_once('./src/controller/page404.php');

  class enderecos extends controller {

    public $enderecos;

    function __construct() {
      if (!isset($_SESSION['usuario'])) redirect('/login');
      
      parent::__construct();
      $this->enderecos = getModel('dataEnderecos');
    }

    public function index(){
      $this->data['view_perfil'] = 'perfil';
      $this->data['detalhes'] = 'enderecos';

      if (!$this->enderecos->doGravarAjax()){

        $this->addJS('enderecos.js');

        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/layout/menu.php", 
          "./src/pages/usuario/perfil/enderecos.php", 
          "./src/pages/usuario/layout/footer.php"
        ]);
      }
    }

    public function get($id = ''){
      if (empty($id))
        echo json_encode(['data' => $this->enderecos->selectByUsuario()]);
    }
  }