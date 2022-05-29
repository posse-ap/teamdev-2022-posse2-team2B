<script>
  // アカウント新規作成画面 アクセス権限がエージェント会社担当者の場合のみ該当エージェントを選択するselectが表示される
  let rightSelect = document.getElementById('right_select');
  let agentSelect = document.getElementById('agent_select');
  let agentSelectArea = document.getElementById('agent_select_area');

  function escNull(el) {
    if (el === null) {
      return document.createElement('div');
    } else {
      return el;
    }
  }

  rightSelect = escNull(rightSelect);
  agentSelect = escNull(agentSelect);
  agentSelectArea = escNull(agentSelectArea);

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
  let btn = document.getElementById('btn');
  btn = escNull(btn);

  btn.addEventListener('click', () => {
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
  let regBtn = document.getElementById('regBtn');
  regBtn = escNull(regBtn);

  regBtn.addEventListener('click', () => {
    document.getElementById('agent_reg_form').submit();
  });
</script>
