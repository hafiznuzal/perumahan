<?php
class Type_model extends CI_Model
{
	public function __construct()
	{
        $this->load->database();
	}

	public function get_all()
	{

        $sql = "select * from master_type";
        $query = $this->db->query($sql);
        $data=$query->result_array();
        return $data;
	}

    public function delete($id)
    {
        $sql = "delete from master_type where ID_type =".$id;
        $query = $this->db->query($sql);
    }

    public function add($name)
    {
        $sql = "insert into  master_type (ID_TYPE, TYPE_NAME) VALUES (NULL, '".$name."')";
        $query = $this->db->query($sql);
    }

    public function edit($ID,$name)
    {
        $sql = "update master_type set TYPE_NAME ='".$name."' where ID_TYPE=".$ID;
        $query = $this->db->query($sql);
    }

}


?>