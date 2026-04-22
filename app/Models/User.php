<?php

namespace App\Models;

class User
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Insert new user record into database
  public function create($data)
  {
    $query = "INSERT INTO users (full_name, mobile, email, password)
                          VALUES (:full_name, :mobile, :email, :password)
    ";
    $stmt = $this->db->prepare($query);
    return $stmt->execute($data);
  }
}
