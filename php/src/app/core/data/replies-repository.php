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

  function getReply(?int $id = null, ?int $applicantId = null, ?int $vacancyId = null): Reply | null {
    $query = "SELECT r.id, r.created_at, v.title, v.company FROM replies as r JOIN vacancies as v WHERE r.vacancy_id = v.id";

    $params = [];
    if ($id !== null) {
        $query .= " AND r.id = ?";
        $params[] = $id;
    }
    if ($applicantId !== null) {
        $query .= " AND r.user_id = ?";
        $params[] = $applicantId;
    }
    if ($vacancyId !== null) {
        $query .= " AND r.vacancy_id = ?";
        $params[] = $vacancyId;
    }

    $query .= " LIMIT 1";

    if (!count($params)) {
      return null;
    }

    $stmt = $this->bd->prepare($query);
    if ($params) {
        $types = str_repeat("i", count($params));
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row['id'] || !$row['created_at'] || !$row['title'] || !$row['company']) {
        return null;
    }

    return new Reply(
        $row['id'],
        $row['created_at'],
        $row['title'],
        $row['company']
    );  
  }

  function createReply(int $applicantId, int $vacancyId): Reply {
    $query = "INSERT INTO replies (user_id, vacancy_id, created_at) VALUES (?, ?, NOW())";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("ii", $applicantId, $vacancyId);
    $stmt->execute();
    
    $id = $stmt->insert_id;
    $reply = $this->getReply($id);

    return $reply;
  }
}