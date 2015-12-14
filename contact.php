<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
</head>
  <body>
    <h1><a href="<?php echo ROOT_URL ?>">SNS Photos</a></h1>
    <h4>SNSに投稿されている画像の傾向分析サイト</h4><br>
    <form action="<?php echo CONTACT_CONFIRM; ?>" method="POST">
      <h3>お問い合わせ</h3>
      <!--再入力時用-->
      <?php session_start(); ?>
      <table>
        <tr>
          <td>お名前：</td>
          <td><input type="text" name="name" value="<?php echo contact_session('name'); ?>"></td>
        </tr><br><br>

        <tr>
          <td>メールアドレス：</td>
          <td><input type="text" name="mail_address" value="<?php echo contact_session('mail_address'); ?>"></td>
        </tr><br><br>

        <tr>
          <td>お問い合わせの種類：</td>
          <td><select name="contact_kind">
            <option value="">--選択してください--</option>
            <option value="使い方" <?php if(contact_session('contact_kind') == "使い方"){echo "selected";} ?>>使い方</option>
            <option value="問題点・改善点" <?php if(contact_session('contact_kind') == "問題点・改善点"){echo "selected";} ?>>問題点・改善点</option>
            <option value="その他" <?php if(contact_session('contact_kind') == "その他"){echo "selected";} ?>>その他</option>
          </select></td><br><br>
        </tr>

        <tr><td>お問い合わせ内容：
          <td><textarea name="contact_contents" rows=10 cols=50 style="resize:none" wrap="hard"><?php echo contact_session('contact_contents'); ?></textarea></td><br><br><br>
        </tr>
      </table>
      <!--アクセスルートの確認用-->
      <input type="hidden" name="mode" value="CONFIRM">
      <input type="submit" name="confirm" value="入力内容を確認する"><br>
    </form>

    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
