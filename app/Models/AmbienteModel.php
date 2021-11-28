<?php

namespace App\Models;

use CodeIgniter\Model;

class AmbienteModel extends Model
{
    protected $table = "Ambientes";

    function registrar($datos)
    {
        $nombre = $datos['nombre'];
        $aforo = $datos['aforo_total'];
        $sql = "INSERT INTO ambientes(nombre, aforo_total)
                VALUES('$nombre', '$aforo')";
        $this->db->query($sql);

        $id = $this->db->insertID();

        return $id;
    }

    function actualizar($id, $datos)
    {
        $nombre = $datos['nombre'];
        $aforo = $datos['aforo_total'];
        $sql = "UPDATE ambientes SET nombre = '$nombre',
                    aforo_total = '$aforo'
                WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->affected_rows > 0;
    }

    function eliminar($id)
    {
        $sql = "UPDATE ambientes SET estado = 0
                WHERE id = $id";
        $this->db->query($sql);
    }
}
