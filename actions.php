<?php
require_once('config.php');
//データベースに接続
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

if (mb_strlen(trim($_POST['password'])) === 4) {
  $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
  $name = $_POST['name'];
  $body = $_POST['body'];
} else {
  echo 'error';
  return false;
}

if(empty(trim($name)) || mb_strlen($name) > 15){
  echo 'error';
  return false;
}

if (empty(trim($body)) || mb_strlen($body) > 255) {
  echo 'error';
  exit;
}

$stmt = $pdo->prepare('insert into users(name, body, password) values(?, ?, ?)');
$stmt->execute([$name, $body, $password]);
