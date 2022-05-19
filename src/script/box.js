//// ボタン表示切り替え ////
function changeBtnDisp(agents) {
  // 全てのボタンの要素を取得し、表示を初期化
  document.querySelectorAll('.js-put-btn').forEach(putBtn => {
    putBtn.style.display = 'block';
  });
  document.querySelectorAll('.js-delete-btn').forEach(deleteBtn => {
    deleteBtn.style.display = 'none';
  })
  // 問い合わせBOX内にあるエージェントの「入れる」ボタンを非表示、「出すボタン」を表示
  agents.forEach(agent => {
    const agentId = agent.id;
    // ボタンの要素を取得し、表示を変更
    document.querySelectorAll(`.js-put-btn${agentId}`).forEach(putBtn => {
      putBtn.style.display = 'none';
    });
    document.querySelectorAll(`.js-delete-btn${agentId}`).forEach(deleteBtn => {
      deleteBtn.style.display = 'block';
    });
  });
}

//// ボックス追加機能 ////

// お問い合わせBOXのul要素
const box = document.getElementById('box');
// お問い合わせBOXアイコンのバッジ(BOX内のエージェント数を表示)
const boxBadge = document.getElementById('boxBadge');

// データベース作成
var db = new Dexie('craftDB');
db.version(1).stores({
  agents: 'id, created_at'
});
// データベース更新 agent_nameを追加
db.version(2).stores({
  agents: 'id, agent_name, created_at'
});

// ボックスの中身を表示
function showBox() {
  db.agents
    .toArray()
    .then(function (agents) {
      // agentsが空の場合
      if (agents.length === 0) {
        box.innerText = 'エージェントが入っていません。';
        boxBadge.innerText = agents.length;
        changeBtnDisp(agents);
        return;
      }
      // BOX内のHTML 初期化
      let html = '';
      // IndexedDB内の各エージェントに対して、順番にAjaxでPHPのパーツのHTMLを出力する関数を実行
      // agent(IndexedDB内のエージェント情報をJSON形式に変換)
      const jsonAgents = JSON.stringify(agents);
      // POST通信を行い、/app/func-js.phpに関数名(m_box_item)と引数(agent)が送信され、/parts/parts.phpの該当する関数が実行される
      const postAgent = $.ajax({
        type: 'post',
        url: 'http://localhost:80/app/box-fn.php',
        data: { 'func': 'm_box_item', 'arg': jsonAgents },
        dataType: 'html',
      }).done(function (response) {
        // 通信成功時
        // responseにエージェントカードのHTMLが返却される
        html = response;
      }).fail(function () {
        // 通信失敗時
        alert('問い合わせBOXへの追加に失敗しました。');
      });

      // Ajax完了時
      $.when(postAgent).done(
        function () {
          // BOX内のHTMLを更新
          box.innerHTML = html;
          boxBadge.innerText = agents.length;
          changeBtnDisp(agents);
        }
      );
    });
}

// エージェントをボックスに追加
function putBox(agentId, agentName) {
  db.agents.put({
    id: agentId,
    agent_name: agentName,
    created_at: new Date()
  });
  // 再表示
  showBox();
}

// エージェントをボックスから削除
function deleteBox(agentId) {
  db.agents.delete(agentId);
  // 再表示
  showBox();
}

// ロード時も再表示
window.onload = () => {
  showBox();
}
