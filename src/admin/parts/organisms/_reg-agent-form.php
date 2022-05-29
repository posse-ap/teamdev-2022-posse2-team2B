<div class="account_form">
  <form action="" id="acc_form" method="POST" autocomplete="off">
    <div class="account_form__sec">
      <h3 class="account_form__sec__title">エージェント会社名</h3>
      <div class="account_form__sec__box">
        <input type="text" name="agent_name" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">契約開始日</h3>
      <div class="account_form__sec__box">
        <input type="datetime-local" step="60" name="start_at" required>
      </div>
    </div>

    <div class="account_form__sec">
      <h3 class="account_form__sec__title">契約終了日</h3>
      <div class="account_form__sec__box">
        <input type="datetime-local" step="60" name="expires_at" required>
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
      <h3 class="account_form__sec__title">エージェントID</h3>
      <div class="account_form__sec__box">
        <input type="number" name="agent_id" required>
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
        <input type="tel" name="tel" required>
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
