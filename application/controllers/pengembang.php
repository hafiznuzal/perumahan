<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengembang extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('pengembang_model');

	}
	
	public function get_all()
	{
		$data['daftar_pengembang'] = $this->pengembang_model->get_all();
		$this->load->view('admin/admin_pengembang', $data);
	}

	public function add()
	{
		$nama = $_GET['nama_perusahaan'];
		$pimpinan = $_GET['pimpinan'];
		$alamat = $_GET['alamat'];
		$telp = $_GET['telp'];
		$fax = $_GET['fax'];
		$data['files']=$this->pengembang_model->add($nama,$pimpinan,$alamat,$telp,$fax);
		echo json_encode($data['files']);
	}

	public function edit()
	{
		$ID = $_GET['id_perusahaan'];
		$nama = $_GET['nama_perusahaan'];
		$pimpinan = $_GET['pimpinan'];
		$alamat = $_GET['alamat'];
		$telp = $_GET['telp'];
		$fax = $_GET['fax'];
		$this->pengembang_model->edit($ID,$nama,$pimpinan,$alamat,$telp,$fax);
		$this->get_all();
	}

	public function delete()
	{
		$ID = $_GET['id'];
		$this->pengembang_model->delete($ID);
		$this->get_all();
	}
}

