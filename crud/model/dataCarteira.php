<?php
require_once("./base/model.php");

class dataCarteira extends model {

  function  __construct() {
    $this->table = 'cartoes';
    $this->pk = "id";
    parent::__construct();
    $tipo = [
      (object)["id" => "Cartão de Crédito", "nome" => "Cartão de Crédito"],
      (object)["id" => "Cartão de Débito", "nome" => "Cartão de Débito"],
    ];

    $bandeira = [
      (object)["id" => "Visa", "nome" => "Visa"],
      (object)["id" => "Master Card", "nome" => "Master Card"],
      (object)["id" => "Elo", "nome" => "Elo"],
      (object)["id" => "American Express", "nome" => "American Express"],
    ];

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['tipo']['label'] = "Débito/Crédito";
    $this->inputs['tipo']['select'] = $tipo;
    $this->inputs['tipo']['order'] = 1;
    $this->inputs['tipo']['col'] = '12';
    $this->inputs['tipo']['required'] = true;

    $this->inputs['numero']['label'] = "Número do Cartão";
    $this->inputs['numero']['order'] = 2;
    $this->inputs['numero']['col'] = '6';
    $this->inputs['numero']['required'] = true;

    $this->inputs['nome']['label'] = "Nome no Cartão";
    $this->inputs['nome']['order'] = 3;
    $this->inputs['nome']['col'] = '6';
    $this->inputs['nome']['required'] = true;
    
    $this->inputs['dt_expiracao']['label'] = 'Data de Expiração';
    $this->inputs['dt_expiracao']['order'] = 4;
    $this->inputs['dt_expiracao']['type'] = 'date';
    $this->inputs['dt_expiracao']['col'] = '6';

    $this->inputs['cvv']['label'] = "Código de Segurança (CVV)";
    $this->inputs['cvv']['order'] = 5;
    $this->inputs['cvv']['col'] = '3';
    $this->inputs['cvv']['required'] = true;

    $this->inputs['bandeira']['label'] = "Bandeira";
    $this->inputs['bandeira']['select'] = $bandeira;
    $this->inputs['bandeira']['order'] = 6;
    $this->inputs['bandeira']['col'] = '6';
    $this->inputs['bandeira']['required'] = true;

    $this->inputs['usuario_id']['label'] = "Usuario";
    $this->inputs['usuario_id']['order'] = 7;
    $this->inputs['usuario_id']['type'] = 'hidden';
    $this->inputs['usuario_id']['value'] = $_SESSION['usuario']->id;
    $this->inputs['usuario_id']['required'] = true;
    
    $this->inputs['ativo']['order'] = 8;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();
  }

  protected function validate(){
    $arrMessage = [];
    if((!isset($_POST['numero'])) or (empty($_POST['numero']))) {
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Número do Cartão!',
      ];
    } else if((!isset($_POST['nome'])) or (empty($_POST['nome']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Nome no Cartão!',
      ];
    } else if((!isset($_POST['tipo'])) or (empty($_POST['tipo']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Tipo do Cartão!',
      ];
    } else if((!isset($_POST['dt_expiracao'])) or (empty($_POST['dt_expiracao']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Data de Expiração!',
      ];
    } else if((!isset($_POST['cvv'])) or (empty($_POST['cvv']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Código de Segurança!',
      ];
    } else if((!isset($_POST['bandeira'])) or (empty($_POST['bandeira']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Bandeira do Cartão!',
      ];
    } else if(!is_numeric($_POST['numero'])){
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Número do Cartão com somente número!',
      ];
    } else if(!is_numeric($_POST['cvv'])){
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Código de Segurança com somente número!',
      ];
    } else if(strlen($_POST['numero']) !== 16){
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, O campo Número do Cartão deve ter o tamanho maximo de 16!',
      ];
    } else if(strlen($_POST['cvv']) !== 3){
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, O campo Código de Segurança cdeve ter o tamanho maximo de 3!',
      ];
    }  else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }
}