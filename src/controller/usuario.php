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

  public function parceiro($detalhes = '', $id = ''){
    if(!in_array($_SESSION['usuario']->tipo,["Proprietário"])){
      redirect("/dashboard");
    }

    $this->data['id'] = $id;
    $this->data['view_perfil'] = 'parceiro';
    $this->data['detalhes'] = $detalhes;
    
    if ($detalhes == "usuarios"){
      $this->_parceiro();
    } else if ($detalhes == 'getParceiros'){
      echo json_encode(["data" => $this->parceiros->selectWhere(['empresa_id' => $id])]);
    }    
  }

  private function _parceiro(){
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

  public function perfil($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'perfil';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_perfil();
    } else if ($detalhes == 'enderecos'){
      $this->_enderecos();
    } else if ($detalhes == 'getEnderecos'){
      echo json_encode(["data" => $this->enderecos->selectByUsuario()]);
    } else if ($detalhes == 'getCarteira'){
      echo json_encode(["data" => $this->carteira->selectByUsuario()]);
    } else if ($detalhes == 'carteira'){
      $this->_carteira();
    } else if ($detalhes == 'senha'){
      $this->_senha();
    } else if ($detalhes == 'empresa'){
      $this->_empresa();
    } 
  }

  public function modulo($detalhes = '', $id = ''){
    $this->data['id'] = $id;
    $this->data['view_perfil'] = 'modulo';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_modulo();
    } else if ($detalhes == 'getModulos'){
      echo json_encode(["data" => $this->modulos->selectAll()]);
    } else if ($detalhes == 'menus'){
      $this->_moduloMenus($id);
    } else if ($detalhes == 'getMenus'){
      $this->modulosmenus = getModel('dataModulosMenus', $id);
      echo json_encode(["data" => $this->modulosmenus->selectWhere(['modulo_id' => $id])]);
    }
  }

  private function _moduloMenus($id){
    $this->modulosmenus = getModel('dataModulosMenus', $id);
    $data = $this->modulos->selectWhere(['id' => $id]);
    if (count($data) > 0){
      if (!$this->modulosmenus->doGravarAjax()){
        
        $this->addJS('modulosmenus.js');
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/modulo/menus.php", 
          "./src/pages/usuario/layout/footer.php"
        ]);
      }
    } else {
      $page404 = new page404();
      $page404->index();
    }
  }

  private function _modulo(){
    if (!$this->modulos->doGravarAjax()){
      
      $this->addJS('modulos.js');
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_modulo.php", 
        "./src/pages/usuario/modulo/modulo.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  public function menu($detalhes = '', $id = ''){
    $this->data['id'] = $id;
    $this->data['view_perfil'] = 'menu';
    $this->data['detalhes'] = $detalhes;
    if (empty($detalhes)){
      $this->_menus();
    } else if ($detalhes == 'getMenus'){
      echo json_encode(["data" => $this->menus->selectAll()]);
    } else if ($detalhes == 'submenus'){
      $this->_submenus($id);
    } else if ($detalhes == 'getSubmenus'){
      $this->submenus = getModel('dataSubmenus', $id);
      echo json_encode(["data" => $this->submenus->selectWhere(['menu_id' => $id])]);
    }
  }

  public function projeto($detalhes = '', $id = ''){
    $this->data['view_perfil'] = 'projeto';
    $this->data['detalhes'] = $detalhes;
    $this->data['id'] = $id;
    if (empty($detalhes)){
      $this->_projeto();
    } else if ($detalhes == 'getProjetos'){
      echo json_encode(["data" => $this->projetos->selectAll()]);
    } else if ($detalhes == 'page'){
      if(!in_array($_SESSION['usuario']->tipo,["Proprietário"])){
        redirect("/dashboard");
      }
      $this->_page($id);
    } else if ($detalhes == 'getPage'){
      if(!in_array($_SESSION['usuario']->tipo,["Proprietário"])){
        redirect("/dashboard");
      }
      $pages = getModel("dataPages", $id);
      echo json_encode(["data" => $pages->selectWhere(['projeto_id' => $id])]);
    }
  }

  private function _menus(){
    
    if (!$this->menus->doGravarAjax()){
      
      $this->addJS('menus.js');
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_menu.php", 
        "./src/pages/usuario/menu/menus.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _submenus($id){
    $this->submenus = getModel('dataSubmenus', $id);
    $data = $this->menus->selectWhere(['id' => $id]);
    if (count($data) > 0){
      if (!$this->submenus->doGravarAjax()){
        
        $this->addJS('submenus.js');
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/menu/submenus.php", 
          "./src/pages/usuario/layout/footer.php"
        ]);
      }
    } else {
      $page404 = new page404();
      $page404->index();
    }
  }

  private function _projeto(){
    if (!$this->projetos->doGravarAjax()){

      $this->addJS('projetos.js');
      $this->viewLogado([
        "./src/pages/usuario/layout/header.php", 
        "./src/pages/usuario/layout/menu_projeto.php", 
        "./src/pages/usuario/projeto/projeto.php", 
        "./src/pages/usuario/layout/footer.php"
      ]);
    }
  }

  private function _perfil(){
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

  private function _enderecos(){

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

  private function _carteira() {
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

  private function _senha() {
    
    $this->usuario->doTrocarSenha();
    

    $this->viewLogado([
      "./src/pages/usuario/layout/header.php", 
      "./src/pages/usuario/layout/menu.php", 
      "./src/pages/usuario/perfil/senha.php", 
      "./src/pages/usuario/layout/footer.php"
    ]);
  }

  private function _empresa() {

    $this->empresa->doGravar();
    
    $empresa = $this->empresa->selectByPk($_SESSION['usuario']->empresa_id);
    if(!empty($empresa)){
      $this->empresa->inputs['id']['value'] = $empresa[0]->id;
      $this->empresa->inputs['atividade_id']['value'] = $empresa[0]->atividade_id;
      $this->empresa->inputs['razao_social']['value'] = $empresa[0]->razao_social;
      $this->empresa->inputs['nome_fantasia']['value'] = $empresa[0]->nome_fantasia;
      $this->empresa->inputs['cep']['value'] = $empresa[0]->cep;
      $this->empresa->inputs['endereco']['value'] = $empresa[0]->endereco;
      $this->empresa->inputs['numero']['value'] = $empresa[0]->numero;
      $this->empresa->inputs['bairro']['value'] = $empresa[0]->bairro;
      $this->empresa->inputs['complemento']['value'] = $empresa[0]->complemento;
      $this->empresa->inputs['cidade']['value'] = $empresa[0]->cidade;
      $this->empresa->inputs['uf']['value'] = $empresa[0]->uf;
      $this->empresa->inputs['celular']['value'] = $empresa[0]->celular;
      $this->empresa->inputs['dt_experiencia']['value'] = $empresa[0]->dt_experiencia;
    }

    $this->viewLogado([
      "./src/pages/usuario/layout/header.php", 
      "./src/pages/usuario/layout/menu.php", 
      "./src/pages/usuario/perfil/empresa.php", 
      "./src/pages/usuario/layout/footer.php"
    ]);
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

  public function _page($id){
    $data = $this->projetos->selectWhere(['id' => $id]);
    if (count($data) > 0){
      $this->pages = getModel('dataPages', $id);
      if (!$this->pages->doGravarAjax()){
        
        $this->addJS('pages.js');
        $this->viewLogado([
          "./src/pages/usuario/layout/header.php", 
          "./src/pages/usuario/projeto/page.php", 
          "./src/pages/usuario/layout/footer.php"
        ]);
      }
    } else {
      $page404 = new page404();
      $page404->index();
    }   
  }
}