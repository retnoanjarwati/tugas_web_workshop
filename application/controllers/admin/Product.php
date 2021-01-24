<?php 
/**
 * 
 */
class Product extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('kategori_model');
		//proteksi halaman
		$this->simple_login->cek_login();
	}
	public function index() 
	{ 
		$id_user = $this->session->userdata('id_user');
		$akses_level = $this->session->userdata('akses_level');

		if($akses_level=='Admin'){
			$product = $this->product_model->listing();
		}else{
			$product = $this->product_model->listing_user($id_user);
		}
		
		$data = array(	'title'		=> 'Data Product',
						'product'	=> $product,
						'isi'		=> 'admin/product/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//gambar
	public function gambar($id_product){
		$product = $this->product_model->detail($id_product);
		$gambar = $this->product_model->gambar($id_product);

		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('judul_gambar', 'Judul/Nama Product','required',
				array(	'required' 		=> '%s harus diisi'));


		if($valid->run()){
			$config['upload_path']		= './assets/upload/image/thumbs';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2400';//dalam kb
			$config['max_width']		= '2024';
			$config['max_height']		= '2024';

			$this->load->library('upload',$config);

			if( ! $this->upload->do_upload('gambar')){
				
			//end validation

			$data = array(	'title'		=> 'Tambah Gambar Product: '.$product->nama_product,
							'product'	=> $product,
							'gambar'	=> $gambar,
							'error'		=> $this->upload->display_errors(),
							'isi'		=> 'admin/product/gambar'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			//create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/thumbs'.$upload_gambar['upload_data']['file_name'];
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

			$data = array(	'id_product'		=> $id_product,
							'judul_gambar'		=> $i->post('judul_gambar'),
							'gambar'			=> $upload_gambar['upload_data']['file_name'],
						);
			$this->product_model->tambah_gambar($data); 
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/product/gambar/'.$id_product), 'refresh');
		}}
		$data = array(	'title'		=> 'Tambah Gambar Product: '.$product->nama_product,
						'product'	=> $product,
						'gambar'	=> $gambar,
						'isi'		=> 'admin/product/gambar'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//tambah data
	public function tambah()
	{
		//ambil data kategori
		$kategori = $this->kategori_model->listing();
		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_product', 'Nama Product','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('kode_product', 'Kode Product','required|is_unique[tb_product.kode_product]',
				array(	'required' 		=> '%s harus diisi',
						'is_unique'		=> '%s sudah ada. Buat kode produk baru'));

		if($valid->run()){
			$config['upload_path']		= './assets/upload/image/thumbs';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2400';//dalam kb
			$config['max_width']		= '2024';
			$config['max_height']		= '2024';

			$this->load->library('upload',$config);

			if( ! $this->upload->do_upload('gambar')){
				
			//end validation

			$data = array(	'title'		=> 'Tambah Product',
							'kategori'	=> $kategori,
							'error'		=> $this->upload->display_errors(),
							'isi'		=> 'admin/product/tambah'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			//create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/thumbs'.$upload_gambar['upload_data']['file_name'];
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
			//slug
			$slug_kategori = url_title($this->input->post('nama_product').'-'.$this->input->post('kode_product'), 'dash', TRUE);
			$data = array(	'id_user'			=> $this->session->userdata('id_user'),
							'id_kategori'		=> $i->post('id_kategori'),
							'kode_product'		=> $i->post('kode_product'),
							'nama_product'		=> $i->post('nama_product'),
							'slug_product'		=> $slug_kategori,
							'keterangan'		=> $i->post('keterangan'),
							'harga'				=> $i->post('harga'),
							'stok'				=> $i->post('stok'),
							'gambar'			=> $upload_gambar['upload_data']['file_name'],
							'status_product'	=> $i->post('status_product'),
							'tanggal_post'		=> date('Y-m-d H:i:s')
						);
			$this->product_model->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('admin/product'), 'refresh');
		}}
		$data = array(	'title'		=> 'Tambah Product',
							'kategori'	=> $kategori,
							'isi'		=> 'admin/product/tambah'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//edit data
	public function edit($id_product)
	{
		//ambil data product yg akan di edit
		$product = $this->product_model->detail($id_product);
		//ambil data kategori
		$kategori = $this->kategori_model->listing();

		//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_product', 'Nama Product','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('kode_product', 'Kode Product','required',
				array(	'required' 		=> '%s harus diisi'));

		if($valid->run()){
			//chek jika gambar diganti
			if(!empty($_FILES['gambar']['name'])){
			//hapus gambar
			//unlink('./assets/upload/image/'.$product->gambar);
			unlink('./assets/upload/image/thumbs/'.$product->gambar);

			$config['upload_path']		= './assets/upload/image/thumbs';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2400';//dalam kb
			$config['max_width']		= '2024';
			$config['max_height']		= '2024';
			//$config['thumb_marker']		= '';

			$this->load->library('upload',$config);

			if( ! $this->upload->do_upload('gambar')){
				
			//end validation

			$data = array(	'title'		=> 'Edit Product'.$product->nama_product,
							'kategori'	=> $kategori,
							'product'	=> $product,
							'error'		=> $this->upload->display_errors(),
							'isi'		=> 'admin/product/edit'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		}else{
			$upload_gambar = array('upload_data' => $this->upload->data());

			//create thumbnail gambar
			$config['image_library'] 	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/thumbs'.$upload_gambar['upload_data']['file_name'];
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
			//slug
			$slug_kategori = url_title($this->input->post('nama_product').'-'.$this->input->post('kode_product'), 'dash', TRUE);
			$data = array(	'id_product'		=> $id_product,
							'id_user'			=> $this->session->userdata('id_user'),
							'id_kategori'		=> $i->post('id_kategori'),
							'kode_product'		=> $i->post('kode_product'),
							'nama_product'		=> $i->post('nama_product'),
							'slug_product'		=> $slug_kategori,
							'keterangan'		=> $i->post('keterangan'),
							'harga'				=> $i->post('harga'),
							'stok'				=> $i->post('stok'),
							'gambar'			=> $upload_gambar['upload_data']['file_name'],
							'status_product'	=> $i->post('status_product'),
						);
			$this->product_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/product'), 'refresh');
		}}else{
			//edit product tanpa ganti gambar
			$i = $this->input;
			//slug
			$slug_kategori = url_title($this->input->post('nama_product').'-'.$this->input->post('kode_product'), 'dash', TRUE);
			$data = array(	'id_product'		=> $id_product,
							'id_user'			=> $this->session->userdata('id_user'),
							'id_kategori'		=> $i->post('id_kategori'),
							'kode_product'		=> $i->post('kode_product'),
							'nama_product'		=> $i->post('nama_product'),
							'slug_product'		=> $slug_kategori,
							'keterangan'		=> $i->post('keterangan'),
							'harga'				=> $i->post('harga'),
							'stok'				=> $i->post('stok'),
							//'gambar'			=> $upload_gambar['upload_data']['file_name'],
							'status_product'	=> $i->post('status_product'),
						);
			$this->product_model->edit($data);
			$this->session->set_flashdata('sukses','Data telah diedit');
			redirect(base_url('admin/product'), 'refresh');
		}}
		$data = array(	'title'			=> 'Edit Product: '.$product->nama_product,
							'kategori'	=> $kategori,
							'product'	=> $product,
							'isi'		=> 'admin/product/edit'
						);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		
	}
	//delete product
	public function delete($id_product){
		//proses hapus gambar
		$product = $this->product_model->detail($id_product);
		//unlink('./assets/upload/image/'.$product->gambar);
		unlink('./assets/upload/image/thumbs/'.$product->gambar);
		//end hapus gambar

		$data = array('id_product' => $id_product);
		$this->product_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/product'), 'refresh');
	}

	//delete product
	public function delete_gambar($id_product, $id_gambar){
		//proses hapus gambar
		$gambar = $this->product_model->detail_gambar($id_gambar);
		//unlink('./assets/upload/image/'.$gambar->gambar);
		unlink('./assets/upload/image/thumbs/'.$gambar->gambar);
		//end hapus gambar

		$data = array('id_gambar' => $id_gambar);
		$this->product_model->delete_gambar($data);
		$this->session->set_flashdata('sukses', 'Data gambar telah dihapus');
		redirect(base_url('admin/product/gambar/'.$id_product), 'refresh');
	}
}