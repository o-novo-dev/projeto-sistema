<?php 
require_once("./base/controller.php");

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
      $this->usuario->doSignup($_POST);
    }
    
    $this->view("./pages/signup/index.php");
  }

  public function cadastrar(){
    
  }
}