<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengarah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengarah_model');
        $this->load->model('program_model'); // Ensure program_model is loaded if needed
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['title'] = 'Pengarah Program';
        $data['pageName'] = 'Senarai Program';

        $pengarahMatric = $this->session->userdata('PENGARAH_MATRIC');
        if (!empty($pengarahMatric)) {
            $data['program'] = $this->program_model->getAssignedPrograms($pengarahMatric)->result();

            $this->load->view('templates_pengarah/header', $data);
            $this->load->view('templates_pengarah/sidebar', $data);
            $this->load->view('pengarah', $data);
            $this->load->view('templates_pengarah/footer');
        } else {
            echo "Pengarah's matric not found in session.";
        }
    }

    public function lihatProgram($PROGRAM_ID)
    {
        $data['title'] = 'Lihat Program';
        $where = array('PROGRAM_ID' => $PROGRAM_ID);

        $data['program'] = $this->program_model->getProgramById($where, 'TBL_PROGRAM')->result();
        $data['PROGRAM_ID'] = $PROGRAM_ID; // Pass the program ID to the view

        $this->load->view('templates_pengarah/header', $data);
        $this->load->view('templates_pengarah/sidebar', $data);
        $this->load->view('edit_program', $data);
        $this->load->view('templates_pengarah/footer');
    }


    public function _rule()
    {
        $this->form_validation->set_rules('NAMA_ANJURAN', 'Nama Anjuran', 'required');
        $this->form_validation->set_rules('KATEGORI_PROGRAM', 'Kategori Program', 'required');
        $this->form_validation->set_rules('TARIKH_MULA', 'Tarikh Mula', 'required');
        //$this->form_validation->set_rules('TARIKH_TAMAT', 'Tarikh Tamat', 'required');
        $this->form_validation->set_rules('OBJEKTIF_PROGRAM', 'Objektif Program', 'required');
        $this->form_validation->set_rules('TEMPAT_PROGRAM', 'Tempat Program', 'required');
        //$this->form_validation->set_rules('MASA_PROGRAM', 'Masa Program', 'required');
        $this->form_validation->set_rules('NEGERI_PROGRAM', 'Negeri Program', 'required');
    }

    public function editProgram($PROGRAM_ID)
    {
        $this->_rule();

        if ($this->form_validation->run() == FALSE) {
            $this->lihatProgram($PROGRAM_ID);
        } else {
            $data = array(
                'PROGRAM_ID' => $PROGRAM_ID,
                'NAMA_ANJURAN' => $this->input->post('NAMA_ANJURAN'),
                'KATEGORI_PROGRAM' => $this->input->post('KATEGORI_PROGRAM'),
                'TARIKH_MULA' => $this->input->post('TARIKH_MULA'),
                'TARIKH_TAMAT' => $this->input->post('TARIKH_TAMAT'),
                'OBJEKTIF_PROGRAM' => $this->input->post('OBJEKTIF_PROGRAM'),
                'TEMPAT_PROGRAM' => $this->input->post('TEMPAT_PROGRAM'),
                'MASA_PROGRAM' => $this->input->post('MASA_PROGRAM'),
                'NEGERI_PROGRAM' => $this->input->post('NEGERI_PROGRAM')
            );

            // Handle file upload
            if (!empty($_FILES['DOKUMEN_PROGRAM']['name'])) {
                $upload = $this->_do_upload();
                if ($upload) {
                    $data['DOKUMEN_PROGRAM'] = $upload;
                }
            }

            $this->pengarah_model->updateProgram($data, 'TBL_PROGRAM');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Program Succesfully Updated!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('pengarah');
        }
    }

    private function _do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048; // 2MB

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('DOKUMEN_PROGRAM')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . $error . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('pengarah');
            return false;
        }

        return $this->upload->data('file_name');
    }

    public function ajkForm($PROGRAM_ID)
    {
        // Logic to assign AJK to the program
        $data['title'] = 'Assign AJK Program';
        $data['PROGRAM_ID'] = $PROGRAM_ID;

        // Fetch the program name
        $program = $this->program_model->getProgramById(array('PROGRAM_ID' => $PROGRAM_ID), 'TBL_PROGRAM')->row();
        $data['program_name'] = $program ? $program->NAMA_PROGRAM : 'Unknown Program';

        // Fetch the list of AJKs for this program
        $data['ajk_list'] = $this->pengarah_model->getAjkByProgramId($PROGRAM_ID);

        // Load the view to handle the assignment, replace 'assign_ajk' with your view
        $this->load->view('templates_pengarah/header', $data);
        $this->load->view('templates_pengarah/sidebar', $data);
        $this->load->view('assign_ajk', $data);
        $this->load->view('templates_pengarah/footer');
    }



    public function assignAjkProgram($PROGRAM_ID)
    {
        // Load the necessary model
        $this->load->model('pengarah_model');

        // Retrieve form data
        $noMatric = $this->input->post('NO_MATRIC');
        $namaAjk = $this->input->post('NAMA_AJK');
        $emailAjk = $this->input->post('EMAIL_AJK');
        $positionAjk = $this->input->post('POSITION_AJK');

        // Check if the form data is properly received
        if (empty($noMatric) || empty($namaAjk) || empty($emailAjk) || empty($positionAjk)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            All fields are required.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('pengarah/ajkForm/' . $PROGRAM_ID);
            return;
        }

        // Prepare data for insertion
        $data = array(
            'NO_MATRIC' => $noMatric,
            'NAMA_AJK' => $namaAjk,
            'EMAIL_AJK' => $emailAjk,
            'POSITION_AJK' => $positionAjk,
            'PROGRAM_ID' => $PROGRAM_ID
        );

        // Insert data into database
        $this->pengarah_model->insertAjkProgram($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        AJK Successfully Added!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>');
        redirect('pengarah/ajkForm/' . $PROGRAM_ID);
    }


    // public function ajkForm()
    // {
    //     $data['title'] = 'Assign AJK Program';
    //     $this->load->view('templates_pengarah/header', $data);
    //     $this->load->view('templates_pengarah/sidebar', $data);
    //     $this->load->view('ajk_form', $data); // Ensure this matches your view filename
    //     $this->load->view('templates_pengarah/footer');
    // }
}
