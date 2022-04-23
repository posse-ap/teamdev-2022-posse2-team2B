<?php
require(dirname(__FILE__) . "/dbconnect.php");

if (!isset($_POST['search'])) {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php');
  exit();
}

// 条件に合うエージェントを取得
$condition = array();
$tags = $_POST['tags'];
$in_clause = substr(str_repeat(',?', count($tags)), 1);

$result_agents_stmt = $db->prepare(sprintf(
  "SELECT
    DISTINCT(agents.id) AS agent_id,
    agent_name,
    expires_at,
    evaluation1,
    evaluation2,
    evaluation3,
    paragraph1,
    paragraph2,
    paragraph3,
    paragraph4
  FROM
    agents
  RIGHT JOIN agent_tags ON agents.id = agent_tags.agent_id
  WHERE tag_id IN (%s)",
  $in_clause
));
$result_agents_stmt->execute($tags);
$result_agents = $result_agents_stmt->fetchAll();
print_r($result_agents);


?>


<ul>
  <?php foreach ($result_agents as $result_agent) : ?>
    <li>
      <?= $result_agent["agent_name"] ?>
      <button id="buttonOpen" onclick="openDB()">DBオープン</button>
      <button id="buttonAdd" onclick='addData(<?= $result_agent["agent_id"] ?>)'>データ追加</button>
      <form id='questionForm'>
        <ul name='questionList' id='questionList' size=10>
        </ul>
      </form>
      <input id='deleteBtn' type='button' value='問い合わせBOXから出す' />

    </li>
  <?php endforeach ?>
</ul>
<!-- <div id='questionBox'></div> -->



<?php
$resultAgents = json_encode($result_agent);
?>
<script>
  var resultAgents = '<?= $resultAgents ?>'
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="/script/result.js"></script>
