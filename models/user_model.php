<?php 
class User_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_users(){
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function get_users_by_name($name){
        $query = $this->db->like('nome',$name,'after');
        return $query->get('user')->result_array(); 
    }

    public function get_user($id) {
		$query = $this -> db -> where('iduser', $id);
		return $query -> get('user') -> row();
	}
    public function gravar_user($usuario){
        if($this->valida_user($usuario)){
            $query = $this->db->insert('user',$usuario);
        }
    }

    private function valida_user($usuario){
        return true;
    }
	
	public function update_user($dados = NULL, $condicao = NULL) {
		if ($dados != NULL && $condicao != NULL) {
			$this -> db -> where('iduser', $condicao);
			$this -> db -> update('user', $dados);
			$this -> session -> set_flashdata('edicaook', 'Cadastro Alterado com Sucesso!');
			redirect(current_url());
		}
	}
}
?>
