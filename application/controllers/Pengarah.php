<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengarah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengarah_model');
        $this->load->model('program_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Pengarah Program';
        $data['pageName'] = 'Senarai Program';

        // Retrieve Pengarah's matric number from the session
        $pengarahMatric = $this->session->userdata('PENGARAH_MATRIC');

        if (!empty($pengarahMatric)) {
            // Fetch only the programs assigned to the logged-in Pengarah
            $data['program'] = $this->program_model->getAssignedPrograms($pengarahMatric)->result();

            $this->load->view('templates_pengarah/header', $data);
            $this->load->view('templates_pengarah/sidebar', $data);
            $this->load->view('pengarah', $data);
            $this->load->view('templates_pengarah/footer');
            var_dump($this->session->userdata('role'));
            var_dump($this->session->userdata('PENGARAH_MATRIC'));
        } else {
            // Handle the case when Pengarah's matric is not found in the session
            echo "Pengarah's matric not found in session.";
        }
    }



    public function lihatProgram($program_ID)
    {
        $data['title'] = 'Lihat Program';
        $where = array('PROGRAM_ID' => $program_ID);

        // Fetch the program details
        $data['program'] = $this->program_model->getProgramById($where, 'TBL_PROGRAM')->result();

        $this->load->view('templates_pengarah/header', $data);
        $this->load->view('templates_pengarah/sidebar', $data);
        $this->load->view('edit_program', $data);
        $this->load->view('templates_pengarah/footer');
    }



    public function _rule()
    {
        $this->form_validation->set_rules('KATEGORI_PROGRAM', 'Kategori Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('TARIKH_MULA', 'Tarikh Mula', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('TARIKH_TAMAT', 'Tarikh Tamat', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('OBJEKTIF_PROGRAM', 'Objektif Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('TEMPAT_PROGRAM', 'Tempat Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('MASA_PROGRAM', 'Masa Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('NEGERI_PROGRAM', 'Negeri Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('DOKUMEN_PROGRAM', 'Kertas Kerja Program', 'required', array(
            'required' => "%s harus diisi"
        ));
    }
    public function editProgram($program_ID)
    {
        $this->_rule();

        if ($this->form_validation->run()  == FALSE) {
            $this->index();
        } else {
            $data = array(
                'PROGRAM_ID' => $program_ID,
                'NAMA_ANJURAN' => $this->input->post('NAMA_ANJURAN'),
                'KATEGORI_PROGRAM' => $this->input->post('KATEGORI_PROGRAM'),
                'TARIKH_MULA' => $this->input->post('TARIKH_MULA'),
                'TARIKH_TAMAT' => $this->input->post('TARIKH_TAMAT'),
                'OBJEKTIF_PROGRAM' => $this->input->post('OBJEKTIF_PROGRAM'),
                'TEMPAT_PROGRAM' => $this->input->post('TEMPAT_PROGRAM'),
                'MASA_PROGRAM' => $this->input->post('MASA_PROGRAM'),
                'NEGERI_PROGRAM' => $this->input->post('NEGERI_PROGRAM'),
                'DOKUMEN_PROGRAM' => $this->input->post('DOKUMEN_PROGRAM'),
                'APPROVAL_STATUS' => 'Edit Request Sent'
            );


            $this->program_model->updateProgram($data, 'TBL_PROGRAM');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Program Succesfully Updated!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('pengarah');
        }
    }

    public function cancelProgram($program_ID)
    {
        // Retrieve program details
        $programDetails = $this->program_model->getProgramById(['PROGRAM_ID' => $program_ID], 'TBL_PROGRAM')->row();
        // Modify the approval status or other fields as needed
        $programDetails->APPROVAL_STATUS = 'Cancelled';

        // Update the record in the database
        $this->program_model->updateProgram((array) $programDetails, 'TBL_PROGRAM');

        // Set flashdata message indicating the program has been cancelled
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Program has been cancelled!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');


        redirect('pengarah');
    }
}
