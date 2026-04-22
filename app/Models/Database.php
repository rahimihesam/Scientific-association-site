<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
  private static $instance = null;
  private $conn;
  private $host = 'localhost';
  private $dbname = 'scientific-association-site-db';
  private $username = 'root';
  private $password = '';

  public function __construct()
  {
    try {
      $this->conn = new PDO(
        "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
        $this->username,
        $this->password,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
      );
    } catch (PDOException $e) {
      echo "خطا در برقراری با دیتابیس : " . $e->getMessage();
    }
  }

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->conn;
  }
}
