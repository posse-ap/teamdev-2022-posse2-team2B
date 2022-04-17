set
  character_set_client = utf8mb4;

set
  character_set_connection = utf8mb4;

set
  character_set_results = utf8mb4;

DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

-- ここから新たに作るテーブル
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
  tag_name VARCHAR(20) NOT NULL
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

-- ダミーデータ
INSERT INTO
  accounts (email, password, name, agent_id, right_id)
VALUES
  ('test@test', sha1('teamdev'), '青柳仁', NULL, 2);

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
