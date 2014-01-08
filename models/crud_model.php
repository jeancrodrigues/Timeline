<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model{

	public function do_insert($dados= NULL){
		if($dados != NULL){
			$dadosUser = array('nome' => element('nome', $dados),'email'=>element('email', $dados));
			$dadosLogin = array('nomeusuario' => element('login', $dados),'senha'=>element('senha', $dados));
			$this->db->insert('user',$dadosUser);
			$this->db->insert('login',$dadosLogin);
			$this->session->set_flashdata('cadastrook','Cadastro Efetuado com Sucesso!');
			redirect('crud/create');
		}
	}		
}
