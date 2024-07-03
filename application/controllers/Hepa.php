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
        // $this->load->library('m_pdf'); // Load the m_pdf library
    }

    public function index()
    {
        $data['title'] = 'Admin HEPA';
        $data['pageName'] = 'Senarai Program';

        // Fetch data from TBL_PROGRAM
        $data['program'] = $this->hepa_model->getData('TBL_PROGRAM')->result();

        $this->load->view('templates_hepa/header', $data);
        $this->load->view('templates_hepa/sidebar', $data);
        $this->load->view('hepa', $data);
        $this->load->view('templates_hepa/footer');
    }

    // public function approveProgram($PROGRAM_ID)
    // {
    //     $data['title'] = 'Approve Program';
    //     $data['program'] = $this->hepa_model->getProgramByIdFromProgram($PROGRAM_ID);

    //     log_message('debug', 'Program data: ' . print_r($data['program'], true));

    //     if (!$data['program']) {
    //         show_error('Program not found');
    //     }

    //     $this->load->view('templates_hepa/header', $data);
    //     $this->load->view('templates_hepa/sidebar', $data);
    //     $this->load->view('approve_program', $data);
    //     $this->load->view('templates_hepa/footer');
    // }

    public function approveProgram($id)
    {
        $data['title'] = 'Admin HEPA';
        $data['pageName'] = 'Senarai Program';
        // Load the Program_model
        $this->load->model('Program_model');

        // Get the program by ID
        $program = $this->Program_model->getProgramById(array('PROGRAM_ID' => $id), 'TBL_PROGRAM')->row();

        // Check if program exists
        if (!$program) {
            // Handle case where program with given ID does not exist
            // Redirect or show error message
            redirect('error/not_found'); // Example redirect to a not found page
            return;
        }

        // Pass the program data to the view
        $data['program'] = array($program); // Wrap in array to ensure it's iterable in the view

        // Load the view with program data
        $this->load->view('templates_hepa/header', $data);
        $this->load->view('templates_hepa/sidebar', $data);
        $this->load->view('approve_program', $data);
        $this->load->view('templates_hepa/footer');
    }

    // Approve program to the database
    public function lulusProgram($PROGRAM_ID)
    {
        // Retrieve program details
        $programDetails = $this->hepa_model->getProgramByIdFromProgram($PROGRAM_ID);

        // Check if the program has already been approved
        if ($programDetails->APPROVAL_STATUS === 'Approved') {
            // Set flashdata message indicating the program is already approved
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        Program has already been approved!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        } else {
            // Modify the approval status or other fields as needed
            $programDetails->APPROVAL_STATUS = 'Approved';

            // Update the record in the database
            $this->hepa_model->updateProgram((array) $programDetails, 'TBL_PROGRAM');

            // Set flashdata message indicating the program has been approved
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Program has been approved!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        }

        redirect('hepa');
    }

    public function rejectProgram($PROGRAM_ID)
    {
        // Your logic to update approval status to 'Rejected'
        $this->_ruleReject();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'PROGRAM_ID' => $PROGRAM_ID,
                'APPROVAL_STATUS' => 'Rejected by HEPA',
                'PROGRAM_NOTES' => $this->input->post('PROGRAM_NOTES')
            );

            // Update the program status to 'Rejected'
            $this->hepa_model->updateProgram($data, 'TBL_PROGRAM');

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

    public function approveProgramForm($PROGRAM_ID)
    {
        $data['title'] = 'Approve Program';
        $data['PROGRAM_ID'] = $PROGRAM_ID;
        $data['program'] = $this->hepa_model->getProgramByIdFromSuratHepa($PROGRAM_ID);

        $this->load->view('templates_hepa/header', $data);
        $this->load->view('templates_hepa/sidebar', $data);
        $this->load->view('hepa_form', $data);
        $this->load->view('templates_hepa/footer');
    }

    public function submitApproval()
    {
        $this->form_validation->set_rules('PERUNTUKAN_KEWANGAN_HEPA', 'Peruntukan Kewangan Hepa', 'required');
        // Add other validation rules as needed

        if ($this->form_validation->run() == FALSE) {
            log_message('debug', 'Form validation failed: ' . validation_errors());
            $this->approveProgramForm($this->input->post('PROGRAM_ID'));
        } else {
            $data = array(
                'PROGRAM_ID' => $this->input->post('PROGRAM_ID'),
                'PERUNTUKAN_KEWANGAN_HEPA' => $this->input->post('PERUNTUKAN_KEWANGAN_HEPA'),
                'DANA_TABUNG_AMANAH' => $this->input->post('DANA_TABUNG_AMANAH'),
                'BILANGAN_SIJIL_TNC_HEPA' => $this->input->post('BILANGAN_SIJIL_TNC_HEPA'),
                'BILANGAN_SIJIL_PENGARAH_PPHKP' => $this->input->post('BILANGAN_SIJIL_PENGARAH_PPHKP'),
                'BIL_PESERTA' => $this->input->post('BIL_PESERTA'),
                'KUTIPAN_YURAN_PESERTA' => $this->input->post('KUTIPAN_YURAN_PESERTA'),
                'KOS_PROGRAM' => $this->input->post('KOS_PROGRAM'),
                'PEGAWAI_PENGIRING_1_NAMA' => $this->input->post('PEGAWAI_PENGIRING_1_NAMA'),
                'PEGAWAI_PENGIRING_1_NO_KP' => $this->input->post('PEGAWAI_PENGIRING_1_NO_KP'),
                'PEGAWAI_PENGIRING_1_JAWATAN' => $this->input->post('PEGAWAI_PENGIRING_1_JAWATAN'),
                'PEGAWAI_PENGIRING_1_NO_TEL' => $this->input->post('PEGAWAI_PENGIRING_1_NO_TEL'),
                'PEGAWAI_PENGIRING_2_NAMA' => $this->input->post('PEGAWAI_PENGIRING_2_NAMA'),
                'PEGAWAI_PENGIRING_2_NO_KP' => $this->input->post('PEGAWAI_PENGIRING_2_NO_KP'),
                'PEGAWAI_PENGIRING_2_JAWATAN' => $this->input->post('PEGAWAI_PENGIRING_2_JAWATAN'),
                'PEGAWAI_PENGIRING_2_NO_TEL' => $this->input->post('PEGAWAI_PENGIRING_2_NO_TEL'),
                'DISEDIAKAN_NAMA' => $this->input->post('DISEDIAKAN_NAMA'),
                'DISEDIAKAN_JAWATAN' => $this->input->post('DISEDIAKAN_JAWATAN'),
                'DISEDIAKAN_BAGI_PIHAK' => $this->input->post('DISEDIAKAN_BAGI_PIHAK'),
                'DISEDIAKAN_STATUS' => $this->input->post('DISEDIAKAN_STATUS'),
                'DISOKONG_NAMA' => $this->input->post('DISOKONG_NAMA'),
                'DISOKONG_JAWATAN' => $this->input->post('DISOKONG_JAWATAN'),
                'DISOKONG_BAGI_PIHAK' => $this->input->post('DISOKONG_BAGI_PIHAK'),
                'DISOKONG_STATUS' => $this->input->post('DISOKONG_STATUS'),
                'KELULUSAN_NAMA' => $this->input->post('KELULUSAN_NAMA'),
                'KELULUSAN_JAWATAN' => $this->input->post('KELULUSAN_JAWATAN'),
                'KELULUSAN_BAGI_PIHAK' => $this->input->post('KELULUSAN_BAGI_PIHAK'),
                'KELULUSAN_STATUS' => $this->input->post('KELULUSAN_STATUS'),
            );

            // Combine 'KENDERAAN_UNIVERSITI' and 'bilangan_kenderaan' into a single array
            $kenderaan = [];
            $kenderaan_universiti = $this->input->post('KENDERAAN_UNIVERSITI');
            $bilangan_kenderaan = $this->input->post('bilangan_kenderaan');
            if (!empty($kenderaan_universiti) && is_array($kenderaan_universiti)) {
                for (
                    $i = 0;
                    $i < count($kenderaan_universiti);
                    $i++
                ) {
                    $kenderaan[] = [
                        'jenis' => $kenderaan_universiti[$i],
                        'bilangan' => $bilangan_kenderaan[$i]
                    ];
                }
            }
            $data['KENDERAAN_UNIVERSITI'] = json_encode($kenderaan);

            // Combine 'bil_peserta' and 'bayaran_peserta' into a single array
            $peserta = $this->preparePesertaData(
                $this->input->post('bil_peserta'),
                $this->input->post('bayaran_peserta')
            );
            $data['PESERTA'] = json_encode($peserta);

            log_message('debug', 'Data to be inserted: ' . print_r($data, true));

            if ($this->hepa_model->approveProgram($data)) {
                log_message('debug', 'Data successfully inserted into the database.');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Program approved successfully!</div>');
                redirect('hepa/programDetails/' . $data['PROGRAM_ID']);
            } else {
                log_message('error', 'Failed to insert data into the database.');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to approve the program. Please try again.</div>');
                $this->approveProgramForm($this->input->post('PROGRAM_ID'));
            }
        }
    }




    private function _ruleReject()
    {
        $this->form_validation->set_rules('PROGRAM_NOTES', 'Nota Program', 'required', array(
            'required' => "%s harus diisi"
        ));
    }

    public function tambahNota($PROGRAM_ID)
    {
        $nota = $this->input->post('nota_hepa');
        $this->hepa_model->updateProgram(array('PROGRAM_ID' => $PROGRAM_ID, 'NOTA_HEPA' => $nota), 'TBL_PROGRAM');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Nota HEPA telah ditambah!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('hepa/approveProgram/' . $PROGRAM_ID);
    }

    public function editNota($PROGRAM_ID)
    {
        $nota = $this->input->post('nota_hepa');
        $this->hepa_model->updateProgram(array('PROGRAM_ID' => $PROGRAM_ID, 'NOTA_HEPA' => $nota), 'TBL_PROGRAM');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Nota HEPA telah dikemaskini!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>');
        redirect('hepa/approveProgram/' . $PROGRAM_ID);
    }

    public function preparePesertaData($bil_peserta, $bayaran_peserta)
    {
        $peserta = array();
        if (is_array($bil_peserta) && is_array($bayaran_peserta)) {
            for ($i = 0; $i < count($bil_peserta); $i++) {
                $peserta[] = array(
                    'bil_peserta' => $bil_peserta[$i],
                    'bayaran_peserta' => $bayaran_peserta[$i]
                );
            }
        }
        return $peserta;
    }


    public function programDetails($PROGRAM_ID)
    {
        $data['title'] = 'Program Details';
        $data['PROGRAM_ID'] = $PROGRAM_ID;
        $data['program'] = $this->hepa_model->getProgramDetails($PROGRAM_ID);

        $this->load->view('templates_hepa/header', $data);
        $this->load->view('templates_hepa/sidebar', $data);
        $this->load->view('program_list', $data);
        $this->load->view('templates_hepa/footer');
    }

    // public function cetak($PROGRAM_ID)
    // {
    //     $data['program'] = $this->Program_model->getProgramById(['PROGRAM_ID' => $PROGRAM_ID])->row();
    //     $html = $this->load->view('program_pdf', $data, true);

    //     $this->load->library('pdf');
    //     $pdf = new \Mpdf\Mpdf();
    //     $pdf->WriteHTML($html);
    //     $pdf->Output('program_details.pdf', 'D');
    // }

    public function cetak($PROGRAM_ID)
    {
        // Load the necessary data
        $program = $this->hepa_model->getProgramDetails($PROGRAM_ID);
        if (!$program) {
            show_error('Program not found', 404);
            return;
        }

        // Load the view with program data to generate HTML
        $html = $this->load->view('program_pdf', ['program' => $program], true);

        // Create a new mPDF instance and configure it
        $mpdf = new \Mpdf\Mpdf([
            'margin_top' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
        ]);

        // Write the HTML to the PDF
        $mpdf->WriteHTML($html);

        // Output the PDF
        $mpdf->Output('program_details.pdf', 'I'); // 'D' to download, 'I' to view in browser
    }
}

    // function cetak($id)
    // {

    //     $data = [];

    //     $bil2 = $this->load->view("pdf/surat.php", $data, true);
    //     $mpdf = new \Mpdf\Mpdf();
    //     $mpdf->WriteHTML($bil2);
    //     $mpdf->Output();
    // }
