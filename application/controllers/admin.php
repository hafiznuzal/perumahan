<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Admin extends CI_Controller
{
	public $sesi;
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

        $this->load->library('session');
		$this->load->model('perumahan_model');
		$this->load->model('pengembang_model');
		$this->load->model('lokasi_model');
		$this->load->model('status_model');
		$this->load->model('gabungan_model');
		$this->load->model('proyek_model');
		if(!$this->session->userdata('logged_in')){
			redirect(site_url()."login");
		}
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
		if($this->session->userdata('logged_in')){
			$data['jumlah_pengembang'] = $this->gabungan_model->jumlah_pengembang();
			$data['jumlah_perumahan'] = $this->gabungan_model->jumlah_perumahan();
			$data['jumlah_lokasi'] = $this->gabungan_model->jumlah_lokasi();
			$data['jumlah_ijin_lokasi'] = $this->gabungan_model->jumlah_ijin_lokasi();
			$data['jumlah_pembangunan'] = $this->gabungan_model->jumlah_pembangunan();

			// echo $data['jumlah_pengembang'][0]->jumlah_pengembang;
			$this->load->view('template/admin_header',$this->sesi);
			$this->load->view('admin/admin_home', $data);
			$this->load->view('template/admin_footer');
		}
		else redirect(site_url()."admin/login");
	}
	public function updatePeriode()
	{
		if($this->session->userdata('logged_in')){
			$uri=$this->input->post('uri');
			
			$session_data=$this->session->userdata('logged_in');
			$session_data['tahun']=$this->input->post('tahun');
			$session_data['periode']=$this->input->post('periode');
			$this->session->set_userdata('logged_in', $session_data);
			redirect($uri);
		}
		else redirect(site_url()."admin/login");
	}
	
	public function logout() {
     	//remove all session data
     	$this->session->unset_userdata('logged_in');
     	$this->session->sess_destroy();
     	redirect(site_url()."login");
     }
	public function genre()
	{
		$data['genre'] = $this->genre_model->get_all();
		$this->load->view('template/admin_header',$this->sesi);
		$this->load->view('admin/admin_genre',$data);
		$this->load->view('template/admin_footer');
	}

	public function type()
	{
		$data['type'] = $this->type_model->get_all();
		$this->load->view('template/admin_header',$this->sesi);
		$this->load->view('admin/admin_type',$data);
		$this->load->view('template/admin_footer');
	}

	public function status()
	{
		$data['status'] = $this->status_model->get_all();
		$this->load->view('template/admin_header',$this->sesi);
		$this->load->view('admin/admin_status',$data);
		$this->load->view('template/admin_footer');
	}

	public function pengembang()
	{
		$data['daftar_pengembang'] = $this->pengembang_model->get_all();
		$this->load->view('template/admin_header',$this->sesi);
		$this->load->view('admin/admin_pengembang', $data);
		$this->load->view('template/admin_footer');
	}

	public function perumahan()
	{
		if($this->session->userdata('logged_in')){
			$data['daftar_perumahan'] = $this->perumahan_model->get_all();
			$data['daftar_lokasi'] = $this->perumahan_model->get_all_dummy();
			$data['daftar_pengembang'] = $this->perumahan_model->get_pengembang_dummy();
			$this->load->view('template/admin_header',$this->sesi);
			$this->load->view('admin/admin_perumahan', $data);
			$this->load->view('template/admin_footer');
		}
		else redirect(site_url()."admin/login");
	}

	public function pencarian()
	{
		$this->load->view('template/admin_header',$this->sesi);
		$this->load->view('admin/admin_pencarian');
		$this->load->view('template/admin_footer');
	}

	public function lokasi()
	{
		$data['daftar_lokasi'] = $this->lokasi_model->get_all();
		$data['daftar_kecamatan'] = $this->lokasi_model->get_all_kecamatan();
		$this->load->view('template/admin_header',$this->sesi);
		$this->load->view('admin/admin_lokasi', $data);
		$this->load->view('template/admin_footer');
	}

	public function report_lahan()
	{
		$this->load->model('proyek_model');
        $data['lokasi'] = $this->proyek_model->get_data_lokasi_all();
        $this->load->view('/admin/admin_report_lahan',$data);
	}

	public function report_pembangunan()
	{
        $data['pembangunan'] = $this->proyek_model->get_data_pembangunan_all();
        $this->load->view('/admin/admin_report_pembangunan',$data);
	}

	public function hasil()
	{
		if (!isset($_GET['berdasarkan']) && !isset($_GET['kata_kunci']))
		{
			redirect('/admin/pencarian');
		}
		else
		{
			$this->load->model('pencarian_model');
			$kata_kunci = $_GET['kata_kunci'];
			$berdasarkan = $_GET['berdasarkan'];

			$data['hasil_pencarian'] = $this->pencarian_model->get_hasil_pencarian($berdasarkan, $kata_kunci);
			$this->load->view('template/admin_header',$this->sesi);
			$this->load->view('admin/admin_hasil_pencarian', $data);
			$this->load->view('template/admin_footer');
		}
	}

	public function excels()
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'PEMBANGUNAN PERUMAHAN / PERMUKIMAN');
		$this->excel->getActiveSheet()->setCellValue('B2', 'DATA LAHAN PERUMAHAN / PERMUKIMAN');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18.29);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(45.43);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(19.43);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(9.86);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(25.71);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(17.29);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(13.57);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(17.14);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14.71);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15.29);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(17);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15.14);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(21.71);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(12.57);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(10.29);
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(8.71);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(6.43);

		$this->excel->getActiveSheet()->mergeCells('B1:T1');
		$this->excel->getActiveSheet()->mergeCells('B2:T2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('B7', "NO");
		$this->excel->getActiveSheet()->mergeCells('B7:B9');
		$this->excel->getActiveSheet()->setCellValue('C7', "PENGEMBANG / PELAKSANA PEMBANGUNAN PERUMAHAN");
		$this->excel->getActiveSheet()->mergeCells('C7:D9');
		$this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('E7', "LOKASI");
		$this->excel->getActiveSheet()->mergeCells('E7:E9');
		$this->excel->getActiveSheet()->setCellValue('F7', "IJIN LOKASI");
		$this->excel->getActiveSheet()->mergeCells('F7:H7');
		$this->excel->getActiveSheet()->setCellValue('F8', "JML IJIN LOKASI");
		$this->excel->getActiveSheet()->mergeCells('F8:F9');
		$this->excel->getActiveSheet()->getStyle('F8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('G8', "LOKASI TGL/NO");
		$this->excel->getActiveSheet()->mergeCells('G8:G9');
		$this->excel->getActiveSheet()->getStyle('G8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('H8', "LUAS (Ha)");
		$this->excel->getActiveSheet()->mergeCells('H8:H9');
		$this->excel->getActiveSheet()->getStyle('H8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('I7', "RENCANA TAPAK (Ha)");
		$this->excel->getActiveSheet()->mergeCells('I7:I9');
		$this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('J7', "PEMBEBASAN (Ha)");
		$this->excel->getActiveSheet()->mergeCells('J7:J9');
		$this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('K7', "TERBANGUN (Ha)");
		$this->excel->getActiveSheet()->mergeCells('K7:K9');
		$this->excel->getActiveSheet()->getStyle('K7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('L7', "BELUM TERBANGUN (Ha)");
		$this->excel->getActiveSheet()->mergeCells('L7:L9');
		$this->excel->getActiveSheet()->getStyle('L7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('M7', "FASILITAS SOSIAL (Ha)");
		$this->excel->getActiveSheet()->mergeCells('M7:O7');
		$this->excel->getActiveSheet()->setCellValue('M8', "DIALOKASIKAN");
		$this->excel->getActiveSheet()->mergeCells('M8:M9');
		$this->excel->getActiveSheet()->getStyle('M8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('N8', "PEMBEBASAN");
		$this->excel->getActiveSheet()->mergeCells('N8:N9');
		$this->excel->getActiveSheet()->getStyle('N8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('O8', "SUDAH DIMATANGKAN");
		$this->excel->getActiveSheet()->mergeCells('O8:O9');
		$this->excel->getActiveSheet()->getStyle('O8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->getStyle('P7:P9')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('P7', "CATATAN (PERPANJANGAN IJIN LOKASI)");
		$this->excel->getActiveSheet()->mergeCells('P7:P9');
			
		$this->excel->getActiveSheet()->setCellValue('Q7', "AKTIF DALAM PEMBANGUNAN");
		$this->excel->getActiveSheet()->mergeCells('Q7:Q9');
		$this->excel->getActiveSheet()->getStyle('Q7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('R7', "AKTIF BERHENTI");
		$this->excel->getActiveSheet()->mergeCells('R7:R9');
		$this->excel->getActiveSheet()->getStyle('R7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('S7', "AKTIF SUDAH SELESAI");
		$this->excel->getActiveSheet()->mergeCells('S7:S9');
		$this->excel->getActiveSheet()->getStyle('S7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('T7', "TIDAK AKTIF");
		$this->excel->getActiveSheet()->mergeCells('T7:T9');
		$this->excel->getActiveSheet()->getStyle('T7')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('I7', "RENCANA");
		$this->excel->getActiveSheet()->setCellValue('I8', "TAPAK");
		$this->excel->getActiveSheet()->setCellValue('I9', "(Ha)");
		$this->excel->getActiveSheet()->setCellValue('J7', "PEMBEBASAN");
		$this->excel->getActiveSheet()->setCellValue('J9', "(Ha)");
		$this->excel->getActiveSheet()->setCellValue('K7', "TERBANGUN");
		$this->excel->getActiveSheet()->setCellValue('K9', "(Ha)");
		$this->excel->getActiveSheet()->setCellValue('L7', "BELUM");
		$this->excel->getActiveSheet()->setCellValue('L8', "TERBANGUN");
		$this->excel->getActiveSheet()->setCellValue('L9', "(Ha)");
		$this->excel->getActiveSheet()->setCellValue('M7', "FASILITAS SOSIAL (Ha)");
		$this->excel->getActiveSheet()->mergeCells('M7:O7');
		$this->excel->getActiveSheet()->setCellValue('M8', "DIALOKASIKAN");
		$this->excel->getActiveSheet()->setCellValue('N8', "PEMBEBASAN");
		$this->excel->getActiveSheet()->setCellValue('O8', "SUDAH");
		$this->excel->getActiveSheet()->setCellValue('O8', "DIMATANGKAN");
		$this->excel->getActiveSheet()->setCellValue('P7', "CATATAN");
		$this->excel->getActiveSheet()->setCellValue('P8', "(PERPANJANGAN");
		$this->excel->getActiveSheet()->setCellValue('P9', "IJIN LOKASI)");
		$this->excel->getActiveSheet()->setCellValue('Q7', "AKTIF");
		$this->excel->getActiveSheet()->setCellValue('Q8', "DALAM PEM-");
		$this->excel->getActiveSheet()->setCellValue('Q9', "BANGUNAN");
		$this->excel->getActiveSheet()->setCellValue('R7', "AKTIF");
		$this->excel->getActiveSheet()->setCellValue('R8', "BERHENTI");
		$this->excel->getActiveSheet()->setCellValue('S7', "AKTIF");
		$this->excel->getActiveSheet()->setCellValue('S8', "SUDAH");
		$this->excel->getActiveSheet()->setCellValue('S9', "SELESAI");
		$this->excel->getActiveSheet()->setCellValue('T7', "TIDAK");
		$this->excel->getActiveSheet()->setCellValue('T8', "AKTIF");

		 
		$filename='just_some_random_name.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	public function printout_report_lahan()
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		//$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(18);
		//$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'Report Lahan');
		//$this->excel->getActiveSheet()->setCellValue('B2', 'DATA LAHAN PERUMAHAN / PERMUKIMAN');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(18.29);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(45.43);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(40.43);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(95.43);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30.43);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20.29);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(13.57);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(17.14);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14.71);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15.29);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(17);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15.14);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(21.71);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(12.57);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(10.29);
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(8.71);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(6.43);
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(6.43);

		$this->excel->getActiveSheet()->mergeCells('B1:T4');
		//$this->excel->getActiveSheet()->mergeCells('B2:T2');
		//$this->excel->getActiveSheet()->mergeCells('B1:B2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('B7', "No");
		$this->excel->getActiveSheet()->mergeCells('B7:B9');
		$this->excel->getActiveSheet()->setCellValue('C7', "Kecamatan");
		$this->excel->getActiveSheet()->mergeCells('C7:C9');
		$this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('D7', "Perusahaan");
		$this->excel->getActiveSheet()->mergeCells('D7:D9');
		//$this->excel->getActiveSheet()->setCellValue('F7', "IJIN LOKASI");
		//$this->excel->getActiveSheet()->mergeCells('F7:H7');
		$this->excel->getActiveSheet()->setCellValue('E7', "Nama Perumahaan");
		$this->excel->getActiveSheet()->mergeCells('E7:E9');
		$this->excel->getActiveSheet()->getStyle('E7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('F7', "Nama Lokasi");
		$this->excel->getActiveSheet()->mergeCells('F7:F9');
		$this->excel->getActiveSheet()->getStyle('F7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('G7', "No Lokasi");
		$this->excel->getActiveSheet()->mergeCells('G7:G9');
		$this->excel->getActiveSheet()->getStyle('G7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('H7', "Tanggal Lokasi Dimiliki");
		$this->excel->getActiveSheet()->mergeCells('H7:H9');
		$this->excel->getActiveSheet()->getStyle('H7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('I7', "Luas Lokasi");
		$this->excel->getActiveSheet()->mergeCells('I7:I9');
		$this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('J7', "Rencana Tapak");
		$this->excel->getActiveSheet()->mergeCells('J7:J9');
		$this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('K7', "Pembebasan");
		$this->excel->getActiveSheet()->mergeCells('K7:K9');
		$this->excel->getActiveSheet()->getStyle('K7')->getAlignment()->setWrapText(true);
		//$this->excel->getActiveSheet()->setCellValue('M7', "FASILITAS SOSIAL (Ha)");
		//$this->excel->getActiveSheet()->mergeCells('M7:O7');
		$this->excel->getActiveSheet()->setCellValue('L7', "Terbangun");
		$this->excel->getActiveSheet()->mergeCells('L7:L9');
		$this->excel->getActiveSheet()->getStyle('L7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('M7', "Belum Terbangun");
		$this->excel->getActiveSheet()->mergeCells('M7:M9');
		$this->excel->getActiveSheet()->getStyle('M7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('N7', "FS Dialokasikan");
		$this->excel->getActiveSheet()->mergeCells('N7:N9');
		$this->excel->getActiveSheet()->getStyle('N7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->getStyle('O7:O9')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('O7', "FS Pembebasan");
		$this->excel->getActiveSheet()->mergeCells('O7:O9');
			
		$this->excel->getActiveSheet()->setCellValue('P7', "FS Sudah Dimatangkan");
		$this->excel->getActiveSheet()->mergeCells('P7:P9');
		$this->excel->getActiveSheet()->getStyle('P7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('Q7', "Catatan");
		$this->excel->getActiveSheet()->mergeCells('Q7:Q9');
		$this->excel->getActiveSheet()->getStyle('Q7')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('R7', "Aktif dalam Pembangunan");
		$this->excel->getActiveSheet()->mergeCells('R7:R9');
		$this->excel->getActiveSheet()->getStyle('R7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('S7', "Aktif Berhenti");
		$this->excel->getActiveSheet()->mergeCells('S7:S9');
		$this->excel->getActiveSheet()->getStyle('S7')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('T7', "Aktif Sudah Selesai");
		$this->excel->getActiveSheet()->mergeCells('T7:T9');
		$this->excel->getActiveSheet()->getStyle('T7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('U7', "Tidak Aktif");
		$this->excel->getActiveSheet()->mergeCells('U7:U9');
		$this->excel->getActiveSheet()->getStyle('U7')->getAlignment()->setWrapText(true);
		
		$this->load->model('proyek_model');
        $data= $this->proyek_model->get_data_lokasi_all();
        $numCell=10;		
        foreach ($data as $i) {
        	$this->excel->getActiveSheet()->setCellValue('C'.$numCell, $i['nama_kecamatan']);
        	$this->excel->getActiveSheet()->setCellValue('D'.$numCell, $i['nama_perusahaan']);
        	$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $i['nama_perumahan']);
        	$this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['nama_lokasi']);
        	$this->excel->getActiveSheet()->setCellValue('G'.$numCell, $i['lokasi_no']);
        	$this->excel->getActiveSheet()->setCellValue('H'.$numCell, $i['lokasi_tgl']);
        	$this->excel->getActiveSheet()->setCellValue('I'.$numCell, $i['luas']);
        	$this->excel->getActiveSheet()->setCellValue('J'.$numCell, $i['rencana_tapak']);
        	$this->excel->getActiveSheet()->setCellValue('K'.$numCell, $i['pembebasan']);
        	$this->excel->getActiveSheet()->setCellValue('L'.$numCell, $i['terbangun']);
        	$this->excel->getActiveSheet()->setCellValue('M'.$numCell, $i['belum_terbangun']);
        	$this->excel->getActiveSheet()->setCellValue('N'.$numCell, $i['fs_dialokasikan']);
        	$this->excel->getActiveSheet()->setCellValue('O'.$numCell, $i['fs_pembebasan']);
        	$this->excel->getActiveSheet()->setCellValue('P'.$numCell, $i['fs_sudah_dimatangkan']);
        	$this->excel->getActiveSheet()->setCellValue('Q'.$numCell, $i['catatan']);
        	$this->excel->getActiveSheet()->setCellValue('R'.$numCell, $i['aktif_dlm_pembangunan']);
        	$this->excel->getActiveSheet()->setCellValue('S'.$numCell, $i['aktif_berhenti']);
        	$this->excel->getActiveSheet()->setCellValue('T'.$numCell, $i['aktif_sdh_selesai']);
        	$this->excel->getActiveSheet()->setCellValue('U'.$numCell, $i['tidak_aktif']);
        	
        	$numCell++;
        }
		 
		$filename='just_some_random_name.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}
}