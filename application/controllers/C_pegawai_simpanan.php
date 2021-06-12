<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pegawai_simpanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_simpanan');
		if ($this->session->userdata('role') == 'pegawai') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$simpanan_pokok = $this->db->where('id_pegawai', $this->session->userdata('id'))->get('simpanan_pokok')->row();
		$id = $this->session->userdata('id');
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Simpanan Wajib & Simpanan Pokok',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'sp' => $this->m_admin_simpanan->getData(),
			'simpanan_pokok' => $simpanan_pokok,
			'count_simpanan_wajib' => $this->m_admin_simpanan->countSimpananWajibTotalPegawai($id),
			'simpanan_wajib' => $this->m_admin_simpanan->getDetailSimpananWajibTotalPegawai($id)
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('pegawai/templates/header', $header);
		$this->load->view('pegawai/pages/v_simpanan', $data);
		$this->load->view('pegawai/templates/footer', $footer);
	}

	public function getDetailSimpananPokok()
	{
		$id = $this->input->post('id');
		$simpananPokok = $this->m_admin_simpanan->getDetailSimpananPokok($id);

		$status_bayar = '';
		$tgl_konfirmasi = '';
		if ($simpananPokok->status == 0) {
			$status_bayar = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak">Belum Bayar</div>';
		} else {
			$admin = $this->m_admin_simpanan->getAdmin($simpananPokok->id_admin);
			$status_bayar = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Ditolak">Sudah Bayar</div>';
			$tgl_konfirmasi = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tanggal Konfirmasi :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($simpananPokok->tgl_konfirmasi_admin)) . " (" . $admin . ")" . '</strong>
					</li>';
		}


		$output = '<ul class="list-group list-group-flush">				
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Total Simpanan :</p>
						<strong style="float: right;">' . number_format($simpananPokok->total_simpanan_pokok, 0, '', '.') . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Status Bayar :</p>
						<strong style="float: right;">' . $status_bayar . '</strong>
					</li>' . $tgl_konfirmasi . '
				</ul>';

		echo $output;
	}

	public function getSimpananWajib()
	{
		$simpananWajib = $this->m_admin_simpanan->getPegawaiSimpananWajib();
		echo json_encode($simpananWajib);
	}

	public function getDetailSimpananWajib()
	{
		$id_pegawai = $this->input->post('id');
		$tabelDetailSimpananWajib = $this->m_admin_simpanan->getDetailSimpananWajibTabel($id_pegawai);
		$output = '';
		$output .= '
		<div class="table-reponsive">
		<table class="table table-sm table-striped" id="table2">
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
}
