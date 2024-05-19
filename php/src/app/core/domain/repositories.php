<?php
include_once dirname(__FILE__) . '/models.php';

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

abstract class UsersRepository {
  abstract public function getUser(string $login, string $password): User | null;
  abstract public function addUser(string $login, string $password, int $role): User | null;
}

abstract class ViewerRepository {
  abstract function setIsAuth(bool $isAuth): void;
  abstract function isAuth(): bool;  
  abstract function setRole(Role $role): void;
  abstract function getRole(): Role | null;
  abstract function setId(int $id): void;
  abstract function getId(): int | null;
  abstract function getLogin(): string | null;
  abstract function setLogin(string $login): void;
}

abstract class RepliesRepository {
  abstract function getApplicantReplies(int $applicantId): array;
  abstract function getReplies(?int $id = null, ?int $applicantId = null, ?int $vacancyId = null): array;
  abstract function createReply(int $applicantId, int $vacancyId): Reply;
  abstract function deleteReply(int $id): void;
}

abstract class VacanciesRepository {
  abstract function getVacancies($employerId = null): array;
  abstract function getVacancy(int $id): Vacancy | null;
  abstract function createVacancy(VacancyFormValue $formValue, int $employerId): Vacancy;
  abstract function deleteVacancy(int $id): void;
  abstract function editVacancy(VacancyFormValue $formValue, int $id): Vacancy;
}