<?php 
require_once("./src/base/controller.php");
require_once("./src/controller/page404.php");

class usuario extends controller {

  public $usuario;
  public $empresa;
  public $enderecos;
  public $carteira;
  public $modulos;
  public $menus;
  public $submenus;
  public $projeto;
  public $plano;
  public $parceiros;

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect("/login");
    parent::__construct();
    $this->usuario = getModel('dataUsuario');
    $this->empresa = getModel('dataEmpresas');
    $this->enderecos = getModel('dataEnderecos');
    $this->carteira = getModel('dataCarteira');
    $this->modulos = getModel('dataModulos');
    $this->menus = getModel('dataMenus');
    $this->projetos = getModel('dataProjetos');
    $this->planotipos = getModel('dataPlanoTipos');
    $this->plano = getModel('dataPlano');
    $this->parceiros = getModel('dataParceiros', $_SESSION['usuario']->empresa_id);
    $this->data['titulo'] = "Usuário";
  }

  public function index(){
    $this->addJS('usuario.js');
    $this->viewLogado("./src/pages/usuario/index.php");
  }

  public function logout(){
    session_destroy();
    redirect("");
  }

  public function parceiro($detalhes = '', $id = ''){
    $parceiros = getController('parceiros');
    $parceiros->index($id);
  }

  public function overview(){
    if(!in_array($_SESSION['usuario']->tipo,["Proprietário"])){
      redirect("/dashboard");
    }

    $this->data['view_perfil'] = 'overview';

    $this->viewLogado([
      "./src/pages/usuario/layout/header.php", 
      "./src/pages/usuario/perfil/overview.php", 
      "./src/pages/usuario/layout/footer.php"
    ]);
  }

  public function perfil($detalhes = '', $id = ''){
    if (empty($detalhes)){
      getController('perfil')->index();
    } else if ($detalhes == 'enderecos'){
      getController('enderecos')->index();
    } else if ($detalhes == 'carteira'){
      getController('carteira')->index();
    } else if ($detalhes == 'senha'){
      getController('perfil')->doTrocaSenha();
    } else if ($detalhes == 'empresa'){
      getController('perfil')->empresaa();
    } 
  }

  public function modulo($detalhes = '', $id = ''){
    if (empty($detalhes)){
      getController('modulos')->index();
    } else if ($detalhes == 'menus'){
      getController('modulosmenus')->index($id);
    }
  }

  public function menu($detalhes = '', $id = ''){
    $this->data['id'] = $id;
    $this->data['view_perfil'] = 'menu';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      getController('menus')->index();
    } else if ($detalhes == 'submenus'){
      getController('submenus', $id)->index();
    }
  }

  public function projetos($detalhes = '', $id = ''){
    if (empty($detalhes)){
      getController('projetos')->index();
    } else if ($detalhes == 'page'){
      getController('pages')->index($id);
    }
  }


  public function plano($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'plano';
    $this->data['detalhes'] = $detalhes;
    $this->data['id'] = $id;
    if (empty($detalhes)){
      $this->_plano();
    } else if ($detalhes == 'tipos'){
      $this->_tipos();
    } else if ($detalhes == 'precos'){
      $this->_planopreco($id);
    } else if ($detalhes == 'detalhes'){
      $this->_planodetalhes($id);
    } else if ($detalhes == 'getPlanoTipos'){
      echo json_encode(["data" => $this->planotipos->selectAll()]);
    } else if ($detalhes == 'getPlano'){
      echo json_encode(["data" => $this->plano->selectWhere()]);
    } else if ($detalhes == 'getPlanoDetalhes'){
      $planodetalhes = getModel('dataPlanoDetalhes', $id);
      echo json_encode(["data" => $planodetalhes->selectWhere(['plano_id' => $id])]);
    } else if ($detalhes == 'getPlanoPrecos'){
      $planoprecos = getModel('dataPlanoPrecos', $id);
      echo json_encode(["data" => $planoprecos->selectWhere(['plano_id' => $id])]);
    }
  }

  private function _planopreco($id){
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

  private function _planodetalhes($id){
    $this->planodetalhes = getModel('dataPlanoDetalhes', $id); //filho
    $data = $this->plano->selectWhere([
      ['key' => 'a.id', 'param' => 'id', 'valor' => $id]
    ]); //pai
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

  private function _tipos(){
    if (!$this->planotipos->doGravarAjax()){
      
      $this->addJS('planotipos.js');
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_plano.php", 
        "./src/pages/usuario/plano/tipo.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _plano(){
    if (!$this->plano->doGravarAjax()){
      
      $this->addJS('plano.js');
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_plano.php", 
        "./src/pages/usuario/plano/plano.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }


}