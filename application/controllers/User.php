<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

public function __construct()
{
	parent::__construct();

	$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
	$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
	$this->output->set_header('Pragma: no-cache');
	
	if(($this->session->userdata('userid') == null) || ($this->session->userdata('userid') == ""))
	{
		redirect(base_url().'login');
	}	
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
}

/*Manju Starts*/

public function index()
{
	$this->load->view('header');
	$this->load->view('dashboard');
	$this->load->view('footer');
}

public function logout()
{
	$userdata = array();
	$this->session->set_userdata($userdata);
	$this->session->sess_destroy();
	$this->load->helper('cookie');
	delete_cookie('ci_localmailserver');
	redirect(base_url().'login');
}

public function changepassword()
{
	$this->load->view('changepassword');
}

public function updatePassword()
{
	$userId = $this->session->userdata('userid');
	$oldPassword = $this->input->post('oldPassword');
	$newPassword = $this->input->post('newPassword');
	
	if($oldPassword != "" && $newPassword != "")
	{
		$result = $this->loginmodel->getUserDetails($userId);
		foreach($result as $row)
		{
			$checkPassword = $row->password;
		}
		if($checkPassword != md5($oldPassword))
		{
			$data["isError"] = TRUE;
			$data["msg"] = "Your Old Password is Wrong. Please Check.";
		}
		else
		{
			$this->loginmodel->updatePassword($userId, $newPassword);
			
			$data["isError"] = FALSE;
			$data["msg"] = "Password Updated Successfully...";
		}
	}
	else
	{
		$data["isError"] = TRUE;
		$data["msg"] = "Please Fill All Fields";
	}
	echo json_encode($data);
}

public function users($entryId = '')
{
	$data["entryId"] = $entryId;
	
	$res = $this->loginmodel->getUserDetails($entryId);
	
	$data["userName"] = "";
	$data["userEmail"] = "";
	
	if($entryId > 0)
	{
		foreach($res as $row)
		{
			$data["userName"] = $row->firstname;
			$data["userEmail"] = $row->email;
		}
	}
	else
	{
		$data["allDtls"] = $res;
	}
	
	$this->load->view('header');
	$this->load->view('users', $data);
	$this->load->view('footer');
}

public function saveUser()
{
	$entryId = $this->input->post('userId');
	$userName = $this->input->post('userName');
	$userEmail = $this->input->post('userEmail');
	
	if($userName != "" && $userEmail != "")
	{
		$cnt = $this->loginmodel->checkUserAvailability($entryId, $userEmail);
		
		if($cnt > 0)
		{
			$data["isError"] = TRUE;
			$data["msg"] = "User Already Available. Please Check.";
		}
		else
		{
			$this->loginmodel->saveUser($entryId, $userName, $userEmail);
		
			$data["isError"] = FALSE;
			if($id > 0)
			{
				$data["msg"] = "User Updated Successfully...";
			}
			else
			{
				$data["msg"] = "User Created Successfully...";
			}
		}
	}
	else
	{
		$data["isError"] = TRUE;
		$data["msg"] = "Please Fill All Fields";
	}
	echo json_encode($data);
}

public function inbox()
{
	$this->load->view('header');
	$this->load->view('inbox');
	$this->load->view('footer');
}

/*Common Function Starts*/

public function delEntry()
{
	$entryId = $this->input->post('entryId');
	$tableName = $this->input->post('tableName');
	$columnName = $this->input->post('columnName');
	
	if($entryId > 0 && $tableName != "" && $columnName != "")
	{
		$this->loginmodel->delEntry($entryId, $tableName, $columnName);
		
		$data["isError"] = FALSE;
		$data["msg"] = "Entry Removed Successfully...";
	}
	else
	{
		$data["isError"] = TRUE;
		$data["msg"] = "Please Fill All Fields";
	}
	echo json_encode($data);
}

/*Common Function Ends*/

/*Manju Ends*/

}