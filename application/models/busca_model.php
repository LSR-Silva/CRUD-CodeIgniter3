<?php

class Busca_model extends CI_Model
{
	public function buscar($busca, $filtro, $user)
	{
		$this->db->select('contatos.id, nome, nascimento, cpf, email, phone');
		$this->db->from('contatos');
		$this->db->join('grupos_contatos', 'contatos.id = grupos_contatos.id_contato');
		$this->db->join('grupos', 'grupos.id = grupos_contatos.id_grupo');
		$this->db->join('emails', 'contatos.id = emails.id_contato');
		$this->db->join('phones', 'contatos.id = phones.id_contato');
		$this->db->like('contatos.nome', $busca);
		$this->db->like('grupos_contatos.id_grupo', $filtro);
		$this->db->where('contatos.id_user', $user);
		$this->db->group_by('emails.id_contato');
		return $this->db->get()->result_array();
	}
}
