<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configuracion extends CI_Controller
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
        $this->load->library('Ssp');
        $this->jsPath = base_url() . "assets/js/";
        $this->load->model('Model_general', 'general');
        $this->load->model('ConfiguracionModel', 'configuracionmodel');
        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->user_id = $this->session->userdata('authorized');
    }



    /**  TIPO DE PRODUCTO */
    public function usuario($json = false)
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
            array('db' => 'id_usua', 'dt' => 'ID',       "field" => "id_usua"),
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


        $this->cssjs->add_js($this->jsPath . "configuracion/usuario.js", false, false);
        //$this->cssjs->add_js(base_url() . "assets/js/usuario/listado.js", false, false);
        $this->load->view('header');
        $this->load->view($this->router->fetch_class() . "/usuario", $datos);
        $this->load->view('footer');
    }

    public function usuario_crear($id_usua = "")
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
        $this->load->view($this->router->fetch_class() . "/form_usuario", $data);
    }
    function usuario_validar()
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
    function usuario_guardar($id_usua = "")
    {
        $this->usuario_validar();

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
    public function usuario_eliminar($id_usua = "")
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

    /**  FIN USUARIO */


    /** SLIDER */
    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->configuracionmodel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $slider) {
            $no++;
            $row = array();
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $slider->id_slider . "'" . ')"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $slider->id_slider . "'" . ')"><i class="fa fa-trash"></i></a>';

            $estado = $slider->estado_slider;

            if ($estado == '1') {
                $estado = '<span class="badge bg-success">Activado</span>';
            } elseif ($estado == '2') {
                $estado = '<span class="badge bg-danger">Desactivado</span>';
            }

            $row[] = $slider->id_slider;
            $row[] = $slider->descripcion_slider;
            $row[] = $slider->link_slider;
            $row[] = $estado;
            if ($slider->imagen_slider)
                $row[] = '<a href="' . base_url('assets/img/upload/' . $slider->imagen_slider) . '" target="_blank"><img src="' . base_url('assets/img/upload/' . $slider->imagen_slider) . '" class="img-responsive imagentabla" /></a>';
            else
                $row[] = '(No photo)';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->configuracionmodel->count_all(),
            "recordsFiltered" => $this->configuracionmodel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->configuracionmodel->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'descripcion_slider' => $this->input->post('descripcion'),
            'estado_slider' => $this->input->post('estado'),
            'link_slider' => $this->input->post('link')
        );

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();
            $data['imagen_slider'] = $upload;
        }

        $this->configuracionmodel->save($data);

        echo json_encode(array("status" => TRUE, "mensaje" => 'Slider Registrado'));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'descripcion_slider' => $this->input->post('descripcion'),
            'estado_slider' => $this->input->post('estado'),
            'link_slider' => $this->input->post('link')
        );

        if ($this->input->post('remove_photo')) // if remove photo checked
        {
            if (file_exists('assets/img/upload/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/img/upload/' . $this->input->post('remove_photo'));
            $data['imagen_slider'] = '';
        }

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $slider = $this->configuracionmodel->get_by_id($this->input->post('id'));
            if (file_exists('assets/img/upload/' . $slider->imagen_slider) && $slider->imagen_slider)
                unlink('assets/img/upload/' . $slider->imagen_slider);

            $data['imagen_slider'] = $upload;
        }

        $this->configuracionmodel->update(array('id_slider' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE, "mensaje" => 'slider actualizada'));
    }

    public function ajax_delete($id)
    {
        //delete file
        $slider = $this->configuracionmodel->get_by_id($id);
        if (file_exists('assets/img/upload/' . $slider->imagen_slider) && $slider->imagen_slider)
            unlink('assets/img/upload/' . $slider->imagen_slider);

        $this->configuracionmodel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/upload/';
        $config['allowed_types']        = 'gif|jpg|png|PNG|JPG|jpge';
        $config['max_size']             = 0; //set max size allowed in Kilobyte
        $config['max_width']            = 0; // set max width image allowed
        $config['max_height']           = 0; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_message('greater_than', '%s debe de ser número mayor a 0');

        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }
    }

    public function slider()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;


        $slider = new stdClass();
        $slider->id_slider = "";
        $slider->descripcion_slider = "";
        $slider->descripcion_slider = "";
        $slider->link_slider = "";
        $slider->duracion_slider  = "";
        $slider->terapeuta_slider = "";
        $slider->costo_slider = "";
        $slider->imagen_slider = "";

        $data["slider"] = $slider;


        $this->cssjs->add_js($this->jsPath . "configuracion/sliders.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/slider", $data);
        $this->load->view('footer');
    }
    /** FIN DE SLIDERS */
}
