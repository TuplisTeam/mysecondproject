<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

/**
 * Index Page for this controller.
 *
 * Maps to the following URL
 * 		http://example.com/index.php/welcome
 *	- or -
 * 		http://example.com/index.php/welcome/index
 *	- or -
 * Since this controller is set as the default controller in
 * config/routes.php, it's displayed at http://example.com/
 *
 * So any other public methods not prefixed with an underscore will
 * map to /index.php/welcome/<method_name>
 * @see https://codeigniter.com/user_guide/general/urls.html
 */

public function __construct()
{
	parent::__construct();

	$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
	$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
	$this->output->set_header('Pragma: no-cache');
	//$this->session->set_userdata('isLogged', FALSE);
	
	if(($this->session->userdata('userid') == null) || ($this->session->userdata('userid') == ""))
	{
	}
	else
	{
		redirect(base_url().'user');
	}			
}

/*Manju Starts*/

public function index()
{
	$this->load->view('loginpage');
}

public function checkLogin()
{
	$userName = $this->input->post('userName');
	$password = $this->input->post('password');
	
	if($userName != "" && $password != "")
	{
		$this->loginmodel->checkLogin($userName, $password);
	}
	else
	{
		$data["isError"] = TRUE;
		$data["msg"] = "Please Fill All Details.";
		
		echo json_encode($data);
		return;
	}
}

/*Manju Ends*/

}