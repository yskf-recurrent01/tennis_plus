<?php
session_start();
if (isset($_SESSION['id'])) {
  header('location:bbs.php');
  exit();
}

$dsn = 'mysql:host=localhost;dbname=tennis_plus;charset=utf8';
$user = 'tennisuser';
$password = 'password';

try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $sql = 'SELECT * FROM users WHERE name=:name AND pass=:pass';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
  $stmt->bindValue(':pass', hash('sha256', $_POST['password']), PDO::PARAM_STR);

  $stmt->execute();

  if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['id'] = $row['id'];
    header('location:index.php');
    exit();
  } else {
    header('location:login.php');
    exit();
  }
} catch (PDOException $e) {
  $dirname = 'log/';
  $filename = 'error.txt';
  $now = date('Y-m-d H:m:s');
  if (!file_exists($dirname)) {
    mkdir($dirname);
  }
  $msg = '[' . $now . ']' . $e->getMessage() . "\n";
  file_put_contents($dirname . $filename, $msg, FILE_APPEND);
}
