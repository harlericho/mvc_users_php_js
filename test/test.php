<?php
// Definir BASE_PATH para que las rutas sean correctas
define('BASE_PATH', __DIR__ . '/..');
define('TEST_MODE', true); // Activar el modo de prueba

// Incluir las dependencias
require_once BASE_PATH . '/config/Db.php';
require_once BASE_PATH . '/app/models/UserModel.php';
require_once BASE_PATH . '/app/controllers/UserControllerTest.php'; // Controlador de Test

// Crear una instancia del controlador
$userController = new UserControllerTest();

// Función para capturar la salida JSON de los métodos
function captureOutput($callback)
{
  ob_start();
  $result = $callback();
  return ob_get_clean() ?: $result;
}

// Probar el método 'list'
// echo "Probando método 'list':\n";
// $output = captureOutput(function () use ($userController) {
//   return $userController->list();
// });
// echo "Respuesta JSON del método 'list':\n";
// echo json_encode($output, JSON_PRETTY_PRINT) . "\n";

// Probar el método 'store'
// echo "Probando método 'store':\n";
// $userData = [
//   'name' => 'Test User',
//   'email' => 'testuser@example.com'
// ];
// $output = captureOutput(function () use ($userController, $userData) {
//   return $userController->store($userData);
// });
// echo "Respuesta JSON del método 'store':\n";
// echo json_encode($output, JSON_PRETTY_PRINT) . "\n";

// Probar el método 'update'
// echo "Probando método 'update':\n";
// $updateData = [
//   'id' => 7,
//   'name' => 'Updated User',
//   'email' => 'updateduser@example.com'
// ];
// $output = captureOutput(function () use ($userController, $updateData) {
//   return $userController->update($updateData);
// });
// echo "Respuesta JSON del método 'update':\n";
// echo json_encode($output, JSON_PRETTY_PRINT) . "\n";

// Probar el método 'show'
// echo "Probando método 'show':\n";
// $output = captureOutput(function () use ($userController) {
//   return $userController->show(6); // Asume que el ID 1 existe en la base de datos
// });
// echo "Respuesta JSON del método 'show':\n";
// echo json_encode($output, JSON_PRETTY_PRINT) . "\n";

// Probar el método 'delete'
echo "Probando método 'delete':\n";
$output = captureOutput(function () use ($userController) {
  return $userController->delete(6); // Asume que el ID 1 existe en la base de datos
});
echo "Respuesta JSON del método 'delete':\n";
echo json_encode($output, JSON_PRETTY_PRINT) . "\n";
