<?php

namespace App\Controllers;

use App\Models\AmbienteModel;
use CodeIgniter\HTTP\Response;

class Ambiente extends BaseController
{

    protected $ambienteModel;

    public function __construct()
    {
        helper('utils');
        $this->ambienteModel = new AmbienteModel();
    }

    public function getAll()
    {
        try {
            $ambientes = $this->ambienteModel->where('estado',1)->findAll();
            $data = apiResponse(200, '', $ambientes);
            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Throwable $th) {
            $data = apiResponse(500, "Ocurrió un error al procesar los datos");
            return $this->response->setStatusCode(500, "Sucedió un error")->setJSON($data);
        }
    }

    public function get($id = 0)
    {
        try {
            if ($id == 0) {
                $data = apiResponse(400, "El Id ingresado es inválido");
                return $this->response->setStatusCode(400, "Id Inválido")->setJSON($data);
            } else {
                $ambiente = $this->ambienteModel->find($id);
                $data = apiResponse(200, "", $ambiente);
                return $this->response->setStatusCode(200)->setJSON($data);
            }
        } catch (\Throwable $th) {
            $data = apiResponse(500, "Ocurrió un error al procesar los datos");
            return $this->response->setStatusCode(500, "Sucedió un error")->setJSON($data);
        }
    }

    public function create()
    {
        try {
            $dataRequest = json_decode(file_get_contents("php://input"), true);
            $dataInsert = [
                "nombre" => $dataRequest["nombre"],
                "aforo_total" => $dataRequest["aforo"]
            ];
            $id = $this->ambienteModel->registrar($dataInsert);
            if ($id > 0) {
                $ambiente = $this->ambienteModel->find($id);
                $data = apiResponse(200, "", $ambiente);
            } else {
                $data = apiResponse(500, "No se ha podido completar el registro");
            }

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Throwable $th) {
            $data = apiResponse(500, $th->getMessage());
            return $this->response->setStatusCode(500, "Sucedió un error")->setJSON($data);
        }
    }

    public function update($id)
    {
        try {
            $dataRequest = json_decode(file_get_contents("php://input"), true);
            $dataUpdate = [
                "nombre" => $dataRequest['nombre'],
                "aforo_total" => $dataRequest['aforo']
            ];
            $this->ambienteModel->actualizar($id, $dataUpdate);
            $ambiente = $this->ambienteModel->find($id);
            $data = apiResponse(200, "", $ambiente);
            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Throwable $th) {
            $data = apiResponse(500, $th->getMessage());
            return $this->response->setStatusCode(500, "Sucedió un error")->setJSON($data);
        }
    }

    public function delete($id)
    {
        try {
            $this->ambienteModel->eliminar($id);
            $data = apiResponse(200, "");
            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Throwable $th) {
            $data = apiResponse(500, $th->getMessage());
            return $this->response->setStatusCode(500, "Sucedió un error")->setJSON($data);
        }
    }
}
