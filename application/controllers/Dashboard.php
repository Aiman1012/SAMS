<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    // public function index()
    // {
    //     $data['title'] = 'Presiden Kelab';

    //     $this->load->view('templates_hepa/header', $data);
    //     $this->load->view('templates_hepa/sidebar', $data);
    //     $this->load->view('dashboardkelab', $data);
    //     $this->load->view('templates_hepa/footer');
    // }
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function fetch_program_data()
    {
        $status = $this->input->get('status');

        if ($status) {
            $this->db->where('APPROVAL_STATUS', $status);
        }
        $query = $this->db->get('program');
        $programs = $query->result();

        echo json_encode($programs);
    }

    public function index()
    {
        $data['title'] = 'Presiden Kelab';

        $this->load->view('templates_presiden/header', $data);
        $this->load->view('templates_presiden/sidebar', $data);
        $this->load->view('dashboardkelab', $data);
        $this->load->view('templates_presiden/footer');
    }

    public function penasihatDashboard()
    {
        $data['title'] = 'Penasihat Kelab';

        $this->load->view('templates_penasihat/header', $data);
        $this->load->view('templates_penasihat/sidebar', $data);
        $this->load->view('dashboardkelab', $data);
        $this->load->view('templates_penasihat/footer');
    }

    public function mppDashboard()
    {
        $data['title'] = 'MPP';

        $this->load->view('templates_mpp/header', $data);
        $this->load->view('templates_mpp/sidebar', $data);
        $this->load->view('dashboardkelab', $data);
        $this->load->view('templates_mpp/footer');
    }

    public function hepaDashboard()
    {
        $data['title'] = 'HEPA Dashboard';

        $this->load->view('templates_hepa/header', $data);
        $this->load->view('templates_hepa/sidebar', $data);
        $this->load->view('dashboardkelab', $data);
        $this->load->view('templates_hepa/footer');
    }
}
