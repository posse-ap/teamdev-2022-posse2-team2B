<?php

require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/app/functions.php');

if(!isset($_POST)) {
  echo 'データ送信エラー';
  exit();
}

if(!f_check_token()) {
  echo 'アクセスエラー';
  exit();
}

$student_id = f_register_student($_POST);

if($student_id == false) {
  echo 'エラーが発生しました。最初からやり直してください。';
  exit();
}

$pgdata = array();
$pgdata += array('page_title' => '問い合わせ完了');

// 学生にメール送信
// $student = ['id' => id, 'date' => 'yyyy年mm月dd日', 'name' => '名前', 'ruby' => 'フリガナ' 'birthday' => 'yyyy年mm月dd日', 'sex' => 'x性', 'email' => 'example@email.com', 'tel' => '09012345678', 'univ' => 'xx大学xx学部xx学科', 'graduation' => 'yyyy年', 'address' => '〒xxx-xxxx xx県xx市xx町xx', 'option' => 'お問い合わせ内容', 'comment' => '自由記述欄の内容']
// $agents = [['name' => 'エージェント名', 'address' => '〒xxx-xxxx xx県xx市xx町xx', 'email' => 'example@email.com', 'tel' => '03-xxxx-xxxx', 'url' => 'https://example.com'], ...]
$student = f_select_student($student_id);

$pgdata += array('student' => [
  'id' => $student_id,
  'date' => date_format(date_create_from_format('Y-m-d G:i:s', $student['created_at']), 'Y年n月j日 G:i'),
  'name' => $student['student_name'],
  'ruby' => $student['student_name_ruby'],
  'birthday' => date_format(date_create_from_format('Y-m-d', $student['birthday']), 'Y年n月j日'),
  'sex' => f_sex_num2kanji($student['sex']),
  'email' => $student['email'],
  'tel' => $student['tel'],
  'univ' => sprintf('%s%s%s', $student['univ'], $student['faculty'], $student['department']),
  'graduation' => $student['graduate_year'] . '年',
  'address' => sprintf('〒%s %s', $student['postal_code'], $student['address']),
  'option' => f_select_inquiry_option($student['inquiry_option_id']),
  'comment' => $student['optional_comment'],
]);
$pgdata += array('agents' => []);

  $inq_agent_ids = f_student_id2inq_agent_id($student_id);
  $agents = $db->prepare(sprintf("SELECT agent_name AS name, address, email, agents.tel, url FROM agents JOIN agent_contract ON agents.id = agent_id WHERE agents.id IN (%s)", f_in_clause($inq_agent_ids)));
  $agents->execute([...$inq_agent_ids]);
  $agents = $agents->fetchAll();
  $pgdata['agents'] += $agents;



f_mail2student($pgdata['student'], $pgdata['agents']);

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_thanks.php');
