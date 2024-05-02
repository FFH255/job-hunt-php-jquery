<?php
include_once dirname(__FILE__) . '/auth.data.php';
include_once dirname(__FILE__) . '/auth.core.php';

$usersRepository = new UserRepositoryImpl();
$authService = new AuthService($usersRepository);