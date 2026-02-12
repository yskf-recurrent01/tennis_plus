<?php
// TODO: CSV読み込み処理

$info_array = array();

// TODO: ソート処理
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
        <!-- TODO: 記事一覧を表示する -->
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