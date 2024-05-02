<?php
include_once dirname(__FILE__) . '/auth.core.php';
class UserRepositoryImpl extends UsersRepository {
  function __construct() {}

  function getUser(string $login, string $password): User | null {
    return new User('seva', 'fadeev', Role::Admin);
  }
}