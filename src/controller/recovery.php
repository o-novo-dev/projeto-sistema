<?php 
require_once("./src/base/controller.php");

class recovery extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->view("./src/pages/recovery/index.php");
  }
}