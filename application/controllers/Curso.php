<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Curso extends CI_Controller
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
        $this->load->model('CursoModel', 'cursomodel');
        $this->load->model('WebModel', 'web');
        $this->load->model('UsuarioModel', 'usuario_model');
        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->load->helper('Response');
        $this->user_id = $this->session->userdata('authorized');
    }

    public function preinscripcion($json = false)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $nombres = "CONCAT(nombres_cliente,' ',apellidos_cliente)";
        $habilitado = '<span class="badge bg-success">Confirmado</span>';
        $bloqueado = '<span class="badge bg-danger">No Confirmado</span>';
        $estado = "IF(estado_inscripcion = '2','" . $bloqueado . "','" . $habilitado . "')";

        $columns = array(

            array('db' => 'id_inscripcion', 'dt' => 'ID', "field" => "id_inscripcion"),
            array('db' => $nombres, 'dt' => 'CLIENTE', "field" => $nombres),
            array('db' => 'nombre_curso', 'dt' => 'CURSO', "field" => 'nombre_curso'),
            array('db' => 'telefono_cliente', 'dt' => 'Telefono', "field" => 'telefono_cliente'),
            array('db' => $estado, 'dt' => 'ESTADO', "field" => $estado),
            array('db' => 'DATE_FORMAT(fecha_inscripcion, "%d/%m/%Y - %r")', 'dt' => 'FECHA', "field" => 'DATE_FORMAT(fecha_inscripcion, "%d/%m/%Y - %r")'),
            array('db' => 'observacion_inscripcion', 'dt' => 'OBSERVACION', "field" => 'observacion_inscripcion'),
            array('db' => 'id_inscripcion', 'dt' => 'DT_RowId', 'field' => 'id_inscripcion'),
            //array('db' => 'DATE_FORMAT(fecha_flujo, "%d/%m/%Y")', 'dt' => 'FECHA'),
        );

        if ($json) {

            $json = isset($_GET['json']) ? $_GET['json'] : false;

            $table = 'inscripcion';
            $primaryKey = 'id_inscripcion';

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );

            $condiciones = array();
            $joinQuery = "FROM inscripcion 
            JOIN cliente ON inscripcion.cliente_inscripcion = cliente.id_cliente 
            JOIN curso ON inscripcion.curso_inscripcion = curso.id_curso";
            $where = "";
            if (!empty($_POST['rango'])) {
                $fechas = explode('-', $_POST['rango']);
                $condiciones[] = "DATE(fecha_inscripcion) >='" . cambiaf_a_mysql($fechas[0]) . "' AND DATE(fecha_inscripcion) <= '" . cambiaf_a_mysql($fechas[1]) . "'";
            }
            $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
            echo json_encode(
                $this->ssp->simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where)
            );
            exit(0);
        }

        $datos['columns'] = $columns;
        $datos['titulo'] = "Lista de Preinscripcion";

        $this->cssjs->add_js($this->jsPath . "curso/preinscripcion.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/preinscripcion", $datos);
        $this->load->view('footer');
    }
    public function preinscripcion_crear($id = "")
    {
        if (empty($id)) {

            $inscripcion = new stdClass();
            $inscripcion->id_inscripcion = "";
            $inscripcion->observacion_inscripcion = "";
            $inscripcion->fecha_inscripcion = "";
            $inscripcion->estado_inscripcion = "";
            $inscripcion->cliente_inscripcion = "";
            $inscripcion->curso_inscripcion = "";
        } else {
            $inscripcion = $this->db->where("id_inscripcion", $id)->get("inscripcion")->row();
        }

        $data["cliente"] = $this->web->get_cliente($inscripcion->cliente_inscripcion);
        $data["inscripcion"] = $inscripcion;
        $data["curso"] = $this->general->getOptions('curso', array("id_curso", "nombre_curso"), '* Seleccionar el Curso');
        //$data["cliente"] = $this->general->getOptions('cliente', array("id_cliente", "nombres_cliente"), '* Seleccionar Cliente');


        $this->load->view($this->controller . "/form_preinscripcion", $data);
    }

    public function preinscripcion_guardar($id = "")
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_message('greater_than', '%s debe de ser número mayor a 0');

        $this->form_validation->set_rules('estado', 'estado', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }


        $estado = $this->input->post("estado");
        $curso = $this->input->post("curso");
        $observacion = $this->input->post("observacion");

        $inscripcion = array(
            "observacion_inscripcion"     => $observacion,
            "estado_inscripcion"     => $estado,
            "curso_inscripcion"        => $curso
        );

        if (!empty($id)) {
            $condicion = array("id_inscripcion" => $id);

            if ($this->general->update_data("inscripcion", $inscripcion, $condicion)) {
                $json["exito"] = true;
                $json["mensaje"] = "Inscripcion Actualizada";
            } else {
                $json["exito"] = false;
                $json["mensaje"] = "No se guardaron cambios";
            }
        } else {

            if ($this->general->save_data("inscripcion", $inscripcion) != false) {
                $json["exito"] = true;
                $json["mensaje"] = "Gastos registrados con exito";
            } else {
                $json["exito"] = false;
                $json["mensaje"] = "Error ak al guardar Gastos";
            }
        }
        echo json_encode($json);
    }

    public function preinscripcion_eliminar($id)
    {

        $this->db->trans_start();
        $this->general->delete_data("inscripcion", array("id_inscripcion" => $id));
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


    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->cursomodel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $curso) {
            $no++;
            $row = array();
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $curso->id_curso . "'" . ')"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $curso->id_curso . "'" . ')"><i class="fa fa-trash"></i></a>';

            $descripcion = $curso->descripcion_curso;
            if (strlen($descripcion) > 120) {
                $descripcion = substr($descripcion, 0, 20);
            }
            $modalidad = $curso->modalidad_curso;
            $inicio = $curso->inicio_curso;

            if ($inicio == '1') {
                $inicio = '<span class="badge bg-success"><i class="far fa-eye"></i></span>';
            } elseif ($inicio == '2') {
                $inicio = '<span class="badge bg-danger"><i class="far fa-eye-slash"></i></span>';
            }

            if ($modalidad == '1') {
                $modalidad = 'Presencial';
            } elseif ($modalidad == '2') {
                $modalidad = 'Online';
            } elseif ($modalidad == '3') {
                $modalidad = 'Semipresencial';
            }

            //$row[] = $curso->id_curso;
            $row[] = $curso->nombre_curso;
            $row[] = $descripcion . "...";
            $row[] = $curso->duracion_curso;
            $row[] = $modalidad;
            $row[] = $curso->horario_curso;
            $row[] = $curso->docente_curso;
            $row[] = "S/. " . $curso->costo_curso;
            $row[] = $inicio;
            if ($curso->imagen_curso)
                $row[] = '<a href="' . base_url('assets/img/upload/' . $curso->imagen_curso) . '" target="_blank"><img src="' . base_url('assets/img/upload/' . $curso->imagen_curso) . '" class="img-responsive imagentabla" /></a>';
            else
                $row[] = '(No photo)';

            if ($curso->guia_rapida_curso)
                $row[] = '<a href="' . base_url('assets/guias/upload/' . $curso->guia_rapida_curso) . '" target="_blank" class="text-danger h3 mb-0"> <i class="fas fa-file-pdf"></i></a>';
            else
                $row[] = '(Sin Guía)';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->cursomodel->count_all(),
            "recordsFiltered" => $this->cursomodel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->cursomodel->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'nombre_curso' => $this->input->post('nombre'),
            'descripcion_curso' => $this->input->post('descripcion'),
            'duracion_curso' => $this->input->post('duracion'),
            'modalidad_curso' => $this->input->post('modalidad'),
            'horario_curso' => $this->input->post('horario'),
            'docente_curso' => $this->input->post('docente'),
            'costo_curso' => $this->input->post('costo'),
            'inicio_curso' => $this->input->post('inicio'),
        );

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();
            $data['imagen_curso'] = $upload;
        }

        if (!empty($_FILES['guia']['name'])) {
            $upload_guia = $this->_do_upload_pdf();
            $data['guia_rapida_curso'] = $upload_guia;
        }

        $this->cursomodel->save($data);

        echo json_encode(array("status" => TRUE, "mensaje" => $_FILES));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nombre_curso' => $this->input->post('nombre'),
            'descripcion_curso' => $this->input->post('descripcion'),
            'duracion_curso' => $this->input->post('duracion'),
            'modalidad_curso' => $this->input->post('modalidad'),
            'horario_curso' => $this->input->post('horario'),
            'docente_curso' => $this->input->post('docente'),
            'costo_curso' => $this->input->post('costo'),
            'inicio_curso' => $this->input->post('inicio'),
        );

        if ($this->input->post('remove_photo')) // if remove photo checked
        {
            if (file_exists('assets/img/upload/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/img/upload/' . $this->input->post('remove_photo'));
            $data['imagen_curso'] = '';
        }

        if ($this->input->post('remove_guia')) // if remove photo checked
        {
            if (file_exists('assets/guias/upload/' . $this->input->post('remove_guia')) && $this->input->post('remove_guia'))
                unlink('assets/guias/upload/' . $this->input->post('remove_guia'));
            $data['guia_rapida_curso'] = '';
        }

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();
            //delete file
            $curso = $this->cursomodel->get_by_id($this->input->post('id'));
            if (file_exists('assets/img/upload/' . $curso->imagen_curso) && $curso->imagen_curso)
                unlink('assets/img/upload/' . $curso->imagen_curso);

            $data['imagen_curso'] = $upload;
        }

        if (!empty($_FILES['guia']['name'])) {
            $upload_guia = $this->_do_upload_pdf();
            //delete file
            $curso = $this->cursomodel->get_by_id($this->input->post('id'));
            if (file_exists('assets/guias/upload/' . $curso->guia_rapida_curso) && $curso->guia_rapida_curso)
                unlink('assets/guias/upload/' . $curso->guia_rapida_curso);

            $data['guia_rapida_curso'] = $upload_guia;
        }

        $this->cursomodel->update(array('id_curso' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE, "mensaje" => 'curso actualizada'));
    }

    public function ajax_delete($id)
    {
        //delete file
        $curso = $this->cursomodel->get_by_id($id);
        if (file_exists('assets/img/upload/' . $curso->imagen_curso) && $curso->imagen_curso)
            unlink('assets/img/upload/' . $curso->imagen_curso);

        $this->cursomodel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/upload/';
        $config['allowed_types']        = 'gif|jpg|png|PNG|JPG|jpge|JFIF|jfif';
        $config['max_size']             = 0; //set max size allowed in Kilobyte
        $config['max_width']            = 0; // set max width image allowed
        $config['max_height']           = 0; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config, 'photoupload'); // Create custom object for cover upload
        $this->photoupload->initialize($config);
        $photo_cover = $this->photoupload->do_upload('photo');

        if (!$photo_cover) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: ' . $this->photoupload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->photoupload->data('file_name');
    }


    private function _do_upload_pdf()
    {
        $config = [];
        $config['upload_path']          = 'assets/guias/upload/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 0; //set max size allowed in Kilobyte
        $config['max_width']            = 0; // set max width image allowed
        $config['max_height']           = 0; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config, 'guiaupload'); // Create custom object for cover upload
        $this->guiaupload->initialize($config);
        $guia_cover = $this->guiaupload->do_upload('guia');

        if (!$guia_cover) //upload and validate
        {
            $data['inputerror'][] = 'guia';
            $data['error_string'][] = 'Upload error: ' . $this->guiaupload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->guiaupload->data('file_name');
    }

    private function _validate()
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_message('greater_than', '%s debe de ser número mayor a 0');

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
        $this->form_validation->set_rules('duracion', 'Duracion', 'required');
        $this->form_validation->set_rules('modalidad', 'Modalidad', 'required');
        $this->form_validation->set_rules('horario', 'Horario', 'required');
        $this->form_validation->set_rules('docente', 'Docente', 'required');
        $this->form_validation->set_rules('costo', 'Costo', 'required');
        $this->form_validation->set_rules('inicio', 'Inicio', 'required');

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


        $curso = new stdClass();
        $curso->id_curso = "";
        $curso->nombre_curso = "";
        $curso->descripcion_curso = "";
        $curso->duracion_curso = "";
        $curso->duracion_curso  = "";
        $curso->terapeuta_curso = "";
        $curso->costo_curso = "";
        $curso->imagen_curso = "";

        $data["curso"] = $curso;


        $this->cssjs->add_js($this->jsPath . "curso/cursos.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/curso", $data);
        $this->load->view('footer');
    }
}
