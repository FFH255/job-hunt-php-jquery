<?php
include_once dirname(__FILE__) . '/../app/main.php';

$id = $_GET['id'];

$formValue = new VacancyFormValue(
    $_POST['title'],
    $_POST['employment'],
    $_POST['description'],
    $_POST['company'],
    $_POST['experience_from'],
    $_POST['experience_to'],
    $_POST['city'],
    $_POST['salary_from'],
    $_POST['salary_to']
);

$vacanciesRepository->editVacancy($formValue, $id);

header('Content-Type: application/json');
echo json_encode($vacancy);