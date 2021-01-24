<?php 
/**
 * 
 */
class Wilayah_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function listing(){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('CHAR_LENGTH(kode)=2');
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_kabupaten($n,$id,$m){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('LEFT(kode,2)', $id);
		$this->db->where('CHAR_LENGTH(kode)', $m);
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_desa($n,$id,$m){
		$this->db->select('*');
		$this->db->from('wilayah_2020');
		$this->db->where('LEFT(kode,5)', $id);
		$this->db->where('CHAR_LENGTH(kode)', $m);
		$this->db->order_by('nama','asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_ongkir($kode){
		$this->db->select('*');
		$this->db->from('ongkir');
		$this->db->where('kode_wilayah',$kode);
		$this->db->order_by('id_ongkir','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_ongkir2($kode){
		$this->db->select('*');
		$this->db->from('ongkir');
		$this->db->where('id_ongkir',$kode);
		//$this->db->order_by('id_ongkir','asc');
		$query = $this->db->get();
		return $query->result();
	}
}