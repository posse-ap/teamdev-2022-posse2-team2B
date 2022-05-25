<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 8);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['請求日', '請求額', '対象月'],
  'tr' => array()
]);
$agent_id = $_SESSION['agent_id'];
$trs_stmt = $db->query(
  "SELECT
    DATE_FORMAT(students.created_at, '%Y-%m') as `month`,
    COUNT(*) as count
  FROM
    inquired_agents
  LEFT JOIN
    students
  ON
    inquired_agents.student_id=students.id
  WHERE
    inquired_agents.agent_id = $agent_id
  GROUP BY
    `month`"
);
$trs = $trs_stmt->fetchAll();

foreach ($trs as $tr) :
  $date_tmp = $tr['month'] . '-10';
  $date = new DateTime($date_tmp);
  $date->modify('+1 months');
  array_push($pgdata['table_data']['tr'], [$date->format('Y-m-d'), $tr['count'] * 10000, $tr['month']]);
endforeach;

$month_stmt = $db->prepare(
  "SELECT
    DATE_FORMAT(students.created_at, '%Y-%m') AS `month`,
    COUNT(*) AS count
  FROM
    inquired_agents
  LEFT JOIN
    students
  ON
    inquired_agents.student_id=students.id
  WHERE
    DATE_FORMAT(students.created_at, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')
    AND inquired_agents.agent_id = $agent_id
  GROUP BY
    `month`"
);
$month_stmt->execute();
$month = $month_stmt->fetch()['count'];



require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");
include(dirname(__FILE__) . "/parts/templates/_list-template.php");
