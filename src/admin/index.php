<?php
session_start();
require(dirname(__FILE__) . "/../dbconnect.php");
require(dirname(__FILE__) . "/parts/login-check.php");

// 権限判定
$right = $_SESSION['right_id'];
$right_name_stmt = $db->prepare("SELECT right_name FROM rights WHERE id = ?");
$right_name_stmt->execute([$right]);
$right_name = $right_name_stmt->fetch()['right_name'];
print_r($right_name);

// page_idの取得 指定なしの場合1とする
if (isset($_GET['page'])) {
  $page_id = $_GET['page'];
} else {
  $page_id = 1;
}

// ナビゲーションに表示するページを取得
$pages_stmt = $db->prepare(
  "SELECT
    page_id,
    page_name,
    page_type
  FROM
    maint_pages
  JOIN maint_page_rights ON maint_pages.id = maint_page_rights.page_id
  WHERE
    on_nav = 1 AND right_id = ?"
);
$pages_stmt->execute([$right]);
$pages = $pages_stmt->fetchAll();

// このページのレコードを取得 (タイトル表示, レイアウト分岐用)
$this_page = $pages[sprintf('%s', array_search($page_id, array_column($pages, 'page_id')))];

// アカウント名を取得 (ヘッダー表示用)
$account_stmt = $db->prepare("SELECT name FROM accounts WHERE id = ?");
$account_stmt->execute([$_SESSION['account_id']]);
$account_name = $account_stmt->fetch()['name'];

// ページのtableタグのthに入れる文字列を取得
$page_cols_stmt = $db->prepare("SELECT * FROM maint_page_cols WHERE maint_page_id = ?");
$page_cols_stmt->execute([$page_id]);
$page_cols = $page_cols_stmt->fetchAll();

// page_idによって表示するデータを変える
include(dirname(__FILE__) . "/parts/_data-select.php");
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this_page['page_name']; ?> | CRAFT <?= $right_name; ?>用ページ</title>
  <link rel="stylesheet" href="./style/header.css">
  <link rel="stylesheet" href="./style/acountinfo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,500;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  include(dirname(__FILE__) . "/parts/_header.php");
  ?>
  <div class="container">
    <div class="area">
      <?php
      include(dirname(__FILE__) . "/parts/_nav.php");
      include(dirname(__FILE__) . "/parts/_logout-btn.php");
      ?>
    </div>
    <div class="area">
      <?php
      include(dirname(__FILE__) . "/parts/_title.php");

      if ($this_page['page_type'] == 'list') {
        include(dirname(__FILE__) . "/parts/_main-list.php");
      } elseif ($this_page['page_type'] == 'info') {
        include(dirname(__FILE__) . "/parts/_main-info.php");
      }

      // include(dirname(__FILE__) . "/parts/_btn.php");
      ?>
    </div>
  </div>

  <script>
  const nowPageId = <?= $page_id; ?>;
  </script>
  <script src="./script/script.js"></script>
</body>

</html>