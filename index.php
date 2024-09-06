<?php
// Llamar al UserController y la configuración de la base de datos
require_once "config/db.php";
require_once "controllers/UserController.php";

// Instancia del controlador
$userController = new UserController();

// Validar la acción
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'index';

// Mapeo de acciones permitidas
$actions = [
  'index' => 'index',
  'list' => 'list',
  'create' => 'create',
  'store' => 'store',
  'show' => 'show',
  'update' => 'update',
  'delete' => 'delete'
];

// Comprobar si la acción existe en el controlador
if (array_key_exists($action, $actions) && method_exists($userController, $actions[$action])) {
  // Ejecutar la acción correspondiente
  switch ($action) {
    case 'store':
    case 'update':
      $userController->{$actions[$action]}($_POST);
      break;
    case 'show':
    case 'delete':
      $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
      if ($id) {
        $userController->{$actions[$action]}($id);
      } else {
        echo json_encode(['error' => 'ID inválido']);
      }
      break;
    default:
      $userController->{$actions[$action]}();
      break;
  }
} else {
  // Acción por defecto: mostrar el índice
  $userController->index();
}
