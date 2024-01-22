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

        $data['program'] = $this->program_model->getData('tbl_program')->result();

        $this->load->view('templates_pengarah/header', $data);
        $this->load->view('templates_pengarah/sidebar', $data);
        $this->load->view('pengarah', $data);
        $this->load->view('templates_pengarah/footer');
        var_dump($this->session->userdata('role'));
        var_dump($this->session->userdata('pengarah_matric'));
    }

    public function lihatProgram($program_id)
    {
        $data['title'] = 'Lihat Program';
        $where = array('program_id' => $program_id);

        // Fetch the program details
        $data['program'] = $this->program_model->getProgramById($where, 'tbl_program')->result();

        $this->load->view('templates_pengarah/header', $data);
        $this->load->view('templates_pengarah/sidebar', $data);
        $this->load->view('edit_program', $data);
        $this->load->view('templates_pengarah/footer');
    }



    public function _rule()
    {
        $this->form_validation->set_rules('kategori_program', 'Kategori Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('tarikh_mula', 'Tarikh Mula', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('tarikh_tamat', 'Tarikh Tamat', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('objektif_program', 'Objektif Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('tempat_program', 'Tempat Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('masa_program', 'Masa Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('negeri_program', 'Negeri Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('dokumen_program', 'Kertas Kerja Program', 'required', array(
            'required' => "%s harus diisi"
        ));
    }
    public function editProgram($program_id)
    {
        $this->_rule();

        if ($this->form_validation->run()  == FALSE) {
            $this->index();
        } else {
            $data = array(
                'program_id' => $program_id,
                'nama_anjuran' => $this->input->post('nama_anjuran'),
                'kategori_program' => $this->input->post('kategori_program'),
                'tarikh_mula' => $this->input->post('tarikh_mula'),
                'tarikh_tamat' => $this->input->post('tarikh_tamat'),
                'objektif_program' => $this->input->post('objektif_program'),
                'tempat_program' => $this->input->post('tempat_program'),
                'masa_program' => $this->input->post('masa_program'),
                'negeri_program' => $this->input->post('negeri_program'),
                'dokumen_program' => $this->input->post('dokumen_program'),
                'approval_status' => 'Edit Request Sent'
            );


            $this->program_model->updateProgram($data, 'tbl_program');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Program Succesfully Updated!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('pengarah');
        }
    }
}
