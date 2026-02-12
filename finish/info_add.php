<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

</head>

<body>

  <?php
  include('navbar.php');
  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->
      <h1 class="my-5">お知らせ - 新規登録</h1>
      <form action="info_add_do.php" method="post" class="needs-validation mb-3" novalidate>
        <div class="mb-3">
          <label for="title" class="form-label">タイトル</label>
          <input type="text" name="title" id="title" class="form-control" required>
          <div class="invalid-feedback">
            お知らせのタイトルを入力してください
          </div>
        </div>
        <div class="mb-3 row">
          <div class="col">
            <label for="date" class="form-label">投稿日</label>
            <input type="date" name="date" id="date" class="form-control">
          </div>
          <div class="col">
            <label for="author" class="form-label">投稿者</label>
            <input type="text" name="author" id="author" class="form-control" required>
            <div class="invalid-feedback">
              投稿者を入力してください
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">本文</label>
          <textarea name="body" id="body" class="form-control" required></textarea>
          <div class="invalid-feedback">
            お知らせの本文を入力してください
          </div>
        </div>
        <div class="mb-3">
          <input type="submit" value="投稿する" class="btn btn-primary">
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
  <script>
    (() => {
      'use strict'

      const forms = document.querySelectorAll('.needs-validation')

      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
</body>

</html>