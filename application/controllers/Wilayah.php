<?php 
/**
 * 
 */
class Wilayah extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('wilayah_model');
	}

	public function index(){
		$wilayah = $this->wilayah_model->listing();

		$data = array(	'title'		=> 'Data Wilayah',
						'wilayah'	=> $wilayah,
						'isi'		=> 'wilayah/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	

	public function get_wilayah(){
		$data = $this->input->post('data');
		$id = $this->input->post('id');
		

		$n=strlen($id);
		$m=($n==2?5:($n==5?8:13));

	if($data == "kabupaten"){
		$wilayah = $this->wilayah_model->get_kabupaten($n,$id,$m);
		 foreach ($wilayah as $wilayah) {
		 	$data1 ="<option value='$wilayah->kode'>$wilayah->nama</option>";
		 	echo $data1;
		 }

	}elseif($data == "kecamatan"){
		$wilayah = $this->wilayah_model->get_desa($n,$id,$m);
		//$data1 ="<option value=''> $n </option>";
		  foreach ($wilayah as $wilayah) {
		  	$data1 ="<option value='$wilayah->kode'> $wilayah->nama</option>";
		  	echo $data1;
		  }
		//echo $data1;

	}else if($data == "desa"){
		
	}

	}
	public function ongkir(){
		$data = $this->input->post('id');

		//$wilayah = $this->wilayah_model->get_desa($n,$id,$m);
		$kendaraan = $this->wilayah_model->get_ongkir($data);
		foreach ($kendaraan as $kendaraan) {
		  	$data1 ="<option dataongkir='$kendaraan->ongkir' expedisi='$kendaraan->kendaraan' value='$kendaraan->id_ongkir'> $kendaraan->kendaraan</option>";
		  	echo $data1;
		  }
		//$data1 ="<option value=''> $data </option>";
		  
		//echo $data1;
	}

	public function get_ongkir(){
		$data = $this->input->post('id');
		
		//$wilayah = $this->wilayah_model->get_desa($n,$id,$m);
		$ongkir2 = $this->wilayah_model->get_ongkir2($data);
		foreach ($ongkir2 as $ongkir2) {
		  	$data1 ="<label dataongkir='$ongkir2->ongkir'> $ongkir2->ongkir </label>";
		  	echo $data1;
		  }
		// $data1 ="<option value=''> $ongkir2->ongkir </option>";
		  
		// echo $data1;
	}

	public function get_total(){
		$data = $this->input->post('id');
		
		$data1 ="<label value=''> $data </label>";
		  
		 echo $data1;
	}
}