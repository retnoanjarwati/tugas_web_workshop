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
		$id_user		= $this->session->userdata('id_user');
		$All_transaksi 	= $this->transaksi_model->Alltransaksi($id_user, 'Sudah Bayar');
		$diproses		= $this->transaksi_model->Alltransaksi($id_user,'Diproses');
		$dikirim		= $this->transaksi_model->Alltransaksi($id_user,'Dikirim');
		$selesai		= $this->transaksi_model->Alltransaksi($id_user,'Selesai');
		$trans 			= $this->detail_transaksi_model->listing();
		$data = array(	'title'				=> 'Data Transaksi',
						'All_transaksi'		=> $All_transaksi,
						'diproses'			=> $diproses,
						'dikirim'			=> $dikirim,
						'selesai'			=> $selesai,
						'trans'				=> $trans,
						'isi'				=> 'transaksi/list'
						);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//semua transaksi
	public function transaksi_tengkulak()
	{
		$id_user		  = $this->session->userdata('id_user');
		$transaksi_tengkulak 	= $this->transaksi_model->transaksi($id_user);
		$data = array(	'title'				=> 'Semua Transaksi',
						'transaksi_tengkulak'		=> $transaksi_tengkulak,
						'isi'				=> 'transaksi/transaksi_tengkulak'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	//detail
	public function detail($kode_transaksi)
	{
		$id_user		  = $this->session->userdata('id_user');
		$detail_transaksi 	= $this->detail_transaksi_model->kode_transaksi($kode_transaksi);
		$id_rekening = $detail_transaksi->id_rekening;
		$transaksi 			= $this->transaksi_model->detail_transaksi($kode_transaksi, $id_user);
		$rekening = $this->rekening_model->detail($id_rekening);

		$data = array(	'title'				=> 'Riwayat Belanja',
						'detail_transaksi'	=> $detail_transaksi,
						'transaksi'			=> $transaksi,
						'rekening'			=> $rekening,
						'isi'				=> 'admin/transaksi/detail'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
	public function diproses($kode_transaksi)
	{
			$data = array(	'kode_transaksi'	=> $kode_transaksi,
							'status_bayar'		=> 'Diproses'
						);
			$this->detail_transaksi_model->update_status($data);
			$this->session->set_flashdata('sukses','Status Telah Diubah');
			redirect(base_url('transaksi'), 'refresh');
	}
	public function dikirim($kode_transaksi)
	{
			$data = array(	'kode_transaksi'	=> $kode_transaksi,
							'no_resi'			=> $this->input->post('no_resi'),
							'status_bayar'		=> 'Dikirim'
						);
			$this->detail_transaksi_model->update_status($data);
			$this->session->set_flashdata('sukses','Status Telah Diubah');
			redirect(base_url('transaksi'), 'refresh');
	}
	
}