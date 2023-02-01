<?php

class Login_model extends CI_Model{
    
    public function getUser($user, $senha)
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('user', $user);
        $this->db->where('senha', $senha);

        return $this->db->get()->row_array();
    }
}