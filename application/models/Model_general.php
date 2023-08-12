<?php
class Model_general extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function save_data($table, $data)
    {
        $this->db->set($data);
        $this->db->insert($table);

        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return false;
    }

    public function update_data($table, $data, $condition)
    {
        $this->db->where($condition);
        $this->db->update($table, $data);
        if ($this->db->trans_status() === FALSE)
            return false;
        else
            return true;
    }
    public function delete_data($table, $condition)
    {
        $this->db->where($condition);
        $this->db->delete($table);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    public function getData($table, $datos, $where = null, $order = null)
    {
        $this->db->select(implode(",", $datos));
        if ($where != null)
            $this->db->where($where);
        if ($order != null)
            $this->db->order_by($order, "asc");
        $this->db->from($table);
        $consulta = $this->db->get();
        return $consulta->result();
    }
    public function check_captcha($where)
    {

        $this->db->where($where);
        $this->db->limit(1);
        $consulta = $this->db->get('captcha');

        if ($consulta->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function select_options($datos, $opts, $vacio = FALSE)
    {
        $options = ($vacio != FALSE) ? array("" => $vacio) : array();
        $id = $opts[0];
        $nombre = $opts[1];
        foreach ($datos as $value) {
            $options[$value->$id] = $value->$nombre;
        }

        return $options;
    }
    public function getOptions($table, $datos, $vacio = FALSE, $order = null, $where = null)
    {
        return $this->select_options($this->getData($table, $datos, $where, $order), $datos, $vacio);
    }

    function seleccionarDatos($datos, $opts, $vacio = FALSE)
    {
        $options = ($vacio != FALSE) ? array("" => $vacio) : array();
        $id = $opts[0];
        $nombre = $opts[1];
        $apellido = $opts[2];
        foreach ($datos as $value) {
            $options[$value->$id] = $value->$nombre . " " . $value->$apellido;
        }

        return $options;
    }
    public function obtenerDatos($table, $datos, $vacio = FALSE, $order = null, $where = null)
    {
        return $this->seleccionarDatos($this->getData($table, $datos, $where, $order), $datos, $vacio);
    }




    function enum_valores($tabla, $campo)
    {
        $consulta = $this->db->query("SHOW COLUMNS FROM $tabla LIKE '$campo'");
        if ($consulta->num_rows() > 0) {
            $consulta = $consulta->row();
            $array = explode(",", str_replace(array("enum", "'", "(", ")"), "", $consulta->Type));
            foreach ($array as $key) {
                $array2[$key] = $key;
            }
            return $array2;
        } else {
            return FALSE;
        }
    }
    function select2($tabla, $search, $order = null, $where = null)
    {
        $this->db->select("sql_calc_found_rows *", FALSE);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->or_like($search);
            $this->db->group_end();
        }
        $this->db->from($tabla);
        if ($where != null) $this->db->where($where);
        if ($order != null) $this->db->order_by($order);
        $consulta = $this->db->get();
        $query = $this->db->query('SELECT FOUND_ROWS() AS total_count');
        $total_count = $query->row()->total_count;
        $response = array("total_count" => $total_count, "items" => $consulta->result());
        return $response;
    }

    function select2withJoin($tabla, $search, $joinTable, $joinCondition, $order = null, $where = null)
    {
        $this->db->select("sql_calc_found_rows *", FALSE);
        if (!empty($search))
            $this->db->like($search);
        $this->db->from($tabla);
        $this->db->join($joinTable, $joinCondition);
        if ($where != null) $this->db->where($where);
        if ($order != null) $this->db->order_by($order);
        $consulta = $this->db->get();
        $query = $this->db->query('SELECT FOUND_ROWS() AS total_count');
        $total_count = $query->row()->total_count;
        $response = array("total_count" => $total_count, "items" => $consulta->result());
        return $response;
    }

    function select2query($id, $text, $query)
    {
        $response = new StdClass();
        $sql = 'SELECT DISTINCT SQL_CALC_FOUND_ROWS ' . $id . ' AS id, ' . $text . ' AS text ' . $query;
        $response->items = $this->db->query($sql)->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS total_count');
        $response->total_count = $query->row()->total_count;
        $response->incomplete_results = false;
        return $response;
    }

    function fecha_to_mysql($fecha)
    {
        if (empty($fecha))
            return NULL;
        if (preg_match('#([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})?#', $fecha, $mifecha)) {
            return $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
        }
        return NULL;
    }
    function time_to_mysql($fechahora)
    {
        if (preg_match('#([0-9]{1,2}):([0-9]{1,2})#', $fechahora, $buf)) {
            $hora = $buf[1];
            return $hora . ':' . $buf[2] . ':00';
        } else {
            return NULL;
        }
    }
    /*
    function time_to_mysql($fechahora) {
        if (preg_match('#([0-9]{1,2}):([0-9]{1,2}) ([A|P][M])#', $fechahora, $buf)){
            $hora = ($buf[3]=='PM' && $buf[1]<12) ? $buf[1]+12 : ($buf[1]==12 && $buf[3]=='AM'? 0:$buf[1]);
            return $hora . ':' . $buf[2] . ':00';
        }else{
            return NULL;
        }
    }
    */
    function dieMsg($json)
    {
        echo json_encode($json);
        exit;
    }
    function get_detaVenta($vent_id)
    {
        $this->db->from("venta_detalle");
        $this->db->join("producto", "prod_id = deta_prod_id");
        $this->db->where("deta_vent_id", $vent_id);
        return $this->db->get()->result();
    }
    public function encaja($_vTipo, $_vTipoId, $_vMoneda, $_vMonto, $_vCuenta, $_vDescripcion, $_vUsuaId, $obs)
    {

        $vIngreso = 0.00;
        $vEgreso = 0.00;

        if ($_vTipo == 'INGRESO') {
            $vIngreso = $_vMonto;
            $this->db->query("UPDATE cuenta SET cuen_saldo=cuen_saldo+{$_vMonto} WHERE cuen_id={$_vCuenta}");
        } else {
            $vEgreso = $_vMonto;
            $this->db->query("UPDATE cuenta SET cuen_saldo=cuen_saldo-{$_vMonto} WHERE cuen_id={$_vCuenta}");
        }

        $consulta = $this->db->query("SELECT cuen_saldo,cuen_moneda FROM cuenta WHERE cuen_id=$_vCuenta")->row();
        $vSaldo = $consulta->cuen_saldo;
        if ($_vMoneda == "")
            $vMoneda = $consulta->cuen_moneda;
        else
            $vMoneda = $_vMoneda;

        $data = array(
            "movi_cuen_id" => $_vCuenta,
            "movi_tipo_id" => $_vTipoId,
            "movi_tipo" => $_vTipo,
            "movi_fechareg" => date('Y-m-d H:i:s'),
            "movi_descripcion" => $_vDescripcion,
            "movi_monto" => $_vMonto,
            "movi_ingreso" => $vIngreso,
            "movi_egreso" => $vEgreso,
            "movi_saldo" => $vSaldo,
            "movi_moneda" => $vMoneda,
            "movi_id_usua" => $_vUsuaId,
            "movi_obs" => $obs
        );
        $this->db->set($data);
        $this->db->insert("cuenta_movimiento");
    }
    public function afectar_almacen($prod_id, $costo, $precio, $cantidad, $accion, $sucursal, $tipocomp, $serie, $numero, $tipooper, $descripcion)
    {

        $signo = ($accion == "INGRESO") ? "+" : "-";
        $fechass = ($accion == "INGRESO") ? "stoc_reg_fingreso" : "stoc_reg_fsalida";
        $sql = "INSERT INTO stock(stoc_sucu_id,stoc_prod_id,stoc_cantidad,{$fechass}) 
        VALUES ('{$sucursal}','{$prod_id}','{$signo}{$cantidad}',NOW()) 
        ON DUPLICATE KEY UPDATE stoc_cantidad=stoc_cantidad{$signo}({$cantidad}),{$fechass}=NOW();";
        if (!$this->db->query($sql)) return false;

        $old_cantidad = 0;
        $old_costo = 0;
        $old_total = 0;

        $ing_cantidad = 0;
        $ing_costo = 0;
        $ing_total = 0;

        $egr_cantidad = 0;
        $egr_costo = 0;
        $egr_total = 0;

        $sal_cantidad = 0;
        $sal_costo = 0;
        $sal_total = 0;

        $row = $this->db->query("SELECT * FROM kardex_producto WHERE kard_prod_id='{$prod_id}' AND kard_sucu_id='{$sucursal}' ORDER BY kard_id DESC LIMIT 1")->row();
        if (!empty($row->kard_id)) {
            $old_cantidad = $row->kard_sal_cantidad;
            $old_costo = $row->kard_sal_costo;
            $old_total = $row->kard_sal_total;
        }
        /*
        if(in_array($tipooper, array(5,6))){
            if($accion == 'EGRESO'){
                $ing_cantidad = $cantidad*-1;
                $ing_costo = $costo;
                $ing_total = $ing_cantidad*$ing_costo;
                $sal_cantidad = $old_cantidad+$ing_cantidad;
                $sal_costo = ($old_total+$ing_total)/$sal_cantidad;
                $sal_total = $sal_cantidad*$sal_costo;
                $accion = "INGRESO";
            }else{
               $egr_cantidad = $cantidad*-1;
               $egr_costo = $old_costo;
               $egr_total = $egr_cantidad*$egr_costo;
               $sal_cantidad = $old_cantidad-$egr_cantidad;
               $sal_costo = $old_costo;
               $sal_total = $sal_cantidad*$sal_costo;
               $accion = "EGRESO";
            }
        }else{
            if($accion == 'INGRESO'){
                $ing_cantidad = $cantidad;
                $ing_costo = $costo;
                $ing_total = $ing_cantidad*$ing_costo;
                $sal_cantidad = $old_cantidad+$ing_cantidad;
                $sal_costo = ($old_total+$ing_total)/$sal_cantidad;
                $sal_total = $sal_cantidad*$sal_costo;
            }else{
               $egr_cantidad = $cantidad;
               $egr_costo = $old_costo;
               $egr_total = $egr_cantidad*$egr_costo;
               $sal_cantidad = $old_cantidad-$egr_cantidad;
               $sal_costo = $old_costo;
               $sal_total = $sal_cantidad*$sal_costo;
            }
        }
        */
        if ($accion == 'INGRESO') {
            $ing_cantidad = $cantidad;
            $ing_costo = $costo;
            $ing_total = $ing_cantidad * $ing_costo;
            $sal_cantidad = $old_cantidad + $ing_cantidad;
            $sal_costo = ($old_total + $ing_total) / $sal_cantidad;
            $sal_total = $sal_cantidad * $sal_costo;
        } else {
            $egr_cantidad = $cantidad;
            $egr_costo = $old_costo;
            $egr_total = $egr_cantidad * $egr_costo;
            $sal_cantidad = $old_cantidad - $egr_cantidad;
            $sal_costo = $old_costo;
            $sal_total = $sal_cantidad * $sal_costo;
        }
        $kard = array(
            "kard_sucu_id" => $sucursal,
            "kard_tipo" => $accion,
            "kard_comp_id" => $tipocomp,
            "kard_serie" => $serie,
            "kard_numero" => $numero,
            "kard_tipo_id" => $tipooper,
            "kard_prod_id" => $prod_id,

            "kard_ing_cantidad" => $ing_cantidad,
            "kard_ing_costo" => $ing_costo,
            "kard_ing_total" => $ing_total,
            "kard_egr_cantidad" => $egr_cantidad,
            "kard_egr_costo" => $egr_costo,
            "kard_egr_total" => $egr_total,
            "kard_sal_cantidad" => $sal_cantidad,
            "kard_sal_costo" => $sal_costo,
            "kard_sal_total" => $sal_total,

            "kard_old_cantidad" => $old_cantidad,
            "kard_old_costo" => $old_costo,
            "kard_old_total" => $old_total,

            "kard_cantidad" => $cantidad,
            "kard_precio" => $precio,
            "kard_total" => $precio * $cantidad,
            "kard_descripcion" => $descripcion,
            "kard_fechareg" => date('Y-m-d H:i:s'),
            "kard_usuario" => $this->session->userdata('authorized')
        );
        if ($this->save_data("kardex_producto", $kard) != false)
            return true;
        else
            return false;
    }
    public function get_venta($vent_id)
    {


        $this->db->where("vent_id", $vent_id);
        $this->db->from("venta");
        $this->db->join("moneda", "mone_id = vent_moneda");
        $venta = $this->db->get()->row();

        $cobrado = $this->db->query("SELECT SUM(cobr_monto) monto FROM cobros where cobr_vent_id = {$vent_id}")->row();

        $venta->cobrado = ($cobrado->monto != "") ? $cobrado->monto : '0.00';
        $venta->saldo = number_format($venta->vent_total - $venta->cobrado, 2, '.', '');

        return $venta;
    }
    public function getServicioPaquete($paquete)
    {
        $data = $this->db->query("SELECT deta_id id, deta_paqu_id paqu_id, deta_tipo tipo, 
                                            deta_pax pax, deta_paxinf paxinf, deta_paxchd paxchd, deta_tc tc, IF(deta_esturistico = '1', serv_nombre, deta_descripcion) servicio, deta_tiposervicio tiposervicio,
                                            DATE_FORMAT(deta_fecha, '%d/%m/%Y') fecha, 
                                            DATE_FORMAT(deta_hora, '%H:%i') hora, 
                                            deta_precio precio, deta_tipocobro tipocobro, deta_obs obs
                                        FROM paquete_detalle
                                        LEFT JOIN servicio ON serv_id = deta_servicio
                                        WHERE deta_paqu_id = {$paquete} ORDER BY deta_fecha ASC, deta_hora ASC")->result();
        return $data;
    }
    public function getServicesBiblia($date, $tipo, $paqu_id)
    {
        $query = $this->db->query(
            "SELECT 
                deta_paqu_id paqu_id,
                deta_fecha,
                paqu_clie_rsocial agencia,
                paqu_nombre nombre,
                deta_pax pax,
                deta_paxchd paxchd,
                deta_paxinf paxinf,
                deta_tc tc,
                CONCAT(COALESCE(serv_nombre, ''), ' ', deta_obs) detalle,
                DATE_FORMAT(deta_hora, '%H:%i') hora,
                paqu_hotel_nombre hotel,
                deta_id id,
                color,
                texto,
                deta_tiposervicio stipo,
                CONCAT(paqu_datenum, '-', paqu_numero) file
            FROM
                paquete_detalle
                    LEFT JOIN
                paquete ON paqu_id = deta_paqu_id
                    LEFT JOIN
                servicio ON serv_id = deta_servicio
                    LEFT JOIN
                paquete_detalle_estado ON id = deta_estado
            WHERE
            (deta_fecha = '{$date}' or deta_paqu_id = '{$paqu_id}') AND deta_tipo = '{$tipo}'
            ORDER BY deta_hora ASC"
        );
        return $query->result();
    }
    public function getServicesFile($id)
    {
        $this->db->select("paqu_clie_rsocial agencia, paqu_nombre nombre, deta_pax pax, 
                            deta_paxchd paxchd, deta_paxinf paxinf, deta_tc tc, CONCAT(coalesce(serv_nombre,''),' ',deta_obs) detalle, DATE_FORMAT(deta_hora, '%H:%i') hora, 
                            DATE_FORMAT(deta_fecha, '%d/%m/%Y') fecha, paqu_hotel_nombre hotel, deta_id id, color, texto, deta_tiposervicio stipo, serv_nombre servicio");
        $this->db->from("paquete_detalle");
        $this->db->join("paquete", "paqu_id = deta_paqu_id");
        $this->db->join("servicio", "serv_id = deta_servicio", 'left');
        $this->db->join("paquete_detalle_estado", "id = deta_estado");
        $this->db->where("paqu_estado", 'VIGENTE');
        $this->db->where("paqu_id", $id);
        $this->db->order_by("deta_fecha", "asc");
        $this->db->order_by("deta_hora", "asc");
        return $this->db->get()->result();
    }
    public function getDetasOrdenServicio($orden = '')
    {
        $this->db->select("*, DATE_FORMAT(osdet_fecha,'%d/%m/%Y') osdet_fecha");
        $this->db->where("osdet_oserv_id", $orden);
        $this->db->from("ordserv_detalle");
        return $this->db->get()->result();
    }
    public function getRecordatorios()
    {
        $this->db->select("COUNT(*) cantidad");
        $this->db->from("recordatorios");
        $this->db->where("fecha >= ", date('Y-m-d'));
        $cantidad = $this->db->get()->row();

        if ($cantidad->cantidad > 0)
            return $cantidad->cantidad;
        else
            return 0;
    }
    public function getProveedoresServicio($deta_id, $tipo)
    {
        $proveedores = $this->db->query("SELECT GROUP_CONCAT(CONCAT(oser_datenum,'-',oser_numero,' | ',oser_prov_rsocial) SEPARATOR '<br>') proveedores
                                            FROM orden_servicio
                                            WHERE oser_id IN (SELECT osdet_oserv_id 
                                                                FROM ordserv_detalle
                                                                WHERE osdet_pdeta_id = {$deta_id})
                                            AND oser_prov_tipo IN ({$tipo})
                                            LIMIT 1");
        return $proveedores->num_rows() > 0 ? $proveedores->row()->proveedores : "";
    }
    public function getProveedoresServicio2($deta_id, $tipo)
    {
        $proveedores = $this->db->query("SELECT GROUP_CONCAT(CONCAT(oser_prov_rsocial) SEPARATOR '<br>') proveedores
                                            FROM orden_servicio
                                            WHERE oser_id IN (SELECT osdet_oserv_id 
                                                                FROM ordserv_detalle
                                                                WHERE osdet_pdeta_id = {$deta_id})
                                            AND oser_prov_tipo IN ({$tipo})
                                            LIMIT 1");
        return $proveedores->num_rows() > 0 ? $proveedores->row()->proveedores : "";
    }
}
