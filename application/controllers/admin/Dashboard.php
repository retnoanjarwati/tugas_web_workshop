<?php 
/**
 * 
 */
//load model
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		//proteksi halaman
		$this->simple_login->cek_login();
	}
	public function index(){
		$data = array('title' => 'Halaman Administrator',
						'isi' => 'admin/dashboard/list' );
		$this->load->view('admin/layout/wrapper',$data, FALSE);
	}
}