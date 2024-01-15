<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penasihat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('penasihat_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index()
    {
        $data['title'] = 'Penasihat Kelab';
        $data['pageName'] = 'Senarai Program';

        $data['program'] = $this->penasihat_model->getData('tbl_program')->result();

        $this->load->view('templates_penasihat/header', $data);
        $this->load->view('templates_penasihat/sidebar', $data);
        $this->load->view('penasihat', $data);
        $this->load->view('templates_penasihat/footer');
    }

    // Approve program to the database
    public function approveProgram($program_id)
    {
        $data['title'] = 'Approve Program';
        $where = array('program_id' => $program_id);

        // Fetch the program details
        $data['program'] = $this->penasihat_model->getProgramById($where, 'tbl_program')->result();

        $this->load->view('templates_penasihat/header', $data);
        $this->load->view('templates_penasihat/sidebar', $data);
        $this->load->view('approve_program', $data);
        $this->load->view('templates_penasihat/footer');
    }
}
