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
      <table>
        <tr>
          <td>お名前：</td>
          <td><input type="text" name="name"></td>
        </tr><br><br>

        <tr>
          <td>メールアドレス：</td>
          <td><input type="text" name="mail_address"></td>
        </tr><br><br>

        <tr>
          <td>お問い合わせの種類：</td>
          <td><select name="contact_kind">
            <option value="" selected>--選択してください--</option>
            <option value="使い方">使い方</option>
            <option value="その他">その他</option>
          </select></td><br><br>
        </tr>

        <tr><td>お問い合わせ内容：
          <td><textarea name="contact_contents" rows=10 cols=50 style="resize:none" wrap="hard"></textarea></td><br><br><br>
        </tr>
      </table>
      <input type="submit" name="confirm" value="入力内容を確認する"><br>
    </form>

    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
