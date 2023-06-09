<?php

require_once "models/Conexao.class.php";
require_once "models/Usuario.class.php";
require_once "models/UsuarioDAO.class.php";

if(!isset($_SESSION))
	session_start();

class usuarioController
{
    private $parm;
	public function __construct()
	{
		$this->parm = Conexao::getInstancia();
	}
    public function inserir()
    {
        $msg = array("", "", "", "");
        $erro = false;

        if($_POST)
        {
            //verificação do preenchimento
            if(empty($_POST["nome"]))
            {
                $msg[0] = "Preencha o seu nome!";
                $erro = true;
            }
            if(empty($_POST["email"]))
            {
                $msg[1] = "Preencha o seu email!";
                $erro = true;
            }
            if(empty($_POST["senha"]))
            {
                $msg[2] = "Preencha sua senha!";
                $erro = true;
            }
            if(empty($_POST["confsenha"]))
            {
                $msg[3] = "Preencha a confirmação da senha!";
                $erro = true;
            }

            if(!empty($_POST["senha"]) && !empty($_POST["confsenha"]))
            {
                if($_POST["senha"] != $_POST["confsenha"])
                {
                    $msg[2] = "Senhas não conferem!";
                    $erro = true;
                
                }
            }
            if(!empty($_POST["email"]))
            {
                $usuario = new usuario(email:$_POST["email"]);
                $usuarioDAO = new usuarioDAO($this->parm);
                $retorno = $usuarioDAO->verificar_por_email($usuario);
                if(count($retorno) > 0)
                {
                    $msg[1] = "Email já cadastrado!";
                    $erro = true;
                }

            }
            //se tudo certo
            if(!$erro)
            {
                //inserir no BD
                $usuario = new usuario(0, $_POST["nome"], $_POST["email"], md5($_POST["senha"]), "Cliente");
                $usuarioDAO = new usuarioDAO($this->parm);
                $usuarioDAO->inserir($usuario);

                 //mostrar login
                 header("location:index.php?controle=usuarioController&metodo=login");

            }
           
        }
        require_once "views/form_usuario.php";       
    
    }

    public function login()
    {

        $msg = "";
        if($_POST)
        {
                    
            //verificar preenchimento
            if($_POST["email"] == "" || $_POST["senha"] == "")
            {
                $msg ="Dados Obrigatórios";
            }
            
            
            //se não tiver erro 
        
            if($msg ==  "")
            {
                
                //verificar usuario e senha no BD
                $usuario = new Usuario(email:$_POST["email"], senha:md5($_POST["senha"]));
                
                $usuarioDAO = new UsuarioDAO($this->parm);
                $retorno = $usuarioDAO->autenticar($usuario);
                if(is_array($retorno) && count($retorno) > 0)
                {
                //é um usuário
                // vamos guardar dados na sessão
                
                
                $_SESSION["idusuario"] = $retorno[0]->idusuario;
                
                $_SESSION["nome"] = $retorno[0]->nome;
                
                $_SESSION["perfil"] = $retorno[0]->perfil;
                
                header("location:index.php");
                }
                else
                {
                    $msg = "Verificar os dados digitados";
                }
            }
        }	
        
        require_once "views/login.php";
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header("location:index.php");
    }

    
}