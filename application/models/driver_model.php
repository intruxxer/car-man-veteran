<?php 

class Driver_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_driver_holder($table, $data=array())
    {
        return $this->db->insert($table, $data);
    }

    function getall_driver_holder($table)
    {
        $this->db->select('UserID, Username, Cellphone, Position, Personincharge, Carincharge')->where(array('Role'=>'driver', 'RowStatus'=>'A'));
        return $this->db->get($table)->result();
    }
    
    function getmaxID_driver_holder($table)
    {
        $this->db->select_max('UserID');
        return $this->db->get($table)->result();
    }

    function getone_driver_holder($table, $id)
    {
        $this->db->select('UserID, Username, Cellphone, Position, Personincharge, Carincharge')->where(array('UserID'=>$id, 'Role'=>'driver', 'RowStatus'=>'A'));
        return $this->db->get($table)->result();
    }

    function update_driver_holder($table, $data=array(), $where)
    {
        $this->db->where(array('UserID'=>$where, 'RowStatus'=>'A'));
        $this->db->update($table, $data);
    }
    
    function delete_driver_holder($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
    }

}