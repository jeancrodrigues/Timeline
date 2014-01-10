<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cadastro_model extends CI_Model {

	public function do_insert($dados = NULL) {
		if ($dados != NULL) {
			$dadosUser = array('nome' => element('nome', $dados), 'email' => element('email', $dados));
			$this -> db -> trans_start();
			$this -> db -> insert('user', $dadosUser);
			$id = $this -> db -> insert_id();
			$dadosLogin = array('nomeusuario' => element('login', $dados), 'senha' => element('senha', $dados), 'iduser' => $id);
			$this -> db -> insert('login', $dadosLogin);
			$this -> db -> trans_complete();

			if ($this -> db -> trans_status() === FALSE) {

				return -1;
				// indicates failure
			} else {
				$this -> session -> set_flashdata('cadastrook', 'Cadastro Efetuado com Sucesso!');
				redirect('cadastro/novo');
			}

		}
	}

	public function do_update($dados = NULL, $condicao = NULL) {
		if ($dados != NULL && $condicao != NULL) {
			$this -> db -> where('iduser', $condicao);
			$this -> db -> update('user', $dados);
			$this -> session -> set_flashdata('edicaook', 'Cadastro Alterado com Sucesso!');
			redirect(current_url());
		}
	}

	public function do_delete($condicao = NULL) {
		if ($condicao != NULL) {
			$this -> db -> delete('user', $condicao);
			$this -> session -> set_flashdata('excluirok', 'Registro Deletado com Sucesso!');
			redirect('cadastro/buscar');
		}
	}

	public function get_all_user() {
		return $this -> db -> get('user');
	}
	

	public function get_all() {
        $this->db->from('user');
        $this->db->join('login', 'user.iduser = login.iduser','inner');
		return $this -> db -> get();
	}

	public function get_user_byid($id = null) {
		if ($id != NULL) {
			$this -> db -> where('iduser', $id);
			$this -> db -> limit(1);
			return $this -> db -> get('user');
		} else {
			return FALSE;
		}	
	}
	
	public function get_byid($id = null) {
		if ($id != NULL) {
			$this->db->from('user');
            $this -> db -> where('user.iduser', $id);
			$this -> db -> limit(1);
			$this->db->join('login', 'user.iduser = login.iduser','inner');
			return $this->db->get();
		} else {
			return FALSE;
		}
	}

}
