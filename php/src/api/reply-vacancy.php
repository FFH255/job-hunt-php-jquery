<?php
include_once dirname(__FILE__) . '/../app/main.php';
$id = $_GET['id'];

if(!ctype_digit($id)) {
  http_response_code(400);
  return;
}

$replayToVacancy->execute($id);
http_response_code(200);