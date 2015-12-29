<?php require_once 'api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //リストの取得
    $result = select_list();
    ?>
    <table border=1>
      <tr>
        <th>リストの番号</th>
        <th>リストの名前</th>
        <th>種類名</th>
      </tr>

      <?php
      foreach($result as $value){
          ?>
          <tr>
            <td><?php echo $value['listID']; ?></td>
            <td><?php echo $value['listName']; ?></td>
            <td><?php echo $value['listKind']; ?></td>
          </tr>
          <?php
      }
      ?>
    </table>
  </body>
</html>
