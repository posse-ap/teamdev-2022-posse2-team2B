SET
  character_set_client = utf8mb4;

SET
  character_set_connection = utf8mb4;

SET
  character_set_results = utf8mb4;

-- 管理者アカウント情報サンプル
-- right_id... 1: エージェント会社担当者様, 2: 共同管理者, 3: 管理者
INSERT INTO
  accounts(email, password, name, agent_id, right_id)
VALUES
  ('admin@test.com', sha1('teamdev'), '小笹', NULL, 3),
  ('co-admin@test.com', sha1('teamdev'), '小谷', NULL, 2);

-- エージェント会社アカウント情報サンプル
INSERT INTO
  accounts(email, password, name, agent_id, right_id)
VALUES
  (
    'agent1@test.com',
    sha1('teamdev'),
    '株式会社sampleagent1ウサギ',
    1,
    1
  ),
  (
    'agent2@test.com',
    sha1('teamdev'),
    '株式会社sampleagent2ハチワレ',
    2,
    1
  ),
  (
    'agent3@test.com',
    sha1('teamdev'),
    '株式会社sampleagent3シーサー',
    3,
    1
  ),
    (
    'agent4@test.com',
    sha1('teamdev'),
    '株式会社sampleagent4シーサー',
    4,
    1
  ),
    (
    'agent5@test.com',
    sha1('teamdev'),
    '株式会社sampleagent5シーサー',
    5,
    1
  ),
    (
    'agent6@test.com',
    sha1('teamdev'),
    '株式会社sampleagent3シーサー',
    6,
    1
  ),
    (
    'agent7@test.com',
    sha1('teamdev'),
    '株式会社sampleagent3シーサー',
    7,
    1
  ),
    (
    'agent8@test.com',
    sha1('teamdev'),
    '株式会社sampleagent3シーサー',
    8,
    1
  ),
    (
    'agent9@test.com',
    sha1('teamdev'),
    '株式会社sampleagent3シーサー',
    9,
    1
  ),
    (
    'agent10@test.com',
    sha1('teamdev'),
    '株式会社sampleagent3シーサー',
    10,
    1
  );
