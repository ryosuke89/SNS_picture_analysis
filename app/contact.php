<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
  <link rel="stylesheet" type="text/css" href="../css/css_contact.css">
</head>
  <body>
    <div id="header"><div class="title"><a href="<?php echo ROOT_URL; ?>">
    <span style="vertical-align: middle; font-size: 35px;">SNS Photos</span></a>
    <span style="vertical-align: 3px; font-size: 50%; margin-left: 20px">
    SNSに投稿されている画像の傾向分析サイト</span></div></div>
    <div id="content">
    <form action="<?php echo CONTACT_CONFIRM; ?>" method="POST">
      <div class="text">お問い合わせ</div>
      <!--再入力時用-->
      <?php session_start(); ?>
          <label for="name">お名前：</label>
          <input type="text" name="name" value="<?php echo contact_session('name'); ?>"><br>

          <label for="mail_address">メールアドレス：</label>
          <input type="text" name="mail_address" value="<?php echo contact_session('mail_address'); ?>"><br>

          <label for="contact_kind">お問い合わせの種類：</label>
          <select name="contact_kind">
            <option value="">--選択してください--</option>
            <option value="使い方" <?php if(contact_session('contact_kind') == "使い方"){echo "selected";} ?>>使い方</option>
            <option value="問題点・改善点" <?php if(contact_session('contact_kind') == "問題点・改善点"){echo "selected";} ?>>問題点・改善点</option>
            <option value="その他" <?php if(contact_session('contact_kind') == "その他"){echo "selected";} ?>>その他</option>
          </select><br>

          <label for="contact_contents">お問い合わせ内容：</label>
          <textarea name="contact_contents" rows=10 cols=50 style="resize:none" wrap="hard"><?php echo contact_session('contact_contents'); ?></textarea></div><br>
      <!--アクセスルートの確認用-->
      <div class="submit">
      <input type="hidden" name="mode" value="CONFIRM">
      <input type="submit" name="confirm" value="入力内容を確認する">
    </form></div>
    <div id="footer">
    <div class="link">
    <?php echo return_top(); ?>
    <span style="margin-left: 63px">
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a></span></div></div>
  </body>
</html>
