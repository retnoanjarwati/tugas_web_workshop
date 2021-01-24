<?php 
/**
 * 
 */
class Masuk extends CI_Controller
{
	//load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('distributor_model');
	}
	//login distributor
	public function index()
	{
		//validasi
		$this->form_validation->set_rules('email','Email','required',
				array(	'required'	=> '%s harus diisi'));
		$this->form_validation->set_rules('password','Password','required',
				array(	'required'	=> '%s harus diisi'));

		if($this->form_validation->run())
		{
			$email 	= $this->input->post('email');
			$password 	= $this->input->post('password');
			//proses ke simple login
			$this->simple_distributor->login($email,$password);
		}
		//end validasi

		$data= array(	'title'		=> 'Login Distributor',
						'isi'		=> 'masuk/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function logout()
	{
		//ambil fungsi logout di simple_distributor yang sudah diset di autoload
		$this->simple_distributor->logout();
	}
}