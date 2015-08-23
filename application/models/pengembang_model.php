<?php
class Pengembang_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_all()
	{
		$sql = "SELECT id_perusahaan, nama_perusahaan, pimpinan, alamat, telp, fax
				FROM perusahaan;";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function delete($ID)
	{
		$sql = "DELETE FROM perusahaan WHERE id_perusahaan=$ID";
		$query = $this->db->query($sql);
	}

	public function add($nama,$pimpinan,$alamat,$telp,$fax)
	{
		$sql = "INSERT INTO perusahaan (nama_perusahaan,pimpinan,alamat,telp,fax) VALUES ('$nama', '$pimpinan', '$alamat', '$telp', '$fax')";
		$query = $this->db->query($sql);
		$sql="SELECT id_perusahaan FROM perusahaan ORDER BY id_perusahaan DESC LIMIT 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;

	}

	public function edit($ID,$nama,$pimpinan,$alamat,$telp,$fax)
	{
		$sql = "UPDATE perusahaan SET nama_perusahaan='$nama', pimpinan='$pimpinan', alamat='$alamat', telp='$telp', fax='$fax' WHERE id_perusahaan=$ID";
		$query = $this->db->query($sql);
	}
}
?>