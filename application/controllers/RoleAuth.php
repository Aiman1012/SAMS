<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleAuth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session'); // Load the session library
    }
    public function index()
    {
        $this->load->view('role_auth');
    }

    public function setRole()
    {
        $selectedRole = $this->input->post('role');

        if ($selectedRole) {
            // Set the role in the session
            $this->session->set_userdata('role', $selectedRole);

            // Redirect to the main page of the selected role
            redirect($selectedRole);
        } else {
            // Handle the case when no role is selected
            redirect('roleauth');
        }
    }
}
