<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

//エラーを表示させない処理
if(empty($_GET['category'])){
    $_GET['category'] = null;
    ?>
    <!--GETを受け取れない場合、トップページに移動する処理-->
    <meta http-equiv="refresh" content="0; URL=<?php echo ROOT_URL; ?>">
    <?php
}

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
    $get_sns = null;
}else{
    $get_sns = $_GET['sns'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
  <link rel="stylesheet" type="text/css" href="../css/css_category_detail.css">
  <!--AJAX APIの読み込み-->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="scriptUtil.php"></script>
  <script type="text/javascript">
  //カテゴリーごとの割合の円グラフを表示する処理の取得
  <?php detail_chart($get_sns, $_GET['category'], $kind_array); ?>
  </script>
</head>
  <body>
    <div id="header"><div class="title"><a href="<?php echo ROOT_URL; ?>">
    <span style="vertical-align: middle; font-size: 35px;">SNS Photos</span></a>
    <span style="vertical-align: 3px; font-size: 50%; margin-left: 20px">
    SNSに投稿されている画像の傾向分析サイト</span></div></div>
    <div id="content">
    <form action="<?php echo SNS; ?>" method="POST">
      <?php
      //配列、配列番号の初期化
      $url_array = array();
      $key = 0;

      //snsIDの取得
      if(empty($_GET['sns'])){
          $snsID = null;
      }else{
          $snsID = ex_sns($_GET['sns']);
      }

      //種類の割合をテーブル型で表示
      foreach($result_category as $value_category){
          if(empty($snsID) || $value_category['snsID'] == $snsID){
              ?>
              <!--円グラフの表示-->
              <div id="chart_div<?php echo $value_category['snsID'];?>"></div>
              <table class="table">
                <tr>
                  <th>種類</th>
                  <th>割合</th>
                </tr>
                <?php
                foreach($kind_array as $value_kind_array){
                    if($value_category['categoryID'] == $value_kind_array['categoryID']){
                        ?>
                        <tr>
                          <td><?php echo $value_kind_array['kindName']; ?></td>
                          <td><?php echo $value_kind_array['kindPercentage']; ?>％</td>
                        </tr>
                        <?php
                    }
                }
                ?>
              </table>
              <div class="photo">
                <?php
                //カテゴリーごとの画像の番号を取得
                $result_photoID = photoID_calc($value_category['snsID'], $value_category['categoryName']);
                //カテゴリーごとの画像のURLを取得
                foreach($result_photoID as $value_photoID){
                    $result_url = url_photo($value_photoID['photoID']);
                    //画像のURLを配列に格納
                    foreach($result_url as $value_url){
                        $url_array += array($key=>$value_url['photoURL']);
                        $key = $key + 1;
                    }
                }

                //重複する画像のURLを配列から削除
                $url_unique = array_unique($url_array);
                //画像のURLをランダムにする処理
                shuffle($url_unique);
                //画像の表示
                for($i = 0; $i < 4; $i++){
                    ?>
                    <img src="<?php echo $url_unique[$i]; ?>" width="150" height="150"/>
                    <?php
                }

                //配列、配列番号の初期化
                $url_array = array();
                $key = 0;
                ?>
              </div>
              <?php
          }
      }
      ?>
    </form></div>
    <div id="footer">
    <div class="link">
    <?php echo return_top(); ?>
    <span style="margin-left: 63px">
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a></span></div></div>
  </body>
</html>
