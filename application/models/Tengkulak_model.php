<?php 

/**
 * 
 */
class Tengkulak_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all tengkulak
	public function listing(){
		$this->db->select('*');
		$this->db->from('tb_tengkulak');
		$this->db->order_by('id_tengkulak','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//detail
	public function detail($id_user){
		$this->db->select('*');
		$this->db->from('tb_tengkulak');
		$this->db->where('id_user', $id_user);
		$this->db->order_by('id_tengkulak','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//detail slug tengkulak
	public function read($slug_tengkulak){
		$this->db->select('*');
		$this->db->from('tb_tengkulak');
		$this->db->where('slug_tengkulak', $slug_tengkulak);
		$this->db->order_by('id_tengkulak','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//login tengkulak
	public function login($tengkulakname, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_tengkulak');
		$this->db->where(array(	'tengkulakname'	=> $tengkulakname,
								'password'	=> SHA1($password)));
		$this->db->order_by('id_tengkulak','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//tambah
	public function tambah($data)
	{
		$this->db->insert('tb_tengkulak', $data);
	}
	//edit
	public function edit($data){
		$this->db->where('id_tengkulak', $data['id_tengkulak']);
		$this->db->update('tb_tengkulak',$data);
	}
	//delete
	public function delete($data){
		$this->db->where('id_tengkulak', $data['id_tengkulak']);
		$this->db->delete('tb_tengkulak',$data);
	}
}