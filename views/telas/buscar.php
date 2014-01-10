<?php

echo '<h2> Lista de usuarios </h2>';

$query = $this->cadastro_model->get_all()->result();

if($this->session->flashdata('excluirok')){
	echo '<p>'.$this->session->flashdata('excluirok').'<p>';
}

$this -> table -> set_heading('ID', 'NOME', 'EMAIL', 'DATA DE CADASTRO','LOGIN','SENHA');

foreach ($usuarios as $user) {
	$this -> table -> add_row($user -> iduser,$user -> nome,$user -> email,$user -> datacadastro,$user -> nomeusuario,$user -> senha,
	 anchor("cadastro/editar/$user->iduser", 'Editar') . ' - ' . anchor("cadastro/deletar/$user->iduser", 'Excluir'));
}

echo $this->table->generate();
