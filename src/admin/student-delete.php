<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 0);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['氏名', 'メールアドレス', '電話番号', '住所', '大学名', '学部', '学科', '卒業年', '問い合わせ内容', '自由記述欄']
]);

$student_id = $_GET['id'];


try {
  $db->beginTransaction();
  // テーブルに追加するデータ
  $db->query(
    "DELETE FROM students WHERE id=$student_id;"
  );
  $db->commit();
  echo "完了";
} catch (\Throwable $th) {
  //throw $th;
  $db->rollBack();
  echo "失敗".$th->getMessage();
}
?>

<a href="../admin/student-info.php"></a>
