<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(['auth', 'session']);
		$this->load->database();
	}

	/**
	 * Streams a file under assets/documents/* after requiring login.
	 *
	 * This is used by an .htaccess rewrite inside assets/documents to prevent
	 * direct public access to static files.
	 */
	public function documents($path = '') {
		$path = (string) $path;
		$path = str_replace('\\', '/', $path);
		$path = ltrim($path, '/');

		if ($path === '' || strpos($path, '..') !== false) {
			show_404();
			return;
		}

		// Only require login when the requested file is referenced by dokumen_spmi.
		// This keeps Dokumen SPMI protected while allowing other documents (e.g. laporan) to remain publicly downloadable.
		$fileUrl = 'assets/documents/' . $path;
		$this->db->select('id');
		$this->db->from('dokumen_spmi');
		$this->db->where_in('file_url', [$fileUrl, '/' . $fileUrl]);
		$this->db->limit(1);
		$row = $this->db->get()->row();
		if (!empty($row)) {
			$this->auth->require_login('login');
		}

		$base = realpath(FCPATH . 'assets/documents');
		$real = realpath(FCPATH . 'assets/documents/' . $path);
		if ($real === false || $base === false || strpos($real, $base) !== 0 || !is_file($real)) {
			show_404();
			return;
		}

		$mime = @mime_content_type($real);
		if (!$mime) {
			$mime = 'application/octet-stream';
		}

		$filename = basename($real);

		$download = (string) $this->input->get('download');
		$isDownload = ($download === '1' || strtolower($download) === 'true');
		$disposition = $isDownload ? 'attachment' : 'inline';
		$filename = str_replace('"', '', $filename);

		header('Content-Type: ' . $mime);
		header('Content-Disposition: ' . $disposition . '; filename="' . $filename . '"');
		header('Content-Length: ' . filesize($real));
		header('X-Content-Type-Options: nosniff');

		readfile($real);
		exit;
	}
}
