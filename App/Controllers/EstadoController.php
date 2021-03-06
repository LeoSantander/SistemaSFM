<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Estado;

class EstadoController extends Controller
{
    public function index()
    {
        $this->redirect('/estado/cadastro');//redireciona ao controller estado, action cadastro
    }

    //action cadastro
    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }
        
        //renderiza a view cadastro
        $this->render('/estado/cadastro');

        //ao abrir a view, limpa dados de formulario, mensagem, mensagem de sucesso e erros.
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    //action salvar(incluir no bd)
    public function salvar()
    {
        //instanciando novo objeto e setando valores informados pelo usuario na view
        $registro = new Estado();
        $registro->setNome(ucwords($_POST['nome']));
        $registro->setSigla(strtoupper($_POST['sigla']));
        $registro->setidUsuarioInclusao(Sessao::retornaidUsuario());
        
        //grava formulário, caso ocorra alguma exceção
        Sessao::gravaFormulario($_POST);

        //instanciando nova DAO
        $estadoDAO = new EstadoDAO();
        
        //validação de cadastro, não permite o cadastro de estados e siglas já cadastrados
        if(($estadoDAO->verificaNome($_POST['nome'])) and ($estadoDAO->verificaSigla($_POST['sigla'])))
        {
            Sessao::gravaMensagem("Estado já Cadastrado!");//mensagem a ser exibida para informar ao usuário
            $this->redirect('/estado/cadastro');//recarrega a página cadastro de estados, já renderizada
        }
        //não permite a inserção de estados já cadastrados
        else if($estadoDAO->verificaNome($_POST['nome']))
        {
            Sessao::gravaMensagem("Nome de estado já cadastrado!");
            $this->redirect('/estado/cadastro');
        }
        //não permite a inserção de siglas já cadastradas
        else if($estadoDAO->verificaSigla($_POST['sigla']))
        {
            Sessao::gravaMensagem("Sigla já cadastrada!");
            $this->redirect('/estado/cadastro');
        }

        //salvar no banco, se retornar true, salva. (salvar - método da classe EstadoController, recebe como parametro o registro de um novo estado)
        if($estadoDAO->salvar($registro))//o retorno de salvar será true ou false
        {
            Sessao::limpaFormulario();//limpa os dados do form
            Sessao::gravaSucesso("Estado Cadastrado com Sucesso!");//grava mensagem de sucesso a ser exibida ao usuário na view

            $this->redirect('/estado/cadastro');
        }
        //caso retorne false
        else
        {
            Sessao::gravaMensagem("Erro ao gravar");//grava mensagem de erro
        }
    }

    //action consultar
    public function consultar()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        //instanciando nova DAO
        $estadoDAO = new EstadoDAO();

        //enviando dados para a view
        self::setViewParam('listarEstados', $estadoDAO->listarEstados());
        $this->render('/estado/consultar');

        //limpando métodos sessao
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
        Sessao::limpaMensagem();
    }

    //action excluir (chamada pela action exclusao)
    public function excluir()
    {
        $estado = new Estado();
        $estado->setId($_POST['id']);

        $estadoDAO = new EstadoDAO();

        if($estadoDAO->verificaCidade($estado->getId())){
            Sessao::gravaMensagem("Não é possível excluir. Estado tem relação com alguma cidade!");
            $this->redirect('/estado/consultar');
        }

        if(!$estadoDAO->excluir($estado)){
            Sessao::gravaMensagem("Estado inválido");
            $this->redirect('/estado/consultar');
        }

        Sessao::gravaSucesso("Estado excluído com sucesso!");
        $this->redirect('/estado/consultar');   
    }
}
