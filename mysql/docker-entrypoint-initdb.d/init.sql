SET
  character_set_client = utf8mb4;

SET
  character_set_connection = utf8mb4;

SET
  character_set_results = utf8mb4;

DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

-- マスタ 問い合わせ関連

DROP TABLE IF EXISTS schools;

CREATE TABLE schools(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  school_name VARCHAR(50) NOT NULL
);

DROP TABLE IF EXISTS prefs;

CREATE TABLE prefs(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  pref_name VARCHAR(10) NOT NULL
);

DROP TABLE IF EXISTS inquiry_options;

CREATE TABLE inquiry_options(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `option` VARCHAR(50)
);

-- マスタ　エージェント関連
DROP TABLE IF EXISTS agents;

CREATE TABLE agents(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_name VARCHAR(50) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  expires_at DATETIME NOT NULL,
  publication INT NOT NULL DEFAULT 1,
  evaluation1 INT,
  evaluation2 INT,
  evaluation3 INT,
  paragraph1 VARCHAR(2000),
  paragraph2 VARCHAR(2000),
  paragraph3 VARCHAR(2000),
  paragraph4 VARCHAR(2000)
);

DROP TABLE IF EXISTS agent_contract;

-- TODO 契約に必要な情報を保持するカラムをさらに追加
CREATE TABLE agent_contract(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  agent_id INT NOT NULL
);

DROP TABLE IF EXISTS tags;

CREATE TABLE tags(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  tag_name VARCHAR(20) NOT NULL,
  tag_category_id INT NOT NULL
);

DROP TABLE IF EXISTS tag_categories;

CREATE TABLE tag_categories(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  tag_category_name VARCHAR(20) NOT NULL
);

DROP TABLE IF EXISTS agent_tags;

CREATE TABLE agent_tags(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  agent_id INT NOT NULL,
  tag_id INT NOT NULL
);

DROP TABLE IF EXISTS accounts;

CREATE TABLE accounts(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(50),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  name VARCHAR(50) NOT NULL,
  agent_id INT,
  right_id INT NOT NULL
);

DROP TABLE IF EXISTS rights;

CREATE TABLE rights(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  right_name VARCHAR(50)
);

DROP TABLE IF EXISTS maint_pages;

CREATE TABLE maint_pages(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  page_name VARCHAR(20) NOT NULL,
  page_type VARCHAR(20) NOT NULL,
  on_nav INT NOT NULL
);

DROP TABLE IF EXISTS maint_page_rights;

CREATE TABLE maint_page_rights(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  page_id INT NOT NULL,
  right_id INT NOT NULL
);

DROP TABLE IF EXISTS maint_page_cols;

CREATE TABLE maint_page_cols(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  maint_page_id INT NOT NULL,
  col VARCHAR(20) NOT NULL
);

-- トランザクション

DROP TABLE IF EXISTS students;

CREATE TABLE students(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  inquiry_option_id INT NOT NULL,
  student_name VARCHAR(50) NOT NULL,
  student_name_ruby VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  tel VARCHAR(11) NOT NULL,
  school_id INT NOT NULL,
  faculty VARCHAR(50),
  department VARCHAR(50),
  graduate_year INT NOT NULL,
  postal_code VARCHAR(7),
  pref_id INT NOT NULL,
  address VARCHAR(50),
  building VARCHAR(50),
  optional_comment VARCHAR(1000)
);

DROP TABLE IF EXISTS inquired_agents;

CREATE TABLE inquired_agents(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  student_id INT NOT NULL,
  agent_id INT NOT NULL
);

-- マスタ　データ
INSERT INTO
  tag_categories (tag_category_name)
VALUES
  ('専攻から選ぶ'),
  ('地域から選ぶ'),
  ('職種から選ぶ'),
  ('イチオシ機能から選ぶ');

INSERT INTO
  tags (tag_name, tag_category_id)
VALUES
  ('文系', 1),
  ('理系', 1),
  ('その他', 1),
  ('西日本', 2),
  ('東日本', 2),
  ('事務系', 3),
  ('営業系', 3),
  ('販売系', 3),
  ('IT系', 3),
  ('技術系', 3),
  ('専門系', 3),
  ('年収交渉の代行', 4),
  ('コンシェルジュへの相談', 4),
  ('スカウトサービス', 4),
  ('書類選考免除', 4),
  ('グローバル対応', 4),
  ('内定後のサポート', 4),
  ('年収査定診断', 4),
  ('オンライン面接', 4);

