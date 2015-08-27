<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('berkas_model');
		$this->load->library('session');
        if(!$this->session->userdata('logged_in')){
          redirect(site_url()."login");
        }

	}
	function do_upload($id_perumahan)
	{
		//$config['allowed_types'] = 'gif|jpg|png|doc|docx|xls|';
		$config['max_size']	= '4096';
		$this->load->library('upload', $config);
		$file_element_name = 'userfile';
		$config['upload_path'] ='files/';
		$config['allowed_types'] = '*';
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload($file_element_name))
		{
			$error = array('error' => $this->upload->display_errors());
    		echo json_encode(array('status' => $error));


		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$file_link = base_url().$config['upload_path'].$data['upload_data']['file_name'];
    		$this->berkas_model->insert_berkas($id_perumahan,$file_link);
    		echo json_encode(array('status' => "success" ));
		}
	}


}

?>