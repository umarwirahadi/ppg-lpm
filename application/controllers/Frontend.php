<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->model('StrukturModel');
	}

	public function index() {
		// Set page meta information
		$this->template->set_title('LPM - Leading Web Solutions | Home')
			->set_meta_description('LPM is a leading web development company specializing in creating cutting-edge digital solutions for businesses of all sizes.')
			->set_meta_keywords('web development, digital solutions, responsive design, e-commerce, mobile apps, LPM');

		// Set additional data
		$data = [
			'active_menu' => 'home'
		];

		// Render the view
		$this->template->render('frontend/home', $data);
	}

	public function about() {
		$this->template->set_title('About Us - LPM Web Solutions')
			->set_meta_description('Learn more about LPM Web Solutions - our team, mission, and commitment to delivering exceptional web development services.');

		$data = [
			'active_menu' => 'about'
		];

		$this->template->render('frontend/about', $data);
	}

	public function services() {
		$this->template->set_title('Our Services - LPM Web Solutions')
			->set_meta_description('Explore our comprehensive web development services including custom applications, e-commerce, mobile solutions, and more.');

		$data = [
			'active_menu' => 'services'
		];

		$this->template->render('frontend/services', $data);
	}

	public function contact() {
		$this->template->set_title('Contact Us - LPM Web Solutions')
			->set_meta_description('Get in touch with LPM Web Solutions. Contact us for your next web development project or digital solution.');

		$data = [
			'active_menu' => 'contact'
		];

		$this->template->render('frontend/contact', $data);
	}

	public function struktur_organisasi() {
		$this->template->set_title('Struktur Organisasi - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Struktur organisasi dan profil tim Lembaga Penjaminan Mutu Politeknik Piksi Ganesha yang berkomitmen untuk peningkatan mutu pendidikan.')
			->set_meta_keywords('struktur organisasi LPM, tim LPM, profil staff, Politeknik Piksi Ganesha, penjaminan mutu');

		// Get struktur data from model
		$struktur_data = $this->StrukturModel->get_for_frontend();

		$data = [
			'active_menu' => 'struktur',
			'struktur_data' => $struktur_data
		];

		$this->template->render('frontend/struktur-organisasi', $data);
	}

	public function kegiatan($action = null, $id = null)
	{
		if ($action === 'detail' && $id) {
			return $this->detail_kegiatan($id);
		}

		$this->template->set_title('Kegiatan - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Program dan kegiatan Lembaga Penjaminan Mutu Politeknik Piksi Ganesha dalam rangka peningkatan mutu pendidikan tinggi.')
			->set_meta_keywords('kegiatan LPM, audit mutu internal, workshop SPMI, evaluasi diri, monitoring mutu, Politeknik Piksi Ganesha');

		$data = [
			'active_menu' => 'kegiatan'
		];

		$this->template->render('frontend/kegiatan', $data);
	}

	public function detail_kegiatan($id = null)
	{
		if (!$id) {
			redirect('kegiatan');
			return;
		}

		// Sample data - in real application, this would come from database
		$kegiatan_data = $this->get_kegiatan_by_id($id);

		if (!$kegiatan_data) {
			show_404();
			return;
		}

		$this->template->set_title($kegiatan_data['judul'] . ' - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Detail kegiatan ' . $kegiatan_data['judul'] . ' yang diselenggarakan oleh Lembaga Penjaminan Mutu Politeknik Piksi Ganesha')
			->set_meta_keywords('kegiatan LPM, ' . strtolower($kegiatan_data['judul']) . ', Politeknik Piksi Ganesha');

		$data = [
			'active_menu' => 'kegiatan',
			'kegiatan' => $kegiatan_data
		];

		$this->template->render('frontend/detail-kegiatan', $data);
	}

	private function get_kegiatan_by_id($id)
	{
		// Sample data - replace with actual database query
		$kegiatan_list = [
			'1' => [
				'id' => 1,
				'judul' => 'Audit Mutu Internal (AMI) Semester Genap 2025/2026',
				'kategori' => 'Audit & Evaluasi',
				'tanggal' => '15-20 Januari 2026',
				'waktu' => '08:00 - 16:00 WIB',
				'tempat' => 'Kampus Politeknik Piksi Ganesha',
				'peserta' => 'Semua Program Studi dan Unit Kerja',
				'status' => 'Berlangsung',
				'pic_nama' => 'Dr. Ahmad Sutanto, M.T.',
				'pic_jabatan' => 'Ketua LPM',
				'pic_phone' => '(022) 1234-5678',
				'pic_email' => 'lpm@piksi.ac.id',
				'deskripsi' => '<p>Audit Mutu Internal (AMI) merupakan kegiatan rutin yang dilaksanakan oleh Lembaga Penjaminan Mutu (LPM) Politeknik Piksi Ganesha untuk memastikan bahwa seluruh program studi dan unit kerja telah menjalankan sistem penjaminan mutu yang telah ditetapkan.</p>
				
				<h5>Tujuan Kegiatan:</h5>
				<ul>
					<li>Memastikan implementasi Sistem Penjaminan Mutu Internal (SPMI) di seluruh unit kerja</li>
					<li>Mengidentifikasi area-area yang perlu diperbaiki dalam proses pembelajaran dan pengelolaan</li>
					<li>Memberikan rekomendasi untuk peningkatan mutu berkelanjutan</li>
					<li>Mempersiapkan dokumentasi untuk akreditasi eksternal</li>
				</ul>

				<h5>Ruang Lingkup Audit:</h5>
				<ul>
					<li>Standar Pendidikan (Kompetensi Lulusan, Isi, Proses, Penilaian)</li>
					<li>Standar Penelitian</li>
					<li>Standar Pengabdian kepada Masyarakat</li>
					<li>Standar Pengelolaan dan Kemahasiswaan</li>
					<li>Standar Sarana dan Prasarana</li>
					<li>Standar Pembiayaan</li>
				</ul>',
				'timeline' => [
					[
						'waktu' => 'Hari 1',
						'judul' => 'Persiapan dan Briefing Tim Auditor',
						'deskripsi' => 'Koordinasi tim auditor internal dan persiapan dokumen audit'
					],
					[
						'waktu' => 'Hari 2-4',
						'judul' => 'Pelaksanaan Audit ke Program Studi',
						'deskripsi' => 'Audit dokumentasi, observasi, dan wawancara di seluruh program studi'
					],
					[
						'waktu' => 'Hari 2-4',
						'judul' => 'Audit Unit Penunjang',
						'deskripsi' => 'Audit pada unit-unit penunjang akademik'
					],
					[
						'waktu' => 'Hari 5',
						'judul' => 'Kompilasi Hasil dan Pelaporan',
						'deskripsi' => 'Penyusunan laporan hasil audit dan rekomendasi perbaikan'
					]
				]
			],
			'2' => [
				'id' => 2,
				'judul' => 'Workshop Sistem Penjaminan Mutu Internal (SPMI)',
				'kategori' => 'Pelatihan & Workshop',
				'tanggal' => '25 Januari 2026',
				'waktu' => '09:00 - 16:00 WIB',
				'tempat' => 'Auditorium Utama Politeknik Piksi Ganesha',
				'peserta' => 'Dosen dan Tenaga Kependidikan',
				'status' => 'Akan Datang',
				'pic_nama' => 'Dr. Siti Nurjanah, M.Pd.',
				'pic_jabatan' => 'Sekretaris LPM',
				'pic_phone' => '(022) 1234-5679',
				'pic_email' => 'spmi@piksi.ac.id',
				'deskripsi' => '<p>Workshop SPMI dirancang untuk meningkatkan pemahaman civitas akademika tentang implementasi Sistem Penjaminan Mutu Internal di lingkungan Politeknik Piksi Ganesha.</p>
				
				<h5>Materi Workshop:</h5>
				<ul>
					<li>Konsep dan filosofi SPMI dalam pendidikan tinggi</li>
					<li>Siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, Peningkatan)</li>
					<li>Penyusunan dokumen mutu (Manual, Standar, SOP, Formulir)</li>
					<li>Teknik monitoring dan evaluasi internal</li>
				</ul>',
			]
		];

		return isset($kegiatan_list[$id]) ? $kegiatan_list[$id] : null;
	}
}
