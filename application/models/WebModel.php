<?php
class WebModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_general', 'general');
    }
    static $table = 'periodos';


    public function get_clientes()
    {
        return $this->db->query('SELECT id_cliente as id, nombres_cliente as text FROM cliente')->result_array();
    }

    public function get_cliente($id)
    {
        return $this->db->query('SELECT *FROM cliente WHERE id_cliente = ' . $id)->row();
    }

    public function get_producto($id)
    {
        return $this->db->query('SELECT *FROM producto WHERE id_producto = ' . $id)->row();
    }

    public function get_productos()
    {
        return $this->db->query('SELECT *FROM producto ORDER BY nombre_producto');
    }
    public function get_productos_inicio()
    {
        return $this->db->query('SELECT *FROM producto WHERE inicio_producto = 1 ORDER BY nombre_producto');
    }

    public function get_terapias()
    {
        return $this->db->query('SELECT *FROM terapia ORDER BY nombre_terapia');
    }
    public function get_terapia($id)
    {
        return $this->db->query('SELECT *FROM terapia WHERE id_terapia = ' . $id)->row();
    }

    public function get_cursos()
    {
        return $this->db->query('SELECT *FROM curso ORDER BY nombre_curso');
    }
    public function get_curso($id)
    {
        return $this->db->query('SELECT *FROM curso WHERE id_curso = ' . $id)->row();
    }

    public function get_cursos_inicio()
    {
        return $this->db->query('SELECT *FROM curso WHERE inicio_curso = 1 ORDER BY nombre_curso');
    }

    public function get_sliders()
    {
        return $this->db->query('SELECT *FROM slider WHERE estado_slider = 1');
    }

    public function get_order($id)
    {
        $this->proTable = 'producto';
        $this->custTable = 'cliente';
        $this->ordTable = 'orders';
        $this->ordItemsTable = 'order_items';

        $this->db->select('o.*, c.nombres_cliente as name, c.correo_cliente as email, c.telefono_cliente as phone, c.direccion_cliente as address');
        $this->db->from($this->ordTable . ' as o');
        $this->db->join($this->custTable . ' as c', 'c.id_cliente = o.customer_id', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();


        $this->db->select('i.*, p.imagen_producto as image, p.imagen2_producto as image2, p.nombre_producto as name, p.presentacion_producto as presentacion, p.presentacion2_producto as presentacion2, p.precio_producto as price, p.precio2_producto as price2');
        $this->db->from($this->ordItemsTable . ' as i');
        $this->db->join($this->proTable . ' as p', 'p.id_producto = i.product_id', 'left');
        $this->db->where('i.order_id', $id);
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0) ? $query2->result_array() : array();

        // Return fetched data
        return !empty($result) ? $result : false;
    }
    public function get($where)
    {
        $this->db->from(self::$table);
        $this->db->where($where);
        return $this->db->get()->result();
    }
    public function save($data_inscripcion, $data_cliente)
    {
        $this->db->trans_start();

        if (is_array($data_cliente)) {
            $cliente_id = $this->general->save_data("cliente", $data_cliente);
            if ($cliente_id == false) {
                $this->db->trans_rollback();
                return false;
            }
        } else {
            $cliente_id = $data_cliente;
        }

        $data_inscripcion['cliente_inscripcion'] = $cliente_id;

        $id_inscripcion = $this->general->save_data("inscripcion", $data_inscripcion);
        if ($id_inscripcion == false) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_complete();
        return $id_inscripcion;
    }
    public function save_reserva($data_reserva, $data_cliente)
    {
        $this->db->trans_start();

        if (is_array($data_cliente)) {
            $cliente_id = $this->general->save_data("cliente", $data_cliente);
            if ($cliente_id == false) {
                $this->db->trans_rollback();
                return false;
            }
        } else {
            $cliente_id = $data_cliente;
        }

        $data_reserva['cliente_reserva'] = $cliente_id;

        $id_reserva = $this->general->save_data("reserva", $data_reserva);
        if ($id_reserva == false) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_complete();
        return $id_reserva;
    }
}
