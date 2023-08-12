<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{
    function __construct()
    {
        parent::__construct();


        $this->load->library('Cssjs');
        $this->load->library('form_validation');
        $this->load->library('Ssp');
        $this->load->library('cart');
        $this->jsPath = base_url() . "assets/js/";
        $this->cssPath = base_url() . "assets/css/";
        $this->load->model('Model_general', 'general');
        $this->load->model('RecepcionModel', 'recepcion');
        $this->load->model('WebModel', 'web');
        $this->load->model('product');
        $this->controller = $this->router->fetch_class();
        $this->load->helper('Functions');
        $this->load->helper('Response');
        $this->user_id = $this->session->userdata('authorized');
    }

    public function index()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;



        $cursos = $this->web->get_cursos_inicio();
        $sliders = $this->web->get_sliders();
        $productos = $this->web->get_productos_inicio();

        $data["cursos"] = $cursos;
        $data["sliders"] = $sliders;
        $data["productos"] = $productos;

        $this->cssjs->add_js($this->jsPath . "web/inicio.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/inicio', $data);
        $this->load->view($this->controller . '/footer');
    }



    public function nosotros()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;
        $columns = array(
            array('db' => 'id', 'dt' => 'DT_RowId'),
            array('db' => 'nombre', 'dt' => 'NOMBRE')
        );
        foreach ($columns as &$item) {
            $item['field'] = $item['db'];
        }

        if ($json) {

            $json = isset($_GET['json']) ? $_GET['json'] : false;

            $table = 'rubros';
            $primaryKey = 'id';

            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );

            $condiciones = array();
            $joinQuery = "FROM rubros";
            $where = "";

            $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
            echo json_encode(
                $this->ssp->simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where)
            );
            exit(0);
        }

        $datos['columns'] = $columns;
        $datos['titulo'] = "Rubros";

        //$this->cssjs->add_js($this->jsPath . "recepcion/calendario.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/nosotros', $datos);
        $this->load->view($this->controller . '/footer');
    }

    public function cursos()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $cursos = $this->web->get_cursos();

        $data["cursos"] = $cursos;

        //$this->cssjs->add_js($this->jsPath . "recepcion/calendario.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/cursos', $data);
        $this->load->view($this->controller . '/footer');
    }




    public function curso($id)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $cursos = $this->web->get_curso($id);

        $data["cursos"] = $cursos;

        $this->cssjs->add_js($this->jsPath . "/web/curso.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/curso_info', $data);
        $this->load->view($this->controller . '/footer');
    }

    public function producto($id)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $productos = $this->web->get_producto($id);

        $data["productos"] = $productos;

        $this->cssjs->add_js($this->jsPath . "/web/curso.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/producto_info', $data);
        $this->load->view($this->controller . '/footer');
    }


    public function producto_informacion($id)
    {
        $productos = $this->web->get_producto($id);
        echo json_encode($productos);
    }




    public function agregar_producto($id)
    {

        $this->load->library('cart');

        $productos = $this->web->get_producto($id);
        $data["productos"] = $productos;


        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/carrito', $data);
        $this->load->view($this->controller . '/footer');
    }

    public function preinscripcion()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $curso = $this->web->get_cursos();
        $data["tipo"] = $this->general->getOptions('curso', array("id_curso", "nombre_curso"), '* Seleccione el Curso');
        $data["curso"] = $curso;

        $this->cssjs->add_js($this->jsPath . "web/inscripcion.js?v=1", false, false);
        //$this->cssjs->add_js($this->jsPath . "ventas/form.js?v=1", false, false);
        $script['js'] = $this->cssjs->generate_js();
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/preinscripcion', $data);
        $this->load->view($this->controller . '/footer');
    }

    public function inscripcion($id)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $curso = $this->web->get_curso($id);
        $data["tipo"] = $this->general->getOptions('curso', array("id_curso", "nombre_curso"), '* Seleccione el Curso');
        $data["curso"] = $curso;

        $this->cssjs->add_js($this->jsPath . "web/inscripcion.js?v=1", false, false);
        //$this->cssjs->add_js($this->jsPath . "ventas/form.js?v=1", false, false);
        $script['js'] = $this->cssjs->generate_js();
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/inscripcion', $data);
        $this->load->view($this->controller . '/footer');
    }

    public function guardar_inscripcion($id = null)
    {
        $this->load->library('Form_validation');
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
            'smtp_host' => 'mail.hashiko.com.pe',
            'smtp_port' => 465,
            'smtp_user' => 'info@hashiko.com.pe',
            'smtp_pass' => 'dN_d}lD;e#]%',
            'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            'mailtype' => 'html', //plaintext 'text' mails or 'html'
            'smtp_timeout' => '4', //in seconds
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );

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

        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $dni = $this->input->post("dni");
        $telefono = $this->input->post("telefono");
        $correo = $this->input->post("correo");
        $curso = $this->input->post("tipo");
        $observacion = $this->input->post("observacion");

        /** Enviar Mensaje */
        $this->email->initialize($config);

        $this->email->to($correo, $nombres . " " . $apellidos);
        $this->email->from('info@hashiko.com.pe', 'Hashiko');
        $this->email->cc('chambialexd@gmail.com');
        $this->email->subject('Pre Inscripcion');
        $plantilla = '<html>
        <head>
            <title>Email de Contactenos</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <style type="text/css">
                /* FONTS */
                
        
                /* CLIENT-SPECIFIC STYLES */
                body,
                table,
                td,
                a {
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }
        
                table,
                td {
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }
        
                img {
                    -ms-interpolation-mode: bicubic;
                }
        
                /* RESET STYLES */
                img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                }
        
                table {
                    border-collapse: collapse !important;
                }
        
                body {
                    height: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    width: 100% !important;
                }
        
                /* iOS BLUE LINKS */
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                }
        
                /* ANDROID CENTER FIX */
                div[style*="margin: 16px 0;"] {
                    margin: 0 !important;
                }
            </style>
        </head>
        
        <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
        
            
        
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <!-- LOGO -->
                <tr>
                    <td bgcolor="#7c72dc" align="center">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
                            <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 10px 10px;">
                            <a style="display: block; font-family: sans-serif; color: #ffffff; font-size: 28px; text-decoration: none;" href="http://litmus.com" target="_blank">
                                <img alt="Logo" src="https://hashiko.com.pe//assets/web/img/logotipo.png" width="100"
                                    height="100"
                                    style="display: block;  font-family:  sans-serif; color: #ffffff; font-size: 18px;"
                                    border="0">
                                HASHIKO
                                </a>
                        </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- HERO -->
                <tr>
                    <td bgcolor="#7c72dc" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
                            <tr>
                                <td bgcolor="#ffffff" align="center" valign="top"
                                    style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: sans-serif; font-size: 42px; font-weight: 400; letter-spacing: 2px; line-height: 48px;">
                                    <h2 style="font-size: 28px; font-weight: 400; margin: 0;">Confirmacion de Inscripcion</h2>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- COPY BLOCK -->
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
        
                            <tr>
                                <td bgcolor="#ffffff" align="left"
                                    style="padding: 20px 30px 10px 30px; color: #666666; font-family: sans-serif; font-size: 18px; font-weight: 400; line-height: 5px;">
                                    <p style="font-weight: bold;">Hola ' . $nombres . ' ' . $apellidos . '</p>
                
                                </td>
                            </tr>
                            <!-- COPY -->
                            <tr>
                                <td bgcolor="#ffffff" align="left"
                                    style="padding: 20px 30px 20px 30px; color: #666666; font-family: sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    
                                    <p>' . $nombres . ' su pre-inscripcion se a realizado correctamente!' . '</p>
                                </td>
                            </tr>
                            <!-- BULLETPROOF BUTTON -->
                            
                        </table>
                    </td>
                </tr>
        
        
                <!-- FOOTER -->
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
        
        
        
                            <!-- ADDRESS -->
                            <tr>
                                <td bgcolor="#f4f4f4" align="left"
                                    style="padding: 20px 30px 30px 30px; color: #666666; font-family: sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;">
                                    <p style="margin: 0;"> Jr. Santiago Antonio Lishner N°1710. Cercado de Lima, Perú.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
        </body>
        
        </html>';
        $this->email->message($plantilla);

        if (isset($_POST['agregar_persona'])) {
            $nombres = $this->input->post("nombres");
            $apellidos = $this->input->post("apellidos");
            $dni = $this->input->post("dni");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
        }



        $cliente_data = [
            "nombres_cliente" => $nombres,
            "apellidos_cliente" => $apellidos,
            "dni_cliente" => $dni,
            "telefono_cliente" => $telefono,
            "correo_cliente" => $correo
        ];

        $data = array(
            "observacion_inscripcion" => $observacion,
            "estado_inscripcion" => '2',
            "curso_inscripcion" => $curso
        );

        if ($this->web->save($data, $cliente_data) == false) {
            showError('Ocurrió un error guardando al alumno');
        } else {
            $this->email->send();
            showSuccess('Alumno registrado correctamente');
        }

        //echo json_encode($resp);
    }

    public function terapias()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $terapias = $this->web->get_terapias();

        $data["terapias"] = $terapias;

        //$this->cssjs->add_js($this->jsPath . "recepcion/calendario.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/terapias', $data);
        $this->load->view($this->controller . '/footer');
    }

    public function terapia($id)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $terapias = $this->web->get_terapia($id);

        $data["terapias"] = $terapias;

        $this->cssjs->add_js($this->jsPath . "web/terapia.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/terapia_info', $data);
        $this->load->view($this->controller . '/footer');
    }

    public function tienda($json = false)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $data = array();
        $productos = $this->web->get_productos();

        $data["productos"] = $productos;
        //$data['products'] = $this->product->getRows();

        $this->cssjs->add_js($this->jsPath . "web/tienda.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/tienda', $data);
        $this->load->view($this->controller . '/footer');
    }

    function aagregar_carrito($id, $tipo)
    {
        $producto = $this->web->get_producto($id);

        if ($tipo == 1) {
            $datos = array(
                'id'    =>  $producto->id_producto,
                'qty'   =>  1,
                'price' => $producto->precio_producto,
                'name'  => $producto->nombre_producto,
                'image' => $producto->imagen_producto,
                'options' => array('presentacion' => $producto->presentacion_producto)
            );
        } elseif ($tipo == 2) {
            $datos = array(
                'id'    =>  $producto->id_producto,
                'qty'   =>  1,
                'price' => $producto->precio2_producto,
                'name'  => $producto->nombre_producto,
                'image' => $producto->imagen2_producto,
                'options' => array('presentacion' => $producto->presentacion2_producto)
            );
        }



        $this->cart->insert($datos);

        // Redirect to the cart page
        redirect(base_url('web/carrito'));
    }

    function agregar_carrito($proID)
    {

        // Fetch specific product by ID
        $product = $this->product->getRows($proID);

        // Add product to the cart
        $data = array(
            'id'    => $product['id'],
            'qty'    => 1,
            'price'    => $product['price'],
            'name'    => $product['name'],
            'image' => $product['image']
        );
        $this->cart->insert($data);

        // Redirect to the cart page
        redirect(base_url('web/carrito'));
    }

    function carrito()
    {
        $data = array();

        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        $this->cssjs->add_js($this->jsPath . "web/carrito.js", false, false);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/carrito', $data);
        $this->load->view($this->controller . '/footer');
    }

    function updateItemQty()
    {
        $update = 0;

        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');

        // Update item in the cart
        if (!empty($rowid) && !empty($qty)) {
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }

        // Return response
        echo $update ? 'ok' : 'err';
    }

    function removeItem($rowid)
    {
        // Remove item from cart
        $remove = $this->cart->remove($rowid);

        // Redirect to the cart page
        redirect(base_url('web/carrito'));
    }
    function checkout()
    {
        // Redirect if the cart is empty
        if ($this->cart->total_items() <= 0) {
            redirect(base_url('web/tienda'));
        }

        $custData = $data = array();

        // If order request is submitted
        $submit = $this->input->post('placeOrder');
        if (isset($submit)) {
            // Form field validation rules
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'Phone', 'required');
            $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
            $this->form_validation->set_rules('dni', 'DNI', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required');
            $this->form_validation->set_rules('direccion', 'Direccion', 'required');

            // Prepare customer data
            $custData = array(
                'nombres_cliente'     => strip_tags($this->input->post('nombres')),
                'apellidos_cliente'     => strip_tags($this->input->post('apellidos')),
                'dni_cliente'     => strip_tags($this->input->post('dni')),
                'telefono_cliente' => strip_tags($this->input->post('telefono')),
                'correo_cliente' => strip_tags($this->input->post('correo')),
                'direccion_cliente' => strip_tags($this->input->post('direccion'))
            );

            // Validate submitted form data
            if ($this->form_validation->run() == true) {
                // Insert customer data
                $insert = $this->product->insertarCliente($custData);

                // Check customer data insert status
                if ($insert) {
                    // Insert order
                    $order = $this->placeOrder($insert);

                    // If the order submission is successful
                    if ($order) {
                        $this->session->set_userdata('success_msg', 'Order placed successfully.');
                        redirect($this->controller . '/orderSuccess/' . $order);
                    } else {
                        $data['error_msg'] = 'Order submission failed, please try again.';
                    }
                } else {
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }

        // Customer data
        $data['custData'] = $custData;

        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        // Pass products data to the view

        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/checkout', $data);
        $this->load->view($this->controller . '/footer');
    }

    function placeOrder($id_cliente)
    {
        // Insert order data
        $ordData = array(
            'customer_id' => $id_cliente,
            'grand_total' => $this->cart->total()
        );
        $insertOrder = $this->product->insertOrder($ordData);

        if ($insertOrder) {
            // Retrieve cart data from the session
            $cartItems = $this->cart->contents();

            // Cart items
            $ordItemData = array();
            $i = 0;
            foreach ($cartItems as $item) {
                $ordItemData[$i]['order_id']     = $insertOrder;
                $ordItemData[$i]['product_id']     = $item['id'];
                $ordItemData[$i]['quantity']     = $item['qty'];
                $ordItemData[$i]['sub_total']     = $item["subtotal"];
                $i++;
            }

            if (!empty($ordItemData)) {
                // Insert order items
                $insertOrderItems = $this->product->insertOrderItems($ordItemData);

                if ($insertOrderItems) {
                    // Remove items from the cart
                    $this->cart->destroy();

                    // Return order ID
                    return $insertOrder;
                }
            }
        }
        return false;
    }

    function orderSuccess($ordID)
    {
        // Fetch order data from the database
        //$data['order'] = $this->product->getOrder($ordID);

        $data['order'] = $this->web->get_order($ordID);

        // Load order details view
        //$this->load->view($this->controller . '/order-success', $data);
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/order-success', $data);
        $this->load->view($this->controller . '/footer');
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


    /**-----------------PAGINA DE RESERVACION ---------------- */

    public function cliente_informacion()
    {
        $cliente = $this->web->get_clientes();

        $clientes['results'] = $cliente;

        echo json_encode($clientes);
    }

    public function reservacion($id = "")
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $data["tipo"] = $this->general->getOptions('terapia', array("id_terapia", "nombre_terapia"), '* Seleccione la terapia');


        $reserva = new stdClass();
        $reserva->id_reserva = "";
        $reserva->atencion_reserva = "";
        $reserva->estado_reserva = "";
        $reserva->cliente_reserva = "";
        $reserva->terapia_reserva = "";

        if (isset($_GET['cliente'])) {
            $reserva->cliente_reserva = $_GET['cliente'];
        }

        $data["reserva"] = $reserva;

        $this->cssjs->add_js($this->jsPath . "web/reserva.js?v=1", false, false);
        //$this->cssjs->add_js($this->jsPath . "ventas/form.js?v=1", false, false);
        $script['js'] = $this->cssjs->generate_js();
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/reservacion', $data);
        $this->load->view($this->controller . '/footer');
    }
    public function reserva($id)
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $terapia = $this->web->get_terapia($id);
        $data["tipo"] = $this->general->getOptions('terapia', array("id_terapia", "nombre_terapia"), '* Seleccione la terapia');
        $data["terapia"] = $terapia;

        $this->cssjs->add_js($this->jsPath . "web/reserva.js?v=1", false, false);
        $script['js'] = $this->cssjs->generate_js();
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/reserva', $data);
        $this->load->view($this->controller . '/footer');
    }

    public function guardar_reserva($id = null)
    {
        $this->load->library('Form_validation');
        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_message('greater_than', '%s debe de ser número mayor a 0');

        $this->form_validation->set_rules('nombres', 'Nombre(s)', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('dni', 'DNI', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('tipo', 'Terapia', 'required');
        $this->form_validation->set_rules('dia', 'Dia de Atencion', 'required');
        $this->form_validation->set_rules('hora', 'Hora de Atencion', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }

        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $dni = $this->input->post("dni");
        $telefono = $this->input->post("telefono");
        $correo = $this->input->post("correo");
        $terapia = $this->input->post("tipo");
        $dia = $this->input->post("dia");
        $hora = $this->input->post("hora");

        if (isset($_POST['agregar_persona'])) {
            $nombres = $this->input->post("nombres");
            $apellidos = $this->input->post("apellidos");
            $dni = $this->input->post("dni");
            $telefono = $this->input->post("telefono");
            $correo = $this->input->post("correo");
        }


        $cliente_data = [
            "nombres_cliente" => $nombres,
            "apellidos_cliente" => $apellidos,
            "dni_cliente" => $dni,
            "telefono_cliente" => $telefono,
            "correo_cliente" => $correo
        ];

        $data = array(
            "dia_reserva" => $dia,
            "hora_reserva" => $hora,
            "estado_reserva" => '2',
            "terapia_reserva" => $terapia
        );

        if ($this->web->save_reserva($data, $cliente_data) == false) {
            showError('Error al registrar reserva');
        } else {
            showSuccess('Reserva Realizada');
        }

        //echo json_encode($resp);
    }
    /** FIN DE RESERVACION */


    /** --------------PAGINA CONTACTENOS------------- */

    public function contactenos()
    {
        $this->load->helper('Functions');
        $this->load->library('Ssp');
        $this->load->library('Cssjs');
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $this->cssjs->add_js($this->jsPath . "web/contactenos.js?v=1", false, false);
        $script['js'] = $this->cssjs->generate_js();
        $this->load->view($this->controller . '/header');
        $this->load->view($this->controller . '/contactenos');
        $this->load->view($this->controller . '/footer');
    }

    public function enviar_mensaje()
    {
        $this->load->library('Form_validation');
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
            'smtp_host' => 'mail.hashiko.com.pe',
            'smtp_port' => 465,
            'smtp_user' => 'info@hashiko.com.pe',
            'smtp_pass' => 'dN_d}lD;e#]%',
            'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            'mailtype' => 'html', //plaintext 'text' mails or 'html'
            'smtp_timeout' => '4', //in seconds
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );

        $this->form_validation->set_message('required', '%s es un campo obligatorio ');
        $this->form_validation->set_message('greater_than', '%s debe de ser número mayor a 0');
        $this->form_validation->set_message('valid_email', '%s debe contener una dirección de correo electrónico válida.');

        $this->form_validation->set_rules('nombres', 'Nombre(s)', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
        $this->form_validation->set_rules('asunto', 'Asunto', 'required');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->general->dieMsg(array('exito' => false, 'mensaje' => validation_errors()));
        }

        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $correo = $this->input->post("correo");
        $asunto = $this->input->post("asunto");
        $mensaje = $this->input->post("mensaje");


        $this->email->initialize($config);

        $this->email->to('hashikobienestarentuvida@gmail.com', 'Hashiko');
        $this->email->from('info@hashiko.com.pe', 'Hashiko');
        $this->email->cc('chambialexd@gmail.com');
        $this->email->reply_to($correo, $nombres . " " . $apellidos);
        $this->email->subject($asunto);


        $plantilla = '<html>
        <head>
            <title>Email de Contactenos</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <style type="text/css">
                /* FONTS */
                
        
                /* CLIENT-SPECIFIC STYLES */
                body,
                table,
                td,
                a {
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }
        
                table,
                td {
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }
        
                img {
                    -ms-interpolation-mode: bicubic;
                }
        
                /* RESET STYLES */
                img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                }
        
                table {
                    border-collapse: collapse !important;
                }
        
                body {
                    height: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    width: 100% !important;
                }
        
                /* iOS BLUE LINKS */
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                }
        
                /* ANDROID CENTER FIX */
                div[style*="margin: 16px 0;"] {
                    margin: 0 !important;
                }
            </style>
        </head>
        
        <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
        
            
        
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <!-- LOGO -->
                <tr>
                    <td bgcolor="#7c72dc" align="center">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
                            <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 10px 10px;">
                            <a style="display: block; font-family: sans-serif; color: #ffffff; font-size: 28px; text-decoration: none;" href="http://litmus.com" target="_blank">
                                <img alt="Logo" src="https://hashiko.com.pe//assets/web/img/logotipo.png" width="100"
                                    height="100"
                                    style="display: block;  font-family:  sans-serif; color: #ffffff; font-size: 18px;"
                                    border="0">
                                HASHIKO
                                </a>
                        </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- HERO -->
                <tr>
                    <td bgcolor="#7c72dc" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
                            <tr>
                                <td bgcolor="#ffffff" align="center" valign="top"
                                    style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                    <h1 style="font-size: 32px; font-weight: 400; margin: 0;">Contactenos</h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- COPY BLOCK -->
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
        
                            <tr>
                                <td bgcolor="#ffffff" align="left"
                                    style="padding: 20px 30px 10px 30px; color: #666666; font-family: sans-serif; font-size: 18px; font-weight: 400; line-height: 5px;">
                                    <p style="font-weight: bold;">Asunto:</p>
                                    <p>' . $asunto . '</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" align="left"
                                    style="padding: 20px 30px 10px 30px; color: #666666; font-family: sans-serif; font-size: 18px; font-weight: 400; line-height: 5px;">
                                    <p style="font-weight: bold;">' . $nombres . ' ' . $apellidos . '</p>
                                    <p>' . $correo . '</p>
                                </td>
                            </tr>
                            <!-- COPY -->
                            <tr>
                                <td bgcolor="#ffffff" align="left"
                                    style="padding: 20px 30px 30px 30px; color: #666666; font-family: sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <p style="font-weight: bold;">Mensaje:</p>
                                    <p>' . $mensaje . '</p>
                                </td>
                            </tr>
                            <!-- BULLETPROOF BUTTON -->
                            
                        </table>
                    </td>
                </tr>
        
        
                <!-- FOOTER -->
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="480">
        
        
        
                            <!-- ADDRESS -->
                            <tr>
                                <td bgcolor="#f4f4f4" align="left"
                                    style="padding: 20px 30px 30px 30px; color: #666666; font-family: sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;">
                                    <p style="margin: 0;"> Jr. Santiago Antonio Lishner N°1710. Cercado de Lima, Perú.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
        </body>
        
        </html>';
        $this->email->message($plantilla);

        if (!$this->email->send()) {
            echo json_encode(array("exito" => FALSE, "mensaje" => 'Error al Enviar'));
        } else {
            echo json_encode(array("exito" => TRUE, "mensaje" => 'Enviado Correctamente'));
        }
    }
    /** --------------FIN PAGINA CONTACTENOS------------- */
}
