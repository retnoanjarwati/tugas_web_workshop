<?php 

/**
 * 
 */
class User_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all user
	public function listing(){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->order_by('id_user','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_latest_id(){
		$this->db->select(MAX('id_user'));
		$this->db->from('tb_user');
		$query = $this->db->get();
		return $query->row();
	} 
	//detail
	public function detail($id_user){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('id_user', $id_user);
		$this->db->order_by('id_user','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//login user
	public function login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where(array(	'username'	=> $username,
								'password'	=> SHA1($password)));
		$this->db->order_by('id_user','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//tambah
	public function tambah($data)
	{
		$this->db->insert('tb_user', $data);
    	return $this->db->insert_id();// return last insert id
	}
	//edit
	public function edit($data){
		$this->db->where('id_user', $data['id_user']);
		$this->db->update('tb_user',$data);
	}
	//delete
	public function delete($data){
		$this->db->where('id_user', $data['id_user']);
		$this->db->delete('tb_user',$data);
	}
}