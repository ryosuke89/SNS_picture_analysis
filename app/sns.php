<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

//エラーを表示させない処理
if(empty($_GET['sns'])){
    $_GET['sns'] = null;
    ?>
    <!--GETを受け取れない場合、トップページに移動する処理-->
    <meta http-equiv="refresh" content="0; URL=<?php echo ROOT_URL; ?>">
    <?php
}

//categoryテーブルの値を割合が高い順に取得
$result_category = select_category(ex_sns($_GET['sns']));
//kindテーブルの値を割合が高い順に取得
$result_kind = select_kind(ex_sns($_GET['sns']));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>SNS Photos</title>
  <link rel="stylesheet" type="text/css" href="../css/css_sns.css">
  <!--AJAX APIの読み込み-->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="scriptUtil.php"></script>
  <script type="text/javascript">
  //SNSごとの割合の円グラフを表示する処理の取得
  <?php chart($_GET['sns'], $result_category); ?>
  </script>
</head>
  <body>
    <div id="header"><div class="title"><a href="<?php echo ROOT_URL; ?>">
    <span style="vertical-align: middle; font-size: 35px;">SNS Photos</span></a>
    <span style="vertical-align: 3px; font-size: 50%; margin-left: 20px">
    SNSに投稿されている画像の傾向分析サイト</span></div></div>
    <div id="content">
    <!--円グラフの表示-->
    <div id="chart_div"></div>
    <form action="<?php echo SNS; ?>" method="POST">
      <?php
      //配列、配列番号の初期化
      $url_array = array();
      $key = 0;
      ?>
      <div class="category">
      <?php
      //カテゴリーごとの種類の割合をテーブル型で表示
      foreach($result_category as $value_category){
          ?>
          <a href="<?php echo CATEGORY_DETAIL; ?>?sns=<?php echo $_GET['sns']; ?>&category=<?php echo $value_category['categoryName']; ?>">
          <span style="font-size: 20px;"><?php echo $value_category['categoryName']; ?></a>の割合：<?php echo $value_category['categoryPercentage']; ?>％</span>
          <table class="table">
            <tr>
              <th>種類</th>
              <th>割合</th>
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
            ?>
          </table>
          <div class="photo">
            <?php
            //カテゴリーごとの画像の番号を取得
            $result_photoID = photoID_calc(ex_sns($_GET['sns']), $value_category['categoryName']);
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
      ?>
    </form></div>
    <div id="footer">
    <div class="link">
    <?php echo return_top(); ?>
    <span style="margin-left: 63px">
    <a href="<?php echo CONTACT; ?>">お問い合わせ</a></span></div></div>
  </body>
</html>
