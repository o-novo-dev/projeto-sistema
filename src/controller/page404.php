<?php 
require_once("./src/base/controller.php");

class page404 extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->view("./src/pages/page404/index.php");
  }
}