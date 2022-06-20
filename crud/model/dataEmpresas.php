<?php

require_once("./base/model.php");

class dataEmpresas extends model {

  function  __construct() {
    $this->table = 'empresas';
    $this->pk = "id";
    parent::__construct();
    
    $this->atividades = getModel("dataAtividades");
    $this->usuario = getModel("dataUsuario");
    $data = $this->atividades->selectAll();
    
    /*$pago = [
      (object)["id" => "Sim", "nome" => "Sim"],
      (object)["id" => "Não", "nome" => "Não"],
    ];
    $this->inputs['pago']['label'] = 'Pago';
    $this->inputs['pago']['select'] = $pago; */

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;
    
    $this->inputs['atividade_id']['label'] = 'Atividade';
    $this->inputs['atividade_id']['select'] = $data;
    $this->inputs['atividade_id']['order'] = 1;
    
    $this->inputs['razao_social']['label'] = 'Razão social';
    $this->inputs['razao_social']['order'] = 2;
    
    $this->inputs['nome_fantasia']['label'] = 'Nome Fantasia';
    $this->inputs['nome_fantasia']['order'] = 3;

    $this->inputs['cep']['label'] = 'CEP';
    $this->inputs['cep']['col'] = '3';
    $this->inputs['cep']['required'] = false;
    $this->inputs['cep']['order'] = 4;

    $this->inputs['endereco']['label'] = 'Endereço';
    $this->inputs['endereco']['col'] = '6';
    $this->inputs['endereco']['order'] = 5;

    $this->inputs['numero']['label'] = 'Número';
    $this->inputs['numero']['col'] = '3';
    $this->inputs['numero']['order'] = 6;

    $this->inputs['bairro']['label'] = 'Bairro';
    $this->inputs['bairro']['col'] = '6';
    $this->inputs['bairro']['order'] = 7;

    $this->inputs['complemento']['label'] = 'Complemento';
    $this->inputs['complemento']['required'] = false;
    $this->inputs['complemento']['col'] = '6';
    $this->inputs['complemento']['order'] = 8;

    $this->inputs['cidade']['label'] = 'Cidade';
    $this->inputs['cidade']['col'] = '6';
    $this->inputs['cidade']['order'] = 9;

    $this->inputs['uf']['label'] = 'Estado';
    $this->inputs['uf']['col'] = '3';
    $this->inputs['uf']['order'] = 10;

    $this->inputs['celular']['label'] = 'Celular';
    $this->inputs['celular']['col'] = '6';
    $this->inputs['celular']['order'] = 11;

    $this->inputs['dt_experiencia']['label'] = 'Data Experiência';
    $this->inputs['dt_experiencia']['type'] = 'date';
    $this->inputs['dt_experiencia']['col'] = '6';
    $this->inputs['dt_experiencia']['order'] = 12;
    
    $this->inputs['pago']['type'] = 'hidden';
    $this->inputs['pago']['value'] = 'Não';
    $this->inputs['pago']['order'] = 13;

    $this->inputs['ativo']['order'] = 14;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->ordernar();
  }

  protected function validate(){
    if((!isset($_POST['atividade_id'])) or (empty($_POST['atividade_id']))){
      setflashdata(indicator("Por favor, Preencher o campo Atividade", "danger"));
    } else if((!isset($_POST['razao_social'])) or (empty($_POST['razao_social']))) { 
      setflashdata(indicator("Por favor, Preencher o campo Razão Social", "danger"));
    } else if((!isset($_POST['nome_fantasia'])) or (empty($_POST['nome_fantasia']))) {
      setflashdata(indicator("Por favor, Preencher o campo Nome Fantasia", "danger"));
    } else if((!isset($_POST['cep'])) or (empty($_POST['cep']))) {
      setflashdata(indicator("Por favor, Preencher o campo CEP", "danger"));
    } else if((!isset($_POST['endereco'])) or (empty($_POST['endereco']))) {
      setflashdata(indicator("Por favor, Preencher o campo Endereço", "danger"));
    } else if((!isset($_POST['numero'])) or (empty($_POST['numero']))) {
      setflashdata(indicator("Por favor, Preencher o campo Número", "danger"));
    } else if((!isset($_POST['bairro'])) or (empty($_POST['bairro']))) {
      setflashdata(indicator("Por favor, Preencher o campo Bairro", "danger"));
    } else if((!isset($_POST['cidade'])) or (empty($_POST['cidade']))) {
      setflashdata(indicator("Por favor, Preencher o campo Cidade", "danger"));
    } else if((!isset($_POST['celular'])) or (empty($_POST['celular']))) {
      setflashdata(indicator("Por favor, Preencher o campo Celular", "danger"));
    } else if((!isset($_POST['dt_experiencia'])) or (empty($_POST['dt_experiencia']))) {
      setflashdata(indicator("Por favor, Preencher o campo Data Experiência", "danger"));
    } else {
      return true;
    }
    return false;
  }

  public function doGravar(){
    if($_POST){
      if ($this->validate($_POST)) {
        if(empty($_POST['id'])){
          $_POST['id'] = null;
          $empresa_id = $this->inserir($_POST);
          if(!$empresa_id){
            setflashdata(indicator("Falha ao inserir o registro no cadastro de Empresa.", "danger"));
          } else {
            $_SESSION['usuario']->empresa_id = $empresa_id;
            $this->usuario->alterar(['empresa_id' => $empresa_id, 'id' => $_SESSION['usuario']->id]);
            setflashdata(indicator("Dados cadastrado com sucesso!", "success"));
          }
        } else{
          $this->alterar($_POST);
          setflashdata(indicator("Dados alterado com sucesso!", "success"));
        }

        redirect("/usuario/perfil/empresa");
      }
    }
  }

}