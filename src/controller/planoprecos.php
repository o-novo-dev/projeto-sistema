
<?php 
require_once('./src/base/controller.php');
require_once('./src/controller/page404.php');

class planoprecos extends controller {

  public $planoprecos;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect('/login');
    
    parent::__construct();
    $this->planoprecos = getModel('dataPlanoPrecos');
  }

  public function index($id){
    $this->data['view_perfil'] = 'plano';
    $this->data['detalhes'] = 'precos';
    $this->data['id'] = $id;

    $this->planoprecos = getModel('dataPlanoPrecos', $id); //filho
    $data = $this->plano->selectWhere([
      ['key' => 'a.id', 'param' => 'id', 'valor' => $id]
    ]); //pai
    if (count($data) > 0){
      if (!$this->planoprecos->doGravarAjax()){

        $this->addJS('planoprecos.js');
    
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/plano/precos.php", 
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
      echo json_encode(['data' => $this->planoprecos->selectAll()]);
    else {
      $planoprecos = getModel('dataPlanoPrecos', $id);
      echo json_encode(['data' => $planoprecos->selectWhere(['plano_id' => $id])]);
    }
  }
}
