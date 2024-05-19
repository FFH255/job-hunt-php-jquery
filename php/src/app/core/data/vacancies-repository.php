<?php

include_once dirname(__FILE__) . '/../domain/models.php';
include_once dirname(__FILE__) . '/../domain/repositories.php';

class VacanciesRepositoryImpl extends VacanciesRepository {
  function __construct(
    private mysqli $bd,
  ) {}

  function getVacancies($employerId = null): array {
    $query = "SELECT * FROM vacancies";
    $stmt = $this->bd->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $vacancies = [];
    while ($row = $result->fetch_assoc()) {
      $vacancy = new Vacancy(
        $row['id'],
        $row['title'],
        $row['employment'],
        $row['description'],
        $row['company'],
        $row['experience_from'],
        $row['experience_to'],
        $row['city'],
        $row['salary_from'],
        $row['salary_to'],
      );
      $vacancies[] = $vacancy;
    }
    return $vacancies;
  }
}