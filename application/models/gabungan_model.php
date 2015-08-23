<?php
class Gabungan_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function jumlah_pengembang()
	{
		$sql = "SELECT COUNT(*) AS jumlah_pengembang FROM perusahaan";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}

	public function jumlah_perumahan()
	{
		$sql = "SELECT COUNT(*) AS jumlah_perumahan FROM perumahan";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}

	public function jumlah_lokasi()
	{
		$sql = "SELECT COUNT(*) AS jumlah_lokasi FROM lokasi";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}

	public function jumlah_ijin_lokasi()
	{
		// $sql = "SELECT COUNT(*) AS jumlah_ijin_lokasi FROM ijin_lokasi";
		// $query = $this->db->query($sql);
		// $data = $query->result();
		// return $data;
		$sql = "select count(distinct id_perumahan) as jumlah_ijin_lokasi from ijin";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}

	public function jumlah_pembangunan()
	{
		$sql = "SELECT COUNT(*) AS jumlah_pembangunan FROM pembangunan";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}
}
?>
