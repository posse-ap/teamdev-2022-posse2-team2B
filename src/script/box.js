// ボックス追加機能
// データベース作成
var db = new Dexie('craftDB');
db.version(1).stores({
  agents: 'id, created_at'
});

// ボックスの中身を表示
function showBox() {
  db.agents
    .toArray()
    .then((agents) => {
      const box = document.getElementById('box');
      box.innerHTML = '';
      agents.forEach(agent => {
        const li = document.createElement('li');
        li.innerHTML = `エージェントID: ${agent['id']}<br>追加日時: ${agent['created_at']}`;
        box.insertAdjacentElement('beforeend', li);
      });
    });
}

// エージェントをボックスに追加
function putBox(agentId) {
  db.agents.put({
    id: agentId,
    created_at: new Date()
  });
  showBox();
}

// エージェントをボックスから削除
function deleteBox(agentId) {
  db.agents.delete(agentId);
  showBox();
}

// ロード時も再表示
window.onload = () => {
  showBox();
}
