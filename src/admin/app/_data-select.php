<?php
if ($page_id == 1) {
  $data_stmt = $db->query(
    "SELECT
      created_at,
      student_name,
      email,
      tel,
      graduate_year
    FROM
      students"
  );
  $data = $data_stmt->fetchAll();
} elseif(($right == 1 || 2) && $page_id == 2){
  $data_stmt = $db->query(
    "SELECT
      agent_name
    FROM
      agents
    LEFT JOIN agent_contract ON agents.id = agent_contract.agent_id"
  );
  $data = $data_stmt->fetchAll();
} elseif ($right == 2 && $page_id == 3) {
  $data_stmt =$db->query(
    "SELECT
      name,
      email,
      password,
      right_name
    FROM
      accounts
    LEFT JOIN rights ON accounts.right_id = rights.id - 1"
  );
  $data = $data_stmt->fetchAll();
} elseif($right == 1 && $page_id == 4) {
  $data_stmt = $db->query(
    "SELECT
    student_name,
    email,
    tel,
    school_id,
    faculty,
    department,
    graduate_year,
    CONCAT(
    pref_id,
    address,
    building)as fulladdress,
    optional_comment
    FROM
      students"
  );
  $data = $data_stmt->fetchAll();
}
