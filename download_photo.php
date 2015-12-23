<?php require_once 'api_dbaccesUtil.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
  <body>
      <?php
      //画像のURLから画像をダウンロードする関数
      function photo_download($url, $dir, $file_name){
          if(!is_dir($dir)){
              echo 'ディレクトリが存在しません。';
          }

          $p = pathinfo($url);
          $local_filename = null;

          //ダウンロードする画像のファイル名を指定する処理
          if($file_name){
              $local_filename = $dir . '/' . $file_name . '.' . $p['extension'];
          }else{
              $local_filename = $dir . '/' . $p['filename'] . '.' . $p['extension'];
          }

          //画像のダウンロード
          $tmp = file_get_contents($url);

          if(!$tmp){
              echo 'URL：' . $url . 'から画像をダウンロードできませんでした。';
          }else{
              echo 'URLから画像をダウンロードしました。';
          }

          $fp = fopen($local_filename, 'w');
          fwrite($fp, $tmp);
          fclose($fp);
      }

      //ダウンロードする画像のURL、ディレクトリ、ファイル名を指定
      photo_download('http://.jpg', 'photo', '0001');
      ?>
    </table>
  </body>
</html>
