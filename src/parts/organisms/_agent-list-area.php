<?php
a_section_start('掲載エージェント一覧');
?>
これはトップページの掲載エージェント一覧です。
<?php
foreach ($agents as $agent) {
  $agent_name = $agent['agent_name'];
  $agent_id = $agent['id'];
  $agent_intro = $agent['paragraph1']; //TODO 紹介文用のカラムを追加して置き換える
  $tags_stmt = $db->prepare("SELECT * FROM agent_tags LEFT JOIN tags ON agent_tags.tag_id = tags.id WHERE agent_tags.agent_id = ?");
  $tags_stmt->execute([$agent_id]);
  $tags = $tags_stmt->fetchAll();
  include(dirname(__FILE__) . '/../organisms/_agent-card.php');
}
// ↑繰り返し文で生成していく。多分。

a_section_end();

?>
