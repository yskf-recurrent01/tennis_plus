<?php
$dir = 'info/';
$base_filename = 'info';
$filename = $dir . $base_filename . '.csv';
$fp = fopen($filename, 'r');

$info_array = array();
if ($fp) {
  while ($row = fgetcsv($fp)) {
    $info_array[] = [$row[0], $row[1], $row[2]];
  }
}
fclose($fp);
// 投稿日の降順に並べ替え
if (!empty($info_array)) {
  $dates = array_column($info_array, 2);
  array_multisort($dates, SORT_DESC, $info_array);
}
?>
<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <?php include('navbar.php');  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->

      <h1 class="my-5">お知らせ</h1>
      <a href="info_add.php">お知らせ新規登録</a>
      <ul class="list-group my-3">
        <?php if (count($info_array) > 0): foreach ($info_array as $info): ?>
            <li class="list-group-item py-3">
              <a class="post-link" href="info.php?id=<?php echo $info[0]; ?>">
                <time class="post-date" datetime="<?php echo $info[2]; ?>"><?php echo date('Y.m.d', strtotime($info[2])); ?></time>
                <span class="post-title"><?php echo $info[1]; ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <p>お知らせはありません。</p>
        <?php endif; ?>
      </ul>

      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>