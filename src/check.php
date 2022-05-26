<?php
require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/app/functions.php');

if(!isset($_POST['inq_agents'])) {
  echo 'エラー';
  exit();
}

$inq_agents = explode(',', $_POST['inq_agents']);
$in_clause = substr(str_repeat(',?', count($inq_agents)), 1);
$agent_names = $db->prepare(sprintf("SELECT agent_name FROM agents WHERE id IN (%s)", $in_clause));
$agent_names->execute([...$inq_agents]);
$agent_names = $agent_names->fetchAll();
$agent_names = array_map(function ($v) {
  return $v['agent_name'];
}, $agent_names);

$pgdata = array();
$pgdata += array('page_title' => '確認画面');
$pgdata += array('disp_data' => array(
  ['name' => 'お問い合せ先エージェント', 'value' => nl2br(implode("\n", $agent_names))],
  ['name' => 'お問い合せ内容', 'value' => $_POST['inq_radio']],
  ['name' => '名前(フリガナ)', 'value' => $_POST['inq_name'] . '(' . $_POST['inq_nameruby'] . ')'],
  ['name' => '生年月日', 'value' => f_date_format_hyphen2kanji($_POST['inq_birthday'])],
  ['name' => '性別', 'value' => f_sex_num2kanji($_POST['inq_sex'])],
  ['name' => 'メールアドレス', 'value' => $_POST['inq_email']],
  ['name' => '電話番号', 'value' => $_POST['inq_tel']],
  ['name' => '大学情報', 'value' => sprintf(nl2br("大学名: %s\n学部・学科: %s %s"), $_POST['inq_univ'], $_POST['inq_faculty'], $_POST['inq_department'])],
  ['name' => '卒業年', 'value' => $_POST['inq_graduation']],
  ['name' => '住所', 'value' => sprintf(nl2br("〒%s-%s\n%s %s %s"), substr($_POST['inq_postalcode'], 0, 3), substr($_POST['inq_postalcode'], 3, 4), $_POST['inq_pref'], $_POST['inq_address'], $_POST['inq_bldg'])],
  ['name' => '自由記述欄', 'value' => $_POST['inq_free']],
  ['name' => 'プライバシーポリシーへの同意', 'value' => $_POST['inq_agree']]
));
$pgdata += array('send_data' => array(
  'inquired_agents' => $_POST['inq_agents'],
  'inquiry_option_id' => $_POST['inq_radio'],
  'student_name' => $_POST['inq_name'],
  'student_name_ruby' => $_POST['inq_nameruby'],
  'birthday' => $_POST['inq_birthday'],
  'sex' => $_POST['inq_sex'],
  'email' => $_POST['inq_email'],
  'tel' => $_POST['inq_tel'],
  'univ' => $_POST['inq_univ'],
  'faculty' => $_POST['inq_faculty'],
  'department' => $_POST['inq_department'],
  'graduate_year' => $_POST['inq_graduation'],
  'postal_code' => $_POST['inq_postalcode'],
  'address' => $_POST['inq_pref'] . $_POST['inq_address'] . $_POST['inq_bldg'],
  'optional_comment' => $_POST['inq_free']
));

// トークンを生成し、sessionに保存、フォーム送信時にPOSTでthanks.phpにトークンが送られる
$pgdata += array('token' => f_generate_token());

// データ送信
f_submit_form(['action' => 'thanks.php', 'method' => 'POST', 'id' => 'checkForm'], $pgdata['send_data'], $pgdata['token']);

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_check.php');
