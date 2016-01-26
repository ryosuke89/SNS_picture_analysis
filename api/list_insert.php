<?php require_once '../common/api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //画像認識の結果を重複を除いてDBから取得
    $select_recognition = group_by_recognition();
    //リストの取得
    $select_list = select_all('list');
    ?>
    <table border=1>
      <tr>
        <th>リストの名前</th>
        <th>種類名</th>
        <th>カテゴリー名</th>
      </tr>

      <?php
      //認識結果1と一致するものがリストに存在するかを確認
      foreach($select_recognition as $value_recognition){
          $flag = false;
          foreach($select_list as $value_list){
              if($value_recognition['result1'] == $value_list['listName']){
                  $flag = true;
              }
          }
          //リストに存在しない場合、認識結果1と入力フォームを表示
          if($flag == false){
              ?>
              <form action="./list_insert.php" method="POST">
                <tr>
                  <td><input type="text" name="listName" value="<?php echo $value_recognition['result1']; ?>"></td>
                  <td><input type="text" name="listKind"></td>
                  <td><input type="text" name="listCategory"></td>
                  <td><input type="submit" name="btnSubmit"></td>
                </tr>
              </form>
              <?php
          }
      }
      ?>
    </table>
    <?php
    //リストをDBに追加
    if(!empty($_POST['listName']) && !empty($_POST['listKind']) && !empty($_POST['listCategory'])){
        $insert_result = insert_list($_POST['listName'], $_POST['listKind'], $_POST['listCategory']);
    }
    ?>
  </body>
</html>
