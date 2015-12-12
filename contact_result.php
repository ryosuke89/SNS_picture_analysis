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

    <?php
    session_start();
    echo 'お名前：' . $_SESSION['name'] . "<br>";
    echo 'メールアドレス：' . $_SESSION['mail_address'] . "<br>";
    echo 'お問い合わせの種類：' . $_SESSION['contact_kind'] . "<br>";
    echo 'お問い合わせ内容：' . $_SESSION['contact_contents'] . "<br>" . "<br>";
    ?>
    上記の内容で送信しました。<br><br>

    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
