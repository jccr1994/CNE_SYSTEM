<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	function __construct() {
        parent::__construct();
        //$this->load->model('Proveedor_model');
    }
	public function index()
	{
		redirect(base_url("index.php/Home/inicio"));
	}
	public function inicio()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_proveedor');
		$this->load->view('footer');
	}
	public function certmultiple()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_certmultiple');
		$this->load->view('footer');
	}
	public function genreceta()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_receta');
		$this->load->view('footer');
	}
}
