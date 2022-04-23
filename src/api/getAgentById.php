<?php

// Content-TypeをJSONに指定する
header('Content-Type: application/json');
$dsn = 'mysql:host=db;dbname=shukatsu;charset=utf8;';
$user = 'root';
$password = 'password';

try {
  $db = new PDO($dsn, $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) {
  echo '接続失敗: ' . $e->getMessage();
  exit();
}

$agentId = $_POST["agentId"];
$result_agents_stmt = $db->query(
  "SELECT
    DISTINCT(agents.id) AS agent_id,
    agent_name,
    expires_at,
    evaluation1,
    evaluation2,
    evaluation3,
    paragraph1,
    paragraph2,
    paragraph3,
    paragraph4
  FROM
    agents
  WHERE id = $agentId"
);

$result_agents = $result_agents_stmt->fetchAll();

// 「200 OK」 で {"data":"24歳、学生です"} のように返す
$data = [
  "id"=>$agentId,
  "data1"=>$result_agents[0]["agent_name"],
  "data2"=>"123",
  "data3"=>[
    "data3_1"=>"001",
    "data3_2"=>"1000",
  ]
  ];
echo json_encode(compact('data'));
