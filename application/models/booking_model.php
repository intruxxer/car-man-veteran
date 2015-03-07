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
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus')
        ->where(array('RowStatus'=>'A'));
        return $this->db->get($table)->result();
    }

    function getall_booking_join_byid($tableone, $tabletwo)
    {
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($tabletwo.'.RowStatus', 'A');
        $query = $this->db->get()->result();
        return $query;
    }

    function getall_booking_today_join_byid($tableone, $tabletwo)
    {
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($tableone.'.BookingStatus', 4);
        $query = $this->db->get()->result();
        return $query;
    }

    function getallpending_booking($tableone, $tabletwo)
    {
        $this->db
        //->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        ->select('*', 'Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($tableone.'.BookingStatus', 4);
        $query = $this->db->get()->result();
        return $query;
    }

    function getone_booking($table, $id) 
    {
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus')
        ->where(array('BookingID'=>$id));
        $query = $this->db->get($table)->result();
        return $query;
    }

    function getoneuser_booking_byid($table, $id)
    {
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus')
        ->where(array('UserBooking'=>$id));
        $query = $this->db->get($table)->result();
        return $query;
    }

    function getoneuserbyname_booking($table, $name)
    {
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus')
        ->where(array('UserBookingName'=>$name));
        $query = $this->db->get($table)->result();
        return $query;
    }

    function getmaxID_booking($table)
    {
        $this->db->select_max('BookingID');
        $query = $this->db->get($table)->result();
        return $query[0]->BookingID;
    }

    function getusername_byid($id)
    {
        $this->db->select('Username')->where('UserID',$id);
        $query = $this->db->get('msuser')->result();
        return $query;
    }

    function update_booking($table, $data=array(), $where)
    {
        $this->db->where('BookingID', $where);
        $this->db->update($table, $data);
    }
    
    function delete_booking($table, $where){
        $this->db->where($where);
        $this->db->delete($table);
    }

}