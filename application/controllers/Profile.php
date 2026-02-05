<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->model('ProfileModel');
    }

    /**
     * Profile index - shows all profile information
     */
    public function index() {
        $this->template->set_title('Profile LPM - Politeknik Piksi Ganesha')
            ->set_meta_description('Profile Lembaga Penjaminan Mutu Politeknik Piksi Ganesha - Tentang LPM, Visi Misi, dan Tugas Tanggung Jawab.')
            ->set_meta_keywords('profile LPM, tentang LPM, visi misi LPM, tugas LPM, Politeknik Piksi Ganesha');

        $data = [
            'active_menu' => 'profile',
            'tentang' => $this->ProfileModel->get_tentang(),
            'visi' => $this->ProfileModel->get_visi(),
            'misi' => $this->ProfileModel->get_misi(),
            'tugas' => $this->ProfileModel->get_tugas()
        ];

        $this->template->render('frontend/profile', $data);
    }

    /**
     * Tentang LPM page
     */
    public function tentang() {
        $this->template->set_title('Tentang LPM - Politeknik Piksi Ganesha')
            ->set_meta_description('Informasi tentang Lembaga Penjaminan Mutu Politeknik Piksi Ganesha.')
            ->set_meta_keywords('tentang LPM, about LPM, Politeknik Piksi Ganesha');

        $data = [
            'active_menu' => 'profile',
            'active_submenu' => 'tentang',
            'profile_data' => $this->ProfileModel->get_tentang()
        ];

        $this->template->render('frontend/profile-tentang', $data);
    }

    /**
     * Visi Misi page
     */
    public function visi_misi() {
        $this->template->set_title('Visi & Misi LPM - Politeknik Piksi Ganesha')
            ->set_meta_description('Visi dan Misi Lembaga Penjaminan Mutu Politeknik Piksi Ganesha dalam mewujudkan budaya mutu berkelanjutan.')
            ->set_meta_keywords('visi misi LPM, visi LPM, misi LPM, Politeknik Piksi Ganesha');

        $data = [
            'active_menu' => 'profile',
            'active_submenu' => 'visi-misi',
            'visi' => $this->ProfileModel->get_visi(),
            'misi' => $this->ProfileModel->get_misi()
        ];

        $this->template->render('frontend/profile-visi-misi', $data);
    }

    /**
     * Tugas dan Tanggung Jawab page
     */
    public function tugas() {
        $this->template->set_title('Tugas dan Tanggung Jawab LPM - Politeknik Piksi Ganesha')
            ->set_meta_description('Tugas dan tanggung jawab Lembaga Penjaminan Mutu Politeknik Piksi Ganesha.')
            ->set_meta_keywords('tugas LPM, tanggung jawab LPM, Politeknik Piksi Ganesha');

        $data = [
            'active_menu' => 'profile',
            'active_submenu' => 'tugas',
            'tugas' => $this->ProfileModel->get_tugas()
        ];

        $this->template->render('frontend/profile-tugas', $data);
    }

    /**
     * API endpoint to get profile data as JSON
     */
    public function api_get($key = null) {
        $this->output->set_content_type('application/json');
        
        if ($key) {
            if ($key === 'tugas') {
                $data = $this->ProfileModel->get_tugas();
            } else {
                $data = $this->ProfileModel->get_by_key($key);
            }
        } else {
            $data = $this->ProfileModel->get_all_keyed();
            // Parse tugas items
            if (isset($data['tugas'])) {
                $data['tugas']['items'] = json_decode($data['tugas']['content'], true);
            }
        }

        if ($data) {
            $this->output->set_output(json_encode([
                'status' => 'success',
                'data' => $data
            ]));
        } else {
            $this->output->set_output(json_encode([
                'status' => 'error',
                'message' => 'Data not found'
            ]));
        }
    }
}
