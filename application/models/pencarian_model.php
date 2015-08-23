<?php
class Pencarian_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_hasil_pencarian($berdasarkan, $kata_kunci)
	{
		$keys = array(
			"kecamatan" => "AND k.nama_kecamatan = '$kata_kunci'",
			"pengembang" => "AND pn.nama_perusahaan = '$kata_kunci'",
			"lokasi" => "AND l.nama_lokasi = '%$kata_kunci%'",
			"perumahan" => "AND pr.nama_perumahan = '$kata_kunci'"
			);
		$sql = "SELECT p.id_proyek, k.nama_kecamatan, pn.nama_perusahaan, GROUP_CONCAT(DISTINCT pr.nama_perumahan) nama_perumahan, GROUP_CONCAT(DISTINCT l.nama_lokasi) nama_lokasi
				FROM kecamatan k, pengembang pn, perumahan pr, lokasi l, ijin_lokasi i, proyek p
				WHERE k.id_kecamatan=p.id_kecamatan
				AND pn.id_perusahaan=p.id_perusahaan
				AND pr.id_perumahan=p.id_perumahan
				AND l.id_lokasi=p.id_lokasi
				AND i.id_ijin=p.id_ijin " . 
				$keys[$berdasarkan]
				. " GROUP BY p.id_kecamatan, p.id_perusahaan, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif";

		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
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