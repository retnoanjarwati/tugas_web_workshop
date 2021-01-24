<?php 

/**
 * 
 */
class Transaksi_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//listing all transaksi
	public function listing(){
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->order_by('id_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//all transaksi
	public function Alltransaksi($id_user, $status){
		$this->db->select('tb_detail_transaksi.*,
							tb_distributor.nama_distributor,
							SUM(tb_transaksi.jumlah) AS total_item');
		$this->db->from('tb_detail_transaksi');
		//join
		$this->db->join('tb_transaksi','tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi', 'left');
		$this->db->join('tb_distributor', 'tb_distributor.id_distributor = tb_detail_transaksi.id_distributor', 'left');
		//end join
		$this->db->where('tb_detail_transaksi.status_bayar',$status);
		$this->db->where('tb_transaksi.id_user', $id_user);
		$this->db->group_by('tb_detail_transaksi.kode_transaksi');
		$this->db->order_by('kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function transaksi($id_user){
		$this->db->select('tb_detail_transaksi.*,
							tb_distributor.nama_distributor,
							SUM(tb_transaksi.jumlah) AS total_item');
		$this->db->from('tb_detail_transaksi');
		//join
		$this->db->join('tb_transaksi','tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi', 'left');
		$this->db->join('tb_distributor', 'tb_distributor.id_distributor = tb_detail_transaksi.id_distributor', 'left');
		//end join
		$this->db->where('tb_transaksi.id_user', $id_user);
		$this->db->group_by('tb_detail_transaksi.kode_transaksi');
		$this->db->order_by('kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing all transaksi berdasarkan header
	public function kode_transaksi($kode_transaksi){
		$this->db->select('tb_transaksi.*, 
						tb_product.nama_product,
						tb_product.kode_product');
		$this->db->from('tb_transaksi');
		//join
		$this->db->join('tb_product', 'tb_product.id_product = tb_transaksi.id_product', 'left');
		//end join
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->order_by('id_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing all transaksi berdasarkan header
	public function detail_transaksi($kode_transaksi, $id_user){
		$this->db->select('tb_transaksi.*, 
						tb_product.nama_product,
						tb_product.kode_product');
		$this->db->from('tb_transaksi');
		//join
		$this->db->join('tb_product', 'tb_product.id_product = tb_transaksi.id_product', 'left');
		//end join
		$this->db->where('tb_transaksi.kode_transaksi', $kode_transaksi);
		$this->db->where('tb_transaksi.id_user', $id_user);
		$this->db->order_by('id_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//detail
	public function detail($id_transaksi){
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->order_by('id_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//detail slug transaksi
	public function read($slug_transaksi){
		$this->db->select('*');
		$this->db->from('tb_transaksi');
		$this->db->where('slug_transaksi', $slug_transaksi);
		$this->db->order_by('id_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//tambah
	public function tambah($data)
	{
		$this->db->insert('tb_transaksi', $data);
	}
	//edit
	public function edit($data){
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->update('tb_transaksi',$data);
	}
	//delete
	public function delete($data){
		$this->db->where('id_transaksi', $data['id_transaksi']);
		$this->db->delete('tb_transaksi',$data);
	}
}