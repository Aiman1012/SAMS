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

        var_dump($this->session->userdata('role'));
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

        var_dump($this->session->userdata('role'));
    }

    public function lulusProgram($program_id)
    {
        // Retrieve program details
        $programDetails = $this->hepa_model->getProgramById(['program_id' => $program_id], 'tbl_program')->row();

        // Check if the program has already been approved
        if ($programDetails->approval_status === 'Approved') {
            // Set flashdata message indicating the program is already approved
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Program has already been approved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        } else {
            // Modify the approval status or other fields as needed
            $programDetails->approval_status = 'Approved';

            // Update the record in the database
            $this->hepa_model->updateProgram((array) $programDetails, 'tbl_program');

            // Set flashdata message indicating the program has been approved
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Program has been approved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        }

        redirect('hepa');
    }



    public function rejectProgram($program_id)
    {
        // Your logic to update approval status to 'Rejected'
        $data = array(
            'approval_status' => 'Rejected'
        );

        // Update the program status to 'Rejected'
        $this->hepa_model->updateProgram($data, 'tbl_program', $program_id);

        // Notify Club President (you need to implement the notification logic)

        $this->session->set_flashdata('message', 'Program rejected and notification sent to Club President.');
        redirect('hepa');
    }
}
