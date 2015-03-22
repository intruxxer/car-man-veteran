<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usermodel extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }

    function getUserID()
    {
    	$query = "select coalesce(max(userid)+1,1) as userid from msuser";

    	$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getTotalUser()
    {
    	$query = "select count(userid) as totalrow from msuser where rowstatus = 'A'";

		$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getUserListData($start, $rowperpage)
    {
    	$query = "select userid, ".
                    "username, ".
                    "cellphone, ".
                    "email, ".
                    "position, ".
                    "role, ".
                    "(select concat(username,' - ',position) from msuser where userid = a.personincharge and rowstatus ='A') as personincharge, ".
                    "(select platenumber from mscar where personincharge = a.userid and rowstatus = 'A') as carincharge ".
                "from msuser a ".
                "where rowstatus = 'A' ".
                "order by role, username asc ".
                "limit ?,?";

		$result = $this->db->query($query, array($start, $rowperpage));

		return $result->result_array();
    }

    function getUserDataByID($userid)
    {
    	$query = "select userid, ".
                    "username, ".
                    "password as userpassword, ".
                    "cellphone, ".
                    "email, ".
                    "position, ".
                    "role, ".
                    "personincharge ".
                "from msuser a ".
                "where rowstatus = 'A' ".
                    "and userid = ?";

		$result = $this->db->query($query, array($userid));

		return $result->result_array();
    }

    function createUser($userid, $username, $password, $cellphone, $email, $position, $role, $personincharge, $auditusername)
    {
    	$temppersonincharge = $personincharge;

    	if($personincharge == 0)
    	{
    		$temppersonincharge = null;
    	}

    	echo $temppersonincharge;

    	$query = "insert into msuser values (?, UPPER(?), ?, ?, ?, ?, ?, ?, null, NOW(), ?, null, null, 'A')";

		$result = $this->db->query($query, array($userid, $username, $password, $cellphone, $email, $position, $role, $temppersonincharge, $auditusername));

		return $result;
    }

    function updateUser($userid, $username , $password, $cellphone, $email, $position , $role, $personincharge, $auditusername)
    {
    	$temppersonincharge = $personincharge;

    	if($personincharge == 0)
    	{
    		$temppersonincharge = null;
    	}
    	
    	$query1 = "update msuser set modifiedtime=now(), modifiedusername=?, rowstatus='U' ".
    				"where userid = ? and rowstatus = 'A'";

		$result1 = $this->db->query($query1, array($auditusername, $userid));

    	$query2 = "insert into msuser values (?, UPPER(?), ?, ?, ?, ?, ?, ?, null, NOW(), ?, null, null, 'A')";

		$result2 = $this->db->query($query2, array($userid, $username , $password, $cellphone, $email, $position, $role, $temppersonincharge, $auditusername));

		return $result2;
    }

    function deleteUserData($userid, $auditusername)
    {
    	$query = "update msuser set modifiedtime=now(), modifiedusername=?, rowstatus='D' ".
    				"where userid = ? and rowstatus = 'A'";

		$result = $this->db->query($query, array($auditusername, $userid));

		return $result;
    }
}