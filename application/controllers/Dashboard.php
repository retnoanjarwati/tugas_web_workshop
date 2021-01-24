<?php 
/**
 * 
 */
class Dashboard extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('distributor_model');
		$this->load->model('detail_transaksi_model');
		$this->load->model('transaksi_model');
		$this->load->model('rekening_model');
		$this->load->model('pembayaran_model');
		//halaman ini diproteksi dengan simple_distributor => check login
		$this->simple_distributor->cek_login();
	}
 
	//halaman dashboard
	public function index()
	{
		//ambil data login id_distributor dari session
		$id_distributor = $this->session->userdata('id_distributor');
		$detail_transaksi 	= $this->detail_transaksi_model->distributor($id_distributor);

		$data = array(	'title'				=> 'Halaman Dashboard Distributor',
						'detail_transaksi'	=> $detail_transaksi,
						'isi'				=> 'dashboard/list'
			);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function belanja()
	{
		//ambil data login id_distributor dari session
		$id_distributor = $this->session->userdata('id_distributor');
		$rekening 		= $this->rekening_model->listing();
		$detail_transaksi 	= $this->detail_transaksi_model->distributor($id_distributor);

		$data = array(	'title'				=> 'Halaman Dashboard Pelanggan',
						'detail_transaksi'	=> $detail_transaksi,
						'rekening'			=> $rekening,
						'isi'				=> 'dashboard/belanja'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//detail 
	public function detail($kode_transaksi)
	{
		//ambil data login id_distributor dari session
		$id_distributor 		= $this->session->userdata('id_distributor');
		$detail_transaksi 	= $this->detail_transaksi_model->kode_transaksi($kode_transaksi);
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);

		//pastikan bahwa distributor hanya mengakses data transaksinya
		if($detail_transaksi->id_distributor != $id_distributor){
			$this->session->set_flashdata('warning', 'Anda mencoba mengakses data transaksi orang lain');
			redirect(base_url('masuk'));
		}
		$data = array(	'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'transaksi'			=> $transaksi,
						'isi'				=> 'dashboard/detail'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	} 
	//profil
	public function profil(){
		$id_distributor		= $this->session->userdata('id_distributor');
		$distributor 		= $this->distributor_model->detail($id_distributor);

		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_distributor', 'Nama Lengkap','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('telephon', 'Telephon','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()===FALSE){
			//end validation

		$data = array(	'title'				=> 'Profil Saya',
						'distributor'		=> $distributor,
						'isi'				=> 'dashboard/profil'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
		}else{
			//masuk database
			$i = $this->input;
			//kalau password lebih dari 6 karakter, maka password diganti
			if(strlen($i->post('password')) >= 6){
				$data = array(	'id_distributor'		=> $id_distributor,
								'nama_distributor'	=> $i->post('nama_distributor'),
								'password'			=> SHA1($i->post('password')),
								'telephon'			=> $i->post('telephon'),
								'alamat'			=> $i->post('alamat'),
							);
			}else{
				//kalau password kurang dari 6 maka password ga diganti
				$data = array(	'id_distributor'		=> $id_distributor,
								'nama_distributor'	=> $i->post('nama_distributor'),
								'telephon'			=> $i->post('telephon'),
								'alamat'			=> $i->post('alamat'),
							);
			}
			$this->distributor_model->edit($data);
			$this->session->set_flashdata('sukses','Update profil berhasil');
			redirect(base_url('dashboard/profil'), 'refresh');
		}
		//end masuk database
	}
	//konfirmasi pembayaran
	public function konfirmasi($kode_transaksi)
	{
		$detail_transaksi 	= $this->detail_transaksi_model->kode_transaksi($kode_transaksi);
		$rekening 			= $this->rekening_model->listing();

		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_bank', 'Nama Bank','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('rekening_pembayaran', 'Nomor Rekening','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('tanggal_bayar', 'Tanggal Pembayaran','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('jumlah_bayar', 'Jumlah Pembayaran','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()){
			$config['upload_path']		= './assets/upload/image/';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2400';//dalam kb
			$config['max_width']		= '2024';
			$config['max_height']		= '2024';
			//$config['thumb_marker']		= '';

			$this->load->library('upload',$config);

			if( ! $this->upload->do_upload('bukti_bayar')){
				
			//end validation
				$data = array(	'title'				=> 'Konfirmasi Pembayaran',
								'detail_transaksi' 	=> $detail_transaksi,
								'rekening'			=> $rekening,
								'error'				=> $this->upload->display_errors(),
								'isi'				=> 'dashboard/konfirmasi'
								);
				$this->load->view('layout/wrapper', $data, FALSE);
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
			$data = array(	'kode_transaksi'		=> $detail_transaksi->kode_transaksi,
							//'status_bayar'			=> 'Konfirmasi',
							'jumlah_bayar'			=> $i->post('jumlah_bayar'),
							'rekening_pembayaran'	=> $i->post('rekening_pembayaran'),
							'rekening_distributor'	=> $i->post('rekening_distributor'),
							'bukti_bayar'			=> $upload_gambar['upload_data']['file_name'],
							'id_rekening'			=> $i->post('id_rekening'),
							'tanggal_bayar'			=> $i->post('tanggal_bayar'),
							'nama_bank'				=> $i->post('nama_bank')
						);
			$this->pembayaran_model->bayar($data);
			//update status bayar
			$data = array(	'kode_transaksi'	=>$detail_transaksi->kode_transaksi,
							'status_bayar'		=>'Konfirmasi'
							);
			$this->detail_transaksi_model->edit($data);
			$this->session->set_flashdata('sukses','Konfirmasi Pembayaran Berhasil');
			redirect(base_url('dashboard'), 'refresh');
		}}
		$data = array(	'title'				=> 'Konfirmasi Pembayaran',
						'detail_transaksi' 	=> $detail_transaksi,
						'rekening'			=> $rekening,
						'isi'				=> 'dashboard/konfirmasi'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//detail pembayaran
	public function bukti_bayar($kode_transaksi)
	{
		$detail_transaksi 	= $this->detail_transaksi_model->kode_transaksi($kode_transaksi);
		$pembayaran 		= $this->pembayaran_model->detail_bayar($kode_transaksi);
		$rekening 			= $this->rekening_model->listing();

		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_bank', 'Nama Bank','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('rekening_pembayaran', 'Nomor Rekening','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('tanggal_bayar', 'Tanggal Pembayaran','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('jumlah_bayar', 'Jumlah Pembayaran','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()){
			//chek jika gambar diganti
			if(!empty($_FILES['bukti_bayar']['name'])){
			//hapus gambar
			unlink('./assets/upload/image/'.$pembayaran->bukti_bayar);
			unlink('./assets/upload/image/thumbs/'.$pembayaran->bukti_bayar);

			$config['upload_path']		= './assets/upload/image/';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2400';//dalam kb
			$config['max_width']		= '2024';
			$config['max_height']		= '2024';
			//$config['thumb_marker']		= '';

			$this->load->library('upload',$config);

			if( ! $this->upload->do_upload('bukti_bayar')){
				
			//end validation
				$data = array(	'title'				=> 'Konfirmasi Pembayaran',
								'detail_transaksi' 	=> $detail_transaksi,
								'rekening'			=> $rekening,
								'pembayaran'		=> $pembayaran,
								'error'				=> $this->upload->display_errors(),
								'isi'				=> 'dashboard/bukti_bayar'
								);
				$this->load->view('layout/wrapper', $data, FALSE);
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
			$data = array(	'kode_transaksi'		=> $pembayaran->kode_transaksi,
							//'status_bayar'			=> 'Konfirmasi',
							'jumlah_bayar'			=> $i->post('jumlah_bayar'),
							'rekening_pembayaran'	=> $i->post('rekening_pembayaran'),
							'rekening_distributor'	=> $i->post('rekening_distributor'),
							'bukti_bayar'			=> $upload_gambar['upload_data']['file_name'],
							'id_rekening'			=> $i->post('id_rekening'),
							'tanggal_bayar'			=> $i->post('tanggal_bayar'),
							'nama_bank'				=> $i->post('nama_bank')
						);
			$this->pembayaran_model->edit($data);
			$this->session->set_flashdata('sukses','Konfirmasi Pembayaran Berhasil');
			redirect(base_url('dashboard'), 'refresh');
		}}else{
			//edit product tanpa ganti gambar
			$i = $this->input;
			$data = array(	'kode_transaksi'		=> $pembayaran->kode_transaksi,
							//'status_bayar'			=> 'Konfirmasi',
							'jumlah_bayar'			=> $i->post('jumlah_bayar'),
							'rekening_pembayaran'	=> $i->post('rekening_pembayaran'),
							'rekening_distributor'	=> $i->post('rekening_distributor'),
							//'bukti_bayar'			=> $upload_gambar['upload_data']['file_name'],
							'id_rekening'			=> $i->post('id_rekening'),
							'tanggal_bayar'			=> $i->post('tanggal_bayar'),
							'nama_bank'				=> $i->post('nama_bank')
						);
			$this->detail_transaksi_model->edit($data);
			$this->session->set_flashdata('sukses','Konfirmasi Pembayaran Berhasil');
			redirect(base_url('dashboard'), 'refresh');
		}}
		$data = array(	'title'				=> 'Konfirmasi Pembayaran',
						'detail_transaksi' 	=> $detail_transaksi,
						'rekening'			=> $rekening,
						'pembayaran'		=> $pembayaran,
						'isi'				=> 'dashboard/bukti_bayar'
					);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function selesai($kode_transaksi)
	{
			$data = array(	'kode_transaksi'	=> $kode_transaksi,
							'status_bayar'		=> 'Selesai'
						);
			$this->detail_transaksi_model->update_status($data);
			$this->session->set_flashdata('sukses','Transaksi Selesai');
			redirect(base_url('dashboard'), 'refresh');
	}
}