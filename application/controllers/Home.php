<?php 
/**
 * 
 */
class Home extends CI_Controller
{
	//load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model'); 
		$this->load->model('kategori_model');
		$this->load->model('konfigurasi_model');
	}
	
	public function index()
	{
		$site		= $this->konfigurasi_model->listing();
		$kategori 	= $this->konfigurasi_model->nav_product();
		$product 	= $this->product_model->home();

		$data = array(	'title'		=> 'tokoTaniku - Toko Online',
						'keywords'	=> $site->keywords,
						'deskripsi' => $site->deskripsi,
						'site'		=> $site,
						'kategori'	=> $kategori,
						'product'	=> $product,
						'isi'		=> 'home/list'
						); 
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}