<?php
include_once dirname(__FILE__) . '/../domain/repositories.php';

class ViewerRepositoryImpl extends ViewerRepository {
  private string $IS_AUTH_KEY = 'is_auth';
  private string $ROLE_KEY = 'role';
  private string $ID_KEY = 'id';

  function setIsAuth(bool $isAuth): void {
    $_SESSION[$this->IS_AUTH_KEY] = $isAuth;
  }

  function isAuth(): bool {
    return isset($_SESSION[$this->IS_AUTH_KEY]) && $_SESSION[$this->IS_AUTH_KEY];
  }

  function setRole(Role $role): void {
    $_SESSION[$this->ROLE_KEY] = $role->value;
  }

  function getRole(): Role | null {
    if (isset($_SESSION[$this->ROLE_KEY])) {
      return Role::from($_SESSION[$this->ROLE_KEY]);
    } else {
      return null;
    }
  }

  function setId(int $id): void {
    $_SESSION[$this->ID_KEY] = $id;
  }

  function getId(): int | null {
    if (isset($_SESSION[$this->ID_KEY])) {
      return (int)$_SESSION[$this->ID_KEY];
    } else {
      return null;
    }
  }
}