<?php 
include_once dirname(__FILE__) . '/../../app/main.php';

if(!isset($_POST['login']) || !isset($_POST['password'])) {
  http_response_code(400);
  return;
}

$login = $_POST['login'];
$password = $_POST['password'];

try {
  $ok = $authService->login($login, $password);

  if (!$ok) {
    http_response_code(401);
    return;
  }

  http_response_code(200);
} catch(Exception $e) {
  http_response_code(500);
}