<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('authorized')) {
            redirect(base_url() . "login");
        }
        if ($this->session->userdata('tipo_usua') != 2) {
            redirect(base_url() . "login");
        }
        $this->load->library('Cssjs');
        $this->load->library('form_validation');
        $this->load->model('Model_general', 'general');
        $this->load->model('UsuarioModel', 'model');
        $this->user_id = $this->session->userdata('authorized');
        error_reporting(0);
        ini_set('display_errors', 0);
    }
    /*******************************************************************************************
									USUARIO
     *******************************************************************************************/
    public function Listado($json = false)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $nombre = "CONCAT(nombre_usua,', ',apellido_usua)";
        $habilitado = '<span class="badge bg-success">HABILITADO</span>';
        $bloqueado = '<span class="badge bg-danger">BLOQUEADO</span>';
        $estado = "IF(habilitado_usua = '0','" . $bloqueado . "','" . $habilitado . "')";
        $tipo = "UPPER(denominacion_tipousuario)";
        $columns = array(
            array('db' => 'id_usua',            'dt' => 'ID',       "field" => "id_usua"),
            array('db' => $nombre,              'dt' => 'NOMBRES',  "field" => $nombre),
            array('db' => 'user_usua',          'dt' => 'NOMBRE DE USUARIO',    "field" => "user_usua"),
            array('db' => 'movil_usua',         'dt' => 'TELEFONO', "field" => "movil_usua"),
            array('db' => 'email_usua',         'dt' => 'EMAIL',    "field" => "email_usua"),
            array('db' => $tipo,              'dt' => 'TIPO',   "field" => $tipo),
            array('db' => $estado,              'dt' => 'ESTADO',   "field" => $estado),
            array('db' => 'id_usua',            'dt' => 'DT_RowId', "field" => "id_usua")
        );

        if ($json) {
            $json = isset($_GET['json']) ? $_GET['json'] : false;

            $table = 'usuario';
            $primaryKey = 'id_usua';

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );

            $condiciones = array();
            $joinQuery = "FROM usuario JOIN tipousuario ON usuario.tipo_usua = tipousuario.id_tipousuario";
            $where = "";

            // if (!empty($_POST['lider'])) { $condiciones[] = "usuario_id_usua = ".$_POST['lider']; }
            // $condiciones[] = $_POST['lider'] == '' ?  'usuario_id_usua IS NULL' : "usuario_id_usua = " . $_POST['lider'];

            if (!empty($_POST['tipo'])) {
                $condiciones[] = "tipo_usua = " . $_POST['tipo'];
            }

            $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
            echo json_encode(
                $this->ssp->simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where)
            );
            exit(0);
        }

        $datos['columns'] = $columns;
        $datos['titulo'] = "Usuarios";

        $datos["tipos"] = $this->general->getOptions('tipousuario', array("id_tipousuario", "denominacion_tipousuario"), 'Seleccione');



        $this->cssjs->add_js(base_url() . "assets/js/usuario/listado.js", false, false);
        $this->load->view('header');
        $this->load->view($this->router->fetch_class() . "/listado", $datos);
        $this->load->view('footer');
    }



    public function crear($id_usua = "")
    {
        if (empty($id_usua)) {
            $usua = new stdClass();
            $usua->id_usua = "";
            $usua->user_usua = "";
            $usua->nombre_usua = "";
            $usua->apellido_usua = "";
            $usua->email_usua = "";
            $usua->movil_usua = "";
            $usua->habilitado_usua = "1";
            $usua->tipo_usua = "";
            $usua->dni_usua = "";
        } else {
            $usua = $this->db->where("id_usua", $id_usua)->get("usuario")->row();
        }
        $data["usua"] = $usua;
        $data["estado"] = array("1" => "HABILITADO", "0" => "BLOQUEADO");
        $data["tipo"] = $this->general->getOptions('tipousuario', array("id_tipousuario", "denominacion_tipousuario"), '* Tipo usuario');
        $this->load->view($this->router->fetch_class() . "/usua_form", $data);
    }
    function validar()
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_rules('nombres', 'Nombres', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('dni', 'DNI', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('movil', 'Teléfono', 'required');
        $this->form_validation->set_rules('user', 'Usuario', 'required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
        if ($this->input->post("change_pass"))
            $this->form_validation->set_rules('pass', 'Contraseña', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }
    }
    function guardar($id_usua = "")
    {
        $this->validar();

        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $dni_usua = $this->input->post("dni");
        $email = $this->input->post("email");
        $movil = $this->input->post("movil");
        $user = $this->input->post("user");
        $pass = md5($this->input->post("pass"));
        $tipo = $this->input->post("tipo");
        $habilitado = $this->input->post("habilitado");


        $usuario = array(
            "nombre_usua"         => $nombres,
            "apellido_usua"    => $apellidos,
            "dni_usua"         => $dni_usua,
            "user_usua"         => $user,
            "password_usua"     => $pass,
            "email_usua"        => $email,
            "movil_usua"        => $movil,
            "habilitado_usua"   => $habilitado,
            "tipo_usua"         => $tipo,

        );
        if (!empty($id_usua)) {
            $condicion = array("id_usua" => $id_usua);
            if (!$this->input->post("change_pass"))
                unset($usuario['password_usua']);
            if ($this->general->update_data("usuario", $usuario, $condicion)) {
                $json["exito"] = true;
                $json["mensaje"] = "Usuario actualizado con exito";
            } else {
                $json["exito"] = false;
                $json["mensaje"] = "No se guardaron cambios";
            }
        } else {
            $consulta = $this->db->query("SELECT * FROM usuario WHERE user_usua = '{$user}'")->result();
            if (COUNT($consulta) > 0) {
                $json["exito"] = false;
                $json["mensaje"] = "El nombre de usuario ya existe";
            } else {
                if ($this->general->save_data("usuario", $usuario) != false) {
                    $json["exito"] = true;
                    $json["mensaje"] = "Usuario agregado con exito";
                } else {
                    $json["exito"] = false;
                    $json["mensaje"] = "Error 2 al guardar usuario";
                }
            }
        }
        echo json_encode($json);
    }
    public function eliminar($id_usua = "")
    {
        $this->db->trans_start();
        $this->general->delete_data("usuario", array("id_usua" => $id_usua));
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $json["exito"] = false;
            $json["mensaje"] = "Error al tratar de eliminar el lector";
        } else {
            $json["exito"] = true;
            $json["mensaje"] = "Eliminado con exito";
        }
        echo json_encode($json);
    }
    public function buscar_asesor()
    {
        $responese = new StdClass;
        $lider = isset($_GET['lider']) ? $_GET["lider"] : '';
        $datos = array();
        // $where = $lider != "" ? "usuario_id_usua is null" : null;
        //$where = "usuario_id_usua is null or id_usua !=".$lider;
        $where = 'usuario_id_usua IS NULL AND tipo_usua = 1';
        $like =
            [
                'nombre_usua' => $_GET['term'],
                'apellido_usua' => $_GET['term'],
                'dni_usua' => $_GET['term'],
            ];
        $asesores = $this->general->select2("usuario", $like, ['id_usua' => 'desc'], $where);
        // $asesores = $this->general->select2withJoin("usuario", $like, 'personas', 'alum_pers_id = pers_id');

        foreach ($asesores["items"] as $value) {
            $datos[] = array(
                "id" => $value->id_usua,
                "text" => $value->nombre_usua . ' ' . $value->apellido_usua
            );
        }
        $responese->total_count = $asesores["total_count"];
        $responese->incomplete_results = false;
        $responese->items = $datos;
        echo json_encode($responese);
    }



    public function s2getByTipo($tipo)
    {
        $responese = new StdClass;
        $term = $_GET['term'];
        $datos = array();
        $like =
            [
                'nombre_usua' => $term,
                'apellido_usua' => $term,
                'dni_usua' => $term,
            ];
        $where = ['tipo_usua' => $tipo];
        $results = $this->general->select2("usuario", $like, null, $where);

        foreach ($results["items"] as $value) {
            $datos[] = array(
                "id" => $value->id_usua,
                "text" => $value->nombre_usua . ' ' . $value->apellido_usua . ' (' . $value->dni_usua . ')'
            );
        }
        $responese->total_count = $results["total_count"];
        $responese->incomplete_results = false;
        $responese->items = $datos;
        echo json_encode($responese);
    }

    function getById($id)
    {
        $this->load->helper('Response');
        showJSON($this->db->where("id_usua", $id)->get("usuario")->row());
    }
}
