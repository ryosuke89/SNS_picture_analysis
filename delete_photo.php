<?php require_once 'api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
      <?php
      //削除する範囲のphotoIDを入力
      $first = 3558;
      $last = 4738;

      //不要な画像のURLと投稿日時を削除する
      for($i = $first; $i <= $last; $i++){
          $result = delete_photo($first);
          $first = $first + 1;
      }
      if(!isset($result)){
          echo '削除しました。';
      }
      ?>
    </table>
  </body>
</html>
