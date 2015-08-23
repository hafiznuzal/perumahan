<?php
class Proyek_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_data_lokasi_all()
	{
		$sql = "SELECT k.nama_kecamatan, ps.nama_perusahaan, GROUP_CONCAT(DISTINCT pr.nama_perumahan separator ',\n') nama_perumahan, GROUP_CONCAT(DISTINCT l.nama_lokasi separator ',\n') nama_lokasi, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif
FROM kecamatan k, perusahaan ps, perumahan pr, lokasi l, ijin i, kombinasi ko
WHERE k.id_kecamatan=l.id_kecamatan
AND l.id_lokasi=ko.id_lokasi
AND ko.id_kombinasi=i.id_kombinasi
AND i.id_perumahan=pr.id_perumahan
AND pr.id_perusahaan=ps.id_perusahaan
GROUP BY k.id_kecamatan, ps.id_perusahaan, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif";
		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}
public function get_data_lokasi_periode($tahun)
	{
		$sql = "SELECT k.nama_kecamatan, ps.nama_perusahaan, GROUP_CONCAT(DISTINCT pr.nama_perumahan separator ',\n') nama_perumahan, GROUP_CONCAT(DISTINCT l.nama_lokasi separator ',\n') nama_lokasi, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif
FROM kecamatan k, perusahaan ps, perumahan pr, lokasi l, ijin i, kombinasi ko,pembangunan pem
WHERE k.id_kecamatan=l.id_kecamatan
AND l.id_lokasi=ko.id_lokasi
AND ko.id_kombinasi=i.id_kombinasi
AND i.id_perumahan=pr.id_perumahan
AND pr.id_perusahaan=ps.id_perusahaan
AND pem.id_perumahan=pr.id_perumahan
AND pem.tahun='$tahun'
GROUP BY k.id_kecamatan, ps.id_perusahaan, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif";
		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}

	public function get_data_pembangunan_all()
	{
		$sql = "SELECT k.nama_kecamatan, ps.nama_perusahaan, pr.nama_perumahan, 
		l.nama_lokasi, pb.renc_rss, pb.renc_rs, pb.renc_rm, pb.renc_mw, pb.renc_ruko, pb.real_rss, pb.real_rs, pb.real_rm, pb.real_mw, pb.real_ruko, pb.catatan
FROM kecamatan k, perusahaan ps, perumahan pr, lokasi l, pembangunan pb, kombinasi ko
WHERE k.id_kecamatan=l.id_kecamatan
AND l.id_lokasi=ko.id_lokasi
AND ko.id_kombinasi=pb.id_kombinasi
AND pb.id_perumahan=pr.id_perumahan
AND pr.id_perusahaan=ps.id_perusahaan
GROUP BY k.id_kecamatan, ps.id_perusahaan, pb.renc_rss, pb.renc_rs, pb.renc_rm, pb.renc_mw, pb.renc_ruko, pb.real_rss, pb.real_rs, pb.real_rm, pb.real_mw, pb.real_ruko, pb.catatan;
";
		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}

