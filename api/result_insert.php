<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //SNSの番号を入力
    $snsID = 5;   //1:Twitter、2:Facebook、3:Google+、4:Instagram、5:SNS全体
    //同じSNSのレコードがないことを確認する
    $db = false;  //trueの場合：集計結果をDBに追加
    //カテゴリーの数を指定
    $num = 8;

    //カテゴリーごとの件数を取得
    $result_category = category_calc($snsID);
    //レコード件数の取得
    $result_all_count = count_all_calc($snsID);
    ?>

    <table border=1>
      <tr>
        <th>カテゴリー名</th>
        <th>カテゴリーの割合</th>
        <th>SNSの番号</th>
      </tr>
      <?php
      //カテゴリーの集計結果を表示
      foreach($result_category as $value_category){
          $categoryName = $value_category['calcCategory'];
          $categoryPercentage = $value_category['count(calcCategory)'] / $result_all_count[0]['count(*)'] * 100;
          ?>
          <tr>
            <th><?php echo $categoryName; ?></th>
            <th><?php echo $categoryPercentage; ?></th>
            <th><?php echo $snsID; ?></th>
          </tr>
          <?php
          //カテゴリーの集計結果をDBに追加
          if($db == true){
              $insert_category = insert_category($categoryName, $categoryPercentage, $snsID);
          }
      }
      //エラーが発生しなければ表示
      if(!isset($insert_category) && $db == true){
          echo 'カテゴリーの集計結果をDBに追加しました。<br> . <br>';
      }else{
          echo 'カテゴリーの集計結果<br> . <br>';
      }
      ?>
    </table>
    <?php
    echo "<br>";

    //カテゴリーの集計結果を取得
    $select_category = select_all('category');
    ?>
    <table border=1>
      <tr>
        <th>種類名</th>
        <th>種類の割合</th>
        <th>SNSの番号</th>
        <th>カテゴリーの番号</th>
      </tr>
      <?php
      //カテゴリーごとに種類の集計結果を取得
      for($i = 0; $i < $num; $i++){
          //種類ごとの件数を取得
          $result_kind = kind_calc($snsID, $select_category[$i]['categoryName']);
          //カテゴリーごとのレコード件数を取得
          $result_category_count = count_category_calc($snsID, $select_category[$i]['categoryName']);

          //種類の集計結果を表示
          foreach($result_kind as $value_kind){
              $kindName = $value_kind['calcKind'];
              $kindPercentage = $value_kind['count(calcKind)'] / $result_category_count[0]['count(*)'] * 100;
              foreach($select_category as $value_category){
                  if($value_category['categoryName'] == $value_kind['calcCategory'] && $value_category['snsID'] == $snsID){
                      $kind_categoryID = $value_category['categoryID'];
                  }
              }
              ?>
              <tr>
                <th><?php echo $kindName; ?></th>
                <th><?php echo $kindPercentage; ?></th>
                <th><?php echo $snsID; ?></th>
                <th><?php echo $kind_categoryID; ?></th>
              </tr>
              <?php
              //種類の集計結果をDBに追加
              if($db == true){
                  $insert_kind = insert_kind($kindName, $kindPercentage, $snsID, $kind_categoryID);
              }
          }
      }
      //エラーが発生しなければ表示
      if(!isset($insert_kind) && $db == true){
          echo '種類の集計結果をDBに追加しました。<br> . <br>';
      }else{
          echo '種類の集計結果<br> . <br>';
      }
      ?>
    </table>
  </body>
</html>
