<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

//categoryテーブルの値を取得
$result_category = select_detail_category($_GET['category']);

//配列、配列番号の初期化
$kind_array = array();
$key = 0;

//kindテーブルの値を割合が高い順に取得
foreach($result_category as $value_category){
    $result_kind = select_detail_kind($value_category['categoryID']);
    //全ての配列を結合
    foreach($result_kind as $value_kind){
        $kind_array += array($key=>$value_kind);
        $key = $key + 1;
    }
}

//GETの取得
if(empty($_GET['sns'])){
    $sns = null;
}else{
    $sns = $_GET['sns'];
}
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
  //カテゴリーごとの割合の円グラフを表示する処理の取得
  <?php detail_chart($sns, $_GET['category'], $kind_array); ?>
  </script>
</head>
  <body>
    <h1><a href="<?php echo ROOT_URL; ?>">SNS Photos</a></h1>
    <h4>SNSに投稿されている画像の傾向分析サイト</h4><br>
    <!--円グラフの表示-->
    <div id="chart_div1"></div>
    <div id="chart_div2"></div>
    <div id="chart_div3"></div>
    <div id="chart_div4"></div>
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
                    <img src="<?php echo $value_url['photoURL']; ?>" width="100" height="100"/>
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
