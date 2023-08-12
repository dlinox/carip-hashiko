<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends CI_Controller
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
        $this->load->model('person_model', 'person');
        $this->load->model('UsuarioModel', 'usuario_model');
        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->load->helper('Response');
        $this->user_id = $this->session->userdata('authorized');
        $this->user_tipo_id = $this->session->userdata('tipo_usua');
    }

    public function index()
    {
        $this->lista();
    }

    public function lista($json = false)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $columns = array(
            array('db' => 'dni_cliente', 'dt' => 'N° DNI', "field" => 'dni_cliente'),
            array('db' => 'nombres_cliente', 'dt' => 'NOMBRE(S)', "field" => 'nombres_cliente'),
            array('db' => 'apellidos_cliente', 'dt' => 'APELLIDOS', "field" => 'apellidos_cliente'),
            array('db' => 'telefono_cliente', 'dt' => 'TELEFONO', "field" => 'telefono_cliente'),
            array('db' => 'correo_cliente', 'dt' => 'CORREO', "field" => 'correo_cliente'),
            array('db' => 'fecha_registro_cliente','dt' => 'FECHA REGISTRO', "field" => 'fecha_registro_cliente'),
            array('db' => 'id_cliente','dt' => 'DT_RowId', "field" => "id_cliente")
        );
        foreach ($columns as &$item) {
            $item['field'] = $item['db'];
        }

        if ($json) {

            $json = isset($_GET['json']) ? $_GET['json'] : false;

            $table = 'cliente';
            $primaryKey = 'id_cliente';

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );

            $condiciones = array();
            $joinQuery = "";

            $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
            echo json_encode(
                $this->ssp->simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where)
            );
            exit(0);
        }

        $datos['columns'] = $columns;
        $datos['titulo'] = "Lista de Clientes";

        $this->cssjs->add_js($this->jsPath . "clientes/lista.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/lista", $datos);
        $this->load->view('footer');
    }

    public function cliente_crear($id = "")
    {
        if (empty($id)) {

            $cliente = new stdClass();
            $cliente->id_cliente = "";
            $cliente->nombres_cliente = "";
            $cliente->apellidos_cliente = "";
            $cliente->dni_cliente = "";
            $cliente->telefono_cliente = "";
            $cliente->correo_cliente = "";
        } else {
            $cliente = $this->db->where("id_cliente", $id)->get("cliente")->row();
        }
        $data["cliente"] = $cliente;
        $this->load->view($this->controller . "/form_cliente", $data);
    }

    public function cliente_guardar($id = null)
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_message('greater_than', '%s debe de ser número mayor a 0');

        $this->form_validation->set_rules('nombres', 'Nombre(s)', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('dni', 'DNI', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }

        $data = array(
            'nombres_cliente'  => $this->input->post("nombres"),
            'apellidos_cliente'    => $this->input->post("apellidos"),
            'dni_cliente'  => $this->input->post("dni"),
            'telefono_cliente'    => $this->input->post("telefono"),
            'correo_cliente'   => $this->input->post("correo")
        );
        if ($id != null) {
            $condicion = array("id_cliente" => $id);
            if ($this->general->update_data("cliente", $data, $condicion)) {
                $resp["exito"] = true;
                $resp["mensaje"] = "Datos del Cliente Actualizados!";
            } else {
                $resp["exito"] = false;
                $resp["mensaje"] = "Ocurrio un error, intentelo más tarde";
            }
        } else {

            if ($this->general->save_data("cliente", $data) != false) {
                $resp["exito"] = true;
                $resp["mensaje"] = "Cliente Agregado";
            } else {
                $resp["exito"] = false;
                $resp["mensaje"] = "Ocurrio un error, intentelo más tarde";
            }
        }
        echo json_encode($resp);
    }

    public function cliente_eliminar($id)
    {
        $this->db->trans_start();
        $this->general->delete_data("cliente", array("id_cliente" => $id));
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $json["exito"] = false;
            $json["mensaje"] = "Error al tratar de eliminar";
        } else {
            $json["exito"] = true;
            $json["mensaje"] = "Eliminado con exito";
        }
        echo json_encode($json);
    }
}
