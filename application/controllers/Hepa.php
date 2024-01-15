<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hepa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hepa_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index()
    {
        $data['title'] = 'Admin HEPA';
        $data['pageName'] = 'Senarai Program';

        $data['program'] = $this->hepa_model->getData('tbl_program')->result();

        $this->load->view('templates_hepa/header', $data);
        $this->load->view('templates_hepa/sidebar', $data);
        $this->load->view('hepa', $data);
        $this->load->view('templates_hepa/footer');
    }

    // Approve program to the database
    public function approveProgram($program_id)
    {
        $data['title'] = 'Approve Program';
        $where = array('program_id' => $program_id);

        // Fetch the program details
        $data['program'] = $this->hepa_model->getProgramById($where, 'tbl_program')->result();

        $this->load->view('templates_hepa/header', $data);
        $this->load->view('templates_hepa/sidebar', $data);
        $this->load->view('approve_program', $data);
        $this->load->view('templates_hepa/footer');
    }
}
