<?php

require_once '../Autoloader.php';
require_once '../app/Helpers/functions.php';

// Start session if NOT already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Core\Router;

$router = new Router();

// Public routes
$router->get('/', [HomeController::class, 'index']);

// Authentication routes - Registration
$router->get('/auth/register', [AuthController::class, 'showRegister']);
$router->post('/auth/register', [AuthController::class, 'register']);
$router->get('/register', function () {
  redirect('/auth/register');
});

// Authentication routes - Login
$router->get('/auth/login', [AuthController::class, 'showLogin']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/login', function () {
  redirect('/auth/login');
});

// Logout route
$router->get('/logout', [AuthController::class, 'logout']);

$router->dispatch();
