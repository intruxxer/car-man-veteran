<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maintenancemodel extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }

    function getServiceID()
    {
    	$query = "select coalesce(max(serviceid)+1,1) as serviceid from trcarservicehistory";

    	$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getTotalServiceHistory()
    {
    	$query = "select count(serviceid) as totalrow ".
					"from trcarservicehistory a ".
						"join mscar b on a.carid = b.carid ".
					"where a.rowstatus = 'A' ".
						"and b.rowstatus = 'A' ".
					"order by a.createdtime desc ";

		$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getServiceHistoryList($start, $rowperpage)
    {
    	$query = "select serviceid, ".
							"b.platenumber, ".
							"b.brandname, ".
							"b.typename, ".
							"b.transmitiontype, ".
							"date_format(servicedate, '%d %M %Y') as servicedate, ".
							"nextservicekm, ".
							"remarks ".
					"from trcarservicehistory a ".
						"join mscar b on a.carid = b.carid ".
					"where a.rowstatus = 'A' ".
						"and b.rowstatus = 'A' ".
					"order by a.createdtime desc ".
					"limit ?,?";

		$result = $this->db->query($query, array($start, $rowperpage));

		return $result->result_array();
    }

    function getCarList()
    {
    	$query = "select carid, ".
							"platenumber, ".
							"brandname, ".
							"typename, ".
							"transmitiontype ".
					"from mscar ".
					"where rowstatus = 'A' ".
					"order by platenumber, brandname, typename, transmitiontype asc";

		$result = $this->db->query($query, array());

		return $result->result_array();
    }

    function getServiceDataByID($serviceid)
    {
    	$query = "select serviceid, ".
    						"b.carid, ".
							"date_format(servicedate, '%Y-%m-%d') as servicedate, ".
							"nextservicekm, ".
							"remarks ".
					"from trcarservicehistory a ".
						"join mscar b on a.carid = b.carid ".
					"where a.rowstatus = 'A' ".
						"and b.rowstatus = 'A' ".
						"and serviceid = ?";

		$result = $this->db->query($query, array($serviceid));

		return $result->result_array();
    }

    function createServiceHistory($serviceid, $carid, $servicedate, $nextservicekm, $remarks, $auditusername)
    {
    	$query = "insert into trcarservicehistory values (? ,?, ?, ?, ?, NOW(), ?, null, null, 'A')";

		$result = $this->db->query($query, array($serviceid, $carid, $servicedate, $nextservicekm, $remarks, $auditusername));

		return $result;
    }

    function updateServiceHistory($serviceid, $carid, $servicedate, $nextservicekm, $remarks, $auditusername)
    {
    	$query1 = "update trcarservicehistory set modifiedtime=now(), modifiedusername=?, rowstatus='U' ".
    				"where serviceid = ? and rowstatus = 'A'";

		$result1 = $this->db->query($query1, array($auditusername, $serviceid));

    	$query2 = "insert into trcarservicehistory values (? ,?, ?, ?, ?, NOW(), ?, null, null, 'A')";

		$result2 = $this->db->query($query2, array($serviceid, $carid, $servicedate, $nextservicekm, $remarks, $auditusername));

		return $result2;
    }

    function deleteServiceHistory($serviceid, $auditusername)
    {
    	$query = "update trcarservicehistory set modifiedtime=now(), modifiedusername=?, rowstatus='D' ".
    				"where serviceid = ? and rowstatus = 'A'";

		$result = $this->db->query($query, array($auditusername, $serviceid));

		return $result;
    }
}