USE shukatsu;

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
