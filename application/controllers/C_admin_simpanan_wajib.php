<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_simpanan_wajib extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_simpanan');
		setlocale(LC_ALL, 'id-ID', 'id_ID');

		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengguna = $this->db->where('role', 'pegawai')->group_by('nama')->order_by('nama', 'ASC')->get('pengguna')->result();
		$simpananWajib = $this->db->query('SELECT * FROM `simpanan_wajib` GROUP BY DATE_FORMAT(created_at, "%Y%m") ORDER BY created_at DESC')->result();
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Simpanan Wajib',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'pegawai' => $pengguna,
			'simpananWajib' => $simpananWajib
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_simpanan_wajib', $data);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function getSimpananWajib()
	{
		$tagihan = $this->input->post('tagihan');
		$namaPegawai = $this->input->post('namaPegawai');
		$statusBayar = $this->input->post('statusBayar');
		$simpananWajib = $this->m_admin_simpanan->getSimpananWajib($tagihan, $namaPegawai, $statusBayar);
		echo json_encode($simpananWajib);
	}

	public function getSimpananWajibTotal()
	{
		$simpananWajibTotal = $this->m_admin_simpanan->getSimpananWajibTotal();
		echo json_encode($simpananWajibTotal);
	}

	public function getDetailSimpananWajib()
	{
		$id = $this->input->post('id');
		$simpananWajib = $this->m_admin_simpanan->getDetailSimpananWajib($id);

		$status_bayar = '';
		$tgl_konfirmasi = '';
		$btn_konfirmasi = '';
		if ($simpananWajib->status == 0) {
			$status_bayar = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak">Belum Bayar</div>';
			$btn_konfirmasi = '<li class="list-group-item px-1 py-1">
						<button style="float: right" class="btn btn-sm btn-primary mt-3" id="btn-bayar" onclick="bayar(' . $simpananWajib->id . ')"><i class="fas fa-question-circle"></i> Konfirmasi Pembayaran</button>
					</li>';
		} else {
			$admin = $this->m_admin_simpanan->getAdmin($simpananWajib->id_admin);
			$status_bayar = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Ditolak">Sudah Bayar</div>';
			$tgl_konfirmasi = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tanggal Konfirmasi :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($simpananWajib->tgl_konfirmasi_admin)) . " (" . $admin . ")" . '</strong>
					</li>';
		}
		$output = '<ul class="list-group list-group-flush">
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Nama Pegawai :</p>
						<strong style="float: right;">' . $simpananWajib->nama . '</strong>
					</li>		
                    <li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tagihan :</p>
						<strong style="float: right;">' . date("m-Y", strtotime($simpananWajib->created_at)) . '</strong>
					</li>				
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Total Simpanan :</p>
						<strong style="float: right;">' . number_format($simpananWajib->total_simpanan_wajib, 0, '', '.') . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Status Bayar :</p>
						<strong style="float: right;">' . $status_bayar . '</strong>
					</li>' . $tgl_konfirmasi .
			$btn_konfirmasi . '
				</ul>';

		echo $output;
	}

	public function getDetailSimpananWajibTotal()
	{
		$id = $this->input->post('id');
		$simpananWajibTotal = $this->m_admin_simpanan->getDetailSimpananWajibTotal($id);
		$tabelDetailSimpananWajib = $this->m_admin_simpanan->getDetailSimpananWajibTabel($simpananWajibTotal->id_pegawai);
		$output = '';
		$status_simpanan = '';
		$btn_konfirmasi = '';
		if ($simpananWajibTotal->total_simpanan != 0) {
			$btn_konfirmasi = '<div class="px-1 py-1">
				<button style="float: right" class="btn btn-sm btn-primary mt-3" id="btn-cairkan-dana" onclick="modalCairkanDana(' . $id . ')"><i class="fas fa-question-circle"></i> Cairkan Dana</button>
			</div>';
		} else {
			$status_simpanan = '<div class="badge badge-primary my-3" data-toggle="tooltip" data-placement="left" title="Ditolak">Semua dana sudah tercairkan</div>';
		}
		$output .= '<ul class="list-group list-group-flush">
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Nama Pegawai :</p>
						<strong style="float: right;">' . $simpananWajibTotal->nama . '</strong>
					</li>				
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Total Simpanan Saat Ini :</p>
						<strong style="float: right;">Rp. ' . number_format($simpananWajibTotal->total_simpanan, 0, '', '.') . '</strong>
					</li>' .
			$status_simpanan .
			$btn_konfirmasi . '
			<h6 class="mt-3">Riwayat Pencairan</h6>
			<div class="table-reponsive">
				<table class="table table-sm table-striped" id="table3">
					<thead>
						<tr class="text-center">
							<th>Tanggal Pencairan</th>
							<th>Nominal Pencairan</th>																			
						</tr>
					</thead>
					<tbody>';
		foreach ($tabelDetailSimpananWajib as $row) {
			// $a = $row->penambahan_pencairan + $row->total_simpanan;
			$output .= '
						<tr>
							<td class="text-center">
								' . date("d-m-Y", strtotime($row->tgl_konfirmasi)) . ' (' . $row->nama . ')
							</td>							
							<td class="text-center">
								Rp. ' . number_format($row->penambahan_pencairan, 0, '', '.') . '
							</td>		
																											
						</tr>';
		}

		$output .= '</tbody>
				</table>
			</div>

				';

		echo $output;
	}

	public function getDetailSimpananWajibTotalTabel()
	{
		$id = $this->input->post('id');
		$data = $this->m_admin_simpanan->getDetailSimpananWajibTabel($id);
		echo json_encode($data);
	}

	public function prosesSimpananWajib()
	{
		$id = $this->input->post('id');
		$data = array(
			'status' => 1,
			'id_admin' => $this->session->userdata('id'),
			'updated_at' =>  date("Y-m-d H:i:s"),
			'tgl_konfirmasi_admin' => date("Y-m-d")
		);
		if ($this->m_admin_simpanan->updateSimpananWajib($id, $data)) {
			$this->m_admin_simpanan->totalSimpananWajib($id);
			$response = array('res' => 'success', 'message' => 'Simpanan Wajib Berhasil Diproses');
		} else {
			$response = array('res' => 'error', 'message' => 'Simpanan Wajib Gagal Diproses');
		}
		echo json_encode($response);
	}

	public function prosesPencairan()
	{
		$id = $this->input->post('id');
		$nominal = $this->input->post('nominal');
		$simpananWajibTotal = $this->db->where('id', $id)->get('simpanan_wajib_total')->row();
		if ($this->m_admin_simpanan->cekPencairan($id, $nominal)) {
			// $response = array('res' => 'success', 'message' => 'Pencarian berhasil diproses');

			if ($this->m_admin_simpanan->prosesPencairan($id, $nominal)) {
				$response = array('res' => 'success', 'message' => 'Pencairan dana simpanan wajib berhasil diproses', 'pegawai' => '21');
			}
		} else {
			$response = array('res' => 'error', 'message' => 'Nominal Pencarian tidak boleh melebihi dari total simpanan saat ini.');
		}
		echo json_encode($response);
	}
}
