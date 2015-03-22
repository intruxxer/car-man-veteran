<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class remindermodel extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }

    function getRenewalSTNK()
    {
    	$query = "select carid, ".
    					"brandname, ".
    					"typename, ".
    					"transmitiontype, ".
    					"platenumber, ".
    					"manufactureyear, ".
    					"b.username, ".
    					"date_format(stnkexpiry, '%d %b %Y') as stnkexpiry ".
					"from mscar a ".
						"left join msuser b on a.personincharge = b.userid and b.rowstatus = 'A' ".
					"where week(now()) = week(stnkexpiry)-1 ".
						"and a.rowstatus = 'A' ";

    	$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getReminderService()
    {
    	$query = "select carid, ".
							"brandname, ".
							"typename, ".
							"transmitiontype, ".
							"platenumber, ".
							"manufactureyear, ".
							"username, ".
							"date_format(lastservicedate, '%d %b %Y') as lastservice ".
					"from ".
					"( ".
						"select carid, ".
									"brandname, ".
									"typename, ".
									"transmitiontype, ".
									"platenumber, ".
									"manufactureyear, ".
									"b.username, ".
									"( ".
										"select servicedate from trcarservicehistory ".
										"where carid = a.carid and rowstatus = 'A' ".
										"order by servicedate desc limit 0,1 ".
									") as lastservicedate ".
						"from mscar a ".
							"left join msuser b on a.personincharge = b.userid and b.rowstatus = 'A' ".
						"where a.rowstatus = 'A' ".
					") AS temp ".
					"where week(now()) = week(date_add(lastservicedate, interval 3 month))-1 ";

    	$result = $this->db->query($query, array());

		return $result->result_array();
    }
}