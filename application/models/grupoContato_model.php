<?php

class GrupoContato_model extends CI_Model
{
	public function index()
	{
		return $this->db->get("grupos_contatos")->result_array();
	}

	public function salvar($grupo, $idGrupo, $idContato, $user)
	{
		$this->db->set('id_user', $user);
		$this->db->set('id_grupo', $idGrupo);
		$this->db->set('grupo', $grupo);
		$this->db->set('id_contato', $idContato);
		$this->db->insert("grupos_contatos");
	}

	public function editar($id)
	{
		return $this->db->get_where("grupos_contatos", array(
			"id_contato" => $id
		))->result_array();
	}

	public function atualizar($id, $grupoContato)
	{
		$this->db->where("id_contato", $id);
		return $this->db->update("grupos_contatos", $grupoContato);
	}

	public function deletar($id, $grupo)
	{
		$this->db->where("id_contato", $id);
		$this->db->where("id_grupo", $grupo);
		return $this->db->delete("grupos_contatos");
	}

	public function deletarRegistro($id)
	{
		$this->db->where("id_contato", $id);
		return $this->db->delete("grupos_contatos");
	}

	public function getGrupoContato($id, $user){
		$this->db->select('*');
		$this->db->from('grupos_contatos');
		$this->db->where('id_contato', $id);
		$this->db->where('id_user', $user);
		return $this->db->get()->result_array();
	}
}