public function get_data_pembangunan_periode($tahun)
	{
		$sql = "SELECT k.nama_kecamatan, ps.nama_perusahaan, pr.nama_perumahan, 
		l.nama_lokasi, pb.renc_rss, pb.renc_rs, pb.renc_rm, pb.renc_mw, pb.renc_ruko, pb.real_rss, pb.real_rs, pb.real_rm, pb.real_mw, pb.real_ruko, pb.catatan
FROM kecamatan k, perusahaan ps, perumahan pr, lokasi l, pembangunan pb, kombinasi ko
WHERE k.id_kecamatan=l.id_kecamatan
AND l.id_lokasi=ko.id_lokasi
AND ko.id_kombinasi=pb.id_kombinasi
AND pb.id_perumahan=pr.id_perumahan
AND pr.id_perusahaan=ps.id_perusahaan
AND pb.tahun=$tahun

GROUP BY k.id_kecamatan, ps.id_perusahaan, pb.renc_rss, pb.renc_rs, pb.renc_rm, pb.renc_mw, pb.renc_ruko, pb.real_rss, pb.real_rs, pb.real_rm, pb.real_mw, pb.real_ruko, pb.catatan;
";
		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}

	public function get_data_info($id_perumahan)
	{
		$sql = "SELECT ko.id_lokasi, ko.id_kombinasi,pr.id_perumahan,pr.nama_perumahan, ps.nama_perusahaan, GROUP_CONCAT(DISTINCT l.nama_lokasi) nama_lokasi
				FROM perusahaan ps, perumahan pr, lokasi l, ijin i, kombinasi ko
				WHERE l.id_lokasi=ko.id_lokasi
				AND ko.id_kombinasi=i.id_kombinasi
				AND i.id_perumahan=pr.id_perumahan
				AND pr.id_perusahaan=ps.id_perusahaan
				AND pr.id_perumahan = ".$id_perumahan."
				GROUP BY pr.nama_perumahan, ps.nama_perusahaan";
		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}
	public function get_data_ijin($id_perumahan)
	{
		$sql = "SELECT k.nama_kecamatan, ps.nama_perusahaan, GROUP_CONCAT(DISTINCT pr.nama_perumahan) nama_perumahan, GROUP_CONCAT(DISTINCT l.nama_lokasi) nama_lokasi,i.id_ijin, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif
		FROM kecamatan k, perusahaan ps, perumahan pr, lokasi l, ijin i, kombinasi ko
		WHERE k.id_kecamatan=l.id_kecamatan
		AND l.id_lokasi=ko.id_lokasi
		AND ko.id_kombinasi=i.id_kombinasi
		AND i.id_perumahan=pr.id_perumahan
		AND pr.id_perusahaan=ps.id_perusahaan
		AND pr.id_perumahan = ".$id_perumahan."
		GROUP BY k.id_kecamatan, ps.id_perusahaan, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif;";

		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}
	public function get_ijin_json($id_perumahan,$tahun,$periode)
	{
		$sql = "SELECT i.lokasi_no,i.lokasi_tgl,i.luas,i.rencana_tapak,i.pembebasan,i.terbangun, 
		i.belum_terbangun,i.fs_dialokasikan,i.fs_pembebasan,i.fs_sudah_dimatangkan,i.catatan,
		i.aktif_dlm_pembangunan,i.aktif_berhenti,i.aktif_sdh_selesai,i.tidak_aktif,ps.id_perusahaan,
		l.id_lokasi, k.nama_kecamatan, ps.nama_perusahaan,
		pem.id_kombinasi,pem.renc_rss,pem.renc_rs,pem.renc_rm,pem.renc_mw,pem.renc_ruko,
		pem.real_rss,pem.real_rs,pem.real_rm,pem.real_mw,pem.real_ruko,pem.catatan, 
		GROUP_CONCAT(DISTINCT pr.nama_perumahan) nama_perumahan, 
		GROUP_CONCAT(DISTINCT l.nama_lokasi) nama_lokasi
		FROM kecamatan k, perusahaan ps, perumahan pr, lokasi l, ijin i, kombinasi ko, pembangunan pem
		WHERE k.id_kecamatan=l.id_kecamatan
		AND l.id_lokasi=ko.id_lokasi
		AND ko.id_kombinasi=i.id_kombinasi
		AND i.id_perumahan=pr.id_perumahan
		AND pr.id_perusahaan=ps.id_perusahaan
		AND pem.id_perumahan =pr.id_perumahan
		AND pr.id_perumahan = ".$id_perumahan."
		AND pem.tahun = ".$tahun."
		AND pem.triwulan= ".$periode."
		GROUP BY k.id_kecamatan, ps.id_perusahaan, i.lokasi_no, i.lokasi_tgl, i.luas, i.rencana_tapak, i.pembebasan, i.terbangun, i.belum_terbangun, i.fs_dialokasikan, i.fs_pembebasan, i.fs_sudah_dimatangkan, i.catatan, i.aktif_dlm_pembangunan, i.aktif_berhenti, i.aktif_sdh_selesai, i.tidak_aktif;";

		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}

	public function get_data_pembangunan($id_perumahan)
	{
		$sql="SELECT k.nama_kecamatan, ps.nama_perusahaan, GROUP_CONCAT(DISTINCT pr.nama_perumahan) nama_perumahan, GROUP_CONCAT(DISTINCT l.nama_lokasi) nama_lokasi,pb.id_pembangunan, pb.renc_rss, pb.renc_rs, pb.renc_rm, pb.renc_mw, pb.renc_ruko, pb.real_rss, pb.real_rs, pb.real_rm, pb.real_mw, pb.real_ruko, pb.catatan
		,pb.tahun,pb.triwulan
		FROM kecamatan k, perusahaan ps, perumahan pr, lokasi l, pembangunan pb, kombinasi ko
		WHERE k.id_kecamatan=l.id_kecamatan
		AND l.id_lokasi=ko.id_lokasi
		AND ko.id_kombinasi=pb.id_kombinasi
		AND pb.id_perumahan=pr.id_perumahan
		AND pr.id_perusahaan=ps.id_perusahaan
		AND pr.id_perumahan = ".$id_perumahan."
		GROUP BY k.id_kecamatan, ps.id_perusahaan, pb.renc_rss, pb.renc_rs, pb.renc_rm, pb.renc_mw, pb.renc_ruko, pb.real_rss, pb.real_rs, pb.real_rm, pb.real_mw, pb.real_ruko, pb.catatan;";

		$query = $this->db->query($sql);
		$data=$query->result_array();
		return $data;
	}




}

?>