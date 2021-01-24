<?php 
/**
 * 
 */
class Simple_distributor
{
	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		//load data model user
		$this->CI->load->model('distributor_model');
	}

	//fungsi login
	public function login($email, $password)
	{
		$check = $this->CI->distributor_model->login($email, $password);
		//jika ada data user, maka create session login
		if($check){
			$id_distributor	= $check->id_distributor;
			$nama_distributor	= $check->nama_distributor;
			//create session
			$this->CI->session->set_userdata('id_distributor',$id_distributor);
			$this->CI->session->set_userdata('nama_distributor',$nama_distributor);
			$this->CI->session->set_userdata('email',$email);
			//redirect ke halaman admin yang diproteksi
			redirect(base_url('dashboard'),'refresh');
		}else{
			//kalau tidak ada, maka suruh login lagi
			$this->CI->session->set_flashdata('warning','email atau password salah');
			redirect(base_url('masuk'),'refresh');
		}
	}

	//fungsi cek login
	public function cek_login()
	{
		//memeriksa apakah session sudah atau belum, jika belum alihkan ke halaman login
		if($this->CI->session->userdata('email')==""){
			$this->CI->session->set_flashdata('warning','Anda belum login');
			redirect(base_url('masuk'),'refresh');
		}
	}

	//fungsi logout
	public function logout()
	{
		//membuang semua session yang telah diset pada saat login
		$this->CI->session->unset_userdata('id_distributor');
		$this->CI->session->unset_userdata('nama_distributor');
		$this->CI->session->unset_userdata('email');
		//setelah session dibuang, maka redirect ke login
		$this->CI->session->set_flashdata('sukses','Anda berhasil logout');
		redirect(base_url('masuk'),'refresh');
	}
}