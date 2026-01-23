<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kegiatan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->model('KegiatanModel');
	}

	public function index() {
		$this->template->set_title('Kegiatan - LPM Web Solutions')
			->set_meta_description('Daftar kegiatan yang diselenggarakan oleh LPM Web Solutions.');

		$data = [
			'active_menu' => 'kegiatan',
			'kegiatan_list' => $this->KegiatanModel->get_all_kegiatan()
		];

		$this->template->backend('backend/kegiatan/index', $data);
	}

	public function create() {
		$this->template->set_title('Buat Kegiatan Baru - LPM Web Solutions')
			->set_meta_description('Form untuk membuat kegiatan baru di LPM Web Solutions.');

		$data = [
			'active_menu' => 'kegiatan'
		];

		$this->template->render('backend/kegiatan/create', $data);
	}

	public function store() {
		// Logic to store new kegiatan would go here
	}

	public function edit($id) {
		$kegiatan = $this->KegiatanModel->get_kegiatan_by_id($id);
		if (!$kegiatan) {
			show_404();
		}

		$this->template->set_title('Edit Kegiatan - LPM Web Solutions')
			->set_meta_description('Form untuk mengedit kegiatan di LPM Web Solutions.');

		$data = [
			'active_menu' => 'kegiatan',
			'kegiatan' => $kegiatan
		];

		$this->template->render('backend/kegiatan/edit', $data);
	}

	public function update($id) {
		// Logic to update existing kegiatan would go here
	}

	public function delete($id) {
		// Logic to delete kegiatan would go here
	}

	public function detail($id) {
		$kegiatan = $this->KegiatanModel->get_kegiatan_by_id($id);
		if (!$kegiatan) {
			show_404();
		}

		$this->template->set_title($kegiatan['title'] . ' - Kegiatan LPM Web Solutions')
			->set_meta_description(substr($kegiatan['description'], 0, 160));

		$data = [
			'active_menu' => 'kegiatan',
			'kegiatan' => $kegiatan
		];

		$this->template->render('backend/kegiatan/detail', $data);
	}
}
