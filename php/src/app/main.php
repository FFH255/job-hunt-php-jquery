<?php
session_start();

// domain
include_once dirname(__FILE__) . '/core/domain/models.php';
include_once dirname(__FILE__) . '/core/domain/repositories.php';
include_once dirname(__FILE__) . '/core/domain/use-cases.php';

// repositories
include_once dirname(__FILE__) . '/core/data/replies-repository.php';
include_once dirname(__FILE__) . '/core/data/user-repository.php';
include_once dirname(__FILE__) . '/core/data/vacancies-repository.php';
include_once dirname(__FILE__) . '/core/data/viewer-repository.php';

// feature/auth
include_once dirname(__FILE__) . '/features/auth/auth-service.php';
include_once dirname(__FILE__) . '/features/auth/auth.guards.php';

$db = new mysqli('db', 'root', 'root', 'job_hunt_db');

$userRepository = new UserRepositoryImpl($db);

$viewerRepository = new ViewerRepositoryImpl();

$vacanciesRepository = new VacanciesRepositoryImpl($db);

$repliesRepository = new RepliesRepositoryImpl($db);

$getApplicantVacancies = new GetApplicantVacancies($vacanciesRepository, $repliesRepository, $viewerRepository);

$getApplicantVacancy = new GetApplicantVacancy($vacanciesRepository, $repliesRepository, $viewerRepository);

$getApplicantReplies = new GetApplicantReplies($repliesRepository, $viewerRepository);

$replayToVacancy = new ReplayToVacancy($viewerRepository, $repliesRepository);

$authService = new AuthService($userRepository, $viewerRepository);

$applicantGuard = new ApplicantGuard($viewerRepository);