<?php
class HotelModel extends CI_Model
{

    var $table = 'habitacion';
    var $column_order = array('nombre_hab', 'descripcion_hab', 'tipo_hab', 'capacidad_hab', 'precio_hab', 'estado_hab', null); //set column field database for datatable orderable
    var $column_search = array('nombre_hab', 'descripcion_hab', 'tipo_hab', 'estado_hab'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_hab' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_general', 'general');
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_hab', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_hab', $id);
        $this->db->delete($this->table);
    }

    public function s2()
    {
        $id = 'id';
        $text = 'nombre';
        $query = 'FROM productos WHERE nombre LIKE "%' . $_GET['term'] . '%"';
        $response = $this->general->select2Query($id, $text, $query);
        echo json_encode($response);
    }

    public function s2ByDocente($docente_id)
    {
        $term = is_null($this->input->get('term')) ? '' : $this->input->get('term');
        $id = 'id';
        $text = 'nombre';
        $query = '  FROM    grupos 
                    JOIN    periodos 
                    ON      grup_peri_id = peri_id 
                    JOIN    productos 
                    ON      peri_prod_id = id' . ' 
                    WHERE   grup_docente_id = ' . $docente_id . '
                    AND     nombre LIKE "%' . $term . '%"';
        $response = $this->general->select2Query($id, $text, $query);
        return $response;
    }

    public function getByGrupo($grup_id)
    {
        $this->db->select('productos.*');
        $this->db->from('grupos');
        $this->db->join('periodos', 'grup_peri_id = peri_id');
        $this->db->join('productos', 'peri_prod_id = id');
        $this->db->where(['grup_id' => $grup_id]);
        return $this->db->get()->row();
    }

    public function getByPagoPersonal($id)
    {
        $this->db->select('*');
        $this->db->from('pagopersonal');
        $this->db->join('usuario', 'pagopersonal.usuario_id_usua = usuario.id_usua');
        $this->db->join('tipousuario', 'usuario.tipo_usua = tipousuario.tipo_id');
        $this->db->where(['idpago' => $id]);
        return $this->db->get()->row();
    }

    private function getEgresosPagoPersonal($fecha_inicial, $fecha_final)
    {
        $sql = 'SELECT SUM(bono+monto+comisiondirecta+comisionasesores+horas*costohora) AS egresopagopersonal
                FROM pagopersonal
                WHERE DATE(fecha) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }

    private function getEgresosFlujoDeCaja($fecha_inicial, $fecha_final)
    {
        $sql = 'SELECT SUM(importe_flujo) AS egresoflujocaja
                FROM flujocaja
                WHERE DATE(fecha_flujo) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_flujo) <= "' . $fecha_final . '" ';
        return $this->db->query($sql)->row();
    }

    private function getIngresosAlumnos($fecha_inicial, $fecha_final)
    {
        $sql = 'SELECT SUM(monto) AS ingresopagos
                FROM pagos
                WHERE DATE(fechapago) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fechapago) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentas($fecha_inicial, $fecha_final)
    {
        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }

    private function getVentasEnero()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-01-01';
        $fecha_final = $año . '-01-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasFebrero()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-02-01';
        $fecha_final = $año . '-02-28';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasMarzo()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-03-01';
        $fecha_final = $año . '-03-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasAbril()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-04-01';
        $fecha_final = $año . '-04-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasMayo()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-05-01';
        $fecha_final = $año . '-05-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasJunio()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-06-01';
        $fecha_final = $año . '-06-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasJulio()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-07-01';
        $fecha_final = $año . '-07-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasAgosto()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-08-01';
        $fecha_final = $año . '-08-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasSetiembre()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-09-01';
        $fecha_final = $año . '-09-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasOctubre()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-10-01';
        $fecha_final = $año . '-10-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasNoviembre()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-11-01';
        $fecha_final = $año . '-11-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasDiciembre()
    {
        $año = date("Y");
        $fecha_inicial = $año . '-12-01';
        $fecha_final = $año . '-12-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }

    public function getEgresosIngresos($fecha_inicial, $fecha_final)
    {
        $pagopersonal = $this->getEgresosPagoPersonal($fecha_inicial, $fecha_final);
        $flujocaja = $this->getEgresosFlujoDeCaja($fecha_inicial, $fecha_final);
        $pagos = $this->getIngresosAlumnos($fecha_inicial, $fecha_final);
        $ventas = $this->getVentas($fecha_inicial, $fecha_final);

        $enero = $this->getVentasEnero();
        $febrero = $this->getVentasFebrero();
        $marzo = $this->getVentasMarzo();
        $abril = $this->getVentasAbril();
        $mayo = $this->getVentasMayo();
        $junio = $this->getVentasJunio();
        $julio = $this->getVentasJulio();
        $agosto = $this->getVentasAgosto();
        $setiembre = $this->getVentasSetiembre();
        $octubre = $this->getVentasOctubre();
        $noviembre = $this->getVentasNoviembre();
        $diciembre = $this->getVentasDiciembre();

        return compact('pagopersonal', 'flujocaja', 'pagos', 'ventas', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'setiembre', 'octubre', 'noviembre', 'diciembre');
    }



    private function getComisionDirecta($usuario_id, $fecha_inicial, $fecha_final)
    {
        $sql = 'SELECT  IFNULL(SUM(comision), 0) AS total, 
                        IFNULL(GROUP_CONCAT(id_alumno), "") AS ids 
                FROM    alumnos 
                JOIN    productos 
                ON      productos_id = id 
                WHERE   habilitado 
                AND     usuario_id_usua = ' . $usuario_id . ' ' .
            'AND    DATE(alum_fecha) >= "' . $fecha_inicial . '" ' .
            'AND    DATE(alum_fecha) <= "' . $fecha_final . '"';

        return $this->db->query($sql)->row();
    }

    private function getComisionPorAsesorado($usuario_id, $fecha_inicial, $fecha_final)
    {
        $sql = 'SELECT  IFNULL(SUM(comision_asesor), 0) AS total, 
                        IFNULL(GROUP_CONCAT(id_alumno), "") AS ids 
                FROM    alumnos 
                JOIN    productos 
                ON      productos_id = id 
                WHERE   habilitado 
                AND     usuario_id_usua IN (SELECT id_usua FROM usuario WHERE usuario_id_usua = ' . $usuario_id . ')' .
            'AND    DATE(alum_fecha) >= "' . $fecha_inicial . '" ' .
            'AND    DATE(alum_fecha) <= "' . $fecha_final . '"';

        return $this->db->query($sql)->row();
    }

    public function getComisiones($usuario_id, $fecha_inicial, $fecha_final)
    {
        $directo = $this->getComisionDirecta($usuario_id, $fecha_inicial, $fecha_final);
        $asesorado = $this->getComisionPorAsesorado($usuario_id, $fecha_inicial, $fecha_final);
        return compact('directo', 'asesorado');
    }
}
