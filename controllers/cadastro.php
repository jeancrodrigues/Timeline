<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 */
class Cadastro extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		$this -> load -> library('form_validation');
		$this -> load -> helper('array');
		$this -> load -> library('session');
		$this -> load -> library('table');
		$this->load->model('cadastro_model');
	}

	public function index() {

		$dados = array('titulo' => 'Menu de Cadastro ', 'tela' => '', );
		$this -> load -> view('cadastro_view', $dados);
	}

	public function novo() {
		//validação do form
		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|max_lenght[3]|ucwords');
		$this -> form_validation -> set_rules('email', 'EMAIL', 'trim|required|max_lenght[50]|strtolowe|valid_email|is_unique[user.email]');
		$this -> form_validation -> set_rules('login', 'LOGIN', 'trim|required|max_lenght[25]|strtolower|is_unique[login.nomeusuario]');
		$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|required|strtolower');
		$this->form_validation->set_message('matches','O campo %s nao confere com o campo %s');
		$this -> form_validation -> set_rules('senha2', 'REPITA A SENHA', 'trim|required|strtolower|matches[senha]');
		
		if ($this -> form_validation -> run() == TRUE) {
			$dados = elements(array('nome','email','login','senha'),$this->input->post());
			$dados['senha'] = md5($dados['senha']);
			$this->cadastro_model->do_insert($dados);
		}
		$dados = array('titulo' => 'Crud &raquo; Create ', 'tela' => 'inserir', );
		$this -> load -> view('cadastro_view', $dados);
	}

	public function buscar() {

		$dados = array('titulo' => 'Cadastro &raquo; - Busca de Usuarios ', 'tela' => 'buscar',
		'usuarios'=> $this->cadastro_model->get_all()->result(),);
		$this -> load -> view('cadastro_view', $dados);
	}

	public function editar() {

		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|max_lenght[50]|ucwords');
		$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|required|strtolower');
		$this->form_validation->set_message('matches','O campo %s nao confere com o campo %s');
		$this -> form_validation -> set_rules('senha2', 'REPITA A SENHA', 'trim|required|strtolower|matches[senha]');
		
		if ($this -> form_validation -> run() == TRUE) {
			//$dados = elements(array('nome','senha'),$this->input->post());
			//$dados['senha'] = md5($dados['senha']);
			$dados = elements('nome',$this->input->post());
			$cond = $this->input->post('idusuario');
			$this->cadastro_model->do_update($dados,$cond);
		}
		$dados = array('titulo' => 'Cadastro &raquo; Editar ', 'tela' => 'editar', );
		$this -> load -> view('cadastro_view', $dados);
	}

	public function deletar() {
		if($this->input->post('idusuario')>0)
		$this->cadastro_model->do_delete(array('iduser'=>$this->input->post('idusuario')));
		$dados = array('titulo' => 'Cadastro &raquo; Excluir ', 'tela' => 'deletar', );
		$this -> load -> view('cadastro_view', $dados);
	}

}
