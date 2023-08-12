<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reserva extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('authorized') && $this->session->userdata('tipo_usua') != 2) {
            redirect(base_url() . "login");
        }

        $this->load->library('Cssjs');
        $this->load->library('form_validation');
        $this->load->library('Ssp');
        $this->jsPath = base_url() . "assets/js/";
        $this->cssPath = base_url() . "assets/css/";
        $this->load->model('Model_general', 'general');
        $this->load->model('HotelModel', 'model');
        $this->load->model('AlumnoModel', 'alumno_model');
        $this->load->model('UsuarioModel', 'usuario_model');
        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->load->helper('Response');
        $this->user_id = $this->session->userdata('authorized');
        $this->user_tipo_id = $this->session->userdata('tipo_usua');
    }

    public function index()
    {
        $this->calendario();
    }

    public function calendario($json = false)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');


        $this->cssjs->add_js($this->jsPath . "Reserva/calendario.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/calendario");
        $this->load->view('footer');
    }
}
