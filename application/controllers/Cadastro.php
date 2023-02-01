<?php

class Cadastro extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['title'] = "Cadastro - Agenda";
        $this->load->view('pages/cadastrar', $data);
    }

    public function salvar()
    {
        $user = array(
            'user' => $this->input->post('user'),
            'email' => $this->input->post('email'),
            'senha' => md5($this->input->post('senha'))
        );

        echo json_encode($this->user_model->salvar($user), JSON_UNESCAPED_UNICODE);
    }

}