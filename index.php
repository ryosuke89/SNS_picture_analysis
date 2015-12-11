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
    <form action="<?php echo SNS; ?>" method="POST">
      SNS<br><br>
      <a href="<?php echo SNS; ?>">Twitter</a><br>
      <a href="<?php echo SNS; ?>">Facebook</a><br>
      <a href="<?php echo SNS; ?>">Google+</a><br><br><br>

      カテゴリー<br><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>">動物</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>">風景</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>">料理</a><br><br><br>

      サブサービス<br><br>
      サブサービス1<br>
      サブサービス2<br>
      サブサービス3<br><br>

      <!--トップページへのリンク-->
      <?php echo return_top(); ?><br>
      <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
    </form>
  </body>
</html>
