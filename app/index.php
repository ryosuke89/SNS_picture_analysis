<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

//categoryテーブルの値を割合が高い順に取得
$result_category = select_all_category();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
  <!-- AJAX API の読み込み -->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">

    // 円グラフパッケージとVisualization APIの読み込み
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Visualization APIを呼び出したときに実行するコールバックの設定
    google.setOnLoadCallback(drawChart);

    // データテーブルの作成と挿入のコールバック。
    // 円グラフを作成し、データを渡し、描画する
    function drawChart() {

      // データテーブルの作成
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'SNS全体');
      data.addColumn('number', '割合');
      //円グラフにSNS全体の割合を表示する処理
      <?php
      foreach($result_category as $value_category){
      ?>
      data.addRows([
        ['<?php echo $value_category['categoryName']; ?>', <?php echo $value_category['categoryPercentage']; ?>]
      ]);
      <?php
      }
      ?>

      // チャートオプションの設定
      var options = {'title':'SNS全体の割合',
                     'width':600,
                     'height':400};

      // いくつかのオプションを渡してチャートを描画する
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
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
      <a href="<?php echo SNS; ?>?sns=Google+">Google+</a><br><br><br>

      カテゴリー<br><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>?category=風景">風景</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>?category=物品">物品</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>?category=人物">人物</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>?category=絵・図">絵・図</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>?category=動物">動物</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>?category=食品・料理">食品・料理</a><br>
      <a href="<?php echo CATEGORY_DETAIL; ?>?category=乗り物">乗り物</a><br><br><br>

      サブサービス<br><br>
      サブサービス1<br>
      サブサービス2<br>
      サブサービス3<br><br>
    </form>

    <!--フッター-->
    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
