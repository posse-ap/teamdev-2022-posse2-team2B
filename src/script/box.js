let put_out_of_box = document.getElementById('put_out_of_box');
let put_into_box = document.getElementById('put_into_box');

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
        li.innerHTML = `<p>エージェントID: ${agent['id']}<br>追加日時: ${agent['created_at']}</p>
          <div onclick="deleteBox(${agent['id']})">削除</div>`;
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
