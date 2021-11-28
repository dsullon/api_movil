<?php
function apiResponse($codigo, $mensaje = '', $datos = [])
{
    $data = array(
        "code" => $codigo,
        "message" => $mensaje,
        "data" => $datos
    );
    return $data;
}