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
  start_at DATETIME NOT NULL,
  expires_at DATETIME NOT NULL,
  publication INT NOT NULL DEFAULT 1,
  evaluation1 INT,
  evaluation2 INT,
  evaluation3 INT,
  paragraph1 VARCHAR(2000),
  paragraph2 VARCHAR(2000),
  paragraph3 VARCHAR(2000),
  paragraph4 VARCHAR(2000),
  url VARCHAR(100),
  email VARCHAR(50),
  tel VARCHAR(20)
);

DROP TABLE IF EXISTS agent_contract;

-- TODO 契約に必要な情報を保持するカラムをさらに追加
CREATE TABLE agent_contract(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  agent_id INT NOT NULL,
  address VARCHAR(100) NOT NULL,
  tel VARCHAR(20) NOT NULL,
  pres_name VARCHAR(20) NOT NULL,
  pic_name VARCHAR(20) NOT NULL,
  pic_tel VARCHAR(20) NOT NULL,
  pic_email VARCHAR(50) NOT NULL,
  notification_email VARCHAR(50) NOT NULL
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

-- トランザクション
DROP TABLE IF EXISTS students;

CREATE TABLE students(
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  inquiry_option_id INT NOT NULL,
  student_name VARCHAR(50) NOT NULL,
  student_name_ruby VARCHAR(50) NOT NULL,
  birthday DATE NOT NULL,
  sex INT NOT NULL,
  email VARCHAR(50) NOT NULL,
  tel VARCHAR(11) NOT NULL,
  univ VARCHAR(50) NOT NULL,
  faculty VARCHAR(50),
  department VARCHAR(50),
  graduate_year INT NOT NULL,
  postal_code VARCHAR(7),
  address VARCHAR(200),
  optional_comment VARCHAR(1000)
);

DROP TABLE IF EXISTS inquired_agents;

CREATE TABLE inquired_agents(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  student_id VARCHAR(255) NOT NULL,
  agent_id INT NOT NULL
);
INSERT INTO
  inquired_agents(student_id, agent_id)
VALUES
  ('d3628cfd6b722eb',1),('5f628cfd7a5b92e',1),('e5628cfd846cc8b',1),('d3628cfd6b722eb',2),('5f628cfd7a5b92e',2),('e5628cfd846cc8b',3);


-- マスタ　データ
INSERT INTO
  rights(right_name)
VALUES
  ('エージェント会社担当者様'),
  ('共同管理者'),
  ('管理者');

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

-- ダミーデータ
INSERT INTO
  agent_contract(
    agent_id,
    address,
    tel,
    pres_name,
    pic_name,
    pic_tel,
    pic_email,
    notification_email
  )
VALUES
  (
    1,
    '山口県下関市菊川町xx-xx',
    '0831234567',
    'ちいかわ',
    'ウサギ',
    '09088881111',
    'tantouA@test',
    'tsuuchi1@test'
  ),
  (
    2,
    '長崎県西彼杵郡時津町左底郷xx-xx',
    '0831234567',
    'カワウソ',
    'ハチワレ',
    '09088882222',
    'tantouB@test',
    'tsuuchi2@test'
  ),
  (
    3,
    '神奈川県横浜市港北区篠原東xx-xx',
    '0831234567',
    'シーサー',
    '星',
    '09088883333',
    'tantouC@test',
    'tsuuchi3@test'
  );

INSERT INTO
  accounts(email, password, name, agent_id, right_id)
VALUES
  ('agent1@test', sha1('teamdev'), '株式会社sampleagent1ウサギ', 1, 1),
  ('agent2@test', sha1('teamdev'), '株式会社sampleagent2ハチワレ', 2, 1),
  ('agent3@test', sha1('teamdev'), '株式会社sampleagent3シーサー', 3, 1),
  ('boozer@test', sha1('teamdev'), '青柳', NULL, 2),
  ('admin@test', sha1('teamdev'), '田上', NULL, 3);

INSERT INTO
  agents (
    agent_name,
    start_at,
    expires_at,
    evaluation1,
    evaluation2,
    evaluation3,
    paragraph1,
    paragraph2,
    paragraph3,
    paragraph4,
    url,
    email,
    tel
  )
VALUES
  (
    'sample agent 1',
    '2022-01-01 00:00:00',
    '2022-04-30 23:59:59',
    3,
    2,
    4,
    'いってらっしゃい',
    'いってきます',
    'ただいま',
    'おかえり',
    'www.agent1.com',
    'info@agent1.com',
    '03-0000-0000'
  ),
  (
    'sample agent 2',
    '2022-02-01 00:00:00',
    '2022-05-31 23:59:59',
    5,
    3,
    2,
    'こんにちは',
    'こんばんは',
    'いただきます',
    'ごちそうさま',
    'www.agent2.com',
    'info@agent2.com',
    '045-000-0000'
  ),
  (
    'sample agent 3',
    '2021-10-01 00:00:00',
    '2022-07-31 23:59:59',
    2,
    3,
    3,
    'ありがとう',
    'どういたしまして',
    'ご無沙汰しております',
    'お騒がせしました',
    'www.agent2.com',
    'info@agent3.com',
    '083-000-0000'
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

INSERT INTO
  students(
    id,
    inquiry_option_id,
    student_name,
    student_name_ruby,
    birthday,
    sex,
    email,
    tel,
    univ,
    faculty,
    department,
    graduate_year,
    postal_code,
    address,
    optional_comment
  )
VALUES
  (
    'd3628cfd6b722eb',
    1,
    '青柳仁',
    'アオヤギジン',
    '2002-05-08',
    '0',
    'student@test',
    '09012345678',
    '慶應',
    '理工学部',
    '情報工学科',
    '2026',
    '1234567',
    '港区南青山',
    '詳しく知りたいです。よろしくお願いします。'
  ),
  (
    '5f628cfd7a5b92e',
    2,
    '横山健人',
    'ヨコヤマケント',
    '2002-05-08',
    '0',
    'student2@test',
    '09034567890',
    '早稲田',
    '理工学部',
    '情報工学科',
    '2025',
    '1234567',
    '港区南青山',
    '詳しく知りたいです。よろしくお願いしまっす。'
  ),
  (
    'e5628cfd846cc8b',
    3,
    '田上黎',
    'タノウエレイ',
    '2002-05-08',
    '1',
    'student3@test',
    '09034567890',
    '上智',
    '理工学部',
    '情報工学科',
    '2025',
    '1234567',
    '港区南青山',
    '詳しく知りたいです。よろしくお願いしまうす。'
  );
