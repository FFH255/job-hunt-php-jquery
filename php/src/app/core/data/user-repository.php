<?php
include_once dirname(__FILE__) . '/../domain/models.php';
include_once dirname(__FILE__) . '/../domain/repositories.php';
class UserRepositoryImpl extends UsersRepository {
  function __construct(
    private mysqli $bd,
  ) {}

  function getUser(string $login, string $password): User | null {
    $query = "SELECT * FROM users WHERE login = ? AND password = ? LIMIT 1";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    if(is_null($row)) {
        return null;
    }
    
    $roleEnum = Role::from($row['role']);
    
    return new User(
      $row['id'], 
      $row['login'], 
      $row['password'], 
      $roleEnum
    );
  }

  function addUser(string $login, string $password, int $role): User | null {
    $query = "INSERT INTO users(login, password, role) VALUES (?, ?, ?)";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("ssi", $login, $password, $role);
    $stmt->execute();
    $stmt->close();
    
    $id = $this->bd->insert_id;

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $this->bd->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    $row = $result->fetch_assoc();
    if(is_null($row)) {
        return null;
    }

    $roleEmun = Role::from($row['role']);
    
    return new User(
      $row['id'], 
      $row['login'], 
      $row['password'], 
      $roleEmun
    );
  }
}