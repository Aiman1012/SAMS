<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penasihat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('penasihat_model');
        $this->load->model('Program_model'); // Load the Program_model here
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Penasihat Kelab';
        $data['pageName'] = 'Senarai Program';

        $status_filter = $this->input->get('status_filter');

        // Fetch the programs based on the status filter
        if ($status_filter) {
            $data['program'] = $this->Program_model->getProgramsByStatus($status_filter);
        } else {
            $data['program'] = $this->Program_model->getAllPrograms();
        }

        $this->load->view('templates_penasihat/header', $data);
        $this->load->view('templates_penasihat/sidebar', $data);
        $this->load->view('penasihat', $data);
        $this->load->view('templates_penasihat/footer');
    }


    // Approve program to the database
    public function approveProgram($PROGRAM_ID)
    {
        $data['title'] = 'Approve Program';
        $where = array('PROGRAM_ID' => $PROGRAM_ID);

        // Fetch the program details
        $data['program'] = $this->penasihat_model->getProgramById($where, 'TBL_PROGRAM')->result();

        $this->load->view('templates_penasihat/header', $data);
        $this->load->view('templates_penasihat/sidebar', $data);
        $this->load->view('approve_program', $data);
        $this->load->view('templates_penasihat/footer');
    }

    public function lulusProgram($PROGRAM_ID)
    {
        // Retrieve program details
        $programDetails = $this->penasihat_model->getProgramById(['PROGRAM_ID' => $PROGRAM_ID], 'TBL_PROGRAM')->row();

        // Check if program details were retrieved
        if (!$programDetails) {
            log_message('error', 'Program details not found for ID: ' . $PROGRAM_ID);
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Program not found!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');
            redirect('penasihat');
            return;
        }

        // Check if the program has already been approved
        if ($programDetails->APPROVAL_STATUS === 'Pending MPP Approval') {
            // Set flashdata message indicating the program is already approved
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        Program has already been approved!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');
        } else {
            // Modify the approval status or other fields as needed
            $updateData = [
                'PROGRAM_ID' => $PROGRAM_ID,
                'APPROVAL_STATUS' => 'Pending MPP Approval',
                //'NOTA_PENASIHATKELAB' => 'Program Diluluskan Penasihat'
            ];

            // Update the record in the database
            $updateStatus = $this->penasihat_model->updateProgram($updateData, 'TBL_PROGRAM');

            if ($updateStatus) {
                // Set flashdata message indicating the program has been approved
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Program has been approved!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            } else {
                log_message('error', 'Failed to update program for ID: ' . $PROGRAM_ID);
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to approve program!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            }
        }

        redirect('penasihat');
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

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'PROGRAM_ID' => $PROGRAM_ID,
                'APPROVAL_STATUS' => 'Rejected by Penasihat',
                'PROGRAM_NOTES' => $this->input->post('PROGRAM_NOTES')
            );

            // Update the program status to 'Rejected'
            $this->penasihat_model->updateProgram($data, 'TBL_PROGRAM');

            // Notify Club President (you need to implement the notification logic)

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Program has been rejected!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('penasihat');
        }
    }

    public function tambahNota($PROGRAM_ID)
    {
        $this->form_validation->set_rules('PROGRAM_NOTES', 'Nota Program', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Reload the page with validation errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('penasihat/approveProgram/' . $PROGRAM_ID);
        } else {
            $data = array(
                'NOTA_PENASIHATKELAB' => $this->input->post('PROGRAM_NOTES'),
                'PROGRAM_ID' => $PROGRAM_ID
            );

            $updateStatus = $this->penasihat_model->updateProgram($data, 'TBL_PROGRAM');

            if ($updateStatus) {
                $this->session->set_flashdata('success', 'Nota program telah ditambah');
            } else {
                $this->session->set_flashdata('error', 'Failed to add nota program');
            }
            redirect('penasihat/approveProgram/' . $PROGRAM_ID);
        }
    }


    public function editNota($PROGRAM_ID)
    {
        $this->form_validation->set_rules('PROGRAM_NOTES', 'Nota Program', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Reload the page with validation errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('penasihat/approveProgram/' . $PROGRAM_ID);
        } else {
            $data = array(
                'NOTA_PENASIHATKELAB' => $this->input->post('PROGRAM_NOTES'),
                'PROGRAM_ID' => $PROGRAM_ID
            );

            $updateStatus = $this->penasihat_model->updateProgram($data, 'TBL_PROGRAM');

            if ($updateStatus) {
                $this->session->set_flashdata('success', 'Nota program telah diubah');
            } else {
                $this->session->set_flashdata('error', 'Failed to update nota program');
            }
            redirect('penasihat/approveProgram/' . $PROGRAM_ID);
        }
    }
}