INSERT INTO
  maint_pages (page_name, page_type, on_nav)
VALUES
  ('学生情報一覧', 'list', 1),
  ('エージェント一覧', 'list', 1),
  ('アカウント一覧', 'list', 1),
  ('マイアカウント', 'info', 1),
  ('登録情報', 'info', 1),
  ('請求情報', 'info', 1),
  ('学生情報詳細', 'info', 0),
  ('エージェント情報詳細', 'info', 0),
  ('アカウント作成・変更', 'form', 0);

INSERT INTO
  maint_page_rights(page_id, right_id)
VALUES
  (1, 0),
  (1, 1),
  (1, 2),
  (2, 1),
  (2, 2),
  (3, 2),
  (4, 1),
  (4, 2),
  (5, 0),
  (6, 0),
  (7, 1),
  (7, 2),
  (8, 1),
  (8, 2),
  (9, 2);

INSERT INTO
  maint_page_cols(maint_page_id, col)
VALUES
  (1, '問い合わせ日時'),
  (1, '氏名'),
  (1, 'メールアドレス'),
  (1, '電話番号'),
  (1, '卒業年'),
  (1, '詳細'),
  (2, '会社名'),
  (2, '担当者氏名'),
  (2, '担当者メールアドレス'),
  (2, '担当者電話番号'),
  (2, '掲載期間'),
  (3, '氏名'),
  (3, 'メールアドレス'),
  (3, 'パスワード'),
  (3, 'アクセス権限'),
  (3, '変更'),
  (4, '氏名'),
  (4, 'メールアドレス'),
  (4, 'パスワード'),
  (4, 'アクセス権限'),
  (5, '会社名'),
  (5, '会社所在地'),
  (5, '会社URL'),
  (5, '会社電話番号'),
  (5, '代表者氏名'),
  (5, '担当者氏名'),
  (5, '担当者電話番号'),
  (5, '担当者メールアドレス'),
  (5, '通知用メールアドレス'),
  (5, '契約期間'),
  (5, '項目を追加'),
  (6, '請求日'),
  (6, '請求額'),
  (6, '対象月'),
  (6, 'ステータス'),
  (7, '氏名'),
  (7, 'メールアドレス'),
  (7, '電話番号'),
  (7, '住所'),
  (7, '大学名'),
  (7, '学部学科'),
  (7, '卒業年'),
  (7, '生年月日'),
  (7, '性別'),
  (7, '問い合わせ内容'),
  (7, '自由記入欄'),
  (8, '会社名'),
  (8, '会社所在地'),
  (8, '会社URL'),
  (8, '会社電話番号'),
  (8, '代表者氏名'),
  (8, '担当者氏名'),
  (8, '担当者電話番号'),
  (8, '担当者メールアドレス'),
  (8, '通知用メールアドレス'),
  (8, '契約期間'),
  (8, '項目を追加');

-- ダミーデータ
INSERT INTO
  accounts(email, password, name, agent_id, right_id)
VALUES
  ('agent@test', sha1('teamdev'), '横山', NULL, 0),
  ('boozer@test', sha1('teamdev'), '青柳', NULL, 1),
  ('admin@test', sha1('teamdev'), '田上', NULL, 2);

INSERT INTO
  agents (
    agent_name,
    expires_at,
    evaluation1,
    evaluation2,
    evaluation3,
    paragraph1,
    paragraph2,
    paragraph3,
    paragraph4
  )
VALUES
  (
    'sample agent 1',
    '2022-04-30 23:59:59',
    3,
    2,
    4,
    'いってらっしゃい',
    'いってきます',
    'ただいま',
    'おかえり'
  ),
  (
    'sample agent 2',
    '2022-05-31 23:59:59',
    5,
    3,
    2,
    'こんにちは',
    'こんばんは',
    'いただきます',
    'ごちそうさま'
  );

INSERT INTO
  agent_tags (agent_id, tag_id)
VALUES
  (1, 1),
  (1, 4),
  (1, 6),
  (1, 19),
  (2, 2),
  (2, 6),
  (2, 9),
  (2, 13);
