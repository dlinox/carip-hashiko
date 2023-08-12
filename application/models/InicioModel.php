<?php
class InicioModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_general', 'general');
    }

    public function get_inscripciones_hoy()
    {
        return $this->db->query('SELECT COUNT(*) AS preinscripciones FROM inscripcion WHERE DATE_FORMAT(fecha_inscripcion, "%Y-%m-%d") = CURRENT_DATE')->row();
    }
    public function get_clientes_hoy()
    {
        return $this->db->query('SELECT COUNT(*) AS clientes FROM cliente WHERE DATE_FORMAT(fecha_registro_cliente, "%Y-%m-%d") = CURRENT_DATE')->row();
    }
    public function get_reservas_hoy()
    {
        return $this->db->query('SELECT COUNT(*) AS reservas FROM reserva WHERE DATE_FORMAT(fecha_reserva, "%Y-%m-%d") = CURRENT_DATE')->row();
    }
    public function get_ventas_hoy()
    {
        return $this->db->query('SELECT COUNT(*) AS ventas FROM orders WHERE DATE_FORMAT(created, "%Y-%m-%d") = CURRENT_DATE;')->row();
    }

    public function get_productos()
    {
        return $this->db->query('SELECT nombre_producto, SUM(quantity) AS cantidad FROM order_items JOIN producto ON order_items.product_id = producto.id_producto GROUP BY product_id ORDER BY cantidad DESC LIMIT 4')->result_array();
    }

    public function get_ventas()
    {
        $array = array();
        for ($i = 1; $i <= 12; $i++) {
            $array[]  = $this->db->query('SELECT COUNT(*) AS venta FROM orders WHERE DATE_FORMAT(created, "%c") = '.$i."")->row();
        }

        return $array;
    }
}
