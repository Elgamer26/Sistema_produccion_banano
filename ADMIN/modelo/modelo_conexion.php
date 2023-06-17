<?php
class modelo_conexion
{

  private $host;
	private $db;
	private $contraseña;
	private $usuario;

  //esto es para la conexion habrir la conexion la base de datos
  public function conexionPDO()
  {
    $this->host = "localhost";
    $this->usuario = "root";
    $this->contraseña = "elgamer1";
    $this->db = "proyecto_ochoa";

    try {
      $pdo =  new PDO("mysql:host=$this->host;dbname=$this->db", $this->usuario, $this->contraseña);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->exec("set names utf8");
      return $pdo;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  //esto es para cerrar la conexion de la base de datos
  public function cerrar_conexion()
  {
    $this->pdo->close();
  }

  ////////////
  //// para el backup
  public function gethost(): string
  {
    return $this->host;
  }

  public function getUsuario(): string
  {
    return $this->usuario;
  }

  public function getdb(): string
  {
    return $this->db;
  }

  public function getContrasena(): string
  {
    return $this->contraseña;
  }
}
