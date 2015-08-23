<?php
class Pembangunan_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function edit($id,$renc_rss,$renc_rs,$renc_rm,$renc_mw,$renc_ruko,
		$real_rss,$real_rs,$real_rm,$real_mw,$real_ruko,$catatan)
	{
		$sql="update pembangunan set renc_rss='$renc_rss',renc_rs='$renc_rs',renc_rm='$renc_rm',renc_mw='$renc_mw'
		,renc_ruko='$renc_ruko',real_rss='$real_rss',real_rs='$real_rs',real_rm='$real_rm',real_mw='$real_mw',real_ruko='$real_ruko',
		catatan='$catatan' where id_pembangunan='$id'";
		$query = $this->db->query($sql);
	}
	public function delete($id)
	{
		$sql="Delete from pembangunan where id_pembangunan='$id'";
		$query = $this->db->query($sql);
	}
	public function create($id_perumahan,
						$id_kombinasi,
						$id_lokasi,$tahun,$triwulan)
	{
		$sql="INSERT INTO PEMBANGUNAN( id_perumahan,
									id_kombinasi,
									id_lokasi,
									tahun,
									triwulan)
									values(".$id_perumahan.",
										".$id_kombinasi.",
										".$id_lokasi.",
										".$tahun.",
										".$triwulan.");";
		$query = $this->db->query($sql);
	}
	public function add($id_perumahan,
						$id_kombinasi,
						$id_lokasi,
						$renc_rss,
						$renc_rs,
						$renc_rm,
						$renc_mw,      
						$renc_ruko,
						$real_rss,
						$real_rs,
						$real_rm,
						$real_mw,
						$real_ruko,
						$catatan,$tahun,$periode)
	{
		$sql = "insert into pembangunan ( id_perumahan,
									id_kombinasi,
									id_lokasi,
									renc_rss,
									renc_rs,
									renc_rm,
									renc_mw,      
									renc_ruko,
									real_rss,
									real_rs,
									real_rm,
									real_mw,
									real_ruko,
									catatan,tahun,triwulan) 
			
								values (".$id_perumahan.",
										".$id_kombinasi.",
										".$id_lokasi.",
										'".$renc_rss."',
										'".$renc_rs."',
										'".$renc_rm."',
										'".$renc_mw."',      
										'".$renc_ruko."',
										'".$real_rss."',
										'".$real_rs."',
										'".$real_rm."',
										'".$real_mw."',
										'".$real_ruko."',
										'".$catatan."',
										'".$tahun."',
										'".$periode."');";
		$query = $this->db->query($sql);
		$sql="SELECT id_pembangunan FROM pembangunan ORDER BY id_pembangunan DESC LIMIT 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}


	
}
?>
