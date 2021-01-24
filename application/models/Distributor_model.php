<?php 

/**
 * 
 */
class Distributor_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all distributor
	public function listing(){
		$this->db->select('*');
		$this->db->from('tb_distributor');
		$this->db->order_by('id_distributor','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//login
	public function login($email,$password){
		$this->db->select('*');
		$this->db->from('tb_distributor');
		$this->db->where(array(	'email'		=> $email,
								'password'	=> SHA1($password)
								));
		$this->db->order_by('id_distributor','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//detail
	public function detail($id_distributor){
		$this->db->select('*');
		$this->db->from('tb_distributor');
		$this->db->where('id_distributor', $id_distributor);
		$this->db->order_by('id_distributor','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//distributor sudah login
	public function sudah_login($email, $nama_distributor)
	{
		$this->db->select('*');
		$this->db->from('tb_distributor');
		$this->db->where('email', $email);
		$this->db->where('nama_distributor', $nama_distributor);
		$this->db->order_by('id_distributor','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//tambah
	public function tambah($data)
	{
		$this->db->insert('tb_distributor', $data);
	}
	//edit
	public function edit($data){
		$this->db->where('id_distributor', $data['id_distributor']);
		$this->db->update('tb_distributor',$data);
	}
	//delete
	public function delete($data){
		$this->db->where('id_distributor', $data['id_distributor']);
		$this->db->delete('tb_distributor',$data);
	}
}