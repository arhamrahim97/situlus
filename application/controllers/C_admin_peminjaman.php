<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_peminjaman extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_admin_peminjaman');
		$this->load->model('m_pengaturan');
		$this->load->helper(array('url', 'download'));
		setlocale(LC_ALL, 'id-ID', 'id_ID');
		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$pengguna = $this->db->where('role', 'pegawai')->group_by('nama')->order_by('nama', 'ASC')->get('pengguna')->result();
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Peminjaman',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'pegawai' => $pengguna
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_peminjaman', $data);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function dataPeminjaman()
	{
		$namaPeminjam = $this->input->post('namaPeminjam');
		$konfirmasiAdmin = $this->input->post('konfirmasiAdmin');
		$statusPeminjam = $this->input->post('statusPeminjam');
		$data = $this->m_admin_peminjaman->getData($namaPeminjam, $konfirmasiAdmin, $statusPeminjam);
		echo json_encode($data);
	}

	public function pemberitahuan()
	{
		$countConfirm = $this->m_admin_peminjaman->getCountConfirm(); // Jumlah yang berlum dikonfirmasi
		$getConfirm = $this->m_admin_peminjaman->getConfirm();
		if ($countConfirm !== 0) {
			$output = '';
			foreach ($getConfirm as $gc) {
				$output .= '
					<div class="alert alert-light shadow-sm px-3">
						<div class="alert-body">
							<div class="mr-auto" style="display: inline;">
							<p>' . $gc->nama . '</p>
							Rp. <p class="pinjaman-pegawai" style="display: inline">' . $gc->total_pinjaman . '</p>
							</div>
							<div class="ml-auto" style="float: right;">
								<button class="btn btn-sm btn-primary detail-pemberitahuan" id="' . $gc->id . '"><i class="fas fa-info-circle"></i></button>
							</div>
						</div>
					</div>				
				';
			}
			echo $output;
		} else {
			echo '<h6 class="text-center"> Belum ada pengajuan pinjaman</h6>';
		}
	}



	public function pemberitahuanCount()
	{
		$countConfirm = $this->m_admin_peminjaman->getCountConfirm(); // Jumlah yang berlum dikonfirmasi
		$output = '';
		$output .= '
			<span class="badge badge-danger shadow-sm">' . $countConfirm . '</span>
		';
		echo $output;
	}

	public function pemberitahuanDetail()
	{
		$id = $this->input->post('id');

		$detail = $this->m_admin_peminjaman->getPemberitahuanDetail($id);
		$output = '';
		foreach ($detail as $d) {
			$output .= '
				<ul class="list-group list-group-flush">
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">ID Pinjaman :</p>
						<strong style="float: right;">' . $d->id . '</strong>
					</li>					
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Nama Pengaju :</p>
						<strong style="float: right;">' . $d->nama . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Pengajuan :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($d->tgl_pengusulan)) . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Total Pengajuan Pinjaman :</p>
						<strong style="float: right;">Rp. <p id="det-total-pinjaman" style="display: inline;">' . $d->total_pinjaman . '</p></strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tenor Pinjaman :</p>
						<strong style="float: right;">' . $d->tenor_pinjaman . ' Bulan</strong>
					</li>					
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Pembayaran Perbulan :</p>
						<strong style="float: right;">Rp. <p id="det-pembayaran-perbulan" style="display: inline;">' . $d->pembayaran_perbulan . '</p></strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Surat Pernyataan :</p>
						<a style="float: right" class="btn btn-sm btn-primary btn-download-sp" id="' . $d->id . '" href="' . (base_url("/uploads/pdf_word/$d->surat_pernyataan")) . '"><i class="fas fa-download"></i> Download</a>
					</li>
					<li class="list-group-item px-1 py-1">
						<button style="float: right" class="btn btn-sm btn-primary mt-3 btn-konfirmasi-pinjaman" id="' . $d->id . '" ><i class="fas fa-question-circle"></i> Konfirmasi</button>
					</li>
				</ul>
				';
		}
		echo $output;
	}

	public function spPeminjaman()
	{
// 		$this->load->helper('download');
// 		$file =  $this->uri->segment(2);
// 		$data = file_get_contents(base_url('/uploads/pdf_word/' . $file));
// 		force_download($filename, $data);

// $this->load->helper('download');
		$file =  $this->uri->segment(2);		
		echo 'test';
// 		$data = file_get_contents(base_url('/uploads/pdf_word/' . $file));		
// 		force_download(NULL, $data);
	}



	public function setujuPeminjaman()
	{
		$id = $this->input->post('id');

		if ($this->m_admin_peminjaman->setujuPeminjaman($id)) {
			$this->m_admin_peminjaman->tenorPeminjaman($id);
			$data = array('res' => 'success', 'message' => 'Pengajuan Pinjaman Terkirim');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function tolakPeminjaman()
	{
		$id = $this->input->post('id');
		$catatan = $this->input->post('catatan');

		if ($this->m_admin_peminjaman->tolakPeminjaman($id, $catatan)) {
			$data = array('res' => 'success', 'message' => 'Pengajuan Pinjaman Ditolak');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function detail()
	{
		$id = $this->input->post('id');
		$detail = $this->m_admin_peminjaman->getDetail($id);
		$pembayaran = $this->m_admin_peminjaman->getTenor($id);
		$output = '';
		// foreach ($detail as $d) {
		$output .= '
			<ul class="list-group list-group-flush">
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">ID Pinjaman :</p>
					<strong style="float: right;">' . $detail->id . '</strong>
				</li>
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Tgl Pengajuan :</p>
					<strong style="float: right;">' . date("d-m-Y", strtotime($detail->tgl_pengusulan)) . '</strong>
				</li>
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Total Pinjaman :</p>
					<strong style="float: right;">Rp. <p id="det-total-pinjaman" style="display: inline;">' . $detail->total_pinjaman . '</p></strong>
				</li>
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Tenor Pinjaman :</p>
					<strong style="float: right;">' . $detail->tenor_pinjaman . ' Bulan</strong>
				</li>
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Pembayaran Perbulan :</p>
					<strong style="float: right;">Rp. <p id="det-pembayaran-perbulan" style="display: inline;">' . $detail->pembayaran_perbulan . '</p></strong>
				</li>
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Tgl dikonfirmasi :</p>
					<strong style="float: right;">' . date("d-m-Y", strtotime($detail->tgl_konfirmasi_admin)) . ' (' . $detail->nama . ')</strong>
				</li>
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Surat Pernyataan :</p>
					<a style="float: right" target="_blank" class="btn btn-sm btn-primary btn-download-sp" id="' . $detail->id . '" href="' . base_url("/uploads/pdf_word/$detail->surat_pernyataan") . '"><i class="fas fa-download"></i> Download</a>					
				</li>
				<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Status Pinjaman :</p>
					<strong style="float: right;">';
		if ($detail->konfirmasi_admin == 2) {
			$output .= '
									<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Pengajuan Pinjaman Ditolak">Pengajuan Pinjaman Ditolak</div>';
		} else if ($detail->status_pinjaman == 0) {
			$output .= '
						<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum Lunas">Belum Lunas</div>';
		} else if ($detail->status_pinjaman == 1) {
			$output .= '
						<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah Lunas">Sudah Lunas</div>';
		} else if ($detail->status_pinjaman == 2) {
			$output .= '
						<div class="badge badge-warning" data-toggle="tooltip" data-placement="left" title="Sudah Lunas">Pengajuan Pinjaman Ditolak</div>';
		}
		$output .= '</strong>
				</li>';
		if ($detail->status_pinjaman == 1) {
			$output .= '
							<li class="list-group-item px-1 py-1">
								<p style="display: inline;">Tgl Lunas :</p>
								<strong style="float: right;">' . date("d-m-Y", strtotime($detail->updated_at)) . '</strong>
							</li>
							';
		}
		$output .= '<hr class="my-3">
				<h6>Riwayat Pembayaran</h6>
			<div class="table-reponsive">
				<table class="table table-sm table-light" id="table2">
					<thead>
						<tr>
						    <th class="text-center">
								No
							</th>
							<th class="text-center">
								Tagihan
							</th>							
							<th class="text-center">
								Status
							</th>
							<th class="text-center">
								Konfirmasi
							</th>
							<th class="text-center">
								Dibayar Kepada
							</th>
						</tr>
					</thead>
					<tbody>';
		foreach ($pembayaran as $p) {
			$output .= '
						<tr>
						    <td class="text-center">
								' . $p->id . '
							</td>
							<td class="text-center">
								' . strftime("%B %Y", strtotime($p->periode_pembayaran)) . '
							</td>							
							<td class="text-center">';
			if ($p->konfirmasi_admin == 1) {
				$output .= '
								<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah Dibayar">Sudah Dibayar</div>
								';
			} else if ($p->konfirmasi_admin == 0) {
				$output .= '
								<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum Dibayar">Belum Dibayar</div>
								';
			}
			$output .= '
							</td>
							<td class="text-center">';
			if ($p->konfirmasi_admin == 1) {
				$output .= date("d-m-Y", strtotime($p->tgl_konfirmasi_admin));
			} else if ($p->konfirmasi_admin == 0) {
				$output .= '
									<button class="btn btn-sm btn-primary btn-tenor-pinjaman" id="' . $p->id . '"><i class="fas fa-check"></i></button>
									';
			}
			$output .= '
							</td>
							<td class="text-center">';
			if ($p->konfirmasi_admin == 1) {
				$output .= $p->nama;
			} else if ($p->konfirmasi_admin == 0) {
				$output .= '-';
			}
			$output .= '
							</td>	
						</tr>	
						';
		}
		$output .= '
				</tbody>
			</table>	
			<div>		
		</ul>
		';

		echo $output;
	}

	public function pembayaranTenor()
	{
		$id = $this->input->post('id');
		if ($this->m_admin_peminjaman->pembayaranTenor($id)) {
			$getIdPinjaman = $this->m_admin_peminjaman->getIdPinjaman($id);
			$this->m_admin_peminjaman->statusPeminjaman($getIdPinjaman->id_pinjaman);
			$data = array('res' => 'success', 'message' => 'Status menjadi "Sudah Dibayar"', 'id_pinjaman' => $getIdPinjaman->id_pinjaman);
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}



	public function testing($id = 73)
	{
		$this->db->where('id_pinjaman', $id);
		$jumlahTenor = $this->db->get('tenor_pinjaman')->num_rows();

		$this->db->where('id_pinjaman', $id);
		$this->db->where('konfirmasi_admin', 1);
		$jumlahDibayar = $this->db->get('tenor_pinjaman')->num_rows();

		if ($jumlahTenor == $jumlahDibayar) {
			$this->db->set('status_pinjaman', 1);
			$this->db->set('updated_at', date("Y-m-d H:i:s"));

			$this->db->where('id', $id);
			$this->db->update('peminjaman');
		}
	}
}
