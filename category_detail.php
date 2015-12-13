<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
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
      data.addColumn('string', 'SNSでの種類');
      data.addColumn('number', '割合');
      data.addRows([
        ['犬', 40],
        ['猫', 40],
        ['その他', 20]
      ]);

      // チャートオプションの設定
      var options = {'title':'Twitterでの動物の割合',
                     'width':600,
                     'height':400};

      // いくつかのオプションを渡してチャートを描画する
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
</head>
  <body>
    <h1><a href="<?php echo ROOT_URL ?>">SNS Photos</a></h1>
    <h4>SNSに投稿されている画像の傾向分析サイト</h4><br>
    <!--円グラフの表示-->
    <div id="chart_div"></div>
    <form action="<?php echo SNS; ?>" method="POST">
    </form>

    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
