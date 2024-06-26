<?php 
include_once dirname(__FILE__) . '/models.php';
include_once dirname(__FILE__) . '/repositories.php';
class GetApplicantReplies {
  function __construct(
    private RepliesRepository $repliesRepository,
    private ViewerRepository $viewerRepository
  ) {}
  function execute(): array {
    $userId = $this->viewerRepository->getId();
    $role = $this->viewerRepository->getRole();
    if ($role !== Role::Applicant) {
      return [];
    }
    if ($userId === null) {
      return [];
    }
    return $this->repliesRepository->getApplicantReplies($userId);
  }
}

class ReplayToVacancy {
  function __construct(
    private ViewerRepository $viewerRepository,
    private RepliesRepository $repliesRepository
  ) {}

  function execute(int $vacancyId): Reply | null {
    $role = $this->viewerRepository->getRole();
    $userId = $this->viewerRepository->getId();
    if ($role !== Role::Applicant) {
      return null;
    }
    if ($userId === null) {
      return null;
    }
    return $this->repliesRepository->createReply($userId, $vacancyId);
  }
}

class GetApplicantVacancies {
  function __construct(
    private VacanciesRepository $vacanciesRepository,
    private RepliesRepository $repliesRepository,
    private ViewerRepository $viewerRepository
  ) {}
  private function getApplicantVacancy(Vacancy $vacancy): ApplicantVacancy {
    $applicantId = $this->viewerRepository->getId();
    $replies = $this->repliesRepository->getReplies(null, $applicantId, $vacancy->id);
    $isReplied = count($replies) == 0 ? true : false;
    return new ApplicantVacancy(
      $vacancy->id,
      $vacancy->title,
      $vacancy->employment,
      $vacancy->description,
      $isReplied,
      $vacancy->company,
      $vacancy->experienceFrom,
      $vacancy->experienceTo,
      $vacancy->city,
      $vacancy->salaryFrom,
      $vacancy->salaryTo
    );
  }
  function execute(): array {
    $vacancies = $this->vacanciesRepository->getVacancies();
    $applicantVacancies = array_map([$this, 'getApplicantVacancy'], $vacancies);
    return $applicantVacancies;
  }
}

class GetApplicantVacancy {
  function __construct(
    private VacanciesRepository $vacanciesRepository,
    private RepliesRepository $repliesRepository,
    private ViewerRepository $viewerRepository
  ) {}
  function execute(int $id): ApplicantVacancy | null {
    $vacancy = $this->vacanciesRepository->getVacancy($id); 

    if (is_null($vacancy)) {
      return null;
    }

    $applicantId = $this->viewerRepository->getId();
    $replies = $this->repliesRepository->getReplies(null, $applicantId, $vacancy->id);
    $isReplied = count($replies) == 0 ? true : false;
    return new ApplicantVacancy(
      $vacancy->id,
      $vacancy->title,
      $vacancy->employment,
      $vacancy->description,
      $isReplied,
      $vacancy->company,
      $vacancy->experienceFrom,
      $vacancy->experienceTo,
      $vacancy->city,
      $vacancy->salaryFrom,
      $vacancy->salaryTo
    );
  }
}

class GetEmployerVacancies {
  function __construct(
    private VacanciesRepository $vacanciesRepository,
    private RepliesRepository $repliesRepository,
    private ViewerRepository $viewerRepository
  ) {}

  function execute(): array {
    $role = $this->viewerRepository->getRole();
    if($role !== Role::Employer) {
      return [];
    }
    $employerId = $this->viewerRepository->getId();
    if (is_null($employerId)) {
      return [];
    }
    return $this->vacanciesRepository->getVacancies($employerId);
  }
}

class VacancyFormValue {
  function __construct(
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

class CreateVacancy {
  function __construct(
    private VacanciesRepository $vacanciesRepository,
    private ViewerRepository $viewerRepository
  ) {}

  function execute(VacancyFormValue $formValue): Vacancy | null {
    $role = $this->viewerRepository->getRole();
    if ($role !== Role::Employer) {
      return null;
    }
    $employerId = $this->viewerRepository->getId();
    if (is_null($employerId)) {
      return null;
    }
    return $this->vacanciesRepository->createVacancy($formValue, $employerId);
  }
}