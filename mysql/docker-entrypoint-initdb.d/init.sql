SET
  character_set_client = utf8mb4;

SET
  character_set_connection = utf8mb4;

SET
  character_set_results = utf8mb4;

DROP SCHEMA IF EXISTS shukatsu;

CREATE SCHEMA shukatsu;

USE shukatsu;

-- マスタ サービス全体
DROP TABLE IF EXISTS service;

CREATE TABLE service(
  id INT NOT NULL PRIMARY KEY,
  privacy_policy TEXT(65535)
);

-- マスタ 問い合わせ関連
DROP TABLE IF EXISTS inquiry_options;

CREATE TABLE inquiry_options(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `option` VARCHAR(50)
);

-- マスタ エージェント関連
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
  intro VARCHAR(2000),
  paragraph1 VARCHAR(2000),
  paragraph2 VARCHAR(2000),
  paragraph3 VARCHAR(2000),
  paragraph4 VARCHAR(2000),
  paragraph5 VARCHAR(2000),
  paragraph6 VARCHAR(2000),
  paragraph7 VARCHAR(2000),
  url VARCHAR(2000),
  email VARCHAR(255),
  tel VARCHAR(15)
);

DROP TABLE IF EXISTS agent_contract;

CREATE TABLE agent_contract(
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  agent_id INT NOT NULL,
  address VARCHAR(100) NOT NULL,
  tel VARCHAR(15) NOT NULL,
  pres_name VARCHAR(20) NOT NULL,
  pic_name VARCHAR(20) NOT NULL,
  pic_tel VARCHAR(15) NOT NULL,
  pic_email VARCHAR(255) NOT NULL,
  notification_email VARCHAR(255) NOT NULL
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
  email VARCHAR(255) NOT NULL,
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
  email VARCHAR(255) NOT NULL,
  tel VARCHAR(15) NOT NULL,
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

-- マスタデータ
INSERT INTO
  service(id, privacy_policy)
VALUES
  (
    1,
    'プライバシーポリシー（個人情報保護方針）

株式会社○○（以下、「当社」という。）は，ユーザーの個人情報について以下のとおりプライバシーポリシー（以下、「本ポリシー」という。）を定めます。本ポリシーは、当社がどのような個人情報を取得し、どのように利用・共有するか、ユーザーがどのようにご自身の個人情報を管理できるかをご説明するものです。
【１．事業者情報】
法人名：株式会社○○
住所：○○
代表者：○○【２．個人情報の取得方法】
当社はユーザーが利用登録をするとき、氏名・生年月日・住所・電話番号・メールアドレスなど個人を特定できる情報を取得させていただきます。
お問い合わせフォームやコメントの送信時には、氏名・電話番号・メールアドレスを取得させていただきます。
【３．個人情報の利用目的】
取得した閲覧・購買履歴等の情報を分析し、ユーザー別に適した商品・サービスをお知らせするために利用します。また、取得した閲覧・購買履歴等の情報は、結果をスコア化した上で当該スコアを第三者へ提供します。

【４．個人データを安全に管理するための措置】
当社は個人情報を正確かつ最新の内容に保つよう努め、不正なアクセス・改ざん・漏えい・滅失及び毀損から保護するため全従業員及び役員に対して教育研修を実施しています。また、個人情報保護規程を設け、現場での管理についても定期的に点検を行っています。

【５．個人データの共同利用】
当社は、以下のとおり共同利用を行います。

個人データの管理に関する責任者
株式会社○○
共同して利用する者の利用目的
上記「利用目的」の内容と同様。
利用項目
氏名、住所、電話番号、メールアドレス
共同して利用する者の範囲
当社企業グループを構成する企業
【６．個人データの第三者提供について】
当社は法令及びガイドラインに別段の定めがある場合を除き、同意を得ないで第三者に個人情報を提供することは致しません。

【７．保有個人データの開示、訂正】
当社は本人から個人情報の開示を求められたときには、遅滞なく本人に対しこれを開示します。個人情報の利用目的の通知や訂正、追加、削除、利用の停止、第三者への提供の停止を希望される方は以下の手順でご請求ください。
（各社請求方法を指定）
送付先住所
〒○○
東京都○○
株式会社○○　お問い合わせ窓口

【８．個人情報取り扱いに関する相談や苦情の連絡先】
当社の個人情報の取り扱いに関するご質問やご不明点、苦情、その他のお問い合わせはお問い合わせフォームよりご連絡ください。

【９．SSL（Secure Socket Layer）について】
当社のWebサイトはSSLに対応しており、WebブラウザとWebサーバーとの通信を暗号化しています。ユーザーが入力する氏名や住所、電話番号などの個人情報は自動的に暗号化されます。

【１０．cookieについて】
cookieとは、WebサーバーからWebブラウザに送信されるデータのことです。Webサーバーがcookieを参照することでユーザーのパソコンを識別でき、効率的に当社Webサイトを利用することができます。当社Webサイトがcookieとして送るファイルは、個人を特定するような情報は含んでおりません。
お使いのWebブラウザの設定により、cookieを無効にすることも可能です。

【１１．プライバシーポリシーの制定日及び改定日】
制定：○○年○月○日
改定：○○年○月○日
改定：○○年○月○日

【１２．免責事項】
当社Webサイトに掲載されている情報の正確性には万全を期していますが、利用者が当社Webサイトの情報を用いて行う一切の行為に関して、一切の責任を負わないものとします。
当社は、利用者が当社Webサイトを利用したことにより生じた利用者の損害及び利用者が第三者に与えた損害に関して、一切の責任を負わないものとします。

【１３．著作権・肖像権】
当社Webサイト内の文章や画像、すべてのコンテンツは著作権・肖像権等により保護されています。無断での使用や転用は禁止されています。

【１４．リンク】
当社Webサイトへのリンクは、自由に設置していただいて構いません。ただし、Webサイトの内容等によってはリンクの設置をお断りすることがあります。'
  );

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
  (
    'agent1@test',
    sha1('teamdev'),
    '株式会社sampleagent1ウサギ',
    1,
    1
  ),
  (
    'agent2@test',
    sha1('teamdev'),
    '株式会社sampleagent2ハチワレ',
    2,
    1
  ),
  (
    'agent3@test',
    sha1('teamdev'),
    '株式会社sampleagent3シーサー',
    3,
    1
  ),
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
    intro,
    paragraph1,
    paragraph2,
    paragraph3,
    paragraph4,
    paragraph5,
    paragraph6,
    paragraph7,
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
    '紹介文です',
    'いってらっしゃい',
    'いってきます',
    'ただいま',
    'おかえり',
    'おかえり',
    'おかえり',
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
    '紹介文です',
    'こんにちは',
    'こんばんは',
    'いただきます',
    'ごちそうさま',
    'ごちそうさま',
    'ごちそうさま',
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
    '紹介文です',
    'ありがとう',
    'どういたしまして',
    'ご無沙汰しております',
    'お騒がせしました',
    'お騒がせしました',
    'お騒がせしました',
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
  (2, 13),
  (3, 5),
  (3, 8),
  (3, 9),
  (3, 10);
