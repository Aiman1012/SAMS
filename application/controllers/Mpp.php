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

        $data['program'] = $this->mpp_model->getData('TBL_PROGRAM')->result();

        $this->load->view('templates_mpp/header', $data);
        $this->load->view('templates_mpp/sidebar', $data);
        $this->load->view('mpp', $data);
        $this->load->view('templates_mpp/footer');
        var_dump($this->session->userdata('role'));
    }

    // Approve program to the database
    public function approveProgram($PROGRAM_ID)
    {
        $data['title'] = 'Approve Program';
        $where = array('PROGRAM_ID' => $PROGRAM_ID);

        // Fetch the program details
        $data['program'] = $this->mpp_model->getProgramById($where, 'TBL_PROGRAM')->result();

        $this->load->view('templates_mpp/header', $data);
        $this->load->view('templates_mpp/sidebar', $data);
        $this->load->view('approve_program', $data);
        $this->load->view('templates_mpp/footer');
    }

    public function lulusProgram($PROGRAM_ID)
    {
        // Retrieve program details
        $programDetails = $this->mpp_model->getProgramById(['PROGRAM_ID' => $PROGRAM_ID], 'TBL_PROGRAM')->row();

        // Check if the program has already been approved
        if ($programDetails->APPROVAL_STATUS === 'Pending HEPA Approval') {
            // Set flashdata message indicating the program is already approved
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Program has already been approved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        } else {
            // Modify the approval status or other fields as needed
            $programDetails->APPROVAL_STATUS = 'Pending HEPA Approval';

            // Update the record in the database
            $this->mpp_model->updateProgram((array) $programDetails, 'TBL_PROGRAM');

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
        $this->form_validation->set_rules('PROGRAM_NOTES', 'Nota Program', 'required', array(
            'required' => "%s harus diisi"
        ));
    }


    public function rejectProgram($PROGRAM_ID)
    {
        // Your logic to update approval status to 'Rejected'
        $this->_rule();

        if (
            $this->form_validation->run()  == FALSE
        ) {
            $this->index();
        } else {
            $data = array(
                'PROGRAM_ID' => $PROGRAM_ID,
                'APPROVAL_STATUS' => 'Rejected by MPP',
                'PROGRAM_NOTES' => $this->input->post('PROGRAM_NOTES')
            );

            // Update the program status to 'Rejected'
            $this->mpp_model->updateProgram($data, 'TBL_PROGRAM');

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

    public function tambahNota($PROGRAM_ID)
    {
        $this->form_validation->set_rules('PROGRAM_NOTES', 'Nota Program', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Reload the page with validation errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('mpp/approveProgram/' . $PROGRAM_ID);
        } else {
            $data = array(
                'NOTA_MPP' => $this->input->post('PROGRAM_NOTES'),
                'PROGRAM_ID' => $PROGRAM_ID
            );

            $updateStatus = $this->mpp_model->updateProgram($data, 'TBL_PROGRAM');

            if ($updateStatus) {
                $this->session->set_flashdata('success', 'Nota program telah ditambah');
            } else {
                $this->session->set_flashdata('error', 'Failed to add nota program');
            }
            redirect('mpp/approveProgram/' . $PROGRAM_ID);
        }
    }

    public function editNota($PROGRAM_ID)
    {
        $this->form_validation->set_rules('PROGRAM_NOTES', 'Nota Program', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Reload the page with validation errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('mpp/programDetails/' . $PROGRAM_ID);
        } else {
            $data = array(
                'NOTA_MPP' => $this->input->post('PROGRAM_NOTES'),
                'PROGRAM_ID' => $PROGRAM_ID
            );

            $updateStatus = $this->mpp_model->updateProgram($data, 'TBL_PROGRAM');

            if ($updateStatus) {
                $this->session->set_flashdata('success', 'Nota program telah diubah');
            } else {
                $this->session->set_flashdata('error', 'Failed to update nota program');
            }
            redirect('mpp/approveProgram/' . $PROGRAM_ID);
        }
    }
}
