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
$pgdata += array('agent_picture' => '/pictures/agent1.jpg'); //最終的には画像パスをDBに保存してそこから取得したい
$pgdata += array('paragraphs' => array(
  ['title' => 'タイトル１', 'text' => $agent['paragraph1']],
  ['title' => 'タイトル２', 'text' => $agent['paragraph2']],
  ['title' => 'タイトル３', 'text' => $agent['paragraph3']],
  ['title' => 'タイトル４', 'text' => $agent['paragraph4']],
));

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_detail.php');


?>
