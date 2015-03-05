<?php 

class Booking_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert_booking($table, $data=array())
    {
        return $this->db->insert($table, $data);
    }
    
    function getall_booking($table)
    {
        $this->db->select('UserID, Username, Cellphone, Position, Personincharge, Carincharge')->where(array('Role'=>'driver', 'RowStatus'=>'A'));
        return $this->db->get($table)->result();
    }

    function getone_booking($table, $id)
    {
        $this->db->select('UserID, Username, Cellphone, Position, Personincharge, Carincharge')->where(array('UserID'=>$id, 'Role'=>'driver'));
        return $this->db->get($table)->result();
    }

    function update_booking($table, $data=array(), $where)
    {
        $this->db->where('UserID', $where);
        $this->db->update($table, $data);
    }
    
    function delete_booking($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
    }

}