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

function escNull(el) {
  if (el == null) {
    return document.createElement('div');
  } else {
    return el;
  }
}

// お問い合わせBOXのul要素
let boxes = document.querySelectorAll('.js-box');
// お問い合わせBOXアイコンのバッジ(BOX内のエージェント数を表示)
let boxBadge = document.getElementById('boxBadge');
let inBoxPc = document.getElementById('inBoxPc');
boxBadge = escNull(boxBadge);
inBoxPc = escNull(inBoxPc);



// データベース作成
var db = new Dexie('craftDB');
db.version(1).stores({
  agents: 'id, created_at'
});
// データベース更新 agent_nameを追加
db.version(2).stores({
  agents: 'id, agent_name, created_at'
});
// データベース更新 agent_pictureを追加
db.version(3).stores({
  agents: 'id, agent_name, agent_picture, created_at'
});

// ボックスの中身を表示
function showBox() {
  db.agents
    .toArray()
    .then(function (agents) {
      // agentsが空の場合
      if (agents.length === 0) {
        boxes.forEach(box => {
          box.innerText = 'エージェントが入っていません。';
        });
        boxBadge.innerText = agents.length;
        inBoxPc.innerText = agents.length;
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
          boxes.forEach(box => {
            box.innerHTML = html;
          });
          boxBadge.innerText = agents.length;
          inBoxPc.innerText = agents.length;
          changeBtnDisp(agents);
        }
      );
    });
}

// エージェントをボックスに追加
function putBox(agentId, agentName, agentPicture) {
  db.agents.put({
    id: agentId,
    agent_name: agentName,
    agent_picture: agentPicture,
    created_at: new Date()
  });
  // 再表示
  showBox();
}

// 結果画面に出ているエージェント全て追加
function putBoxAll(ids, names, pictures) {
  const idsArray = ids.split(',');
  const namesArray = names.split(',');
  const picturesArray = pictures.split(',');
  for (let i = 0; i < idsArray.length; i++ ) {
    putBox(idsArray[i], namesArray[i], picturesArray[i]);
  }
}

// 結果画面に出ているエージェント全て削除

// エージェントをボックスから削除
function deleteBox(agentId) {
  db.agents.delete(agentId);
  // 再表示
  showBox();
}

function deleteBoxAll(ids) {
  const idsArray = ids.split(',');
  for (let i = 0; i < idsArray.length; i++) {
    deleteBox(idsArray[i]);
  }
}

// ロード時も再表示
window.onload = () => {
  showBox();
}

function inquiryBtn() {
  let length;
  db.agents
    .toArray()
    .then(function (agents) {
      length = agents.length;
      if (length !== 0) {
        // agentsからagent_idだけの配列を作る
        const agentIdArray = new Array();
        agents.forEach(agent => {
          agentIdArray.push(agent.id);
        });
        // 問い合わせBOXの中身を送信
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'input.php';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'inq_agents';
        input.value = agentIdArray.join(',');
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
      } else {
        alert('問い合わせBOXの中身が空です。次に進むには、問い合わせBOXにエージェントを1件以上追加してください。');
      }
    });
}
