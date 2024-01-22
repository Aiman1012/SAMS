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
        var_dump($this->session->userdata('role'));
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

    public function lulusProgram($program_id)
    {
        // Retrieve program details
        $programDetails = $this->mpp_model->getProgramById(['program_id' => $program_id], 'tbl_program')->row();

        // Check if the program has already been approved
        if ($programDetails->approval_status === 'Pending HEPA Approval') {
            // Set flashdata message indicating the program is already approved
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Program has already been approved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        } else {
            // Modify the approval status or other fields as needed
            $programDetails->approval_status = 'Pending HEPA Approval';

            // Update the record in the database
            $this->mpp_model->updateProgram((array) $programDetails, 'tbl_program');

            // Set flashdata message indicating the program has been approved
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Program has been approved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        }

        redirect('mpp');
    }

    public function _rule()
    {
        $this->form_validation->set_rules('program_notes', 'Nota Program', 'required', array(
            'required' => "%s harus diisi"
        ));
    }


    public function rejectProgram($program_id)
    {
        // Your logic to update approval status to 'Rejected'
        $this->_rule();

        if (
            $this->form_validation->run()  == FALSE
        ) {
            $this->index();
        } else {
            $data = array(
                'program_id' => $program_id,
                'approval_status' => 'Rejected by MPP',
                'program_notes' => $this->input->post('program_notes')
            );

            // Update the program status to 'Rejected'
            $this->mpp_model->updateProgram($data, 'tbl_program');

            // Notify Club President (you need to implement the notification logic)

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Program has been rejected!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('mpp');
        }
    }
}
