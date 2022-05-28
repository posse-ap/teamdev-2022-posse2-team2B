<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 0);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['申込日時', '氏名', 'メールアドレス', '電話番号', '卒業年', '詳細'],
  'tr' => array()
]);




if ($_SESSION['right_id'] != 1) {
  $trs_stmt = $db->query(
    "SELECT
    created_at, student_name, email, tel, graduate_year,id
  FROM
    students"
  );
} else {
  $agent_id = $_SESSION['agent_id'];
  $student_id = $_GET['id'];
  // テーブルに追加するデータ
  $trs_stmt = $db->query(
    "SELECT
      created_at, student_name, email, tel, graduate_year,students.id
    FROM
      inquired_agents
    LEFT JOIN
      students
    ON
      inquired_agents.student_id= students.id
    WHERE
      inquired_agents.agent_id = $agent_id"
  );
}
$trs = $trs_stmt->fetchAll();
foreach ($trs as $tr) :
  array_push($pgdata['table_data']['tr'], [$tr['created_at'], $tr['student_name'], $tr['email'], $tr['tel'], $tr['graduate_year'], '<a href="student-info.php?id=' . $tr["id"] . '" target="" class="link">詳細</a>']);
endforeach;

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_list-template.php");
