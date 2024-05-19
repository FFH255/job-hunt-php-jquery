<?php
include_once dirname(__FILE__) . '/../domain/models.php';
include_once dirname(__FILE__) . '/../domain/repositories.php';

class RepliesRepositoryImpl extends RepliesRepository {
  function __construct(
    private mysqli $bd,
  ) {}
  function getApplicantReplies(int $applicantId): array {
    return [];
  }
  function createReply(int $applicantId, int $vacancyId): Reply {
    return new Reply(-1, 'fake_date', 'fake_company');
  }
}