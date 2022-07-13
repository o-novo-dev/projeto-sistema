
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class planodetalhes extends controller {

  public $planodetalhes;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->planodetalhes = getModel('dataPlanoDetalhes');
  }

  public function index($id){
    $this->data['view_perfil'] = 'plano';
    $this->data['detalhes'] = 'detalhes';
    $this->data['id'] = $id;
    $this->planodetalhes = getModel('dataPlanoDetalhes', $id); //filho
    echo $id;
    $data = getModel('dataPlanos')->selectWhere([
      ['key' => 'a.id', 'param' => 'id', 'valor' => $id]
    ]);
    if (count($data) > 0){
      if (!$this->planodetalhes->doGravarAjax()){

        $this->addJS('planodetalhes.js');
    
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/plano/detalhes.php", 
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
      echo json_encode(['data' => $this->planodetalhes->selectAll()]);
    else {
      $planodetalhes = getModel('dataPlanoDetalhes', $id);
      echo json_encode(['data' => $planodetalhes->selectWhere(['plano_id' => $id])]);
    }
  }
}
