<?php 
/**
 * 
 */
class Belanja extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('kategori_model');
		$this->load->model('konfigurasi_model');
		$this->load->model('distributor_model');
		$this->load->model('detail_transaksi_model');
		$this->load->model('transaksi_model');
		$this->load->model('wilayah_model');
		//load helper random string
		$this->load->helper('string');
	}
	//halaman belanja
	public function index()
	{
		$keranjang = $this->cart->contents();
		$data = array(	'title'		=> 'Keranjang Belanja',
						'keranjang' => $keranjang,
						'isi'		=> 'belanja/list'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//sukses checkout
	public function sukses()
	{
		$data = array(	'title'		=> 'Belanja Berhasil',
						'isi'		=> 'belanja/sukses'
						);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//checkout
	public function checkout()
	{
		//cek distributor sudah loggin atau belum, jika belum restrasi sekaligus login

		//kondisi sudah login
		if($this->session->userdata('email')){
			$email				= $this->session->userdata('email');
			$nama_distributor 	= $this->session->userdata('nama_distributor');
			$distributor 		= $this->distributor_model->sudah_login($email, $nama_distributor);
			$wilayah 			= $this->wilayah_model->listing();

			$keranjang 	= $this->cart->contents();

			//validation
		$valid = $this-> form_validation;

		$valid->set_rules('nama_distributor', 'Nama Lengkap','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('telephon', 'Nomor Telephon','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('alamat', 'Alamat','required',
				array(	'required' 		=> '%s harus diisi'));

		$valid->set_rules('email', 'Email','required|valid_email',
				array(	'required' 		=> '%s harus diisi',
						'valid_email'	=> '%s tidak valid'
					));

		if($valid->run()===FALSE){
			//end validation

			$data = array(	'title'			=> 'Checkout',
							'keranjang'		=> $keranjang,
							'distributor'	=> $distributor,
							'wilayah'		=> $wilayah,
							'isi'			=> 'belanja/checkout'
							);
			$this->load->view('layout/wrapper', $data, FALSE);
			//masuk database
			}else{
			//masuk database
			$i = $this->input;
			$data = array(	'id_distributor'	=> $distributor->id_distributor,
							//'id_user' 			=> $i->post('id_user'),
							'nama_distributor'	=> $i->post('nama_distributor'),
							'email'				=> $i->post('email'),
							'telephon'			=> $i->post('telephon'),
							'alamat'			=> $i->post('alamat'),
							'kode_transaksi'	=> $i->post('kode_transaksi'), 
							'tanggal_transaksi'	=> $i->post('tanggal_transaksi'),
							'expedisi'			=> $i->post('expedisi'),
							'ongkir'			=> $i->post('ongkir'),
							'total_bayar'		=> $i->post('total'),
							'jumlah_transaksi'	=> $i->post('jumlah_transaksi'),
							'status_bayar'		=> 'Belum Bayar',
							'tanggal_post'		=> date('Y-m-d H:i:s')
						);
			$this->detail_transaksi_model->tambah($data);
			//proses masuk ke tabel transaksi
			foreach ($keranjang as $keranjang) {
				$sub_total	= $keranjang['price'] * $keranjang['qty'] * 100;

				$data = array(	'id_distributor'	=> $distributor->id_distributor,
								'id_user'			=> $keranjang['coupon'],
								'kode_transaksi'	=> $i->post('kode_transaksi'),
								'id_product'		=> $keranjang['id'],
								'harga'				=> $keranjang['price'],
								'jumlah'			=> $keranjang['qty'],
								'total_harga'		=> $sub_total,
								'tanggal_transaksi'	=> $i->post('tanggal_transaksi')
								);
				$this->transaksi_model->tambah($data);
			}
			//end proses masuk ke tabel transaksi
			//hapus keranjang
			$this->cart->destroy();
			$this->session->set_flashdata('sukses','Checkout berhasil');
			redirect(base_url('belanja/sukses'), 'refresh');
		}
		//end masuk database
			//end database
		}else{
			//kalau belum, maka harus registrasi
			$this->session->set_flashdata('sukses','Silahkan Login atau Registrasi Terlebih Dahulu');
			redirect(base_url('registrasi'),'refresh');
		}
	}
	//tambahkan ke keranjang belanja
	public function add()
	{
		//ambil data dari form
		$id 			= $this->input->post('id');
		$id_user		= $this->input->post('id_user');
		$qty 			= $this->input->post('qty');
		$price 			= $this->input->post('price');
		$name 			= $this->input->post('name');
		$redirect_page 	= $this->input->post('redirect_page');
		//proses memasukkan ke keranjang belanja
		$data = array(	'id'	=> $id,
						'qty'	=> $qty,
						'price'	=> $price,
						'name'	=> $name,
						'coupon' => $id_user
						);
		$this->cart->insert($data);
		//redirect page
		redirect($redirect_page,'refresh');
	}
	//update cart
	public function update_cart($rowid)
	{
		//jika ada data rowid
		if($rowid)
		{
			$data = array(	'rowid'		=>$rowid,
							'qty'		=>$this->input->post('qty')
							);
			$this->cart->update($data);
			$this->session->set_flashdata('sukses','Data keranjang telah diupdate');
			redirect(base_url('belanja'),'refresh');
		}else{
			//jika ga ada row id
			redirect(base_url('belanja'),'refresh');
		}
	}
	//hapus semua isi keranjang belanja
	public function hapus($rowid='')
	{
		if($rowid){
			//hapus per item
			$this->cart->remove($rowid);
			$this->session->set_flashdata('sukses','Data keranjang belanja telah dihapus');
			redirect(base_url('belanja'), 'refresh');
		}else{
			//hapus all
			$this->cart->destroy();
			$this->session->set_flashdata('sukses','Data keranjang belanja telah dihapus');
			redirect(base_url('belanja'), 'refresh');
		}
		
	}
}