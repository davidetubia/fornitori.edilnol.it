<?php 
class Login_model extends CI_Model {

    public function check_user_exist($codforn, $password=null){
        $this->db->select('*');
        $this->db->from('utenti');
        $this->db->where('conto', $codforn);
        $this->db->where('attivo', 'A');

        $query = $this->db->get();
        
        if($query->result()){
            $login = $query->row();
            $user = $this->check_user_password($codforn, $password);
            if($user){
                $this->create_session($user);
                return true;
            } else {
                if($login){
                    return $login;
                } else {
                    return false;
                }
            }
        } else {
            return null;
        }
    }

    public function check_user_password($codforn, $password){
        $this->db->select('*');
        $this->db->from('utenti');
        $this->db->where('conto', $codforn);
        $this->db->where('password', sha1($password));
        $this->db->where('attivo', 'A');
        $query = $this->db->get();

        if($query->result()){
            $user = $query->row();
            return $user;
        } else {
            return null;
        }
    }

    public function create_session($login){
        $this->session->set_userdata('user', $login);
    }
}
