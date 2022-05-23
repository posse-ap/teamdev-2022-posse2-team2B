<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>確認画面</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div id="inquiry">
    <?php
    require(dirname(__FILE__) . "/dbconnect.php");



    $inquiry_option_id  = $_POST['inquiry_option_id'];
    $student_name = $_POST['student_name'];
    $student_name_ruby = $_POST['student_name_ruby'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $school_id = $_POST['school_id'];
    $faculty = $_POST['faculty'];
    $department = $_POST['department'];
    $graduate_year = $_POST['graduate_year'];
    $postal_code = $_POST['postal_code'];
    $pref_id = $_POST['pref_id'];
    $address = $_POST['address'];
    $building = $_POST['building'];
    $optional_comment = $_POST['optional_comment'];




    // $name = htmlspecialchars($name);
    // $email = htmlspecialchars($email);
    // $message = htmlspecialchars($message);

    echo $student_name . '様<br>' . "\n";
    echo 'お問い合わせ内容『' . $inquiry_option_id . '』を<br>' . "\n";
    echo $email . 'にメールで送りましたのでご確認ください。' . "\n";

    $mail_sub = 'お問い合わせを受け付けました。';
    $mail_body = $student_name . '様、ご協力ありがとうございました。';
    $mail_body = html_entity_decode($mail_body, ENT_QUOTES, "UTF-8");
    $mail_head = 'From:xxx@gmail.com';
    mb_language('Japanese');
    mb_internal_encoding("UTF-8");
    mb_send_mail($email, $mail_sub, $mail_body, $mail_head);

    $sql = 'INSERT INTO students(
    inquiry_option_id,
    student_name,
    student_name_ruby,
    email,
    tel,
    school_id,
    faculty,
    department,
    graduate_year,
    postal_code,
    pref_id,
    address,
    building,
    optional_comment)
    VALUES(
    :inquiry_option_id,
    :student_name,
    :student_name_ruby,
    :email,
    :tel,
    :school_id,
    :faculty,
    :department,
    :graduate_year,
    :postal_code,
    :pref_id,
    :building,
    :address,
    :optional_comment)';
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        'inquiry_option_id' => $inquiry_option_id,
        'student_name' => $student_name,
        'student_name_ruby' => $student_name_ruby,
        'email' => $email,
        'tel' => $tel,
        'school_id' => $school_id,
        'faculty' => $faculty,
        'department' => $department,
        'graduate_year' => $graduate_year,
        'postal_code' => $postal_code,
        'pref_id' => $pref_id,
        'building' => $building,
        'address' => $address,
        'optional_comment' => $optional_comment
      )
    );

    // $pdo = null;
    ?>
    <ul>
      <li><a href="index.php">トップページに戻る</a></li>
    </ul>
  </div>
</body>

</html>
