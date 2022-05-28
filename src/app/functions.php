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

function f_select_student($student_id)
{
  global $db;
  $student = $db->prepare("SELECT * FROM students WHERE id = ?");
  $student->execute([$student_id]);
  $student = $student->fetch();
  return $student;
}

function f_select_inquiry_option($inquiry_option_id)
{
  global $db;
  $inquiry_option = $db->prepare("SELECT  * FROM inquiry_options WHERE id = ?");
  $inquiry_option->execute([$inquiry_option_id]);
  $inquiry_option = $inquiry_option->fetch();
  return $inquiry_option;
}

function f_student_id2inq_agent_id($student_id)
{
  global $db;
  $inq_agents = $db->prepare("SELECT * FROM inquired_agents WHERE student_id = ?");
  $inq_agents->execute([$student_id]);
  $inq_agents = $inq_agents->fetchAll();
  $ids = array_map(function ($agent) {
    return $agent['agent_id'];
  }, $inq_agents);
  return $ids;
}

//　[SQL] WHERE xx IN (?, ?, ...)の?, ?, ...の部分を$arrayの長さぶん生成
function f_in_clause($array)
{
  return substr(str_repeat(',?', count($array)), 1);
}

function f_set_evals($agent_id)
{
  $agent = f_select_agent($agent_id);
  $evals = array(
    ['title' => '求人の多さ', 'star' => $agent['evaluation1']],
    ['title' => 'サービスの充実度', 'star' => $agent['evaluation2']],
    ['title' => 'コンサルタントの質', 'star' => $agent['evaluation3']]
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

function f_select_tags() {
  global $db;
  $tags = $db->query("SELECT tag_name, tag_category_name, tags.id AS tag_id, tag_category_id FROM tags LEFT JOIN tag_categories ON tag_category_id = tag_categories.id");
  $tags =$tags->fetchAll();
  return $tags;
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
    foreach ($data as $name => $value) {
      f_input(['type' => 'hidden', 'name' => $name, 'value' => $value]);
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
    return $student_id;
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

// 学生にメール送信
// $student = ['id' => id, 'date' => 'yyyy年mm月dd日', 'name' => '名前', 'ruby' => 'フリガナ' 'birthday' => 'yyyy年mm月dd日', 'sex' => 'x性', 'email' => 'example@email.com', 'tel' => '09012345678', 'univ' => 'xx大学xx学部xx学科', 'graduation' => 'yyyy年', 'address' => '〒xxx-xxxx xx県xx市xx町xx', 'option' => 'お問い合わせ内容', 'comment' => '自由記述欄の内容']
// $agents = [['name' => 'エージェント名', 'address' => '〒xxx-xxxx xx県xx市xx町xx', 'email' => 'example@email.com', 'tel' => '03-xxxx-xxxx', 'url' => 'https://example.com', 'notification_email' => 'example@email.com'], ...]
function f_mail2student($student, $agents)
{
  $to = $student['email'];
  $subject = "お問い合わせありがとうございます";
  $message = $student['name'] . " 様\n\n";
  $message .= "就活.com エージェント比較サービスをご利用いただきまして、誠にありがとうございます。
下記の内容でお問い合わせを承りました。
エージェント会社からの連絡をお待ちください。

-------------------------------------------\n\n";
  $message .= "お問い合わせ番号： " . $student['id'] . "\n";
  $message .= "お問い合わせ日時： " . $student['date'] . "\n";
  $message .= "お名前(フリガナ): " . $student['name'] . "(" . $student['ruby'] . ")" . "\n";
  $message .= "生年月日: " . $student['birthday'] . "\n";
  $message .= "性別: " . $student['sex'] . "\n";
  $message .= "メールアドレス: " . $student['email'] . "\n";
  $message .= "電話番号: " . $student['tel'] . "\n";
  $message .= "大学: " . $student['univ'] . "\n";
  $message .= "卒業年度: " . $student['graduation'] . "\n";
  $message .= "住所: " . $student['address'] . "\n";
  $message .= "お問い合わせ内容: " . $student['option'] . "\n";
  $message .= "自由記述欄: " . $student['comment'] . "\n\n";
  $message .= "--------------------------------------------

【お問い合わせいただいたエージェント会社】\n\n";

  foreach ($agents as $agent) {
    $message .= "====" . $agent['name'] . "====\n";
    $message .= "所在地: " . $agent['address'] . "\n";
    $message .= "メールアドレス: " . $agent['email'] . "\n";
    $message .= "電話番号: " . $agent['tel'] . "\n";
    $message .= "URL: " . $agent['url'] . "\n\n";
  }

  $message .= "--------------------------------------------

もし内容に誤りがある場合、下記メールアドレスまでご連絡ください。

就活.comでは就職活動に関する有益な情報を発信しています。詳しくは【 http://localhost:80 】をチェック！

◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆
【会社情報】
株式会社boozer
住所:  〒107-0062 東京都港区南青山３丁目１５−９ MINOWA表参道 3階
メールアドレス: info@shukatsu.com
電話番号: 03-6885-6140
FAX: 03-6885-6140
URL: http://localhost:80
営業時間: 平日 9時～18時
◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆";

  $headers = "From: info@shukatsu.com";

  mb_send_mail($to, $subject, $message, $headers);
}

function f_mail2agent($agent)
{
  $to = $agent['notification_email'];
  $subject = "CRAFTから新しいお問い合わせがございます。";
  $message = $agent['name'] . " 担当者様

お世話になっております。株式会社boozerです。

この度、学生からのお問い合わせがありました。
CRAFT管理画面より新着のお問い合わせの確認をお願いいたします。
お問い合わせに関して、ご不明点等ありましたら以下の連絡先までお問い合わせくださいませ。

今後ともよろしくお願いいたします。

※このメールは自動送信メールです。

◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆
【会社情報】
株式会社boozer
住所:  〒107-0062 東京都港区南青山３丁目１５−９ MINOWA表参道 3階
メールアドレス: info@shukatsu.com
電話番号: 03-6885-6140
FAX: 03-6885-6140
URL: http://localhost:80
営業時間: 平日 9時～18時
◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆";
  $headers = "From: info@shukatsu.com";
  mb_send_mail($to, $subject, $message, $headers);
}
