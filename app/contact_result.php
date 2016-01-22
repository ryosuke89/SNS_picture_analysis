<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
  <link rel="stylesheet" type="text/css" href="../css/css_contact_result.css">
</head>
  <body>
    <!--ヘッダー-->
    <div id="header">
      <div class="title">
        <a href="<?php echo ROOT_URL; ?>">
          <span style="vertical-align: middle; font-size: 35px;">SNS Photos</span>
        </a>
        <span style="vertical-align: 3px; font-size: 50%; margin-left: 20px">
          SNSに投稿されている画像の傾向分析サイト
        </span>
      </div>
    </div>

    <div id="content">
      <?php
      //URLで直接アクセスした場合、トップページに移動する処理
      if(empty($_POST['mode'])){
          ?>
          <meta http-equiv="refresh" content="0; URL=<?php echo ROOT_URL; ?>">
          <?php
      }elseif($_POST['mode'] == 'RESULT'){
          ?>
          <div class="text">送信結果</div>
          <?php
          session_start();
          echo 'お名前：' . $_SESSION['name'] . "<br>";
          echo 'メールアドレス：' . $_SESSION['mail_address'] . "<br>";
          echo 'お問い合わせの種類：' . $_SESSION['contact_kind'] . "<br>";
          echo 'お問い合わせ内容：' . $_SESSION['contact_contents'];
          ?>
          <div class="result">上記の内容で送信しました。</div>
          <?php
      }
      ?>
    </div>

    <!--フッター-->
    <div id="footer">
      <div class="link">
        <?php echo return_top(); ?>
        <span style="margin-left: 63px">
          <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
        </span>
      </div>
    </div>
  </body>
</html>
