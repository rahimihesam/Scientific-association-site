<?php

namespace App\Models;

class CSRF
{
  private $db;

  public function __construct()
  {
    $this->db = Database::getInstance()->getConnection();
  }

  // Generate new CSRF token and store in database
  public function generateToken()
  {
    $token = bin2hex(random_bytes(32));
    $expires_at = date('Y-m-d H:i:s', strtotime('+1 hours'));

    $this->cleanExpiredTokens();

    $query = "INSERT INTO csrf_tokens (token, expires_at) VALUES (:token, :expires_at)";
    $stmt = $this->db->prepare($query);
    $stmt->execute([
      ':token' => $token,
      ':expires_at' => $expires_at
    ]);

    $_SESSION['csrf_token'] = $token;

    return $token;
  }

  // Verify submitted token from stored database
  public function validateToken($token)
  {
    if (empty($token)) {
      return false;
    }

    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
      $this->deletetoken($token);
      unset($_SESSION['csrf_token']);
      return true;
    }

    $query = "SELECT id FROM csrf_tokens WHERE token = :token AND expires_at > NOW()";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':token' => $token]);

    if ($stmt->rowCount() > 0) {
      $this->deletetoken($token);
      return true;
    }

    return false;
  }

  // Remove used token from database
  private function deletetoken($token)
  {
    $query = "DELETE FROM csrf_tokens WHERE token = :token";
    $stmt = $this->db->prepare($query);
    $stmt->execute([':token' => $token]);
  }

  // Delete all expired tokens from database
  private function cleanExpiredTokens()
  {
    $query = "DELETE FROM csrf_tokens WHERE expires_at < NOW()";
    $this->db->exec($query);
  }
}
