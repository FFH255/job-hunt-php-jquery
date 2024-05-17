<?php 
include_once dirname(__FILE__) . '/auth.core.php';
class ApplicantGuard {
  function __construct(private AuthService $authService) {}
  function canActivate() {
    $auth = $this->authService->getAuth();
    if ($auth->isAuth === true && $auth->role === Role::User->value) {
      return;
    }
    header('Location: /login.php');
    die();
  }
}