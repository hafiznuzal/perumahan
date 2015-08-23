<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perumahan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('perumahan_model');
		$this->load->model('pembangunan_model');
		$this->load->model('proyek_model');
		$this->load->model('pembangunan_model');
		header("Access-Control-Allow-Origin: *");
		//header("Content-Type: application/json; charset=UTF-8");
	}
	
	public function get_json()
	{
		$tahun=$_GET['tahun'];
		$periode=$_GET['periode'];
		$json_data=$this->perumahan_model->get_json_data($tahun,$periode);
		$this->output
	    ->set_content_type('application/json')
	    ->set_output(json_encode($json_data));
	}
	public function get_ijin()
	{
		$id_perumahan=$_GET['id_perumahan'];
		$tahun=$_GET['tahun'];
		$periode=$_GET['periode'];
		$json_data=$this->proyek_model->get_ijin_json($id_perumahan,$tahun,$periode);
		$this->output
	    ->set_content_type('application/json')
	    ->set_output(json_encode($json_data));
	}	
	public function get_all()
	{
		$data['daftar_perumahan'] = $this->perumahan_model->get_all();
		$data['daftar_lokasi'] = $this->perumahan_model->get_all_dummy();
		$data['daftar_pengembang'] = $this->perumahan_model->get_pengembang_dummy();
		
		$this->load->view('admin/admin_perumahan', $data);
	}

	public function add()
	{
		//insert tabel kombinasi
		$lokasi = $_GET['lokasi'];
		$id_kombinasi = $this->perumahan_model->add_kombinasi($lokasi);
		
		//insert tabel perumahan
		$nama = $_GET['nama_perumahan'];
		$id_pengembang = $_GET['id_pengembang'];
		$id_perumahan = $this->perumahan_model->add($nama, $id_pengembang);

		//insert tabel ijin

		$datas = array(
			"id_perumahan" => $id_perumahan,
			"id_kombinasi" => $id_kombinasi,
			"lokasi_no" => $_GET["addNoIjin"],
			"lokasi_tgl" => $_GET["addTglIjin"],
			"luas" => $_GET["addLuasIjin"],
			"rencana_tapak" => $_GET["addRencanaTapakIjin"],
			"pembebasan" => $_GET["addPembebasanIjin"],
			"terbangun" => $_GET["addTerbangunIjin"],
			"belum_terbangun" => $_GET["addBelumTerbangunIjin"],
			"fs_dialokasikan" => $_GET["addFSAlokasiIjin"],
			"fs_pembebasan" => $_GET["addFSPembebasanIjin"],
			"fs_sudah_dimatangkan" => $_GET["addFSSudahMatangIjin"],
			"catatan" => $_GET["addCatatanIjin"],
			"aktif_dlm_pembangunan" => $_GET["addAktifPembangunanIjin"],
			"aktif_berhenti" => $_GET["addAktifBerhentiIjin"],
			"aktif_sdh_selesai" => $_GET["addAktifSelesaiIjin"],
			"tidak_aktif" => $_GET["addTidakAktifIjin"]
		);
		$this->perumahan_model->insert_ijin($datas);
		
		//insert tabel pembangunan
		$session_data =$this->session->userdata('logged_in');
		$tahun=$session_data['tahun'];
		$periode=$session_data['periode'];

		if(isset($_GET['mode']) && $_GET['mode']=="import")
		{
			$id_perumahan = $id_perumahan;
			$id_kombinasi = $id_kombinasi;
			$id_lokasi    = $_GET['id_lokasi'];
			$renc_rss     = $_GET['renc_rss'];
			$renc_rs      = $_GET['renc_rs'];
			$renc_rm      = $_GET['renc_rm'];
			$renc_mw      = $_GET['renc_mw'];      
			$renc_ruko    = $_GET['renc_ruko'];
			$real_rss     = $_GET['real_rss'];
			$real_rs      = $_GET['real_rs'];
			$real_rm      = $_GET['real_rm'];
			$real_mw      = $_GET['real_mw'];
			$real_ruko    = $_GET['real_ruko'];
			$catatan      = $_GET['catatan'];
			

			$this->pembangunan_model->add($id_perumahan,$id_kombinasi,$id_lokasi,$renc_rss,$renc_rs,$renc_rm,$renc_mw,$renc_ruko,$real_rss,$real_rs,$real_rm,$real_mw,$real_ruko,$catatan,$tahun,$periode);			
		}
		else $this->pembangunan_model->add($id_perumahan,$id_kombinasi,$lokasi,"","","","","","","","","","","",$tahun,$periode);			
		$this->get_all();
	}

	public function edit()
	{
		$ID = $_GET['id'];
		$name = $_GET['nama_perumahan'];
		$this->perumahan_model->edit($ID,$name);
		$this->get_all();
	}

	public function delete()
	{
		$ID = $_GET['id'];
		$this->perumahan_model->delete($ID);
		$this->get_all();
	}
}