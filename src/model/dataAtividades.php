<?php
require_once("./src/base/model.php");

class dataAtividades extends model {

  function  __construct() {
    $this->table = 'cad_atividades';
    $this->pk = "id";
    parent::__construct();
  }

  protected function validate(){
    return true;
  }
}