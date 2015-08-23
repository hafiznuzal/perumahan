<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{
	public $sesi;
	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('proyek_model');
		$this->load->model('berkas_model');
		$this->load->model('ijin_model');
		$this->load->model('pembangunan_model');
		$this->load->model('m_report');
		$this->load->library("Pdf");
        $this->load->library("tcpdf/tcpdf");
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

	public function index($tahun,$periode)
	{
		$this->sesi['tahun']=$tahun;
		$this->sesi['bulan']=$periode;
		
		$this->load->view('template/admin_header',$this->sesi);
		$this->get_all($tahun,$periode);
		$this->load->view('template/admin_footer');
	}
	public function laporan_chart()
	{
		//$this->sesi['tahun']=$tahun;
		$this->load->view('template/admin_header',$this->sesi);
		$data['mychart'] = $this->m_report->report_chart();		
		$this->load->view('admin/admin_chart',$data);
		$this->load->view('template/admin_footer');
	}
	public function back_up()
	{
		
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'perumahan';
		// $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
		// if(! $conn )
		// {
		//   die('Could not connect: ' . mysqli_error());
		// }
		// $table_name = "perumahan";
		$backup_file  = "../controllers/tmp/perumahan.sql";
		// $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
		// $result = mysqli_query($conn,$sql);
		// echo $result;
		
		$command='mysqldump --opt -h' .$dbhost .' -u' .$dbuser .' -p' .$dbpass .' ' .$dbname .' > ~/' .$backup_file;
        exec($command);

		// echo "Backedup  data successfully\n";
		//mysqli_close($conn);
		
	}

	public function back_up1()
	{
		include('dumper.php');

		try {
			$world_dumper = Shuttle_Dumper::create(array(
			    'host' => 'localhost',
			    'username' => 'root',
			    'password' => '',
			    'db_name' => 'perumahan',
			));
			// dump the database to plain text file
			$world_dumper->dump('perumahan.sql');

			// send the output to gziped file:
			//$world_dumper->dump('perumahan.gz');

		}
			catch(Shuttle_Exception $e){
			echo "Couldn't dump database: " . $e->getMessage();
			}
	}
	
	public function back_up2()
	{
				//ENTER THE RELEVANT INFO BELOW
		 //ENTER THE RELEVANT INFO BELOW
        $mysqlDatabaseName ='perumahan';
        $mysqlUserName ='root';
        $mysqlPassword ='';
        $mysqlHostName ='localhost';
        $mysqlExportPath ='perumahanex.sql';

        //DO NOT EDIT BELOW THIS LINE
        //Export the database and output the status to the page
        $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ~/' .$mysqlExportPath;
        exec($command);

		
	}





		
	public function statistic_pembangunan($tahun,$periode)
	{
		$data= $this->m_report->tabel_statistik2_rencana($tahun,$periode);
        $data1= $this->m_report->tabel_statistik2_realisasi($tahun,$periode);
	}

	public function report_pembangunan($tahun)
	{
		$this->sesi['tahun']=$tahun;
		
		
		$this->load->view('template/admin_header',$this->sesi);
		$data['pembangunan'] = $this->proyek_model->get_data_pembangunan_periode($tahun);		
		$this->load->view('admin/admin_report_pembangunan',$data);
		$this->load->view('template/admin_footer');
	}


	public function report_Pembangunan_Perkecamatan($id,$tahun,$periode)
	{
		$this->sesi['tahun']=$tahun;
		$this->sesi['bulan']=$periode;
		$this->sesi['id']=$id;
		$this->load->view('template/admin_header',$this->sesi);
		$data['value']= $this->m_report->tabel_report_kecamatan_value($id,$tahun,$periode);
        $data['kecamatan']= $this->m_report->kecamatan_get_all();
        $this->load->view('admin/admin_report_pembangunan_perkecamatan',$data);
		$this->load->view('template/admin_footer');
	}

	public function rekapitulasi_Pembangunan_kecamatan($tahun,$periode)
	{
		$this->sesi['tahun']=$tahun;
		$this->sesi['bulan']=$periode;
		//$this->sesi['id']=$id;
		$this->load->view('template/admin_header',$this->sesi);
		$data['value']= $this->m_report->tabel_pembangunan_kecamatan_all($tahun,$periode);
        //$data['kecamatan']= $this->m_report->kecamatan_get_all();
        $this->load->view('admin/admin_rekapitulasi_pembangunan_kecamatan',$data);
		$this->load->view('template/admin_footer');
	}
	


	public function report_lahan($tahun)
	{
		$this->sesi['tahun']=$tahun;
		
		$this->load->view('template/admin_header',$this->sesi);
		$data['lahan']= $this->proyek_model->get_data_lokasi_periode($tahun);
		$this->load->view('admin/admin_report_lahan',$data);
		$this->load->view('template/admin_footer');
	}

	public function report_lahan_Perkecamatan($id,$tahun,$periode)
	{
		$this->sesi['tahun']=$tahun;
		$this->sesi['bulan']=$periode;
		$this->sesi['id']=$id;
		$this->load->view('template/admin_header',$this->sesi);
		
		$data['kecamatan']= $this->m_report->kecamatan_get_all();
        $data['value']= $this->m_report->lahan_perkecamatan_value($id,$tahun,$periode);
        $this->load->view('admin/admin_report_lahan_perkecamatan',$data);
		$this->load->view('template/admin_footer');
	}

	public function rekapitulasi_lahan_kecamatan($tahun,$periode)
	{
		$this->sesi['tahun']=$tahun;
		$this->sesi['bulan']=$periode;
		//$this->sesi['id']=$id;
		$this->load->view('template/admin_header',$this->sesi);
		
		$nilai = $this->m_report->jumlah_kecamatan();
		foreach ($nilai as $nil)
		{
			$jmlkec = $nil['JUMLAH'];
			$data['jumlah'] = $nil['JUMLAH'];
		}

		for ($j=1; $j <= $jmlkec ; $j++)
		{

	        $data['lah_kec'][$j]= $this->m_report->tabel_lahan_kecamatan_all($j,$tahun,$periode);
	        $data['aktifpemb'][$j]= $this->m_report->aktif_dalam_pembangunan($j,$tahun,$periode);
	        $data['aktifber'][$j]= $this->m_report->aktif_berhenti($j,$tahun,$periode);
	        $data['aktifsel'][$j]= $this->m_report->aktif_sdh_selesai($j,$tahun,$periode);
	        $data['tdkaktif'][$j]= $this->m_report->tidak_aktif($j,$tahun,$periode);

		}	
		
		//print_r($data['lah_kec'][1]);
        $this->load->view('admin/admin_rekapitulasi_lahan_kecamatan',$data);
		$this->load->view('template/admin_footer');
	}

	public function get_all($tahun,$periode)
	{
		$data['pembangunan'] = $this->proyek_model->get_data_pembangunan_periode($tahun,$periode);
		
		$this->load->view('admin/admin_report_pembangunan',$data);
	}

	public function printout_report_pembangunan_excel($tahun)
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN');
		$this->excel->getActiveSheet()->setCellValue('B3', 'DATA LAHAN PERUMAHAN / PERMUKIMAN');

		


		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25.71);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(22.14);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(18.29);																																								
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(16.29);

		/**autosize*/
