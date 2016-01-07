<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

//categoryテーブルの値を取得
$result_category = select_detail_category($_GET['category']);
//kindテーブルの値を割合が高い順に取得
$result_kind = select_detail_kind($result_category[0]['categoryID']);
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
      //円グラフに種類の割合を表示する処理
      <?php
      foreach($result_kind as $value_kind){
      ?>
      data.addRows([
        ['<?php echo $value_kind['kindName']; ?>', <?php echo $value_kind['kindPercentage']; ?>]
      ]);
      <?php
      }
      ?>

      // チャートオプションの設定
      var options = {'title':'<?php if(empty($_GET['sns'])){echo 'Twitterでの' . $_GET['category']; }else{echo $_GET['sns'] . 'での' . $_GET['category']; } ?>の割合',
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
      <table border=1>
        <tr>
          <td>種類</td>
          <td>割合</td>
        </tr>
        <?php
        //種類の割合をテーブル型で表示
        foreach($result_kind as $value_kind){
            ?>
            <tr>
              <td><?php echo $value_kind['kindName']; ?></td>
              <td><?php echo $value_kind['kindPercentage']; ?>％</td>
            </tr>
            <?php
        }

        //snsIDの取得
        if(empty($_GET['sns'])){
            $snsID = null;
        }else{
            $snsID = ex_sns($_GET['sns']);
        }

        foreach($result_category as $value_category){
            //カテゴリーごとの画像の番号を取得
            $result_photoID = photoID_calc($snsID, $value_category['categoryName']);
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
        }
        ?>
      </table><br>
    </form>

    <?php echo return_top(); ?><br>
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a>
  </body>
</html>
