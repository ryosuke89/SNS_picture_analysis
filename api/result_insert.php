<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //カテゴリーテーブル、種類テーブルにレコードがないことを確認する
    $db = false; //trueの場合：集計結果をDBに追加
    //SNSの番号を入力
    $snsID = 0; //0の場合：全てのSNS

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
          $category_snsID = $value_category['snsID'];
          ?>
          <tr>
            <th><?php echo $categoryName; ?></th>
            <th><?php echo $categoryPercentage; ?></th>
            <th><?php echo $category_snsID; ?></th>
          </tr>
          <?php
          //カテゴリーの集計結果をDBに追加
          if($db == true){
              $insert_category = insert_category($categoryName, $categoryPercentage, $category_snsID);
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
    $select_category = select_category();
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
      for($i = 0; $i < 8; $i++){
          //種類ごとの件数を取得
          $result_kind = kind_calc($snsID, $select_category[$i]['categoryName']);
          //カテゴリーごとのレコード件数を取得
          $result_category_count = count_category_calc($snsID, $select_category[$i]['categoryName']);

          //種類の集計結果を表示
          foreach($result_kind as $value_kind){
              $kindName = $value_kind['calcKind'];
              $kindPercentage = $value_kind['count(calcKind)'] / $result_category_count[0]['count(*)'] * 100;
              $kind_snsID = $value_kind['snsID'];
              foreach($select_category as $value_category){
                  if($value_category['categoryName'] == $value_kind['calcCategory']){
                      $kind_categoryID = $value_category['categoryID'];
                  }
              }
              ?>
              <tr>
                <th><?php echo $kindName; ?></th>
                <th><?php echo $kindPercentage; ?></th>
                <th><?php echo $kind_snsID; ?></th>
                <th><?php echo $kind_categoryID; ?></th>
              </tr>
              <?php
              //種類の集計結果をDBに追加
              if($db == true){
                  $insert_kind = insert_kind($kindName, $kindPercentage, $kind_snsID, $kind_categoryID);
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