//for ($col = 'A'; $col != 'P'; $col++) {
//    $this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
//}	

		$this->excel->getActiveSheet()->mergeCells('B1:Q2');
		$this->excel->getActiveSheet()->mergeCells('B3:Q4');
		//$this->excel->getActiveSheet()->mergeCells('B1:B2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('B5', "Propinsi");
		$this->excel->getActiveSheet()->mergeCells('B5:C5');
		$this->excel->getActiveSheet()->setCellValue('D5', ": Jawa Timur");

		$this->excel->getActiveSheet()->setCellValue('B6', "Kabupaten");
		$this->excel->getActiveSheet()->mergeCells('B6:C6');
		$this->excel->getActiveSheet()->setCellValue('D6', ": Sidoarjo");

		$this->excel->getActiveSheet()->setCellValue('O5', "Periode ");
		$this->excel->getActiveSheet()->mergeCells('O5:P5');
		$this->excel->getActiveSheet()->setCellValue('Q5', ": Jan-Des $tahun");
		//$this->excel->getActiveSheet()->mergeCells('Q5:R5');

		
		

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
		$this->excel->getActiveSheet()->setCellValue('G7', "Rencana RSS");
		$this->excel->getActiveSheet()->mergeCells('G7:G9');
		$this->excel->getActiveSheet()->getStyle('G7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('H7', "Rencana RS");
		$this->excel->getActiveSheet()->mergeCells('H7:H9');
		$this->excel->getActiveSheet()->getStyle('H7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('I7', "Rencana RM");
		$this->excel->getActiveSheet()->mergeCells('I7:I9');
		$this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('J7', "Rencana MW");
		$this->excel->getActiveSheet()->mergeCells('J7:J9');
		$this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('K7', "Rencana Ruko");
		$this->excel->getActiveSheet()->mergeCells('K7:K9');
		$this->excel->getActiveSheet()->getStyle('K7')->getAlignment()->setWrapText(true);
		//$this->excel->getActiveSheet()->setCellValue('M7', "FASILITAS SOSIAL (Ha)");
		//$this->excel->getActiveSheet()->mergeCells('M7:O7');
		$this->excel->getActiveSheet()->setCellValue('L7', "Realisasi RSS");
		$this->excel->getActiveSheet()->mergeCells('L7:L9');
		$this->excel->getActiveSheet()->getStyle('L7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('M7', "Realisasi RS");
		$this->excel->getActiveSheet()->mergeCells('M7:M9');
		$this->excel->getActiveSheet()->getStyle('M7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('N7', "Realisasi RM");
		$this->excel->getActiveSheet()->mergeCells('N7:N9');
		$this->excel->getActiveSheet()->getStyle('N7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->getStyle('O7:O9')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('O7', "Realisasi MW");
		$this->excel->getActiveSheet()->mergeCells('O7:O9');
			
		$this->excel->getActiveSheet()->setCellValue('P7', "Realisasi Ruko");
		$this->excel->getActiveSheet()->mergeCells('P7:P9');
		$this->excel->getActiveSheet()->getStyle('P7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('Q7', "Catatan");
		$this->excel->getActiveSheet()->mergeCells('Q7:Q9');
		$this->excel->getActiveSheet()->getStyle('Q7')->getAlignment()->setWrapText(true);

		$this->load->model('proyek_model');
        $data= $this->proyek_model->get_data_pembangunan_periode($tahun);
        $numCell=10;		
        $no=1;		
        foreach ($data as $i) {
        	$this->excel->getActiveSheet()->setCellValue('B'.$numCell, $no);
        	$this->excel->getActiveSheet()->setCellValue('C'.$numCell, $i['nama_kecamatan']);
        	$this->excel->getActiveSheet()->setCellValue('D'.$numCell, $i['nama_perusahaan']);
        	$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $i['nama_perumahan']);
        	$this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['nama_lokasi']);
        	$this->excel->getActiveSheet()->setCellValue('G'.$numCell, $i['renc_rss']);
        	$this->excel->getActiveSheet()->setCellValue('H'.$numCell, $i['renc_rs']);
        	$this->excel->getActiveSheet()->setCellValue('I'.$numCell, $i['renc_rm']);
        	$this->excel->getActiveSheet()->setCellValue('J'.$numCell, $i['renc_mw']);
        	$this->excel->getActiveSheet()->setCellValue('K'.$numCell, $i['renc_ruko']);
        	$this->excel->getActiveSheet()->setCellValue('L'.$numCell, $i['real_rss']);
        	$this->excel->getActiveSheet()->setCellValue('M'.$numCell, $i['real_rs']);
        	$this->excel->getActiveSheet()->setCellValue('N'.$numCell, $i['real_rm']);
        	$this->excel->getActiveSheet()->setCellValue('O'.$numCell, $i['real_mw']);
        	$this->excel->getActiveSheet()->setCellValue('P'.$numCell, $i['real_ruko']);
        	$this->excel->getActiveSheet()->setCellValue('Q'.$numCell, $i['catatan']);
        	
        	//$this->excel->getActiveSheet()->getRowDimension($numCell)->setRowHeight(-1);
        	$numCell++;
        	$no++;
        }
         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

   		/** Borders for outside border */
   		$this->excel->getActiveSheet()->getStyle('B10'.':'.'B'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C10'.':'.'C'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D10'.':'.'D'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E10'.':'.'E'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('F10'.':'.'F'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G10'.':'.'G'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H10'.':'.'H'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('I10'.':'.'I'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('J10'.':'.'J'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('K10'.':'.'K'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('L10'.':'.'L'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('M10'.':'.'M'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('N10'.':'.'N'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('O10'.':'.'O'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('P10'.':'.'P'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('Q10'.':'.'Q'.($numCell))->applyFromArray($BStyle);

        
        $data= $this->m_report->tabel_statistik2_rencana($tahun);
        $data1= $this->m_report->tabel_statistik2_realisasi($tahun);
        $dataS= $this->m_report->tabel_statistik2_rencana($tahun-1);
        $data1S= $this->m_report->tabel_statistik2_realisasi($tahun-1);

        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+4), "TYPE RUMAH");
        	$this->excel->getActiveSheet()->mergeCells('D'.($numCell+4).':'.'D'.($numCell+5));
			$this->excel->getActiveSheet()->getStyle('D'.($numCell+4))->getAlignment()->setWrapText(true);

        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+6), "RSS 	: TYPE 21-27");
        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+7), "RS 		: TYPE 36-70");
        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+8), "RM 		: TYPE 70-125");
        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+9), "MW 	: TYPE >125");
        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+10), "RUKO");
        	//$this->excel->getActiveSheet()->setCellValue('B'.($numCell+8), "JUMLAH");

        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+4), "RENCANA PENGADAAN (UNIT)");
        	$this->excel->getActiveSheet()->mergeCells('E'.($numCell+4).':'.'F'.($numCell+4));
			$this->excel->getActiveSheet()->getStyle('E'.($numCell+4))->getAlignment()->setWrapText(true);

			$this->excel->getActiveSheet()->setCellValue('G'.($numCell+4), "REALISASI PENGADAAN (UNIT)");
        	$this->excel->getActiveSheet()->mergeCells('G'.($numCell+4).':'.'J'.($numCell+4));
			$this->excel->getActiveSheet()->getStyle('G'.($numCell+4))->getAlignment()->setWrapText(true);


			$lastyear=$tahun-1;
			$this->excel->getActiveSheet()->setCellValue('E'.($numCell+5), "Des $tahun");
			$this->excel->getActiveSheet()->setCellValue('G'.($numCell+5), "Des $tahun");
			$this->excel->getActiveSheet()->setCellValue('F'.($numCell+5), "Des $lastyear");
			$this->excel->getActiveSheet()->setCellValue('I'.($numCell+5), "Des $lastyear");

			/** border statistic **/
	   		$this->excel->getActiveSheet()->getStyle('D'.($numCell+5).':'.'D'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('E'.($numCell+5).':'.'E'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('F'.($numCell+5).':'.'F'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('G'.($numCell+5).':'.'G'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('H'.($numCell+5).':'.'H'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('I'.($numCell+5).':'.'I'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('J'.($numCell+5).':'.'J'.($numCell+10))->applyFromArray($BStyle);

   			/**MERGE CELL STATISTIK**/
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+5).':'.'H'.($numCell+5));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+6).':'.'H'.($numCell+6));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+7).':'.'H'.($numCell+7));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+8).':'.'H'.($numCell+8));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+9).':'.'H'.($numCell+9));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+10).':'.'H'.($numCell+10));
   			
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+5).':'.'J'.($numCell+5));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+6).':'.'J'.($numCell+6));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+7).':'.'J'.($numCell+7));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+8).':'.'J'.($numCell+8));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+9).':'.'J'.($numCell+9));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+10).':'.'J'.($numCell+10));

        	
        	foreach ($data as $key) {
        		$this->excel->getActiveSheet()->setCellValue('E'.($numCell+6), $key['RENC_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+7), $key['RENC_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+8), $key['RENC_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+9), $key['RENC_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+10), $key['RENC_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
	        	
        	}

        	foreach ($data1 as $key) {
        		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+6), $key['REAL_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+7), $key['REAL_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+8), $key['REAL_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+9), $key['REAL_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+10), $key['REAL_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
	        }

	        foreach ($dataS as $key) {
        		$this->excel->getActiveSheet()->setCellValue('F'.($numCell+6), $key['RENC_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+7), $key['RENC_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+8), $key['RENC_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+9), $key['RENC_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('F'.($numCell+10), $key['RENC_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
	        	
        	}

        	foreach ($data1S as $key) {
        		$this->excel->getActiveSheet()->setCellValue('I'.($numCell+6), $key['REAL_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+7), $key['REAL_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+8), $key['REAL_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+9), $key['REAL_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+10), $key['REAL_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
	        }


		/** Borders for heading */
   		$this->excel->getActiveSheet()->getStyle('B7:Q9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
   		$this->excel->getActiveSheet()->getStyle('D'.($numCell+4).':'.'J'.($numCell+5))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

   		/** Set wrap Text **/
   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'Q'.($numCell+12)) ->getAlignment()->setWrapText(true); 

		$filename='Report_Pembangunan_Kabupaten_Sidoarjo_'.$tahun.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}
	public function printout_report_pembangunan_perkecamatan_excel($id,$tahun,$periode)
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN');
		$this->excel->getActiveSheet()->setCellValue('B3', 'DATA PEMBANGUNAN RUMAH');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(45.71);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(16.29);
		

		$this->excel->getActiveSheet()->mergeCells('B1:O2');
		$this->excel->getActiveSheet()->mergeCells('B3:O4');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		


		$this->excel->getActiveSheet()->setCellValue('B7', "NO");
		$this->excel->getActiveSheet()->mergeCells('B7:B8');
		$this->excel->getActiveSheet()->setCellValue('C7', "PERUSAHAAN");
		$this->excel->getActiveSheet()->mergeCells('C7:C8');
		$this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('D7', "LOKASI");
		$this->excel->getActiveSheet()->mergeCells('D7:D8');
		

		$this->excel->getActiveSheet()->mergeCells('E7:I7');
		$this->excel->getActiveSheet()->setCellValue('E7', "RENCANA PENGADAAN");		
		$this->excel->getActiveSheet()->setCellValue('E8', "RS");
		$this->excel->getActiveSheet()->setCellValue('F8', "RSS");
		$this->excel->getActiveSheet()->setCellValue('G8', "RM");
		$this->excel->getActiveSheet()->setCellValue('H8', "MW");
		$this->excel->getActiveSheet()->setCellValue('I8', "RUKO");

		$this->excel->getActiveSheet()->setCellValue('J7', "REALISASI");
		$this->excel->getActiveSheet()->mergeCells('J7:N7');		
		
		$this->excel->getActiveSheet()->setCellValue('J8', "RS");
		$this->excel->getActiveSheet()->setCellValue('K8', "RSS");
		$this->excel->getActiveSheet()->setCellValue('L8', "RM");
		$this->excel->getActiveSheet()->setCellValue('M8', "MW");
		$this->excel->getActiveSheet()->setCellValue('N8', "RUKO");

		$this->excel->getActiveSheet()->setCellValue('O7', "CATATAN");
		$this->excel->getActiveSheet()->mergeCells('O7:O8');


		$this->load->model('m_report');
        //$data= $this->m_report->tabel_report_kecamatan_dataperusahaan($id,$tahun,$periode);
        $data1= $this->m_report->tabel_report_kecamatan_value($id,$tahun,$periode);
        $no=1;
        $numCell=9;	
        foreach ($data1 as $i)
		{

			$this->excel->getActiveSheet()->setCellValue('B'.$numCell, $no);
			//$this->excel->getActiveSheet()->mergeCells('B'.$numCell.':'.'B'.($numCell+4));
			$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Nama Perusahaan  : '.$i['NAMA_PERUSAHAAN']);
           	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'Pimpinan  : '. $i['PIMPINAN']);
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'Alamat  : '. $i['ALAMAT']);
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'Telepon  : '.$i['TELP']);
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4),'Fax  : ' .$i['FAX']);

        	$this->excel->getActiveSheet()->setCellValue('D'.$numCell, $i['LOKASI']);
        	$this->excel->getActiveSheet()->mergeCells('D'.$numCell.':'.'D'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $i['RENC_RSS']);
        	$this->excel->getActiveSheet()->mergeCells('E'.$numCell.':'.'E'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['RENC_RS']);
        	$this->excel->getActiveSheet()->mergeCells('F'.$numCell.':'.'F'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('G'.$numCell, $i['RENC_RM']);
        	$this->excel->getActiveSheet()->mergeCells('G'.$numCell.':'.'G'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('H'.$numCell, $i['RENC_MW']);
        	$this->excel->getActiveSheet()->mergeCells('H'.$numCell.':'.'H'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('I'.$numCell, $i['RENC_RUKO']);
        	$this->excel->getActiveSheet()->mergeCells('I'.$numCell.':'.'I'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('J'.$numCell, $i['REAL_RSS']);
        	$this->excel->getActiveSheet()->mergeCells('J'.$numCell.':'.'J'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('K'.$numCell, $i['REAL_RS']);
        	$this->excel->getActiveSheet()->mergeCells('K'.$numCell.':'.'K'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('L'.$numCell, $i['REAL_RM']);
        	$this->excel->getActiveSheet()->mergeCells('L'.$numCell.':'.'L'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('M'.$numCell, $i['REAL_MW']);
        	$this->excel->getActiveSheet()->mergeCells('M'.$numCell.':'.'M'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('N'.$numCell, $i['REAL_RUKO']);
        	$this->excel->getActiveSheet()->mergeCells('N'.$numCell.':'.'N'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('O'.$numCell, $i['CATATAN']);
        	$this->excel->getActiveSheet()->mergeCells('O'.$numCell.':'.'O'.($numCell+4));
        	
        	$numCell=$numCell+6;
        	$no++;
        	
        	
        }

         /** Borders for outside border */
         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
   		$this->excel->getActiveSheet()->getStyle('B9'.':'.'B'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C9'.':'.'C'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D9'.':'.'D'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E9'.':'.'E'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('F9'.':'.'F'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G9'.':'.'G'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H9'.':'.'H'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('I9'.':'.'I'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('J9'.':'.'J'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('K9'.':'.'K'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('L9'.':'.'L'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('M9'.':'.'M'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('N9'.':'.'N'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('O9'.':'.'O'.($numCell))->applyFromArray($BStyle);
        /** Set wrap Text **/
   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'O'.($numCell)) ->getAlignment()->setWrapText(true); 
   		/** Borders for heading */
   		$this->excel->getActiveSheet()->getStyle('B7:O8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


   		$kecamatan= $this->m_report->get_kecamatan($id);
   		foreach ($kecamatan as $key) 
   		{
   			$getkecamatan = $key['NAMA_KECAMATAN'];
   		}
   		$this->excel->getActiveSheet()->setCellValue('B5', "Propinsi");
		$this->excel->getActiveSheet()->mergeCells('B5:C5');
		$this->excel->getActiveSheet()->setCellValue('D5', ": Jawa Timur");

		$this->excel->getActiveSheet()->setCellValue('B6', "Kabupaten");
		$this->excel->getActiveSheet()->mergeCells('B6:C6');
		$this->excel->getActiveSheet()->setCellValue('D6', ": Sidoarjo");

		$this->excel->getActiveSheet()->setCellValue('M5', "Periode ");
		$this->excel->getActiveSheet()->mergeCells('M5:N5');
		$this->excel->getActiveSheet()->setCellValue('O5', ": Triwulan $periode $tahun");

		$this->excel->getActiveSheet()->setCellValue('M6', "Kecamatan ");
		$this->excel->getActiveSheet()->mergeCells('M6:N6');
		$this->excel->getActiveSheet()->setCellValue('O6', ": $getkecamatan");
		$this->excel->getActiveSheet()->mergeCells('O6:P6');
		$filename='Report_Pembangunan_Perkecamatan_'.$getkecamatan.'_Triwulan'.$periode.'_'.$tahun.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}


	public function printout_report_lahan_excel($tahun)
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'REKAPITULASI PERTAHUN');
		$this->excel->getActiveSheet()->setCellValue('B3', 'DATA LAHAN PERUMAHAN / PERMUKIMAN');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15.50);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(12.50);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(8.71);
		$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(8.5);

		$this->excel->getActiveSheet()->mergeCells('B1:T2');
		$this->excel->getActiveSheet()->mergeCells('B3:T4');
		//$this->excel->getActiveSheet()->mergeCells('B1:B2');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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

		$this->excel->getActiveSheet()->setCellValue('N7', "Fasilitas Sosial (Ha)");
		$this->excel->getActiveSheet()->mergeCells('N7:P7');

		$this->excel->getActiveSheet()->setCellValue('N8', "Dialokasikan");
		$this->excel->getActiveSheet()->mergeCells('N8:N9');
		$this->excel->getActiveSheet()->getStyle('N8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->getStyle('O8:O9')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('O8', "Pembebasan");
		$this->excel->getActiveSheet()->mergeCells('O8:O9');
			
		$this->excel->getActiveSheet()->setCellValue('P8', "Sudah Dimatangkan");
		$this->excel->getActiveSheet()->mergeCells('P8:P9');
		$this->excel->getActiveSheet()->getStyle('P8')->getAlignment()->setWrapText(true);
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
		$data= $this->proyek_model->get_data_lokasi_periode($tahun);

        $no=1;
        $numCell=10;		
        foreach ($data as $i) {
        	$this->excel->getActiveSheet()->setCellValue('B'.$numCell, $no);
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
        	
        	$no++;
        	$numCell++;

        }

        $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

   		/** Borders for outside border */
   		$this->excel->getActiveSheet()->getStyle('B10'.':'.'B'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C10'.':'.'C'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D10'.':'.'D'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E10'.':'.'E'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('F10'.':'.'F'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G10'.':'.'G'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H10'.':'.'H'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('I10'.':'.'I'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('J10'.':'.'J'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('K10'.':'.'K'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('L10'.':'.'L'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('M10'.':'.'M'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('N10'.':'.'N'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('O10'.':'.'O'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('P10'.':'.'P'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('Q10'.':'.'Q'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('R10'.':'.'R'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('S10'.':'.'S'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('T10'.':'.'T'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('U10'.':'.'U'.($numCell))->applyFromArray($BStyle);

        $this->load->model('m_report');
       // $data= $this->m_report->tabel_pengembang($tahun);
        $data1= $this->m_report->tabel_statistik1($tahun);
        	
        	$numCell=$numCell+1;


        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2), "Jumlah Pengembang");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3), "Ijin Lokasi");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4), "Luas Ijin Lokasi");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5), "Rencana Tapak");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6), "Pembebasan");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7), "Terbangun");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), "Belum Terbangun");

        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+1), "Des 2014");

        	foreach ($data1 as $key) {
        		$this->excel->getActiveSheet()->setCellValue('D'.($numCell+2), $key['PENGEMBANG']);
        		$this->excel->getActiveSheet()->setCellValue('D'.($numCell+3), $key['IJIN_LOKASI']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+4), $key['LUAS_IJIN_LOKASI']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+5), $key['RENCANA_TAPAK']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+6), $key['PEMBEBASAN']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+7), $key['TERBANGUN']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+8), $key['BELUM_TERBANGUN']);
	        	
        	}

        
   		$this->excel->getActiveSheet()->setCellValue('B5', "Propinsi");
		$this->excel->getActiveSheet()->mergeCells('B5:C5');
		$this->excel->getActiveSheet()->setCellValue('D5', ": Jawa Timur");

		$this->excel->getActiveSheet()->setCellValue('B6', "Kabupaten");
		$this->excel->getActiveSheet()->mergeCells('B6:C6');
		$this->excel->getActiveSheet()->setCellValue('D6', ": Sidoarjo");

		$this->excel->getActiveSheet()->setCellValue('P5', "Periode ");
		$this->excel->getActiveSheet()->mergeCells('P5:Q5');
		$this->excel->getActiveSheet()->setCellValue('R5', ": Jan-Des $tahun");
		$this->excel->getActiveSheet()->mergeCells('R5:S5');
		
        	
        /** Set wrap Text **/
   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'U'.($numCell+8)) ->getAlignment()->setWrapText(true); 	
        	
        	
        /** Borders for heading */
   		$this->excel->getActiveSheet()->getStyle('B7:U9')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
   		 	
         $filename='Report_Lahan_Kabupaten_Sidoarjo_'.$tahun.'.xls'; //save our workbook as this file name
		 header('Content-Type: application/vnd.ms-excel'); //mime type
		 header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		 header('Cache-Control: max-age=0');
		 $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		 $objWriter->save('php://output');
	}
	public function printout_report_lahan_perkecamatan_excel($id,$tahun,$periode)
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'PEMBANGUNAN PERUMAHAN / PERMUKIMAN');
		$this->excel->getActiveSheet()->setCellValue('B3', 'DATA LAHAN PERUMAHAN / PERMUKIMAN');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(45.71);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(9.50);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(9.50);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(9.50);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(8.50);
		$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(8.50);
		

		$this->excel->getActiveSheet()->mergeCells('B1:R1');
		$this->excel->getActiveSheet()->mergeCells('B3:R4');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('B7', "NO");
		$this->excel->getActiveSheet()->mergeCells('B7:B8');
		$this->excel->getActiveSheet()->setCellValue('C7', "PENGEMBANG / PELAKSANA PEMBANGUNAN PERUMAHAN");
		$this->excel->getActiveSheet()->mergeCells('C7:C8');
		$this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('D7', "LOKASI");
		$this->excel->getActiveSheet()->mergeCells('D7:D8');
		$this->excel->getActiveSheet()->setCellValue('E7', "IJIN LOKASI");
		$this->excel->getActiveSheet()->mergeCells('E7:F7');
		
		$this->excel->getActiveSheet()->setCellValue('E8', "LOKASI TGL/NO");
		
		$this->excel->getActiveSheet()->getStyle('E8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('F8', "LUAS (Ha)");	
		$this->excel->getActiveSheet()->getStyle('F8')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('G7', "RENCANA TAPAK (Ha)");
		$this->excel->getActiveSheet()->mergeCells('G7:G8');
		$this->excel->getActiveSheet()->getStyle('G7')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('H7', "PEMBEBASAN (Ha)");
		
		$this->excel->getActiveSheet()->getStyle('H7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('H7:H8');

		$this->excel->getActiveSheet()->setCellValue('I7', "TERBANGUN (Ha)");
		
		$this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('I7:I8');
		$this->excel->getActiveSheet()->setCellValue('J7', "BELUM TERBANGUN (Ha)");
		
		$this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('J7:J8');

		$this->excel->getActiveSheet()->setCellValue('K7', "FASILITAS SOSIAL (Ha)");
		$this->excel->getActiveSheet()->mergeCells('K7:M7');
	
		$this->excel->getActiveSheet()->setCellValue('K8', "DIALOKASIKAN");		
		$this->excel->getActiveSheet()->getStyle('K8')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('L8', "PEMBEBASAN");		
		$this->excel->getActiveSheet()->getStyle('L8')->getAlignment()->setWrapText(true);

		$this->excel->getActiveSheet()->setCellValue('M8', "SUDAH DIMATANGKAN");
		$this->excel->getActiveSheet()->getStyle('M8')->getAlignment()->setWrapText(true);
		
		$this->excel->getActiveSheet()->getStyle('N7:N9')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('N7', "CATATAN (PERPANJANGAN IJIN LOKASI)");
		$this->excel->getActiveSheet()->mergeCells('N7:N8');
			
		$this->excel->getActiveSheet()->setCellValue('O7', "AKTIF DALAM PEMBANGUNAN");
		$this->excel->getActiveSheet()->getStyle('O7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('O7:O8');

		$this->excel->getActiveSheet()->setCellValue('P7', "AKTIF BERHENTI");
		$this->excel->getActiveSheet()->getStyle('P7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('P7:P8');

		$this->excel->getActiveSheet()->setCellValue('Q7', "AKTIF SUDAH SELESAI");
		$this->excel->getActiveSheet()->getStyle('Q7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('Q7:Q8');

		$this->excel->getActiveSheet()->setCellValue('R7', "TIDAK AKTIF");
		$this->excel->getActiveSheet()->getStyle('R7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->mergeCells('R7:R8');

		$this->load->model('m_report');
        //$data= $this->m_report->lahan_perkecamatan_perusahaan($id,$tahun,$periode);
        $data1= $this->m_report->lahan_perkecamatan_value($id,$tahun,$periode);
        $numCell=9;	
        $no=1;
		foreach ($data1 as $i)
		{
			$this->excel->getActiveSheet()->setCellValue('B'.$numCell, $no);
			$this->excel->getActiveSheet()->setCellValue('C'.$numCell,'Nama Perusahaan  : '.$i['NAMA_PERUSAHAAN']);
           	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+1),'Pimpinan  : '. $i['PIMPINAN']);
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+2),'Alamat  : '. $i['ALAMAT']);
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+3),'Telepon  : '.$i['TELP']);
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4),'Fax  : ' .$i['FAX']);

        	$this->excel->getActiveSheet()->setCellValue('D'.$numCell, $i['NAMA_LOKASI']);
        	$this->excel->getActiveSheet()->mergeCells('D'.$numCell.':'.'D'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $i['LOKASI_TGL']);
        	$this->excel->getActiveSheet()->mergeCells('E'.$numCell.':'.'E'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['LUAS']);
        	$this->excel->getActiveSheet()->mergeCells('F'.$numCell.':'.'F'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('G'.$numCell, $i['RENCANA_TAPAK']);
        	$this->excel->getActiveSheet()->mergeCells('G'.$numCell.':'.'G'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('H'.$numCell, $i['PEMBEBASAN']);
        	$this->excel->getActiveSheet()->mergeCells('H'.$numCell.':'.'H'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('I'.$numCell, $i['TERBANGUN']);
        	$this->excel->getActiveSheet()->mergeCells('I'.$numCell.':'.'I'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('J'.$numCell, $i['BELUM_TERBANGUN']);
        	$this->excel->getActiveSheet()->mergeCells('J'.$numCell.':'.'J'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('K'.$numCell, $i['DIALOKASIKAN']);
        	$this->excel->getActiveSheet()->mergeCells('K'.$numCell.':'.'K'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('L'.$numCell, $i['PEMBEBASAN']);
        	$this->excel->getActiveSheet()->mergeCells('L'.$numCell.':'.'L'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('M'.$numCell, $i['SUDAH_DIMATANGKAN']);
        	$this->excel->getActiveSheet()->mergeCells('M'.$numCell.':'.'M'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('N'.$numCell, $i['CATATAN']);
        	$this->excel->getActiveSheet()->mergeCells('N'.$numCell.':'.'N'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('O'.$numCell, $i['AKTIF_DLM_PEMBANGUNAN']);
        	$this->excel->getActiveSheet()->mergeCells('O'.$numCell.':'.'O'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('P'.$numCell, $i['SUDAH_DIMATANGKAN']);
        	$this->excel->getActiveSheet()->mergeCells('P'.$numCell.':'.'P'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('Q'.$numCell, $i['CATATAN']);
        	$this->excel->getActiveSheet()->mergeCells('Q'.$numCell.':'.'Q'.($numCell+4));
        	$this->excel->getActiveSheet()->setCellValue('R'.$numCell, $i['AKTIF_DLM_PEMBANGUNAN']);
        	$this->excel->getActiveSheet()->mergeCells('R'.$numCell.':'.'R'.($numCell+4));
        	
        	$numCell=$numCell+6;
        	$no++;
        	
        	
        }

			/** Borders for outside border */
	         $BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
	   		$this->excel->getActiveSheet()->getStyle('B9'.':'.'B'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('C9'.':'.'C'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('D9'.':'.'D'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('E9'.':'.'E'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('F9'.':'.'F'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('G9'.':'.'G'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('H9'.':'.'H'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('I9'.':'.'I'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('J9'.':'.'J'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('K9'.':'.'K'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('L9'.':'.'L'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('M9'.':'.'M'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('N9'.':'.'N'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('O9'.':'.'O'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('P9'.':'.'P'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('Q9'.':'.'Q'.($numCell))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('R9'.':'.'R'.($numCell))->applyFromArray($BStyle);
			
	   		$kecamatan= $this->m_report->get_kecamatan($id);
	   		foreach ($kecamatan as $key) 
	   		{
	   			$getkecamatan = $key['NAMA_KECAMATAN'];
	   		}
	   		$this->excel->getActiveSheet()->setCellValue('B5', "Propinsi");
			$this->excel->getActiveSheet()->mergeCells('B5:C5');
			$this->excel->getActiveSheet()->setCellValue('D5', ": Jawa Timur");

			$this->excel->getActiveSheet()->setCellValue('B6', "Kabupaten");
			$this->excel->getActiveSheet()->mergeCells('B6:C6');
			$this->excel->getActiveSheet()->setCellValue('D6', ": Sidoarjo");

			$this->excel->getActiveSheet()->setCellValue('M5', "Periode ");
			$this->excel->getActiveSheet()->mergeCells('M5:N5');
			$this->excel->getActiveSheet()->setCellValue('O5', ": Triwulan $periode $tahun");
			$this->excel->getActiveSheet()->mergeCells('O5:P5');

			$this->excel->getActiveSheet()->setCellValue('M6', "Kecamatan ");
			$this->excel->getActiveSheet()->mergeCells('M6:N6');
			$this->excel->getActiveSheet()->setCellValue('O6', ": $getkecamatan");
			$this->excel->getActiveSheet()->mergeCells('O6:P6');
				/** Set wrap Text **/
	   		$this->excel->getActiveSheet()->getStyle('A1'.':'.'R'.($numCell)) ->getAlignment()->setWrapText(true); 
	   		/** Borders for heading */
	   		$this->excel->getActiveSheet()->getStyle('B7:R8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
 
		$filename='Report_Lahan_Perkecamatan_'.$getkecamatan.'_Triwulan'.$periode.'_'.$tahun.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	public function rekapitulasi_pembangunan_kecamatan_excel($tahun,$periode)
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN');
		$this->excel->getActiveSheet()->setCellValue('B3', 'REKAPITULASI DATA PEMBANGUNAN RUMAH');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25.71);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(8.5);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(16.29);
		

		$this->excel->getActiveSheet()->mergeCells('B1:O2');
		$this->excel->getActiveSheet()->mergeCells('B3:O4');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		

		$this->excel->getActiveSheet()->setCellValue('B7', "NO");
		$this->excel->getActiveSheet()->mergeCells('B7:B8');
		$this->excel->getActiveSheet()->setCellValue('C7', "KECAMATAN");
		$this->excel->getActiveSheet()->mergeCells('C7:C8');
		$this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('D7', "JUMLAH LOKASI PERUMAHAN");
		$this->excel->getActiveSheet()->mergeCells('D7:D8');
		

		$this->excel->getActiveSheet()->mergeCells('E7:I7');
		$this->excel->getActiveSheet()->setCellValue('E7', "RENCANA PENGADAAN (UNIT)");		
		$this->excel->getActiveSheet()->setCellValue('E8', "RS");
		$this->excel->getActiveSheet()->setCellValue('F8', "RSS");
		$this->excel->getActiveSheet()->setCellValue('G8', "RM");
		$this->excel->getActiveSheet()->setCellValue('H8', "MW");
		$this->excel->getActiveSheet()->setCellValue('I8', "RUKO");

		$this->excel->getActiveSheet()->setCellValue('J7', "REALISASI PENGADAAN (UNIT)");
		$this->excel->getActiveSheet()->mergeCells('J7:N7');		
		
		$this->excel->getActiveSheet()->setCellValue('J8', "RS");
		$this->excel->getActiveSheet()->setCellValue('K8', "RSS");
		$this->excel->getActiveSheet()->setCellValue('L8', "RM");
		$this->excel->getActiveSheet()->setCellValue('M8', "MW");
		$this->excel->getActiveSheet()->setCellValue('N8', "RUKO");

		$this->excel->getActiveSheet()->setCellValue('O7', "CATATAN");
		$this->excel->getActiveSheet()->mergeCells('O7:O8');


		$this->load->model('m_report');
		
        $numCell=9;
        	$data= $this->m_report->tabel_pembangunan_kecamatan_all($tahun,$periode);
        	
        	        		$no=1;
				foreach ($data as $i)
				{
					$this->excel->getActiveSheet()->setCellValue('B'.$numCell, $no);
					$this->excel->getActiveSheet()->setCellValue('C'.$numCell, $i['NAMA_KECAMATAN']);
			       	$this->excel->getActiveSheet()->setCellValue('D'.$numCell, $i['JML_LOKASI']);
			       	$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $i['RENC_RSS']);
			       	$this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['RENC_RS']);
			       	$this->excel->getActiveSheet()->setCellValue('G'.$numCell, $i['RENC_RM']);
			       	$this->excel->getActiveSheet()->setCellValue('H'.$numCell, $i['RENC_MW']);
			       	$this->excel->getActiveSheet()->setCellValue('I'.$numCell, $i['RENC_RUKO']);
			       	$this->excel->getActiveSheet()->setCellValue('J'.$numCell, $i['REAL_RSS']);
			       	$this->excel->getActiveSheet()->setCellValue('K'.$numCell, $i['REAL_RS']);
			       	$this->excel->getActiveSheet()->setCellValue('L'.$numCell, $i['REAL_RM']);
			       	$this->excel->getActiveSheet()->setCellValue('M'.$numCell, $i['REAL_MW']);
			       	$this->excel->getActiveSheet()->setCellValue('N'.$numCell, $i['REAL_RUKO']);
			       	$this->excel->getActiveSheet()->setCellValue('O'.$numCell, $i['CATATAN']);
			       	
			       	$numCell++;
			       	$no++;
			        	
			        	
			    }
		$numCell++;
		
		$BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));	    
        $this->excel->getActiveSheet()->setCellValue('B'.($numCell), "JUMLAH");
        $this->excel->getActiveSheet()->mergeCells('B'.($numCell).':'.'C'.($numCell));
        $this->excel->getActiveSheet()->getStyle('B'.($numCell).':'.'O'.($numCell))->applyFromArray($BStyle);
		
		$data1= $this->m_report->tabel_jumlah_pem_kec($tahun,$periode);
		foreach ($data1 as $i)
				{
					
					
			       	$this->excel->getActiveSheet()->setCellValue('D'.$numCell, $i['JML_LOKASI']);
			       	$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $i['RENC_RSS']);
			       	$this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['RENC_RS']);
			       	$this->excel->getActiveSheet()->setCellValue('G'.$numCell, $i['RENC_RM']);
			       	$this->excel->getActiveSheet()->setCellValue('H'.$numCell, $i['RENC_MW']);
			       	$this->excel->getActiveSheet()->setCellValue('I'.$numCell, $i['RENC_RUKO']);
			       	$this->excel->getActiveSheet()->setCellValue('J'.$numCell, $i['REAL_RSS']);
			       	$this->excel->getActiveSheet()->setCellValue('K'.$numCell, $i['REAL_RS']);
			       	$this->excel->getActiveSheet()->setCellValue('L'.$numCell, $i['REAL_RM']);
			       	$this->excel->getActiveSheet()->setCellValue('M'.$numCell, $i['REAL_MW']);
			       	$this->excel->getActiveSheet()->setCellValue('N'.$numCell, $i['REAL_RUKO']);			      	       	
			       	
			    }

        /** Borders for outside border */
      	

   		$this->excel->getActiveSheet()->getStyle('B9'.':'.'B'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C9'.':'.'C'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D9'.':'.'D'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E9'.':'.'E'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('F9'.':'.'F'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G9'.':'.'G'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H9'.':'.'H'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('I9'.':'.'I'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('J9'.':'.'J'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('K9'.':'.'K'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('L9'.':'.'L'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('M9'.':'.'M'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('N9'.':'.'N'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('O9'.':'.'O'.($numCell))->applyFromArray($BStyle);


   		$this->load->model('m_report');

   		// $data= $this->m_report->tabel_statistik2_rencana($tahun);
     //    $data1= $this->m_report->tabel_statistik2_realisasi($tahun);
     //    $dataS= $this->m_report->tabel_statistik2_rencana($tahun-1);
     //    $data1S= $this->m_report->tabel_statistik2_realisasi($tahun-1);
   		
        $data1= $this->m_report->tabel_pembangunan_kecamatan_all_statistic($tahun-1,$periode);
        $data2= $this->m_report->tabel_pembangunan_kecamatan_all_statistic($tahun-2,$periode);
        
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4), "TYPE RUMAH");
        	$this->excel->getActiveSheet()->mergeCells('C'.($numCell+4).':'.'C'.($numCell+5));
			$this->excel->getActiveSheet()->getStyle('C'.($numCell+4))->getAlignment()->setWrapText(true);

        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6), "RSS 	: TYPE 21-27");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7), "RS 		: TYPE 36-70");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), "RM 		: TYPE 70-125");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9), "MW 	: TYPE >125");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+10), "RUKO");
        	//$this->excel->getActiveSheet()->setCellValue('B'.($numCell+8), "JUMLAH");

        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+4), "RENCANA PENGADAAN (UNIT)");
        	$this->excel->getActiveSheet()->mergeCells('D'.($numCell+4).':'.'F'.($numCell+4));
			$this->excel->getActiveSheet()->getStyle('D'.($numCell+4))->getAlignment()->setWrapText(true);

			$this->excel->getActiveSheet()->setCellValue('G'.($numCell+4), "REALISASI PENGADAAN (UNIT)");
        	$this->excel->getActiveSheet()->mergeCells('G'.($numCell+4).':'.'J'.($numCell+4));
			$this->excel->getActiveSheet()->getStyle('G'.($numCell+4))->getAlignment()->setWrapText(true);

			$this->excel->getActiveSheet()->setCellValue('D'.($numCell+5), "Des");
			$this->excel->getActiveSheet()->setCellValue('E'.($numCell+5), "Des");
			$this->excel->getActiveSheet()->setCellValue('G'.($numCell+5), "Des");
			$this->excel->getActiveSheet()->setCellValue('I'.($numCell+5), "Des");


			/** border statistic **/
			$this->excel->getActiveSheet()->getStyle('C'.($numCell+5).':'.'C'.($numCell+10))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('D'.($numCell+5).':'.'D'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('E'.($numCell+5).':'.'E'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('F'.($numCell+5).':'.'F'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('G'.($numCell+5).':'.'G'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('H'.($numCell+5).':'.'H'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('I'.($numCell+5).':'.'I'.($numCell+10))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('J'.($numCell+5).':'.'J'.($numCell+10))->applyFromArray($BStyle);

   			/**MERGE CELL STATISTIK**/
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+5).':'.'H'.($numCell+5));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+6).':'.'H'.($numCell+6));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+7).':'.'H'.($numCell+7));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+8).':'.'H'.($numCell+8));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+9).':'.'H'.($numCell+9));
   			$this->excel->getActiveSheet()->mergeCells('G'.($numCell+10).':'.'H'.($numCell+10));
   			
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+5).':'.'J'.($numCell+5));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+6).':'.'J'.($numCell+6));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+7).':'.'J'.($numCell+7));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+8).':'.'J'.($numCell+8));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+9).':'.'J'.($numCell+9));
   			$this->excel->getActiveSheet()->mergeCells('I'.($numCell+10).':'.'J'.($numCell+10));

   			$this->excel->getActiveSheet()->mergeCells('E'.($numCell+5).':'.'F'.($numCell+5));
   			$this->excel->getActiveSheet()->mergeCells('E'.($numCell+6).':'.'F'.($numCell+6));
   			$this->excel->getActiveSheet()->mergeCells('E'.($numCell+7).':'.'F'.($numCell+7));
   			$this->excel->getActiveSheet()->mergeCells('E'.($numCell+8).':'.'F'.($numCell+8));
   			$this->excel->getActiveSheet()->mergeCells('E'.($numCell+9).':'.'F'.($numCell+9));
   			$this->excel->getActiveSheet()->mergeCells('E'.($numCell+10).':'.'F'.($numCell+10));


        	
        	foreach ($data1 as $key) {
        		$this->excel->getActiveSheet()->setCellValue('D'.($numCell+6), $key['RENC_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+7), $key['RENC_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+8), $key['RENC_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+9), $key['RENC_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+10), $key['RENC_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
	        	
        		$this->excel->getActiveSheet()->setCellValue('G'.($numCell+6), $key['REAL_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+7), $key['REAL_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+8), $key['REAL_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+9), $key['REAL_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('G'.($numCell+10), $key['REAL_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
				}
			foreach ($data2 as $key) {
        		$this->excel->getActiveSheet()->setCellValue('E'.($numCell+6), $key['RENC_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+7), $key['RENC_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+8), $key['RENC_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+9), $key['RENC_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('E'.($numCell+10), $key['RENC_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
	        	
        		$this->excel->getActiveSheet()->setCellValue('I'.($numCell+6), $key['REAL_RSS']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+7), $key['REAL_RS']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+8), $key['REAL_RM']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+9), $key['REAL_MW']);
	        	$this->excel->getActiveSheet()->setCellValue('I'.($numCell+10), $key['REAL_RUKO']);
	        	//$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), $key['BELUM_TERBANGUN']);
				}	

		$this->excel->getActiveSheet()->setCellValue('B5', "Propinsi");
		$this->excel->getActiveSheet()->mergeCells('B5:C5');
		$this->excel->getActiveSheet()->setCellValue('D5', ": Jawa Timur");
		$this->excel->getActiveSheet()->setCellValue('B6', "Kabupaten");
		$this->excel->getActiveSheet()->mergeCells('B6:C6');
		$this->excel->getActiveSheet()->setCellValue('D6', ": Sidoarjo");

		$this->excel->getActiveSheet()->setCellValue('M5', "Periode ");
		$this->excel->getActiveSheet()->mergeCells('M5:N5');
		$this->excel->getActiveSheet()->setCellValue('O5', ": Triwulan $periode $tahun");
		$this->excel->getActiveSheet()->mergeCells('O5:P5');
        /** Set wrap Text **/
  		$this->excel->getActiveSheet()->getStyle('A1'.':'.'O'.($numCell+10)) ->getAlignment()->setWrapText(true); 
   		/** Borders for heading */
 		$this->excel->getActiveSheet()->getStyle('B7:O8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
 		$this->excel->getActiveSheet()->getStyle('C'.($numCell+4).':'.'J'.($numCell+5))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$filename='Rekapitulasi_Pembangunan_Perkecamatan_Triwulan'.$periode.'_'.$tahun.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	public function rekapitulasi_lahan_kecamatan_excel($tahun,$periode)
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A3);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setSize(18);
		$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->setCellValue('B1', 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN');
		$this->excel->getActiveSheet()->setCellValue('B3', 'REKAPITULASI DATA LAHAN PERUMAHAN / PEMUKIMAN');

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(1.86);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15.71);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(14.17);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10.17);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(12.17);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(12.17);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(13.17);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(12.17);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(12.17);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(14.17);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(13.17);
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(14.17);
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(14.17);
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(10.17);
		$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(10.17);
		$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(10.17);
		//$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(8.5);
		

		$this->excel->getActiveSheet()->mergeCells('B1:Q2');
		$this->excel->getActiveSheet()->mergeCells('B3:Q4');
		
		$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		

		$this->excel->getActiveSheet()->setCellValue('B7', "NO");
		$this->excel->getActiveSheet()->mergeCells('B7:B8');
		$this->excel->getActiveSheet()->setCellValue('C7', "KECAMATAN");
		$this->excel->getActiveSheet()->mergeCells('C7:C8');
		$this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->setCellValue('D7', "JUMLAH LOKASI PERUMAHAN");
		$this->excel->getActiveSheet()->mergeCells('D7:D8');
		

		$this->excel->getActiveSheet()->mergeCells('E7:F7');
		$this->excel->getActiveSheet()->setCellValue('E7', "IJIN LOKASI");
		$this->excel->getActiveSheet()->setCellValue('E8', "JML IJIN LOKASI");
		$this->excel->getActiveSheet()->setCellValue('F8', "LUAS (Ha)");

		$this->excel->getActiveSheet()->setCellValue('G7', "RENCANA TAPAK (Ha)");
		$this->excel->getActiveSheet()->mergeCells('G7:G8');
		$this->excel->getActiveSheet()->setCellValue('H7', "PEMBEBASAN (Ha)");
		$this->excel->getActiveSheet()->mergeCells('H7:H8');
		$this->excel->getActiveSheet()->setCellValue('I7', "TERBANGUN (Ha)");
		$this->excel->getActiveSheet()->mergeCells('I7:I8');

		$this->excel->getActiveSheet()->setCellValue('J7', "BELUM TERBANGUN");
		$this->excel->getActiveSheet()->mergeCells('J7:J8');		
		

		$this->excel->getActiveSheet()->setCellValue('K7', "FASILITAS SOSIAL (Ha)");
		$this->excel->getActiveSheet()->mergeCells('K7:M7');
		$this->excel->getActiveSheet()->setCellValue('K8', "DIALOKASIKAN");
		$this->excel->getActiveSheet()->setCellValue('L8', "PEMBEBASAN");
		$this->excel->getActiveSheet()->setCellValue('M8', "SUDAH DIMATANGKAN");
		

		$this->excel->getActiveSheet()->setCellValue('N7', "AKTIF DALAM PEMBANGUNAN");
		$this->excel->getActiveSheet()->mergeCells('N7:N8');
		$this->excel->getActiveSheet()->setCellValue('O7', "AKTIF BERHENTI");
		$this->excel->getActiveSheet()->mergeCells('O7:O8');
		$this->excel->getActiveSheet()->setCellValue('P7', "AKTIF SUDAH SELESAI");
		$this->excel->getActiveSheet()->mergeCells('P7:P8');
		$this->excel->getActiveSheet()->setCellValue('Q7', "TIDAK AKTIF");
		$this->excel->getActiveSheet()->mergeCells('Q7:Q8');



		$this->load->model('m_report');
		$nilai = $this->m_report->jumlah_kecamatan();
		foreach ($nilai as $nil)
		{
			$jmlkec = $nil['JUMLAH'];
		}
       
        $numCell=9;	
        $numCella=9;
        //$NAMA_KECAMATAN,$JML_IJIN_LOKASI,$LUAS,$RENCANA_TAPAK,$PEMBEBASAN,$TERBANGUN,$DIALOKASIKAN,$PEMBEBASAN,$DIMATANGKAN

        $k['JML_IJIN_LOKASI']=$k['LUAS']=$k['RENCANA_TAPAK']=$k['PEMBEBASAN']=$k['TERBANGUN']=$k['BELUM_TERBANGUN']=$k['DIALOKASIKAN']=$k['PEMBEBASAN']=$k['DIMATANGKAN']=$k['AKTIF_DLM_PEMBANGUNAN']=$k['AKTIF_BERHENTI']=$k['AKTIF_SDH_SELESAI']=$k['TIDAK_AKTIF']=0;
        $no=1;
        
        for ($j=1; $j <= $jmlkec ; $j++) { 
        	$data= $this->m_report->tabel_lahan_kecamatan_all($j,$tahun,$periode);
        	$data1= $this->m_report->aktif_dalam_pembangunan($j,$tahun,$periode);
        	$data2= $this->m_report->aktif_berhenti($j,$tahun,$periode);
        	$data3= $this->m_report->aktif_sdh_selesai($j,$tahun,$periode);
        	$data4= $this->m_report->tidak_aktif($j,$tahun,$periode);

        	        		
				foreach ($data as $i)
				{
					$this->excel->getActiveSheet()->setCellValue('B'.$numCell, $no);
					$this->excel->getActiveSheet()->setCellValue('C'.$numCell, $i['NAMA_KECAMATAN']);
			       //	$this->excel->getActiveSheet()->setCellValue('D'.$numCell, $i['JML_LOKASI']);
			       	$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $i['JML_IJIN_LOKASI']);
			       	$this->excel->getActiveSheet()->setCellValue('F'.$numCell, $i['LUAS']);
			       	$this->excel->getActiveSheet()->setCellValue('G'.$numCell, $i['RENCANA_TAPAK']);
			       	$this->excel->getActiveSheet()->setCellValue('H'.$numCell, $i['PEMBEBASAN']);
			       	$this->excel->getActiveSheet()->setCellValue('I'.$numCell, $i['TERBANGUN']);
			       	$this->excel->getActiveSheet()->setCellValue('J'.$numCell, $i['BELUM_TERBANGUN']);
			       	$this->excel->getActiveSheet()->setCellValue('K'.$numCell, $i['DIALOKASIKAN']);
			       	$this->excel->getActiveSheet()->setCellValue('L'.$numCell, $i['PEMBEBASAN']);
			       	$this->excel->getActiveSheet()->setCellValue('M'.$numCell, $i['DIMATANGKAN']);
			       	$no++;
			     	$k['JML_IJIN_LOKASI']+=$i['JML_IJIN_LOKASI'];
			     	$k['LUAS']+=$i['LUAS'];
			     	$k['RENCANA_TAPAK']+=$i['RENCANA_TAPAK'];
			     	$k['PEMBEBASAN']+=$i['PEMBEBASAN'];
			     	$k['TERBANGUN']+=$i['TERBANGUN'];
			     	$k['BELUM_TERBANGUN']+=$i['BELUM_TERBANGUN'];
			     	$k['DIALOKASIKAN']+=$i['DIALOKASIKAN'];
			     	$k['PEMBEBASAN']+=$i['PEMBEBASAN'];
			     	$k['DIMATANGKAN']+=$i['DIMATANGKAN'];


			    }


			    foreach ($data1 as $a)
				{
					$this->excel->getActiveSheet()->setCellValue('N'.$numCell, $a['AKTIF_DLM_PEMBANGUNAN']);
					$k['AKTIF_DLM_PEMBANGUNAN']+=$a['AKTIF_DLM_PEMBANGUNAN'];
				}
				foreach ($data2 as $b)
				{
					$this->excel->getActiveSheet()->setCellValue('O'.$numCell, $b['AKTIF_BERHENTI']);
					$k['AKTIF_BERHENTI']+=$b['AKTIF_BERHENTI'];
				}
				foreach ($data3 as $c)
				{
					$this->excel->getActiveSheet()->setCellValue('P'.$numCell, $c['AKTIF_SDH_SELESAI']);
					$k['AKTIF_SDH_SELESAI']+=$c['AKTIF_SDH_SELESAI'];
				}
				foreach ($data4 as $d)
				{
					$this->excel->getActiveSheet()->setCellValue('Q'.$numCell, $d['TIDAK_AKTIF']);
					$k['TIDAK_AKTIF']+=$d['TIDAK_AKTIF'];
				}
				$numCell++;

        	}

        		$this->excel->getActiveSheet()->setCellValue('E'.$numCell, $k['JML_IJIN_LOKASI']);
			    $this->excel->getActiveSheet()->setCellValue('F'.$numCell, $k['LUAS']);
			    $this->excel->getActiveSheet()->setCellValue('G'.$numCell, $k['RENCANA_TAPAK']);
			    $this->excel->getActiveSheet()->setCellValue('H'.$numCell, $k['PEMBEBASAN']);
			    $this->excel->getActiveSheet()->setCellValue('I'.$numCell, $k['TERBANGUN']);
			    $this->excel->getActiveSheet()->setCellValue('J'.$numCell, $k['BELUM_TERBANGUN']);
			    $this->excel->getActiveSheet()->setCellValue('K'.$numCell, $k['DIALOKASIKAN']);
			    $this->excel->getActiveSheet()->setCellValue('L'.$numCell, $k['PEMBEBASAN']);
			    $this->excel->getActiveSheet()->setCellValue('M'.$numCell, $k['DIMATANGKAN']);
			    $this->excel->getActiveSheet()->setCellValue('N'.$numCell, $k['AKTIF_DLM_PEMBANGUNAN']);
			    $this->excel->getActiveSheet()->setCellValue('O'.$numCell, $k['AKTIF_BERHENTI']);
			    $this->excel->getActiveSheet()->setCellValue('P'.$numCell, $k['AKTIF_SDH_SELESAI']);
			    $this->excel->getActiveSheet()->setCellValue('Q'.$numCell, $k['TIDAK_AKTIF']);

			    $this->excel->getActiveSheet()->setCellValue('B'.($numCell), "JUMLAH");
				$this->excel->getActiveSheet()->mergeCells('B'.($numCell).':'.'C'.($numCell));
				$BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
   				$this->excel->getActiveSheet()->getStyle('B'.($numCell).':'.'Q'.($numCell))->applyFromArray($BStyle);	
        

        $this->load->model('m_report');
        $data= $this->m_report->tabel_lahan_kecamatan_all_statistic($tahun,$periode);
        
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+4), " ");
        	//$this->excel->getActiveSheet()->mergeCells('C'.($numCell+4).':'.'C'.($numCell+5));
			//$this->excel->getActiveSheet()->getStyle('C'.($numCell+4))->getAlignment()->setWrapText(true);
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+5), "JUMLAH PENGEMBANG");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+6), "JUMLAH IJIN LOKASI");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+7), "LUAS IJIN LOKASI");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+8), "RENCANA TAPAK");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+9), "PEMBEBASAN");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+10), "TERBANGUN");
        	$this->excel->getActiveSheet()->setCellValue('C'.($numCell+11), "BELUM TERBANGUN");
        	//$this->excel->getActiveSheet()->setCellValue('B'.($numCell+8), "JUMLAH");

        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+4), "Des 2014");
        	
			$this->excel->getActiveSheet()->setCellValue('E'.($numCell+4), "Des 2014");
        	
			$BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));		

			/** border statistic **/
			$this->excel->getActiveSheet()->getStyle('C'.($numCell+5).':'.'C'.($numCell+11))->applyFromArray($BStyle);
	   		$this->excel->getActiveSheet()->getStyle('D'.($numCell+5).':'.'D'.($numCell+11))->applyFromArray($BStyle);
   			$this->excel->getActiveSheet()->getStyle('E'.($numCell+5).':'.'E'.($numCell+11))->applyFromArray($BStyle);
   			

        	
        	foreach ($data as $key) {
        		$this->excel->getActiveSheet()->setCellValue('D'.($numCell+5), $key['JML_PENGEMBANG']);
        		$this->excel->getActiveSheet()->setCellValue('D'.($numCell+6), $key['JML_IJIN_LOKASI']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+7), $key['LUAS']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+8), $key['RENCANA_TAPAK']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+9), $key['PEMBEBASAN']);	        	
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+10), $key['TERBANGUN']);
	        	$this->excel->getActiveSheet()->setCellValue('D'.($numCell+11), $key['BELUM_TERBANGUN']);
	        	
				}

        /** Borders for outside border */
     	$BStyle = array('borders' => array('outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

   		$this->excel->getActiveSheet()->getStyle('B9'.':'.'B'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('C9'.':'.'C'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('D9'.':'.'D'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('E9'.':'.'E'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('F9'.':'.'F'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('G9'.':'.'G'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('H9'.':'.'H'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('I9'.':'.'I'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('J9'.':'.'J'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('K9'.':'.'K'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('L9'.':'.'L'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('M9'.':'.'M'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('N9'.':'.'N'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('O9'.':'.'O'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('P9'.':'.'P'.($numCell))->applyFromArray($BStyle);
   		$this->excel->getActiveSheet()->getStyle('Q9'.':'.'Q'.($numCell))->applyFromArray($BStyle);
   		//$this->excel->getActiveSheet()->getStyle('R9'.':'.'O'.($numCell))->applyFromArray($BStyle);

   		$this->excel->getActiveSheet()->setCellValue('B5', "Propinsi");
		$this->excel->getActiveSheet()->mergeCells('B5:C5');
		$this->excel->getActiveSheet()->setCellValue('D5', ": Jawa Timur");

		$this->excel->getActiveSheet()->setCellValue('B6', "Kabupaten");
		$this->excel->getActiveSheet()->mergeCells('B6:C6');
		$this->excel->getActiveSheet()->setCellValue('D6', ": Sidoarjo");

		$this->excel->getActiveSheet()->setCellValue('M5', "Periode ");
		$this->excel->getActiveSheet()->mergeCells('M5:N5');
		$this->excel->getActiveSheet()->setCellValue('O5', ": Triwulan $periode $tahun");
		$this->excel->getActiveSheet()->mergeCells('O5:P5');

        /** Set wrap Text **/
  		$this->excel->getActiveSheet()->getStyle('A1'.':'.'Q'.($numCell+11)) ->getAlignment()->setWrapText(true); 
   		/** Borders for heading */
 		$this->excel->getActiveSheet()->getStyle('B7:Q8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
 		$this->excel->getActiveSheet()->getStyle('C'.($numCell+4).':'.'E'.($numCell+4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	
		$filename='Rekapitulasi_Lahan_Perkecamatan_Triwulan'.$periode.'_'.$tahun.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->save('php://output');
	}

	
	
}