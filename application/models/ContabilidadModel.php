<?php
class ContabilidadModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_general', 'general');
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
        $fecha_inicial = $año.'-01-01';
        $fecha_final = $año.'-01-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasFebrero()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-02-01';
        $fecha_final = $año.'-02-28';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasMarzo()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-03-01';
        $fecha_final = $año.'-03-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasAbril()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-04-01';
        $fecha_final = $año.'-04-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasMayo()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-05-01';
        $fecha_final = $año.'-05-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasJunio()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-06-01';
        $fecha_final = $año.'-06-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasJulio()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-07-01';
        $fecha_final = $año.'-07-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasAgosto()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-08-01';
        $fecha_final = $año.'-08-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasSetiembre()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-09-01';
        $fecha_final = $año.'-09-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasOctubre()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-10-01';
        $fecha_final = $año.'-10-31';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasNoviembre()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-11-01';
        $fecha_final = $año.'-11-30';

        $sql = 'SELECT COUNT(*) AS numventas
                FROM alumnos
                WHERE DATE(fecha_inscripcion) >= "' . $fecha_inicial . '" ' .
            'AND DATE(fecha_inscripcion) <= "' . $fecha_final . '" ';

        return $this->db->query($sql)->row();
    }
    private function getVentasDiciembre()
    {
        $año = date("Y");   
        $fecha_inicial = $año.'-12-01';
        $fecha_final = $año.'-12-31';

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
