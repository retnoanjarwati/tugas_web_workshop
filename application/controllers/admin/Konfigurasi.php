<?php 
/**
 * 
 */
class Konfigurasi extends CI_Controller
{
	//Load Model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('konfigurasi_model');
	}
	//konfigurasi umum
	public function index()
	{
		$konfigurasi = $this->konfigurasi_model->listing();

		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('namaweb', 'Nama website','required',
				array(	'required' 		=> '%s harus diisi'));


		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'			=> 'Konfigurasi website',
							'konfigurasi'	=> $konfigurasi,
							'isi'			=> 'admin/konfigurasi/list'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$i 	= $this->input;
			$data = array(	'id_konfigurasi'		=> $konfigurasi->id_konfigurasi,
							'namaweb'				=> $i->post('namaweb'),
							'tagline'				=> $i->post('tagline'),
							'email'					=> $i->post('email'),
							'website'				=> $i->post('website'),
							'keywords'				=> $i->post('keywords'),
							'metatext'				=> $i->post('metatext'),
							'telephone'				=> $i->post('telephone'),
							'alamat'				=> $i->post('alamat'),
							'facebook'				=> $i->post('facebook'),
							'instagram'				=> $i->post('instagram'),
							'deskripsi'				=> $i->post('deskripsi')
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diupdate');
			redirect(base_url('admin/konfigurasi'), 'refresh');
		}
	}
	//konfigurasi logo website
	public function logo()
	{
		$konfigurasi = $this->konfigurasi_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('namaweb', 'Nama Website','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()){
			//chek jika gambar diganti
			if(!empty($_FILES['logo']['name'])){
			//hapus gambar
			unlink('./assets/upload/image/'.$konfigurasi->logo);
			unlink('./assets/upload/image/thumbs/'.$konfigurasi->logo);

			$config['upload_path']		= './assets/upload/image/';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2400';//dalam kb
			$config['max_width']		= '2024';
			$config['max_height']		= '2024';
			//$config['thumb_marker']		= '';

			$this->load->library('upload',$config);

			if( ! $this->upload->do_upload('logo')){
				
			//end validation

			$data = array(	'title'			=> 'Konfigurasi Logo Website',
							'konfigurasi'	=> $konfigurasi,
							'error'			=> $this->upload->display_errors(),
							'isi'			=> 'admin/konfigurasi/logo'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());
			//create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;
			$config['height']       	= 250;
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end
			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							'logo'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diupdate');
			redirect(base_url('admin/konfigurasi/logo'), 'refresh');
		}}else{
			//edit product tanpa ganti gambar
			$i = $this->input;
			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							//'logo'				=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diupdate');
			redirect(base_url('admin/Konfigurasi/logo'), 'refresh');
		}}
		$data = array(	'title'			=> 'Konfigurasi Logo Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/logo'
					);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		
	}
	//konfigurasi icon
	public function icon()
	{
		$konfigurasi = $this->konfigurasi_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('namaweb', 'Nama Website','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()){
			//chek jika gambar diganti
			if(!empty($_FILES['icon']['name'])){
			//hapus gambar
			unlink('./assets/upload/image/'.$konfigurasi->icon);
			unlink('./assets/upload/image/thumbs/'.$konfigurasi->icon);

			$config['upload_path']		= './assets/upload/image/';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2400';//dalam kb
			$config['max_width']		= '2024';
			$config['max_height']		= '2024';
			//$config['thumb_marker']		= '';

			$this->load->library('upload',$config);

			if( ! $this->upload->do_upload('icon')){
				
			//end validation

			$data = array(	'title'			=> 'Konfigurasi Icon Website',
							'konfigurasi'	=> $konfigurasi,
							'error'			=> $this->upload->display_errors(),
							'isi'			=> 'admin/konfigurasi/icon'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());
			//create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			$config['new_image']		= './assets/upload/image/thumbs/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;
			$config['height']       	= 250;
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end
			$i = $this->input;

			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							'icon'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diupdate');
			redirect(base_url('admin/konfigurasi/icon'), 'refresh');
		}}else{
			//edit product tanpa ganti gambar
			$i = $this->input;
			$data = array(	'id_konfigurasi'	=> $konfigurasi->id_konfigurasi,
							'namaweb'			=> $i->post('namaweb'),
							//'logo'				=> $upload_gambar['upload_data']['file_name'],
						);
			$this->konfigurasi_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diupdate');
			redirect(base_url('admin/Konfigurasi/icon'), 'refresh');
		}}
		$data = array(	'title'			=> 'Konfigurasi Icon Website',
						'konfigurasi'	=> $konfigurasi,
						'isi'			=> 'admin/konfigurasi/icon'
					);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
}