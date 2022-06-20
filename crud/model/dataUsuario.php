<?php
require_once("./base/model.php");

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
        if($this->inserirUsuario($arrPost)){
          $data = $this->selectByEmail($arrPost['email'])[0];
          $_SESSION['usuario'] = $data;
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
        setflashdata(indicator("Este e-mail não existe. ", "warning"));
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

  public function doUpdatePerfil($arrPost){
    if(!isset($arrPost['nome'])){
      setflashdata(indicator("Por favor, Preencher o campo Nome", "danger"));
    } else if(!isset($arrPost['cpf_cnpj'])){
      setflashdata(indicator("Por favor, Preencher o campo CPF ou CNPJ", "danger"));
    } else {
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

  private function inserirUsuario($arr){
    $arr['senha'] = md5($arr['senha']);
    return $this->insert('insert into usuario (id, nome, email, senha, tipo) values (null, :nome, :email, :senha, :tipo)', $arr);
  }

  private function selectByEmail($email){
    return $this->select('select id, nome, email, tipo, senha, avatar, cpf_cnpj, ativo, telefone, empresa_id from usuario where email = :email', ['email' => $email]);
  }
}