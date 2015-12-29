<?php require_once 'api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
    <?php
    //削除する範囲のlistIDを入力
    $first = 5;
    $last = 10;

    //不要なリストを削除する
    for($i = $first; $i <= $last; $i++){
        $result = delete_list($first);
        $first = $first + 1;
    }

    if(!isset($result)){
        echo '削除しました。';
    }
    ?>
    </table>
  </body>
</html>
