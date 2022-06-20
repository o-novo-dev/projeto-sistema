<?php 
require_once("./base/controller.php");

class page404 extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->view("./pages/page404/index.php");
  }
}