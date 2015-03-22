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

    function getall_car($table='mscar')
    {
        return $this->db->get_where($table, array('RowStatus' =>'A'))->result();
    }

     function getall_driver($table='msuser')
    {
        return $this->db->get_where($table, array('Role'=>'Driver', 'RowStatus' =>'A'))->result();
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

    function getall_booking_join_byid_withlimitoffset($tableone, $tabletwo, $tablethree, $lim, $off)
    {
        /*
        $this->db
        ->select('BookingID, mscar.PlateNumber, mscar.CarID, trcarbooking.CarID as trid, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'left');
        $this->db->join($tablethree, $tableone.'.CarID'.'='.$tablethree.'.CarID', 'left');
        $this->db->where($tabletwo.'.RowStatus', 'A');
        //$this->db->limit($lim, $off);
        $query = $this->db->get()->result();
        //var_dump($query);
        */
        if($off==NULL) $off = 0;
        $queryWord = "SELECT b.BookingID, a.PlateNumber, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username
                      FROM mscar a left join trcarbooking b on a.carid = b.carid and b.rowstatus = 'A' left join msuser c on b.userbooking = c.userid and c.rowstatus = 'A'
                      WHERE a.rowstatus = 'A' ORDER BY a.PlateNumber, BookingStart, BookingEnd, b.createdtime ASC LIMIT ".$off.",".$lim;
        $query = $this->db->query($queryWord);
        return $query->result();
    }

    function getnum_all_booking_join_byid_withlimitoffset($tableone, $tabletwo, $tablethree)
    {
        /*
        $this->db
        ->select('BookingID, mscar.PlateNumber, mscar.CarID, trcarbooking.CarID as trid, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'left');
        $this->db->join($tablethree, $tableone.'.CarID'.'='.$tablethree.'.CarID', 'left');
        $this->db->where($tabletwo.'.RowStatus', 'A');
        //$this->db->limit($lim, $off);
        $query = $this->db->get()->result();
        //var_dump($query);
        */
        $queryWord = "SELECT b.BookingID, a.PlateNumber, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username
                      FROM mscar a left join trcarbooking b on a.carid = b.carid and b.rowstatus = 'A' left join msuser c on b.userbooking = c.userid and c.rowstatus = 'A'
                      WHERE a.rowstatus = 'A' ORDER BY a.PlateNumber, BookingStart, BookingEnd, b.createdtime ASC";
        $query = $this->db->query($queryWord);
        return $query;
    }

    function getall_booking_today_join_byid($tableone, $tabletwo)
    {
        $todaystring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $todaystart = $today.' 00:00:00'; $todayend = $today.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$todayend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$todayend."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->select_sum( $tableone.".BookingID", 'totalbooking');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'.mdate($todaystring, strtotime('+0 days',time()))); 
        return $query;
    }

    function getall_booking_today_join_byid_withlimitoffset($tableone, $tabletwo, $tablethree, $lim, $off)
    {
        $todaystring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $todaystart = $today.' 00:00:00'; $todayend = $today.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$todayend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$todayend."' )";
        $this->db
        ->select('BookingID, mscar.CarID, PlateNumber, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        //$this->db->distinct(); //$tableone.".BookingID", 'totalbooking'
        $this->db->from($tablethree);
        $this->db->join($tableone, $tablethree.'.CarID'.'='.$tableone.'.CarID AND '.$tableone.'.RowStatus = "A"', 'left');
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID AND '.$tabletwo.'.RowStatus = "A"', 'left');
        $this->db->where($where);
        $this->db->where($tablethree.".RowStatus = 'A'");
        $this->db->limit($lim, $off);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'.mdate($todaystring, strtotime('+0 days',time()))); 
        return $query;
    }

    function getnum_all_booking_today($tableone, $tabletwo)
    {
        $todaystring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $todaystart = $today.' 00:00:00'; $todayend = $today.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$todayend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$todayend."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->select_sum( $tableone.".BookingID", 'totalbooking');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'.mdate($todaystring, strtotime('+0 days',time()))); 
        return $query;
    }

    function getall_booking_thisweek_join_byid($tableone, $tabletwo)
    {
        $todaystring = "%Y-%m-%d"; $weekstring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $week = mdate($weekstring, strtotime('+7 days',time()));
        $todaystart = $today.' 00:00:00'; $weekend = $week.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$weekend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$weekend."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'); 
        return $query;
    }

        function getall_booking_thisweek_join_byid_withlimitoffset($tableone, $tabletwo, $tablethree, $lim, $off)
    {
        $todaystring = "%Y-%m-%d"; $weekstring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $week = mdate($weekstring, strtotime('+7 days',time()));
        $todaystart = $today.' 00:00:00'; $weekend = $week.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$weekend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$weekend."' )";
        $this->db
        ->select('BookingID, mscar.CarID, PlateNumber, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        //$this->db->distinct(); //$tableone.".BookingID", 'totalbooking'
        $this->db->from($tablethree);
        $this->db->join($tableone, $tablethree.'.CarID'.'='.$tableone.'.CarID AND '.$tableone.'.RowStatus = "A"', 'left');
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID AND '.$tabletwo.'.RowStatus = "A"', 'left');
        $this->db->where($where);
        $this->db->where($tablethree.".RowStatus = 'A'");
        $this->db->limit($lim, $off);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'); 
        return $query;
    }

    function getnum_all_booking_thisweek_join_byid($tableone, $tabletwo)
    {
        $todaystring = "%Y-%m-%d"; $weekstring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $week = mdate($weekstring, strtotime('+7 days',time()));
        $todaystart = $today.' 00:00:00'; $weekend = $week.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$weekend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$weekend."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'); 
        return $query;
    }

    function getall_booking_thismonth_join_byid($tableone, $tabletwo)
    {
        $todaystring = "%Y-%m-%d"; $monthstring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $month = mdate($monthstring, strtotime('+30 days',time()));
        $todaystart = $today.' 00:00:00'; $monthend = $month.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$monthend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$monthend."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'); 
        return $query;
    }

    function getall_booking_thismonth_join_byid_withlimitoffset($tableone, $tabletwo, $tablethree, $lim, $off)
    {
        $todaystring = "%Y-%m-%d"; $monthstring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $month = mdate($monthstring, strtotime('+30 days',time()));
        $todaystart = $today.' 00:00:00'; $monthend = $month.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$monthend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$monthend."' )";
        $this->db
        ->select('BookingID, mscar.CarID, PlateNumber, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        //$this->db->distinct(); //$tableone.".BookingID", 'totalbooking'
        $this->db->from($tablethree);
        $this->db->join($tableone, $tablethree.'.CarID'.'='.$tableone.'.CarID AND '.$tableone.'.RowStatus = "A"', 'left');
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID AND '.$tabletwo.'.RowStatus = "A"', 'left');
        $this->db->where($where);
        $this->db->where($tablethree.".RowStatus = 'A'");
        $this->db->limit($lim, $off);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'); 
        return $query;
    }

    function getnum_all_booking_thismonth_join_byid($tableone, $tabletwo)
    {
        $todaystring = "%Y-%m-%d"; $monthstring = "%Y-%m-%d";
        $today = mdate($todaystring, time());
        $month = mdate($monthstring, strtotime('+30 days',time()));
        $todaystart = $today.' 00:00:00'; $monthend = $month.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$todaystart."' AND "
            .$tableone.".BookingStart <= '".$monthend."' OR "
            .$tableone.".BookingEnd >= '".$todaystart."' AND "
            .$tableone.".BookingEnd <= '".$monthend."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get();
        //print_r($where.'<br/>'.$todaystart.' & '.$todayend.'<br/>'); 
        return $query;
    }

    function getall_booking_inperiod_join_byid($tableone, $tabletwo, $startDate, $endDate)
    {
        $start = $startDate.' 00:00:00'; $end = $endDate.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$start."' AND "
            .$tableone.".BookingStart <= '".$end."' OR "
            .$tableone.".BookingEnd >= '".$start."' AND "
            .$tableone.".BookingEnd <= '".$end."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$start.' & '.$end.'<br/><br/><br/>'); 
        return $query;
    }

    function getall_booking_inperiod_join_byid_withlimitoffset($tableone, $tabletwo, $tablethree, $startDate, $endDate, $lim, $off)
    {
        $start = $startDate.' 00:00:00'; $end = $endDate.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$start."' AND "
            .$tableone.".BookingStart <= '".$end."' OR "
            .$tableone.".BookingEnd >= '".$start."' AND "
            .$tableone.".BookingEnd <= '".$end."' )";
        $this->db
        ->select('BookingID, mscar.CarID, PlateNumber, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        //$this->db->distinct(); //$tableone.".BookingID", 'totalbooking'
        $this->db->from($tablethree);
        $this->db->join($tableone, $tablethree.'.CarID'.'='.$tableone.'.CarID AND '.$tableone.'.RowStatus = "A"', 'left');
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID AND '.$tabletwo.'.RowStatus = "A"', 'left');
        $this->db->where($where);
        $this->db->where($tablethree.".RowStatus = 'A'");
        $this->db->limit($lim, $off);
        $query = $this->db->get()->result();
        //print_r($where.'<br/>'.$start.' & '.$end.'<br/><br/><br/>'); 
        return $query;
    }

    function getnum_all_booking_inperiod_join_byid($tableone, $tabletwo, $startDate, $endDate)
    {
        $start = $startDate.' 00:00:00'; $end = $endDate.' 23:59:59';
        $where = $tabletwo.".RowStatus = 'A' AND ( "
            .$tableone.".BookingStart >= '".$start."' AND "
            .$tableone.".BookingStart <= '".$end."' OR "
            .$tableone.".BookingEnd >= '".$start."' AND "
            .$tableone.".BookingEnd <= '".$end."' )";
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($where);
        $query = $this->db->get();
        //print_r($where.'<br/>'.$start.' & '.$end.'<br/><br/><br/>'); 
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
        $this->db->where($tabletwo.'.RowStatus', 'A');
        $query = $this->db->get()->result();
        return $query;
    }

    function getallpending_booking_withlimitoffset($tableone, $tabletwo, $lim, $off)
    {
        $this->db
        //->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus, Username');
        ->select('*', 'Username');
        $this->db->from($tableone);
        $this->db->join($tabletwo, $tableone.'.UserBooking'.'='.$tabletwo.'.UserID', 'inner');
        $this->db->where($tableone.'.BookingStatus', 4);
        $this->db->where($tabletwo.'.RowStatus', 'A');
        $this->db->limit($lim, $off);
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

    function getoneuser_booking_byid_withlimitoffset($table, $id, $lim, $off)
    {
        $this->db
        ->select('BookingID, CarID, UserBooking, Driver, BookingStart, BookingEnd, Destination, Remarks, BookingStatus');
        $this->db->from($table);
        $this->db->where(array('UserBooking'=>$id));
        $this->db->limit($lim, $off);
        $query = $this->db->get()->result();
        //var_dump($query);
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

    function getdrivername_byid($id)
    {
        $query = "SELECT Username, Position, Role FROM msuser WHERE UserID = ".$id." AND RowStatus = 'A'";
        //$this->db->select('Username')->where(
        //    array('UserID'=>$id,
        //        'RowStatus'=>'A'
        //    ));
        $result = $this->db->query($query)->result();
        return $result;
    }

    function getvehicle_byid($id)
    {
        $this->db->select('PlateNumber')->where('CarID',$id);
        $query = $this->db->get('mscar')->result();
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