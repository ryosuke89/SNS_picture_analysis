<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

//categoryテーブルの値を割合が高い順に取得
$result_category = select_sns_category(ex_sns($_GET['sns']));
//kindテーブルの値を割合が高い順に取得
$result_kind = select_sns_kind(ex_sns($_GET['sns']));
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
      data.addColumn('string', 'カテゴリー');
      data.addColumn('number', '割合');
      //円グラフにSNSの割合を表示する処理
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
      var options = {'title':'<?php if($_GET['sns'] == 'Google '){echo 'Google+';}else{echo $_GET['sns'];} ?>の割合',
                     'width':600,
                     'height':400};

      // いくつかのオプションを渡してチャートを描画する
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
</head>
  <body>
    <h1><a href="<?php echo ROOT_URL; ?>">SNS Photos</a></h1>
    <h4>SNSに投稿されている画像の傾向分析サイト</h4><br>
    <!--円グラフの表示-->
    <div id="chart_div"></div>
    <form action="<?php echo SNS; ?>" method="POST">
      <?php
      //カテゴリーごとの種類の割合をテーブル型で表示
      foreach($result_category as $value_category){
          ?>
          <a href="<?php echo CATEGORY_DETAIL; ?>?sns=<?php echo $_GET['sns']; ?>&category=<?php echo $value_category['categoryName']; ?>"><?php echo $value_category['categoryName']; ?></a>の割合：<?php echo $value_category['categoryPercentage']; ?>％<br>
          <table border=1>
            <tr>
              <td>種類</td>
              <td>割合</td>
            </tr>
            <?php
            foreach($result_kind as $value_kind){
                if($value_category['categoryID'] == $value_kind['categoryID']){
                    ?>
                    <tr>
                      <td><?php echo $value_kind['kindName']; ?></td>
                      <td><?php echo $value_kind['kindPercentage']; ?>％</td>
                    </tr>
                    <?php
                }
            }
            //カテゴリーごとの画像の番号を取得
            $result_photoID = photoID_calc(ex_sns($_GET['sns']), $value_category['categoryName']);
            //カテゴリーごとの画像のURLを取得
            foreach($result_photoID as $value_photoID){
                $result_url = url_photo($value_photoID['photoID']);
                //画像の表示
                foreach($result_url as $value_url){
                    ?>
                    <img src="<?php echo $value_url['photoURL']; ?>" width="80" height="80"/>
                    <?php
                }
            }
            ?>
          </table><br>
          <?php
      }
      ?>
    </form>

    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
