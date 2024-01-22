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

    public function _ruleReject()
    {
        $this->form_validation->set_rules('program_notes', 'Nota Program', 'required', array(
            'required' => "%s harus diisi"
        ));
    }


    public function rejectProgram($program_id)
    {
        // Your logic to update approval status to 'Rejected'
        $this->_ruleReject();

        if (
            $this->form_validation->run()  == FALSE
        ) {
            $this->index();
        } else {
            $data = array(
                'program_id' => $program_id,
                'approval_status' => 'Rejected by HEPA',
                'program_notes' => $this->input->post('program_notes')
            );

            // Update the program status to 'Rejected'
            $this->hepa_model->updateProgram($data, 'tbl_program');

            // Notify Club President (you need to implement the notification logic)

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Program has been rejected!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('hepa');
        }
    }

    public function _rulePengarah()
    {
        $this->form_validation->set_rules('pengarah_matric', 'No Matriks', 'required', array(
            'required' => "%s harus diisi"
        ));
    }

    public function assignPengarah($program_id)
    {
        $this->_rulePengarah();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
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

                // Assign the Pengarah
                $data = array(
                    'program_id' => $program_id,
                    'pengarah_matric' => $this->input->post('pengarah_matric')
                );

                $this->hepa_model->updateProgram($data, 'tbl_program');

                // Set flashdata message indicating the program has been approved and Pengarah assigned
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Program has been approved and Pengarah assigned!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            }

            redirect('hepa');
        }
    }
}
