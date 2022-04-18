<?php
require(dirname(__FILE__) . "/dbconnect.php");

// 掲載期間内かつ公開設定1(公開)である全エージェント情報を取得
$agents_stmt = $db->query("SELECT * FROM agents WHERE expires_at > NOW() && publication = 1");
$agents = $agents_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>トップ</title>
  <link rel="stylesheet" href="style/header.css">
  <link rel="stylesheet" href="style/reset.css">
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
  <!-- system end -->

  <?php
  require(dirname(__FILE__) . "/parts/header.html");
  ?>


</body>

</html>
