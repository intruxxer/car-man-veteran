<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class carmodel extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }

    function getUserList()
    {
    	$query = "select userid, username, position from msuser where rowstatus='A' order by username asc";

    	$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getCarID()
    {
    	$query = "select coalesce(max(carid)+1,1) as carid from mscar";

    	$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getTotalCar()
    {
    	$query = "select count(carid) as totalrow from mscar where rowstatus = 'A'";

		$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getCarList($start, $rowperpage)
    {
    	$query = "select carid, ".
						"brandname, ".
						"typename, ".
						"transmitiontype, ".
						"platenumber, ".
						"manufactureyear, ".
						"date_format(stnkexpiry, '%d %M %Y') as stnkexpiry, ".
						"b.userid, ".
						"b.username, ".
                        "b.position ".
				"from mscar a ".
					"left join msuser b on a.personincharge = b.userid and b.rowstatus = 'A' ".
				"where a.rowstatus = 'A' ".
					"order by platenumber asc ".
				"limit ?,?";

		$result = $this->db->query($query, array($start, $rowperpage));

		return $result->result_array();
    }

    function getCarDataByID($carid)
    {
    	$query = "select carid, ".
						"brandname, ".
						"typename, ".
						"transmitiontype, ".
						"platenumber, ".
						"machinenumber, ".
						"casisnumber, ".
						"manufactureyear, ".
						"date_format(stnkexpiry, '%Y-%m-%d') as stnkexpiry, ".
						"b.userid, ".
						"b.username ".
						"carimage ".
				"from mscar a ".
					"left join msuser b on a.personincharge = b.userid and b.rowstatus = 'A' ".
				"where a.rowstatus = 'A' ".
					"and carid = ?";

		$result = $this->db->query($query, array($carid));

		return $result->result_array();
    }

    function createCar($carid, $brandname, $typename, $transmitiontype, $platenumber, $stnkexpiry, $machinenumber, $casisnumber, 
        $manufactureyear, $personincharge, $auditusername)
    {
    	$temppersonincharge = $personincharge;

    	if($personincharge == 0)
    	{
    		$temppersonincharge = null;
    	}

    	echo $temppersonincharge;

    	$query = "insert into mscar values (? ,?, ?, ?, UPPER(?), ? ,?, ?, ?, ?, null, NOW(), ?, null, null, 'A')";

		$result = $this->db->query($query, array($carid, $brandname, $typename, $transmitiontype, $platenumber, $stnkexpiry, 
            $machinenumber, $casisnumber, $manufactureyear, $temppersonincharge, $auditusername));

		return $result;
    }

    function updateCar($carid, $brandname, $typename, $transmitiontype, $platenumber, $stnkexpiry, $machinenumber, $casisnumber, 
        $manufactureyear, $personincharge, $auditusername)
    {
    	$temppersonincharge = $personincharge;

    	if($personincharge == 0)
    	{
    		$temppersonincharge = null;
    	}
    	
    	$query1 = "update mscar set modifiedtime=now(), modifiedusername=?, rowstatus='U' ".
    				"where carid = ? and rowstatus = 'A'";

		$result1 = $this->db->query($query1, array($auditusername, $carid));

    	$query2 = "insert into mscar values (? ,?, ?, ?, UPPER(?), ? ,?, ?, ?, ?, null, NOW(), ?, null, null, 'A')";

		$result2 = $this->db->query($query2, array($carid, $brandname, $typename, $transmitiontype, $platenumber, $stnkexpiry, 
            $machinenumber, $casisnumber, $manufactureyear, $temppersonincharge, $auditusername));

		return $result2;
    }

    function deleteCarData($carid, $auditusername)
    {
    	$query = "update mscar set modifiedtime=now(), modifiedusername=?, rowstatus='D' ".
    				"where carid = ? and rowstatus = 'A'";

		$result = $this->db->query($query, array($auditusername, $carid));

		return $result;
    }
}