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
    abstract public function addUser(string $login, string $password, int $role): User | null;
  }

  class AuthService {
    private string $IS_AUTH_KEY = 'is_auth';
    private string $ROLE_KEY = 'role';
    public function __construct(
      private UsersRepository $usersRepository
    ) {}

    public function login(string $login, string $password): void {
      $user = $this->usersRepository->getUser($login, $password);
      if (is_null($user)) {
        return;
      }
      session_start();
      $_SESSION[$this->IS_AUTH_KEY] = true;
      $_SESSION[$this->ROLE_KEY] = $user->role->value;
    }

    public function register(string $login, string $password, int $role): bool {
      $user = $this->usersRepository->addUser($login, $password, $role);
      if (is_null($user)) {
        return false;
      }
      session_start();
      $_SESSION[$this->IS_AUTH_KEY] = true;
      $_SESSION[$this->ROLE_KEY] = $user->role->value;
      return true;
    }

    public function logout() {
      session_start();
      session_unset();
      session_destroy();
    }
  }