<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->view('login');
		if (isset($_SESSION["locked"])){
			$difference = time() - $_SESSION["locked"];
			if ($difference > 10){
				unset($_SESSION["locked"]);
				unset($_SESSION["login_attempts"]);
			}else{
				//echo "<script type='text/javascript'>window.location='https://www.google.com/'</script>";
			}
		}
	}
	public function test()
	{
		$this->load->view('welcome_message');
	}
}
