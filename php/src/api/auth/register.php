<?php
include_once dirname(__FILE__) . '/../../app/features/auth/auth.compose.php';

if(!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['role'])) {
  http_response_code(400);
  return;
}

$login = $_POST['login'];
$password = $_POST['password'];
$role = $_POST['role'];

if (!is_numeric($role)) {
  http_response_code(400);
  return;
}

$ok = $authService->register($login, $password, $role);

if (!$ok) {
  http_response_code(409);
  return;
}

http_response_code(200);
return;