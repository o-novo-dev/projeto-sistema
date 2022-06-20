<?php 
require_once("./base/controller.php");

class recovery extends controller {

  function __construct() {
    parent::__construct();
  }

  public function index(){
    $this->data['titulo'] = "Principal";
    $this->view("./pages/recovery/index.php");
  }
}