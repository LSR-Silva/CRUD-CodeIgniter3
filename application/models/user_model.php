<?php

class User_model extends CI_Model{
    
    public function salvar($user)
    {
        $this->db->set('user', $user['user']);
        $this->db->set('email', $user['email']);
        $this->db->set('senha', $user['senha']);
        return $this->db->insert('usuarios');
    }
}