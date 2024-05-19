<?php
include_once dirname(__FILE__) . '/../auth/auth.core.php';

class Vacancy {
  public function __construct(
    public int $id, 
    public string $title, 
    public string $employment, 
    public string $description,
    public ?string $company = null, 
    public ?string $experienceFrom = null, 
    public ?string $experienceTo = null, 
    public ?string $city = null, 
    public ?string $salaryFrom = null, 
    public ?string $salaryTo = null
  ) {}
}


abstract class VacanciesRepository {
  abstract function getVacancies($employerId = null): array;
}