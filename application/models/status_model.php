<?php
class Status_model extends CI_Model
{
	public function __construct()
	{
        $this->load->database();
	}

	public function get_all()
	{

        $sql = "select * from master_status";
        $query = $this->db->query($sql);
        $data=$query->result_array();
        return $data;
	}

    public function delete($id)
    {
        $sql = "delete from master_status where ID_STATUS =".$id;
        $query = $this->db->query($sql);
    }

    public function add($name)
    {
        $sql = "insert into  master_status (ID_STATUS, STATUS_NAME) VALUES (NULL, '".$name."')";
        $query = $this->db->query($sql);
    }

    public function edit($ID,$name)
    {
        $sql = "update master_status set STATUS_NAME ='".$name."' where ID_STATUS=".$ID;
        $query = $this->db->query($sql);
    }

}


?>