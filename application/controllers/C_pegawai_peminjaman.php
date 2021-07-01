<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pegawai_peminjaman extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pegawai_peminjaman');
		$this->load->model('m_pengaturan');
		$this->load->helper(array('url', 'download'));
		setlocale(LC_ALL, 'id-ID', 'id_ID');
		if ($this->session->userdata('role') == 'pegawai') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$s_k = $this->db->where('kategori', 'Peminjaman')->order_by('nomor', 'ASC')->get('syarat_dan_ketentuan')->result();
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Peminjaman',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'bunga' => $pengaturan->bunga_pinjaman,
			's_k' => $s_k
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];

		$this->load->view('pegawai/templates/header', $header);
		$this->load->view('pegawai/pages/v_peminjaman', $data);
		$this->load->view('pegawai/templates/footer', $footer);
	}

	public function dataPeminjaman()
	{
		$data = $this->m_pegawai_peminjaman->getData();
		echo json_encode($data);
	}

	public function detail()
	{
		$id = $this->input->post('id');
		$detail = $this->m_pegawai_peminjaman->getDetail($id);
		$pembayaran = $this->m_pegawai_peminjaman->getTenor($id);
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
						<p style="display: inline;">Tgl disetujui :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($detail->tgl_konfirmasi_admin)) . ' (' . $detail->nama . ')</strong>
					</li>
					<li class="list-group-item px-1 py-1">
					<p style="display: inline;">Surat Pernyataan :</p>
					<a style="float: right" target="_blank" class="btn btn-sm btn-primary btn-download-sp" id="' . $detail->id . '" href="' . base_url("/uploads/pdf_word/$detail->surat_pernyataan")  . '"><i class="fas fa-download"></i> Download</a>					
				</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Status Pinjaman :</p>
						<strong style="float: right;">';
		if ($detail->status_pinjaman == 0) {
			$output .= '
										<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Belum Lunas">Belum Lunas</div>';
		} else if ($detail->status_pinjaman == 1) {
			$output .= '
										<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Sudah Lunas">Sudah Lunas</div>';
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
					<table class="table table-sm table-light">
						<thead>
							<tr>
							<th class="text-center">
								Tagihan
							</th>							
							<th class="text-center">
								Status
							</th>
							<th class="text-center">
								Tanggal Bayar
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
				$output .= '-';
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
					
				</ul>
				';
		// }
		echo $output;
	}

	public function konfirmasiAdmin()
	{
		$getPenjamanditolak = $this->m_pegawai_peminjaman->getPinjamanditolak();
		if ($getPenjamanditolak->num_rows() !== 0) {
			$output = '';
			foreach ($getPenjamanditolak->result() as $gp) {
				$output .= '
					<div class="alert alert-danger alert-dismissible show fade">
						<div class="alert-body">
							<button class="close hapus-pemberitahuan" id="' . $gp->id . '" data-dismiss="alert">
								<span>×</span>
							</button>
							Pengajuan pinjaman Rp <p class="nominal-pinjaman-ditolak" style="display:inline">' . $gp->total_pinjaman . '</p> anda ditolak.	
							<div>
							<p>Alasan : ' . $gp->catatan . '</p>
							</div>						
						</div>
					</div>
				';
			}
			echo $output;
		}

		$menugguKonfirmasi = $this->m_pegawai_peminjaman->menugguKonfirmasi();
		if ($menugguKonfirmasi) {
			$output = '';
			$output .= '
					<div class="alert alert-warning alert-dismissible show fade">
						<div class="alert-body">
						<i class="fas fa-history"></i> Pengajuan pinjaman Rp <p class="nominal-pinjaman-ditolak" style="display:inline">' . $menugguKonfirmasi->total_pinjaman . '</p> anda sedang menunuggu konfirmasi dari Admin. 																					
						</div>
					</div>
				';
			echo $output;
		}
	}

	public function spPeminjaman($filename = NULL)
	{
		$this->load->helper('download');
		$file =  $this->uri->segment(2);
		$data = file_get_contents(base_url('/uploads/pdf_word/' . $file));
		force_download($filename, $data);
	}


	public function hapusPemberitahuan()
	{
		$id = $this->input->post('id');

		if ($this->m_pegawai_peminjaman->hapusPemberitahuan($id)) {
			$data = array('res' => 'success');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function cekPeminjaman()
	{
		if (!$this->m_pegawai_peminjaman->cekPeminjaman()) {
			$data = array('res' => 'success');
		} else {
			$data = $this->m_pegawai_peminjaman->cekPeminjaman();
			// $data = array('res' => 'error1');
		}
		echo json_encode($data);
	}

	public function insert()
	{
		if ($this->input->is_ajax_request()) {
			$config['upload_path'] = APPPATH . '../uploads/pdf_word/';
			$config['allowed_types'] = 'pdf|docx|doc';
			$config['max_size'] = '2048';
			$config['file_name'] = 'Peminjaman_' . date("d-m-Y H_i") . '_' . str_replace(".", " ", $this->session->userdata('nama'));
			$this->load->library('upload', $config);



			if (!$this->upload->do_upload('surat_pernyataan')) {
				$data = array('res' => 'error', 'message' => $this->upload->display_errors());
			} else {
				$ajax_data = $this->input->post(); //total_pinjaman, total_pinjaman_bunga, bunga_pinjaman, tenor_pinjaman, pembayaran_perbulan
				$query = $this->db->query('SELECT max(id) as maxKode FROM peminjaman')->row();
				$id = $query->maxKode;
				$urutan = (int) substr($id, 4, 5);
				$urutan++;
				$huruf = "PJM-";
				$kode = $huruf . sprintf("%05s", $urutan);

				$ajax_data['id'] = $kode;
				$ajax_data['id_pegawai'] = $this->session->userdata('id');
				$ajax_data['surat_pernyataan'] = $this->upload->data('file_name');
				$ajax_data['tgl_pengusulan'] = date("Y-m-d H:i:s");
				$ajax_data['created_at'] = date("Y-m-d H:i:s");
				if ($this->m_pegawai_peminjaman->insert($ajax_data)) {
					$data = array('res' => 'success', 'message' => 'Pengajuan Pinjaman Terkirim');
				} else {
					$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
				}
			}
			echo json_encode($data);
		}
	}

	public function testing()
	{
		$idPegawai = $this->session->userdata('id');
		$this->db->where('id_pegawai', $idPegawai);
		$data = $this->db->get('peminjaman')->result();

		foreach ($data as $d) {
			if ($d->status_pinjaman == 0) {
				// return TRUE;
				echo 'dapat';
			}
		}
	}
}
