<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mpp_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index()
    {
        $data['title'] = 'MPP';
        $data['pageName'] = 'Senarai Program';

        $data['program'] = $this->mpp_model->getData('tbl_program')->result();

        $this->load->view('templates_mpp/header', $data);
        $this->load->view('templates_mpp/sidebar', $data);
        $this->load->view('mpp', $data);
        $this->load->view('templates_mpp/footer');
    }

    // Approve program to the database
    public function approveProgram($program_id)
    {
        $data['title'] = 'Approve Program';
        $where = array('program_id' => $program_id);

        // Fetch the program details
        $data['program'] = $this->mpp_model->getProgramById($where, 'tbl_program')->result();

        $this->load->view('templates_mpp/header', $data);
        $this->load->view('templates_mpp/sidebar', $data);
        $this->load->view('approve_program', $data);
        $this->load->view('templates_mpp/footer');
    }
}
