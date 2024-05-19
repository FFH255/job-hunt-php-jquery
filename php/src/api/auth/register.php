<?php
include_once dirname(__FILE__) . '/../../app/main.php';

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

try {
  $role = $authService->register($login, $password, $role);

  if (!$role) {
    http_response_code(409);
    return;
  }

  $redirectUrl = '/';
  switch ($role) {
    case Role::Applicant:
      $redirectUrl = '/';
      break;
    case Role::Employer:
      $redirectUrl = '/employer-vacancies.php';
      break;
    default:
      break;
  }

  header('Content-Type: application/json');
  http_response_code(200);
  echo json_encode(['redirectUrl' => $redirectUrl]);
} catch(Exception $error) {
  http_response_code(500);
}