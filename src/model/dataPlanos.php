<?php
require_once("./src/base/model.php");

class dataPlanos extends model {

  function  __construct() {
    $this->table = 'dev_plano';
    $this->pk = "id";
    parent::__construct();

    $tipo = getModel('dataPlanoTipos');
    $projetos = getModel('dataProjetos');

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Plano";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['plano_tipo_id']['label'] = "Tipo do Plano";
    $this->inputs['plano_tipo_id']['select'] = $tipo->selectAll();
    $this->inputs['plano_tipo_id']['order'] = 2;
    $this->inputs['plano_tipo_id']['required'] = true;

    $this->inputs['projeto_id']['label'] = "Projeto";
    $this->inputs['projeto_id']['select'] = $projetos->selectAll();
    $this->inputs['projeto_id']['order'] = 3;
    $this->inputs['projeto_id']['required'] = true;

    $this->inputs['ativo']['order'] = 4;
    $this->inputs['ativo']['value'] = 'Sim';

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
        'message' => 'Por favor, Preencher o campo Plano!!',
      ];
    } else if((!isset($_POST['plano_tipo_id'])) or (empty($_POST['plano_tipo_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Tipo do Plano!',
      ];
    } else if((!isset($_POST['projeto_id'])) or (empty($_POST['projeto_id']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Projeto!',
      ];
    } else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }
  
  public function selectWhere($where = []){
    $sql = "SELECT a.id, a.nome, a.plano_tipo_id, a.projeto_id, a.ativo, b.nome as tipo, c.nome as projeto
              FROM dev_plano a
             INNER JOIN dev_plano_tipos b ON b.id = a.plano_tipo_id
             INNER JOIN dev_projetos c ON c.id = a.projeto_id
             WHERE a.ativo = 'Sim' ";
    $andWhere = [];
    foreach ($where as $key => $value) {
      $sql .= " AND {$value['key']} = :{$value['param']} ";
      $andWhere = [$value['param'] => $value['valor']];
    }
    
    return $this->select($sql, $andWhere);
  }
}