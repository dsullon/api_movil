<?php
namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController{

    protected $usuarioModel;

    public function __construct() {
        helper('utils');
        $this->usuarioModel = new UsuarioModel();
    }

    public function getAll()
    {
        try {
            $usuarios = $this->usuarioModel->findAll();
            $data = apiResponse("200", "", $usuarios);
            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Throwable $th) {
            log_message("error", $th);
            $data = apiResponse("500", "Ocurrió un error al procesar los datos");
            return $this->response->setStatusCode(500)->setJSON($data);
        }
    }


    public function create()
    {
        echo "Se llamó al método create";
    }    
}
