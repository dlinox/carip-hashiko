<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Producto extends CI_Controller
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
        $this->cssPath = base_url() . "assets/css/";
        $this->load->model('Model_general', 'general');
        $this->load->model('PuntodeventaModel', 'pventamodel');
        $this->load->model('ProductoModel', 'producto');
        $this->load->model('WebModel', 'web');
        $this->load->model('UsuarioModel', 'usuario_model');
        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->load->helper('Response');
        $this->user_id = $this->session->userdata('authorized');
        $this->user_tipo_id = $this->session->userdata('tipo_usua');
    }


    public function ajax_list()
    {
        $this->load->helper('url');

        $list = $this->pventamodel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $producto) {
            $no++;
            $row = array();
            //add html for action
            $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $producto->id_producto . "'" . ')"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $producto->id_producto . "'" . ')"><i class="fa fa-trash"></i></a>';

            if ($producto->presentacion2_producto === '') {
                $presentacion = $producto->presentacion_producto;
            } else {
                $presentacion = $producto->presentacion_producto . " | " . $producto->presentacion2_producto;
            }

            if ($producto->precio2_producto === '' or $producto->precio2_producto == '0.00') {
                $precio = "S/." . $producto->precio_producto;
            } else {
                $precio = "S/." . $producto->precio_producto . " | S/." . $producto->precio2_producto;
            }

            $inicio = $producto->inicio_producto;

            if ($inicio == '1') {
                $inicio = '<span class="badge bg-success"><i class="far fa-eye"></i></span>';
            } elseif ($inicio == '2') {
                $inicio = '<span class="badge bg-danger"><i class="far fa-eye-slash"></i></span>';
            }

            $descripcion = $producto->descripcion_producto;
            if (strlen($descripcion) > 120) {
                $descripcion = substr($descripcion, 0, 20);
            }

            //$row[] = $producto->id_producto;
            $row[] = $producto->nombre_producto;
            $row[] = $descripcion . "...";
            $row[] = $producto->beneficio_producto;
            $row[] =  $presentacion;
            $row[] =  $precio;
            $row[] = $inicio;

            if ($producto->imagen_producto) {
                if ($producto->imagen2_producto) {
                    $row[] =  '<a href="' . base_url('assets/img/upload/' . $producto->imagen_producto) . '" target="_blank"><img src="' . base_url('assets/img/upload/' . $producto->imagen_producto) . '" class="img-responsive imagentabla" /></a>' . "" . '<a href="' . base_url('assets/img/upload/' . $producto->imagen2_producto) . '" target="_blank"><img src="' . base_url('assets/img/upload/' . $producto->imagen2_producto) . '" class="img-responsive imagentabla" /></a>';
                } else {
                    $row[] =  '<a href="' . base_url('assets/img/upload/' . $producto->imagen_producto) . '" target="_blank"><img src="' . base_url('assets/img/upload/' . $producto->imagen_producto) . '" class="img-responsive imagentabla" /></a>';
                }
            } else {
                if ($producto->imagen2_producto) {
                    $row[] =  "No Imagen 1" . '<a href="' . base_url('assets/img/upload/' . $producto->imagen_producto) . '" target="_blank"><img src="' . base_url('assets/img/upload/' . $producto->imagen_producto) . '" class="img-responsive imagentabla" /></a>';
                } else {
                    $row[] =  'No hay imagenes  ';
                }
            }



            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pventamodel->count_all(),
            "recordsFiltered" => $this->pventamodel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->pventamodel->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'nombre_producto' => $this->input->post('nombre'),
            'descripcion_producto' => $this->input->post('descripcion'),
            'beneficio_producto' => $this->input->post('beneficio'),
            'inicio_producto' => $this->input->post('inicio'),
            'presentacion_producto' => $this->input->post('presentacion'),
            'presentacion2_producto' => $this->input->post('presentacion2'),
            'precio_producto' => $this->input->post('precio'),
            'precio2_producto' => $this->input->post('precio2'),
        );

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();
            $data['imagen_producto'] = $upload;
        }

        if (!empty($_FILES['photo2']['name'])) {
            $upload = $this->_do_upload2();
            $data['imagen2_producto'] = $upload;
        }

        $this->pventamodel->save($data);

        echo json_encode(array("status" => TRUE, "mensaje" => 'Producto Registrado'));
    }

    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'nombre_producto' => $this->input->post('nombre'),
            'descripcion_producto' => $this->input->post('descripcion'),
            'beneficio_producto' => $this->input->post('beneficio'),
            'inicio_producto' => $this->input->post('inicio'),
            'presentacion_producto' => $this->input->post('presentacion'),
            'presentacion2_producto' => $this->input->post('presentacion2'),
            'precio_producto' => $this->input->post('precio'),
            'precio2_producto' => $this->input->post('precio2')
        );

        if ($this->input->post('remove_photo')) // if remove photo checked
        {
            if (file_exists('assets/img/upload/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('assets/img/upload/' . $this->input->post('remove_photo'));
            $data['imagen_producto'] = '';
        }

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $producto = $this->pventamodel->get_by_id($this->input->post('id'));
            if (file_exists('assets/img/upload/' . $producto->imagen_producto) && $producto->imagen_producto)
                unlink('assets/img/upload/' . $producto->imagen_producto);

            $data['imagen_producto'] = $upload;
        }

        /** Imagen 2 */
        if ($this->input->post('remove_photo2')) // if remove photo checked
        {
            if (file_exists('assets/img/upload/' . $this->input->post('remove_photo2')) && $this->input->post('remove_photo2'))
                unlink('assets/img/upload/' . $this->input->post('remove_photo2'));
            $data['imagen2_producto'] = '';
        }

        if (!empty($_FILES['photo2']['name'])) {
            $upload = $this->_do_upload2();

            //delete file
            $producto = $this->pventamodel->get_by_id($this->input->post('id'));
            if (file_exists('assets/img/upload/' . $producto->imagen2_producto) && $producto->imagen2_producto)
                unlink('assets/img/upload/' . $producto->imagen2_producto);

            $data['imagen2_producto'] = $upload;
        }

        $this->pventamodel->update(array('id_producto' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE, "mensaje" => 'Producto Actualizado'));
    }

    public function ajax_delete($id)
    {
        //delete file
        $producto = $this->pventamodel->get_by_id($id);
        if (file_exists('assets/img/upload/' . $producto->imagen_producto) && $producto->imagen_producto)
            unlink('assets/img/upload/' . $producto->imagen_producto);

        if (file_exists('assets/img/upload/' . $producto->imagen2_producto) && $producto->imagen2_producto)
            unlink('assets/img/upload/' . $producto->imagen2_producto);

        $this->pventamodel->delete_by_id($id);
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
    private function _do_upload2()
    {
        $config['upload_path']          = 'assets/img/upload/';
        $config['allowed_types']        = 'gif|jpg|png|PNG|JPG|jpge|webp';
        $config['max_size']             = 0; //set max size allowed in Kilobyte
        $config['max_width']            = 0; // set max width image allowed
        $config['max_height']           = 0; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo2')) //upload and validate
        {
            $data['inputerror'][] = 'photo2';
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
        $this->form_validation->set_rules('presentacion', 'Presentacion', 'required');
        $this->form_validation->set_rules('inicio', 'Inicio', 'required');
        $this->form_validation->set_rules('precio', 'Precio', 'required');

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


        $productos = new stdClass();
        $productos->id_producto = "";
        $productos->nombre_producto = "";
        $productos->descripcion_producto = "";
        $productos->presentacion_producto = "";
        $productos->beneficio_producto  = "";
        $productos->imagen_producto = "";
        $productos->precio_producto = "";
        $productos->imagen_prod = "";

        $data["productos"] = $productos;


        $this->cssjs->add_js($this->jsPath . "producto/productos.js", false, false);
        $this->load->view('header');
        $this->load->view($this->controller . "/productos", $data);
        $this->load->view('footer');
    }


    public function ventas($json = false)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $nombre = "CONCAT(nombres_cliente,', ',apellidos_cliente)";
        $porconfirmar = '<span class="badge bg-warning">Por Confirmar</span>';
        $confirmado = '<span class="badge bg-success">Confirmado</span>';
        $estado = "IF(status = '1','" . $porconfirmar . "','" . $confirmado . "')";

        $columns = array(
            array('db' => 'id', 'dt' => 'COD',       "field" => "id"),
            array('db' => 'dni_cliente',              'dt' => 'DNI',  "field" => 'dni_cliente'),
            array('db' => $nombre,              'dt' => 'CLIENTE',  "field" => $nombre),
            array('db' => 'telefono_cliente',              'dt' => 'TELEFONO',  "field" => 'telefono_cliente'),
            array('db' => 'correo_cliente',              'dt' => 'CORREO',  "field" => 'correo_cliente'),
            array('db' => 'grand_total',          'dt' => 'PRECIO',    "field" => "grand_total"),
            array('db' => 'DATE_FORMAT(created, "%d/%m/%Y")',         'dt' => 'FECHA', "field" => 'DATE_FORMAT(created, "%d/%m/%Y")'),
            array('db' => 'DATE_FORMAT(created, "%h:%i %p")',         'dt' => 'HORA', "field" => 'DATE_FORMAT(created, "%h:%i %p")'),
            array('db' => $estado,         'dt' => 'ESTADO',    "field" => $estado),
            array('db' => 'id',            'dt' => 'DT_RowId', "field" => "id")
        );

        if ($json) {
            $json = isset($_GET['json']) ? $_GET['json'] : false;

            $table = 'orders';
            $primaryKey = 'id';

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );

            $condiciones = array();
            $joinQuery = "FROM orders JOIN cliente ON cliente.id_cliente = orders.customer_id";
            $where = "";

            // if (!empty($_POST['lider'])) { $condiciones[] = "usuario_id_usua = ".$_POST['lider']; }
            // $condiciones[] = $_POST['lider'] == '' ?  'usuario_id_usua IS NULL' : "usuario_id_usua = " . $_POST['lider'];

            if (!empty($_POST['rango'])) {
                $fechas = explode('-', $_POST['rango']);
                $condiciones[] = "DATE(created) >='" . cambiaf_a_mysql($fechas[0]) . "' AND DATE(created) <= '" . cambiaf_a_mysql($fechas[1]) . "'";
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


        $this->cssjs->add_js($this->jsPath . "producto/ventas.js", false, false);
        //$this->cssjs->add_js(base_url() . "assets/js/usuario/listado.js", false, false);
        $this->load->view('header');
        $this->load->view($this->router->fetch_class() . "/ventas", $datos);
        $this->load->view('footer');
    }

    public function venta_info($ordID)
    {
        $data['order'] = $this->web->get_order($ordID);

        $data["estado"] = array("1" => "Por Confirmar", "0" => "Confirmado");

        $this->load->view($this->router->fetch_class() . "/form_ventas", $data);
    }
    function venta_actualizar($id)
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_rules('estado', 'Estado', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }

        $estado = $this->input->post("estado");

        $venta = array(
            "status"         => $estado,

        );
        $condicion = array("id" => $id);
        if ($this->general->update_data("orders", $venta, $condicion)) {
            $json["exito"] = true;
            $json["mensaje"] = "Venta actualizada con exito";
        } else {
            $json["exito"] = false;
            $json["mensaje"] = "No se guardaron cambios";
        }

        echo json_encode($json);
    }
    public function venta_eliminar($id = "")
    {
        $this->db->trans_start();
        $this->general->delete_data("orders", array("id" => $id));
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $json["exito"] = false;
            $json["mensaje"] = "Error al tratar de eliminar";
        } else {
            $json["exito"] = true;
            $json["mensaje"] = "Venta eliminada con exito";
        }
        echo json_encode($json);
    }
}
