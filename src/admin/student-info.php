<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 4);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['氏名', 'メールアドレス', '電話番号', '住所', '大学名', '学部', '学科', '卒業年', '問い合わせ内容', '自由記述欄']
]);

$student_id = $_GET['id'];

// テーブルに追加するデータ
$trs_stmt = $db->query(
  "SELECT
    student_name,
    email,
    tel,
    CONCAT(
    pref_id,
    address,
    building)as fulladdress,
    school_id,
    faculty,
    department,
    graduate_year,
    inquiry_option_id,
    optional_comment
    FROM
      students
      WHERE
      id = $student_id"
);
$trs = $trs_stmt->fetch(PDO::FETCH_ASSOC);
$pgdata['table_data']['tr'] = $trs;

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_detail-template.php");
