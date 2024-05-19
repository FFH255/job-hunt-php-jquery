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