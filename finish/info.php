<?php
if (empty($_GET['id'])) {
  header('location:./');
  exit();
}
$id = $_GET['id'];

$dir = 'info/';
$base_filename = 'info';
$filename = $dir . $base_filename . '.csv';

$target = array();
if ($id && file_exists($filename)) {

  $fp = fopen($filename, 'r');
  if ($fp) {
    while ($row = fgetcsv($fp)) {
      if ($row[0] === $id) {
        $target = $row;
        break;
      }
    }
  }
  fclose($fp);
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
      <?php if ($target): ?>
        <article class="info">
          <header class="info-header">
            <h2 class="info-title"><?php echo $target[1] ?></h2>
            <div class="info-data">
              <time datetime="<?php echo $target[2] ?>"><?php echo date('Y.m.d', strtotime($target[2])); ?></time>
              <p class="m-0"><?php echo $target[3] ?></p>
            </div>
          </header>
          <section class="info-body my-3">
            <p><?php echo nl2br($target[4]); ?></p>
          </section>
        </article>
      <?php else: ?>
        <p>不正なリクエストです。</p>
      <?php endif; ?>
      <p><a href="./">トップページへ戻る</a></p>

      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
</body>

</html>