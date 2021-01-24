<?php 
/**
 * 
 */
class Tengkulak extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('tengkulak_model');
		//proteksi halaman
		$this->simple_login->cek_login();
	}
	public function index()
	{
		$tengkulak = $this->tengkulak_model->listing();

		$data = array(	'title'		=> 'Data Tengkulak',
						'tengkulak'	=> $tengkulak,
						'isi'		=> 'tengkulak/profil/'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//profil
	public function profil(){
		$id_user			= $this->session->userdata('id_user');
		$tengkulak 			= $this->tengkulak_model->detail($id_user);

		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_tengkulak', 'Nama Lengkap','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('telephon', 'Telephon','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()===FALSE){
			//end validation
		$data = array(	'title'				=> 'Halaman Dashboard Pelanggan',
						'tengkulak'			=> $tengkulak,
						'isi'				=> 'tengkulak/profil/list'
			);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			//masuk database
			$i = $this->input;
			//kalau password lebih dari 6 karakter, maka password diganti
				$data = array(	'id_tengkulak'		=> $tengkulak->id_tengkulak,
								'nama_tengkulak'	=> $i->post('nama_tengkulak'),
								'telephon'			=> $i->post('telephon'),
								'alamat'			=> $i->post('alamat'),
							);

			$this->tengkulak_model->edit($data);
			$this->session->set_flashdata('sukses','Update profil berhasil');
			redirect(base_url('admin/tengkulak/profil'), 'refresh');
		}
		//end masuk database
	}
	//tambah data
	public function tambah()
	{
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_tengkulak', 'Nama Tengkulak','required|is_unique[tb_tengkulak.nama_tengkulak]',
				array(	'required' 		=> '%s harus diisi',
						'is_unique'		=> '%s sudah ada. Buat tengkulak baru!'));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Tambah Tengkulak',
							'isi'		=> 'admin/tengkulak/tambah'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'slug_tengkulak'		=> $slug_tengkulak,
							'nama_tengkulak'		=> $i->post('nama_tengkulak')
						);
			$this->tengkulak_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/tengkulak'), 'refresh');
		}
	}

	//edit data
	public function edit($id_tengkulak)
	{
		$tengkulak = $this->tengkulak_model->detail($id_user);
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_tengkulak', 'Nama Tengkulak','required',
				array(	'required' 		=> '%s harus diisi'));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'		=> 'Edit Tengkulak Produk',
							'tengkulak'		=> $tengkulak,
							'isi'		=> 'admin/tengkulak/edit'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i = $this->input;
			$slug_tengkulak = url_title($this->input->post('nama_tengkulak'), 'dash', TRUE);
			$data = array(	'id_tengkulak'		=> $id_tengkulak,
							'slug_tengkulak'		=> $slug_tengkulak,
							'nama_tengkulak'		=> $i->post('nama_tengkulak'),
						);
			$this->tengkulak_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/tengkulak'), 'refresh');
		}
	}
	//delete tengkulak
	public function delete($id_tengkulak){
		$data = array('id_tengkulak' => $id_tengkulak);
		$this->tengkulak_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/tengkulak'), 'refresh');
	}
}