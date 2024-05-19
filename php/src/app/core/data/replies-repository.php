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
    $query = "INSERT INTO replies (user_id, vacancy_id, created_at) VALUES (?, ?, NOW())";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("ii", $applicantId, $vacancyId);
    $stmt->execute();
    
    $replyId = $stmt->insert_id;

    $query = "SELECT r.id, r.created_at, v.title, v.company FROM replies as r JOIN vacancies as v WHERE r.vacancy_id = v.id AND r.id = ? LIMIT 1;";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("i", $replyId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return new Reply(
      $row['id'],
        $row['created_at'],
        $row['title'],
        $row['company']
    );  
  }
}