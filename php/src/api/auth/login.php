<?php 
include_once dirname(__FILE__) . '/../../app/main.php';

if(!isset($_POST['login']) || !isset($_POST['password'])) {
  http_response_code(400);
  return;
}

$login = $_POST['login'];
$password = $_POST['password'];

try {
  $role = $authService->login($login, $password);

  if (is_null($role)) {
    http_response_code(401);
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
} catch(Exception $e) {
  http_response_code(500);
}