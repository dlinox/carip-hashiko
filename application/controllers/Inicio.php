<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
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
        $this->load->model('InicioModel', 'inicio');

        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->load->helper('Response');
        $this->user_id = $this->session->userdata('authorized');
        $this->user_tipo_id = $this->session->userdata('tipo_usua');
    }

    public function index(){
        $this->dashboard();
    }

    

    /*******************************************************************************************
                                    Flujo de Caja
     *******************************************************************************************/
    public function dashboard($json = false)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;
        
        $inscripcion = $this->inicio->get_inscripciones_hoy();
        $cliente = $this->inicio->get_clientes_hoy();
        $reserva = $this->inicio->get_reservas_hoy();
        $venta = $this->inicio->get_ventas_hoy();

        $datos['inscripcion'] = $inscripcion;
        $datos['cliente'] = $cliente;
        $datos['reserva'] = $reserva;
        $datos['venta'] = $venta;

        $this->cssjs->add_js($this->jsPath . "inicio/inicio.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/dashboard", $datos);
        $this->load->view('footer');
    }

    public function producto_mas_vendido(){
        $resp = $this->inicio->get_productos();
        echo json_encode($resp);
    }
    public function venta_anual(){
        $resp = $this->inicio->get_ventas();
        echo json_encode($resp);
    }


}
