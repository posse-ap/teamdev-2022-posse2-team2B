<?php
// エージェント会社登録フォームの値を全て受け取ったら
if (isset($_POST['agent_name']) && isset($_POST['start_at']) && isset($_POST['expires_at']) && isset($_POST['publication']) && isset($_POST['evaluation1']) && isset($_POST['evaluation2']) && isset($_POST['evaluation3']) && isset($_POST['tag']) && isset($_POST['intro']) && isset($_POST['paragraph1']) && isset($_POST['paragraph2']) && isset($_POST['paragraph3']) && isset($_POST['paragraph4']) && isset($_POST['paragraph5']) && isset($_POST['paragraph6']) && isset($_POST['paragraph7']) && isset($_POST['url']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['address']) && isset($_POST['agent_tel']) && isset($_POST['pres_name']) && isset($_POST['pic_name']) && isset($_POST['pic_tel']) && isset($_POST['pic_email']) && isset($_POST['notification_email'])) {
  try {
    $db->beginTransaction();
    $reg_agent_stmt = $db->prepare(
      "INSERT INTO
      agents
      (agent_name,start_at,expires_at,publication,evaluation1,evaluation2,evaluation3,intro,paragraph1,paragraph2,paragraph3,paragraph4,paragraph5,paragraph6,paragraph7,url,email,tel)
    VALUES
      (
        :agent_name,
        :start_at,
        :expires_at,
        :publication,
        :evaluation1,
        :evaluation2,
        :evaluation3,
        :intro,
        :paragraph1,
        :paragraph2,
        :paragraph3,
        :paragraph4,
        :paragraph5,
        :paragraph6,
        :paragraph7,
        :url,
        :email,
        :tel
      )"
    );
    $reg_agent_stmt->execute([
      ':agent_name' => $_POST['agent_name'],
      ':start_at' => $_POST['start_at'],
      ':expires_at' => $_POST['expires_at'],
      ':publication' => $_POST['publication'],
      ':evaluation1' => $_POST['evaluation1'],
      ':evaluation2' => $_POST['evaluation2'],
      ':evaluation3' => $_POST['evaluation3'],
      ':intro' => $_POST['intro'],
      ':paragraph1' => $_POST['paragraph1'],
      ':paragraph2' => $_POST['paragraph2'],
      ':paragraph3' => $_POST['paragraph3'],
      ':paragraph4' => $_POST['paragraph4'],
      ':paragraph5' => $_POST['paragraph5'],
      ':paragraph6' => $_POST['paragraph6'],
      ':paragraph7' => $_POST['paragraph7'],
      ':url' => $_POST['url'],
      ':email' => $_POST['email'],
      ':tel' => $_POST['tel']
    ]);
    $agentId = $db->lastInsertId();
    $tag_stmt = $db->prepare(
      "INSERT INTO
      agent_tags
      (agent_id,tag_id)
    VALUES
      (
        :agent_id,
        :tag_id
      )"
    );
    $tag_stmt->execute([
      ':agent_id' => $agentId,
      ':tag_id' => $_POST['tag']
    ]);
    $agentId = $db->lastInsertId();
    // commit
    $reg_agent_contract_stmt = $db->prepare(
      "INSERT INTO
      agent_contract
    (agent_id,company_name,address,tel,pres_name,pic_name,pic_tel,pic_email,notification_email)

    VALUES
      (
        :agent_id,
        :company_name,
        :address,
        :agent_tel,
        :pres_name,
        :pic_name,
        :pic_tel,
        :pic_email,
        :notification_email
      )"
    );
    $reg_agent_contract_stmt->execute([
      ':agent_id' => $agentId,
      ':company_name' => $_POST['company_name'],
      ':address' => $_POST['address'],
      ':agent_tel' => $_POST['agent_tel'],
      ':pres_name' => $_POST['pres_name'],
      ':pic_name' => $_POST['pic_name'],
      ':pic_tel' => $_POST['pic_tel'],
      ':pic_email' => $_POST['pic_email'],
      ':notification_email' => $_POST['notification_email']
    ]);
    var_dump($agentId);
    // commit
    $db->commit();
  } catch (PDOException $e) {
    // エラー発生時の処理(ロールバック)
    $db->rollBack();
    echo $e->getMessage();
  }
}
