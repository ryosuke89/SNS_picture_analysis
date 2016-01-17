<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

//categoryテーブルの値を割合が高い順に取得
$result_category = select_category(5);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
  <link rel="stylesheet" type="text/css" href="../css/css_index.css">
  <!--AJAX APIの読み込み-->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="scriptUtil.php"></script>
  <script type="text/javascript">
  //SNS全体の割合の円グラフを表示する処理の取得
  <?php chart(null, $result_category); ?>
  </script>
</head>
  <body>
    <!--ヘッダー-->
    <div id="header"><div class="title"><a href="<?php echo ROOT_URL; ?>">
    <span style="vertical-align: middle; font-size: 35px;">SNS Photos</span></a>
    <span style="vertical-align: 3px; font-size: 50%; margin-left: 20px">
    SNSに投稿されている画像の傾向分析サイト</span></div></div>
    <div id="content">
    <!--円グラフの表示-->
    <div id="chart_div"></div>
    <form action="<?php echo SNS; ?>" method="POST">
      <div class="sns">
      <div class="text">
      SNS</div>
      <a href="<?php echo SNS; ?>?sns=Twitter">Twitter</a><br>
      Facebook<br>
      Google+<br>
      Instagram</div>

      <div class="category">
      <div class="text">
      カテゴリー</div>
      <?php
      foreach($result_category as $value_category){
          ?>
          <a href="<?php echo CATEGORY_DETAIL; ?>?category=<?php echo $value_category['categoryName']; ?>"><?php echo $value_category['categoryName']; ?></a><br>
          <?php
      }
      ?>
      <br><br></div>
    </form></div>

    <!--フッター-->
    <div id="footer">
    <div class="link">
    <?php echo return_top(); ?>
    <span style="margin-left: 63px">
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a></span></div></div>
  </body>
</html>
