<?php
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';

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
  <!--AJAX APIの読み込み-->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="scriptUtil.php"></script>
  <script type="text/javascript">
  //SNSごとの割合の円グラフを表示する処理の取得
  <?php chart($_GET['sns'], $result_category); ?>
  </script>
</head>
  <body>
    <h1><a href="<?php echo ROOT_URL; ?>">SNS Photos</a></h1>
    <h4>SNSに投稿されている画像の傾向分析サイト</h4><br>
    <!--円グラフの表示-->
    <div id="chart_div"></div>
    <form action="<?php echo SNS; ?>" method="POST">
      <?php
      //配列、配列番号の初期化
      $url_array = array();
      $key = 0;
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
            for($i = 0; $i < 6; $i++){
                ?>
                <img src="<?php echo $url_unique[$i]; ?>" width="100" height="100"/>
                <?php
            }

            //配列、配列番号の初期化
            $url_array = array();
            $key = 0;
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
