<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lokasi extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('lokasi_model');
	}

	public function index()
	{
		$this->load->view('template/admin_header');
		$this->get_all();
		$this->load->view('template/admin_footer');
	}
	
	public function get_all()
	{
		$data['daftar_lokasi'] = $this->lokasi_model->get_all();
		$data['daftar_kecamatan'] = $this->lokasi_model->get_all_kecamatan();
		$this->load->view('admin/admin_lokasi', $data);
	}

	public function delete($id)
	{
		// $this->get_all();		
	}

	public function add()
	{
		$nama = $_GET['nama_lokasi'];
		$latitude = $_GET['latitude'];
		$longitude = $_GET['longitude'];
		$id_kecamatan = $_GET['id_kecamatan'];
		$this->lokasi_model->add($nama, $longitude, $latitude, $id_kecamatan);
		$this->get_all();
	}

	public function edit()
	{
		$nama = $_GET['nama_lokasi'];
		$latitude = $_GET['latitude'];
		$longitude = $_GET['longitude'];
		$id_kecamatan = $_GET['id_kecamatan'];
		$id = $_GET['id'];
		$this->lokasi_model->edit($id, $nama, $longitude, $latitude, $id_kecamatan);
		$this->get_all();
	}
}

