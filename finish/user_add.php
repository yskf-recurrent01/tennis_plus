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

      <h1 class="my-5 text-center">新規ユーザー登録</h1>
      <form action="user_add_do.php" method="post">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6">
            <div class="mb-3">
              <label for="name" class="form-label">名前</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">パスワード</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-5">
              <label for="role" class="form-label">役割</label>
              <select name="role" id="role" class="form-select">
                <option value="1">管理者</option>
                <option value="2" selected>一般</option>
              </select>
            </div>
            <div class="d-grid gap-2">
              <input type="submit" class="btn btn-primary" value="登録する">
            </div>
          </div>
        </div>
      </form>
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