function regexpCheck() {
  // 正規表現チェック
  const inputArray = new Array();
  inputArray.push({ id: 'inqName', regexp: /^[^\x20-\x7e]+$/ }); //全角文字、空文字NG
  inputArray.push({ id: 'inqNameruby', regexp: /^[ァ-ンヴー]+$/ }); //全角カタカナ、空文字NG
  inputArray.push({ id: 'inqEmail', regexp: /^[a-zA-Z0-9!-/:-@¥[-`{-~]+$/ }); //半角英数記号、空文字NG
  inputArray.push({ id: 'inqTel', regexp: /^[0-9]+$/ }); //半角数値、空文字NG
  inputArray.push({ id: 'inqUniv', regexp: /^[^\x20-\x7e]+$/ }); //全角文字、空文字NG
  inputArray.push({ id: 'inqFaculty', regexp: /^[^\x20-\x7e]+$/ }); //全角文字、空文字NG
  inputArray.push({ id: 'inqDepartment', regexp: /^[^\x20-\x7e]+$/ }); //全角文字、空文字NG
  inputArray.push({ id: 'inqGraduation', regexp: /^\d{4}$/ }); //半角数値４文字
  inputArray.push({ id: 'inqPostalcode', regexp: /^\d{7}$/ }); //半角数値７文字
  inputArray.push({ id: 'inqPref', regexp: /^[^\x20-\x7e]+$/ }); //全角文字、空文字NG
  inputArray.push({ id: 'inqAddress', regexp: /^[^\x20-\x7e]+$/ }); //全角文字、空文字NG
  inputArray.push({ id: 'inqBldg', regexp: /^[^\x20-\x7e]*$/ }); //全角文字、空文字OK
  inputArray.push({ id: 'inqFree', regexp: /^[^\x20-\x7e]*$/ }); //全角文字、空文字OK

  // 入力内容に誤りのある要素のidを入れる配列
  const falseInputIdArray = new Array();

  inputArray.forEach(obj => {
    const el = document.getElementById(obj.id);
    el.classList.remove('Application-form__input__false-js');

    const str = String(el.value);
    const regexp = new RegExp(obj.regexp);
    if (!regexp.test(str)) {
      falseInputIdArray.push(obj.id);
    }
  });

  // 入力内容に誤りのある要素のスタイルを変更
  falseInputIdArray.forEach(id => {
    const el = document.getElementById(id);
    el.classList.add('Application-form__input__false-js');
  });

  return falseInputIdArray;
}

function formSend() {
  const form = document.getElementById('inqForm');
  const agree = document.getElementById('inqAgree').checked;
  const falseCount = regexpCheck().length;

  if (falseCount === 0 && agree) {
    form.submit();
  } else {
    alert('入力内容に誤りがあります。');
  }
}
