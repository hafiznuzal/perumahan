<?php
class Berkas_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_berkas($id_perumahan)
	{
		$sql = "select * from berkas where berkas.id_perumahan = ".$id_perumahan;
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function get_berkas_html($id_perumahan)
	{
		$sql = "select * from berkas where berkas.id_perumahan = ".$id_perumahan;
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function insert_berkas($id_perumahan,$alamat_berkas)
	{
		$sql = "insert into berkas (id_perumahan,alamat_berkas) values (".$id_perumahan.",'".$alamat_berkas."')";
		$query = $this->db->query($sql);
	}


	
}
?>
