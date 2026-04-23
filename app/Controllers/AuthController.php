<?php

namespace App\Controllers;

require_once '../app/Helpers/functions.php';

use App\Models\CSRF;
use App\Models\Database;
use App\Models\User;
use PDO;
use PDOException;

class AuthController
{
  private $userModel;

  public function __construct()
  {
    // Ensure session is active
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->userModel = new User();
  }

  // Display registration form
  public function showRegister()
  {
    $this->checkAuth();
    $csrf = new CSRF();
    $csrfToken = $csrf->generateToken();
    require_once '../app/Views/auth/register.php';
  }

  // Display login form
  public function showLogin()
  {
    $this->checkAuth();
    $csrf = new CSRF();
    $csrfToken = $csrf->generateToken();
    require_once '../app/Views/auth/login.php';
  }

  // Process registration form submission
  public function register()
  {
    if ($this->isPost()) {
      $csrf = new CSRF();
      if (!$csrf->validateToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = 'خطای امنیتی! لطفاً صفحه را رفرش کنید.';
        $this->sendRegisterPage();
      }

      $full_name = trim($_POST['fullName'] ?? '');
      $mobile = trim($_POST['mobile'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $password = $_POST['password'] ?? '';

      try {
        $database = new Database();
        $db = $database->getConnection();

        // Check if user already exists with same mobile or email
        $check_query = "SELECT id FROM users WHERE mobile = :mobile OR email = :email";
        $stmt = $db->prepare($check_query);
        $stmt->execute([
          ':mobile' => $mobile,
          ':email' => $email
        ]);

        if ($stmt->rowCount() > 0) {
          $_SESSION['error'] = "کاربری با این شماره موبایل یا ایمیل قبلاً ثبت‌نام کرده است.";
          require_once '../app/Views/auth/register.php';
          return;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
          'full_name' => $full_name,
          'mobile' => $mobile,
          'email' => $email,
          'password' => $hashed_password,
        ];

        // Create new user record
        if ($this->userModel->create($data)) {
          // Fetch newly created user data
          $database = new Database();
          $db = $database->getConnection();
          $check_query = "SELECT * FROM users WHERE mobile = :mobile OR email = :email";
          $stmt = $db->prepare($check_query);
          $stmt->execute([
            ':mobile' => $mobile,
            ':email' => $email
          ]);
          $user = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set session variables for Logged-in user
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['full_name'] = $user['full_name'];
          $_SESSION['mobile'] = $user['mobile'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['just_registered'] = true;
          $_SESSION['registered_name'] = $full_name;
          redirect('/');
        } else {
          $_SESSION['error'] = 'خطا در ثبت‌نام. لطفاً مجدداً تلاش کنید.';
          require_once '../app/Views/auth/register.php';
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'خطای دیتابیس: ' . $e->getMessage();
        require_once '../app/Views/auth/register.php';
      }
    }
  }

  // Process login form submission
  public function login()
  {
    if ($this->isPost()) {
      $csrf = new CSRF();
      if (!$csrf->validateToken($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] =  'خطای امنیتی! لطفاً صفحه را رفرش کنید.';
        $this->sendLoginPage();
      }

      $username = trim($_POST['username'] ?? '');
      $password = $_POST['password'];

      // Detect if input is mobile number or email
      $input_type = detectedInputType($username);
      if ($input_type) {
        try {
          $database = new Database();
          $db = $database->getConnection();

          $query = "SELECT * FROM users WHERE ";
          if ($input_type == 'mobile') {
            $query .= " mobile = :username";
          } else {
            $query .= " email = :username";
          }

          $stmt = $db->prepare($query);
          $stmt->execute([
            ':username' => $username
          ]);

          if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
              // Set session variables for authenticated user
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['full_name'] = $user['full_name'];
              $_SESSION['mobile'] = $user['mobile'];
              $_SESSION['email'] = $user['email'];
              $_SESSION['show_welcome'] = true;
              redirect('/');
              return;
            } else {
              $_SESSION['error'] = 'رمز عبور اشتباه است.';
              $this->sendLoginPage();
            }
          } else {
            $_SESSION['error'] = 'کاربری با این مشخصات پیدا نشد.';
            $this->sendLoginPage();
          }
        } catch (PDOException $e) {
          $_SESSION['error'] = 'خطای دیتابیس : ' . $e->getMessage();
          $this->sendLoginPage();
        }
      }
    }
  }

  // Check if current request method is POST
  private function isPost()
  {
    return $_SERVER['REQUEST_METHOD'] === "POST";
  }

  // Redirect authenticated users to homepage
  private function checkAuth()
  {
    if (isset($_SESSION['user_id'])) {
      redirect('/');
    }
  }

  // Redirect to registration page
  private function sendRegisterPage()
  {
    redirect('/auth/register');
    return;
  }

  // Redirect to login page
  private function sendLoginPage()
  {
    redirect('/auth/login');
    return;
  }

  // Destroy function logout
  public function logout()
  {
    session_destroy();
    redirect('/auth/login');
  }
}
