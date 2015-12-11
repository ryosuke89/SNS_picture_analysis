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
    <form action="<?php echo CONTACT_RESULT; ?>" method="POST">

      <?php
      echo 'お名前：' . $_POST['name'] . "<br>";
      echo 'メールアドレス：' . $_POST['mail_address'] . "<br>";
      echo 'お問い合わせの種類：' . $_POST['contact_kind'] . "<br>";
      echo 'お問い合わせ内容：' . $_POST['contact_contents'] . "<br>" . "<br>";
      ?>
      上記の内容で送信します。よろしいですか？<br><br>
      <input type="submit" name="yes" style="width:70px" value="送信する"><br>
    </form>

    <form action="<?php echo CONTACT; ?>" method="POST">
      <input type="submit" name="no" style="width:70px" value="戻る"><br>
    </form>

      <?php echo return_top(); ?><br>
      <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
