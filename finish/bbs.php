<?php
// クッキーの読み込み
if (isset($_COOKIE['name'])) {
  $name = $_COOKIE['name'];
} else {
  $name = '';
}

// 1ページあたりに表示する投稿数
$num = 10;

$dsn = 'mysql:host=localhost;dbname=tennis_plus;charset=utf8';
$user = 'tennisuser';
$password = 'password';

// 表示するページの初期化
$page = 1;
// 1ページ目以外を表示する場合、該当するページ数を代入
if (isset($_GET['page']) && $_GET['page'] > 1) {
  $page = intval($_GET['page']);
}

try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $sql = 'SELECT * FROM bbs ORDER BY date DESC LIMIT :page,:num';
  $stmt = $db->prepare($sql);
  // 表示する最初の投稿を指定(例: 2ページ目->結果セットの20番目から表示)
  $page = ($page - 1) * $num;
  $stmt->bindValue(':page', $page, PDO::PARAM_INT);
  $stmt->bindValue(':num', $num, PDO::PARAM_INT);

  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $dirname = 'log/';
  $filename = 'error.txt';
  $now = date('Y-m-d H:m:s');
  if (!file_exists($dirname)) {
    mkdir($dirname);
  }
  $msg = '[' . $now . ']' . $e->getMessage() . "\n";
  file_put_contents($dirname . $filename, $msg, FILE_APPEND);
  header('location:bbs.php');
  exit();
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

      <h1 class="my-5">掲示板</h1>
      <form action="write.php" method="post">
        <div class="form-group mt-3">
          <label for="titile">タイトル</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group mt-3">
          <label for="name">名前</label>
          <input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>">
        </div>
        <div class="form-group mt-3">
          <label for="body">本文</label>
          <textarea name="body" id="body" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group mt-3">
          <label for="pass">削除パスワード(数字4桁)</label>
          <input type="text" name="pass" id="pass" class="form-control">
        </div>
        <input type="submit" value="書き込む" class="btn btn-primary mt-3">
      </form>

      <hr>
      <?php foreach ($result as $row): ?>
        <div class="card">
          <div class="card-header">
            <?php echo $row['title']; ?>
          </div>
          <div class="card-body">
            <p class="card-text">
              <?php echo $row['body']; ?>
            </p>
          </div>
          <div class="card-footer">
            <form action="delete.php" method="post" class="form-inline">
              <?php echo $row['name']; ?> (<?php echo $row['date']; ?>)
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <div class="row mt-2 g-2">
                <div class="col-2"><input type="text" name="pass" id="pass" placeholder="削除用パスワード" class="form-control"></div>
                <div class="col-1"><input type="submit" value="削除" class="btn btn-secondary"></div>
              </div>
            </form>
          </div>
        </div>
        <hr>
      <?php endforeach; ?>

      <?php
      // ページネーション
      try {
        $sql = 'SELECT COUNT(*) FROM bbs';
        $stmt = $db->prepare($sql);
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
        header('location:bbs.php');
        exit();
      }

      $comments = $stmt->fetchColumn();
      $max_page = ceil($comments / $num);
      if ($max_page >= 1):
      ?>
        <nav>
          <ul class="pagination">
            <?php for ($i = 1; $i <= $max_page; $i++): ?>
              <li class="page-item"><a class="page-link" href="bbs.php?page=<?php echo $i; ?>"> <?php echo $i; ?></a></li>
            <?php endfor; ?>
          </ul>
        </nav>
      <?php endif; ?>
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