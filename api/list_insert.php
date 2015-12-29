<?php require_once 'api_dbaccesUtil.php'; ?>
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
    $select_list = select_list();
    ?>
    <table border=1>
      <tr>
        <th>画像認識の番号</th>
        <th>リストの名前</th>
        <th>種類名</th>
      </tr>

      <?php
      foreach($select_recognition as $value_recognition){
          ?>
          <form action="./list_insert.php" method="POST">
            <tr>
              <td><?php echo $value_recognition['recognitionID']; ?></td>
              <td><input type="text" name="listName" value="<?php echo $value_recognition['result1']; ?>"></td>
              <td><input type="text" name="listKind" value="<?php foreach($select_list as $value_list){if($value_recognition['result1'] == $value_list['listName']){echo $value_list['listKind'];}} ?>"></td>
              <td><input type="submit" name="btnSubmit"></td>
            </tr>
          </form>
          <?php
      }
      ?>
    </table>
    <?php
    //POSTの取得
    if(empty($_POST['listName'])){
        $listName = null;
    }else{
        $listName = $_POST['listName'];
    }

    if(empty($_POST['listKind'])){
        $listKind = null;
    }else{
        $listKind = $_POST['listKind'];
    }

    $insert_result = insert_list($listName, $listKind);
    ?>
  </body>
</html>
