<?php require_once 'api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <table border=1>
      <tr>
        <th>画像の番号</th>
        <th>画像のURL</th>
        <th>投稿日時</th>
        <th>SNSの番号</th>
      </tr>
      <?php
      //画像のURLと投稿日時を表示する
      $result = select_photo();

      foreach($result as $value){
          ?>
          <tr>
            <td><?php echo $value['photoID']; ?></td>
            <td><?php echo $value['photoURL']; ?></td>
            <td><?php echo $value['postedDatetime']; ?></td>
            <td><?php echo $value['snsID']; ?></td>
          </tr>
          <?php
      }
      ?>
    </table>
  </body>
</html>
