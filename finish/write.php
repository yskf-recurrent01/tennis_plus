<?php
date_default_timezone_set('Asia/Tokyo');
$name = $_POST['name'];
$title = $_POST['title'];
$body = $_POST['body'];
$pass = $_POST['pass'];

if ($name === '' | $body === '') {
  header('location:bbs.php');
  exit();
}

if (!preg_match('/^[0-9]{4}$/', $pass)) {
  header('location:bbs.php');
  exit();
}
// クッキーのセット
setcookie('name', $name, time() + 60 * 60 * 24 * 30);

$dsn = 'mysql:host=localhost;dbname=tennis_plus;charset=utf8';
$user = 'tennisuser';
$password = 'password';


try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $sql = 'INSERT INTO bbs (name,title,body,date,pass) VALUES (:name,:title,:body,now(),:pass)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':title', $title, PDO::PARAM_STR);
  $stmt->bindValue(':body', $body, PDO::PARAM_STR);
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
