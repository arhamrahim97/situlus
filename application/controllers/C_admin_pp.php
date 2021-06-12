<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_pp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_pengaturan');
		$this->load->model('m_admin_pp');
		$this->load->model('m_wilayah');
		$this->load->model('m_admin_grade');
		$this->load->helper(array('url', 'download'));

		if ($this->session->userdata('role') == 'admin') {
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		$provinsi = $this->m_wilayah->getProvinsi();
		$grade = $this->m_admin_grade->getGrade();
		$pengaturan = $this->m_pengaturan->getSettings()->row();
		$header = [
			'title_header' => $pengaturan->title_header,
			'title' => 'Pengguna (Pegawai)',
			'nama' => $this->session->userdata('nama')
		];
		$data = [
			'provinsi' => $provinsi,
			'grade' => $grade
		];
		$footer = [
			'title_footer' => $pengaturan->title_footer
		];
		$this->load->view('admin/templates/header', $header);
		$this->load->view('admin/pages/v_pp', $data);
		$this->load->view('admin/templates/footer', $footer);
	}

	public function dataPegawai()
	{
		$data = $this->m_admin_pp->getData();
		echo json_encode($data);
	}

	public function fotoKTP($nama)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '2048';
		$config['max_width']            = '5000';
		$config['max_height']           = '5000';
		$config['file_name'] 			= 'Foto KTP ' . str_replace(".", " ", $nama);
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_ktp')) {
			return array('res' => 'error', 'message' => 'Foto KTP :' . $this->upload->display_errors());
		} else {
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function fotoKK($nama)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '2048';
		$config['max_width']            = '5000';
		$config['max_height']           = '5000';
		$config['file_name'] 			= 'Foto KK ' . str_replace(".", " ", $nama);
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_kk')) {
			return array('res' => 'error', 'message' => 'Foto KK :' . $this->upload->display_errors());
		} else {
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function fotoSlip($nama)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '2048';
		$config['max_width']            = '5000';
		$config['max_height']           = '5000';
		$config['file_name'] 			= 'Foto Slip Gaji ' . str_replace(".", " ", $nama);
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_slip_gaji')) {
			return array('res' => 'error', 'message' => 'Foto Slip Gaji :' . $this->upload->display_errors());
		} else {
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function fotoProfil($nama)
	{
		$config['upload_path']          = APPPATH . '../uploads/img/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name'] 			= 'Foto Profil ' . str_replace(".", " ", $nama);
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto_profil')) {
			return array('res' => 'success', 'message' => 'default.png');
		} else {
			$this->upload->data();
			return array('res' => 'success', 'message' => $this->upload->data('file_name'));
		}
	}

	public function cekDataPegawai()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		if ($this->m_admin_pp->cekNama($nama)) {
			$data = array('res' => 'nama', 'message' => 'Nama sudah terdaftar');
		} else if ($this->m_admin_pp->cekUsername($username)) {
			$data = array('res' => 'username', 'message' => 'Username sudah digunakan');
		} else {
			$data = array('res' => 'success');
		}
		echo json_encode($data);
	}

	public function cekDataPegawaiDetail()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');

		if ($this->m_admin_pp->cekNamaDetail($id, $nama)) {
			$data = array('res' => 'nama', 'message' => 'Nama sudah ada');
		} else if ($this->m_admin_pp->cekUsernameDetail($id, $username)) {
			$data = array('res' => 'username', 'message' => 'Username sudah digunakan');
		} else {
			$data = array('res' => 'success');
		}
		echo json_encode($data);
	}

	public function tambahDataPegawai()
	{

		$nama = $this->input->post('nama');
		$fileKTP = null;
		$fileKK = null;
		$fileSlip = null;
		$fileProfil = null;
		$fileKTP = $this->fotoKTP($nama);
		$fileKK = $this->fotoKK($nama);
		$fileSlip = $this->fotoSlip($nama);
		$fileProfil = $this->fotoProfil($nama);
		if ($fileKTP['res'] == 'error') {
			echo json_encode($fileKTP);
		} else if ($fileKK['res'] == 'error') {
			echo json_encode($fileKK);
		} else if ($fileSlip['res'] == 'error') {
			echo json_encode($fileSlip);
		} else {
			$ajax_data = $this->input->post();
			$ajax_data['foto_ktp'] = $fileKTP['message'];
			$ajax_data['foto_kk'] = $fileKK['message'];
			$ajax_data['foto_slip_gaji'] = $fileSlip['message'];
			$ajax_data['foto_profil'] = $fileProfil['message'];
			$ajax_data['password'] = md5($this->input->post('password'));
			$ajax_data['password_show'] = $this->input->post('password');
			$ajax_data['role'] = 'pegawai';

			if ($this->m_admin_pp->insert($ajax_data)) {
				$this->m_admin_pp->insert_sp();
				$data = array('res' => 'success', 'message' => 'Data pegawai berhasil ditambah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
	}

	public function detailPegawai()
	{
		$id = $this->input->post('id');
		$detail = $this->m_admin_pp->getDetailPegawai($id);
		echo json_encode($detail);
	}

	public function detailPegawai2()
	{
		$id = $this->input->post('id');
		$detail = $this->m_admin_pp->getDetailPegawai($id);
		$output = '';
		$output .= '			
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12 ml-0">
								<label>Nama:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="text" class="form-control form-control-sm" id="namaPegawai" value="' . $detail->nama_pengguna . '"  disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>NIP:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="text" class="form-control form-control-sm" id="nipPegawai" value="' . $detail->nip . '" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Tempat Lahir:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="text" class="form-control form-control-sm" id="tempatPegawai" value="' . $detail->tempat_lahir . '" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Tanggal Lahir:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="date" class="form-control form-control-sm" id="tanggalPegawai" value="' . $detail->tgl_lahir . '" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Email:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="text" class="form-control form-control-sm" id="emailPegawai" value="' . $detail->email . '" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Telepon:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="text" class="form-control form-control-sm" id="teleponPegawai" value="' . $detail->telepon . '" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Provinsi:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<select class="form-control form-control-sm" tabindex="-1" aria-hidden="true" id="provinsiPegawai2" disabled>
									<option value="' . $detail->provinsi . '">' . $detail->provinsi_nama  . '</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Kabupaten:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<select class="form-control form-control-sm select2 kabupatenPegawai" tabindex="-1" aria-hidden="true" id="kabupatenPegawai2" disabled>
									<option value="' . $detail->kabupaten . '">' . $detail->kabupaten_nama  . '</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Kecamatan:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<select class="form-control form-control-sm select2" tabindex="-1" aria-hidden="true" id="kecamatanPegawai" disabled>
									<option value="' . $detail->kecamatan . '">' . $detail->kecamatan_nama  . '</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Kelurahan:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<select class="form-control form-control-sm select2" tabindex="-1" aria-hidden="true" id="kelurahanPegawai" disabled>
									<option value="' . $detail->kelurahan . '">' . $detail->kelurahan_nama  . '</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-lg-1 col-sm-12">
					<label>Alamat:</label>
				</div>
				<div class="col-lg-11 col-sm-12">
					<textarea class="form-control" style="width: 95%; float: right;" name="" cols="30" rows="10" id="alamatPegawai" disabled>' . $detail->alamat . '</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Username:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="text" class="form-control form-control-sm" id="usernamePegawai" value="' . $detail->username . '" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Password:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<input type="text" class="form-control form-control-sm" id="passwordPegawai" value="' . $detail->password_show . '" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-sm-12">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<div class="row">
									<div class="col-lg-3 col-sm-12">
										<label>Tgl & Waktu Pembuatan:</label>
									</div>
									<div class="col-lg-9 col-sm-12">
										<input type="text" class="form-control form-control-sm" value="' . $detail->created_at . '" disabled>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-lg-3 col-sm-12">
										<label>Status Akun:</label>
									</div>
									<div class="col-lg-9 col-sm-12">';
		if ($detail->status == 1) {
			$output .= '
											<div class="badge badge-success mr-3" data-toggle="tooltip" data-placement="left" title="Aktif">Aktif</div>
											<button type="button" id="' . $detail->id . '" class="btn btn-sm btn-danger btn-nonaktifkan" href="#" style="display: none">Non-aktifkan</button>';
		} else if ($detail->status == 2) {
			$output .= '
											<div class="badge badge-danger mr-3" data-toggle="tooltip" data-placement="left" title="Tidak Aktif">Tidak Aktif</div>
											<button type="button" id="' . $detail->id . '" class="btn btn-sm btn-success btn-aktifkan" href="#" style="display: none">Aktifkan</button>
											';
		}
		$output .= '
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-lg-6 col-sm-12">
					<div class="form-group">
						<div class="row">
							<div class="col-lg-3 col-sm-12">
								<label>Foto:</label>
							</div>
							<div class="col-lg-9 col-sm-12">
								<div id="foto-pegawai">
									<img src="uploads/img/' . $detail->foto_profil . '" alt="" style="width: 120px; height: 160px;">
									<button type="button" id="' . $detail->id . '" class="btn btn-sm btn-danger btn-ubahFoto ml-3" href="#" style="display: none">Ubah Foto</button>								
								</div>		
								<div id="form-foto" style="display:none">
									<div class="form-group mb-1">		
										<input type="file" id="input-foto" name="input-foto"  class="form-control" accept=".png, .jpg, .jpeg">
									</div>
									<div class="ml-1">
										<small>* Ukuran file maksimal 2MB.</small>
									</div>
								</div>						
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="float-right" id="btn-ubah-data-pegawai">
						<button name="" id="btn-ubah-data-pegawai" class="btn btn-sm btn-primary btn-ubah-data-pegawai" href="#" role="button"><i class="fas fa-edit"></i> Ubah Data</button>
					</div>
					<div class="float-right btn-perbarui-pegawai" id="' . $detail->id . '" style="display:none">
						<button class="btn btn-primary btn-sm btn-perbarui-pegawai2" id="1"><i class="fas fa-check-circle"></i> Perbarui</button>
					</div>
				</div>
			</div>

			';

		echo $output;
	}

	public function nonaktifkanPegawai()
	{
		$id = $this->input->post('id');

		if ($this->m_admin_pp->nonaktifkanPegawai($id)) {
			$data = array('res' => 'success', 'message' => 'Akun berhasil di nonaktifkan');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}


	public function aktifkanPegawai()
	{
		$id = $this->input->post('id');
		if ($this->m_admin_pp->aktifkanPegawai($id)) {
			$data = array('res' => 'success', 'message' => 'Akun berhasil di aktifkan');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function ubahDataPegawai()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$ajax_data['password'] = md5($this->input->post('password'));
		$ajax_data['password_show'] = $this->input->post('password');

		if ($this->m_admin_pp->update($id, $ajax_data)) {
			$data = array('res' => 'success', 'message' => 'Data pegawai berhasil diubah');
		} else {
			$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
		}
		echo json_encode($data);
	}

	public function ubahFotoKTP()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$fileKTP = null;
		$fileKTP = $this->fotoKTP($nama);
		if ($fileKTP['res'] == 'error') {
			echo json_encode($fileKTP);
		} else {
			$ajax_data['foto_ktp'] = $fileKTP['message'];
			if ($this->m_admin_pp->update($id, $ajax_data)) {
				$data = array('res' => 'success', 'message' => 'Foto KTP berhasil diubah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
	}

	public function ubahFotoKK()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$fileKK = null;
		$fileKK = $this->fotoKK($nama);
		if ($fileKK['res'] == 'error') {
			echo json_encode($fileKK);
		} else {
			$ajax_data['foto_kk'] = $fileKK['message'];
			if ($this->m_admin_pp->update($id, $ajax_data)) {
				$data = array('res' => 'success', 'message' => 'Foto KK berhasil diubah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
	}

	public function ubahFotoSlip()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$fileSlip = null;
		$fileSlip = $this->fotoSlip($nama);
		if ($fileSlip['res'] == 'error') {
			echo json_encode($fileSlip);
		} else {
			$ajax_data['foto_slip_gaji'] = $fileSlip['message'];
			if ($this->m_admin_pp->update($id, $ajax_data)) {
				$data = array('res' => 'success', 'message' => 'Foto Slip Gaji berhasil diubah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
	}

	public function ubahFotoProfil()
	{
		$ajax_data = $this->input->post();
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$fileProfil = null;
		$fileProfil = $this->fotoProfil($nama);
		if ($fileProfil['res'] == 'error') {
			echo json_encode($fileProfil);
		} else {
			$ajax_data['foto_profil'] = $fileProfil['message'];
			if ($this->m_admin_pp->update($id, $ajax_data)) {
				$data = array('res' => 'success', 'message' => 'Foto Profil berhasil diubah');
			} else {
				$data = array('res' => 'error', 'message' => 'Terjadi kesalahan');
			}
			echo json_encode($data);
		}
	}
}
