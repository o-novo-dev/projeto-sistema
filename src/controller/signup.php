<?php 
require_once("./src/base/controller.php");

class signup extends controller {

  private $usuario;

  function __construct() {
    if (isset($_SESSION['usuario'])) redirect("/dashboard");
    parent::__construct();
    $this->usuario = getModel('dataUsuario');
  }

  public function index(){
    $this->data['titulo'] = "Principal";

    if ($_POST){
      $this->usuario->doSignup([
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => $_POST['senha'],
        'tipo' => $_POST['tipo']
      ]);

      //getModel('dataContrato')->inserir();
    }
    
    $this->data['planos'] = getModel('dataPlanos')->selectWhere();
    
    $this->view("./src/pages/signup/index.php");
  }

  public function cadastrar(){
    
  }
}