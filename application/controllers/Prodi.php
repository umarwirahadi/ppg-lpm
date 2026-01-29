<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prodi extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->model('ProdiModel');
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('admin/login');
			return;
		}
	}

	
	public function index() {
		   $data['title'] = 'Daftar Program Studi';
		   $data['prodi_list'] = $this->ProdiModel->get_all_prodi();
		   $this->template->backend('backend/prodi/index', $data);
	}

	public function create() {
		$data['title'] = 'Tambah Program Studi';
		$this->template->backend('backend/prodi/create', $data);
	}

	public function store() {
		$kode = $this->input->post('kode');
		$nama_prodi = $this->input->post('nama_prodi');
		$fakultas = $this->input->post('fakultas');
		$ketua_prodi = $this->input->post('ketua_prodi');
		$sekretaris_prodi = $this->input->post('sekretaris_prodi');
		$akreditasi = $this->input->post('akreditasi');
		$tgl_berlaku_akreditasi = $this->input->post('tgl_berlaku_akreditasi');
		$tgl_berakhir_akreditasi = $this->input->post('tgl_berakhir_akreditasi');
		$no_sk = $this->input->post('no_sk');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'kode' => $kode,
			'nama_prodi' => $nama_prodi,
			'fakultas' => $fakultas,
			'ketua_prodi' => $ketua_prodi,
			'sekretaris_prodi' => $sekretaris_prodi,
			'akreditasi' => $akreditasi,
			'tgl_berlaku_akreditasi' => $tgl_berlaku_akreditasi,
			'tgl_berakhir_akreditasi' => $tgl_berakhir_akreditasi,
			'no_sk' => $no_sk,
			'keterangan' => $keterangan,
			'created_at' => date('Y-m-d H:i:s'),
		);

		$this->ProdiModel->insert_prodi($data);
		$this->session->set_flashdata('success', 'Program Studi berhasil ditambahkan.');
		redirect('admin/prodi');
	}

	public function edit($id) {
		$data['title'] = 'Edit Program Studi';
		$data['prodi'] = $this->ProdiModel->get_prodi_by_id($id);
		if (empty($data['prodi'])) {
			$this->session->set_flashdata('error', 'Program Studi tidak ditemukan.');
			redirect('admin/prodi');
			return;
		}
		$this->template->backend('backend/prodi/edit', $data);
	}

	public function update($id) {
		$prodi = $this->ProdiModel->get_prodi_by_id($id);
		if (empty($prodi)) {
			$this->session->set_flashdata('error', 'Program Studi tidak ditemukan.');
			redirect('admin/prodi');
			return;
		}

		$kode = $this->input->post('kode');
		$nama_prodi = $this->input->post('nama_prodi');
		$fakultas = $this->input->post('fakultas');
		$ketua_prodi = $this->input->post('ketua_prodi');
		$sekretaris_prodi = $this->input->post('sekretaris_prodi');
		$akreditasi = $this->input->post('akreditasi');
		$tgl_berlaku_akreditasi = $this->input->post('tgl_berlaku_akreditasi');
		$tgl_berakhir_akreditasi = $this->input->post('tgl_berakhir_akreditasi');
		$no_sk = $this->input->post('no_sk');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'kode' => $kode,
			'nama_prodi' => $nama_prodi,
			'fakultas' => $fakultas,
			'ketua_prodi' => $ketua_prodi,
			'sekretaris_prodi' => $sekretaris_prodi,
			'akreditasi' => $akreditasi,
			'tgl_berlaku_akreditasi' => $tgl_berlaku_akreditasi,
			'tgl_berakhir_akreditasi' => $tgl_berakhir_akreditasi,
			'no_sk' => $no_sk,
			'keterangan' => $keterangan,
		);

		$this->ProdiModel->update_prodi($id, $data);
		$this->session->set_flashdata('success', 'Program Studi berhasil diperbarui.');
		redirect('admin/prodi');
	}

	public function delete($id) {
		$prodi = $this->ProdiModel->get_prodi_by_id($id);
		if (empty($prodi)) {
			$this->session->set_flashdata('error', 'Program Studi tidak ditemukan.');
			redirect('admin/prodi');
			return;
		}

		$this->ProdiModel->delete_prodi($id);
		$this->session->set_flashdata('success', 'Program Studi berhasil dihapus.');
		redirect('admin/prodi');
	}
}
