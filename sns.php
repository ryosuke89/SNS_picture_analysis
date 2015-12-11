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
      <a href="<?php echo CATEGORY_DETAIL; ?>">動物</a>の割合：40％<br><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>">風景</a>の割合：30％<br><br>

      <?php echo return_top(); ?><br>
      <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
    </form>
  </body>
</html>
