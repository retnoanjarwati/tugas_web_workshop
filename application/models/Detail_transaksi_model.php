<?php 

/**
 * 
 */
class Detail_transaksi_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct(); 
		$this->load->database();
	}
	//listing all detail_transaksi
	public function listing(){
		$this->db->select('tb_detail_transaksi.*,
							tb_distributor.nama_distributor,
							SUM(tb_transaksi.jumlah) AS total_item');
		$this->db->from('tb_detail_transaksi');
		//join
		$this->db->join('tb_transaksi','tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi', 'left');
		$this->db->join('tb_distributor', 'tb_distributor.id_distributor = tb_detail_transaksi.id_distributor', 'left');
		//end join
		$this->db->group_by('tb_detail_transaksi.kode_transaksi');
		$this->db->order_by('kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing all distributor
	public function distributor($id_distributor){
		$this->db->select('tb_detail_transaksi.*,
							SUM(tb_transaksi.jumlah) AS total_item');
		$this->db->from('tb_detail_transaksi');
		$this->db->where('tb_detail_transaksi.id_distributor', $id_distributor);
		$this->db->join('tb_transaksi','tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi', 'left');
		$this->db->group_by('tb_detail_transaksi.kode_transaksi');
		$this->db->order_by('kode_transaksi','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//detail
	public function kode_transaksi($kode_transaksi){
		$this->db->select('tb_detail_transaksi.*,
							tb_pembayaran.bukti_bayar, tb_pembayaran.tanggal_bayar, tb_pembayaran.jumlah_bayar,
							tb_pembayaran.rekening_pembayaran,tb_pembayaran.nama_bank, tb_pembayaran.rekening_distributor,tb_pembayaran.id_rekening,
							tb_distributor.nama_distributor,
							SUM(tb_transaksi.jumlah) AS total_item');
		$this->db->from('tb_detail_transaksi');
		//join
		$this->db->join('tb_transaksi','tb_transaksi.kode_transaksi = tb_detail_transaksi.kode_transaksi', 'left');
		$this->db->join('tb_distributor', 'tb_distributor.id_distributor = tb_detail_transaksi.id_distributor', 'left');
		$this->db->join('tb_pembayaran', 'tb_pembayaran.kode_transaksi = tb_detail_transaksi.kode_transaksi', 'left');
		//end join
		$this->db->group_by('tb_detail_transaksi.kode_transaksi');
		$this->db->where('tb_transaksi.kode_transaksi', $kode_transaksi);
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//detail
	public function detail($kode_transaksi){
		$this->db->select('*');
		$this->db->from('tb_detail_transaksi');
		$this->db->where('kode_transaksi', $kode_transaksi);
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	public function update_status($data)
	{
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_detail_transaksi',$data);
	}
	//detail_transaksi sudah login
	public function sudah_login($email, $nama_detail_transaksi)
	{
		$this->db->select('*');
		$this->db->from('tb_detail_transaksi');
		$this->db->where('email', $email);
		$this->db->where('nama_detail_transaksi', $nama_detail_transaksi);
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}

	//login detail_transaksi
	public function login($email, $password)
	{
		$this->db->select('*');
		$this->db->from('tb_detail_transaksi');
		$this->db->where(array(	'email'	=> $email,
								'password'	=> SHA1($password)));
		$this->db->order_by('kode_transaksi','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//tambah
	public function tambah($data)
	{
		$this->db->insert('tb_detail_transaksi', $data);
	}
	//edit
	public function edit($data){
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->update('tb_detail_transaksi',$data);
	}
	//delete
	public function delete($data){
		$this->db->where('kode_transaksi', $data['kode_transaksi']);
		$this->db->delete('tb_detail_transaksi',$data);
	}
}