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
  'th' => ['請求日', '請求額', '対象月',],
  'tr' => array()
]);
$agent_id = $_SESSION['agent_id'];
$trs_stmt = $db->query(
  "SELECT DATE_FORMAT(inquired_agents.created_at, '%Y-%m') as `created_at`,
  COUNT(*) as count
FROM
    inquired_agents
    LEFT JOIN
students
    ON
      inquired_agents.student_id=students.id
WHERE
    inquired_agents.agent_id = $agent_id
GROUP BY DATE_FORMAT(created_at, '%Y-%m');"
);
$trs = $trs_stmt->fetchAll();
$sum_count = 0;
foreach ($trs as $tr) :
  $sum_count += $tr['count'];
  array_push($pgdata['table_data']['tr'], ['翌月10日', $tr['count'] * 10000, $tr['created_at']]);
endforeach;
print_r("sumCount=" . $sum_count);
print_r("<br>sumCost=" . $sum_count * 10000);
echo("sumCount=" . $sum_count);
echo("<br>sumCost=" . $sum_count * 10000);


require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");
include(dirname(__FILE__) . "/parts/templates/_list-template.php");
