<?php
require_once("./base/model.php");

class dataEnderecos extends model {

  function  __construct() {
    $this->table = 'enderecos';
    $this->pk = "id";
    parent::__construct();
    $principal = [
      (object)["id" => "Sim", "nome" => "Sim"],
      (object)["id" => "Não", "nome" => "Não"],
    ];

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['nome']['order'] = 1;
    $this->inputs['nome']['required'] = true;

    $this->inputs['cep']['label'] = "CEP";
    $this->inputs['cep']['order'] = 2;
    $this->inputs['cep']['col'] = '3';
    $this->inputs['cep']['required'] = true;

    $this->inputs['rua']['label'] = "Rua";
    $this->inputs['rua']['order'] = 3;
    $this->inputs['rua']['col'] = '6';
    $this->inputs['rua']['required'] = true;

    $this->inputs['numero']['label'] = "Número";
    $this->inputs['numero']['order'] = 4;
    $this->inputs['numero']['col'] = '3';
    $this->inputs['numero']['required'] = true;

    $this->inputs['bairro']['label'] = "Bairro";
    $this->inputs['bairro']['order'] = 5;
    $this->inputs['bairro']['col'] = '7';
    $this->inputs['bairro']['required'] = false;

    $this->inputs['complemento']['label'] = "Complemento";
    $this->inputs['complemento']['order'] = 6;
    $this->inputs['complemento']['col'] = '5';
    $this->inputs['complemento']['required'] = false;

    $this->inputs['estado']['label'] = "UF";
    $this->inputs['estado']['order'] = 7;
    $this->inputs['estado']['col'] = '2';
    $this->inputs['estado']['required'] = true;

    $this->inputs['cidade']['label'] = "Cidade";
    $this->inputs['cidade']['order'] = 8;
    $this->inputs['cidade']['col'] = '10';
    $this->inputs['cidade']['required'] = true;

    $this->inputs['telefone']['label'] = "Telefone";
    $this->inputs['telefone']['order'] = 9;
    $this->inputs['telefone']['col'] = '12';
    $this->inputs['telefone']['required'] = true;

    $this->inputs['principal']['label'] = "Endereço Principal";
    $this->inputs['principal']['select'] = $principal;
    $this->inputs['principal']['order'] = 10;
    $this->inputs['principal']['col'] = '12';
    $this->inputs['principal']['required'] = true;

    $this->inputs['usuario_id']['label'] = "Usuario";
    $this->inputs['usuario_id']['order'] = 11;
    $this->inputs['usuario_id']['type'] = 'hidden';
    $this->inputs['usuario_id']['value'] = $_SESSION['usuario']->id;
    $this->inputs['usuario_id']['required'] = true;
    
    $this->inputs['ativo']['order'] = 12;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();

    $this->afterUpdate = function($id) {
      if($_POST['principal'] == 'Sim'){
        $this->update("UPDATE enderecos SET principal = 'Não' WHERE usuario_id = {$_SESSION['usuario']->id} AND id NOT IN ({$id})");
      }
    };
  }

  protected function validate(){
    return true;
  }
}