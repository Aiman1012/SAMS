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

        // Get the status filter from the GET request
        $status_filter = $this->input->get('status_filter');

        // Load the model that handles programs
        $this->load->model('Program_model');

        // Fetch the programs based on the status filter
        if ($status_filter) {
            $data['program'] = $this->Program_model->getProgramsByStatus($status_filter);
        } else {
            $data['program'] = $this->Program_model->getAllPrograms();
        }

        // Load the views with the filtered data
        $this->load->view('templates_presiden/header', $data);
        $this->load->view('templates_presiden/sidebar', $data);
        $this->load->view('presiden', $data);
        $this->load->view('templates_presiden/footer');
        var_dump($this->session->userdata('role'));
    }

    public function lihatProgram($PROGRAM_ID)
    {
        $data['title'] = 'Lihat Program';
        $where = array('PROGRAM_ID' => $PROGRAM_ID);

        // Fetch the program details
        $this->load->model('Program_model');  // Ensure the model is loaded
        $data['program'] = $this->Program_model->getProgramById($where, 'TBL_PROGRAM')->result();

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
        $this->form_validation->set_rules('NAMA_KELAB', 'Nama Kelab', 'required', array(
            'required' => "%s perlu diisi"
        ));
        $this->form_validation->set_rules('NAMA_PROGRAM', 'Nama Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('NAMA_PENGARAH', 'Nama Pengarah', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('PENGARAH_MATRIC', 'No Matriks', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('KATEGORI_PROGRAM', 'Kategori Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('TARIKH_MULA', 'Tarikh Mula', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('TARIKH_TAMAT', 'Tarikh Tamat', 'callback_validate_dates');
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

    public function validate_dates($TARIKH_TAMAT)
    {
        $TARIKH_MULA = $this->input->post('TARIKH_MULA');

        if ($TARIKH_TAMAT && $TARIKH_MULA && $TARIKH_TAMAT < $TARIKH_MULA) {
            $this->form_validation->set_message('validate_dates', 'Tarikh Tamat cannot be before Tarikh Mula.');
            return false;
        }
        return true;
    }


    public function mohon_program_action()
    {
        $this->_rule();

        if ($this->form_validation->run()  == FALSE) {
            $this->mohonProgram();
        } else {
            $data = array(
                'NAMA_KELAB' => $this->input->post('NAMA_KELAB'),
                'NAMA_PROGRAM' => $this->input->post('NAMA_PROGRAM'),
                'NAMA_PENGARAH' => $this->input->post('NAMA_PENGARAH'),
                'PENGARAH_MATRIC' => $this->input->post('PENGARAH_MATRIC'),
                'NAMA_ANJURAN' => $this->input->post('NAMA_ANJURAN'),
                'KATEGORI_PROGRAM' => $this->input->post('KATEGORI_PROGRAM'),
                'TARIKH_MULA' => $this->input->post('TARIKH_MULA'),
                'TARIKH_TAMAT' => $this->input->post('TARIKH_TAMAT'),
                'OBJEKTIF_PROGRAM' => $this->input->post('OBJEKTIF_PROGRAM'),
                'TEMPAT_PROGRAM' => $this->input->post('TEMPAT_PROGRAM'),
                'MASA_PROGRAM' => $this->input->post('MASA_PROGRAM'),
                'NEGERI_PROGRAM' => $this->input->post('NEGERI_PROGRAM'),
                'DOKUMEN_PROGRAM' => $this->input->post('DOKUMEN_PROGRAM'),
                'APPROVAL_STATUS' => 'Pending'
            );


            $this->program_model->createProgram('TBL_PROGRAM', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Program Berjaya Dimohon!!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>');
            redirect('presiden');
        }
    }

    public function edit($program_ID)
    {
        $this->_rule();

        if ($this->form_validation->run()  == FALSE) {
            $this->index();
        } else {
            $data = array(
                'PROGRAM_ID' => $program_ID,
                'NAMA_KELAB' => $this->input->post('NAMA_KELAB'),
                'NAMA_PROGRAM' => $this->input->post('NAMA_PROGRAM'),
                'NAMA_PENGARAH' => $this->input->post('NAMA_PENGARAH'),
                'PENGARAH_MATRIC' => $this->input->post('PENGARAH_MATRIC'),
                'NAMA_ANJURAN' => $this->input->post('NAMA_ANJURAN'),
                'KATEGORI_PROGRAM' => $this->input->post('KATEGORI_PROGRAM'),
                'TARIKH_MULA' => $this->input->post('TARIKH_MULA'),
                'TARIKH_TAMAT' => $this->input->post('TARIKH_TAMAT'),
                'OBJEKTIF_PROGRAM' => $this->input->post('OBJEKTIF_PROGRAM'),
                'TEMPAT_PROGRAM' => $this->input->post('TEMPAT_PROGRAM'),
                'MASA_PROGRAM' => $this->input->post('MASA_PROGRAM'),
                'NEGERI_PROGRAM' => $this->input->post('NEGERI_PROGRAM'),
                'DOKUMEN_PROGRAM' => $this->input->post('DOKUMEN_PROGRAM'),
                'APPROVAL_STATUS' => 'Pending'
            );


            $this->program_model->updateProgram($data, 'TBL_PROGRAM');
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
        $where = array('PROGRAM_ID' => $id);

        $this->program_model->deleteProgram($where, 'TBL_PROGRAM');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Program Succesfully Deleted!!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
        redirect('presiden');
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


        redirect('presiden');
    }
    public function _rulePengarah()
    {
        $this->form_validation->set_rules('PENGARAH_MATRIC', 'No Matriks', 'required', array(
            'required' => "%s harus diisi"
        ));
    }

    public function filterProgram()
    {

        // Get the status filter from the GET request
        $status_filter = $this->input->get('status_filter');

        // Fetch the programs based on the status filter
        if ($status_filter) {
            $data['program'] = $this->program_model->getProgramsByStatus($status_filter);
        } else {
            $data['program'] = $this->program_model->getAllPrograms();
        }

        // Load the view with the filtered data
        $this->load->view('presiden', $data);
    }
}
