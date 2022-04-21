<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php");
require(dirname(__FILE__) . "/app/login-check.php");

$pgdata = array(
  'right_id' => $_SESSION['right_id'],
  'page_id' => 1,
  'page_title' => '学生情報一覧'
);

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");



include(dirname(__FILE__) . "/parts/templates/_list-template.php");
