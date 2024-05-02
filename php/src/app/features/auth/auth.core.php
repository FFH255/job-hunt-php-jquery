<?php
  enum Role: int {
    case None = 0;
    case User = 1;
    case Admin = 2;
  }

  class User {
    function __construct(
      public string $name,
      public string $password,
      public Role $role,
    ) {}
  }

  abstract class UsersRepository {
    abstract public function getUser(string $login, string $password): User | null;
  }

  class AuthService {
    public function __construct(
      private UsersRepository $usersRepository
    ) {}

    public function login(string $login, string $password): void {
      $user = $this->usersRepository->getUser($login, $password);
      if (is_null($user)) {
        return;
      }
      $_SESSION['is_auth'] = true;
      $_SESSION['role'] = $user->role->value;
    }
  }