<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('ContactModel');
	}

	/**
	 * Display list of contacts
	 */
	public function index() {
		$data['contacts'] = $this->ContactModel->get_all();
		$this->load->view('backend/contact/index', $data);
	}

	/**
	 * Display contact details
	 * @param int $id
	 */
	public function detail($id) {
		$data['contact'] = $this->ContactModel->get_by_id($id);
		if (!$data['contact']) {
			show_404();
		}
		$this->load->view('backend/contact/detail', $data);
	}

}
