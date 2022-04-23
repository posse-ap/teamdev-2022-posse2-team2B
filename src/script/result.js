// function addBox(agentInfo) {
//   var agentData = [];
//   $.ajax({
//     url: "/api/getAgentById.php",
//     type: "post", // getかpostを指定(デフォルトは前者)
//     dataType: "json", // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
//     data: {
//       // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
//       agentId: 6,
//     },
//   })
//     // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
//     .done(function (response) {
//       // $("#result").val("成功");
//       // $("#detail").val(response.data);
//       agentData = response.data;
//     })
//     // ・サーバからステータスコード400以上が返ってきたとき
//     // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
//     // ・通信に失敗したとき
//     .fail(function () {
//       // $("#result").val("失敗");
//       // $("#detail").val("");
//       console.log("api failed");
//     });
//   const dbName = "agents";

//   var request = indexedDB.open(dbName, 4);

//   request.onerror = function (event) {
//     // エラー処理
//     console.log("error", event);
//   };
// request.onupgradeneeded = function (event) {
//     console.log("open success");
//     var db = event.target.result;

//     var objectStore = db.createObjectStore("agentInfo", { keyPath: "agentId" });
//     objectStore.createIndex("name", "name", { unique: false });
//     objectStore.add(agentData);

//     // var transaction = db.transaction(["agentInfo"], "readwrite");
//     // transaction.oncomplete = function (event) {
//     //   console.log("All done!");
//     //   var agentInfoObjectStore = db
//     //     .transaction("agentInfo", "readwrite")
//     //     .objectStore("agentInfo");
//     //   console.log(agentData);
//     //   agentInfoObjectStore.add(agentData);
//     // };

//     // transaction.onerror = function (event) {
//     //   console.log("aho");
//     // };
//   };
// }

// window.indexedDB =
//   window.indexedDB ||
//   window.mozIndexedDB ||
//   window.webkitIndexedDB ||
//   window.msIndexedDB;
// window.IDBTransaction =
//   window.IDBTransaction ||
//   window.webkitIDBTransaction ||
//   window.msIDBTransaction;
// window.IDBKeyRange =
//   window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;

// function addBox() {
//   let db;
//   let version = 1;
//   const request = indexedDB.open("database", version);
//   request.onerror = function (event) {
//     alert("IndexedDB が使えません");
//   };
//   request.onupgradeneeded = function (event) {
//     db = event.target.result;
//     const objectStore = db.createObjectStore("items", { keyPath: "id" });
//     objectStore.createIndex("name", "name", { unique: false });
//     objectStore.createIndex("description", "description", { unique: true });
//   };
//   request.onsuccess = function (event) {
//     db = event.target.result;
//   };
//   const transaction = db.transaction(["items"], "readwrite");
//   transaction.oncomplete = function (event) {
//     console.log("完了しました");
//     event.add();
//   };
//   transaction.onerror = function (event) {
//     console.log("エラーです", event);
//   };

//   const objItem = transaction.objectStore("items");
//   for (let i = 1; i < 10; i += 1) {
//     objItem.add({
//       id: i,
//       name: `sample agent ${i}`,
//       description: `sample agent ${i} の説明`,
//       add: "問い合わせBOXに追加",
//     }).onsuccess = function (event) {
//       console.log(event.target.result);
//     };
//   }
//   db.transaction(["items"]).objectStore("items").get(3).onsuccess = function (
//     event
//   ) {
//     console.log("取得しました", event.target.result);
//   };
// }

//  ブラウザ対応宣言
window.indexedDB =
  window.indexedDB ||
  window.mozIndexedDB ||
  window.webkitIndexedDB ||
  window.msIndexedDB;
window.IDBTransaction =
  window.IDBTransaction ||
  window.webkitIDBTransaction ||
  window.msIDBTransaction;
window.IDBKeyRange =
  window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;

//  データベース(IDBDatabase)インスタンス
var db;
//  データベース名
var dbName = "AgentDB";
//  オブジェクトストア名
var objStoreName = "AgentList";

/**
 *  DB接続処理
 */
