<?php

$iduser = $this->uri->segment(3);
if($iduser==NULL) redirect('cadastro/buscar');

$query =$this->cadastro_model->get_byid($iduser)->row();

echo form_open("cadastro/deletar/$iduser");
echo form_label('Nome Completo');
echo form_input(array('name'=>'nome'),set_value('nome',$query->nome),'disabled="disabled"');
echo form_label('Email');
echo form_input(array('name'=>'email'),set_value('email',$query->email),'disabled="disabled"');
echo form_label('Login');
echo form_input(array('name'=>'login'),set_value('nomeusuario',$query->nomeusuario),'disabled="disabled"');
echo form_submit(array('name'=>'excluir'),'Excluir');
echo form_hidden('idusuario',$query->iduser);
echo form_close();