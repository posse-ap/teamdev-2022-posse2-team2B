<?php

require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/app/functions.php');

$agent = f_select_agent_detail($_GET['id']);

// エージェントが存在しないか掲載期間外の場合
if(empty($agent)) {
  echo 'お探しのエージェントは見つかりませんでした。';
  exit();
}

$pgdata = array();
$pgdata += array('page_title' => 'エージェント詳細ページ');
$pgdata += array('agent' => $agent);
$pgdata += array('id' => $_GET['id']);
$pgdata += array('agent_name' => $agent['agent_name']);
$pgdata += array('updated_at' => date('Y年m月d日', strtotime($agent['updated_at'])));
$pgdata += array('agent_picture' => $agent['picture']);
$pgdata += array('paragraphs' => array(
  ['title' => 'こんな就活生にピッタリ', 'text' => $agent['paragraph1']],
  ['title' => '他にはない強み', 'text' => $agent['paragraph2']],
  ['title' => '得意な業種・職種', 'text' => $agent['paragraph3']],
  ['title' => '就活生へのサポート', 'text' => $agent['paragraph4']],
  ['title' => 'エージェント設定のトピック', 'text' => $agent['paragraph5']],
  ['title' => '最後に', 'text' => $agent['paragraph6']],
  ['title' => '管理人からのコメント', 'text' => $agent['paragraph7']],
));

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_detail.php');


?>
