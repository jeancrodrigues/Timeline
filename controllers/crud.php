<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 */
class Crud extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		$this -> load -> library('form_validation');
		$this -> load -> helper('array');
		$this -> load -> library('session');
	}

	public function index() {

		$dados = array('titulo' => 'Crud com CodeIgniter', 'tela' => '', );
		$this -> load -> view('crud_view', $dados);
	}

	public function create() {
		//validação do form
		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|alpha|max_lenght[50]|ucwords');
		$this -> form_validation -> set_rules('email', 'EMAIL', 'trim|required|max_lenght[50]|strtolowe|valid_email|is_unique[user.email]');
		$this -> form_validation -> set_rules('login', 'LOGIN', 'trim|required|max_lenght[25]|strtolower|is_unique[login.nomeusuario]');
		$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|required|strtolower');
		$this->form_validation->set_message('matches','O campo %s nao confere com o campo %s');
		$this -> form_validation -> set_rules('senha2', 'REPITA A SENHA', 'trim|required|strtolower|matches[senha]');
		
		if ($this -> form_validation -> run() == TRUE) {
			$dados = elements(array('nome','email','login','senha'),$this->input->post());
			$dados['senha'] = md5($dados['senha']);
			$this->load->model('crud_model');
			$this->crud_model->do_insert($dados);
			
			//$dadosUser = elements(array('nome','email'),$this->input->post());
			//$dados['senha'] = md5($dados['senha']);
			//$this->load->model('crud_model');
			//$this->crud_model->do_insert($dadosUser);
		}
		$dados = array('titulo' => 'Crud &raquo; Create ', 'tela' => 'create', );
		$this -> load -> view('crud_view', $dados);
	}

	public function retrieve() {

		$dados = array('titulo' => 'Crud &raquo; Retrieve ', 'tela' => 'retrieve', );
		$this -> load -> view('crud_view', $dados);
	}

	public function update() {

		$dados = array('titulo' => 'Crud &raquo; Update ', 'tela' => 'update', );
		$this -> load -> view('crud_view', $dados);
	}

	public function delete() {

		$dados = array('titulo' => 'Crud &raquo; Delete ', 'tela' => 'delete', );
		$this -> load -> view('crud_view', $dados);
	}

}
