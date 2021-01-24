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
	}

	//listing data product
	public function index()
	{
		$site				= $this->konfigurasi_model->listing();
		$listing_kategori 	= $this->product_model->listing_kategori();
		//ambil data detail
		$total				= $this->product_model->total_product();
		//pagination start
		$this->load->library('pagination');

		$config['base_url']			= base_url().'product/index/';
		$config['total_rows']		= $total->total;
		$config['use_page_numbers']	= TRUE;
		$config['per_page']			= 6;
		$config['uri_segment']		= 3;
		$config['num_links']		= 5;
		$config['full_tag_open']	= '<ul class="pagination">';
		$config['full_tag_close']	= '</ul>';
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_tag_open']	= '<li class="disabled"><li class="active"><a href="#">';
		$config['last_tag_close']	= '<span class="sr-only"></a></li></li>';
		$config['next_link']		= '&gt;';
		$config['next_tag_open']	= '<div>';
		$config['next_tag_close']	= '</div>';
		$config['prev_link']		= '&lt;';
		$config['prev_tag_open']	= '<div>';
		$config['prev_tag_close']	= '</div>';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close']	= '</b>';
		$config['first_url']		= base_url().'/product/';
		$this->pagination->initialize($config);

		//ambil data product
		$page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $config['per_page']:0;
		$product 	= $this->product_model->product($config['per_page'], $page);
		//pagination end

		$data	= array(	'title'				=> 'Product '.$site->namaweb,
							'site'				=> $site,
							'listing_kategori'	=> $listing_kategori,
							'product'			=> $product,
							'pagin'				=> $this->pagination->create_links(),
							'isi'				=> 'product/list'
							);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//listing data kategori
	public function kategori($slug_kategori)
	{
		//kategori detail
		$kategori 			= $this->kategori_model->read($slug_kategori);
		$id_kategori		= $kategori->id_kategori;
		//data global
		$site				= $this->konfigurasi_model->listing();
		$listing_kategori 	= $this->product_model->listing_kategori();
		//ambil data detail
		$total				= $this->product_model->total_kategori($id_kategori);
		//pagination start
		$this->load->library('pagination');

		$config['base_url']			= base_url().'product/kategori/'.$slug_kategori.'/index/';
		$config['total_rows']		= $total->total;
		$config['use_page_numbers']	= TRUE;
		$config['per_page']			= 2;
		$config['uri_segment']		= 5;
		$config['num_links']		= 5;
		$config['full_tag_open']	= '<ul class="pagination">';
		$config['full_tag_close']	= '</ul>';
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_tag_open']	= '<li class="disabled"><li class="active"><a href="#">';
		$config['last_tag_close']	= '<span class="sr-only"></a></li></li>';
		$config['next_link']		= '&gt;';
		$config['next_tag_open']	= '<div>';
		$config['next_tag_close']	= '</div>';
		$config['prev_link']		= '&lt;';
		$config['prev_tag_open']	= '<div>';
		$config['prev_tag_close']	= '</div>';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close']	= '</b>';
		$config['first_url']		= base_url().'/product/kategori/'.$slug_kategori;
		$this->pagination->initialize($config);

		//ambil data product
		$page 		= ($this->uri->segment(5)) ? ($this->uri->segment(5)-1) * $config['per_page']:0;
		$product 	= $this->product_model->kategori($id_kategori, $config['per_page'], $page);
		//pagination end

		$data	= array(	'title'				=> $kategori->nama_kategori,
							'site'				=> $site,
							'listing_kategori'	=> $listing_kategori,
							'product'			=> $product,
							'pagin'				=> $this->pagination->create_links(),
							'isi'				=> 'product/list' 
							);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	//detail product
	public function detail($slug_product)
	{
		$site				= $this->konfigurasi_model->listing();
		$product 			= $this->product_model->read($slug_product);
		$id_product			= $product->id_product;
		$gambar				= $this->product_model->gambar($id_product);
		$product_related	= $this->product_model->home();

		$data	= array(	'title'				=> $product->nama_product,
							'site'				=> $site,
							'product'			=> $product,
							'product_related'	=> $product_related,
							'gambar'			=> $gambar,
							'isi'				=> 'product/detail'
							);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}