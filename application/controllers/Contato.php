<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contato extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		permissao();
		$this->load->model("contato_model");
		$this->load->model("busca_model");
		$this->load->model("grupo_model");
		$this->load->model("grupoContato_model");
	}

	public function index()
	{
		$user = $this->session->logged_user['id'];
		$data["contatos"] = $this->contato_model->index($user);
		$data["grupos"] = $this->grupo_model->index($user);
		$data["title"] = "Contatos";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/contatos', $data);
		$this->load->view('templates/js', $data);
		$this->load->view('templates/footer', $data);
	}

	public function new()
	{
		$user = $this->session->logged_user['id'];
		$data["grupos"] = $this->grupo_model->index($user);
		$data["title"] = "Novo Contatos";

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/form-contatos', $data);
		$this->load->view('templates/js', $data);
		$this->load->view('templates/footer', $data);
	}

	public function salvar()
	{
		$contato = array(
			'nome' => $this->input->post('nome'),
			'nascimento' => $this->input->post('nascimento'),
			'cpf' => $this->input->post('cpf')
		);
		$user = $this->session->logged_user['id'];
		$this->contato_model->salvar($contato, $user);
		$contato = $this->contato_model->getContato($contato['nome']);
		$grupos = $this->input->post('grupos');
		$emails = $this->input->post('emails');
		$phones = $this->input->post('telefones');

		if (isset($grupos)) {
			foreach ($grupos as $key => $value) {
				$grupo = $this->grupo_model->grupos($value, $user);
				$this->grupoContato_model->salvar($grupo['grupo'], $grupo['id'], $contato['id'], $user);
			}
		}

		if (isset($phones)) {
			foreach ($phones as $key => $value) {
				$this->contato_model->salvarPhone($value, $contato['id'], $user);
			}
		}
		if (isset($emails)) {
			foreach ($emails as $key => $value) {
				$this->contato_model->salvarEmail($value, $contato['id'], $user);
			}
		}

		redirect("contato");
	}

	public function addEmail()
	{
		$email = $this->input->post('email');
		$id = $this->input->post('id_contato');
		$user = $this->session->logged_user['id'];

		if (!empty($email)) {
			echo json_encode($this->contato_model->salvarEmail($email, $id, $user), JSON_UNESCAPED_UNICODE);
		}
	}

	public function deletarEmail()
	{
		$email = $this->input->post('id_email');
		echo json_encode($this->contato_model->deletarEmail($email), JSON_UNESCAPED_UNICODE);
	}

	public function addPhone()
	{
		$phone = $this->input->post('phone');
		$id = $this->input->post('id_contato');
		$user = $this->session->logged_user['id'];

		if (!empty($phone)) {
			echo json_encode($this->contato_model->salvarPhone($phone, $id, $user), JSON_UNESCAPED_UNICODE);
		}
	}

	public function deletarPhone()
	{
		$phone = $this->input->post('id_phone');
		echo json_encode($this->contato_model->deletarPhone($phone), JSON_UNESCAPED_UNICODE);
	}

	public function addGrupo()
	{
		$grupo = $this->input->post('grupo');
		$id = $this->input->post('id_contato');
		$data = $this->contato_model->getGrupo($id, $grupo);
		$user = $this->session->logged_user['id'];
	
		if (empty($data)) 
		{
			echo json_encode($this->grupoContato_model->salvar($grupo, $grupo[6], $id, $user), JSON_UNESCAPED_UNICODE);
		} 
		else 
		{
			exit;
		}
	}

	public function deletarGrupo()
	{
		$grupo = $this->input->post('id_grupo');
		$id = $this->input->post('id_contato');
		echo json_encode($this->grupoContato_model->deletar($id, $grupo), JSON_UNESCAPED_UNICODE);
	}

	public function editar($id)
	{
		$user = $this->session->logged_user['id'];
		$data["contato"] = $this->contato_model->editar($id);
		$data["grupos"] = $this->grupo_model->index($user);
		$data["email"] = $this->contato_model->editarEmail($id);
		$data["phone"] = $this->contato_model->editarPhone($id);
		$data["title"] = "Editar Contato";

		$this->load->view('templates/nav-top', $data);
		$this->load->view('pages/edit-contatos', $data);
		$this->load->view('templates/js', $data);
		$this->load->view('templates/footer', $data);
	}

	public function atualizar($id)
	{
		$contato['nome'] = $this->input->post('nome');
		$contato['nascimento'] = $this->input->post('nascimento');
		$contato['cpf'] = $this->input->post('cpf');

		$this->contato_model->atualizar($id, $contato);

		redirect("contato");
	}

	public function deletar($id)
	{
		$this->contato_model->deletarRegistroEmail($id);
		$this->contato_model->deletarRegistroPhone($id);
		$this->grupoContato_model->deletarRegistro($id);
		echo json_encode($this->contato_model->deletar($id), JSON_UNESCAPED_UNICODE);
	}

	public function listar()
	{
		$user = $this->session->logged_user['id'];
		$data = $this->input->post('search');
		$filtro = $this->input->post('filter');
		$listar = $this->busca_model->buscar($data, $filtro, $user);
		echo json_encode($listar, JSON_UNESCAPED_UNICODE);
	}

	public function getEmail()
	{
		$id = $this->input->get('id_contato');
		$user = $this->session->logged_user['id'];
		$data = $this->contato_model->getEmail($id, $user);

		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function getPhone()
	{
		$id = $this->input->get('id_contato');
		$user = $this->session->logged_user['id'];
		$data = $this->contato_model->getPhone($id, $user);

		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function getGrupo()
	{
		$id = $this->input->get('id_contato');
		$user = $this->session->logged_user['id'];
		$data = $this->grupoContato_model->getGrupoContato($id, $user);

		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function validaCPF()
	{
		$cpf = $this->input->post('cpf');
		$cpf = preg_replace('/[^0-9]/is', '', $cpf);
		if (strlen($cpf) != 11) {
			echo json_encode(false, JSON_UNESCAPED_UNICODE);
		}
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			echo json_encode(false, JSON_UNESCAPED_UNICODE);
		}
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				echo json_encode(false, JSON_UNESCAPED_UNICODE);
			}
		}
		echo json_encode(true, JSON_UNESCAPED_UNICODE);
	}
}
