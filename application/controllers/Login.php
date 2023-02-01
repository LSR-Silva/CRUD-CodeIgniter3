<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        $data['title'] = "Login - Agenda";
        $this->load->view('pages/login', $data);
    }

    public function validar()
    {
        $user = $this->input->post('user');
        $senha = md5($this->input->post('senha'));
        $cadastro = $this->login_model->getUser($user, $senha);
        $data = $this->session->set_userdata("logged_user", $cadastro);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);   
    }

    public function logout()
    {
        $this->session->unset_userdata("logged_user");
        redirect("login");
    }
}
