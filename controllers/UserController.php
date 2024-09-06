<?php
require_once "models/UserModel.php";

class UserController
{
  private $model;

  public function __construct()
  {
    $this->model = new UserModel();
  }

  // Método para mostrar la vista principal
  public function index()
  {
    require_once "views/IndexView.php";
  }

  // Listado de todos los usuarios
  public function list()
  {
    try {
      $users = $this->model->getAll();
      $this->jsonResponse($users);
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Mostrar el formulario para crear un nuevo usuario
  public function create()
  {
    require_once "views/create.view.php";
  }

  // Guardar un nuevo usuario en la base de datos
  public function store($data)
  {
    try {
      $this->model->create($data);
      $this->jsonResponse(["message" => "Usuario creado correctamente"], 201);
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Mostrar un solo usuario por su ID
  public function show($id)
  {
    try {
      $user = $this->model->getOne($id);
      if ($user) {
        $this->jsonResponse($user);
      } else {
        $this->jsonResponse(["message" => "Usuario no encontrado"], 404);
      }
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Actualizar un usuario existente
  public function update($data)
  {
    try {
      $this->model->update($data);
      $this->jsonResponse(["message" => "Usuario actualizado correctamente"], 200);
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Eliminar un usuario por su ID
  public function delete($id)
  {
    try {
      $this->model->delete($id);
      $this->jsonResponse(["message" => "Usuario eliminado correctamente"], 200);
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Respuesta JSON centralizada
  private function jsonResponse($data, $statusCode = 200)
  {
    header('Content-Type: application/json');
    http_response_code($statusCode);
    echo json_encode($data);
  }

  // Manejo centralizado de errores
  private function handleError($e)
  {
    $this->jsonResponse(["error" => $e->getMessage()], 500);
  }
}
