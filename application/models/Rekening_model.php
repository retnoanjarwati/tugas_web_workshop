<?php 

/**
 * 
 */
class Rekening_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all rekening
	public function listing(){
		$this->db->select('*');
		$this->db->from('tb_rekening');
		$this->db->order_by('id_rekening','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//detail
	public function detail($id_rekening){
		$this->db->select('*');
		$this->db->from('tb_rekening');
		$this->db->where('id_rekening', $id_rekening);
		$this->db->order_by('id_rekening','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//tambah
	public function tambah($data)
	{
		$this->db->insert('tb_rekening', $data);
	}
	//edit
	public function edit($data){
		$this->db->where('id_rekening', $data['id_rekening']);
		$this->db->update('tb_rekening',$data);
	}
	//delete
	public function delete($data){
		$this->db->where('id_rekening', $data['id_rekening']);
		$this->db->delete('tb_rekening',$data);
	}
}