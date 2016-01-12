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
      //認識結果1と入力フォームを表示
      foreach($select_recognition as $value_recognition){
          ?>
          <form action="./list_insert.php" method="POST">
            <tr>
              <td><input type="text" name="listName" value="<?php echo $value_recognition['result1']; ?>"></td>
              <td><input type="text" name="listKind" value="<?php foreach($select_list as $value_list){if($value_recognition['result1'] == $value_list['listName']){echo $value_list['listKind'];}} ?>"></td>
              <td><input type="text" name="listCategory" value="<?php foreach($select_list as $value_list){if($value_recognition['result1'] == $value_list['listName']){echo $value_list['listCategory'];}} ?>"></td>
              <td><input type="submit" name="btnSubmit" style="width:40px" <?php foreach($select_list as $value_list){if($value_recognition['result1'] == $value_list['listName']){ ?>value=""<?php }} ?>></td>
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

    if(empty($_POST['listCategory'])){
        $listCategory = null;
    }else{
        $listCategory = $_POST['listCategory'];
    }

    //リストをDBに追加
    if(!empty($listName) && !empty($listKind) && !empty($listCategory)){
        $insert_result = insert_list($listName, $listKind, $listCategory);
    }
    ?>
  </body>
</html>
