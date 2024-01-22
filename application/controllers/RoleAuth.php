<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleAuth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_auth_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session'); // Load the session library
    }
    public function index()
    {
        $this->load->view('templates_role/header');
        $this->load->view('role_auth');
        $this->load->view('templates_role/footer');
    }

    public function _rule()
    {
        $this->form_validation->set_rules('pengarah_matric', 'Nombor Matrik', 'required', array(
            'required' => "%s harus diisi"
        ));
    }

    public function setRole()
    {
        $selectedRole = $this->input->post('role');

        if ($selectedRole) {
            // Set the role in the session
            $this->session->set_userdata('role', $selectedRole);

            // If 'pengarah' is selected, set the pengarah_matric in the session
            if ($selectedRole === 'pengarah') {
                $pengarah_matric = $this->input->post('pengarah_matric');
                $this->session->set_userdata('pengarah_matric', $pengarah_matric);
            } else {
                // If a different role is selected, remove any existing pengarah_matric from the session
                $this->session->unset_userdata('pengarah_matric');
            }

            // Redirect to the main page of the selected role
            redirect($selectedRole);
        } else {
            // Handle the case when no role is selected
            redirect('roleauth');
        }
    }
}
