<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>確認画面</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div id="inquiry">
    <h2>確認画面</h2>
    <?php
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


    $inquiry_option_id  = htmlspecialchars( $inquiry_option_id);
    $student_name =htmlspecialchars($student_name);
    $student_name_ruby =htmlspecialchars($student_name_ruby);
    $email =htmlspecialchars($email);
    $tel =htmlspecialchars($tel);
    $school_id =htmlspecialchars($school_id);
    $faculty =htmlspecialchars($faculty);
    $department =htmlspecialchars($department);
    $graduate_year =htmlspecialchars($graduate_year);
    $postal_code =htmlspecialchars($postal_code);
    // $pref_id =htmlspecialchars($pref_id);
    $address =htmlspecialchars($address);
    $building =htmlspecialchars($building);
    $optional_comment =htmlspecialchars($optional_comment);

    echo '<ul>' . "\n";
    echo '<li>';
    if ($student_name == '') {
      echo 'お名前が入力されていません。<br>' . "\n";
    } else {
      echo 'お名前：' . $student_name . '<br>' . "\n";
    }
    echo '</li>' . "\n";
    echo '<li>';
    if ($email == '') {
      echo 'メールアドレスが、入力されていません。<br>' . "\n";
    } else {
      echo 'メールアドレス：' . $email . '<br>' . "\n";
    }
    echo '</li>' . "\n";



    if ($student_name == '' || $email == '' ) {
      echo '<p>未記入の項目があります。「<span class="deco">戻る</span>」ボタンをクリックしてください。</p>' . "\n";
      echo '<div class="submit">' . "\n";
      echo '<form>' . "\n";
      echo '<input type="button" onClick="history.back()" value="戻る">' . "\n";
      echo '</form>' . "\n";
      echo '</div>' . "\n";
    } else {
      echo '<p>以上の内容を送信します。よろしければ「<span class="deco">送信</span>」ボタンを、修正する場合は「<span class="deco">戻る</span>」ボタンをクリックしてください。</p>' . "\n";
      echo '<div class="submit">' . "\n";
      echo '<form action="thanks.php" method="post">' . "\n";
      echo '<input type="hidden" name="inquiry_option_id" value="' . $inquiry_option_id . '">';
      echo '<input type="hidden" name="student_name" value="' . $student_name . '">';
      echo '<input type="hidden" name="student_name_ruby" value="' . $student_name_ruby . '">';
      echo '<input type="hidden" name="email" value="' . $email . '">';
      echo '<input type="hidden" name="tel" value="' . $tel . '">';
      echo '<input type="hidden" name="school_id" value="' . $school_id . '">';
      echo '<input type="hidden" name="faculty" value="' . $faculty . '">';
      echo '<input type="hidden" name="department" value="' . $department . '">';
      echo '<input type="hidden" name="graduate_year" value="' . $graduate_year . '">';
      echo '<input type="hidden" name="postal_code" value="' . $postal_code . '">';
      echo '<input type="hidden" name="pref_id" value="' . $pref_id . '">';
      echo '<input type="hidden" name="address" value="' . $address . '">';
      echo '<input type="hidden" name="building" value="' . $building . '">';
      echo '<input type="hidden" name="optional_comment" value="' . $optional_comment . '">';
      echo '<input type="button" onClick="history.back()" value="戻る">' . "\n";
      echo '<input type="submit" value="送信">' . "\n";
      echo '</form>' . "\n";
      echo '</div>' . "\n";
    }
    ?>
  </div>
</body>

</html>
