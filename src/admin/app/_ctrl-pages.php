<?php
// show_nav ... ナビゲーションに表示するか
// right ... 1: エージェント会社担当者様, 2: 共同管理者, 3: 管理者
$pages = array(
  0 => [
    'title' => '学生情報一覧',
    'name' => 'students.php',
    'show_nav' => true,
    'right' => [1, 2, 3]
  ],
  1 => [
    'title' => 'エージェント一覧',
    'name' => 'agents.php',
    'show_nav' => true,
    'right' => [2, 3]
  ],
  2 => [
    'title' => 'アカウント一覧',
    'name' => 'accounts.php',
    'show_nav' => true,
    'right' => [3]
  ],
  3 =>
  [
    'title' => 'アカウント作成・変更',
    'name' => 'account-maint.php',
    'show_nav' => true,
    'right' => [3]
  ],
  4 => [
    'title' => '学生情報詳細',
    'name' => 'student-info.php',
    'show_nav' => false,
    'right' => [1, 2, 3]
  ],
  5 => [
    'title' => 'エージェント情報詳細',
    'name' => 'agent-info.php',
    'show_nav' => false,
    'right' => [2, 3]
  ],
  6 => [
    'title' => 'マイアカウント',
    'name' => 'myaccount.php',
    'show_nav' => true,
    'right' => [2, 3]
  ],
  7 => [
    'title' => '登録情報',
    'name' => 'reg-info.php',
    'show_nav' => true,
    'right' => [1]
  ],
  8 => [
    'title' => '請求情報',
    'name' => 'bill.php',
    'show_nav' => true,
    'right' => [1]
  ],
  9 => [
    'title' => 'エージェント会社登録',
    'name' => 'reg-agent.php',
    'show_nav' => true,
    'right' => [3]
  ]
);
