<?php
class Db
{
  private $host;
  private $user;
  private $pass;
  private $dbname;
  private $port;
  private $driver;
  private $charset;
  private $pdo;
  private $dsn;
  private $options = [
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];

  public function __construct()
  {
    $config = $this->getConfig();
    $this->host = $config['host'];
    $this->user = $config['user'];
    $this->pass = $config['password'];
    $this->dbname = $config['dbname'];
    $this->port = $config['port'];
    $this->driver = $config['driver'];
    $this->charset = $config['charset'];
    $this->dsn = "$this->driver:host=$this->host;dbname=$this->dbname;port=$this->port;charset=$this->charset";
    try {
      $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
    } catch (PDOException $e) {
      echo "Error:" . $e->getMessage();
    }
  }
  public function connect()
  {
    return $this->pdo;
  }
  public function close()
  {
    $this->pdo = null;
  }
  private function getConfig()
  {
    $route = BASE_PATH . '/config/init/config.ini';
    $config = parse_ini_file($route, true);

    if (!$config || !isset($config['database'])) {
      echo "Error al cargar el archivo de configuración";
    }
    return $config['database'];
  }
}
