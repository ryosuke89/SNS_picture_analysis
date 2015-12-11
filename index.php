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
    <form action="./sns.php" method="POST">
      SNS<br><br>
      <a href="sns.php">Twitter</a><br>
      <a href="sns.php">Facebook</a><br>
      <a href="sns.php">Google+</a><br><br><br>

      カテゴリー<br><br>
      <a href="category_detail.php">動物</a><br>
      <a href="category_detail.php">風景</a><br>
      <a href="category_detail.php">料理</a><br><br><br>

      サブサービス<br><br>
      サブサービス1<br>
      サブサービス2<br>
      サブサービス3<br><br>

      <!--トップページへのリンク-->
      <?php echo return_top(); ?><br>
      <a href="contact.php">お問い合わせ</a>
    </form>
  </body>
</html>
