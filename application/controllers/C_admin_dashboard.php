 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class C_admin_dashboard extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('m_login');
			$this->load->model('m_pengaturan');
			$this->load->model('m_admin_peminjaman');
			$this->load->model('m_admin_voucher');
			if ($this->session->userdata('role') == 'admin') {
			} else {
				redirect('login');
			}
		}

		public function index()
		{
			$voucherBelumDibayar = $this->db->where('konfirmasi_pembayaran', 0)->from('voucher_belanja')->count_all_results();
			$peminjamanBelumLunas = $this->db->where('konfirmasi_admin', 1)->where('status_pinjaman', 0)->from('peminjaman')->count_all_results();
			$simpananWajibBulanan = $this->db->where('status', 0)->from('simpanan_wajib')->count_all_results();
			$simpananPokokBelumLunas = $this->db->where('status', 0)->from('simpanan_pokok')->count_all_results();
			$pengaturan = $this->m_pengaturan->getSettings()->row();
			$header = [
				'title_header' => $pengaturan->title_header,
				'title' => 'Dashboard',
				'nama' => $this->session->userdata('nama')
			];
			$data = [
				'voucherbelumbayar' => $voucherBelumDibayar,
				'peminjamanbelumlunas' => $peminjamanBelumLunas,
				'simpananwajibbelumbayar' => $simpananWajibBulanan,
				'simpananpokokbelumlunas' => $simpananPokokBelumLunas
			];
			$footer = [
				'title_footer' => $pengaturan->title_footer
			];

			$this->load->view('admin/templates/header', $header);
			$this->load->view('admin/pages/v_dashboard', $data);
			$this->load->view('admin/templates/footer', $footer);
		}

		// public function pemberitahuan()
		// {
		// 	$countConfirm = $this->m_admin_peminjaman->getCountConfirm(); // Jumlah yang berlum dikonfirmasi
		// 	$getConfirm = $this->m_admin_peminjaman->getConfirm();
		// 	if ($countConfirm !== 0) {
		// 		$output = '';
		// 		foreach ($getConfirm as $gc) {
		// 			$output .= '
		// 				<div class="alert alert-light shadow-sm px-3">
		// 					<div class="alert-body">
		// 						<div class="mr-auto" style="display: inline;">
		// 						<p>' . $gc->nama . '</p>
		// 						Rp. <p class="pinjaman-pegawai" style="display: inline">' . $gc->total_pinjaman . '</p>
		// 						</div>
		// 						<div class="ml-auto" style="float: right;">
		// 							<button class="btn btn-sm btn-primary detail-pemberitahuan" id="' . $gc->id . '"><i class="fas fa-info-circle"></i></button>
		// 						</div>
		// 					</div>
		// 				</div>				
		// 			';
		// 		}
		// 		echo $output;
		// 	} else {
		// 		echo '<h6 class="text-center"> Belum ada pengajuan pinjaman</h6>';
		// 	}
		// }
		function getCountConfirm()
		{
			$this->db->where('konfirmasi_admin', 0);
			return $this->db->get('voucher_belanja')->num_rows();
		}

		function getConfirm()
		{
			$this->db->select('voucher_belanja.id, pengguna.nama');
			$this->db->from('voucher_belanja');
			$this->db->join('pengguna', 'pengguna.id = voucher_belanja.id_pegawai');
			$this->db->where('konfirmasi_admin', 0);
			$this->db->order_by('voucher_belanja.created_at', 'DESC');
			return $this->db->get()->result();
		}

		public function pemberitahuan()
		{
			$countConfirm = $this->getCountConfirm(); // Jumlah yang berlum dikonfirmasi
			$getConfirm = $this->getConfirm();
			if ($countConfirm !== 0) {
				$output = '';
				foreach ($getConfirm as $gc) {
					$output .= '
					<div class="alert alert-light shadow-sm px-3">
					<div class="alert-body">
						<div class="mr-auto" style="display: inline;">
							<p>' . $gc->nama . '</p>
							<p style="display: inline">' . $gc->id . '</p>
						</div>
						<div class="ml-auto" style="float: right;">
							<button class="btn btn-sm btn-primary detail-pemberitahuan-voucher" id="' . $gc->id . '"><i class="fas fa-info-circle"></i></button>
						</div>
					</div>
				</div>
					';
				}
				echo $output;
			} else {
				echo '<h6 class="text-center"> Belum ada pengajuan voucher</h6>';
			}
		}



		public function pemberitahuanCount()
		{
			$countConfirm = $this->getCountConfirm(); // Jumlah yang berlum dikonfirmasi
			$output = '';
			$output .= '
				<span class="badge badge-danger shadow-sm">' . $countConfirm . '</span>
			';
			echo $output;
		}

		public function getDetailVoucher()
		{
			$id = $this->input->post('id');
			$voucher = $this->m_admin_voucher->getDetailVoucher($id);

			$namaAdmin = '';
			if ($voucher->konfirmasi_admin != 0) {
				$namaAdmin = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Konfirmasi Admin :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->tgl_konfirmasi_admin)) . ' (' . $this->m_admin_voucher->getNama($voucher->id_admin) . ')</strong>
					</li>';
			}

			$statusAdmin = '';
			$prosesAdmin = '';
			if ($voucher->konfirmasi_admin == 0) {
				$statusAdmin = "Menunggu Konfirmasi Admin";
				$prosesAdmin = '<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Proses Admin :</p>
						<strong style="float: right;"><button class="btn btn-sm btn-success detail-voucher mr-2" onclick="adminSetuju(' . "'" . $voucher->id . "'" . ')"><i class="fas fa-check"></i></button><button class="btn btn-sm btn-danger detail-voucher" onclick="adminTolak(' . "'" . $voucher->id . "'" . ')"><i class="fas fa-times"></i></button></strong>
					</li>';
			} else if ($voucher->konfirmasi_admin == 1) {
				$statusAdmin = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Disetujui Admin">Disetujui Admin</div>';
			} else {
				$statusAdmin = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak Admin">Ditolak Admin</div>';
			}

			$statusKasir = '';
			if ($voucher->konfirmasi_kasir == 0) {
				$statusKasir = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title="Menunggu Kasir">Menunggu Kasir</div>';
			} else if ($voucher->konfirmasi_kasir == 1) {
				$statusKasir = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Disetujui Kasir">Disetujui Kasir</div>';
			} else if ($voucher->konfirmasi_kasir == 2) {
				$statusKasir = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Ditolak Kasir">Ditolak Kasir</div>';
			}

			$statusBayar = '';
			if ($voucher->konfirmasi_pembayaran == 0) {
				$statusBayar = '<div class="badge badge-info" data-toggle="tooltip" data-placement="left" title=Menunggu Pembayaran">Menunggu Pembayaran</div>';
			} else if ($voucher->konfirmasi_kasir == 1) {
				$statusBayar = '<div class="badge badge-success" data-toggle="tooltip" data-placement="left" title="Pembayaran Disetujui">Pembayaran Disetujui</div>';
			} else if ($voucher->konfirmasi_kasir == 2) {
				$statusBayar = '<div class="badge badge-danger" data-toggle="tooltip" data-placement="left" title="Pembayaran Ditolak"Pembayaran Ditolak</div>';
			}

			$output = '';
			$output .= '
				<ul class="list-group list-group-flush">
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">ID Voucher :</p>
						<strong style="float: right;">' . $voucher->id . '</strong>
					</li>					
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Nama Pengaju :</p>
						<strong style="float: right;">' . $voucher->nama . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Grade :</p>
						<strong style="float: right;">' . $voucher->grade . " (Rp." . number_format($voucher->limit_voucher, 0, '', '.') . ")" . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Tgl Pengajuan :</p>
						<strong style="float: right;">' . date("d-m-Y", strtotime($voucher->created_at)) . '</strong>
					</li>
					<li class="list-group-item px-1 py-1">
						<p style="display: inline;">Status Admin :</p>
						<strong style="float: right;">' . $statusAdmin . '</strong>
					</li>
					' . $prosesAdmin . $namaAdmin;
			if ($voucher->konfirmasi_admin == 1) {
				$output .= '
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Status Kasir :</p>
							<strong style="float: right;">' . $statusKasir . '</strong>
						</li>					
						';
			}
			if ($voucher->konfirmasi_kasir == 1) {
				$output .= '						
						<li class="list-group-item px-1 py-1">
							<p style="display: inline;">Status Bayar :</p>
							<strong style="float: right;">' . $statusBayar . '</strong>
						</li>						
						';
			}
			$output .= '	
				</ul>
				';
			echo $output;
		}
	}
