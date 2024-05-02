<?php 
include_once dirname(__FILE__) . '/../../app/features/auth/auth.compose.php';

$authService->logout();
http_response_code(200);