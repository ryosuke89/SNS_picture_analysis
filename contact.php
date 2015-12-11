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

      お名前：　　　　　　　　　　
      <input type="text" name="name">
      <br><br>

      メールアドレス：　　　　　
      <input type="text" name="name">
      <br><br>

      お問い合わせの種類：　
      <select name="column">
        <option value="" selected>--選択してください--</option>
        <option value="使い方">使い方</option>
        <option value="その他">その他</option>
      </select><br><br>

      お問い合わせ内容：　　
      <textarea name="comment" rows=10 cols=50 style="resize:none" wrap="hard"></textarea><br><br><br>
        　　　　　　　　　　　　　　　　<input type="submit" name="NO" value="入力内容を確認する"><br>
      <?php echo return_top(); ?><br>
      <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
    </form>
  </body>
</html>
