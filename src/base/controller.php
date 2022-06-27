<?php
require_once("conectDB.php");
require_once("utils.php");

class controller extends conectDB {
    
    public $data;
    protected $arrJS;

    function __construct() {
      parent::__construct();
      $this->data['titulo'] = '';
      $this->arrJS = [];
    }

    protected function addJS($js){
      $this->arrJS[] = $js;
    }

    protected function view($views){
      extract($this->data);
      extract($_SESSION);
      include("./src/pages/layout/header.php");
      include($views);
      include("./src/pages/layout/footer.php");
    }

    protected function viewLogado($views){
      extract($this->data);
      extract($_SESSION);
      include("./src/pages/layout/header_logado.php");
      if (is_array($views)){
        foreach ($views as $key => $value) {
          include($value);
        }
      } else {
        include($views);
      }
      include("./src/pages/layout/footer_logado.php");
    }
}