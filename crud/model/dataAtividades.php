<?php
require_once("./base/model.php");

class dataAtividades extends model {

  function  __construct() {
    $this->table = 'atividades';
    $this->pk = "id";
    parent::__construct();
  }

  protected function validate(){
    return true;
  }
}