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
        return;
      }
      // BOX内のHTML 初期化
      let html = '';
      // IndexedDB内の各エージェントに対して、順番にAjaxでPHPのパーツのHTMLを出力する関数を実行
      agents.forEach(agent => {
        // agent(IndexedDB内のエージェント情報をJSON形式に変換)
        agent = JSON.stringify(agent);
        // POST通信を行い、/app/func-js.phpに関数名(m_box_item)と引数(agent)が送信され、/parts/parts.phpの該当する関数が実行される
        $.ajax({
          type: 'post',
          url: 'http://localhost:80/app/box-fn.php',
          data: { 'func': 'm_box_item', 'arg': agent },
          dataType: 'html',
        }).done(function (response) {
          // 通信成功時
          // responseにエージェントカードのHTMLが返却される
          html += response;
        }).fail(function (errorThrown) {
          // 通信失敗時
          console.log('Connection error.\n' + errorThrown);
        });
      });
      // Ajax完了時
      $(document).ajaxStop(function () {
        if (html !== '') {
          // BOX内のHTMLを更新
          box.innerHTML = html;
          boxBadge.innerText = agents.length;
        }
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
