<?php 
require_once("./src/base/controller.php");
require_once("./src/controller/page404.php");

class usuario extends controller {

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect("/login");
    parent::__construct();

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
    getController('parceiros')->index($id);
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
    } else if ($detalhes == 'carteiras'){
      getController('carteiras')->index();
    } else if ($detalhes == 'senha'){
      getController('perfil')->doTrocaSenha();
    } else if ($detalhes == 'empresa'){
      getController('perfil')->empresa();
    } else if ($detalhes == 'contratos'){
      getController('contratos')->index();
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
    if (empty($detalhes)){
      getController('menus')->index();
    } else if ($detalhes == 'submenus'){
      getController('submenus')->index($id);
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
    if (empty($detalhes)){
      getController('planos')->index();
    } else if ($detalhes == 'tipos'){
      getController('planotipos')->index();
    } else if ($detalhes == 'precos'){
      getController('planoprecos')->index($id);
    } else if ($detalhes == 'detalhes'){
      getController('planodetalhes')->index($id);
    }
  }
}