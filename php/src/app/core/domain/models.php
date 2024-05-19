<?php
  enum Role: int {
    case None = 0;
    case Applicant = 1;
    case Employer = 2;
  }

  class User {
    function __construct(
      public int $id,
      public string $name,
      public string $password,
      public Role $role,
    ) {}
  }
class Reply {
  function __construct(
    public int $id,
    public string $date,
    public string $title,
    public string $company,
  ) {}
}

class ApplicantVacancy {
  public function __construct(
    public int $id, 
    public string $title, 
    public string $employment, 
    public string $description,
    public bool $isReplied,
    public ?string $company = null, 
    public ?string $experienceFrom = null, 
    public ?string $experienceTo = null, 
    public ?string $city = null, 
    public ?string $salaryFrom = null, 
    public ?string $salaryTo = null
  ) {}
}

class EmployerVacancy {
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