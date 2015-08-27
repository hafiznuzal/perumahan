<?php
class Perumahan_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}


	public function get_json_data($tahun,$periode)
	{
		$sql = "SELECT pr.id_perumahan,pr.nama_perumahan
				FROM perusahaan ps, perumahan pr, lokasi l, ijin i, kombinasi ko,pembangunan pem
				WHERE l.id_lokasi=ko.id_lokasi
				AND ko.id_kombinasi=i.id_kombinasi
				AND i.id_perumahan=pr.id_perumahan
				AND pr.id_perusahaan=ps.id_perusahaan
				AND pem.id_perumahan=pr.id_perumahan
				AND pem.tahun=$tahun
				AND pem.triwulan=$periode
				GROUP BY pr.id_perumahan, pr.nama_perumahan, ps.nama_perusahaan";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function get_all()
	{
		$session_data=$this->session->userdata('logged_in');
		$tahun=$session_data['tahun'];
		$periode=$session_data['periode'];
		$sql = "SELECT pr.id_perumahan, pr.nama_perumahan,ps.id_perusahaan, ps.nama_perusahaan, GROUP_CONCAT(DISTINCT l.nama_lokasi separator ',\n') nama_lokasi
				FROM perusahaan ps, perumahan pr, lokasi l, ijin i, kombinasi ko,pembangunan pem
				WHERE l.id_lokasi=ko.id_lokasi
				AND ko.id_kombinasi=i.id_kombinasi
				AND i.id_perumahan=pr.id_perumahan
				AND pr.id_perusahaan=ps.id_perusahaan
				AND pem.id_perumahan=pr.id_perumahan
				AND pem.tahun=$tahun
				AND pem.triwulan=$periode
				GROUP BY pr.id_perumahan, pr.nama_perumahan, ps.nama_perusahaan";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function add_kombinasi($id_lokasis)
	{
		$ids = explode(" ", $id_lokasis);
		$sql = "SELECT max(id_kombinasi) + 1 as id from kombinasi";
		$query = $this->db->query($sql);
		$query = $query->result_array();
		$maxid = $query[0]['id'];
		foreach ($ids as $id) 
		{
			$sql = "INSERT INTO kombinasi (id_kombinasi, id_lokasi) VALUES ($maxid, $id)";
			$query = $this->db->query($sql);
		}

		return $maxid;
	}

	public function get_all_dummy()
	{
		$sql = 'select lokasi.id_lokasi, concat(lokasi.nama_lokasi , " (", kecamatan.nama_kecamatan, ")") as nama_lokasi
				from lokasi, kecamatan
				where lokasi.id_kecamatan=kecamatan.id_kecamatan';
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;

		// return array(
		// 	array('id_lokasi' => 1, 'nama_lokasi' => 'Paijo Land'),
		// 	array('id_lokasi' => 2, 'nama_lokasi' => 'Ardian Land'),
		// 	array('id_lokasi' => 3, 'nama_lokasi' => 'Atminanto Land')
		// );
	}

	public function get_pengembang_dummy()
	{
		$sql = "select id_perusahaan, nama_perusahaan from perusahaan";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;

		// return array(
		// 	array('id_perusahaan' => 1, 'nama_pengembang' => 'Paijo Corp'),
		// 	array('id_perusahaan' => 2, 'nama_pengembang' => 'Ardian Corp'),
		// 	array('id_perusahaan' => 3, 'nama_pengembang' => 'Atminanto Corp')
		// );
	}

	public function delete()
	{
		$sql = "DELETE FROM PERUMAHAN WHERE ID_PERUMAHAN=$ID";
		$query = $this->db->query($sql);
	}

	public function add($nama, $pengembang)
	{
		$sql = "INSERT INTO PERUMAHAN (NAMA_PERUMAHAN, ID_PERUSAHAAN) VALUES ('" . $nama . "', '" . $pengembang . "')";
		$query = $this->db->query($sql);
		$sql = "SELECT id_perumahan from perumahan where nama_perumahan='$nama' and id_perusahaan=$pengembang";
		$query = $this->db->query($sql);
		$query = $query->result_array();
		$maxid = $query[0]['id_perumahan'];
		return $maxid;
	}

	public function insert_ijin($datas)
	{
		$this->db->insert("ijin", $datas);
	}

	public function edit($ID,$name,$pengembang)
	{
		$sql = "UPDATE perumahan SET nama_perumahan='" . $name . "',id_perusahaan='".$pengembang."' WHERE id_perumahan=$ID";
		$query = $this->db->query($sql);
	}

}


?>