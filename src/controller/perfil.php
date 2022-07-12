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

  public function doTrocaSenha(){
    $this->data['view_perfil'] = 'perfil';
    $this->data['detalhes'] = 'senha';

    $this->usuario = getModel('dataUsuario');
    $this->usuario->doTrocarSenha();

    $this->viewLogado([
      "./src/pages/usuario/layout/header.php", 
      "./src/pages/usuario/layout/menu.php", 
      "./src/pages/usuario/perfil/senha.php", 
      "./src/pages/usuario/layout/footer.php"
    ]);
  }

  public function empresa(){
    $this->data['view_perfil'] = 'perfil';
    $this->data['detalhes'] = 'empresa';
    $this->empresa = getModel('dataEmpresas');

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

  public function get($id = ''){
  }
}