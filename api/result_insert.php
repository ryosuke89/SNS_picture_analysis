<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //SNSの番号を入力
    $snsID = 0; //0の場合：全てのSNS

    $result_category = category_calc($snsID);
    //種類ごとの数を取得
    $result_kind = kind_calc($snsID);
    //レコード件数の取得
    $result_count = count_calc($snsID);
    //カテゴリーテーブルの表示
    $category = category();
    ?>

    カテゴリーテーブルの表示
    <table border=1>
      <tr>
        <th>カテゴリーの番号</th>
        <th>カテゴリー名</th>
        <th>カテゴリーの割合</th>
        <th>SNSの番号</th>
      </tr>
      <?php
      $number = 0;
      foreach($result_category as $value_category){
          $number = $number + 1;
          ?>
          <tr>
            <th><?php echo $number; ?></th>
            <th><?php echo $categoryName = $value_category['calcCategory']; ?></th>
            <th><?php echo $percentage = $value_category['count(calcCategory)'] / $result_count[0]['count(*)'] * 100; ?></th>
            <th><?php echo $snsID = $value_category['snsID']; ?></th>
          </tr>
          <?php
      }
      ?>
    </table>

    種類テーブルの表示
    <table border=1>
      <tr>
        <th>種類名</th>
        <th>種類の割合</th>
        <th>SNSの番号</th>
        <th>カテゴリーの番号</th>
      </tr>
      <?php
      foreach($result_kind as $value_kind){
          ?>
          <tr>
            <th><?php echo $value_kind['calcKind']; ?></th>
            <th><?php echo $value_kind['count(calcKind)'] / $result_count[0]['count(*)'] * 100; ?></th>
            <th><?php echo $value_kind['snsID']; ?></th>
            <th><?php foreach($category as $value_category){if($value_category['categoryName'] == $value_kind['calcCategory']){echo $value_category['categoryID'];}} ?></th>
          </tr>
          <?php
      }
      ?>
    </table>
  </body>
</html>
