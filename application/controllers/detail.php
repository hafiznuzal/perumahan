<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function get_all()
	{
		$data['genre'] = $this->genre_model->get_all();
		$this->load->view('admin/admin_genre', $data);
	}

	public function delete($id)
	{
		$this->genre_model->delete($id);
		$this->get_all();
	}

	public function add($name)
	{
		$this->genre_model->add($name);
		$this->get_all();
	}

	public function edit($ID,$name)
	{
		$this->genre_model->edit($ID,$name);
		$this->get_all();
	}  
}