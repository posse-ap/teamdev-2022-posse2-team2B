let put_out_of_box = document.getElementById('put_out_of_box');
let put_into_box = document.getElementById('put_into_box');

// ボックス追加機能
// データベース作成
var db = new Dexie('craftDB');
db.version(1).stores({
  agents: 'id, created_at'
});

db.version(2).stores({
  agents: 'id, agent_name, created_at'
});

// ボックスの中身を表示
function showBox() {
  db.agents
    .toArray()
    .then((agents) => {
      const box = document.getElementById('box');
      box.innerHTML = '';
      agents.forEach(agent => {
  //       const li = document.createElement('li');
  //       li.innerHTML = `  <div onclick="deleteBox(${agent['id']})"></div>
  // <p>エージェントID: ${agent['id']}<br>追加日時: ${agent['created_at']}</p>`;
  //       box.insertAdjacentElement('beforeend', li);
        $.ajax({
          type: 'post',
          url: './app/func-js.php',
          data: { 'func': 'm_box_item', 'args': agent },
          dataType: 'json',
        });
      });
    });
}

// エージェントをボックスに追加
function putBox(agentId, agentName) {
  db.agents.put({
    id: agentId,
    agent_name: agentName,
    created_at: new Date()
  });
  showBox();
  // ↓表示変更
  put_into_box.style.display = 'none';
  put_out_of_box.style.display = 'block';
}

// エージェントをボックスから削除
function deleteBox(agentId) {
  db.agents.delete(agentId);
  showBox();
  // ↓表示変更
  put_into_box.style.display = 'block';
  put_out_of_box.style.display = 'none';
}

// ロード時も再表示
window.onload = () => {
  showBox();
}
