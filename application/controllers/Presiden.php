<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presiden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('program_model');
        $this->load->model('hepa_model'); // if needed for getting program details
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
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
        // $this->form_validation->set_rules('TARIKH_MULA', 'Tarikh Mula', 'required', array(
        //     'required' => "%s harus diisi"
        // ));
        // $this->form_validation->set_rules('TARIKH_TAMAT', 'Tarikh Tamat', 'callback_validate_dates');
        $this->form_validation->set_rules('OBJEKTIF_PROGRAM', 'Objektif Program', 'required', array(
            'required' => "%s harus diisi"
        ));
        $this->form_validation->set_rules('TEMPAT_PROGRAM', 'Tempat Program', 'required', array(
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
        print_r($_FILES);
        echo json_encode($_FILES['DOKUMEN_PROGRAM']);
        $this->_rule();

        if ($this->form_validation->run() == TRUE) {
            // Form validation failed, load the view with validation errors
            $this->mohonProgram();
        } else {
            // Form validation succeeded, handle file upload
            $config['upload_path'] = FCPATH . 'uploads/';
            $config['allowed_types'] = 'jpg|png|pdf';
            $config['max_size'] = 20000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('DOKUMEN_PROGRAM')) {
                $error = $this->upload->display_errors();
                log_message('error', 'File upload failed: ' . $error);
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    File upload failed: ' . $error . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');

                // Redirect back to the form
                // redirect('presiden/mohon_program');
            } else {
                // File uploaded successfully, proceed with database insertion
                $upload_data = $this->upload->data();
                log_message('info', 'File uploaded successfully: ' . print_r($upload_data, true));
                $file_name = $upload_data['file_name'];

                // Prepare data for database insertion
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
                    'DOKUMEN_PROGRAM' => $file_name,
                    'APPROVAL_STATUS' => 'Pending'
                );

                // Insert data into database
                $this->program_model->createProgram('TBL_PROGRAM', $data);

                // Set flash data message for success
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Program Berjaya Dimohon!!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

                // Redirect to the listing page
                redirect('presiden');
            }
        }
    }




    public function edit($PROGRAM_ID)
    {
        $this->_rule();

        if ($this->form_validation->run()  == FALSE) {
            $this->index();
        } else {
            $data = array(
                'PROGRAM_ID' => $PROGRAM_ID,
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

    public function cancelProgram($PROGRAM_ID)
    {
        // Retrieve program details
        $programDetails = $this->program_model->getProgramById(['PROGRAM_ID' => $PROGRAM_ID], 'TBL_PROGRAM')->row();
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

    public function assignPengarah($PROGRAM_ID)
    {
        $this->_rulePengarah();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            // Retrieve program details
            $programDetails = $this->program_model->getProgramById(['PROGRAM_ID' => $PROGRAM_ID], 'TBL_PROGRAM')->row();

            // Check if the program has already been approved
            if ($programDetails->APPROVAL_STATUS === 'Approved') {
                // Assign the Pengarah
                $data = array(
                    'PROGRAM_ID' => $PROGRAM_ID,
                    'PENGARAH_MATRIC' => $this->input->post('PENGARAH_MATRIC')
                );

                $this->program_model->updateProgram($data, 'TBL_PROGRAM');

                // Set flashdata message indicating the program has been approved and Pengarah assigned
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Pengarah has been assigned!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            } else {
                // Set flashdata message indicating the program is not yet approved
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Program is not yet approved!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            }

            redirect('presiden');
        }
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
