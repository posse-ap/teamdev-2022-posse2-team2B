<?php

function f_select_agent($agent_id)
{
  global $db;
  $agent = $db->prepare("SELECT * FROM agents WHERE id = ?");
  $agent->execute([$agent_id]);
  $agent = $agent->fetch();
  return $agent;
}

function f_set_evals($agent_id)
{
  $agent = f_select_agent($agent_id);
  $evals = array(
    ['title' => '評価項目１', 'star' => $agent['evaluation1']],
    ['title' => '評価項目２', 'star' => $agent['evaluation2']],
    ['title' => '評価項目３', 'star' => $agent['evaluation3']],
  );
  return $evals;
}

// IDで指定したエージェントの情報を取得
function f_select_agent_detail($agent_id)
{
  global $db;
  $agent_stmt = $db->prepare(
    "SELECT
    DISTINCT(agents.id) AS id,
    agent_name,
    updated_at,
    expires_at,
    publication,
    evaluation1,
    evaluation2,
    evaluation3,
    paragraph1,
    paragraph2,
    paragraph3,
    paragraph4,
    url
  FROM
    agents
  WHERE
    expires_at > NOW() && publication = 1 && id = ?"
  );
  $agent_stmt->execute([$agent_id]);
  $agent = $agent_stmt->fetch();
  return $agent;
}

function f_register_student($student)
{
  global $db;
  $insert_stmt = $db->prepare(
    "INSERT INTO
      students (inquiry_option_id, student_name, student_name_ruby, email, tel, univ, faculty, department, graduate_year, postal_code, address, optional_comment)
    VALUES
      (:inquiry_option_id, :student_name, :student_name_ruby, :email, :tel, :univ, :faculty, :department, :graduate_year, :postal_code, :address, :optional_comment)"
  );
  $insert_stmt->execute([
    ':inquiry_option_id' => $student['inquiry_option_id'],
    ':student_name' => $student['student_name'],
    ':student_name_ruby' => $student['student_name_ruby'],
    ':email' => $student['email'],
    ':tel' => $student['tel'],
    ':univ' => $student['univ'],
    ':faculty' => $student['faculty'],
    ':department' => $student['department'],
    ':graduate_year' => $student['graduate_year'],
    ':postal_code' => $student['postal_code'],
    ':address' => $student['address'],
    ':optional_comment' => $student['optional_comment']
  ]);
}
