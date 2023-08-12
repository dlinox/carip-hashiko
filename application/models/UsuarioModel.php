<?php
class UsuarioModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_general', 'general');
    }

    public function getLideres0()
    {
        $sql = 'SELECT  id_usua AS id, 
                        CONCAT(nombre_usua, " ", apellido_usua, " (", dni_usua, ")") AS label 
                FROM    usuario 
                WHERE   id_usua IN 
                (
                    SELECT DISTINCT usuario_id_usua 
                    FROM            usuario
                )';

        $results = $this->db->query($sql)->result();
        $lideres = [];
        $lideres[''] = 'Todos los usuarios';

        foreach($results as $result) { $lideres[$result->id] = $result->label; }

        return $lideres;
    }

    public function getLideres()
    {
        $sql = 'SELECT  id_usua AS id, 
                        CONCAT(nombre_usua, " ", apellido_usua, " (", dni_usua, ")") AS label  
                FROM    usuario 
                WHERE   usuario_id_usua IS NULL 
                AND     tipo_usua = 1';

        $results = $this->db->query($sql)->result();
        $lideres = [];
        $lideres[''] = 'Todos los usuarios';

        foreach($results as $result) { $lideres[$result->id] = $result->label; }

        return $lideres;
    }

    public function getNoAsesorados()
    {
        $sql = 'SELECT  id_usua AS id, 
                        CONCAT(nombre_usua, " ", apellido_usua, " (", dni_usua, ")") AS label 
                FROM    usuario 
                WHERE   tipo_usua = 1 
                AND 	usuario_id_usua IS NULL 
                AND     id_usua NOT IN 
                (
                    SELECT DISTINCT usuario_id_usua 
                    FROM            usuario 
                    WHERE           tipo_usua = 1
                );';

        $results = $this->db->query($sql)->result();
        $no_asesorados = [];
        $no_asesorados[''] = 'Seleccione un usuario';

        foreach($results as $result) { $no_asesorados[$result->id] = $result->label; }

        return $no_asesorados;
    }

    public function tieneAsesorados($id)
    {
        $sql = 'SELECT COUNT(*) AS total FROM usuario WHERE usuario_id_usua = ' . $id;
        $result = $this->db->query($sql)->row();
        return $result->total > 0 ? true : false;
    }
}
