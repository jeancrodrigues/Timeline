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
            $token = $this->valida_senha_usuario($id,$pass);
            if($token){
                $user->token = $token;
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
        if($query->get()->num_rows() === 1){
            return md5( $id . $pass . date("dmY") );
        }else{
            return false;
        }    
    }

    public function valida_token_usuario($id, $token){
        $query = $this->db->from('login');
        $query->where( array( 'iduser' => $id ) );
        $res = $query->get()->row();         
        return $res and md5( $id . $res->senha . date("dmY") ) === $token;
    }
}
?>
