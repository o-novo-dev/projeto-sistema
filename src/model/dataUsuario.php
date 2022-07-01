<?php
require_once("./src/base/model.php");

class dataUsuario extends model {

  function  __construct() {
    $this->field = [];
    $this->table = 'usuario';
    $this->pk = "id";
    $this->where = ['tipo'];

    parent::__construct();
  }

  protected function validate(){
    return true;
  }
  
  public function doSignup($arrPost){
    if(!isset($arrPost['nome'])){
      setflashdata(indicator("Por favor, Preencher o campo Nome", "danger"));
    } else if(!isset($arrPost['email'])){
      setflashdata(indicator("Por favor, Preencher o campo Email", "danger"));
    }  else if(!isset($arrPost['senha'])){
      setflashdata(indicator("Por favor, Preencher o campo Senha", "danger"));
    } else {
    
      $data = $this->selectByEmail($arrPost['email']);
      
      if ($data == null){
        $arrPost['projeto_id'] = $_SESSION['projeto']->id;
        $id = $this->inserirUsuario($arrPost);
        if($id){
          $data = $this->selectByEmail($arrPost['email'])[0];
          $_SESSION['usuario'] = $data;
          $this->doRegraEmpresa((array)$data);
          setflashdata(indicator("Cadastro realizado com sucesso!", "success"));
          redirect("/dashboard");
        } else {
          setflashdata(indicator("Falha ao realizar o cadatro", "danger"));
        }
      } else {
        setflashdata(indicator("Este e-mail já existe. ", "warning"));
      }

    }
  }

  public function doLogin($arrPost){
    if(!isset($arrPost['email'])){
      setflashdata(indicator("Por favor, Preencher o campo Email", "danger"));
    }  else if(!isset($arrPost['senha'])){
      setflashdata(indicator("Por favor, Preencher o campo Senha", "danger"));
    } else {

      $datas = $this->selectByEmail($arrPost['email']);

      if ($datas == null){
        setflashdata(indicator("Este e-mail não está cadastrado. ", "warning"));
      } else {
        if($datas[0]->projeto_id !== $_SESSION['projeto']->id){
          setflashdata(indicator("Este e-mail não está cadastrado. ", "warning"));
        } else {
          if($datas[0]->ativo == 'Não'){
            setflashdata(indicator("Conta desativa. Entre em contato com o administrador. ", "warning"));
          } else {
            if ($datas[0]->senha == md5($arrPost['senha'])){
              $datas[0]->senha = '';
              $_SESSION['usuario'] = $datas[0];
              setflashdata(indicator("Login realizado com sucesso! ", "success"));
              redirect("/dashboard");
            } else {
              setflashdata(indicator("Usuário ou senha estão incorretos. ", "danger"));
            }
          }
        }
      }
    }
  }

  public function doUpdatePerfil($arrPost){
    
    if(!isset($arrPost['nome'])){
      setflashdata(indicator("Por favor, Preencher o campo Nome", "danger"));
    } else if(!isset($arrPost['cpf_cnpj'])){
      setflashdata(indicator("Por favor, Preencher o campo CPF ou CNPJ", "danger"));
    } else {
      $file = upload('avatar', '/assets/images/avatars/');

      if ($file){
        if ($file['success']) {
          $arrPost['avatar'] = $file['filename'];
          if (!empty($_SESSION['usuario']->avatar)){
            deleteFile($_SESSION['usuario']->avatar, '/assets/images/avatars/');
          }
        } else {
          setflashdata(indicator($file['message'], "danger"));
          return;
        }
      }

      if($this->alterar($arrPost)){
        $datas = $this->selectByPk($arrPost[$this->pk]);
        $datas[0]->senha = '';
        $_SESSION['usuario'] = $datas[0];
        setflashdata(indicator("Alteração do cadastro foi alterado com sucesso", "success"));
      } else {
        setflashdata(indicator("Falha ao realizar a alteração. Tente novamente em instantes!", "danger"));
      }
    }
  }

  public function doTrocarSenha() {
    if($_POST){
      if(!isset($_POST['atual_senha'])){
        setflashdata(indicator("Por favor, Preencher o campo Atual Senha", "danger"));
      } else if(!isset($_POST['senha'])){
        setflashdata(indicator("Por favor, Preencher o campo Nova Senha", "danger"));
      } else {
        $datas = $this->selectByPk($_POST[$this->pk]);
        if ($datas[0]->senha == md5($_POST['atual_senha'])){
          $_POST['senha'] = md5($_POST['senha']);
          if($this->alterar($_POST)) {
            $datas[0]->senha = '';
            $_SESSION['usuario'] = $datas[0];
            setflashdata(indicator("Alteração da senha foi alterado com sucesso", "success"));
          } else {
            setflashdata(indicator("Falha ao realizar a alteração. Tente novamente em instantes!", "danger"));
          }
        } else {
          setflashdata(indicator("Senha atual está errada.", "danger"));
        }
      }
    }
  }

  private function doRegraEmpresa($data){
    $empresas = getModel("dataEmpresas");
    $id = $empresas->inserir([
      'id' => null,
      'atividade_id' => null,
      'razao_social' => null,
      'nome_fantasia' => null,
      'cep' => null,
      'endereco' => null,
      'numero' => null,
      'bairro' => null,
      'complemento' => null,
      'cidade' => null,
      'uf' => null,
      'celular' => null,
      'dt_experiencia' => null,
      'ativo' => "Sim"
    ]);

    if ($id){
      $data['empresa_id'] = $id;
    }

    $this->alterar($data);

   /* $contratos = getModel("dataContratos");
    $contratos->inserir([
      'id' => null,
      'ativo' => "Sim",
      "dt_contrato" => date("Y-m-d"),
      "plano_id" => "?",
      "empresa_id" => $id,
      "dt_fim" => date("Y-m-d", strtotime(date("Y-m-d", strtotime($StaringDate)) . " + 1 year"))
    ]) */
  }

  private function inserirUsuario($arr){
    $arr['senha'] = md5($arr['senha']);
    return $this->insert('insert into usuario (id, nome, email, senha, tipo, projeto_id) values (null, :nome, :email, :senha, :tipo, :projeto_id)', $arr);
  }

  private function selectByEmail($email){
    return $this->select('select id, nome, email, tipo, senha, avatar, cpf_cnpj, ativo, telefone, empresa_id, projeto_id from usuario where email = :email', ['email' => $email]);
  }
}