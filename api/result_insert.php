<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //カテゴリーテーブル、種類テーブルにレコードがないことを確認する
    $db_category = true; //trueの場合：カテゴリーの集計結果をDBに追加
    $db_kind = true;     //trueの場合：種類の集計結果をDBに追加
    //SNSの番号を入力
    $snsID = 0; //0の場合：全てのSNS

    //カテゴリーごとの数を取得
    $result_category = category_calc($snsID);
    //種類ごとの数を取得
    $result_kind = kind_calc($snsID);
    //レコード件数の取得
    $result_count = count_calc($snsID);
    ?>

    <table border=1>
      <tr>
        <th>カテゴリーの番号</th>
        <th>カテゴリー名</th>
        <th>カテゴリーの割合</th>
        <th>SNSの番号</th>
      </tr>
      <?php
      $categoryID = 0;
      //カテゴリーの集計結果を表示
      foreach($result_category as $value_category){
          $categoryID = $categoryID + 1;
          $categoryName = $value_category['calcCategory'];
          $categoryPercentage = $value_category['count(calcCategory)'] / $result_count[0]['count(*)'] * 100;
          $category_snsID = $value_category['snsID'];
          ?>
          <tr>
            <th><?php echo $categoryID; ?></th>
            <th><?php echo $categoryName; ?></th>
            <th><?php echo $categoryPercentage; ?></th>
            <th><?php echo $category_snsID; ?></th>
          </tr>
          <?php
          //カテゴリーの集計結果をDBに追加
          if($db_category == true){
              $insert_category = insert_category($categoryID, $categoryName, $categoryPercentage, $category_snsID);
          }
      }
      //エラーが発生しなければ表示
      if(!isset($insert_category) && $db_category == true){
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
      $kindID = 0;
      //種類の集計結果を表示
      foreach($result_kind as $value_kind){
          $kindID = $kindID + 1;
          $kindName = $value_kind['calcKind'];
          $kindPercentage = $value_kind['count(calcKind)'] / $result_count[0]['count(*)'] * 100;
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
          if($db_kind == true){
              $insert_kind = insert_kind($kindID, $kindName, $kindPercentage, $kind_snsID, $kind_categoryID);
          }
      }
      //エラーが発生しなければ表示
      if(!isset($insert_kind) && $db_kind == true){
          echo '種類の集計結果をDBに追加しました。<br> . <br>';
      }else{
          echo '種類の集計結果<br> . <br>';
      }
      ?>
    </table>
  </body>
</html>
