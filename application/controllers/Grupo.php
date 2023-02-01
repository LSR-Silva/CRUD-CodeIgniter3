<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grupo extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permissao();
		$this->load->model("grupo_model");
	}

	public function index()
	{
		$user = $this->session->logged_user['id'];
		$data["grupos"] = $this->grupo_model->index($user);
		$data["title"] = "Grupos";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/grupos', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function new()
	{
		$data["title"] = "Novo Grupo";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/form-grupos', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function salvar()
	{
		$grupos = $this->input->post('grupo');
		$id = $this->session->logged_user['id'];
	
		$this->grupo_model->salvar($grupos, $id);

		redirect("grupo");
	}

	public function editar($id)
	{
		$data["grupo"] = $this->grupo_model->editar($id);
		$data["title"] = "Editar Grupo";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/form-grupos', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/js', $data);
	}

	public function atualizar($id)
	{
		$grupo = $this->input->post();
		$this->grupo_model->atualizar($id, $grupo);
		redirect("grupo");	
	}

	public function deletar($id)
	{
		$this->grupo_model->deletar($id);
		redirect('grupo');
	}

	public function getGrupos()
	{
		$grupos = $this->input->post('id_grupo');
		$data = $this->grupo_model->getGrupo($grupos);

		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
}
