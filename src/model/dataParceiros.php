<?php
require_once("./src/base/model.php");

class dataParceiros extends model {

  function  __construct($id = '') {
    $this->table = 'usuario';
    $this->pk = "id";
    parent::__construct();

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;

    $this->inputs['email']['label'] = "E-mail";
    $this->inputs['email']['order'] = 2;
    $this->inputs['email']['type'] = 'email';

    $this->inputs['senha']['label'] = "Senha";
    $this->inputs['senha']['order'] = 3;
    $this->inputs['senha']['type'] = 'password';

    $this->inputs['tipo']['order'] = 4;
    $this->inputs['tipo']['value'] = 'Parceiro';
    $this->inputs['tipo']['type'] = 'hidden';

    $this->inputs['avatar']['order'] = 5;
    $this->inputs['avatar']['type'] = 'hidden';
    
    $this->inputs['cpf_cnpj']['order'] = 6;
    $this->inputs['cpf_cnpj']['type'] = 'hidden';

    $this->inputs['telefone']['order'] = 7;
    $this->inputs['telefone']['type'] = 'hidden';

    $this->inputs['ativo']['order'] = 8;
    $this->inputs['ativo']['value'] = 'Sim';
    $this->inputs['ativo']['type'] = 'hidden';

    $this->inputs['projeto_id']['order'] = 9;
    $this->inputs['projeto_id']['type'] = 'hidden';
    $this->inputs['projeto_id']['value'] = $_SESSION['projeto']->id;

    $this->inputs['empresa_id']['label'] = "Empresa";
    $this->inputs['empresa_id']['value'] = $id;
    $this->inputs['empresa_id']['order'] = 10;
    $this->inputs['empresa_id']['type'] = 'hidden';
    $this->inputs['empresa_id']['required'] = true;

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
        'message' => 'Por favor, Preencher o campo Nome!',
      ];
    } else if((!isset($_POST['email'])) or (empty($_POST['email']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo E-mail!',
      ];
    } else if((!isset($_POST['senha'])) or (empty($_POST['senha']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Senha!',
      ];
    } else {
      $_POST['senha'] = md5($_POST['senha']);
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }

  /**
   * quando necessário
   */

  public function selectWhere($where = []){
    $sql = "SELECT id, nome, email, tipo, empresa_id, projeto_id FROM usuario where ativo = 'Sim' and tipo = 'Parceiro' ";
    foreach ($where as $key => $value) {
      $sql .= " and {$key} = :{$key} ";
    }
    return $this->select($sql, $where);
  }
}

