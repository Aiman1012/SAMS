<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presiden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('program_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index()
    {
        $data['title'] = 'Presiden Kelab';
        $data['program'] = $this->program_model->getData('tbl_program')->result();

        $this->load->view('templates_presiden/header', $data);
        $this->load->view('templates_presiden/sidebar', $data);
        $this->load->view('presiden', $data);
        $this->load->view('templates_presiden/footer');
        var_dump($this->session->userdata('role'));
    }

    public function lihatProgram($program_id)
    {
        $data['title'] = 'Lihat Program';
        $where = array('program_id' => $program_id);

        // Fetch the program details
        $data['program'] = $this->program_model->getProgramById($where, 'tbl_program')->result();

        $this->load->view('templates_presiden/header', $data);
        $this->load->view('templates_presiden/sidebar', $data);
        $this->load->view('lihat_program', $data);
        $this->load->view('templates_presiden/footer');
    }



    public function mohonProgram()
    {
        $data['title'] = 'Mohon Program';

        $this->load->view('templates_presiden/header', $data);
        $this->load->view('templates_presiden/sidebar', $data);
        $this->load->view('mohon_program', $data);
        $this->load->view('templates_presiden/footer');
    }

    public function _rule()
    {
        $this->form_validation->set_rules('nama_kelab', 'Nama Kelab', 'required', array(
            'required' => "%s perlu diisi"
        ));
        $this->form_validation->set_rules('nama_program', 'Nama Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('nama_pengarah', 'Nama Pengarah', 'required', array(
            'required' => "%s harus diisi"
        ));
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

    public function mohon_program_action()
    {
        $this->_rule();

        if ($this->form_validation->run()  == FALSE) {
            $this->mohonProgram();
        } else {
            $data = array(
                'nama_kelab' => $this->input->post('nama_kelab'),
                'nama_program' => $this->input->post('nama_program'),
                'nama_pengarah' => $this->input->post('nama_pengarah'),
                'nama_anjuran' => $this->input->post('nama_anjuran'),
                'kategori_program' => $this->input->post('kategori_program'),
                'tarikh_mula' => $this->input->post('tarikh_mula'),
                'tarikh_tamat' => $this->input->post('tarikh_tamat'),
                'objektif_program' => $this->input->post('objektif_program'),
                'tempat_program' => $this->input->post('tempat_program'),
                'masa_program' => $this->input->post('masa_program'),
                'negeri_program' => $this->input->post('negeri_program'),
                'dokumen_program' => $this->input->post('dokumen_program'),
                'approval_status' => 'Pending'
            );


            $this->program_model->createProgram('tbl_program', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Program Berjaya Dimohon!!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>');
            redirect('presiden');
        }
    }

    public function edit($program_id)
    {
        $this->_rule();

        if ($this->form_validation->run()  == FALSE) {
            $this->index();
        } else {
            $data = array(
                'program_id' => $program_id,
                'nama_kelab' => $this->input->post('nama_kelab'),
                'nama_program' => $this->input->post('nama_program'),
                'nama_pengarah' => $this->input->post('nama_pengarah'),
                'nama_anjuran' => $this->input->post('nama_anjuran'),
                'kategori_program' => $this->input->post('kategori_program'),
                'tarikh_mula' => $this->input->post('tarikh_mula'),
                'tarikh_tamat' => $this->input->post('tarikh_tamat'),
                'objektif_program' => $this->input->post('objektif_program'),
                'tempat_program' => $this->input->post('tempat_program'),
                'masa_program' => $this->input->post('masa_program'),
                'negeri_program' => $this->input->post('negeri_program'),
                'dokumen_program' => $this->input->post('dokumen_program')
            );


            $this->program_model->updateProgram($data, 'tbl_program');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Program Succesfully Updated!!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		    </div>');
            redirect('presiden');
        }
    }

    public function deleteProgram($id)
    {
        $where = array('program_id' => $id);

        $this->program_model->deleteProgram($where, 'tbl_program');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Program Succesfully Deleted!!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
        redirect('presiden');
    }
}
