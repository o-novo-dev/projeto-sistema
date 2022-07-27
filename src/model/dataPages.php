<?php
require_once("./src/base/model.php");

class dataPages extends model {

  function  __construct() {
    $this->table = 'dev_pages';
    $this->pk = "id";
    parent::__construct();

    $tipo = [
      (object)["id" => "main", "nome" => "main"],
      (object)["id" => "header", "nome" => "header"],
      (object)["id" => "footer", "nome" => "footer"],
      (object)["id" => "contato", "nome" => "contato"],
      (object)["id" => "sobre", "nome" => "sobre"],
      (object)["id" => "serviço", "nome" => "serviço"],
      (object)["id" => "plano", "nome" => "plano"]
    ];

    $this->inputs['id']['label'] = 'Identificador';
    $this->inputs['id']['order'] = 0;

    $this->inputs['ativo']['order'] = 1;
    $this->inputs['ativo']['value'] = 'Sim';

    $this->inputs['tipo']['label'] = "Sessão";
    $this->inputs['tipo']['select'] = $tipo;
    $this->inputs['tipo']['order'] = 2;

    $this->inputs['param']['label'] = "Parametro";
    $this->inputs['param']['order'] = 3;

    $this->inputs['value']['label'] = "Valor";
    $this->inputs['value']['order'] = 4;

    $this->inputs['valueImg']['label'] = "Imagem";
    $this->inputs['valueImg']['order'] = 5;
    $this->inputs['valueImg']['type'] = 'file';

    $this->inputs['nome']['label'] = "Nome";
    $this->inputs['nome']['order'] = 7;
    $this->inputs['nome']['type'] = 'hidden';
    /**
     * A função ordernar caso tenho configurado sua ordenação
     */
    $this->ordernar();

    $this->beforeInsert = function($data) {
      if ($_FILES){
        $result = upload('valueImg', '/assets/images/pages/');
    
        if($result){
          if ($result['success']){
            $filename = $result['filename'];
            $_POST['valueImg'] = $filename;
          } else {
            echo json_encode([
              'status' => 'false', 
              'title' => 'Falhou',
              'message' => $result['message'],
            ]);
            exit;
          }
        }
      }
    };

    $this->beforeUpdate = function($data) {
      if ($_FILES){
        $result = upload('valueImg', '/assets/images/pages/');
    
        if($result){
          if ($result['success']){
            $filename = $result['filename'];
            $_POST['valueImg'] = $filename;
            $qdata = $this->selectWhere(['id' => $data['id']]);
            if ($qdata){
              if (!empty($qdata[0]->valueImg)){
                deleteFile($qdata[0]->valueImg, '/assets/images/pages/');
              }
            }
          } else {
            echo json_encode([
              'status' => 'false', 
              'title' => 'Falhou',
              'message' => $result['message'],
            ]);
            exit;
          }
        }
      }
    };
  }

  protected function validate(){
    $arrMessage = [];
    if((!isset($_POST['tipo'])) or (empty($_POST['tipo']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Sessão!',
      ];
    } else if((!isset($_POST['param'])) or (empty($_POST['param']))) { 
      $arrMessage = [
        'status' => 'false', 
        'title' => 'Falhou',
        'message' => 'Por favor, Preencher o campo Parametro!',
      ];
    } else {
      return true;
    }
    echo json_encode($arrMessage);
    return false;
  }
}