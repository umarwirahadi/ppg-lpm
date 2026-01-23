<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Template {

	protected $ci;
	protected $data = [];
	protected $title = 'LPM - Web Solutions';
	protected $meta_keywords = '';
	protected $meta_description = '';

	public function __construct() {
		$this->ci = &get_instance();
	}

	// Set page title
	public function set_title($title) {
		$this->title = $title;
		return $this;
	}

	// Set meta keywords
	public function set_meta_keywords($keywords) {
		$this->meta_keywords = $keywords;
		return $this;
	}

	// Set meta description
	public function set_meta_description($description) {
		$this->meta_description = $description;
		return $this;
	}

	// Add data to template
	public function set($key, $value = null) {
		if (is_array($key)) {
			$this->data = array_merge($this->data, $key);
		} else {
			$this->data[$key] = $value;
		}
		return $this;
	}

	// Render frontend template with header, content, footer structure
	public function render($view, $data = [], $layout = 'default') {
		// Merge data
		$template_data = array_merge($this->data, $data);
		
		// Add meta information
		$template_data['page_title'] = $this->title;
		$template_data['meta_keywords'] = $this->meta_keywords;
		$template_data['meta_description'] = $this->meta_description;
		
		// Load content
		$template_data['content'] = $this->ci->load->view($view, $template_data, TRUE);
		
		// Load header
		$template_data['header'] = $this->ci->load->view('frontend/layout/header', $template_data, TRUE);
		
		// Load footer
		$template_data['footer'] = $this->ci->load->view('frontend/layout/footer', $template_data, TRUE);
		
		// Load main layout
		$this->ci->load->view('frontend/layout/' . $layout, $template_data);
	}

	// Generate simple view without layout
	public function view($view, $data = []) {
		$template_data = array_merge($this->data, $data);
		$this->ci->load->view($view, $template_data);
	}

	// generate for backend
	public function backend($view, $data = [], $layout = 'default') {
		$template_data = array_merge($this->data, $data);
		$template_data['content'] = $this->ci->load->view($view, $template_data, TRUE);
		$this->ci->load->view('backend/layout/' . $layout, $template_data);
	}

	// Load partial view
	public function partial($view, $data = []) {
		$template_data = array_merge($this->data, $data);
		return $this->ci->load->view($view, $template_data, TRUE);
	}
}

