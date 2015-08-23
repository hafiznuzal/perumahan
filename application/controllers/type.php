<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type extends CI_Controller
{
    
	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->model('type_model');

	}
    
    public function get_all()
    {
    	$data['type'] = $this->type_model->get_all();
    	$this->load->view('admin/admin_type',$data);   
    }

    public function delete($id)
    {
    	$this->type_model->delete($id);
    	$this->get_all();
    	
    }

    public function add($name)
    {
    	$this->type_model->add($name);
    	$this->get_all();
    }

     public function edit($ID,$name)
    {
    	$this->type_model->edit($ID,$name);
    	$this->get_all();
    }


  
}

