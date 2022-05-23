<?php
require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/app/functions.php');

if(!isset($_POST['inq_agents'])) {
  echo 'エラー';
  exit();
}

$agent_names = $db->prepare("SELECT agent_name FROM agents WHERE id IN (?)");
$agent_names->execute([$_POST['inq_agents']]);
$agent_names = $agent_names->fetchAll();
$agent_names = array_map(function ($v) {
  return $v['agent_name'];
}, $agent_names);

$pgdata = array();
$pgdata += array('page_title' => '確認画面');
$pgdata += array('input_data' => array(
  ['name' => 'お問い合せ先エージェント', 'value' => nl2br(implode("\n", $agent_names))],
  ['name' => 'お問い合せ内容', 'value' => $_POST['inq_radio']],
  ['name' => '名前(フリガナ)', 'value' => $_POST['inq_name'] . '(' . $_POST['inq_nameruby'] . ')'],
  ['name' => 'メールアドレス', 'value' => $_POST['inq_email']],
  ['name' => '電話番号', 'value' => $_POST['inq_tel']],
  ['name' => '大学情報', 'value' => sprintf(nl2br("大学名: %s\n学部・学科: %s %s"), $_POST['inq_univ'], $_POST['inq_faculty'], $_POST['inq_department'])],
  ['name' => '卒業年', 'value' => $_POST['inq_graduation']],
  ['name' => '住所', 'value' => sprintf(nl2br("〒%s-%s\n%s %s %s"), substr($_POST['inq_postalcode'], 0, 3), substr($_POST['inq_postalcode'], 3, 4), $_POST['inq_pref'], $_POST['inq_address'], $_POST['inq_bldg'])],
  ['name' => '自由記述欄', 'value' => $_POST['inq_free']],
  ['name' => 'プライバシーポリシーへの同意', 'value' => $_POST['inq_agree']]
));

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_check.php');
