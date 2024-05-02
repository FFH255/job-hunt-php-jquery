<?php 
include_once dirname(__FILE__) . '/../app/features/auth/auth.compose.php';

if(!isset($_POST['login']) || !isset($_POST['password'])) {
  echo "error";
  return;
}
$login = $_POST['login'];
$password = $_POST['password'];
$authService->login($login, $password);

echo "success";
return;