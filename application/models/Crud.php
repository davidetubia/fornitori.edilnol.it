<?php 
class Crud extends CI_Model {

    public function um_gestite($um){
        $this->db->select('*');
        $this->db->from('um_gestite');
        $this->db->where('trs_um_st', $um);
        $query = $this->db->get();

        if($query->result()){
            return true;
        } else {
            return null;
        }
    }


}
