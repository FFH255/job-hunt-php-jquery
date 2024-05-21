<?php
include_once dirname(__FILE__) . '/../app/main.php';

$employment = $_GET['employment'];

if(is_null($employment)) {
  http_response_code(400);
  exit();
}

$vacancies = $vacanciesRepository->getVacancies(null, $employment);

echo json_encode($vacancies);