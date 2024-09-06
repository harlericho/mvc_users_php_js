<?php
class UserModel
{
  private $db;
  private $table;
  private $sql = null;
  public function __construct()
  {
    $this->db = new Db();
    $this->table = $this->getTableConfig();
  }
  // Llamar al archivo de configuracion .ini
  private function getTableConfig()
  {
    $route = __DIR__ . '/../init/table.ini';
    $config = parse_ini_file($route, true);

    if (!$config || !isset($config['table']['table1'])) {
      echo "Error al cargar el archivo de configuración";
    }
    return $config['table']['table1'];
  }
  // Listado de users
  public function getAll()
  {
    try {
      $this->sql = "SELECT * FROM $this->table";
      $stmt = $this->db->connect()->prepare($this->sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      $this->db->close();
      return $result;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // Listado de user
  public function getOne($id)
  {
    try {
      $this->sql = "SELECT * FROM $this->table WHERE id = :id";
      $stmt = $this->db->connect()->prepare($this->sql);
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->db->close();
      return $result;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // Crear user
  public function create($data)
  {
    try {
      $this->sql = "INSERT INTO $this->table (name, email) VALUES (:name, :email)";
      $stmt = $this->db->connect()->prepare($this->sql);
      $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
      $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
      $stmt->execute();
      $this->db->close();
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // Actualizar user
  public function update($data)
  {
    try {
      $this->sql = "UPDATE $this->table SET name = :name, email = :email WHERE id = :id";
      $stmt = $this->db->connect()->prepare($this->sql);
      $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
      $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
      $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
      $stmt->execute();
      $this->db->close();
      return true;
    } catch (PDOException $e) {
      echo  $e->getMessage();
    }
  }

  // Eliminar user
  public function delete($id)
  {
    try {
      $this->sql = "DELETE FROM $this->table WHERE id = :id";
      $stmt = $this->db->connect()->prepare($this->sql);
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      $this->db->close();
      return true;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
