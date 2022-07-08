<?php
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class parceiros extends controller {

  public $parceiros;


  function __construct() {

    if (!isset($_SESSION['usuario'])) redirect('/login');
    parent::__construct();
    $this->parceiros = getModel('dataParceiros', $_SESSION['usuario']->empresa_id);
  }


  public function index($id = ''){

    $this->data['id'] = $id;
    $this->data['view_perfil'] = 'parceiro';
    $this->data['detalhes'] = 'usuarios';

    if(!in_array($_SESSION['usuario']->tipo,["Proprietário"])){
      redirect("/dashboard");
    }

    if (!$this->parceiros->doGravarAjax()){

      $this->addJS('parceiros.js');

      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_parceiro.php", 
        "./src/pages/usuario/perfil/parceiro.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->parceiros->selectAll()]);
    else
      echo json_encode(['data' => $this->parceiros->selectWhere(['empresa_id' => $id])]);
  }
}