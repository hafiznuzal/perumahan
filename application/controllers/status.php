<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status extends CI_Controller
{
    
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('status_model');

	}
    
    public function get_all()
    {
    	$data['status'] = $this->status_model->get_all();
    	$this->load->view('admin/admin_status',$data);   
    }

    public function delete($id)
    {
    	$this->status_model->delete($id);
    	$this->get_all();
    	
    }

    public function add($name)
    {
    	$this->status_model->add($name);
    	$this->get_all();
    }

     public function edit($ID,$name)
    {
    	$this->status_model->edit($ID,$name);
    	$this->get_all();
    }


  
}

