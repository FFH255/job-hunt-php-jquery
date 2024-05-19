<?php
include_once dirname(__FILE__) . '/models.php';

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
  abstract function createReply(int $applicantId, int $vacancyId): Reply;
}

abstract class VacanciesRepository {
  abstract function getVacancies($employerId = null): array;
}