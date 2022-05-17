<?php

require(dirname(__FILE__) . "/dbconnect.php");

$agent_stmt = $db->prepare("SELECT * FROM agents WHERE expires_at > NOW() && publication = 1 && id = ?");
$agent_stmt->execute([$_GET['id']]);
$agent = $agent_stmt->fetch();
print_r($agent);

$pgdata = array();
$pgdata += array('page_title' => 'エージェント詳細ページ');

$pgdata += array('agent' => $agent);
$pgdata += array('id' => $_GET['id']);
$pgdata += array('agent_name' => $agent['agent_name']);


// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_detail.php');


?>