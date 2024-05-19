<?php

  class AuthService {
    public function __construct(
      private UsersRepository $usersRepository,
      private ViewerRepository $viewerRepository
    ) {}

    public function login(string $login, string $password): Role | null {
      $user = $this->usersRepository->getUser($login, $password);
      if (is_null($user)) {
        return null;
      }
      $this->viewerRepository->setIsAuth(true);
      $this->viewerRepository->setRole($user->role);
      $this->viewerRepository->setId($user->id);
      $this->viewerRepository->setLogin($user->name);
      return $user->role;
    }

    public function register(string $login, string $password, int $role): Role | null {
      $user = $this->usersRepository->addUser($login, $password, $role);
      if (is_null($user)) {
        return null;
      }
      $this->viewerRepository->setIsAuth(true);
      $this->viewerRepository->setRole($user->role);
      $this->viewerRepository->setId($user->id);
      $this->viewerRepository->setLogin($user->name);
      return $user->role;
    }

    public function logout() {
      session_unset();
      session_destroy();
    }
  }