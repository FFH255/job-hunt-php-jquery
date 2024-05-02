<?php 
include_once dirname(__FILE__) . '/../../app/main.php';

if(!isset($_POST['login']) || !isset($_POST['password'])) {
  http_response_code(400);
  return;
}

$login = $_POST['login'];
$password = $_POST['password'];
$authService->login($login, $password);

http_response_code(200);
return;