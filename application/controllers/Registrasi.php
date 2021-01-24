<?php 
/**
 * 
 */
class Registrasi extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('distributor_model');
	}
	public function index()
	{
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_distributor', 'Nama Lengkap','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('email', 'Email','required|valid_email|is_unique[tb_distributor.email]',
				array(	'required' 		=> '%s harus diisi',
						'valid_email'	=> '%s tidak valid',
						'is_unique'		=> '%s sudah terdaftar'
					));
		$valid->set_rules('password', 'Password','required',
				array(	'required' 		=> '%s harus diisi',
					));

		if($valid->run()===FALSE){
			//end validation
		$data = array(	'title'		=> 'Registrasi Distributor',
						'isi'		=> 'registrasi/list'
						);
		$this->load->view('layout/wrapper',$data, FALSE);
		}else{
			//masuk database
			$i = $this->input;
			$data = array(	'status_distributor'	=> 'Pending',
							'nama_distributor'	=> $i->post('nama_distributor'),
							'email'				=> $i->post('email'),
							'password'			=> SHA1($i->post('password')),
							'telephon'			=> $i->post('telephon'),
							'alamat'			=> $i->post('alamat'),
							'tanggal_daftar'	=> date('Y-m-d H:i:s')
						);
			$this->distributor_model->tambah($data);
			//create session login distributor
			$this->session->set_userdata('email',$i->post('email'));
			$this->session->set_userdata('nama_distributor',$i->post('nama_distributor'));
			//end create session
			$this->session->set_flashdata('sukses','Registrasi berhasil');
			redirect(base_url('registrasi/sukses'), 'refresh');
		}
		//end masuk database
	}
	
	//sukses
	public function sukses()
	{
		$data = array(	'title'		=> 'Registrasi berhasil',
						'isi'		=> 'registrasi/sukses'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}