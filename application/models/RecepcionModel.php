<?php
class RecepcionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_general', 'general');
    }

    
    public function consultaHabitacion()
    {
        $query = ' SELECT habitacion.id_hab AS id, habitacion.nombre_hab AS title, tipohabitacion.siglas_tipohab AS sigla FROM habitacion JOIN tipohabitacion ON habitacion.tipo_hab = tipohabitacion.id_tipohab ORDER BY habitacion.nombre_hab;';
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
    public function consultaReserva()
    {
        $query = 'SELECT proceso.id_proce AS id, proceso.idhabitacion_proce AS resourceId, proceso.fechaentrada_proce AS start, proceso.fechasalida_proce AS end, proceso.tipo_proce AS tipo, cliente.nombre_clie AS title, CASE WHEN proceso.tipo_proce = 1 THEN "green" WHEN proceso.tipo_proce = 2 THEN "purple" ELSE "red" END AS color FROM proceso JOIN cliente ON proceso.idclie_proce = cliente.id_clie;';
        $resultados = $this->db->query($query);
        return $resultados->result();
    }

}
