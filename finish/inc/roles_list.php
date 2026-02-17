<?php
require_once __DIR__ . '/../func/functions.php';
try {
} catch (PDOException $e) {
  echo 'エラー:' . $e->getMessage();
}
