<?php

class Grupo_model extends CI_Model
{
	public function index($user)
	{
		$this->db->select('*');
		$this->db->from('grupos');
		$this->db->where('id_user', $user);
		return $this->db->get()->result_array();
	}

	public function salvar($grupo, $user)
	{
		$this->db->set('id_user', $user);
		$this->db->set('grupo', $grupo);
		$this->db->insert("grupos");
	}

	public function editar($id)
	{
		return $this->db->get_where("grupos", array(
			"id" => $id
		))->row_array();
	}

	public function atualizar($id, $grupo)
	{
		$this->db->where("id", $id);
		return $this->db->update("grupos", $grupo);
	}

	public function deletar($id)
	{
		$this->db->where("id", $id);
		return $this->db->delete("grupos");
	}

	public function getGrupo($id){
		$this->db->select('*');
		$this->db->from('grupos');
		$this->db->where('id', $id);
		return $this->db->get()->result_array();
	}

	public function grupos($grupo, $user)
	{
		$this->db->select('*');
		$this->db->from('grupos');
		$this->db->where('grupo', $grupo);
		$this->db->where('id_user', $user);
		return $this->db->get()->row_array();
	}
}
