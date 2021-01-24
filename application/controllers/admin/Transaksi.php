<?php 
/**
 * 
 */
class Transaksi extends CI_Controller
{
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_model');
		$this->load->model('rekening_model');
		$this->load->model('detail_transaksi_model');
	}
	public function index()
	{
		$detail_transaksi = $this->detail_transaksi_model->listing();
		$data = array(	'title'				=> 'Data Transaksi',
						'detail_transaksi'	=> $detail_transaksi,
						'isi'				=> 'admin/transaksi/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//detail
	public function detail($kode_transaksi)
	{
		$detail_transaksi 	= $this->detail_transaksi_model->kode_transaksi($kode_transaksi);
		$id_rekening = $detail_transaksi->id_rekening;
		$transaksi 			= $this->transaksi_model->kode_transaksi($kode_transaksi);
		$rekening = $this->rekening_model->detail($id_rekening);

		$data = array(	'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'transaksi'			=> $transaksi,
						'rekening'			=> $rekening,
						'isi'				=> 'admin/transaksi/detail'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function status($kode_transaksi)
	{
			$data = array(	'kode_transaksi'	=> $kode_transaksi,
							'status_bayar'		=> 'Sudah Bayar'
						);
			$this->detail_transaksi_model->update_status($data);
			$this->session->set_flashdata('sukses','Status Telah Diubah');
			redirect(base_url('admin/transaksi'), 'refresh');
	}
}