function openDB() {
  //  データベースオープン:[名称:TestDB]
  var request = indexedDB.open(dbName);
  //DBが存在しない場合、またはバージョン引数よりも小さい場合の作成処理
  request.onupgradeneeded = function (event) {
    //データベースインスタンス保存
    db = event.target.result;
    db.onerror = function (event) {
      //エラー処理
      console.log("DBの作成に失敗しました。");
    };

    //オブジェクトストア名の確認
    if (!db.objectStoreNames.contains(objStoreName)) {
      //オブジェクトストアが無い場合
      var objStoreKey = { keyPath: "id" }; //キー設定
      //オブジェクトストア生成
      var obj = db.createObjectStore(objStoreName, objStoreKey);
      console.log("オブジェクトストア生成");
    }
  };
  //オープンが正常の場合の関数宣言
  request.onsuccess = function (event) {
    //データベースインスタンス保存
    db = event.target.result;
    console.log("DBオープンOK");
  };
  //エラーの場合の関数宣言
  request.onerror = function (event) {
    console.log("DBオープンエラー");
  };
}
/**
 *  データ追加処理SUB
 */
function _addData(data) {
  //トランザクション
  var transaction = db.transaction(objStoreName, "readwrite");
  //オブジェクトストアにアクセスします。
  var objectStore = transaction.objectStore(objStoreName);
  //単独データを1件の配列データにする
  var arrData = new Array();
  if (Array.isArray(data) == false) {
    arrData[0] = data;
  } else {
    arrData = data;
  }
  for (var i in arrData) {
    //オブジェクトストアに追加のリクエストします。
    var request = objectStore.add(arrData[i]);
    //追加正常の場合の関数宣言
    request.onsuccess = function (event) {
      console.log("保存成功");
      let question_box = `<li>agent1</li>`;
      //html内に入れる
      document
        .getElementById("questionList")
        .insertAdjacentHTML("beforeend", question_box);
    };
    //追加エラーの場合の関数宣言
    request.onerror = function (event) {
      console.log("保存失敗。event:", event);
    };
  }
}
/**
 *  データ追加処理
 */
function addData(agentId) {
  //配列データの例
  var data = [
    {
      id: "01",
      data1: "abcde",
      data2: 123,
      data3: { data3_1: "001", data3_2: 1000 },
    },
    {
      id: "02",
      data1: "a0002",
      data2: 200,
      data3: { data3_1: "002", data3_2: 2000 },
    },
    {
      id: "03",
      data1: "a0003",
      data2: 300,
      data3: { data3_1: "003", data3_2: 3000 },
    },
  ];

  $.ajax({
    url: "/api/getAgentById.php",
    type: "post", // getかpostを指定(デフォルトは前者)
    dataType: "json", // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
    data: {
      // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
      agentId: agentId,
    },
  })
    // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
    .done(function (response) {
      console.log(response.data);
      const data = response.data;
      var transaction = db.transaction(objStoreName, "readwrite");
      //オブジェクトストアにアクセスします。
      var objectStore = transaction.objectStore(objStoreName);
      //単独データを1件の配列データにする
      var arrData = new Array();
      if (Array.isArray(data) == false) {
        arrData[0] = data;
      } else {
        arrData = data;
      }
      for (var i in arrData) {
        //オブジェクトストアに追加のリクエストします。
        var request = objectStore.add(arrData[i]);
        //追加正常の場合の関数宣言
        request.onsuccess = function (event) {
          console.log("保存成功");
          let question_box = `<li>agent1</li>`;
          //html内に入れる
          document
            .getElementById("questionList")
            .insertAdjacentHTML("beforeend", question_box);
        };
        //追加エラーの場合の関数宣言
        request.onerror = function (event) {
          console.log("保存失敗。event:", event);
        };
      }
      // $("#result").val("成功");
      // $("#detail").val(response.data);
      // _addData(response.data);
    })
    // ・サーバからステータスコード400以上が返ってきたとき
    // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
    // ・通信に失敗したとき
    .fail(function () {
      // $("#result").val("失敗");
      // $("#detail").val("");
      console.log("api failed");
    });

  //単独データの例
  //var data  = { id: '11' , data1: '11111' , data2: 111 , data3: { data3_1: '101', data3_2: 1111 } };
}
