<?php
require_once("./src/base/model.php");

class dataPlanoPrecos extends model {

  function  __construct($id = '') {
    $this->table = 'dev_plano_precos';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['preco']['label'] = "Preço";
    $this->inputs['preco']['order'] = 2;
    $this->inputs['preco']['required'] = true;

    $this->inputs['ativo']['order'] = 3;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->inputs['plano_id']['label'] = "Plano";
    $this->inputs['plano_id']['value'] = $id;
    $this->inputs['plano_id']['order'] = 4;
    $this->inputs['plano_id']['type'] = 'hidden';
    $this->inputs['plano_id']['col'] = '6';
    $this->inputs['plano_id']['required'] = true;

    /**
     * A função ordernar caso tenho configurado sua ordenação
     */
    $this->ordernar();

  }

  protected function validate(){
    $arrMessage = [];
    if((!isset($_POST['nome'])) or (empty($_POST['nome']))) {
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Detalhe do Plano!',
      ];
    } else if((!isset($_POST['plano_id'])) or (empty($_POST['plano_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Plano!',
      ];
    } else if((!isset($_POST['preco'])) or (empty($_POST['preco']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Preço!',
      ];
    } else {
      $_POST['preco'] = str_replace(',','.',$_POST['preco']);
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }

  public function selectWhere($where = []){
    $sql = "SELECT a.id, a.nome, a.ativo, a.preco, a.plano_id, b.nome as plano
              FROM dev_plano_precos a
             INNER JOIN dev_plano b ON a.plano_id = b.id
             WHERE a.ativo = 'Sim' ";
    foreach ($where as $key => $value) {
      $sql .= " and {$key} = :{$key} ";
    }
    return $this->select($sql, $where);
  }
}