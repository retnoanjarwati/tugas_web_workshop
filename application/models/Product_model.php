<?php 

/**
 * 
 */
class Product_model extends CI_Model
{
	 
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	} 
	//listing all product
	public function listing(){
		$this->db->select('tb_product.*,
						tb_user.nama,
						tb_kategori.nama_kategori,
						tb_kategori.slug_kategori,
						COUNT(tb_gambar.id_gambar) AS total_gambar');
		$this->db->from('tb_product');
		//join
		$this->db->join('tb_user','tb_user.id_user = tb_product.id_user','left');
		$this->db->join('tb_kategori','tb_kategori.id_kategori = tb_product.id_kategori','left');
		$this->db->join('tb_gambar','tb_gambar.id_product = tb_product.id_product','left');
		//joid end
		$this->db->group_by('tb_product.id_product');
		$this->db->order_by('id_product','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing product per user
	public function listing_user($id_user)
	{
		$this->db->select('tb_product.*,
						tb_user.nama,
						tb_kategori.nama_kategori,
						tb_kategori.slug_kategori,
						COUNT(tb_gambar.id_gambar) AS total_gambar');
		$this->db->from('tb_product');

		//join
		$this->db->join('tb_user','tb_user.id_user = tb_product.id_user','left');
		$this->db->join('tb_kategori','tb_kategori.id_kategori = tb_product.id_kategori','left');
		$this->db->join('tb_gambar','tb_gambar.id_product = tb_product.id_product','left');
		//joid end
		$this->db->where('tb_product.id_user',$id_user);
		$this->db->group_by('tb_product.id_product');
		$this->db->order_by('id_product','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//listing all home
	public function home(){
		$this->db->select('tb_product.*,
						tb_user.nama as nama_user,
						tb_kategori.nama_kategori,
						tb_kategori.slug_kategori,
						COUNT(tb_gambar.id_gambar) AS total_gambar');
		$this->db->from('tb_product');
		//join
		$this->db->join('tb_user','tb_user.id_user = tb_product.id_user','left');
		$this->db->join('tb_kategori','tb_kategori.id_kategori = tb_product.id_kategori','left');
		$this->db->join('tb_gambar','tb_gambar.id_product = tb_product.id_product','left');
		//joid end
		$this->db->where('tb_product.status_product','Publish');
		$this->db->group_by('tb_product.id_product');
		$this->db->order_by('id_product','asc');
		$this->db->limit(12);
		$query = $this->db->get();
		return $query->result();
	}
	//listing read product
	public function read($slug_product){
		$this->db->select('tb_product.*,
						tb_user.nama,
						tb_kategori.nama_kategori,
						tb_kategori.slug_kategori,
						COUNT(tb_gambar.id_gambar) AS total_gambar');
		$this->db->from('tb_product');
		//join
		$this->db->join('tb_user','tb_user.id_user = tb_product.id_user','left');
		$this->db->join('tb_kategori','tb_kategori.id_kategori = tb_product.id_kategori','left');
		$this->db->join('tb_gambar','tb_gambar.id_product = tb_product.id_product','left');
		//joid end
		$this->db->where('tb_product.status_product','Publish');
		$this->db->where('tb_product.slug_product',$slug_product);
		$this->db->group_by('tb_product.id_product');
		$this->db->order_by('id_product','asc');
		$query = $this->db->get();
		return $query->row();
	}
	//product
	public function product($limit, $start){
		$this->db->select('tb_product.*,
						tb_user.nama as nama_user,
						tb_kategori.nama_kategori,
						tb_kategori.slug_kategori,
						COUNT(tb_gambar.id_gambar) AS total_gambar');
		$this->db->from('tb_product');
		//join
		$this->db->join('tb_user','tb_user.id_user = tb_product.id_user','left');
		$this->db->join('tb_kategori','tb_kategori.id_kategori = tb_product.id_kategori','left');
		$this->db->join('tb_gambar','tb_gambar.id_product = tb_product.id_product','left');
		//joid end
		$this->db->where('tb_product.status_product','Publish');
		$this->db->group_by('tb_product.id_product');
		$this->db->order_by('id_product','asc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query->result();
	}
	//total product
	public function total_product()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('tb_product');
		$this->db->where('status_product','Publish');
		$query = $this->db->get();
		return $query->row();
	}
	//kategori
	public function kategori($id_kategori,$limit, $start){
		$this->db->select('tb_product.*,
						tb_user.nama as nama_user,
						tb_kategori.nama_kategori,
						tb_kategori.slug_kategori,
						COUNT(tb_gambar.id_gambar) AS total_gambar');
		$this->db->from('tb_product');
		//join
		$this->db->join('tb_user','tb_user.id_user = tb_product.id_user','left');
		$this->db->join('tb_kategori','tb_kategori.id_kategori = tb_product.id_kategori','left');
		$this->db->join('tb_gambar','tb_gambar.id_product = tb_product.id_product','left');
		//joid end
		$this->db->where('tb_product.status_product','Publish');
		$this->db->where('tb_product.id_kategori', $id_kategori);
		$this->db->group_by('tb_product.id_product');
		$this->db->order_by('id_product','asc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query->result();
	}
	//total kategori
	public function total_kategori($id_kategori)
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('tb_product');
		$this->db->where('status_product','Publish');
		$this->db->where('id_kategori',$id_kategori);
		$query = $this->db->get();
		return $query->row();
	}
	//listing kategori
	public function listing_kategori(){
		$this->db->select('tb_product.*,
						tb_user.nama,
						tb_kategori.nama_kategori,
						tb_kategori.slug_kategori,
						COUNT(tb_gambar.id_gambar) AS total_gambar');
		$this->db->from('tb_product');
		//join
		$this->db->join('tb_user','tb_user.id_user = tb_product.id_user','left');
		$this->db->join('tb_kategori','tb_kategori.id_kategori = tb_product.id_kategori','left');
		$this->db->join('tb_gambar','tb_gambar.id_product = tb_product.id_product','left');
		//joid end
		$this->db->group_by('tb_product.id_kategori');
		$this->db->order_by('id_product','asc');
		$query = $this->db->get();
		return $query->result();
	}

	//detail
	public function detail($id_product){
		$this->db->select('*');
		$this->db->from('tb_product');
		$this->db->where('id_product', $id_product);
		$this->db->order_by('id_product','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//detail gambar
	public function detail_gambar($id_gambar){
		$this->db->select('*');
		$this->db->from('tb_gambar');
		$this->db->where('id_gambar', $id_gambar);
		$this->db->order_by('id_gambar','desc');
		$query = $this->db->get();
		return $query->row();
	}
	//gambar
	public function gambar($id_product){
		$this->db->select('*');
		$this->db->from('tb_gambar');
		$this->db->where('id_product', $id_product);
		$this->db->order_by('id_gambar','desc');
		$query = $this->db->get();
		return $query->result();
	}

	//tambah
	public function tambah($data)
	{
		$this->db->insert('tb_product', $data);
	}
	//tambah
	public function tambah_gambar($data)
	{
		$this->db->insert('tb_gambar', $data);
	}
	//edit
	public function edit($data){
		$this->db->where('id_product', $data['id_product']);
		$this->db->update('tb_product',$data);
	}
	//delete
	public function delete($data){
		$this->db->where('id_product', $data['id_product']);
		$this->db->delete('tb_product',$data);
	}
	//delete gambar
	public function delete_gambar($data){
		$this->db->where('id_gambar', $data['id_gambar']);
		$this->db->delete('tb_gambar',$data);
	}
}