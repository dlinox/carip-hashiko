<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Terapia extends CI_Controller
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
        $this->load->model('HotelModel', 'model');
        $this->load->model('TerapiaModel', 'terapiamodel');
        $this->load->model('UsuarioModel', 'usuario_model');
        $this->load->model('WebModel', 'web');
        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->load->helper('Response');
        $this->user_id = $this->session->userdata('authorized');
        //$this->user_tipo_id = $this->session->userdata('tipo_usua');
    }


    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->terapiamodel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $terapia) {
            $no++;
            $row = array();
            //add html for action
            $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $terapia->id_terapia . "'" . ')"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $terapia->id_terapia . "'" . ')"><i class="fa fa-trash"></i></a>';

            $descripcion = $terapia->descripcion_terapia;
            if (strlen($descripcion) > 120) {
                $descripcion = substr($descripcion, 0, 30);
            }

            //$row[] = $terapia->id_terapia;
            $row[] = $terapia->nombre_terapia;
            $row[] = $descripcion . "...";
            $row[] = $terapia->beneficio_terapia;
            $row[] = $terapia->duracion_terapia;
            $row[] = $terapia->terapeuta_terapia;
            $row[] = "S/. " . $terapia->costo_terapia;
            if ($terapia->imagen_terapia)
                $row[] = '<a href="' . base_url('assets/img/upload/' . $terapia->imagen_terapia) . '" target="_blank"><img src="' . base_url('assets/img/upload/' . $terapia->imagen_terapia) . '" class="img-responsive imagentabla" /></a>';
            else
                $row[] = '(No photo)';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->terapiamodel->count_all(),
            "recordsFiltered" => $this->terapiamodel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->terapiamodel->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'nombre_terapia' => $this->input->post('nombre'),
            'descripcion_terapia' => $this->input->post('descripcion'),
            'beneficio_terapia' => $this->input->post('beneficio'),
            'duracion_terapia' => $this->input->post('duracion'),
            'terapeuta_terapia' => $this->input->post('terapeuta'),
            'costo_terapia' => $this->input->post('costo'),
        );

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();
            $data['imagen_terapia'] = $upload;
        }

        $this->terapiamodel->save($data);

        echo json_encode(array("status" => TRUE, "mensaje" => 'terapia Registrado'));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nombre_terapia' => $this->input->post('nombre'),
            'descripcion_terapia' => $this->input->post('descripcion'),
            'beneficio_terapia' => $this->input->post('beneficio'),
            'duracion_terapia' => $this->input->post('duracion'),
            'terapeuta_terapia' => $this->input->post('terapeuta'),
            'costo_terapia' => $this->input->post('costo'),
        );

        if ($this->input->post('remove_photo')) // if remove photo checked
        {
            if (file_exists('assets/img/upload/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/img/upload/' . $this->input->post('remove_photo'));
            $data['imagen_terapia'] = '';
        }

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $terapia = $this->terapiamodel->get_by_id($this->input->post('id'));
            if (file_exists('assets/img/upload/' . $terapia->imagen_terapia) && $terapia->imagen_terapia)
                unlink('assets/img/upload/' . $terapia->imagen_terapia);

            $data['imagen_terapia'] = $upload;
        }

        $this->terapiamodel->update(array('id_terapia' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE, "mensaje" => 'Terapia actualizada'));
    }

    public function ajax_delete($id)
    {
        //delete file
        $terapia = $this->terapiamodel->get_by_id($id);
        if (file_exists('assets/img/upload/' . $terapia->imagen_terapia) && $terapia->imagen_terapia)
            unlink('assets/img/upload/' . $terapia->imagen_terapia);

        $this->terapiamodel->delete_by_id($id);
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

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('beneficio', 'Beneficio', 'required');
        $this->form_validation->set_rules('duracion', 'Duracion', 'required');
        $this->form_validation->set_rules('costo', 'Costo', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }
    }

    public function lista()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;


        $terapia = new stdClass();
        $terapia->id_terapia = "";
        $terapia->nombre_terapia = "";
        $terapia->descripcion_terapia = "";
        $terapia->beneficio_terapia = "";
        $terapia->duracion_terapia  = "";
        $terapia->terapeuta_terapia = "";
        $terapia->costo_terapia = "";
        $terapia->imagen_terapia = "";

        $data["terapia"] = $terapia;


        $this->cssjs->add_js($this->jsPath . "terapia/terapias.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/terapia", $data);
        $this->load->view('footer');
    }
    public function reserva()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $nombres = "CONCAT(nombres_cliente,' ',apellidos_cliente)";
        $habilitado = '<span class="badge bg-success">Confirmado</span>';
        $bloqueado = '<span class="badge bg-danger">No Confirmado</span>';
        $estado = "IF(estado_reserva = '2','" . $bloqueado . "','" . $habilitado . "')";
        $fecha = 'DATE_FORMAT(fecha_reserva, "%d/%m/%Y - %h:%i %p")';
        $atencion = 'CONCAT(DATE_FORMAT(dia_reserva,"%d/%m/%Y"), " - ", DATE_FORMAT(hora_reserva, "%h:%i %p"))';

        $columns = array(
            array('db' => 'id_reserva', 'dt' => 'DT_RowId', 'field' => 'id_reserva'),
            array('db' => 'dni_cliente', 'dt' => 'CODIGO', 'field' => 'dni_cliente'),
            array('db' => $nombres, 'dt' => 'CLIENTE', 'field' => $nombres),
            array('db' => 'nombre_terapia', 'dt' => 'TERAPIA', 'field' => 'nombre_terapia'),
            array('db' => 'telefono_cliente', 'dt' => 'Telefono', 'field' => 'telefono_cliente'),
            array('db' => $estado, 'dt' => 'ESTADO', 'field' => $estado),
            array('db' => $fecha, 'dt' => 'FECHA REGISTRO', 'field' => $fecha),
            array('db' => $atencion, 'dt' => 'FECHA DE ATENCION', 'field' => $atencion),
            array('db' => 'id_reserva', 'dt' => 'DT_RowId', "field" => "id_reserva")
        );
        foreach ($columns as &$item) {
            $item['field'] = $item['db'];
        }

        if ($json) {
            $json = isset($_GET['json']) ? $_GET['json'] : false;

            $table = 'reserva';
            $primaryKey = 'id_reserva';

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );

            $condiciones = array();
            $joinQuery = "FROM
            reserva
            JOIN cliente ON cliente.id_cliente = reserva.cliente_reserva 
            JOIN terapia ON terapia.id_terapia = reserva.terapia_reserva";
            $where = "";

            // if (!empty($_POST['lider'])) { $condiciones[] = "usuario_id_usua = ".$_POST['lider']; }
            // $condiciones[] = $_POST['lider'] == '' ?  'usuario_id_usua IS NULL' : "usuario_id_usua = " . $_POST['lider'];

            if (!empty($_POST['tipo'])) {
                $condiciones[] = "id_terapia = " . $_POST['tipo'];
            }
            $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
            echo json_encode(
                $this->ssp->simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where)
            );
            exit(0);
        }

        $datos['columns'] = $columns;
        $datos['titulo'] = "Reservas";

        $datos["tipos"] = $this->general->getOptions('terapia', array("id_terapia", "nombre_terapia"), 'Seleccione Terapia');

        $this->cssjs->add_js($this->jsPath . "terapia/reserva.js", false, false);
        $this->load->view('header');
        $this->load->view($this->router->fetch_class() . "/reserva", $datos);
        $this->load->view('footer');
    }
    public function reserva_crear($id = "")
    {
        $reserva = $this->db->where("id_reserva", $id)->get("reserva")->row();

        $data["cliente"] = $this->web->get_cliente($reserva->cliente_reserva);
        $data["reserva"] = $reserva;
        $data["terapia"] = $this->general->getOptions('terapia', array("id_terapia", "nombre_terapia"), '* Selecciona una terapia');
        //$data["cliente"] = $this->general->getOptions('cliente', array("id_cliente", "nombres_cliente"), '* Seleccionar Cliente');

        $this->load->view($this->controller . "/form_reserva", $data);
    }

    public function reserva_guardar($id = "")
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_message('greater_than', '%s debe de ser número mayor a 0');

        $this->form_validation->set_rules('estado', 'Estado', 'required');
        $this->form_validation->set_rules('dia', 'Dia de Atencion');
        $this->form_validation->set_rules('hora', 'Hora de Atencion');
        $this->form_validation->set_rules('terapia', 'Terapia');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }


        $estado = $this->input->post("estado");
        $terapia = $this->input->post("terapia");
        $dia = $this->input->post("dia");
        $hora = $this->input->post("hora");

        $reserva = array(
            "dia_reserva"     => $dia,
            "hora_reserva"     => $hora,
            "estado_reserva"     => $estado,
            "terapia_reserva"        => $terapia
        );

        if (!empty($id)) {
            $condicion = array("id_reserva" => $id);

            if ($this->general->update_data("reserva", $reserva, $condicion)) {
                $json["exito"] = true;
                $json["mensaje"] = "Reserva Actualizada";
            } else {
                $json["exito"] = false;
                $json["mensaje"] = "No se guardaron cambios";
            }
        } else {

            if ($this->general->save_data("reserva", $reserva) != false) {
                $json["exito"] = true;
                $json["mensaje"] = "Reserva Registrada con exito";
            } else {
                $json["exito"] = false;
                $json["mensaje"] = "Error al al guardar Gastos";
            }
        }
        echo json_encode($json);
    }
    public function reserva_eliminar($id)
    {

        $this->db->trans_start();
        $this->general->delete_data("reserva", array("id_reserva" => $id));
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
}
