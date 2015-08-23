<?php
class Ijin_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function add($id_perumahan,$id_kombinasi,$lokasi_no,$lokasi_tgl,$luas,$rencana_tapak,$pembebasan,$terbangun
                                ,$belum_terbangun,$fs_dialokasikan,$fs_pembebasan,$fs_sudah_dimatangkan,$aktif_dlm_pembangunan,
                                 $aktif_berhenti,$aktif_sdh_selesai,$tidak_aktif)
	{
		$sql = "insert into ijin (id_perumahan,id_kombinasi,lokasi_no,lokasi_tgl,luas,rencana_tapak,pembebasan,terbangun
                                ,belum_terbangun,fs_dialokasikan,fs_pembebasan,fs_sudah_dimatangkan,aktif_dlm_pembangunan,
                                 aktif_berhenti,aktif_sdh_selesai,tidak_aktif) 
			
								values ('".$id_perumahan."','".$id_kombinasi."','".$lokasi_no."','".$lokasi_tgl."','".$luas."','".$rencana_tapak."',
									'".$pembebasan."','".$terbangun."','".$belum_terbangun."','".$fs_dialokasikan."','".$fs_pembebasan."','".
									$fs_sudah_dimatangkan."','".$aktif_dlm_pembangunan."','".$aktif_berhenti."','".$aktif_sdh_selesai."','".$tidak_aktif."')";
		$query = $this->db->query($sql);
		$sql="SELECT id_ijin FROM ijin ORDER BY id_ijin DESC LIMIT 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;

	}
	public function edit($id,$no_ijin,$tgl_ijin,$luas,$tapak,$pembebasan,$terbangun,$belum_terbangun,$fs_dialokasikan, 
		$fs_pembebasan,$fs_dimatangkan,$catatan,$AktifPembangunan,$AktifBerhenti,$AktifSelesai,$tidak_aktif)
	{
		$sql="update ijin set lokasi_no='$no_ijin',lokasi_tgl='$tgl_ijin',luas='$luas',rencana_tapak='$tapak',pembebasan='$pembebasan',
		terbangun='$terbangun',belum_terbangun='$belum_terbangun',fs_dialokasikan='$fs_dialokasikan',fs_pembebasan='$fs_pembebasan',
		fs_sudah_dimatangkan='$fs_dimatangkan',aktif_dlm_pembangunan='$AktifPembangunan',aktif_berhenti='$AktifBerhenti',aktif_sdh_selesai='$AktifSelesai',
		tidak_aktif='$tidak_aktif' where id_ijin=$id";
		$query = $this->db->query($sql);
	}
	public function delete($id)
	{
		$sql="Delete from ijin where id_ijin='$id'";
		$query = $this->db->query($sql);
	}


	
}
?>
