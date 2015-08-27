<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detil_proyek extends CI_Controller
{
	
	public function __construct()
	{
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('session');
			$this->load->model('proyek_model');
			$this->load->model('berkas_model');
			$this->load->model('ijin_model');
			$this->load->model('pembangunan_model');
			if ($this->session->userdata('logged_in')) {
				$session_data=$this->session->userdata('logged_in');
				$this->sesi['tahun']=$session_data['tahun'];
				$this->sesi['bulan']=$session_data['periode'];
				$this->sesi['hak'] = $session_data['hak'];
				
			}
			else{
				$this->sesi['tahun']=getdate()['year'];
				$this->sesi['bulan']=getdate()['mon'];

			}

	}

	public function index($id_perumahan)
	{
		$this->load->view('template/admin_header',$this->sesi);
		$this->get_all($id_perumahan);
		$this->load->view('template/admin_footer');
	}
	
	public function get_all($id_perumahan)
	{

		$data['info'] = $this->proyek_model->get_data_info($id_perumahan)[0];
		$data['pembangunan'] = $this->proyek_model->get_data_pembangunan($id_perumahan);
		$data['ijin'] = $this->proyek_model->get_data_ijin($id_perumahan);
		$data['files']=$this->berkas_model->get_berkas($id_perumahan);
		$this->load->view('admin/admin_detil_proyek',$data);
	}

	public function refresh_berkas($id_perumahan)
	{
		$data['files']=$this->berkas_model->get_berkas($id_perumahan);
		echo json_encode($data['files']);
	}
	public function delete_pem($id_perumahan)
	{
		$this->pembangunan_model->delete($_GET['id']);
		$this->get_all($id_perumahan);
	}
	public function edit_pem($id_perumahan){
		
		$this->pembangunan_model->edit($_GET["id_pem"],
		$_GET["renc_rss"],
		$_GET["renc_rs"],
		$_GET["renc_rm"],
		$_GET["renc_mw"],
		$_GET["renc_ruko"],
		$_GET["real_rss"],
		$_GET["real_rs"],
		$_GET["real_rm"],
		$_GET["real_mw"],
		$_GET["real_ruko"],
		$_GET["catatan"]); 
		$this->get_all($id_perumahan);

	}
	public function delete_ijin($id_perumahan)
	{
		$this->ijin_model->delete($_GET['id']);
		$this->get_all($id_perumahan);
	}
	public function edit_ijin($id_perumahan)
	{
		$this->ijin_model->edit($_GET["id_ijin"],
		$_GET["no_ijin"],
		$_GET["tgl_ijin"], 
		$_GET["luas"], 
		$_GET["tapak"], 
		$_GET["pembebasan"],
		$_GET["terbangun"], 
		$_GET["belum_terbangun"], 
		$_GET["fs_dialokasikan"], 
		$_GET["fs_pembebasan"], 
		$_GET["fs_dimatangkan"], 
		$_GET["catatan"],
		$_GET["AktifPembangunan"],
		$_GET["AktifBerhenti"],
		$_GET["AktifSelesai"],
		$_GET["tidak_aktif"]);
		$this->get_all($id_perumahan);
	}
	public function tambah_ijin($id_perumahan)
	{
		$id_perumahan = $_GET["id_perumahan"];
		$id_kombinasi = $_GET["id_kombinasi"];
		$lokasi_no =   $_GET["lokasi_no"];
		$lokasi_tgl =   $_GET["lokasi_tgl"];
		$luas =   $_GET["luas"];
		$rencana_tapak =   $_GET["rencana_tapak"];
		$pembebasan =   $_GET["pembebasan"];
		$terbangun =  $_GET["terbangun"];
		$belum_terbangun =   $_GET["belum_terbangun"];
		$fs_dialokasikan =   $_GET["fs_dialokasikan"];
		$fs_pembebasan =   $_GET["fs_pembebasan"];
		$fs_sudah_dimatangkan =  $_GET["fs_sudah_dimatangkan"];
		$aktif_dlm_pembangunan =  $_GET["aktif_dlm_pembangunan"];
		$aktif_berhenti =  $_GET["aktif_berhenti"];
		$aktif_sdh_selesai =  $_GET["aktif_sdh_selesai"];
		$tidak_aktif =  $_GET["tidak_aktif"] ;
		$data['files']=$this->ijin_model->add($id_perumahan,$id_kombinasi,$lokasi_no,$lokasi_tgl,$luas,$rencana_tapak,$pembebasan,$terbangun
								,$belum_terbangun,$fs_dialokasikan,$fs_pembebasan,$fs_sudah_dimatangkan,$aktif_dlm_pembangunan,
								 $aktif_berhenti,$aktif_sdh_selesai,$tidak_aktif);
		echo json_encode($data['files']);

	}

	public function tambah_pembangunan($id_perumahan)
	{
		$id_perumahan = $_GET['id_perumahan'];
		$id_kombinasi = $_GET['id_kombinasi'];
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
		$session_data=$this->session->userdata('logged_in');
		$tahun=$session_data['tahun'];
		$periode=$session_data['periode'];
		$data['files']=$this->pembangunan_model->add($id_perumahan,$id_kombinasi,$id_lokasi,$renc_rss,$renc_rs,$renc_rm,$renc_mw,$renc_ruko,$real_rss,$real_rs,$real_rm,$real_mw,$real_ruko,$catatan,$tahun,$periode);
		echo json_encode($data['files']);
	}



  
}

