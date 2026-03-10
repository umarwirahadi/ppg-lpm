<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(['template', 'auth', 'session']);
		$this->load->model(['StrukturModel', 'DokumenModel','KegiatanModel']);
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

		$data['active_menu'] = 'about';

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

	public function kegiatan()
	{
		$this->template->set_title('Kegiatan - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Program dan kegiatan Lembaga Penjaminan Mutu Politeknik Piksi Ganesha dalam rangka peningkatan mutu pendidikan tinggi.')
			->set_meta_keywords('kegiatan LPM, audit mutu internal, workshop SPMI, evaluasi diri, monitoring mutu, Politeknik Piksi Ganesha');

		$data = ['active_menu' => 'kegiatan',
		'kegiatan_list' => $this->KegiatanModel->get_all_published_kegiatan()
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
		$kegiatan_data = $this->KegiatanModel->get_kegiatan_by_id($id);

		if (!$kegiatan_data) {
			show_404();
			return;
		}

		$this->template->set_title($kegiatan_data['title'] . ' - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Detail kegiatan ' . $kegiatan_data['title'] . ' yang diselenggarakan oleh Lembaga Penjaminan Mutu Politeknik Piksi Ganesha')
			->set_meta_keywords('kegiatan LPM, ' . strtolower($kegiatan_data['title']) . ', Politeknik Piksi Ganesha');

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


	public function dokumen() {
		$this->load->library('pagination');
		$q = trim((string) $this->input->get('q', true));
		$perPage = 10;
		$page = (int) $this->input->get('page');
		if ($page < 1) {
			$page = 1;
		}
		$offset = ($page - 1) * $perPage;

		$config = [];
		$config['base_url'] = site_url('dokumen-spmi');
		$config['total_rows'] = $this->DokumenModel->count_all_dokumen(true, $q);
		$config['per_page'] = $perPage;
		$config['page_query_string'] = true;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers'] = true;
		$config['reuse_query_string'] = true;

		// Bootstrap 5 pagination markup
		$config['full_tag_open'] = '<nav aria-label="Dokumen pagination"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = '&laquo;';
		$config['last_link'] = '&raquo;';
		$config['prev_link'] = '&lsaquo;';
		$config['next_link'] = '&rsaquo;';

		$this->pagination->initialize($config);

		$this->template->set_title('Dokumen SPMI - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Akses dan unduh dokumen-dokumen penting terkait Sistem Penjaminan Mutu Internal (SPMI) di Politeknik Piksi Ganesha.')
			->set_meta_keywords('dokumen SPMI, unduh dokumen, penjaminan mutu, Politeknik Piksi Ganesha');

		$data = [
			'active_menu' => 'dokumen',
			'dokumen_list' => $this->DokumenModel->get_all_dokumen(true, $perPage, $offset, $q),
			'q' => $q,
			'pagination' => $this->pagination->create_links()
		];

		$this->template->render('frontend/dokumen', $data);
	}

	public function detail_dokumen($id = null) {
		if (!$id) {
			redirect('dokumen-spmi');
			return;
		}

		$doc = $this->DokumenModel->get_dokumen_by_id($id, true);
		if (!$doc) {
			show_404();
			return;
		}

		$docTitle = isset($doc['title']) ? $doc['title'] : (isset($doc['judul']) ? $doc['judul'] : 'Dokumen');
		$this->template->set_title($docTitle . ' - Dokumen SPMI LPM Politeknik Piksi Ganesha')
			->set_meta_description('Detail dokumen ' . $docTitle . ' terkait Sistem Penjaminan Mutu Internal di Politeknik Piksi Ganesha')
			->set_meta_keywords('dokumen SPMI, ' . strtolower($docTitle) . ', Politeknik Piksi Ganesha');

		$data = [
			'active_menu' => 'dokumen',
			'dokumen' => $doc
		];

		$this->template->render('frontend/detail-dokumen', $data);
	}

	public function dokumen_preview($id = null) {
		$this->auth->require_login('login');
		if (!$id) {
			show_404();
			return;
		}

		$doc = $this->DokumenModel->get_dokumen_by_id($id, true);
		if (!$doc || empty($doc['file_url'])) {
			show_404();
			return;
		}

		$this->_serve_dokumen_file($doc['file_url'], 'inline');
	}

	public function dokumen_download($id = null) {
		$this->auth->require_login('login');
		if (!$id) {
			show_404();
			return;
		}

		$doc = $this->DokumenModel->get_dokumen_by_id($id, true);
		if (!$doc || empty($doc['file_url'])) {
			show_404();
			return;
		}

		$this->_serve_dokumen_file($doc['file_url'], 'attachment');
	}

	private function _serve_dokumen_file($fileUrl, $disposition = 'inline') {
		$fileUrl = (string) $fileUrl;
		$relativePath = str_replace('\\', '/', ltrim($fileUrl, '/\\'));
		if ($relativePath === '' || strpos($relativePath, '..') !== false) {
			show_404();
			return;
		}
		if (strpos($relativePath, 'assets/documents/') !== 0) {
			show_404();
			return;
		}

		$base = realpath(FCPATH . 'assets/documents');
		$real = realpath(FCPATH . $relativePath);
		if ($real === false || $base === false || strpos($real, $base) !== 0 || !is_file($real)) {
			show_404();
			return;
		}

		$mime = @mime_content_type($real);
		if (!$mime) {
			$mime = 'application/octet-stream';
		}

		$filename = basename($real);
		$disposition = ($disposition === 'attachment') ? 'attachment' : 'inline';

		header('Content-Type: ' . $mime);
		header('Content-Disposition: ' . $disposition . '; filename="' . $filename . '"');
		header('Content-Length: ' . filesize($real));
		header('X-Content-Type-Options: nosniff');
		readfile($real);
		exit;
	}

	public function prodi(){
		$this->load->model('ProdiModel');
		$this->template->set_title('Program Studi - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Informasi lengkap tentang program studi yang dikelola oleh Lembaga Penjaminan Mutu Politeknik Piksi Ganesha.')
			->set_meta_keywords('program studi, prodi, LPM, Politeknik Piksi Ganesha, informasi prodi');

		$data = [
			'active_menu' => 'prodi'
		];
		$data['prodi_list'] = $this->ProdiModel->get_all_prodi(true);

		$this->template->render('frontend/prodi', $data);
	}

	public function detail_prodi($id = null) {
		$this->load->model('ProdiModel');
		if (!$id) {
			redirect('prodi');
			return;
		}

		$prodi = $this->ProdiModel->get_prodi_by_id($id, true);
		if (!$prodi) {
			show_404();
			return;
		}

		$this->template->set_title($prodi['nama_prodi'] . ' - Program Studi LPM Politeknik Piksi Ganesha')
			->set_meta_description('Detail program studi ' . $prodi['nama_prodi'] . ' yang dikelola oleh Lembaga Penjaminan Mutu Politeknik Piksi Ganesha')
			->set_meta_keywords('program studi, ' . strtolower($prodi['nama_prodi']) . ', LPM, Politeknik Piksi Ganesha');

		$data = [
			'active_menu' => 'prodi',
			'prodi' => $prodi
		];

		$this->template->render('frontend/detail-prodi', $data);
	}

	public function laporan() {
		$this->load->model('LaporanModel');
		$q = trim((string) $this->input->get('q', true));
		$this->template->set_title('Laporan - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Kumpulan laporan terkait penjaminan mutu pendidikan di Politeknik Piksi Ganesha yang disusun oleh Lembaga Penjaminan Mutu (LPM).')
			->set_meta_keywords('laporan mutu, laporan pendidikan, LPM, Politeknik Piksi Ganesha, penjaminan mutu');

		$laporanList = $this->LaporanModel->get_all_laporan();
		if ($q !== '') {
			$needle = mb_strtolower($q);
			$laporanList = array_values(array_filter($laporanList, function ($row) use ($needle) {
				$title = isset($row->title) ? mb_strtolower((string) $row->title) : '';
				$desc = isset($row->description) ? mb_strtolower((string) $row->description) : '';
				return (strpos($title, $needle) !== false) || (strpos($desc, $needle) !== false);
			}));
		}

		$data = [
			'active_menu' => 'laporan',
			'laporan_list' => $laporanList,
			'q' => $q,
		];

		$this->template->render('frontend/laporan', $data);
	}

	public function detail_laporan($id = null) {
		$this->load->model('LaporanModel');
		if (!$id) {
			redirect('data-laporan');
			return;
		}

		$laporan = $this->LaporanModel->get_laporan_by_id($id);
		if (!$laporan) {
			show_404();
			return;
		}

		$this->template->set_title($laporan->title . ' - Laporan LPM Politeknik Piksi Ganesha')
			->set_meta_description('Detail laporan ' . $laporan->title . ' terkait penjaminan mutu di Politeknik Piksi Ganesha')
			->set_meta_keywords('laporan mutu, ' . strtolower($laporan->title) . ', LPM, Politeknik Piksi Ganesha');

		$data = [
			'active_menu' => 'laporan',
			'laporan' => $laporan
		];

		$this->template->render('frontend/detail-laporan', $data);
	}

	public function laporan_preview($id = null) {
		$this->auth->require_login('login');
		$this->load->model('LaporanModel');
		if (!$id) {
			show_404();
			return;
		}

		$laporan = $this->LaporanModel->get_laporan_by_id($id);
		if (!$laporan || empty($laporan->file_path)) {
			show_404();
			return;
		}

		$this->_serve_dokumen_file($laporan->file_path, 'inline');
	}

	public function laporan_download($id = null) {
		$this->auth->require_login('login');
		$this->load->model('LaporanModel');
		if (!$id) {
			show_404();
			return;
		}

		$laporan = $this->LaporanModel->get_laporan_by_id($id);
		if (!$laporan || empty($laporan->file_path)) {
			show_404();
			return;
		}

		$this->_serve_dokumen_file($laporan->file_path, 'attachment');
	}

	public function settings() {
		$this->template->set_title('Settings - LPM Web Solutions')
			->set_meta_description('Manage your account settings and preferences at LPM Web Solutions.');

		$data = [
			'active_menu' => 'settings'
		];

		$this->template->render('frontend/settings', $data);
	}
}
