<?php
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

   function getVacancy(int $id): Vacancy | null {
    $query = "SELECT * FROM vacancies WHERE id = ?";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    if(is_null($row)) {
        return null;
    }

    return new Vacancy(
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
   }

   function deleteVacancy(int $id): void {
    $query = "DELETE FROM vacancies WHERE id = ?;";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->get_result();
   }

   function createVacancy(VacancyFormValue $formValue, int $employerId): Vacancy {
      $stmt = $this->bd->prepare("INSERT INTO vacancies (title, company, employment, experience_from, experience_to, city, salary_from, salary_to, description, employer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

      $stmt->bind_param("sssssssssi", 
        $formValue->title, 
        $formValue->company, 
        $formValue->employment, 
        $formValue->experienceFrom, 
        $formValue->experienceTo, 
        $formValue->city, 
        $formValue->salaryFrom, 
        $formValue->salaryTo, 
        $formValue->description, 
        $employerId
      );

      $stmt->execute();

      $vacancyId = $stmt->insert_id;

      $stmt->close();

      $vacancy = new Vacancy(
        $vacancyId, 
        $formValue->title, 
        $formValue->employment, 
        $formValue->description,
        $formValue->company, 
        $formValue->experienceFrom, 
        $formValue->experienceTo, 
        $formValue->city, 
        $formValue->salaryFrom, 
        $formValue->salaryTo
      );

      return $vacancy;
   }

   function editVacancy(VacancyFormValue $formValue, int $id): Vacancy {
      $query = "UPDATE vacancies SET 
              title = ?, 
              company = ?, 
              employment = ?, 
              experience_from = ?, 
              experience_to = ?, 
              city = ?, 
              salary_from = ?, 
              salary_to = ?, 
              description = ? 
              WHERE id = ?";

      $stmt = $this->bd->prepare($query);

      $stmt->bind_param("sssssssssi", 
                        $formValue->title, 
                        $formValue->company, 
                        $formValue->employment, 
                        $formValue->experienceFrom, 
                        $formValue->experienceTo, 
                        $formValue->city, 
                        $formValue->salaryFrom, 
                        $formValue->salaryTo, 
                        $formValue->description, 
                        $id);

      $stmt->execute();

      return new Vacancy(
          $id,
          $formValue->title,
          $formValue->employment,
          $formValue->description,
          $formValue->company,
          $formValue->experienceFrom,
          $formValue->experienceTo,
          $formValue->city,
          $formValue->salaryFrom,
          $formValue->salaryTo
      );
   }
}