<?php

function f_attributes_str($attributes)
{
  $html = '';
  foreach ($attributes as $key => $value) {
    $html .= $key . '="' . $value . '" ';
  }
  $html = trim($html);
  return $html;
}

// $attributes = [attribute => value, attribute => value, ...]
function f_input($attributes)
{
  $att = f_attributes_str($attributes);
?>
  <input <?= $att; ?>>
<?php
}

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

// 各種フォーム送信時、トークンを発行し、sessionに保存
function f_generate_token()
{
  session_start();
  $token = uniqid(bin2hex(random_bytes(1)));
  $_SESSION['token'] = $token;
  return $token;
}

function f_check_token()
{
  session_start();
  if (!empty($_POST['token']) && !empty($_SESSION['token']) && $_SESSION['token'] === $_POST['token']) {
    unset($_SESSION['token']);
    return true;
  } else {
    return false;
  }
}

// check.phpからthanks.phpにデータ送信するためのフォーム
function f_submit_form($attributes, $data, $token)
{
  $attributes = f_attributes_str($attributes);
?>
  <form <?= $attributes; ?>>
    <?php
    foreach ($data as $item) {
      f_input(['type' => 'hidden', 'name' => $item['name'], 'value' => $item['value']]);
    }
    ?>
    <input type="hidden" name="token" value="<?= $token; ?>">
  </form>
<?php
}

// 学生情報に与えるidを生成
function f_generate_student_id()
{
  return uniqid(bin2hex(random_bytes(1)));
}

// 学生情報をDBに登録
function f_register_student($student)
{
  global $db;
  // student_idを生成
  $student_id = f_generate_student_id();
  // 問い合わせ先エージェントのidをカンマ区切り文字列から配列に変換
  $inquired_agents = explode(',', $student['inquired_agents']);
  // 学生情報をDBに登録(トランザクション)
  try {
    $db->beginTransaction();
    // studentsテーブルへの登録
    $sql1 =
      "INSERT INTO
      students (id, inquiry_option_id, student_name, student_name_ruby, birthday, sex, email, tel, univ, faculty, department, graduate_year, postal_code, address, optional_comment)
    VALUES
      (:student_id, :inquiry_option_id, :student_name, :student_name_ruby, :birthday, :sex, :email, :tel, :univ, :faculty, :department, :graduate_year, :postal_code, :address, :optional_comment)";
    $insert_students_stmt = $db->prepare($sql1);
    $insert_students_stmt->execute([
      ':student_id' => $student_id,
      ':inquiry_option_id' => $student['inquiry_option_id'],
      ':student_name' => $student['student_name'],
      ':student_name_ruby' => $student['student_name_ruby'],
      ':birthday' => $student['birthday'],
      ':sex' => $student['sex'],
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

    // inquired_agentsテーブルへの登録
    foreach ($inquired_agents as $inquired_agent) {
      $sql2 = "INSERT INTO inquired_agents (student_id, agent_id) VALUES (:student_id, :agent_id)";
      $insert_agents_stmt = $db->prepare($sql2);
      $insert_agents_stmt->execute([
        ':student_id' => $student_id,
        ':agent_id' => $inquired_agent
      ]);
    }
    // エラーなければDB登録確定(コミット)
    $db->commit();
    return true;
  } catch (PDOException $e) {
    // エラー発生時の処理(ロールバック)
    $db->rollBack();
    echo $e->getMessage();
    return false;
  }
}

function f_date_format_hyphen2kanji($date_str)
{
  $date_array = explode('-', $date_str);
  $kanji_date_str = sprintf('%s年%s月%s日', ...$date_array);
  return $kanji_date_str;
}

function f_sex_num2kanji($num)
{
  $sex_array = array('男性', '女性', 'その他', '無回答');
  return $sex_array[$num];
}
