<?php
date_default_timezone_set('Asia/Tokyo');
$id = $_POST['id'];
$pass = $_POST['pass'];

if ($id === '' | $pass === '') {
  header('location:bbs.php');
  exit();
}

$dsn = 'mysql:host=localhost;dbname=tennis_plus;charset=utf8';
$user = 'tennisuser';
$password = 'password';

try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $sql = 'DELETE FROM bbs WHERE id = :id AND pass = :pass';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);

  $stmt->execute();
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
header('location:bbs.php');
exit();
