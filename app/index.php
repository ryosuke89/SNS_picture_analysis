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
    <h1><a href="<?php echo ROOT_URL; ?>">SNS Photos</a></h1>
    <h4>SNSに投稿されている画像の傾向分析サイト</h4><br>
    <!--円グラフの表示-->
    <div id="chart_div"></div>
    <form action="<?php echo SNS; ?>" method="POST">
      SNS<br><br>
      <a href="<?php echo SNS; ?>?sns=Twitter">Twitter</a><br>
      <a href="<?php echo SNS; ?>?sns=Facebook">Facebook</a><br>
      Google+<br>
      Instagram<br><br><br>

      カテゴリー<br><br>
      <?php
      foreach($result_category as $value_category){
          ?>
          <a href="<?php echo CATEGORY_DETAIL; ?>?category=<?php echo $value_category['categoryName']; ?>"><?php echo $value_category['categoryName']; ?></a><br>
          <?php
      }
      ?>
      <br><br>
    </form>

    <!--フッター-->
    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
