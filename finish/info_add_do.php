<?php
if (!empty($_POST)) {
  // 必須項目が空じゃなかった場合
  if (!empty($_POST['title']) || !empty($_POST['author']) || !empty($_POST['body'])) {
    $id = uniqid();
    $title = $_POST['title'];
    $date = $_POST['date'] ?: date('Y-m-d');
    $author = $_POST['author'];
    $body = $_POST['body'];

    $data_array = [$id, $title, $date, $author, $body];

    $dir = 'info/';
    $base_filename = 'info';
    $filename = $dir . $base_filename . '.csv';
    $fp = fopen($filename, 'a');
    if ($fp) {
      fputcsv($fp, $data_array);
    }
    fclose($fp);
  }
}

header('location:./info_add.php');
exit();
