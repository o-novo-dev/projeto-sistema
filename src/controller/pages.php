
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class pages extends controller {

  public $pages;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    if(!in_array($_SESSION['usuario']->tipo,["Proprietário"])){
      redirect("/dashboard");
    }

    parent::__construct();
    $this->pages = getModel('dataPages');
  }

  public function index($id){
    if (!$this->pages->doGravarAjax()){

      $this->data['view_perfil'] = 'projeto';
      $this->data['detalhes'] = 'page';
      $this->data['id'] = $id;

      $this->addJS('pages.js');
  
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/projeto/page.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }  
  }

  public function get($id = ''){
    if (empty($id))
      echo json_encode(['data' => $this->pages->selectAll()]);
    else {
      $this->pages = getModel("dataPages", $id);
      echo json_encode(['data' => $this->pages->selectWhere()]);
    }
  }
}
