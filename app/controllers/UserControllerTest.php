<?php
class UserControllerTest
{
  private $model;

  public function __construct()
  {
    $this->model = new UserModel();
  }

  // Listado de todos los usuarios
  public function list()
  {
    try {
      $users = $this->model->getAll();
      // En modo prueba, solo retornamos datos
      if (defined('TEST_MODE') && TEST_MODE) {
        return $users;
      } else {
        $this->jsonResponse($users);
      }
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Guardar un nuevo usuario en la base de datos
  public function store($data)
  {
    try {
      $this->model->create($data);
      if (defined('TEST_MODE') && TEST_MODE) {
        return ["message" => "Usuario creado correctamente"];
      } else {
        $this->jsonResponse(["message" => "Usuario creado correctamente"], 201);
      }
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
        if (defined('TEST_MODE') && TEST_MODE) {
          return $user;
        } else {
          $this->jsonResponse($user);
        }
      } else {
        if (defined('TEST_MODE') && TEST_MODE) {
          return ["message" => "Usuario no encontrado"];
        } else {
          $this->jsonResponse(["message" => "Usuario no encontrado"], 404);
        }
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
      if (defined('TEST_MODE') && TEST_MODE) {
        return ["message" => "Usuario actualizado correctamente"];
      } else {
        $this->jsonResponse(["message" => "Usuario actualizado correctamente"], 200);
      }
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Eliminar un usuario por su ID
  public function delete($id)
  {
    try {
      $user = $this->model->getOne($id);
      if ($user) {
        $this->model->delete($id);
        if (defined('TEST_MODE') && TEST_MODE) {
          return ["message" => "Usuario eliminado correctamente"];
        }
      } else {
        // Si no se encontró el usuario para eliminar
        if (defined('TEST_MODE') && TEST_MODE) {
          return ["message" => "Usuario no encontrado"];
        }
      }
    } catch (Exception $e) {
      $this->handleError($e);
    }
  }

  // Respuesta JSON centralizada
  private function jsonResponse($data, $status = 200)
  {
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
  }

  // Manejo centralizado de errores
  private function handleError($e)
  {
    if (defined('TEST_MODE') && TEST_MODE) {
      return ["error" => $e->getMessage()];
    } else {
      $this->jsonResponse(["error" => $e->getMessage()], 500);
    }
  }
}
