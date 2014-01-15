<?php 

class Login_model extends My_model{
    public function __construct(){
        parent::__construct();
    }

    public function autenticar_user($username,$pass){
        $query = $this->db->from('user');
        $query->where('nomeusuario' , $username);
        $res = $query->get();
        if($res->num_rows() === 1 ){
            $user = $res->row();
            $id = $user->iduser;
            if($this->valida_senha_usuario($id,$pass)){
                return $user;
            }else{
                $this->put_mensagem_validacao('Senha inválida');
            }
        }else{
            $this->put_mensagem_validacao('Usuário não existe');
        }
        return false;
    }

    private function valida_senha_usuario($id, $pass){
        $query = $this->db->from('login');
        $query->where(array( 'iduser' => $id , 'senha' => $pass) );
        return $query->get()->num_rows() === 1;    
    }
}
?>
