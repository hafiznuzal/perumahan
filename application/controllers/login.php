<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

        $this->load->library('session');
		
		
		if ($this->session->userdata('logged_in')) {
			$session_data=$this->session->userdata('logged_in');
			$this->sesi['tahun']=$session_data['tahun'];
			$this->sesi['bulan']=$session_data['periode'];
			
		}
		else{
			$this->sesi['tahun']=getdate()['year'];
			$this->sesi['bulan']=getdate()['mon'];

		}

		
	}
	public function index()
	{
		$login['loginStat']=$this->input->get('login');
		$this->load->view('template/admin_header_login',$this->sesi);
		$this->load->view('login',$login);
	}

}