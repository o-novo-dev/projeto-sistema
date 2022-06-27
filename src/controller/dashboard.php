<?php 
require_once("./src/base/controller.php");

class dashboard extends controller {

  function __construct() {
    if (!isset($_SESSION['usuario'])) redirect("/login");
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->viewLogado("./src/pages/dashboard/index.php");
  }
}