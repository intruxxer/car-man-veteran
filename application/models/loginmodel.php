<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class loginmodel extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }

    function doLogin($email, $password)
    {
    	$query = "select userid, username, role ".
                    "from msuser ".
                    "where rowstatus = 'A'".
                        "and email = ? ".
                        "and password = ?";

    	$result = $this->db->query($query, array($email, $password));

		return $result->result_array();
    }

    function doCheckOldPassword($userid, $oldpassword)
    {
        $query = "select userid ".
                    "from msuser ".
                    "where rowstatus = 'A'".
                        "and userid = ? ".
                        "and password = ?";

        $result = $this->db->query($query, array($userid, $oldpassword));

        return $result->result_array();
    }

    function doChangePassword($newpassword, $userid)
    {
        $userDataQuery = "select userid, ".
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

        $userDataResult = $this->db->query($userDataQuery, array($userid));

        $userData = $userDataResult->result_array();

        $query1 = "update msuser set modifiedtime=now(), modifiedusername=?, rowstatus='U' ".
                    "where userid = ? and rowstatus = 'A'";

        $result1 = $this->db->query($query1, array($userid, $userid));

        $query2 = $query = "insert into msuser values (?, ?, ?, ?, ?, ?, ?, ?, null, NOW(), ?, null, null, 'A')";

        $result2 = $this->db->query($query2, array($userid, $userData[0]['username'], $newpassword, 
            $userData[0]['cellphone'], $userData[0]['email'], $userData[0]['position'], 
            $userData[0]['role'], $userData[0]['personincharge'], $userid));

        return $result2;
    }
}