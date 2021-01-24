<?php 
/**
 * 
 */
class Pembayaran extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('distributor_model');
		$this->load->model('detail_transaksi_model');
		$this->load->model('transaksi_model');
		$this->load->model('rekening_model');
		//halaman ini diproteksi dengan simple_distributor => check login
		$this->simple_distributor->cek_login();
	}
}