<div class="account_form">
  <form action="" id="agent_reg_form" method="POST" autocomplete="off">
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">エージェントサービス名</h3>
      <div class="account_form__sec__box">
        <input type="text" name="agent_name" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">契約開始日</h3>
      <div class="account_form__sec__box">
        <input type="datetime-local" step="1" name="start_at" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">契約終了日</h3>
      <div class="account_form__sec__box">
        <input type="datetime-local" step="1" name="expires_at" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">公開、非公開</h3>
      <div class="account_form__sec__box">
        <label class="account_form__sec__box__label">
          <select name="publication" class="account_form__sec__box__label__select">
            <option value="0">非公開</option>
            <option value="1">公開</option>
          </select>
        </label>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">求人の多さ</h3>
      <div class="account_form__sec__box">
        <input type="number" name="evaluation1" required min="1" max="5">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">サービスの充実度</h3>
      <div class="account_form__sec__box">
        <input type="number" name="evaluation2" required min="1" max="5">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">コンサルタントの質</h3>
      <div class="account_form__sec__box">
        <input type="number" name="evaluation3" required min="1" max="5">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">タグ</h3>
      <div class="tag_container">

        <input type="checkbox" id="custom1" value="1" name="tag">
        <label for="custom1" class="custom-style">文系</label>
        <input type="checkbox" id="custom2" value="2" name="tag">
        <label for="custom2" class="custom-style">理系</label>
        <input type="checkbox" id="custom3" value="3" name="tag">
        <label for="custom3" class="custom-style">その他</label>
        <input type="checkbox" id="custom4" value="4" name="tag">
        <label for="custom4" class="custom-style">西日本</label>
        <input type="checkbox" id="custom5" value="5" name="tag">
        <label for="custom5" class="custom-style">東日本</label>
        <input type="checkbox" id="custom6" value="6" name="tag">
        <label for="custom6" class="custom-style">事務系</label>
        <input type="checkbox" id="custom7" value="7" name="tag">
        <label for="custom7" class="custom-style">営業系</label>
        <input type="checkbox" id="custom8" value="8" name="tag">
        <label for="custom8" class="custom-style">販売系</label>
        <input type="checkbox" id="custom9" value="9" name="tag">
        <label for="custom9" class="custom-style">IT系</label>
        <input type="checkbox" id="custom10" value="10" name="tag">
        <label for="custom10" class="custom-style">技術系</label>
        <input type="checkbox" id="custom11" value="11" name="tag">
        <label for="custom11" class="custom-style">専門系</label>
        <input type="checkbox" id="custom12" value="12" name="tag">
        <label for="custom12" class="custom-style">就活イベント</label>
        <input type="checkbox" id="custom13" value="13" name="tag">
        <label for="custom13" class="custom-style">面接トレーニング</label>
        <input type="checkbox" id="custom14" value="14" name="tag">
        <label for="custom14" class="custom-style">スカウトサービス</label>
        <input type="checkbox" id="custom15" value="15" name="tag">
        <label for="custom15" class="custom-style">書類選考免除</label>
        <input type="checkbox" id="custom16" value="16" name="tag">
        <label for="custom16" class="custom-style">地方就活</label>
        <input type="checkbox" id="custom17" value="17" name="tag">
        <label for="custom17" class="custom-style">入社後定着率</label>
        <input type="checkbox" id="custom18" value="18" name="tag">
        <label for="custom18" class="custom-style">スピード内定</label>
        <input type="checkbox" id="custom19" value="19" name="tag">
        <label for="custom19" class="custom-style">オンライン面接</label>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">紹介文</h3>
      <div class="account_form__sec__box">
        <input type="text" name="intro" required maxlength="2000">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">こんな就活生にピッタリ</h3>
      <div class="account_form__sec__box">
        <input type="text" name="paragraph1" required maxlength="2000">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">他にはない強み</h3>
      <div class="account_form__sec__box">
        <input type="text" name="paragraph2" required maxlength="2000">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">得意な業種、職種</h3>
      <div class="account_form__sec__box">
        <input type="text" name="paragraph3" required maxlength="2000">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">就活生へのサポート</h3>
      <div class="account_form__sec__box">
        <input type="text" name="paragraph4" required maxlength="2000">
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">就活生に一言</h3>
      <div class="account_form__sec__box">
        <input type="text" name="paragraph5" required maxlength="2000">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">最後に</h3>
      <div class="account_form__sec__box">
        <input type="text" name="paragraph6" required maxlength="2000">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">管理人からのコメント</h3>
      <div class="account_form__sec__box">
        <input type="text" name="paragraph7" required maxlength="2000">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">URL</h3>
      <div class="account_form__sec__box">
        <input type="url" name="url" required maxlength="2000">
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">EMAIL</h3>
      <div class="account_form__sec__box">
        <input type="email" name="email" required maxlength="255">
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">電話番号</h3>
      <div class="account_form__sec__box">
        <input type="tel" name="tel" required maxlength="15">
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">会社名</h3>
      <div class="account_form__sec__box">
        <input type="text" name="company_name" required>
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">会社所在地</h3>
      <div class="account_form__sec__box">
        <input type="text" name="address" required>
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">会社電話番号</h3>
      <div class="account_form__sec__box">
        <input type="tel" name="agent_tel" required>
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">代表者氏名</h3>
      <div class="account_form__sec__box">
        <input type="text" name="pres_name" required>
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">担当者氏名</h3>
      <div class="account_form__sec__box">
        <input type="text" name="pic_name" required>
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">担当者電話番号</h3>
      <div class="account_form__sec__box">
        <input type="tel" name="pic_tel" required>
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">担当者メールアドレス</h3>
      <div class="account_form__sec__box">
        <input type="email" name="pic_email" required>
      </div>
    </div>
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">通知用メールアドレス</h3>
      <div class="account_form__sec__box">
        <input type="email" name="  notification_email" required>
      </div>
    </div>
  </form>

  <?php
  include(dirname(__FILE__) . '/../atoms/_btn.php');
  ?>
</div>
