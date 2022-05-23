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
  inputArray.push({ id: 'inqFree', regexp: /\S*$/ }); //全角半角OK

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

// 半角から全角に変換
function han2zen(str) {
  return str.replace(/[A-Za-z0-9]/g, function (s) {
    return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
  });
}

function han2zenKana(str) {
  var kanaMap = {
    'ｶﾞ': 'ガ', 'ｷﾞ': 'ギ', 'ｸﾞ': 'グ', 'ｹﾞ': 'ゲ', 'ｺﾞ': 'ゴ',
    'ｻﾞ': 'ザ', 'ｼﾞ': 'ジ', 'ｽﾞ': 'ズ', 'ｾﾞ': 'ゼ', 'ｿﾞ': 'ゾ',
    'ﾀﾞ': 'ダ', 'ﾁﾞ': 'ヂ', 'ﾂﾞ': 'ヅ', 'ﾃﾞ': 'デ', 'ﾄﾞ': 'ド',
    'ﾊﾞ': 'バ', 'ﾋﾞ': 'ビ', 'ﾌﾞ': 'ブ', 'ﾍﾞ': 'ベ', 'ﾎﾞ': 'ボ',
    'ﾊﾟ': 'パ', 'ﾋﾟ': 'ピ', 'ﾌﾟ': 'プ', 'ﾍﾟ': 'ペ', 'ﾎﾟ': 'ポ',
    'ｳﾞ': 'ヴ', 'ﾜﾞ': 'ヷ', 'ｦﾞ': 'ヺ',
    'ｱ': 'ア', 'ｲ': 'イ', 'ｳ': 'ウ', 'ｴ': 'エ', 'ｵ': 'オ',
    'ｶ': 'カ', 'ｷ': 'キ', 'ｸ': 'ク', 'ｹ': 'ケ', 'ｺ': 'コ',
    'ｻ': 'サ', 'ｼ': 'シ', 'ｽ': 'ス', 'ｾ': 'セ', 'ｿ': 'ソ',
    'ﾀ': 'タ', 'ﾁ': 'チ', 'ﾂ': 'ツ', 'ﾃ': 'テ', 'ﾄ': 'ト',
    'ﾅ': 'ナ', 'ﾆ': 'ニ', 'ﾇ': 'ヌ', 'ﾈ': 'ネ', 'ﾉ': 'ノ',
    'ﾊ': 'ハ', 'ﾋ': 'ヒ', 'ﾌ': 'フ', 'ﾍ': 'ヘ', 'ﾎ': 'ホ',
    'ﾏ': 'マ', 'ﾐ': 'ミ', 'ﾑ': 'ム', 'ﾒ': 'メ', 'ﾓ': 'モ',
    'ﾔ': 'ヤ', 'ﾕ': 'ユ', 'ﾖ': 'ヨ',
    'ﾗ': 'ラ', 'ﾘ': 'リ', 'ﾙ': 'ル', 'ﾚ': 'レ', 'ﾛ': 'ロ',
    'ﾜ': 'ワ', 'ｦ': 'ヲ', 'ﾝ': 'ン',
    'ｧ': 'ァ', 'ｨ': 'ィ', 'ｩ': 'ゥ', 'ｪ': 'ェ', 'ｫ': 'ォ',
    'ｯ': 'ッ', 'ｬ': 'ャ', 'ｭ': 'ュ', 'ｮ': 'ョ',
    '｡': '。', '､': '、', 'ｰ': 'ー', '｢': '「', '｣': '」', '･': '・'
  };

  let reg = new RegExp('(' + Object.keys(kanaMap).join('|') + ')', 'g');
  return str
    .replace(reg, function (match) {
      return kanaMap[match];
    })
    .replace(/ﾞ/g, '゛')
    .replace(/ﾟ/g, '゜');
};

document.querySelectorAll('.js-zen-input').forEach(el => {
  el.onblur = () => {
    el.value = han2zen(el.value);
    el.value = han2zenKana(el.value);
  };
});

// 全角から半角に変換
function zen2han(str) {
  return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) {
    return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
  });
}

document.querySelectorAll('.js-han-input').forEach(el => {
  el.onblur = () => {
    el.value = zen2han(el.value);
  };
});

// input.php->check.php
function formSend() {
  const inqForm = document.getElementById('inqForm');
  const agree = document.getElementById('inqAgree').checked;
  const falseCount = regexpCheck().length;

  if (falseCount === 0 && agree) {
    inqForm.submit();
  } else {
    alert('入力内容に誤りがあります。');
    regexpCheck();
    // キーを離した時に正規表現チェック
    window.onkeyup = () => {
      regexpCheck();
    }
  }
}

// check.php->thanks.php
function confirmBtn() {
  const checkForm = document.getElementById('checkForm');
  checkForm.submit();
}
