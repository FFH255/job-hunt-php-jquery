<?php

  class AuthService {
    public function __construct(
      private UsersRepository $usersRepository,
      private ViewerRepository $viewerRepository
    ) {}

    public function login(string $login, string $password): bool {
      $user = $this->usersRepository->getUser($login, $password);
      if (is_null($user)) {
        return false;
      }
      session_start();
      $this->viewerRepository->setIsAuth(true);
      $this->viewerRepository->setRole($user->role);
      $this->viewerRepository->setId($user->id);
      $this->viewerRepository->setLogin($user->name);
      return true;
    }

    public function register(string $login, string $password, int $role): bool {
      $user = $this->usersRepository->addUser($login, $password, $role);
      if (is_null($user)) {
        return false;
      }
      session_start();
      $this->viewerRepository->setIsAuth(true);
      $this->viewerRepository->setRole($user->role);
      $this->viewerRepository->setId($user->id);
      $this->viewerRepository->setLogin($user->name);
      return true;
    }

    public function logout() {
      session_start();
      session_unset();
      session_destroy();
    }
  }