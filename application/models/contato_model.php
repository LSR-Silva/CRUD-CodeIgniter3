<?php

class Contato_model extends CI_Model
{
	public function index($user)
	{
		$this->db->select('*');
		$this->db->from('contatos');
		$this->db->join('emails', 'contatos.id = emails.id_contato');
		$this->db->join('phones', 'contatos.id = phones.id_contato');
		$this->db->where('contatos.id_user', $user);
		return $this->db->get()->result_array();
	}

	public function getContato($nome){
		$this->db->select('id');
		$this->db->from('contatos');
		$this->db->where('nome', $nome);
		
		return $this->db->get()->row_array();
	}

	public function salvar($contato, $user)
	{
		$this->db->set('id_user', $user);
		$this->db->insert("contatos", $contato);
	}

	public function editar($id)
	{
		return $this->db->get_where("contatos", array(
			"id" => $id
		))->row_array();
	}

	public function atualizar($id, $contato)
	{
		$this->db->where("id", $id);
		return $this->db->update("contatos", $contato);
	}

	public function deletar($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete("contatos");
	}

	public function getGrupo($id, $grupo)
	{
		$this->db->select('*');
		$this->db->from('grupos_contatos');
		$this->db->where('id_contato', $id);
		$this->db->where('id_grupo', $grupo);
		return $this->db->get()->row_array();
	}

	public function salvarEmail($email, $id, $user)
	{
		$this->db->set('id_user', $user);
		$this->db->set('email', $email);
		$this->db->set('id_contato', $id);
		return $this->db->insert("emails");

	}

	public function editarEmail($id)
	{
		return $this->db->get_where("emails", array(
			"id_contato" => $id
		))->row_array();
	}

	public function deletarEmail($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete("emails");
	}

	public function deletarRegistroEmail($id)
	{
		$this->db->where("id_contato", $id);
		return $this->db->delete("emails");
	}

	public function getEmail($id, $user){
		$this->db->select('*');
		$this->db->from('emails');
		$this->db->where('id_contato', $id);
		$this->db->where('id_user', $user);
		return $this->db->get()->result_array();
	}

	public function salvarPhone($telefone, $id, $user)
	{
		$this->db->set('id_user', $user);
		$this->db->set('phone', $telefone);
		$this->db->set('id_contato', $id);
		return $this->db->insert("phones");
		
	}

	public function editarPhone($id)
	{
		return $this->db->get_where("phones", array(
			"id_contato" => $id
		))->row_array();
	}

	// public function atualizarPhone($id, $telefone)
	// {
	// 	$this->db->where("id", $id);
	// 	return $this->db->update("phones", $telefone);
	// }

	public function deletarPhone($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete("phones");
	}

	public function deletarRegistroPhone($id)
	{
		$this->db->where("id_contato", $id);
		return $this->db->delete("phones");
	}

	public function getPhone($id, $user){
		$this->db->select('*');
		$this->db->from('phones');
		$this->db->where('id_contato', $id);
		$this->db->where('id_user', $user);
		return $this->db->get()->result_array();
	}
}
