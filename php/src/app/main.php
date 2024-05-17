<?php
session_start();
include_once dirname(__FILE__) . '/features/auth/auth.core.php';
include_once dirname(__FILE__) . '/features/auth/auth.data.php';
include_once dirname(__FILE__) . '/features/auth/auth.guards.php';

$db = new mysqli('db', 'root', 'root', 'job_hunt_db');

$usersRepository = new UserRepositoryImpl($db);
$authService = new AuthService($usersRepository);
$applicantGuard = new ApplicantGuard($authService);