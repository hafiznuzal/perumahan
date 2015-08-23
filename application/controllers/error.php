<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Error extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

        $this->load->library('session');

		
	}
	public function index()
	{
		
		$this->load->view('error');
	}

}