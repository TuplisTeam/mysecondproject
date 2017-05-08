<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginmodel extends CI_Model
{

/*Manju Starts*/

public function checkLogin($userName, $password)
{
	$res = array();
	
	$sql = "SELECT * FROM users 
			WHERE email = '".$userName."' AND password = '".md5($password)."'";
	$result = $this->db->query($sql);
	
	foreach($result->result() as $user)
	{
		$userdata = array(
    		'userid' => $user->userid,
			'username' => $user->email,
			'firstname' => $user->firstname,
    		'usertype' => $user->usertype,
    		'status'=> $user->status,
			'loggedin'=> TRUE
    	);
		
		if($user->status == 'inactive')
		{
			$res["isError"] = TRUE;
			$res["msg"] = "Account in InActive Mode.. Please Contact Administrator.";
			echo json_encode($res);
			return;
		}		
		
		$sql = "UPDATE users SET lastlogin = NOW() WHERE userid = '".$user->userid."'";
		$this->db->query($sql);		
	
		$this->session->set_userdata($userdata);
		
		$res["isError"] = FALSE;
		$res["msg"] = "Successfully login";	
		echo json_encode($res);
		return;	
	}
	
	$res["isError"] = TRUE;
	$res["msg"] = "Invalid Login";
	echo json_encode($res);
	return;
}

public function getUserDetails($userId = '')
{
	$sql = "SELECT * FROM users WHERE status <> 'inactive'";
	if($userId > 0)
	{
		$sql .= " AND userid = $userId";
	}
	$res = $this->db->query($sql);
	return $res->result();
}

public function checkUserAvailability($userId, $userEmail)
{
	$sql = "SELECT * FROM users WHERE status <> 'inactive' AND email = '".$userEmail."'";
	if($userId > 0)
	{
		$sql .= " AND userid <> $userId";
	}
	$res = $this->db->query($sql);
	return $res->num_rows();
}

public function saveUser($id, $userName, $userEmail, $menuPermissionsArr)
{
	if($id > 0)
	{
		$sql = "UPDATE users SET 
					email = '".$userEmail."', 
					firstname = '".$userName."', usertype = 'user', 
					modified_on = NOW(), 
					modified_by = '".$this->session->userdata('userid')."'
				WHERE userid = $id";
		$this->db->query($sql);
	}
	else
	{
		$sql = "INSERT INTO users SET 
					email = '".$userEmail."', password = md5(123), 
					firstname = '".$userName."', usertype = 'user', 
					created_on = NOW(), 
					created_by = '".$this->session->userdata('userid')."'";
		$this->db->query($sql);
		$id = $this->db->insert_id();
	}
}

public function updatePassword($userId, $password)
{
	$sql = "UPDATE users SET password = md5('".mysql_real_escape_string($password)."') 
			WHERE userid = $userId";
	$this->db->query($sql);
}

public function delEntry($entryId, $tableName, $columnName)
{
	$sql = "UPDATE $tableName SET status = 'inactive' WHERE $columnName = $entryId";
	$this->db->query($sql);
}

/*Manju Ends*/

}