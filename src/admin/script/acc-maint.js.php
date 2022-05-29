<script>
  // アカウント新規作成画面 アクセス権限がエージェント会社担当者の場合のみ該当エージェントを選択するselectが表示される
  const rightSelect = document.getElementById('right_select');
  const agentSelect = document.getElementById('agent_select');
  const agentSelectArea = document.getElementById('agent_select_area');

  function agentSelectDisp() {
    if (rightSelect.value == 1) {
      agentSelectArea.style.display = 'flex';
    } else {
      agentSelectArea.style.display = 'none';
    }
  }

  rightSelect.onchange = () => {
    agentSelectDisp();
  }

  window.addEventListener('DOMContentLoaded', () => {
    agentSelectDisp();
  });

  // アカウント作成ボタンの動作
  document.getElementById('btn').addEventListener('click', () => {
    if (document.getElementById('pw').value != document.getElementById('pw_again').value) {
      alert('パスワードが一致しません');
      return;
    }
    if (rightSelect.value == 0) {
      alert('アクセス権限を選択してください');
      return;
    }
    if (rightSelect.value == 1 && agentSelect.value == 0) {
      alert('エージェントを選択してください');
      return;
    }
    if (agentSelectArea.style.display == 'none') {
      agentSelect.value = '';
    }
    if (confirm('この内容で登録しますか？')) {
      document.getElementById('acc_form').submit();
    }
  });

  // エージェント登録画面
  document.getElementById('ここに自分で作ったid入れて！ by Jin').addEventListener('click', () => {
    document.getElementById('ここに送信したいformのid入れて！ by Jin').submit();
  });
</script>
