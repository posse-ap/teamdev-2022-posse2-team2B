<?php
require(dirname(__FILE__) . "/dbconnect.php");

// 掲載期間内かつ公開設定1(公開)である全エージェント情報を取得
$agents_stmt = $db->query("SELECT * FROM agents WHERE expires_at > NOW() && publication = 1");
$agents = $agents_stmt->fetchAll();

// 全タグカテゴリを取得
$tag_categories_stmt = $db->query("SELECT * FROM tag_categories");
$tag_categories = $tag_categories_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>トップ</title>
  <link rel="stylesheet" href="style/header/header.css">
  <link rel="stylesheet" href="style/reset.css">
  <script src="https://kit.fontawesome.com/a60c81f350.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- system -->
  <?php
  // エージェントごとに項目を取得
  foreach ($agents as $agent) :
    $agent_name = $agent['agent_name'];
    $created_at = $agent['created_at'];
    $updated_at = $agent['updated_at'];
    $expires_at = $agent['expires_at'];
    $publication = $agent['publication'];
    $eval1 = $agent['evaluation1'];
    $eval2 = $agent['evaluation2'];
    $eval3 = $agent['evaluation3'];
    $para1 = $agent['paragraph1'];
    $para2 = $agent['paragraph2'];
    $para3 = $agent['paragraph3'];
    $para4 = $agent['paragraph4'];
    $agent_info = sprintf('エージェント会社名:%s, 作成日時:%s, 最終更新日時:%s, 掲載終了日時:%s, 公開設定:%d, [評価項目1]:%d, [評価項目2]:%d, [評価項目3]:%d, [文章1]:%s, [文章2]:%s, [文章3]:%s, [文章4]:%s', $agent_name, $created_at, $updated_at, $expires_at, $publication, $eval1, $eval2, $eval3, $para1, $para2, $para3, $para4);
  ?>
    <p><?= $agent_info; ?></p>
  <?php
  endforeach;
  ?>


<?php
  require(dirname(__FILE__) . "/parts/header.php");
  ?>



  <!-- 検索フォーム -->
  <form action="./result.php" method="POST">
    <?php
    foreach ($tag_categories as $tag_category) :
      $tags_stmt = $db->prepare("SELECT * FROM tags WHERE tag_category_id = ?");
      $tags_stmt->execute([$tag_category['id']]);
      $tags = $tags_stmt->fetchAll();
    ?>
      <h3><?= $tag_category['tag_category_name'] ?></h3>
      <?php
      foreach ($tags as $tag) :
      ?>
        <label>
          <input type="checkbox" name="tags[]" value="<?= $tag['id']; ?>">
          <?= $tag['tag_name']; ?>
        </label>
    <?php
      endforeach;
    endforeach;
    ?>
    <p>
      <input type="submit" value="検索" name="search">
    </p>
  </form>
  <!-- system end -->



</body>

</html>
