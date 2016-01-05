<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //表示するテーブルの確認
    $photo = false;       //trueの場合：photoテーブルを表示
    $recognition = false; //trueの場合：recognitionテーブルを表示
    $list = false;        //trueの場合：listテーブルを表示
    $calc = false;        //trueの場合：calcテーブルを表示
    $category = false;    //trueの場合：categoryテーブルを表示
    $kind = false;        //trueの場合：kindテーブルを表示

    //画像のURLを表示
    if($photo == true){
        ?>
        <table border=1>
          <tr>
            <th>画像の番号</th>
            <th>画像のURL</th>
            <th>投稿日時</th>
            <th>SNSの番号</th>
          </tr>

          <?php
          $result_photo = select_photo();

          foreach($result_photo as $value_photo){
              ?>
              <tr>
                <td><?php echo $value_photo['photoID']; ?></td>
                <td><?php echo $value_photo['photoURL']; ?></td>
                <td><?php echo $value_photo['postedDatetime']; ?></td>
                <td><?php echo $value_photo['snsID']; ?></td>
              </tr>
              <?php
          }
          ?>
        </table>
        <?php
    }

    //画像認識の結果を表示
    if($recognition == true){
        ?>
        <table border=1>
          <tr>
            <th>画像認識の番号</th>
            <th>認識結果1</th>
            <th>認識結果2</th>
            <th>認識結果3</th>
            <th>認識結果4</th>
            <th>認識結果5</th>
            <th>認識結果6</th>
            <th>認識結果7</th>
            <th>認識結果8</th>
            <th>認識結果9</th>
            <th>認識結果10</th>
            <th>認識結果11</th>
            <th>認識結果12</th>
            <th>認識結果13</th>
            <th>認識結果14</th>
            <th>認識結果15</th>
            <th>認識結果16</th>
            <th>認識結果17</th>
            <th>認識結果18</th>
            <th>認識結果19</th>
            <th>認識結果20</th>
            <th>SNSの番号</th>
            <th>画像の番号</th>
          </tr>

          <?php
          $result_recognition = select_recognition();

          foreach($result_recognition as $value_recognition){
              ?>
              <tr>
                <td><?php echo $value_recognition['recognitionID']; ?></td>
                <td><?php echo $value_recognition['result1']; ?></td>
                <td><?php echo $value_recognition['result2']; ?></td>
                <td><?php echo $value_recognition['result3']; ?></td>
                <td><?php echo $value_recognition['result4']; ?></td>
                <td><?php echo $value_recognition['result5']; ?></td>
                <td><?php echo $value_recognition['result6']; ?></td>
                <td><?php echo $value_recognition['result7']; ?></td>
                <td><?php echo $value_recognition['result8']; ?></td>
                <td><?php echo $value_recognition['result9']; ?></td>
                <td><?php echo $value_recognition['result10']; ?></td>
                <td><?php echo $value_recognition['result11']; ?></td>
                <td><?php echo $value_recognition['result12']; ?></td>
                <td><?php echo $value_recognition['result13']; ?></td>
                <td><?php echo $value_recognition['result14']; ?></td>
                <td><?php echo $value_recognition['result15']; ?></td>
                <td><?php echo $value_recognition['result16']; ?></td>
                <td><?php echo $value_recognition['result17']; ?></td>
                <td><?php echo $value_recognition['result18']; ?></td>
                <td><?php echo $value_recognition['result19']; ?></td>
                <td><?php echo $value_recognition['result20']; ?></td>
                <td><?php echo $value_recognition['snsID']; ?></td>
                <td><?php echo $value_recognition['photoID']; ?></td>
              </tr>
              <?php
          }
          ?>
        </table>
        <?php
    }

    //リストの表示
    if($list == true){
        ?>
        <table border=1>
          <tr>
            <th>リストの番号</th>
            <th>リストの名前</th>
            <th>種類名</th>
            <th>カテゴリー名</th>
          </tr>

          <?php
          $result_list = select_list();

          foreach($result_list as $value_list){
              ?>
              <tr>
                <td><?php echo $value_list['listID']; ?></td>
                <td><?php echo $value_list['listName']; ?></td>
                <td><?php echo $value_list['listKind']; ?></td>
                <td><?php echo $value_list['listCategory']; ?></td>
              </tr>
              <?php
          }
          ?>
        </table>
        <?php
    }

    //認識結果1を変換した種類名の表示
    if($calc == true){
        ?>
        <table border=1>
          <tr>
            <th>計算の番号</th>
            <th>種類名</th>
            <th>カテゴリー名</th>
            <th>SNSの番号</th>
            <th>画像の番号</th>
          </tr>

          <?php
          $result_calc = select_calc();

          foreach($result_calc as $result_calc){
              ?>
              <tr>
                <td><?php echo $result_calc['calcID']; ?></td>
                <td><?php echo $result_calc['calcKind']; ?></td>
                <td><?php echo $result_calc['calcCategory']; ?></td>
                <td><?php echo $result_calc['snsID']; ?></td>
                <td><?php echo $result_calc['photoID']; ?></td>
              </tr>
              <?php
          }
          ?>
        </table>
        <?php
    }

    //カテゴリーの集計結果を表示
    if($category == true){
        ?>
        <table border=1>
          <tr>
            <th>カテゴリーの番号</th>
            <th>カテゴリー名</th>
            <th>カテゴリーの割合</th>
            <th>SNSの番号</th>
          </tr>

          <?php
          $result_category = select_category();

          foreach($result_category as $result_category){
              ?>
              <tr>
                <td><?php echo $result_category['categoryID']; ?></td>
                <td><?php echo $result_category['categoryName']; ?></td>
                <td><?php echo $result_category['categoryPercentage']; ?></td>
                <td><?php echo $result_category['snsID']; ?></td>
              </tr>
              <?php
          }
          ?>
        </table>
        <?php
    }

    //種類の集計結果を表示
    if($kind == true){
        ?>
        <table border=1>
          <tr>
            <th>種類の番号</th>
            <th>種類名</th>
            <th>種類の割合</th>
            <th>SNSの番号</th>
            <th>カテゴリーの番号</th>
          </tr>

          <?php
          $result_kind = select_kind();

          foreach($result_kind as $result_kind){
              ?>
              <tr>
                <td><?php echo $result_kind['kindID']; ?></td>
                <td><?php echo $result_kind['kindName']; ?></td>
                <td><?php echo $result_kind['kindPercentage']; ?></td>
                <td><?php echo $result_kind['snsID']; ?></td>
                <td><?php echo $result_kind['categoryID']; ?></td>
              </tr>
              <?php
          }
          ?>
        </table>
        <?php
    }
    ?>
  </body>
</html>
