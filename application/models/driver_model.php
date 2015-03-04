<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_driver_holder($data)
    {
        $query = $this->db->get_where( 'msuser', array('Role' => $data['Role']) );
        return $query->result();
    }

    function insert_new_driver_holder($data)
    {
        $entry = array(
        'Username' => $data['Username'],
        'Cellphone' => $data['Cellphone'],
        'Position' => $data['Position'],
        'Role'   => $data['Role'],
        'Personincharge' => $data['Personincharge'],
        'Carincharge'   => $data['Carincharge'],
        'CreatedTime' => $data['CreatedTime'],
        'CreatedUsername' => $data['UserID'],
        'RowStatus' => 'A'
        );

        $this->db->insert('msuser', $entry);
    }

    function update($data)
    {

        $this->db->update('msuser', $this, array(
            'Username' => $data['username'])
        );
    }

}