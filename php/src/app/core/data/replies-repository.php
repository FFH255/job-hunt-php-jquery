<?php
include_once dirname(__FILE__) . '/../domain/models.php';
include_once dirname(__FILE__) . '/../domain/repositories.php';

class RepliesRepositoryImpl extends RepliesRepository {
  function __construct(
    private mysqli $bd,
  ) {}
  function getApplicantReplies(int $applicantId): array {
    $query = "SELECT r.id, r.created_at, v.title, v.company FROM replies as r JOIN vacancies as v WHERE r.vacancy_id = v.id AND r.user_id = ?; ";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("i", $applicantId);
    $stmt->execute();
    $result = $stmt->get_result();
    $vacancies = [];
    while ($row = $result->fetch_assoc()) {
      $vacancy = new Reply(
        $row['id'],
        $row['created_at'],
        $row['title'],
        $row['company']
      );
      $vacancies[] = $vacancy;
    }
    return $vacancies;
  }
  function createReply(int $applicantId, int $vacancyId): Reply {
    return new Reply(-1, 'fake_date', 'fake_title', 'fake_company');
  }
}